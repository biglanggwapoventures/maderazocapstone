<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pumps extends MY_Controller 
{

	protected $tabTitle = 'Pumps';
	protected $contentTitle = 'Pumps';

	protected $viewPath = 'pumps';
	protected $resourceName = 'pumps';

	protected $subject = 'pump';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!user('login_type', 'a')) redirect('home');
		$this->load->model('Pump_model', 'pump');
        $this->load->helper('fuel_type');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->pump->all()
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
		$created = $this->pump->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$pump = $this->pump->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$pump['name']}",
			'data' => $pump,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->pump->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}
		$this->id = $id;
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$updated = $this->pump->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->pump->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->pump->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('name', 'pump name', ['required', 
			[
				'has_unique_name',  
				function($val){
					return $this->pump->has_unique('name', $val, $this->id);
				}
			]
		], ['has_unique_name' => 'The %s is already in use!']);

		$this->form_validation->set_rules('fuel_type_id[]', 'fuel type', ['required', 
			[
				'valid_fuel_type',  
				function($val){
					return fuel_type_exists($val);
				}
			]
		], ['valid_fuel_type' => 'Please select at least 1 (one) %s!']);

		if($this->form_validation->run()){
            $input = $this->input->post();

            $data = [
                'pump' => ['name' => $input['name']],
                'fuel_types' => []
            ];

            foreach($input['fuel_type_id'] AS $fuelType){
                $data['fuel_types'][] = ['fuel_type_id' => $fuelType];
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
