<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Employee_Model Extends CI_Model {
	
	public function insert($tableName,$data)
	{	
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
	public function getAll($tableName,$wherefield="",$id="")
	{
		if($id!="")
			$this->db->where($wherefield,$id);

		$result=$this->db->get($tableName)->result_array();
		return $result;
	}

	public function update($tableName,$data,$wherefield,$id)
	{
		if($id!="")
		{
			$this->db->where($wherefield,$id);
			$this->db->update($tableName, $data);
			return ($this->db->affected_rows()>0)? TRUE:FALSE;
		}
		else
		{
			return false;
		}
	}

	public function delete($tableName,$wherefield,$id)
	{
		$this->db->where($wherefield, $id);
		$this->db->delete($tableName); 
		return true;
	}
	public function checkExist($tableName,$wherefield,$fieldValue)
	{
		if($fieldValue!="")
			$this->db->where($wherefield,$fieldValue);

		$result=$this->db->get($tableName)->row_array();
		if(!empty($result))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function getCombineData($tableName1,$tableName2,$field1,$field2,$wherefield="",$fieldValue="")
	{
		$this->db->select($tableName1.'.*,'.$tableName2.'.*');
		$this->db->from($tableName1);
		$this->db->join("$tableName2","$tableName1.$field1=$tableName2.$field2");
		if($fieldValue!="")
			$this->db-> where($wherefield, $fieldValue);
		
		$product_arr = $this->db->get()->result_array();
		//echo $this->db->last_query(); die;
		//echo "<pre>"; print_r($product_arr); die;
		return $product_arr;
	}
	public function commonGet($options) {

		$select = false;
		$table = false;
		$join = false;
		$order = false;
		$limit = false;
		$offset = false;
		$where = false;
		$or_where = false;
		$single = false;
		$where_not_in = false;
		$like = false;

		extract($options);
		
		if ($select != false)
			$this->db->select($select);

		if ($table != false)
			$this->db->from($table);

		if ($where != false)
			$this->db->where($where);

		if ($where_not_in != false) {
			foreach ($where_not_in as $key => $value) {
				if (count($value) > 0)
					$this->db->where_not_in($key, $value);
			}
		}

		if ($like != false) {
			$this->db->like($like);
		}

		if ($or_where != false)
			$this->db->or_where($or_where);

		if ($limit != false) {

			if (!is_array($limit)) {
				$this->db->limit($limit);
			} else {
				foreach ($limit as $limitval => $offset) {
					$this->db->limit($limitval, $offset);
				}
			}
		}


		if ($order != false) {

			foreach ($order as $key => $value) {

				if (is_array($value)) {
					foreach ($order as $orderby => $orderval) {
						$this->db->order_by($orderby, $orderval);
					}
				} else {
					$this->db->order_by($key, $value);
				}
			}
		}


		if ($join != false) {

			foreach ($join as $key => $value) {

				if (is_array($value)) {

					if (count($value) == 3) {
						$this->db->join($value[0], $value[1], $value[2]);
					} else {
						foreach ($value as $key1 => $value1) {
							$this->db->join($key1, $value1);
						}
					}
				} else {
					$this->db->join($key, $value);
				}
			}
		}


		$query = $this->db->get();

		if ($single) {
			return $query->row();
		}
		//echo $this->db->last_query(); die;

		return $query->result_array();
	}


	/* old method */
	public function getLevelCategory($tableName,$level=0)
	{
		$this->db->where('parentCategory_id',$level);
		$result=$this->db->get($tableName)->result_array();
		return $result;
	}
	

	
	public function getData($tableName,$id="")
	{
		if($id!="")
		{
			$this->db->where('id',$id);
		}
		$result=$this->db->get($tableName)->result_array();
		if(!empty($result))
		{
			foreach($result as &$r)
			{
				if($r['parentCategory_id']!=0)
				{
					$this->db->where('id',$r['parentCategory_id']);
					$getname = $this->db->distinct()->select('name')->get($tableName)->result_array();
					$r['parentName'] = $getname[0]['name'];
				}
				else
				{
					$r['parentName'] = "Parent";
				}
			}
		}
		return $result;
	}
	

	public function searching($tableName,$id="")
	{
		if($id!="")
		{
			$this->db->where('parentCategory_id',$id);
		}
		$result=$this->db->get($tableName)->result_array();
		if(!empty($result))
		{
			foreach($result as &$r)
			{
				if($r['parentCategory_id']!=0)
				{
					$this->db->where('id',$r['parentCategory_id']);
					$getname = $this->db->distinct()->select('name')->get($tableName)->result_array();
					$r['parentName'] = $getname[0]['name'];
				}
				else
				{
					$r['parentName'] = "Parent";
				}
			}
			return $result;
		}
		else
		{
			return "childNotavailable";
		}
		
	}
	
	public function getEditdata($tableName,$id=0)
	{
		$this->db->where('id',$id);
		$result=$this->db->get($tableName)->result_array();
		return $result;
	}

	public function getcatEditdata($tableName,$id=0)
	{
		$this->db->select('category.*');
		$this->db->from('category');
		$this->db->where('category.id',$id);
		$result=$this->db->get()->result_array();
		return $result;
	}
	
	public function update_commsion($tableName,$data,$id)
	{
		if($id!="")
		{
			$this->db->where('category_id',$id);
			$this->db->update($tableName, $data);
			return ($this->db->affected_rows()>0)? TRUE:FALSE;
		}
	}


	public function sellerCategory()
	{
		$usernm = $this->session->userdata('username');
		$this->db->where('username',$usernm);
		$category = $this->db->select('category')->get('seller')->result_array();
		if(!empty($category) && !empty($category[0]))
		{
			$cat = $category[0]['category'];
			if($cat!="")
			{
				$merge_arr = array();
				$catArray= explode(",",$cat);
				if(!empty($catArray))
				{
					foreach($catArray as $c)
					{
						$this->db->where('id',$c);
						$category_arr = $this->db->select('*')->get('category')->result_array();
						if(!empty($category_arr) && !empty($category_arr[0]))
						{
							$merge_arr[] = $category_arr[0];
						}
					}
					return $merge_arr;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		//p($merge_arr);
	}
	
	public function checkProductstock($tableName,$data)
	{
		if(!empty($data))
		{
			if($this->db->insert($tableName, $data))
			{
				return $this->db->insert_id();
			}
			else
			{
				return  false;
			}
		}
	}
	
	
	
	
	
	
	
	
	///////////////////////////////////
	/*public function getTrainer()
	{
		$result=$this->db->get('trainer')->result_array();
		return $result;
	}
	
	public function FetchTrainingRoom()
	{
		$result=$this->db->get('training_room')->result_array();
		return $result;
	}
	
	public function FetchLocation()
	{
		$result=$this->db->get('location')->result_array();
		return $result;
	}
	
	function addsopformModal($data)
	{
		$dat=date("Y/m/d");
		$sop = array('title' => $_POST['title'],'days' => $_POST['days'],'sop_description' => $_POST['sop_description'],'date' => $dat);
		$this->db->insert('sop', $sop);
		$sopID= $this->db->insert_id();	
			for ($i=0; $i<sizeof($data['name']); $i++)
				{
					$sopname=array("name"=>$data['name'][$i],"description"=>$data['description'][$i],"sopID"=>$sopID);
					$this->db->insert('sopname',$sopname);
				} 	
				return $this->db->insert_id();
	}
	
	function fetchsop()
	{
		//$this->db->select('sop.*,trainer.name');
		//$this->db->from('sop');
		//$this->db->join('trainer','trainer.id=sop.trainer');
		$result=$this->db->get('sop')->result_array();
		return $result;
	}
	
	public function fetchsopname($sopid)
	{
		$this->db->where('sopID', $sopid);
		$query = $this->db->get('sopname');
		return $query->result_array();
	}	
	
	public function deletesopmodal($id)
	{
		$this->db->where('id',$id);
		$result=$this->db->delete('sop');
		$this->db->where('sopID',$id);
		$result=$this->db->delete('sopname');
		return ($this->db->affected_rows()>0)? TRUE:FALSE;
	}
	
	public function deletesopnamemodal($id)
	{
		$this->db->where('id',$id);
		$result=$this->db->delete('sopname');
		return ($this->db->affected_rows()>0)? TRUE:FALSE;
	}
	
	public function updatesop($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$result=$this->db->get('sop')->result_array();
		//echo "<pre>";
		//print_r($result); 
		if(!empty($result[0]))
		{
			$id = $result[0]['id'];
			$this->db->where('sopname.sopID', $id);
			$result1=$this->db->select('sopname.name,sopname.id,sopname.description')->get('sopname')->result_array();
			
			if(!empty($result1))
			{
				foreach($result1 as $r)
				{
					$result[0]['sopname'][] = $r['name'];
					$result[0]['sopnameID'][] = $r['id'];
					$result[0]['description'][] = $r['description'];
				}
				return $result;
				//print_r($result);  die;
			}
			else
			{
				return $result;
			}
		}
		else
		{
			return false;
		}	
	}
	
	
	public function deleteupdatesopnamemodal($id)
	{
		$this->db->where('id',$id);
		$result=$this->db->delete('sopname');
		return ($this->db->affected_rows()>0)? TRUE:FALSE;
	}
	
	public function updatesopformModal($data)
	{
		//print_r($data); die;
		$id=$data['updateid'];
		$sop = array('title' => $_POST['title'],'days' => $_POST['days'],'trainer' => $_POST['trainer']);
		$this->db->where('id',$id);
		$this->db->update('sop', $sop);
			
			$this->db->select('*');
			$this->db->where('sopID',$id);
			$this->db->get();
			
			
			for ($i=0; $i<sizeof($data['name']); $i++)
			{
				$sopname=array("name"=>$data['name'][$i]);
				//$this->db->insert('sopname',$sopname);
				$this->db->where('sopID',$id);
				$this->db->update('sopname', $sopname);
			} 	
			//return true;
	}
	public function insertNewArray($newArray)
	{
		//print_r($newArray); die;
		if(!empty($newArray))
		{
			foreach($newArray as $new)
			{
				$this->db->insert('sopname', $new);
			}
			return $this->db->insert_id();
		}
	}
	public function insertOldArray($oldNameArray,$oldDescArray )
	{
		//echo "<pre>"; print_r($oldNameArray); echo "<pre>"; print_r($oldDescArray);die;
		if(!empty($oldNameArray) && !empty($oldDescArray))
		{
			foreach($oldNameArray as $key=>$value)
			{
				$id = ltrim($key,"id");
				$desc = $oldDescArray['desid'.$id];
				$data = array("name"=>$value,"description"=>$desc);
				$this->db->where('id',$id);
				$this->db->update('sopname',$data);
			}
		}
		return true;
	}
	
	public function inserItem($tableName,$id="",$data)
	{
		if($id!="")
		{
			$this->db->where('id',$id);
			$this->db->update($tableName, $data);
			return ($this->db->affected_rows()>0)? TRUE:FALSE;
		}
		else
		{
			$this->db->insert($tableName, $data);
			return $this->db->insert_id();
		}
	}
	public function deleteItem($tableName,$id)
	{
		if($id)
		{
			$this->db->where('id',$id);
		}
		$this->db->delete($tableName);
		return ($this->db->affected_rows()>0)? TRUE:FALSE;
	}

	public function insert($tableName,$data)
	{
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
	public function getCategoryData($tableName,$id)
	{
		//$this->db->select('sop.*,trainer.name');
		//$this->db->from('sop');
		//$this->db->join('trainer','trainer.id=sop.trainer');
		$result=$this->db->get('sop')->result_array();
		return $result;
	}*/

		
	
	
	
	
	
	
	
	
	
	
	
	

	

		

}
?>