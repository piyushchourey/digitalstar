<?php
class Api extends CI_Controller {
    
    function __construct() 
    {
        parent::__construct();
        $this->load->model('category_model'); 
        $this->load->model('product_model'); 
        $this->data = array();
    }

    public function get($tableName)
    {
        $category_detail = $this->category_model->getAll($tableName);
        echo json_encode($category_detail);
    }

    public function getCategory()
    {
        $category_detail = $this->category_model->getCombineData('category','category_type_info','category_type','id');
        echo json_encode($category_detail);
    }

    public function getproductBycategory($category_id="")
    {
        $product_detail = $this->product_model->getAllprdctBycategory1('products.category_id',$category_id);
        
        echo json_encode($product_detail);
    }
    public function setMobile()
    {
        if(!empty($_POST) && !empty($_POST['mobile']) && $_POST['mobile']!="")
        {
            $otp = $this->sendMsg($_POST['mobile'],"web");
            if($otp)
            {
                if($_POST['method']=='default')
                    $otp_arr = array();
                else
                     $otp_arr = $this->session->userdata('otp');
                
                array_push($otp_arr,$otp);
                $this->session->set_userdata('mobile_num',$_POST['mobile']);
                $this->session->set_userdata('otp',$otp_arr);
                $this->session->set_userdata('mob_verify',false);
                $arr = array("type"=>"success","msg"=>"Great...OTP Sent Successsfully!!!");
            }
            else
                $arr = array("type"=>"fail","msg"=>"Something Went wrong.");
        }
        else
        {
            $arr = array("type"=>"fail","msg"=>"Please Try Again!!");
        }   
        echo json_encode($arr);
    }

    public function checkOtp()
    {
        if (!empty($_POST)) 
        {
           if($_POST['mobile']!="" && $_POST['otp_val']!="")
            {
                if($this->session->userdata('mobile_num')==$_POST['mobile'])
                {
                    if (in_array($_POST['otp_val'], $this->session->userdata('otp')))
                    {
                        $userArr = array("mobile"=>$_POST['mobile']);
                        $id = $this->category_model->insert('user',$userArr);
                        $this->session->set_userdata('mob_verify',true);
                        $this->session->set_userdata('user_id',$id);
                        $arr = array("type"=>"success","msg"=>"Right");
                    }
                    else
                    {
                        $arr = array("type"=>"fail","msg"=>"Sorry...Otp Not match.");
                    }
                }
                else
                {
                    $arr = array("type"=>"fail","msg"=>"Sorry...Mobile Number Not match.");
                }
            }
            else
            {
                $arr = array("type"=>"fail","msg"=>"Sorry...Mobile Number or Otp is empty.");
            }
        }
        else
        {
            $arr = array("type"=>"fail","msg"=>"Sorry...Please Try Again.");
        }
        echo json_encode($arr);
    }

    public function insertUser()
    {
        $arr = file_get_contents("php://input"); 
        $new_arr = (array)json_decode($arr);
        if(array_key_exists("id",$new_arr)) 
        {
            $id = $new_arr['id']; unset($new_arr['id']);
            if($this->category_model->update('user',$new_arr,'id',$id))
                $arr = $new_arr;
            else
                $arr = array('errorMsg' => 'fail');
        }
        else
        {
            if(!empty($new_arr['mobile']))
            {
               $checkExist = $this->category_model->getAll('user','mobile',$new_arr['mobile']);
                if(!empty($checkExist) && !empty($checkExist[0]))
                {
                    $arr = $checkExist[0];
                }
                else
                {
                    $arr = array("mobile"=>$new_arr['mobile']);
                    $user_id = $this->category_model->insert('user',$arr);
                    if($user_id)
                        $arr = array("mobile"=>$arr['mobile'],"id"=>$user_id);
                    else
                        $arr = array("errorMsg"=>"please Try again.");
                }
            }
            else
                $arr = array('errorMsg' => 'Something went wrong..');
        }

         echo json_encode($arr);
    }

    public function sendMsg($mobileNumber,$where="")
    {
            /*Send SMS using PHP*/    
        //Your authentication key
        $authKey = "194452Ap6B2ljkY5a64818f";
        
        //Multiple mobiles numbers separated by comma
        $mobileNumber = $mobileNumber;
        
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "102234";
        
        $otp = $six_digit_random_number = mt_rand(1000, 9999);
        
        $msg = $otp. " is your OTP(One time password) for login into Holla Food account.";
        //Your message to send, Add URL encoding here.
        $message = urlencode($msg);
        
        //Define route 
        $route = "4";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        
        //API URL
        $url="https://control.msg91.com/api/sendhttp.php";
        
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        
        //get response
        $output = curl_exec($ch);
        
        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        
        curl_close($ch);
        
       if($output!="")
       {
            if($where!="")
                return $otp;
            else
                echo json_encode(array('type'=>"Successs","otp"=>$otp));
       }
       else
       {
            if($where!="")
                return false;
            else
            echo json_encode(array('type'=>"fail"));
       }
    }
}
?>




