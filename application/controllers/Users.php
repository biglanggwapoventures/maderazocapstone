<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller 
{

	protected $tabTitle = 'Users';
	protected $contentTitle = 'Users';

	protected $viewPath = 'users';
	protected $resourceName = 'users';

	protected $subject = 'user';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!user('login_type', 'a')) redirect('home');
		$this->load->model('User_model', 'user');
		$this->load->helper('date2');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->user->all()
		]);
	}

	function create()
	{
		$this->generate_page('manage', [
			'title' => "Create new {$this->subject}",
			'action' => "{$this->resourceName}/store",
			'data' => []
		]);
	}

	function store()
	{
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}

		$validate['data']['login_password'] = md5($validate['data']['login_password']);

		$created = $this->user->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$user = $this->user->get($id)){
			show_404();
		}
		
		if($user['login_type'] === 's'){
			$user['am_shift_start'] = format_date($user['am_shift_start'], 'h:i A', 'H:i:s');
			$user['am_shift_end'] = format_date($user['am_shift_end'], 'h:i A', 'H:i:s');
			$user['pm_shift_start'] = format_date($user['pm_shift_start'], 'h:i A', 'H:i:s');
			$user['pm_shift_end'] = format_date($user['pm_shift_end'], 'h:i A', 'H:i:s');
		}

		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$user['login_username']}",
			'data' => $user,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->user->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}

		$this->id = $id;

		$validate = $this->_validate();
		
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}

		if($validate['data']['login_password']){
			$validate['data']['login_password'] = md5($validate['data']['login_password']);
		}else{
			unset($validate['data']['login_password']);
		}

		$updated = $this->user->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->user->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->user->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function view_shift()
	{
		$attendance_id = $this->input->get('attendance_id');
		$current_sales = $this->user->get_sales($attendance_id);
		if(!$current_sales){

		}else{

			$this->viewPath = '';
			$this->tabTitle = 'View shift detail';
			$this->contentTitle = 'View shift detail';

			$this->load->model([
				'Pump_model' => 'pump', 
				'Creditor_model' => 'creditor', 
			]);

			$this->load->helper('date2');

			$pumps = $this->pump->all();
            $creditors = $this->creditor->all();

			$this->generate_page('view-shift-details', compact(['pumps', 'creditors', 'current_sales']));
		}
	}

	function _validate()
	{
        $this->form_validation->set_rules('firstname', 'first name', 'required');
        $this->form_validation->set_rules('lastname', 'last name', 'required');
        $this->form_validation->set_rules('position', 'position', 'required');
        $this->form_validation->set_rules('contact_number', 'contact number', 'required');
        $this->form_validation->set_rules('email_address', 'email address', 'required|valid_email');

		$this->form_validation->set_rules('login_username', 'login username', ['required', 
			[
				'has_unique_login_username',  
				function($val){
					return $this->user->has_unique('login_username', $val, $this->id);
				}
			]
		], ['has_unique_login_username' => 'The %s is already in use!']);

		$requirePassword = !$this->id ? '|required' : '';
		$this->form_validation->set_rules('login_password', 'login password', "min_length[4]{$requirePassword}");
		if($this->input->post('login_password')){
			$this->form_validation->set_rules('password_confirmation', 'password confirmation', "required|matches[login_password]");
		}

        $this->form_validation->set_rules('login_type', 'login type', 'required|in_list[a,s]', [
           'in_list' => 'The %s can only be Admin or Standard.' 
        ]);

		if(!form_error('login_type') && $this->input->post('login_type') === 's'){
			$timeFields = ['am_shift_start' => 'Shift Start (AM)', 'am_shift_end' => 'Shift End (AM)', 'pm_shift_start' => 'Shift Start (PM)', 'pm_shift_end' => 'Shift End (PM)'];
			foreach($timeFields AS $name => $label){
				$this->form_validation->set_rules($name, $label, [ 'required', 
				 	[
						 'is_valid_time', 
						 function($str){
							 return is_valid_date($str, 'g:i A');
						 }
					]
				], ['is_valid_time' => 'Please provide %s']);
			}
		}

		if($this->form_validation->run()){
			$input = $this->input->post();

			$data = elements([
				'login_username', 
				'login_password', 
				'login_type',
				'firstname',
				'lastname',
				'contact_number',
				'email_address',
				'position'
			], $input);

			if($data['login_type'] === 's'){
				$data += [
					'am_shift_start' => format_date($input['am_shift_start'], 'H:i'),
					'am_shift_end' => format_date($input['am_shift_end'], 'H:i'),
					'pm_shift_start' => format_date($input['pm_shift_start'], 'H:i'),
					'pm_shift_end' => format_date($input['pm_shift_end'], 'H:i'),
				];
			}
			
			return [
				'result' => TRUE,
				'data' => $data
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}
