<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    protected $tabTitle = 'Home';
	protected $contentTitle = 'Home';

    function __construct()
    {
        parent::__construct();

        $this->load->model([
            'Pump_model' => 'pump', 
            'Creditor_model' => 'creditor', 
            'User_model' => 'user'
        ]);

        $this->load->helper('date2');

    }

	function index()
	{  
        if(user('login_type') === User_model::LOGIN_TYPE_USER){

            $current_sales = $this->user->get_sales(user('attendance_id'));
            $pumps = $this->pump->all();
            $creditors = $this->creditor->all();
            $this->generate_page('welcome_message', compact(['pumps', 'creditors', 'current_sales']));

        }else{
            $shifts = $this->user->get_all_shifts();
            $this->generate_page('admin-home', compact('shifts'));
        }
	}

    function save()
    {   
        $input = $this->input->post();
        $data = [
            'log_id' => user('attendance_id'),
            'data' => json_encode($input)
        ];
        $this->user->save_sales($data);
        redirect('home');
    }
}