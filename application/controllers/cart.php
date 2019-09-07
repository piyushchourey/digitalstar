<?php
class Cart extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('category_model'); 
		$this->load->model('product_model'); 
		$this->data = array();
	}

	public function index()
	{
		//print_r($this->cart->contents()); die;
		$this->data['sel'] = 'cart';
		$this->data['body'] = 'front/cart';
		$this->load->view('structure', $this->data);
	}
	public function additem()
	{
		if($_POST['prdct_id'])
		{
			$product_detail = $this->product_model->getAll('products','id',$_POST['prdct_id']);
			if(isset($_POST['pack_timing']))
				$pack_timing = $_POST['pack_timing'];
			else
				$pack_timing = "";

			if(!empty($product_detail) && !empty($product_detail[0]))
			{
				if($product_detail[0]['discount_price'])
				{
					if($pack_timing=="twotime")
						$price  = $product_detail[0]['discount_price']*2;
					else
						$price  = $product_detail[0]['discount_price']*1;
				}
				else
				{
					if($pack_timing=="twotime")
						$price  = $product_detail[0]['price']*2;
					else
						$price  = $product_detail[0]['price']*1;
				}
				
				$data = array(
			        'id'      => 'sku_'.$product_detail[0]['id'],
			        'qty'     => $_POST['qty'],
			        'price'   => $price,
			        'name'    => $product_detail[0]['name'],
			        'options' => array('category_id' => $product_detail[0]['category_id'], 'image' => $product_detail[0]['image'],'pack_type'=>$product_detail[0]['pack_type'],'pack_timing'=>$pack_timing)
			);
				$this->cart->insert($data);
				$arr = array("type"=>"success","msg"=>count($this->cart->contents()));
			}
			else
				$arr = array("type"=>"fail","msg"=>"Product Not Added in cart");
		}
		else
			$arr = array("type"=>"fail","msg"=>"Please Try Again!!");

		echo json_encode($arr);
	}

	public function update()
	{
		if(!empty($_POST['row_id']))
		{
			if($_POST['qty'])
			{	
				$data = array(
					        'rowid' => $_POST['row_id'],
					        'qty'   => $_POST['qty']
					);
				$this->cart->update($data);
				$arr = array("type"=>"success","msg"=>"Cart Update successfully.");
			}
			else
				$arr = array("type"=>"fail","msg"=>"Qty Not selected Properly!!!");
		}
		else
			$arr = array("type"=>"fail","msg"=>"Something went wrong!!!");

		echo json_encode($arr);
	}

	public function remove()
	{
		if(!empty($_POST['row_id']))
		{
			$data = array(
					        'rowid' => $_POST['row_id'],
					        'qty'   => 0
					);
			$this->cart->update($data);
			$arr = array("type"=>"success","msg"=>"Cart Update successfully.");
		}
		else
			$arr = array("type"=>"fail","msg"=>"Something went wrong!!!");
		echo json_encode($arr);
	}

	public function checkout()
	{
		if(count($this->cart->contents()) > 0)
		{
			$this->data['user_info'] = $this->product_model->getAll('user','mobile',$this->session->userdata('mobile_num'));
			//print_r($this->data['user_info']); die;
			$this->data['sel'] = 'Checkout';
			$this->data['body'] = 'front/checkout';
			$this->load->view('structure', $this->data);
		}
		else
		{
			redirect('main');
		}
		
	}

	public function getProductData()
	{
		if(!empty($_POST) && $_POST['prdct_id'])
		{
			$product_detail = $this->product_model->getAll('products','id',$_POST['prdct_id']);
			if(!empty($product_detail) && !empty($product_detail[0]))
			{
				if($_POST['Timing']=="twotime")
						$arr = array("price"=>$product_detail[0]['price']*2,"discountPrice"=>$product_detail[0]['discount_price']*2);
				else
						$arr = array("price"=>$product_detail[0]['price']*1,"discountPrice"=>$product_detail[0]['discount_price']*1);
			}
		}
		else
		{
			$arr = array("type"=>"fail");
		}
		echo json_encode($arr);
	}
}
?>