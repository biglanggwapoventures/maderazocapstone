<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditor_types extends MY_Controller 
{

	protected $tabTitle = 'Creditor Types';
	protected $contentTitle = 'Creditor Types';

	protected $viewPath = 'creditor-types';
	protected $resourceName = 'creditor-types';

	protected $subject = 'creditor type';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!user('login_type', 'a')) redirect('home');
		$this->load->model('Creditor_type_model', 'creditor_type');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->creditor_type->all()
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
		$created = $this->creditor_type->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$creditor_type = $this->creditor_type->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$creditor_type['name']}",
			'data' => $creditor_type,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->creditor_type->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}
		$this->id = $id;
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$updated = $this->creditor_type->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->creditor_type->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->creditor_type->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('name', 'creditor type name', ['required', 
			[
				'has_unique_name',  
				function($val){
					return $this->creditor_type->has_unique('name', $val, $this->id);
				}
			]
		], ['has_unique_name' => 'The %s is already in use!']);

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => elements(['name'], $this->input->post())
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}
