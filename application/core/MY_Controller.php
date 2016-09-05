<?php

class MY_Controller extends CI_Controller
{
    protected $tabTitle = NULL;
    protected $contentTitle = NULL;
    protected $viewPath = '';

    function __construct()
    {
        parent::__construct();
        if(!user('id')){
            redirect('/');
        }
    }

    function generate_page($view, $data = FALSE)
    {
        if(!strlen($this->viewPath)){
            $content = $this->load->view($view, $data, TRUE);
        }else{
            $content = $this->load->view(trim($this->viewPath, '/').'/'.$view, $data, TRUE);
        }
        
        $this->load->view('app', [
            'tabTitle' => $this->tabTitle,
            'contentTitle' => $this->contentTitle,
            'content' => $content
        ]);
    }

    function generate_json($data)
    {
        $this->output->set_content_type('json');
        $this->output->set_output(json_encode($data));
    }

    function user($prop = FALSE)
    {
        return $this->session->userdata($prop);
    }


}