<?php
class Seller extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		//$this->session_model->checkSession('admin');
		$this->load->model('seller_model'); 
		$this->data = array();
	}

	public function index()
	{
		$this->data['sel']='Seller';
		//$this->data['all_prdct']=$this->product_model->getAllprdct('product');
		$this->data['body'] = 'admin/seller';	
		$this->load->view('structure', $this->data);
	}

	public function registration()
	{
		$this->data['sel']='Seller';
		$this->data['body'] = 'admin/seller_registration';	
		$this->load->view('structure', $this->data);
	}

	//add poduct..
	public function add()
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

				if($this->product_model->update('product', $_POST,'id',$id))
				{
					$this->session->set_flashdata('status','success');
					$this->session->set_flashdata('msg', 'Product Update Successfully.');
				}
				else
				{
					$this->session->set_flashdata('status','fail');
					$this->session->set_flashdata('msg', 'Product Not Update Successfully.');
				}
				$url= "product";
			}
			else
			{
				if(!empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['name']!="")
					$filenm = imageupload('image','images/products');	
				else
					$filenm = 'no_image.jpg';

				if($this->session->userdata('type')=="admin")
					$arr = array('status' => 1 , 'date'=>date('Y-m-d'),'p_image'=>$filenm );
				else
					$arr = array('status' => 0 , 'date'=>date('Y-m-d'),'p_image'=>$filenm );

				$_POST = $_POST + $arr;
				if($this->product_model->insert('product', $_POST))
				{
					$this->session->set_flashdata('status','success');
					$this->session->set_flashdata('msg', 'Product Add Successfully.');
				}
				else
				{
					$this->session->set_flashdata('status','fail');
					$this->session->set_flashdata('msg', 'Product Not Add Successfully.');
				}
				$url= "product/create";
			}
		}
		else
		{
			$this->session->set_flashdata('status','fail');
			$this->session->set_flashdata('msg', 'Please Try Again..');
		}
		redirect($url);
	}

	public function edit($id)
	{
		if(!empty($id))
		{
			$this->data['p_detail'] = $this->product_model->getAllprdct('product','product.id',$id);
			$this->data['category']=$this->product_model->getAll('category');
			$this->data['body'] = 'admin/editProduct';	
			$this->load->view('structure', $this->data);
		}
		else
		{
			redirect('product');
		}
	}

	public function delete()
	{
		if(!empty($_POST) && isset($_POST['id']))
		{
			if($this->product_model->delete('product','id',$_POST['id']))
				$data = array('type' =>"success" , 'msg'=>'Product Delete Successfully.');
			else
				$data = array('type' =>"fail" , 'msg'=>'Product Not Delete Successfully.');
		}
		else
		{
			$data = array('type' =>"fail" , 'msg'=>'Please Try again!!');
		}
		echo json_encode($data);
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