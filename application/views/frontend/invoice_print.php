<html>
	<head>
    	<title>Invoice</title>
    	<style>
	body {
	  background: rgb(255,255,255); 
	}
	page {
	  background: #ccc;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  min-height: 29.7cm; 
	  height: auto;
	  background: #ccc;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	   min-height: 29.7cm; 
	   height: auto; 
	   background: #ccc;
	}
	page[size="A3"] {
	  width: 29.7cm;
	  height: 42cm;
	}
	page[size="A3"][layout="portrait"] {
	  width: 42cm;
	  height: 29.7cm;  
	}
	page[size="A5"] {
	  width: 14.8cm;
	  height: 21cm;
	}
	page[size="A5"][layout="portrait"] {
	  width: 21cm;
	  height: 14.8cm;  
	}
	@media print {
	  body, page {
		margin: 0;
		box-shadow: 0;
		background: #ccc;
	  }
	}
	
	
	.printfontsize{
		font-size:18px;
		border-color:#000;
	}

.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:2px;
	color:#000;
}
.summTable .theadline td, th{
	padding:3px;
	color:#000;
	font-weight:bold;
}
</style>
    
    </head>
    <body>
    	<?php
		   if($order_q->num_rows() > 0){
			  foreach($order_q->result() as $rowq);
			  $order_id=$rowq->order_id;
			  $order_number=$rowq->order_number;
			  $order_time=$rowq->order_time;
			  $customer_id=$rowq->customer_id;
			 
			  $pyaableamount=$rowq->amount;
			  $total_price=$rowq->total_price;
			  $shippingCharge=$rowq->shipping;
			  $paid_amount=$rowq->paid_amount;
			  $due_amount=$rowq->due_amount;
			  $payment_status=$rowq->payment_status;
			  $cupon_discount=$rowq->cupon_discount;
			  $product_discount=$rowq->product_discount;
		  }
		  else{
			  $order_id='';
			  $order_number='';
			  $order_time='';
			  $customer_id='';
			  $status='';
			  $pyaableamount ='';
			  $total_price='';
			  $shippingCharge = '';
			  $paid_amount='';
			  $due_amount='';
			  $payment_status='';
			  $cupon_discount='';
			  $product_discount='';
		  }
		  if($customerQ->num_rows() > 0){
			  foreach($customerQ->result() as $rowc);
			  $customer_id=$rowc->user_id;
			  $acc_email=$rowc->email;
			  $acc_contact=$rowc->mobile;
			  $acc_name=$rowc->username;
			  $acc_address=$rowc->address;
		  }
		  else{
			  $customer_id='';
			  $acc_email='';
			  $acc_contact='';
			  $acc_name='';
			  $acc_address = '';
		  }
		  
		  if($payment->num_rows() > 0){
			  $pRow = $payment->row_array();
			  $pay_method=$pRow['pay_method'];
			  $transition_id=$pRow['transition_id'];
			  $card_number=$pRow['card_number'];
			  $card_name=$pRow['card_name'];
			  $comment=$pRow['comment'];
		  }
		  else{
			  $pay_method='';
			  $transition_id='';
			  $card_name='';
			  $card_number='';
			  $comment='';
		  } 
		  
		?>
		<page size="A4" layout="portrait">
			<div style="width:97%; height:auto;padding:0.5cm;">
				<div style="width:100%; height:auto;display: flex;align-items: center;">
					<div style="padding:0; margin:0; width:30%; float:left">
						<a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo_site.png" alt="" style="width:100%; height:auto;" /></a>
					</div>
					<div style="width:40%; float:right; text-align:left; margin-left:30%;line-height: 23px;">
						<address style="width:85%; float:left">                                          
							<?php echo ucfirst($cadd);?><br />
							Contact : <?php echo $cmob;?><br />
							Email : <?php echo $cem;?><br />
                            <?php echo ($fbook) ? 'Facebook: <a href="'.$fbook.'">'.$fbook.'</a>' : '';?>
                            <?php echo ($twtr) ? 'Twitter: <a href="'.$twtr.'">'.$twtr.'</a>' : '';?>
						</address>
					</div>
				</div>
				<div style="width:100%; height:auto; margin:0 0 10px 0; float:left">
					<table class="summTable" border="0" width="100%" style="margin-top:20px; border-collapse:collapse">
					 <tr>
						<td width="79%" align="left"><h2 style="color:#FF0000; padding:0; margin:0">
						<?php echo $pay_method.', '.'BDT <strong>'.$total_price.'</strong> Tk';?></h2></td>
						<td width="21%" align="left"><h3 style="border:2px solid #666666; width:150px; text-align:center; padding:5px">
						<?php echo date('Y-m-d');?></h3></td>
					</tr>
				</table>
				</div>
				<div style="width:100%; height:auto; margin:10px 0 10px 0; float:left">
						<table width="100%" style="border-collapse:collapse" border="1">
							<tr>
								<td align="left">	
								  <table width="100%" border="1" class="summTable" style="border-collapse:collapse">      
										<tr>
											<td>Order Date</td>
											<td><?php echo $order_time;?></td>
										</tr>
										<tr>
											<td>Order No.</td>
											<td><?php echo $order_number;?></td>
										</tr>
										<tr>
											<td>Invoice No.</td>
											<td><?php echo $inv_id;?></td>
										</tr>
										<tr>
											<td>Payment Method</td>
											<td><?php echo $pay_method;?></td>
										</tr> 
										<?php if($transition_id!=""){?> 
										<tr>
											<td>Transaction ID</td>
											<td><?php echo $transition_id;?></td>
										</tr> 
										<?php } 
										if($card_name!=""){?> 
										<tr>
											<td>Card Name</td>
											<td><?php echo $card_name;?></td>
										</tr>
										<?php } 
										if($card_number!=""){?>   
										<tr>
											<td>Card Number</td>
											<td><?php echo $card_number;?></td>
										</tr> 
										<?php } ?>                               
										<tr>
										  <td valign="top">Total Amount</td>
											<td valign="top">
												<table width="100%" style=" border-collapse:collapse">
													<?php if($product_discount!="" || $product_discount!="0"){?>
													<!-- <tr>
														<td>Product Discount</td>
														<td align="right"><strong><?php //echo $product_discount;?></strong></td>
														<td>Tk</td>
													</tr> -->
													<?php } ?>
													<tr>
														<td>Product Cost</td>
														<td align="right"><strong><?php echo $pyaableamount;?></strong></td>
														<td>Tk</td>
													</tr>
													<?php if($shippingCharge!=""){?>
													<tr>
														<td>Shipping Charge</td>
														<td align="right"><strong><?php echo $shippingCharge;?></strong></td>
														<td>Tk</td>
													</tr>
													<?php } ?>
													<?php if($cupon_discount!="" || $cupon_discount!="0"){?>
													<tr>
														<td>Cuopn Discount </td>
														<td align="right"><strong><?php echo $cupon_discount;?></strong></td>
														<td>Tk</td>
													</tr>
													<?php } ?>
													<tr>
														<td>Total Amount</td>
														<td align="right"><strong><?php echo $total_price;?></strong></td>
														<td>Tk</td>
													</tr>
													<tr>
														<td>Paid Amount</td>
														<td align="right"><strong><?php echo $paid_amount;?></strong></td>
														<td>Tk</td>
													</tr>
													<tr>
														<td>Due Amount</td>
														<td align="right"><strong><?php echo $due_amount;?></strong></td>
														<td>Tk</td>
													</tr>
												</table>
												</td>
										</tr>
									   <tr>
											<td>Payment Status</td>
											<td><?php echo $payment_status;?></td>
									</tr>
								  </table>
								</td>
								<td align="center">	
									<address style="width:85%;">
										<h2><strong><?php echo $acc_name;?></strong></h2>                                            
										<?php echo ucfirst($acc_address);?><br />
										Contact : <?php echo $acc_contact;?><br />
										Email : <?php echo $acc_email;?><br />
									</address>
							  </td>
							</tr>
						</table>
				</div>
				<div style="width:100%; height:auto">
				 <table class="summTable" border="1" width="100%" style=" border-collapse:collapse">
				  <tr class="theadline">
					<td align="center">#</td>
					<td align="center">Name</td>
					<td align="center">Product Code</td>
					<td align="center">Quantity</td>
					<td align="center">Price</td>
					<td align="center">Total Price</td>
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
				  <tr bgcolor="<?php echo $c; ?>" >
					<td align="center"><?php echo $i;?></td>
					<td align="center"><?php echo $product_name;?></td>           
					  <td align="center"><?php echo $pro_code;?></td>
					  <td align="center"><?php echo $qty;?></td>
					 <td align="center"><?php echo '<strong>'.$unit_price.'</strong> Tk';?></td>
					<td align="center"><?php echo '<strong>'.$sub_total.'</strong> Tk';?></td>
				   </tr>
				  <?php
				  }
				  ?>
				</table>
				<table class="summTable" width="100%">
				   <tr>
						<td align="center">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="center">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="center">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="center">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="center">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="center">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right" style="border: 1px solid;"><strong>Shipping Charge:</strong></td>
						<td align="center" style="border: 1px solid;"><strong><?php echo '<strong>'.$shippingCharge.'</strong> Tk';?></strong></td>
				   </tr>
                   <tr>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="right" style="border: 1px solid;"><strong>Grand Total:</strong></td>
						<td align="center" style="border: 1px solid #000;color:#ff7600;"><strong><?php echo '<strong>'.$total_price.'</strong> Tk';?></strong></td>
				   </tr>
                   <tr>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="right" style="border: 1px solid;"><strong>Paid Amount:</strong></td>
						<td align="center" style="border: 1px solid #000;color:#3dab1a;"><strong><?php echo '<strong>'.$paid_amount.'</strong> Tk';?></strong></td>
				   </tr>
                   <tr>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="center">	&nbsp;</td>
						<td align="right" style="border: 1px solid;"><strong>Due:</strong></td>
						<td align="center" style="border: 1px solid #000;color:red;"><strong><?php echo '<strong>'.$due_amount.'</strong> Tk';?></strong></td>
				   </tr>
				</table>
				
				<table class="summTable" border="0" width="100%" style="margin-top:20px; border-collapse:collapse">
					 <tr>
						<td align="left"><h2 style="text-transform:uppercase;padding:0; margin:0">Received By:</h2></td>
					</tr>
					<tr>
						<td align="left"><h4 style="padding:0; margin:0">Name and Signiture:</h4></td>
					</tr>
				   
				</table>
					
					</td>
				   </tr>
				</table>
				</div>
			</div>      
		</page>     
    </body>
</html>
