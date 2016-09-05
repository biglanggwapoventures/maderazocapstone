<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fuel_types extends MY_Controller 
{

	protected $tabTitle = 'Fuel Types';
	protected $contentTitle = 'Fuel Types';

	protected $viewPath = 'fuel-types';
	protected $resourceName = 'fuel-types';

	protected $subject = 'fuel type';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!user('login_type', 'a')) redirect('home');
		$this->load->model('Fuel_type_model', 'fuel_type');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->fuel_type->all()
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
		$created = $this->fuel_type->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$fuel_type = $this->fuel_type->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$fuel_type['name']}",
			'data' => $fuel_type,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->fuel_type->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}
		$this->id = $id;
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$updated = $this->fuel_type->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->fuel_type->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->fuel_type->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('name', 'fuel type name', ['required', 
			[
				'has_unique_name',  
				function($val){
					return $this->fuel_type->has_unique('name', $val, $this->id);
				}
			]
		], ['has_unique_name' => 'The %s is already in use!']);

        $this->form_validation->set_rules('price', 'price', 'required');

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => elements(['name', 'price'], $this->input->post())
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}
