<?php
   if($order_q->num_rows() > 0){
	  foreach($order_q->result() as $rowq);
	  $order_id=$rowq->order_id;
	  $order_number=$rowq->order_number;
	  $order_time=$rowq->order_time;
	  $customer_id=$rowq->customer_id;
	  $status=$rowq->status;
	  $total_price=$rowq->total_price;
	  $paid_amount=$rowq->paid_amount;
	  $due_amount=$rowq->due_amount;
	  $payment_status=$rowq->payment_status;
  }
  else{
  	  $order_id='';
	  $order_number='';
	  $order_time='';
	  $customer_id='';
	  $status='';
	   $total_price='';
	  $paid_amount='';
	  $due_amount='';
	  $payment_status='';
  }
  if($customerQ->num_rows() > 0){
	  foreach($customerQ->result() as $rowc);
	  $customer_id=$rowc->user_id;
	  $acc_email=$rowc->email;
	  $acc_contact=$rowc->mobile;
	  $acc_name=$rowc->username;
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
								<a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo.png" alt="" style="width:100%; height:auto;" /></a>
							</div>
							<div class="col-sm-5 col-sm-offset-4">
								<address style="width:85%; float:left">
									<h2><strong>PROJECT OFFICE</strong></h2>
									<?php echo ucfirst($cadd);?><br />
									Contact :
									<?php echo $cmob;?><br />
									Email :
									<?php echo $cem;?><br />
								</address>
								<a href="<?php echo base_url('administration/invoice/'.$inv_id.'/?status=print');?>" onclick="javascript:void window.open('<?php echo base_url('administration/invoice/'.$inv_id.'/?status=print');?>','','width=1200,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=100,top=30');return false;"><i
									 class="fa fa-print"></i> Print</a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-3" style="padding:0; margin:0">
								<h2>Invoice Number #
									<?php echo $inv_id;?>
								</h2>
								<h2>Order Number #
									<?php echo $order_number;?>
								</h2>
							</div>
							<div class="col-sm-5 col-sm-offset-4">
								<h2><strong>SOLD TO</strong></h2>
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
						</div>

						<div class="col-sm-12" style="margin-top:30px;">
							<table width="100%" cellpadding="2" cellspacing="1" class="table_round">

								<tr>
									<td width="34" height="32" align="center" bgcolor="#e5e5e5" class="table_header"><strong><span class="style2">SI</span></strong></td>
									<td width="183" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Name</strong></td>
									<td width="103" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product</strong></td>
									<td width="109" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product Code</strong></td>
									<td width="180" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Quantity</strong></td>
									<td width="159" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Price</strong></td>
									<td width="126" align="center" bgcolor="#e5e5e5" class="table_header"><strong><span class="style2">Total Price</span></strong></td>
								</tr>
								<?php
                           $i=0;
                           $grand_total=0;
                         
                          
                          $order_q=$this->db->query("select * from orders_products where order_id ='".$order_id."'");
                          foreach($order_q->result() as $rowq){
                          $order_id=$rowq->order_id;
                          $product_id=$rowq->product_id;
                          $qty=$rowq->qty;
                          $unit_price=$rowq->unit_price;
                          $sub_total=$rowq->total_price;
                          
                              $order_pro=$this->db->query("select * from product where product_id ='".$product_id."'");
                              foreach($order_pro->result() as $rowpro);
                              $main_image=$rowpro->main_image;
                              $product_name=$rowpro->product_name;
                              $pro_code=$rowpro->pro_code;
                              $grand_total=$grand_total+$sub_total;
                            if($i%2!=0)
                            {
                            $c="#f5f5f5";
                            }
                            else
                            {
                            $c="#FFFFFF";
                            }
                            $i++;
                            ?>
								<tr class="table_hover" bgcolor="<?php echo $c; ?>">
									<td height="44" align="center">
										<h6>
											<?php echo $i;?>
										</h6>
									</td>
									<td align="center" class="section">
										<h6>
											<?php echo $product_name;?>
										</h6>
									</td>
									<td align="center" class="section" style="width:4%; padding:5px">
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
											<?php echo $qty;?>
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
                          }
                          ?>
								<tr>
									<td colspan="7" align="center">
										<div style="border-bottom:1px solid #CCCCCC"></div>
									</td>
								</tr>
								<tr>
									<td height="44" colspan="2" align="center">&nbsp;</td>
									<td align="center" class="section">&nbsp;</td>
									<td align="center" class="section">&nbsp;</td>
									<td align="center" class="section">&nbsp;</td>
									<td align="center" colspan="2">
										<table width="100%" align="center">
											<tr>
												<td>
													<h2 style="padding:0; margin:0">Total Amount</h2>
												</td>
												<td align="right">
													<h2 style="padding:0; margin:0">TK&nbsp;&nbsp;
														<?php echo $grand_total;?>
													</h2>
												</td>
											</tr>
											<tr>
												<td>
													<h2 style="padding:0; margin:0">Paid Amount</h2>
												</td>
												<td align="right">
													<h2 style="padding:0; margin:0">TK&nbsp;&nbsp;
														<?php echo $paid_amount;?>
													</h2>
												</td>
											</tr>
											<tr>
												<td>
													<h2 style="padding:0; margin:0">Due Amount</h2>
												</td>
												<td align="right">
													<h2 style="padding:0; margin:0">TK&nbsp;&nbsp;
														<?php echo $due_amount;?>
													</h2>
												</td>
											</tr>
										</table>

									</td>
								</tr>
							</table>
						</div>





					</div>
				</div>
			</div>
		</div>
	</div>
