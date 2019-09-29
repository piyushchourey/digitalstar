<?php
class Category extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		//$this->session_model->checkSession('admin');
		$this->load->model('category_model'); 
		$this->data = array();
	}

	public function index()
	{
		$this->data['sel']='Category';
		$this->data['cat_type_info']=$this->category_model->getAll('category_type_info');
		$this->data['result']=$this->category_model->getAll('category');
		$this->data['body'] = 'admin/category';	
		$this->load->view('structure', $this->data);
	}
    
	public function type()
	{
		$this->data['sel']='Category Type';
		$this->data['cat_type_info']=$this->category_model->getAll('category_type_info');
		$this->data['body'] = 'admin/category_type';	
		$this->load->view('structure', $this->data);
	}


	//add category..
	public function add()
	{

		if(!empty($_POST))
		{
			if(isset($_POST['id']) && $_POST['id']!="")
			{	
				if($this->category_model->checkExist('category','name',$_POST['name']))
				{
					if($this->category_model->update('category',elements(array('name'), $_POST),'id',$_POST['id']))
					{
						$res = array("type"=>"success","msg"=>"Category Update Successfully.");
					}
					else
					{
						$res = array("type"=>"fail","msg"=>"Category Not Update Successfully.");
					}
				}
				else
				{
					$res = array("type"=>"fail","msg"=>"Category Alredy Exist.");
				}
			}
			else
			{
				if($this->category_model->checkExist('category','name',$_POST['name']))
				{
					if(!empty($_FILES) && !empty($_FILES['cat_img']))
					{
						$_POST['cat_img'] = imageupload('cat_img','images/category');	
					}
					if($this->category_model->insert('category',elements(array('name','category_type','cat_img'), $_POST)))
						$res = array("type"=>"success","msg"=>"Category Add Successfully.");
					else
						$res = array("type"=>"fail","msg"=>"Category Not Add Successfully.");
				}
				else
				{
					$res = array("type"=>"fail","msg"=>"Category Alredy Exist.");
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
			$data = $this->category_model->getAll('category','id',$_POST['catId']);
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
			$data = $this->category_model->delete('category','id',$_POST['id']);
			$data = array('type' =>"success" , 'msg'=>'Category Delete Successfully.');
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
			$data = $this->category_model->getAll('category','id',$_POST['cat_id']);
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