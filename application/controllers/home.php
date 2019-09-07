<?php

class Home extends CI_Controller
{
	function __construct() 
	{
		parent::__construct();
		if ($this->session->userdata('user_id')==FALSE)
			redirect('/admin');		
		    $activity=$this->session->userdata('user_activity');
            $max_time=600;
            $current_time=time()-$activity;
            if($current_time>$max_time)
			{
            	$this->session->unset_userdata('user_id');
            	$this->session->set_flashdata('login', 'false');
				$this->session->set_flashdata('msg', 'Session expired!');
                redirect('/');
            }
            else 
			{
                $this->session->set_userdata('user_activity',time());
            }
		
		$this->data = array();
		$this->data['sel']='dashboard';
	}

	public function index() 
	{	
		if($this->session->userdata('type')=='admin')
			$this->data['body']='admin/home';
		else
			$this->data['body']='front/index';
		
		$this->load->view('structure',$this->data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin');
	}

	public function changePassword()
    	{
    		$pswd = $_POST['pswd'];
    		$this->load->model('login_model');
			$data = $this->login_model->changePassword($pswd);
    		if($data == 1)
    		{
    			echo "hello";
    		}
    		
    	}

		
}


?>