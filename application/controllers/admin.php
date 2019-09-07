<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_id')==TRUE)
			redirect('home');
		$this->data = array();
	} 
	function index()
	{	
		$this->data['sel'] = 'signin';
		$this->load->view('signin',$this->data);
	}
}

?>
