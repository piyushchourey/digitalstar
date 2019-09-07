<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('type')=='admin')
			redirect('/home');	

		$this->load->model('category_model'); 
		$this->data = array();
	} 
	function index()
	{	
		//print_r($this->session->unset_userdata('otp')); die;
		if ($this->session->userdata('mob_verify'))
		{
			$this->data['sel'] = 'mainpage';
			$this->data['body'] = 'front/home';	
			$this->data['cat_type_info']=$this->category_model->getAll('category','category_type',1);
			//print_r($this->data['cat_type_info']); die;
			$this->load->view('structure', $this->data);
		}
		else
		{
			$this->load->view('front/index');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('mobile_num');
		$this->session->unset_userdata('otp');
		$this->session->unset_userdata('mob_verify');
		redirect('main');
	}
	public function category()
	{

		$this->data['sel'] = 'ascdxvfcgvh';
		$this->data['body'] = 'front/product';
		$this->load->view('structure', $this->data);

	}
}

?>
