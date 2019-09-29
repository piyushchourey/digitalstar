<?php
class Employee extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		//$this->session_model->checkSession('admin');
		$this->load->model('employee_model'); 
		$this->data = array();
	}

	public function index()
	{
		$this->data['sel']='Employee Management';
		$this->data['emp_type_info']=$this->employee_model->getAll('role');
		$this->data['result']=$this->employee_model->getAll('login',"id!=",1);
		$this->data['body'] = 'admin/employee';	
		$this->load->view('structure', $this->data);
	}
    
	public function type()
	{
		$this->data['sel']='Category Type';
		$this->data['cat_type_info']=$this->employee_model->getAll('category_type_info');
		$this->data['body'] = 'admin/category_type';	
		$this->load->view('structure', $this->data);
	}


	/**
	 *  This function used to add and edit role created by admin
	 */
	public function add()
	{
		if(!empty($_POST))
		{
			if(isset($_POST['id']) && $_POST['id']!="")
			{	
				if($this->employee_model->checkExist('login','email',$_POST['email']))
				{
					if($this->employee_model->update('login',elements(array('email','password','mobileNumber','type','manager_id','status'), $_POST)))
					{
						$res = array("type"=>"success","msg"=>"Employee Update Successfully.");
					}
					else
					{
						$res = array("type"=>"fail","msg"=>"Employee Not Update Successfully.");
					}
				}
				else
				{
					$res = array("type"=>"fail","msg"=>"This Email id alredy exist.");
				}
			}
			else
			{
				if($this->employee_model->checkExist('login','email',$_POST['email']))
				{
					$_POST['dateTime'] = date('Y-m-d h:i:s'); $_POST['status'] = 1; $_POST['manager_id'] = 1;$_POST['password'] = md5($_POST['password']);
					
					if($this->employee_model->insert('login',elements(array('email','password','mobileNumber','type','manager_id','status'), $_POST)))
						$res = array("type"=>"success","msg"=>"Employee Add Successfully.");
					else
						$res = array("type"=>"fail","msg"=>"Employee Not Add Successfully.");
				}
				else
				{
					$res = array("type"=>"fail","msg"=>"This Email id alredy exist.");
				}
			}
		}
		else
		{
			$res = array("type"=>"fail","msg"=>"Please Try again!!");
		}
		echo json_encode($res);
	}

	public function getEditdata()
	{
		if(!empty($_POST['catId']))
		{
			$data = $this->employee_model->getAll('category','id',$_POST['catId']);
			$data = array('type' =>"success" , 'html'=>$data);
		}
		else
		{
			$data = array('type' =>"fail" , 'msg'=>'Please Try again!!');
		}
				
		echo json_encode($data);
	}

	public function delete()
	{
		if(!empty($_POST) && isset($_POST['id']))
		{
			$data = $this->employee_model->delete('login','id',$_POST['id']);
			$data = array('type' =>"success" , 'msg'=>'Employee Delete Successfully.');
		}
		else
		{
			$data = array('type' =>"fail" , 'msg'=>'Please Try again!!');
		}
		echo json_encode($data);
	}

	public function getType()
	{
		if(!empty($_POST) && $_POST['cat_id'])
		{	
			$data = $this->employee_model->getAll('category','id',$_POST['cat_id']);
			if(!empty($data) && !empty($data[0]))
			{
				if($data[0]['category_type']==2)
					echo true;
				else
					echo false;
			}
		}
	}
}
?>