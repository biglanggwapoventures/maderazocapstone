<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
	}
	 
	function index()
	{
		$this->output->set_content_type('json');

		$this->form_validation->set_rules('login_username', 'username', 'required');
		$this->form_validation->set_rules('login_password', 'password', 'required');

		if(!$this->form_validation->run()){
			$this->output->set_output(json_encode([
				'result' => FALSE, 
				'errors' => $this->form_validation->errors()
			]));
			return;
		}

		$auth = elements(['login_username', 'login_password'], $this->input->post());
		if($user = $this->user->auth($auth['login_username'], $auth['login_password'])){
			$isShift = $this->user->check_shift($user['id']);

			if($user['login_type'] === User_model::LOGIN_TYPE_USER){
				if(!$isShift){
					$this->output->set_output(json_encode(['result' => FALSE, 'errors' => ['Unable to login. It is not yet your shift.']]));
					return;
				}
				$attendance_id = $this->user->check_in($user['id']);
				$user['attendance_id'] = $attendance_id;	
			}

			$this->session->set_userdata($user);
			$this->output->set_output(json_encode(['result' => TRUE]));
			return;
		}
		$this->output->set_output(json_encode(['result' => FALSE, 'errors' => ['Invalid username / password']]));
	}

	function logout()
	{
		$this->attendance->time_out(user('id'));
		session_destroy();
		redirect('welcome');
	}
}
