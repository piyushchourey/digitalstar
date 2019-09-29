<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Login_Model Extends CI_Model {

public function signIn($userId,$password)
{	
	$this->db->where('email', $userId);
	$this->db->where('password', $password);
	$this->db->where('status', 1);
	$result=$this->db->get('login')->row_array();
	if(is_array($result))
		return $result;
	else
		return false;
}

	
public function forgotPassword($uname)
	{
		$this->db->select('*');
		$this->db->from('login');
		$this->db->where('uname', $uname);
		$query = $this->db->get();
		return $query->result_array();
	}

public function updatePanelPasswrd($uname,$randomPassword)
	{
		$this->db-> where('uname', $uname);
		$this->db->update('login', array('password' => $randomPassword));
	}

public function changepassword($pswd)
{
		//echo "<pre>"; print_r($this->session->all_userdata()); die;
		$id=$this->session->userdata('adminId');
		$data=array('password'=>md5($pswd));
		//$this->db->where('password', md5($this->input->post('oldpassword')));
		$this->db->where('id',$id);
	    $this->db->update('login',$data);
        return ($this->db->affected_rows()>0)? TRUE:FALSE;
}
function set_session($userinfo) {
      $this->session->set_userdata( array(
              'username'=> $userinfo->userid, 
			  'user_type'=>$userinfo->type,
              'isLoggedIn'=>true
          )
      );
  }

public function profileUpdate($tablenm)
{
	$result=$this->db->get($tablenm)->result_array();
	$data = $_POST;
	if(!empty($result))
	{
	 	$this->db->update('myprofile',$data);
    	return ($this->db->affected_rows()>0)? TRUE:FALSE;
	}
	else
	{
		$this->db->insert($tablenm, $data);
		return $this->db->insert_id();
	}
}

}
?>