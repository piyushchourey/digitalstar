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

	

	public function create()
	{
		if(!empty($_POST) && $_POST['parentCategory_id']!="" && $_POST['name']!="")
		{
			$data = $_POST;
			$last_id = $this->category_model->insert('category',$data);
			if($last_id)
			{
				$this->session->set_flashdata('success','Category Added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('fail','Category Not Added Successfully.!!!');
			}
		}
		else
		{
			$this->session->set_flashdata('fail','Please Select Right Options!!!');
		}
			redirect('category/add');
	}

	

	



	public function searching()

	{

		$catId = $_POST['categoryId'];

		if($catId)

		{

			$data = $this->category_model->searching('category',$catId);

		}

		else

		{

			$data = "false";

		}

		echo json_encode($data);

	}

	

		



	public function update()
	{
		//p($_POST);
		if(!empty($_POST))
		{
			$id = $_POST['id']; unset($_POST['id']);
			$data = $_POST;
			if($this->category_model->update('category',$data,$id))
			{
				$res = true;
			}
			else
			{
				$res = false;
			}

		}
		echo json_encode($res);

	}

	//our multi vendor query//

	

	public function getCategoryTreeForParentId($parent_id = 0) 
	{

		$categories = array();

		$this->db->where('id', $parent_id);

		$result = $this->db->get('category')->result();

			foreach ($result as $mainCategory) {

				$category = array();

				$category['id'] = $mainCategory->id;

				$category['name'] = $mainCategory->name;

				$category['parentCategory_id'] = $mainCategory->parentCategory_id;

				$category['sub_categories'] = $this->getCategoryTreeForParentId($category['parentCategory_id']);

				$categories[$mainCategory->id] = $category;

		  }

		echo "<pre>"; print_r($categories); die;

		return $categories;

	}
	
	//get all hierechical get child
	public function treeView($id)
	{
		
		$resp = $this->fetchCategoryTree($id);
		p($resp);
	}

	public function fetchCategoryTree($parent, $user_tree_array = '') 
	{
		
	  if (!is_array($user_tree_array))
		$user_tree_array = array();

		$this->db->where('parentCategory_id', $parent);
		$result = $this->db->select('id,parentCategory_id,name')->get('category')->result();
		
		foreach($result as $row) {
		  $user_tree_array[] = array("id" => $row->id, "name" => $row->name);
		  $user_tree_array = $this->fetchCategoryTree($row->id, $user_tree_array);

	  }
	  return $user_tree_array;
	}
	
	
	public function tree_View()
	{
		$new_arr = array();
		$result = $this->db->select('id,parentCategory_id')->get('category')->result_array();
		foreach($result as $r)
		{
		  $key = $r['id']; 
		  $value = $r['parentCategory_id'];
		  $new_arr[$key] = $value;
		}
		
		$tree = $this->parseTree($new_arr);
		
		p($this->printTree($tree));
		$this->data['tree_cat'] = $this->printTree($tree);
		$this->data['body'] = 'admin/treeView';	
		$this->load->view('structure', $this->data);
	}
	
	public function parseTree($tree, $root = 0)
	{
		$return = array();
		# Traverse the tree and search for direct children of the root
		foreach($tree as $child => $parent) {
			# A direct child is found
			if($parent == $root) {
				# Remove item from tree (we don't need to traverse this again)
				unset($tree[$child]);
				# Append the child into result array and parse its children
				$return[] = array(
					'name' => $child,
					'children' => $this->parseTree($tree, $child)
				);
			}
		}
		return empty($return) ? null : $return;    
	}
	
	public function printTree($tree)
	{	
		if(!is_null($tree) && count($tree) > 0) {
			echo '<ul>';
			foreach($tree as $node) {
				echo '<li>'.$this->getCatnm($node['name']);
				$this->printTree($node['children']);
				echo '</li>';
			}
			echo '</ul>';
		}
	}
	
	public function getCatnm($id)
	{
		$this->db->where('id', $id);
		$catnm_arr = $this->db->select('name')->get('category')->result_array();
		if(!empty($catnm_arr))
		{
			return $catnm_arr[0]['name'];
		}
	}

	/*public function addSop() 

	{	

		$this->data['sel']='SOP';

		$this->data['trainer'] = $this->admin_model->getTrainer();

		$this->data['trainingroom'] = $this->admin_model->FetchTrainingRoom();

		$this->data['location'] = $this->admin_model->FetchLocation();

		//echo "<pre>";print_r($this->data['trainer']); die;

		$this->data['body'] = 'admin/addSop';

		$this->load->view('structure', $this->data);

		

	}

	

	public function addsopform(){



		$data=$_POST;



		$result=$this->admin_model->addsopformModal($data);

		if ($result>0){

			redirect('admin/sop');

		//$this->session->set_flashdata('status','added');

		//$this->session->set_flashdata('msg', 'Entry  Added Successfully');

		//redirect('admin/addSop');	

		}

		else {

				$this->session->set_flashdata('status','error');

				$this->session->set_flashdata('msg', 'Try again some error occcured');

				redirect('admin/addSop');	

		}

	}

	

	public function sopname($sopid)

	{

		$this->data['sel']='SOP';

		$this->data['result']=$this->admin_model->fetchsopname($sopid);

		$this->data['body'] = 'admin/sopname';	

		$this->load->view('structure', $this->data);

	}

	

	public function deletesop()

	{

		$id=$_POST['arg1'];

		$result=$this->admin_model->deletesopmodal($id);

		if ($result==1){

			echo "deleted";

		}

		else {

			echo "";

		}

	}

	



	

	public function update($id)

	{

		

		$this->data['result']=$this->admin_model->updatesop($id);

		//echo "<pre>";

		//print_r($this->data['result']); die;

		//$this->data['trainer'] = $this->admin_model->getTrainer();

		//$this->data['trainingroom'] = $this->admin_model->FetchTrainingRoom();

		//$this->data['location'] = $this->admin_model->FetchLocation();

		$this->data['body'] = 'admin/updatesop';	

		$this->load->view('structure', $this->data);		

	}

	

	public function deleteupdatesopname()

	{

		$id=$_POST['arg1'];

		$result=$this->admin_model->deleteupdatesopnamemodal($id);

		echo 'deleted';

	}

	

	public function updatesopform(){

	//print_r($_POST); die;

		$id=$_POST['updateid'];	

		

		if(!empty($_POST['name']))

		{

			$newArray = array();

			$p=0;

			foreach($_POST['name'] as $key=>$value)

			{

				if(is_int($key))

				{

					$newArray[$p]['name'] = $value;

					$newArray[$p]['sopID'] =$_POST['updateid'];

					unset($_POST['name'][$key]);

				}

				$p++;

			}

		}

		

		if(!empty($_POST['description']))

		{

			$p=0;

			foreach($_POST['description'] as $key=>$value)

			{

				if(is_int($key))

				{

					$newArray[$p]['description'] = $value;

					$newArray[$p]['sopID'] =$_POST['updateid'];

					unset($_POST['description'][$key]);

				}

				$p++;

			}

		}

		



		$oldNameArray = $_POST['name']; 

		$oldDescArray = $_POST['description']; 



		

		if(!empty($newArray))

		{

			$result=$this->admin_model->insertNewArray($newArray);

		}

		$date=date("y-m-d");

		$sop = array('title' => $_POST['title'],'days' => $_POST['days'],'sop_description' => $_POST['sop_description'],

		'date' => $date

		);

		

		if($this->admin_model->insert($sop,$id))

		{

			

			if($this->admin_model->insertOldArray($oldNameArray,$oldDescArray))

			{

				redirect('admin/update/'.$id);

			}

		}

		else

		{

			

			redirect('admin/update/'.$id);

		}

		

	}

	

	public function category()

	{

		$this->data['sel']='Category';

		$this->data['result']=$this->admin_model->getData('category');

		$this->data['body'] = 'admin/category';	

		$this->load->view('structure', $this->data);

	}









	public function addItem()

	{

		$id = $_POST['hidden_id'];

		if($id!="")

		{

			unset($_POST['hidden_id']);

			$data = $this->admin_model->inserItem('admin_items',$id,$_POST);

		}

		else

		{

			unset($_POST['hidden_id']);

			$data = $this->admin_model->inserItem('admin_items',$id="",$_POST);

		}

		echo json_encode($data);

		

	}

	public function getEditData()

	{

		$id = $_POST['id'];

		$data = $this->admin_model->getCategoryData('category',$id);

		echo json_encode($data);

	}

	public function deleteItem()

	{

		$id = $_POST['id'];

		$data = $this->admin_model->deleteItem('admin_items',$id);

		echo json_encode($data);

	}

	public function cardPayment()

	{

		try {	

			include(APPPATH.'libraries/stripe-php-master/stripe-php-master/init.php'); // manually

			//require_once('vendor/autoload.php'); // using composer with lastest version

			\Stripe\Stripe::setApiKey('sk_test_htZuRrdkLDTjNGanHlkK8F1M ');

			$myCard = array('number' => '4242424242424241', 'exp_month' => 8, 'exp_year' => 2018);

			$charge = \Stripe\Charge::create(array('card' => $myCard, 'amount' => 60, 'currency' => 'usd'));

		}

		catch(Stripe_CardError $e) { echo "<h1 style='color:red;text-align:center'>".$e->getMessage()."</h1>"; }

		catch (Stripe_InvalidRequestError $e) {

			echo "<h1 style='color:red;text-align:center'>".$e->getMessage()."</h1>";

		} catch (Stripe_AuthenticationError $e) { echo "<h1 style='color:red;text-align:center'>".$e->getMessage()."</h1>";

		} catch (Stripe_ApiConnectionError $e) {  echo "<h1 style='color:red;text-align:center'>".$e->getMessage()."</h1>";

		} catch (Stripe_Error $e) {  			  echo "<h1 style='color:red;text-align:center'>".$e->getMessage()."</h1>";

		} catch (Exception $e) {				  echo "<h1 style='color:red;text-align:center'>".$e->getMessage()."</h1>";

		}

		echo "<pre>"; $response= $charge->__toArray(true);

		print_r($response);

	}

	

	public function checkout()

	{

		try {	

			require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you

			Stripe::setApiKey("YOUR_SECRET_KEY"); //Replace with your Secret Key

 

			$charge = Stripe_Charge::create(array(

				"amount" => 10000,

				"currency" => "usd",

				"card" => $_POST['stripeToken'],

				"description" => "Demo Transaction"

			));

			echo "<h1>Your payment has been completed.</h1>";	

		}

 

		catch(Stripe_CardError $e) {

 

		}

		catch (Stripe_InvalidRequestError $e) {

 

		} catch (Stripe_AuthenticationError $e) {

		} catch (Stripe_ApiConnectionError $e) {

		} catch (Stripe_Error $e) {

		} catch (Exception $e) {

		}

	}*/

	public function table($no,$i=1,$user_tree_array='')
	{
		if (!is_array($user_tree_array))
		$user_tree_array = array();
		if($i<=10)
		{
			$user_tree_array[$no." * ".$i] = $no*$i;
			$this->table($no,$i+1,$user_tree_array);
		}
		p($user_tree_array);
	}

	

	

}

	





?>