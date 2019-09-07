<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Seller_Model Extends CI_Model {
	
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
		return ($this->db->affected_rows()>0)? TRUE:FALSE;
	}

	public function getAllprdct($tableName,$wherefield="",$id="")
	{
		$this->db->select('product.*,category.name as category_name');
		$this->db->from($tableName);
		$this->db->join("category","category.id=product.category_id");
		if($id!="")
			$this->db-> where($wherefield, $id);
		
		$this->db->order_by('date',"DESC");
		$product_arr = $this->db->get()->result_array();
		return $product_arr;
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