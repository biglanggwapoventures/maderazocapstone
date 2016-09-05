<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditors extends MY_Controller 
{

	protected $tabTitle = 'Creditors';
	protected $contentTitle = 'Creditors';

	protected $viewPath = 'creditors';
	protected $resourceName = 'creditors';

	protected $subject = 'creditor';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!user('login_type', 'a')) redirect('home');
		$this->load->model('Creditor_model', 'creditor');
        $this->load->helper('creditor');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->creditor->all()
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
		$created = $this->creditor->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$creditor = $this->creditor->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$creditor['name']}",
			'data' => $creditor,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->creditor->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}
		$this->id = $id;
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$updated = $this->creditor->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->creditor->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->creditor->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('name', 'creditor name', ['required', 
			[
				'has_unique_name',  
				function($val){
					return $this->creditor->has_unique('name', $val, $this->id);
				}
			]
		], ['has_unique_name' => 'The %s is already in use!']);

		$this->form_validation->set_rules('creditor_type_id', 'creditor type', ['required', 
			[
				'valid_creditor_type',  
				function($val){
					return creditor_type_exists($val);
				}
			]
		], ['valid_creditor_type' => 'Please select a %s!']);

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => elements(['name', 'creditor_type_id'], $this->input->post())
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}
