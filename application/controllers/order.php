<?php
class Order extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('category_model'); 
		$this->load->model('product_model'); 
		$this->data = array();
	}
	public function pay()
	{
		if(!empty($_POST))
		{
			$error = "";
			$key_arr = array_keys($_POST);
			foreach ($key_arr as $k) {
				if($_POST[$k]=="")
					$error = true;
			}
			if(!$error)
				$this->data['getData'] = $_POST;
			else
				redirect('cart/checkout');

			$this->data['sel'] = 'payment';
			$this->data['body'] = 'front/pay';
			$this->load->view('structure', $this->data);
		}
		else
		{
			redirect('cart/checkout');
		}
		
	}
	public function confirmation()
	{ 
		$arr = file_get_contents("php://input"); 
        $new_arr = (array)json_decode($arr);
        if(!empty($new_arr))
        {
        	if($new_arr['userId']!="" && $new_arr['userId'] > 0)
        	{
        		if($new_arr['paymentId'] && $new_arr['paymentId']!="")
				{
					if(!empty($new_arr['productDetails']))
					{
						$order = array(); $order_detail = array();
						$total_amount = 0;
						foreach ($new_arr['productDetails'] as $cart) {
							$cart = (array)$cart;
							$total_amount+=$cart['price'];
						}
						$order['total_amount'] = $total_amount;
						$order['user_id'] = $new_arr['userId'];
						$order['status'] = 'in progress';
						$order['d_time'] = 0;
						$order['payment_type'] = $new_arr['paymentType'];
						$order['payment_id'] = $new_arr['paymentId'];
						$order_id = $this->product_model->insert('order_info',$order);
						if($order_id)
						{
							foreach ($new_arr['productDetails'] as $cart) {
								$cart = (array)$cart;
								$order_detail['order_id'] = $order_id;
								$order_detail['p_id'] = $cart['id'];
								$order_detail['qty'] = $cart['quantity'];
								$order_detail['price'] = $cart['price'];
								$order_detail['category_id'] = 1;
								$order_detail_id = $this->product_model->insert('order_detail',$order_detail);
							}
							if($order_detail_id)
							{
								if(!empty($new_arr['userDetail']))
								{
									$userArr['name'] = $new_arr['userDetail']['name'];
									$userArr['email'] = $new_arr['userDetail']['email'];
									$userArr['alternate_mobile'] = $new_arr['userDetail']['alternate_mobile'];
									$userArr['address'] = $new_arr['userDetail']['address'];
									$user_update = $this->product_model->update('user',$userArr,'id',$new_arr['userDetail']['id']);
									$arr = array("orderId"=>$order_id,'paymentId'=>$new_arr['paymentId'],'amount'=>$total_amount);
								}
								else
								{
									$arr = array("errorMsg"=>"User detail Id Not get!!");
								}
							}
							else
							{
								$arr = array("errorMsg"=>"Order detail Id Not get!!");
							}
						}
						else
						{
							$arr = array("errorMsg"=>"OrderId Not get!!");
						}
					}
					else
					{
						$arr = array("errorMsg"=>"cart details Not get!!");
					}
			}
			else
				$arr = array("errorMsg"=>"paymentId Not get!!");
        	}
        	else
        		$arr = array("errorMsg"=>"userId Not get!!");
        }
        else
        	$arr = array("errorMsg"=>"Please Try again!!");

        echo json_encode($arr);
	}


	public function confirm()
	{
		
		if(!empty($_POST) && count($this->cart->contents()) > 0)
		{
			
		if($this->session->userdata('user_id'))
		{
			if($_POST['razorpay_payment_id'] && $_POST['razorpay_payment_id']!="")
			{
				if(count($this->cart->contents())> 0)
				{
					$order = array(); $order_detail = array();
					$total_amount = 0;
					foreach ($this->cart->contents() as $cart) {
						$total_amount+=$cart['subtotal'];
					}
					$order['total_amount'] = $total_amount;
					$order['user_id'] = $this->session->userdata('user_id');
					$order['status'] = 'in progress';
					$order['d_time'] = 0;
					$order['payment_type'] = $_POST['payment_type'];
					$order['payment_id'] = $_POST['razorpay_payment_id'];
					$order_id = $this->product_model->insert('order_info',$order);
					if($order_id)
					{
						foreach ($this->cart->contents() as $cart) {
							$order_detail['order_id'] = $order_id;
							$order_detail['p_id'] = str_replace("sku_","",$cart['id']);
							$order_detail['qty'] = $cart['qty'];
							$order_detail['price'] = $cart['price'];
							$order_detail['category_id'] = $cart['options']['category_id'];
							$order_detail_id = $this->product_model->insert('order_detail',$order_detail);
						}
						if($order_detail_id)
						{
							$userArr['name'] = $_POST['name'];
							$userArr['email'] = $_POST['email'];
							$userArr['alternate_mobile'] = $_POST['alternate_mobile'];
							$userArr['address'] = $_POST['address'];
							$user_update = $this->product_model->update('user',$userArr,'id',$this->session->userdata('user_id'));
							$this->cart->destroy();
							$this->data['orderRes'] = 'success';
							$this->data['success_info'] = array("orderId"=>$order_id,'paymentId'=>$_POST['razorpay_payment_id'],'totalAmount'=>$total_amount);
						}
						else
						{
							$this->data['orderRes'] = 'Please Try Again...Order Not Completed';
						}
					}
					else
					{
						$this->data['orderRes'] = 'Order Not Completed';
					}
				}
				else
				{
					$this->data['orderRes'] = 'Your cart is empty!!';
				}
			}
			else
			{
				$this->data['orderRes'] = 'Payment Failed!!';
			}
		}
		else
		{
			$this->data['orderRes'] = 'Session Expired!!!';
		}
	}
	else
	{
		redirect('main');	
	}
	
		$this->data['sel'] = 'payment';
		$this->data['body'] = 'front/success';
		$this->load->view('structure', $this->data);
	}
}
?>