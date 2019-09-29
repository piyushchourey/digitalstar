<?php
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_id')==TRUE)
			redirect('home');
			$this->data = array();
			$this->load->model('login_model'); 
			//$this->load->model('admin_model'); 
			$this->data['sel']='login';
	} 
	public function index()
	{
		$this->load->view('signin');
	}
	public function forgotPassword()
		{
			$uname = $_POST['username'];
			$result = $this->login_model->forgotPassword($uname);
			if(empty($result))
				{
					echo "Not Found";
				}
			else if(!empty($result))
				{
					echo "Found";
					$randomPassword = random_string('alnum', 12);
					if($result[0]['type'] == "admin")
					{
							$data = array(
								'user_pswd' => $randomPassword
								);
							$this->email->clear();
					        $this->email->from('info@appsms.in', 'App SMS');
					      	$this->email->to($result[0]['email']);
					      	$this->email->subject('Forgot Password');
					      	$this->email->message('Hello '.$result[0]['email'].' Your New Password is : '.$randomPassword);
					      	if($this->email->send())
						      	{
	      		$this->login_model->updatePanelPasswrd($uname,md5($randomPassword));
					      		}
					}
				}
		}
	
	public function signIn() 
	{			
		if(isset($_POST['loginType']) && $_POST['loginType']=='user'){

		}else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$result = $this->login_model->signIn($email,md5($password));
		}
		if(!empty($result))
		{	
			$this->session->set_userdata('user_id',$result['id']);
			$this->session->set_userdata('email',$result['email']);
			$this->session->set_userdata('password',$result['password']);
			$this->session->set_userdata('type',$result['type']);
			$this->session->set_userdata('user_activity',time());   
			redirect('home');
		}
		else
		{
			$this->session->set_flashdata('login', 'false');
			$this->session->set_flashdata('msg', 'Username Or Password is invalid.');
			redirect('/admin');
		}
	}
	/** Get OTP from API for user login authentication */
	public function getOTP(){                                                      
		if($_POST['mobile'] && is_int($_POST['mobile'])){
			return array("type"=>"success","otp"=>"123456");
		}
	}
}
?>
