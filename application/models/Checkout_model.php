<?php
Class checkout_model extends CI_Model
{
	
	function login($email, $password)
	{
		$this -> db -> select('*');
		$this -> db -> from('checkout');
		$this -> db -> where('email = ' . "'" . $email . "'"); 
		$this -> db -> where('password = ' . "'" . $password . "'"); 
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		return $query->result();

	}
	
	function get_logo_update($id)
	{
		/*$this->db
			 ->where('id', $id);
			  $result	= $this->db->get('logo');
			  $result	= $result->result();
			  return $result;*/
		$query = $this
				->db
				->select('*')
				->where('logo_id', $id)
				->limit(1)
				->get('logo');
		$row = $query->row_array();		
		return $row;
	}
	
	
	function product_insert($productId,$size,$shipment,$check_id,$product_id,$qty,$unit_price,$total_price,$date)
	{
			$array=explode(',', $productId);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
		$queryIn="insert into check_product_info values('','".$check_id."','".$product_id[$i]."','".$qty[$i]."','".$size[$i]."','".$shipment[$i]."','".$unit_price[$i]."','".$total_price[$i]."','".$date."')";
				mysql_query($queryIn);
			}
	}
	
	
	
	function save($orderId,$productId,$color,$size,$check_id,$product_id,$qty,$unit_price,$total_price,$custom_order_text,$custom_order_images,$date, $bonus_id=null)
	{
			$array=explode(',', $productId);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
			if(isset($product_id[$i]) && ($product_id[$i]!='' || $product_id[$i]!=0)){
				/*$this->db->query("insert into check_product_info values('','".$check_id."','".$product_id[$i]."','".$qty[$i]."','','".$shipment[$i]."',
				'".$unit_price[$i]."','".$total_price[$i]."','".$date."')");*/
					
				$queryIn=$this->db->query("insert into orders_products values('','".$orderId."','".$product_id[$i]."','".$qty[$i]."',
				'".$color[$i]. "','" . $bonus_id[$i] . "','".$size[$i]."','".$unit_price[$i]."','".$total_price[$i]."','".$custom_order_text[$i]."','".$custom_order_images[$i]."','".$date. "')");
				
				//$querySt=$this->db->query("insert into stock_order_product_status values('','".$orderId."','".$product_id[$i]."','Pending','','','".$date."')");
		}
		
			$sqlstock = "SELECT * FROM stock WHERE pro_id = ?";
			$queryInv = $this->db->query($sqlstock,array($product_id[$i]));
			if($queryInv->num_rows() > 0){
				foreach($queryInv->result() as $invData);
				$invPro = $invData->pro_id;
				$invQty = $invData->pro_qty;
				if($invQty > 1){
					$updateQty = $invQty - $qty[$i];
				}
				else{
					$updateQty = 0;
				}
				$this->db->query("UPDATE stock SET pro_qty = '".$updateQty."' WHERE pro_id='".$invPro."'");
			}
			
		}
	}
}
