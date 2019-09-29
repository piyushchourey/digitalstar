<?php
class Campaign extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		//$this->session_model->checkSession('admin');
		$this->load->model('employee_model'); 
		$this->data = array();
	}

	public function index()
	{
		$this->data['sel']='Campaign';
		$option = array(
			'select' => 'campaign.*,login.email',
			'table' => 'campaign',
			'join' => array('login' => 'login.id = campaign.createdBy')
			);
		$this->data['result']=$this->employee_model->commonGet($option);
		$this->data['body'] = 'admin/campaign';	
		$this->load->view('structure', $this->data);
	}

	public function add()
	{
		if(!empty($_POST))
		{
			if(isset($_POST['id']) && $_POST['id']!="")
			{	
				if($this->employee_model->checkExist('campaign','name',$_POST['name']))
				{
					$_POST['dateTime'] = date('Y-m-d h:i:s'); $_POST['createdBy'] = $this->session->userdata('user_id');
					if($this->employee_model->update('campaign',elements(array('name','dateTime','createdBy'), $_POST)))
						$res = array("type"=>"success","msg"=>"Campaign Update Successfully.");
					else
						$res = array("type"=>"fail","msg"=>"Campaign Not Update Successfully.");
				}
				else
					$res = array("type"=>"fail","msg"=>"Campaign name alredy exist.");
			} 
			else
			{
				if($this->employee_model->checkExist('campaign','name',$_POST['name']))
				{
					$_POST['dateTime'] = date('Y-m-d h:i:s'); $_POST['createdBy'] = $this->session->userdata('user_id');
					
					if($this->employee_model->insert('campaign',elements(array('name','dateTime','createdBy'), $_POST)))
						$res = array("type"=>"success","msg"=>"Campaign Add Successfully.");
					else
						$res = array("type"=>"fail","msg"=>"Campaign Not Add Successfully.");
				}
				else
					$res = array("type"=>"fail","msg"=>"Campaign name alredy exist.");
			}
		}
		else
		{
			$res = array("type"=>"fail","msg"=>"Please Try again!!");
		}
		echo json_encode($res);
	}

	// public function monthlySubscription()
	// {
	// 	$this->data['sel']='Monthly Subscription';
	// 	$this->data['pack_prdct']=$this->product_model->getAllprdctBycategory('category_type',2);
	// 	$category_type_info = $this->product_model->getAll('category_type_info','id',2);
	// 	if(!empty($category_type_info) && !empty($category_type_info[0]))
	// 	{
	// 		$pack = explode(",",($category_type_info[0]['pack_type']));
    //            if(!empty($pack))
    //            	{
    //               	$this->data['my_prdct'] = $this->product_model->getAllprdctBycategory_demo($pack);
    //           	}
	// 	}
	// 	//die;
		
	// 	$this->data['category_type_info']= $category_type_info;
	// 	$this->data['body'] = 'front/monthlySubscription';	
	// 	$this->load->view('structure', $this->data);
	// }

	//add poduct..
	// public function add()
	// {
	// 	if(!empty($_POST))
	// 	{
	// 		if(isset($_POST['id']) && $_POST['id']!="")
	// 		{	
	// 			$id = $_POST['id']; 
	// 			if(!empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['name']!="")
	// 			{
	// 				$_POST['image'] = imageupload('image','images/products');	
	// 			}
	// 			else
	// 			{
	// 				if(isset($_POST['old_path']) && $_POST['old_path']!="")
	// 				{

	// 					$_POST['image'] = $_POST['old_path']; 
	// 				}
	// 				else
	// 					$filenm = 'no_image.jpg';
	// 			}
	// 			unset($_POST['old_path']); unset($_POST['id']);
	// 			if($_POST['discount_type']!="")
	// 			{
	// 				if($_POST['discount_type']=='percentage')
	// 					$_POST['discount_price'] = ($_POST['price'] - (($_POST['price']*$_POST['discount'])/100));
	// 				else
	// 					$_POST['discount_price'] = $_POST['price'] - $_POST['discount'];
	// 			}
	// 			if($this->product_model->update('products', $_POST,'id',$id))
	// 			{
	// 				$this->session->set_flashdata('status','success');
	// 				$this->session->set_flashdata('msg', 'Product Update Successfully.');
	// 			}
	// 			else
	// 			{
	// 				$this->session->set_flashdata('status','fail');
	// 				$this->session->set_flashdata('msg', 'Product Not Update Successfully.');
	// 			}
	// 			$url= "product";
	// 		}
	// 		else
	// 		{
	// 			if(!empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['name']!="")
	// 				$filenm = imageupload('image','images/products');	
	// 			else
	// 				$filenm = 'no_image.jpg';

	// 			if($this->session->userdata('type')=="admin")
	// 				$arr = array('status' => 1 , 'date'=>date('Y-m-d'),'image'=>$filenm );
	// 			else
	// 				$arr = array('status' => 0 , 'date'=>date('Y-m-d'),'image'=>$filenm );

	// 			if($_POST['discount_type']!="")
	// 			{
	// 				if($_POST['discount_type']=='percentage')
	// 					$_POST['discount_price'] = ($_POST['price'] - (($_POST['price']*$_POST['discount'])/100));
	// 				else
	// 					$_POST['discount_price'] = $_POST['price'] - $_POST['discount'];
	// 			}
				
	// 			$_POST = $_POST + $arr;
	// 			if($this->product_model->insert('products', $_POST))
	// 			{
	// 				$this->session->set_flashdata('status','success');
	// 				$this->session->set_flashdata('msg', 'Product Add Successfully.');
	// 			}
	// 			else
	// 			{
	// 				$this->session->set_flashdata('status','fail');
	// 				$this->session->set_flashdata('msg', 'Product Not Add Successfully.');
	// 			}
	// 			$url= "product/create";
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_flashdata('status','fail');
	// 		$this->session->set_flashdata('msg', 'Please Try Again..');
	// 	}
	// 	redirect($url);
	// }

	public function getEditdata()
	{
		if(!empty($_POST['catId']))
		{
			$option = array(
				'select' => 'campaign.name,campaign.id',
				'table' => 'campaign'
				);
			$data =$this->employee_model->commonGet($option);
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
			if($this->employee_model->delete('campaign','id',$_POST['id']))
				$data = array('type' =>"success" , 'msg'=>'Campaign Delete Successfully.');
			else
				$data = array('type' =>"fail" , 'msg'=>'Campaign Not Delete Successfully.');
		}
		else
		{
			$data = array('type' =>"fail" , 'msg'=>'Please Try again!!');
		}
		echo json_encode($data);
	}

	public function status_change()
	{
		if(!empty($_POST) && isset($_POST['id']))
		{
			$prdct_detail = $this->product_model->getAll('products','id',$_POST['id']);
			if(!empty($prdct_detail) && !empty($prdct_detail[0]))
			{
				if($prdct_detail[0]['status'])
					$update_arr = array("status"=>0);
				else
					$update_arr = array("status"=>1);

				if($this->product_model->update('products',$update_arr,'id',$_POST['id']))
					$data = array('type' =>"success" , 'msg'=>'Product status update Successfully.');
				else
					$data = array('type' =>"fail" , 'msg'=>'Product status update Successfully.');
			}
		}
		else
		{
			$data = array('type' =>"fail" , 'msg'=>'Please Try again!!');
		}
		echo json_encode($data);
	}

	public function monthly()
	{
		$this->data['sel']='Monthly Subscription';
		$this->data['all_subscription']=$this->product_model->getAll('subscription');
		$this->data['body'] = 'admin/monthly_subscription';	
		$this->load->view('structure', $this->data);
	}

	public function addMonthly()
	{
		$this->data['sel']='Monthly Subscription';
		$this->data['body'] = 'admin/addSubscription';	
		$this->load->view('structure', $this->data);
	}

	public function insertSubscription()
	{
		if(!empty($_POST))
		{
			if(isset($_POST['id']) && $_POST['id']!="")
			{	
				$id = $_POST['id']; 
				if(!empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['name']!="")
				{
					$_POST['p_image'] = imageupload('image','images/products');	
				}
				else
				{
					if(isset($_POST['old_path']) && $_POST['old_path']!="")
					{

						$_POST['p_image'] = $_POST['old_path']; 
					}
					else
						$filenm = 'no_image.jpg';
				}
				unset($_POST['old_path']); unset($_POST['id']);

				if($this->product_model->update('subscription', $_POST,'id',$id))
				{
					$this->session->set_flashdata('status','success');
					$this->session->set_flashdata('msg', 'Subscription Update Successfully.');
				}
				else
				{
					$this->session->set_flashdata('status','fail');
					$this->session->set_flashdata('msg', 'Subscription Not Update Successfully.');
				}
				$url= "product/monthly";
			}
			else
			{
				if(!empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['name']!="")
					$filenm = imageupload('image','images/products');	
				else
					$filenm = 'no_image.jpg';

				if($this->session->userdata('type')=="admin")
					$arr = array('image'=>$filenm );
				else
					$arr = array('image'=>$filenm );

				$_POST = $_POST + $arr;
				if($this->product_model->insert('subscription', $_POST))
				{
					$this->session->set_flashdata('status','success');
					$this->session->set_flashdata('msg', 'Subscription Add Successfully.');
				}
				else
				{
					$this->session->set_flashdata('status','fail');
					$this->session->set_flashdata('msg', 'Subscription Not Add Successfully.');
				}
				$url= "product/addMonthly";
			}
		}
		else
		{
				$this->session->set_flashdata('status','fail');
				$this->session->set_flashdata('msg', 'Please Try Again!!');
		}
		redirect($url);
	}

	public function categoryWise($cat_id)
	{
		if($cat_id)
		{
			$this->data['sel'] = 'category/ produt';
			$this->data['cat_product']=$this->product_model->getAllprdctBycategory('products.category_id',$cat_id);
			$this->data['cat_id'] = $cat_id;
			$this->data['body'] = 'front/product';
			$this->load->view('structure', $this->data);
		}
		else
		{
			redirect('main');
		}
	}




	/* old method */
	public function assignSpecialCategory()
	{
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		if($id){
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	
	public function getSubcat()

	{

		$catId = $_POST['catId'];

		$data = $this->category_model->getLevelCategory('category',$catId);

		echo json_encode($data);

	}
}

?>