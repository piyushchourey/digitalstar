<?php
class Contact extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		//$this->session_model->checkSession('admin');
		$this->load->model('category_model'); 
		$this->data = array();
	}

	public function index()
	{
		$this->data['sel']='Contact';
		$this->data['body'] = 'front/contact';	
		$this->load->view('structure', $this->data);
	}
}