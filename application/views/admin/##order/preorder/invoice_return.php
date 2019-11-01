<?php
   if($order_q->num_rows() > 0){
	  foreach($order_q->result() as $rowq);
	  $order_id=$rowq->order_id;
	  $order_number=$rowq->order_number;
	  $order_time=$rowq->order_time;
	  $customer_id=$rowq->customer_id;
	  $status=$rowq->status;
	  $total_price=$rowq->total_price;
  }
  else{
  	  $order_id='';
	  $order_number='';
	  $order_time='';
	  $customer_id='';
	  $status='';
	  $total_price='';
  }
  if($customerQ->num_rows() > 0){
	  foreach($customerQ->result() as $rowc);
	  $customer_id=$rowc->user_id;
	  $acc_email=$rowc->email;
	  $acc_contact=$rowc->mobile;
	  $acc_name=$rowc->firstname.''.$rowc->lastname;
  }
  else{
  	  $customer_id='';
	  $acc_email='';
	  $acc_contact='';
	  $acc_name='';
  }
  
   if($billing->num_rows() > 0){
	  foreach($billing->result() as $rowb);
	  $shipping_id=$rowb->id;
	  $bill_name=$rowb->fname.''.$rowb->lname;
	  $bill_address1=$rowb->address1;
	  $bill_address2=$rowb->address2;
	  $bill_contact=$rowb->mobile;
	  $bill_company=$rowb->company;
	  $bill_country=$rowb->country;
	  $bill_city=$rowb->city;
	  $bill_street=$rowb->street;
	  $bill_postcode=$rowb->postcode;
  }
  else{
  	  $shipping_id='';
	  $bill_name='';
	  $bill_address1='';
	  $bill_address2='';
	  $bill_contact='';
	  $bill_company='';
	  $bill_country='';
	  $bill_city='';
	  $bill_street='';
	  $bill_postcode='';
  }
  
   if($billing->num_rows() > 0){
	  foreach($shipping->result() as $rows);
	  $shipping_id=$rows->id;
	  $ship_name=$rows->fname.''.$rows->lname;
	  $ship_address1=$rows->address1;
	  $ship_address2=$rows->address2;
	  $ship_contact=$rows->mobile;
	  $ship_company=$rows->company;
	  $ship_country=$rows->country;
	  $ship_city=$rows->city;
	  $ship_street=$rows->street;
	  $ship_postcode=$rows->postcode;
  }
  else{
  	  $shipping_id='';
	  $ship_name='';
	  $ship_address1='';
	  $ship_address2='';
	  $ship_contact='';
	  $ship_company='';
	  $ship_country='';
	  $ship_city='';
	  $ship_street='';
	  $ship_postcode='';
  }
?>
<script type="text/javascript">
	function update_status(id) {
		var status = document.getElementById("status").value;
		window.location.href = '<?php echo base_url();?>administration/update_status?status=' + status + "&&id=" + id +
			"&&table=" + 'orders';
	}

</script>

<div class="right_col" role="main">
	<div class="row">










		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

				<div class="x_content">
					<div style="width:100%">
						<?php echo $this->session->flashdata('successMsg');?>
					</div>
					<div class="container">
						<div class="col-sm-12">
							<div class="col-sm-3" style="padding:0; margin:0">
								<a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo.png" alt="" style="width:40%; height:auto;" /></a>
							</div>
							<div class="col-sm-5 col-sm-offset-4">
								<address style="width:85%; float:left">
									<h4>PROJECT OFFICE</h4>

									EHL Kamalapur,Suite: 410, Motijheel,<br />
									PO Box-134, GPO, Dhaka-1 000.<br />
									Contact : +8801922002381<br />
									Email : info@evenyoungstar.com<br />

								</address>
								<a href="<?php echo base_url('administration/invoice_return/'.$inv_id.'/?status=print');?>" onclick="javascript:void window.open('<?php echo base_url('administration/invoice_return/'.$inv_id.'/?status=print');?>','','width=1200,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=100,top=30');return false;"><i
									 class="fa fa-print"></i> Print</a>
							</div>
						</div>
						<div class="col-sm-12">
							<h2>Invoice Number #
								<?php echo $inv_id;?>
							</h2>
							<h2>Order Number #
								<?php echo $order_number;?>
							</h2>
							<div class="col-sm-3">
								<h2>Sold To</h2>
								<table width="98%" border="0" cellspacing="1" cellpadding="1">
									<tr>
										<td>
											<?php echo $acc_name;?>
										</td>
									</tr>
									<tr>
										<td>
											<?php echo $acc_email;?>
										</td>
									</tr>
									<tr>
										<td>
											<?php echo $acc_contact;?>
										</td>
									</tr>
								</table>
							</div>
							<div class="col-sm-4 col-sm-offset-5">
								<h2>Billing Address</h2>
								<table width="100%" border="0" cellspacing="1" cellpadding="1">
									<tr>
										<td>
											<?php echo $bill_name;?>
										</td>
									</tr>
									<tr>
										<td>
											<?php echo $bill_address1;?>
										</td>
									</tr>
									<tr>
										<td>
											<?php echo $bill_country.' , '.$bill_city.' , '.$bill_street.' , '.$bill_postcode;?>
										</td>
									</tr>
									<tr>
										<td>
											<?php echo $bill_company;?>
										</td>
									</tr>
									<tr>
										<td>
											<?php echo $bill_contact;?>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div class="col-sm-12" style="margin-top:30px;">
							<table width="100%" cellpadding="2" cellspacing="1" class="table_round">

								<tr>
									<td width="211" height="33" align="center" bgcolor="#e5e5e5" class="table_header"><strong><span class="style2">Status</span></strong></td>
									<td width="432" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Name</strong></td>
									<td width="62" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product</strong></td>
									<td width="141" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product Code</strong></td>
									<td width="94" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Quantity</strong></td>
									<td width="128" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Price</strong></td>
									<td width="194" align="center" bgcolor="#e5e5e5" class="table_header"><strong><span class="style2">Total Price</span></strong></td>
								</tr>
								<?php
									  
									  $sql = "SELECT * FROM product WHERE product_id = ? ";
									  $order_pro=$this->db->query($sql,$return_product);
									  foreach($order_pro->result() as $rowpro);
									  $main_image=$rowpro->main_image;
									  $product_name=$rowpro->product_name;
									  $pro_code=$rowpro->pro_code;
									  
									  $pricesql = "SELECT (SUM(import_unit_cost)+SUM(packing_unit_cost)+SUM(sda_unit_cost)+SUM(delivery_unit_cost)
										+SUM(cashhandle_unit_cost)+SUM(officeexp_unit_cost)+SUM(profit_unit_cost)+SUM(customer_unit_cost)) 
										AS total FROM product_price WHERE product_id = ?";
										$fpricequery = $this->db->query($pricesql,$return_product);
										$product_price	= $fpricequery->row_array();
										$unit_price=$product_price['total'];
										$sub_total = $old_quantity*$unit_price;
										
										 //$grand_total=$grand_total+$sub_total;
								?>
								<tr class="table_hover">
									<td height="44" align="center">
										<h6>Returned Product</h6>
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $product_name;?>
										</h6>
									</td>
									<td align="center" class="section">
										<img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" width="100%"
										 height="auto" style="margin:2px;" />
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $pro_code;?>
										</h6>
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $old_quantity;?>
										</h6>
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $unit_price;?>
										</h6>
									</td>
									<td align="center" class="section">
										<h6>TK&nbsp;
											<?php echo $sub_total;?>
										</h6>
									</td>
								</tr>

								<?php
							  
							  $sqln = "SELECT * FROM product WHERE product_id = ? ";
							  $order_pron=$this->db->query($sqln,$new_pro);
							  foreach($order_pron->result() as $rowpron);
							  $main_imagen=$rowpron->main_image;
							  $product_namen=$rowpron->product_name;
							  $pro_coden=$rowpron->pro_code;
							  
							  $pricesqln = "SELECT (SUM(import_unit_cost)+SUM(packing_unit_cost)+SUM(sda_unit_cost)+SUM(delivery_unit_cost)
								+SUM(cashhandle_unit_cost)+SUM(officeexp_unit_cost)+SUM(profit_unit_cost)+SUM(customer_unit_cost)) 
								AS total FROM product_price WHERE product_id = ?";
								$fpricequeryn = $this->db->query($pricesqln,$new_pro);
								$product_pricen	= $fpricequeryn->row_array();
								$unit_pricen=$product_pricen['total'];
								$sub_totaln = $new_quantity*$unit_pricen;
								
								if($sub_totaln > $sub_total){
									$grand_total=$sub_totaln-$sub_total;
									$status = 'Payable';
								}
								elseif($sub_totaln < $sub_total){
									$grand_total=$sub_total-$sub_totaln;
									$status = 'Due';
								}
								else{
									$grand_total=0.0;
									$status = '--';
								}
								
								
								?>
								<tr bgcolor="#eee" style="opacity:0.5">
									<td height="44" align="center">
										<h6>New Product</h6>
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $product_namen;?>
										</h6>
									</td>
									<td align="center" class="section">
										<img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_imagen;?>" width="100%"
										 height="auto" style="margin:2px;" />
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $pro_coden;?>
										</h6>
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $new_quantity;?>
										</h6>
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $unit_pricen;?>
										</h6>
									</td>
									<td align="center" class="section">
										<h6>TK&nbsp;
											<?php echo $sub_totaln;?>
										</h6>
									</td>
								</tr>


								<tr>
									<td colspan="7" align="center">
										<div style="border-bottom:1px solid #CCCCCC"></div>
									</td>
								</tr>
								<tr>
									<td height="44" colspan="2" align="center">
										<h2><strong>Grand Total</strong></h2>
									</td>
									<td align="center" class="section">&nbsp;</td>
									<td align="center" class="section">&nbsp;</td>
									<td align="center" class="section">&nbsp;</td>
									<td align="center" class="section">&nbsp;</td>
									<td align="center">
										<h2><strong>TK&nbsp;&nbsp;
												<?php echo number_format($grand_total).' ( '.$status.')';?></strong></h2>
									</td>
								</tr>
							</table>
						</div>





					</div>
				</div>
			</div>
		</div>
	</div>
