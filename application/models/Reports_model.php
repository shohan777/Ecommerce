<?php
Class Reports_model extends CI_Model
{


	public function Add_User($data_user){
		$this->db->insert('product', $data_user);
   }
   
	///////////////// Reprots ////////////////////////
	function productFiltering($cat_id){
	  if($cat_id!=""){
		  $this->db->where('cat_id', $cat_id);
	  }
	  $this->db->order_by('product_id','asc');
	  $query = $this->db->get('product');
	  return $query;
  }
  
  function ordersFiltering($cat_id){
	  if($cat_id!=""){
		  $this->db->where('cat_id', $cat_id);
	  }
	  $this->db->order_by('order_id','asc');
	  $query = $this->db->get('orders');
	  return $query;
  }
  
   function customerFiltering($name,$email,$mobile){
	  if($name!=""){
		  $this->db->like('firstname', $name);
		  $this->db->or_like('lastname', $name);
	  }
	   if($email!=""){
		  $this->db->like('email', $email);
	  }
	   if($mobile!=""){
		  $this->db->like('mobile', $mobile);
	  }
	  $this->db->order_by('user_id','asc');
	  $query = $this->db->get('customer');
	  return $query;
  }

   function stockFiltering($from_date,$to_date){
	  if($from_date!="" && $to_date!=""){
		  $this->db->where('entry_date >=', $from_date);
		  $this->db->where('entry_date <=', $to_date);
	  }
	  elseif($from_date!="" && $to_date==""){
		  $this->db->where('entry_date', $from_date);
	  }
	  elseif($from_date=="" && $to_date!=""){
		  $this->db->where('entry_date', $to_date);
	  }
	  $this->db->order_by('product_id','asc');
	  $query = $this->db->get('product');
	  return $query;
  }
  
}

?>