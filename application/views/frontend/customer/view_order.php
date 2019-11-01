 <?php
  foreach($order_q->result() as $rowq);
  if($order_q->num_rows() > 0){
	  $order_id=$rowq->order_id;
	  $order_number=$rowq->order_number;
	  $order_time=$rowq->order_time;
	  $customer_id=$rowq->customer_id;
	  $status=$rowq->status;
	  $totamount=$rowq->amount;
	  $shipval=$rowq->shipping;
	  $total_price=$rowq->total_price;
	  $paid_amount=$rowq->paid_amount;
	  $due_amount = $total_price - $paid_amount;
	  $payment_status=$rowq->payment_status;
  }
  else{
  	 $order_id='';
	  $order_number='';
	  $order_time='';
	  $customer_id='';
	  $status='';
	  $total_price='';
	  $totamount='';
	  $shipval='';
	  $paid_amount='';
	  $due_amount ='';
	  $payment_status='';
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
  	  $customer_id = '';
	  $acc_email = '';
	  $acc_contact = '';
	  $acc_name = '';
	  $acc_address = '';
  }
  
  if($shipping->num_rows() > 0){
	  foreach($shipping->result() as $rows);
	  $shipping_id=$rows->id;
	  $ship_name=$rows->fname.' '.$rows->lname;
	  $ship_address=$rows->address1;
	  $ship_address2=$rows->address2;
	  $ship_contact=$rows->mobile;
	  $ship_locality=$rows->postcode;
	  $ship_city=$rows->city;
  }
  else{
  	  $shipping_id = '';
	  $ship_name = '';
	  $ship_address = '';
	  $ship_address2 = '';
	  $ship_contact = '';
	  $ship_locality = '';
	  $ship_city = '';
  }
  if($payment->num_rows() > 0){
	  foreach($payment->result() as $rowp);  
	  $pay_method=$rowp->pay_method;
	  $payId=$rowp->pay_id;
  }
  else{
	  $pay_method="";
	 }
?>
<style>
.customtable{
}
.customtable th{
	background:#666;
	color:#fff;
	text-align:center;
	font-size:13px;
}
.customtable td{
	color:#000;
	text-align:center;
	font-size:12px;
	font-weight:bold;
}
</style>
<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
	<div class="container" style="margin:20px auto;">
        <div class="col-sm-3">
            <?php include("leftSidebar.php");?>
        </div>
        <div class="col-sm-9" style="padding:0; margin:0"> 
            <a href="javascript:void(0)" onclick="history.back(-1)" style="padding:10px; width:100%; float:left; text-align:right"> &laquo;&laquo; Back</a>
            <table width="100%" border="0" cellspacing="3" cellpadding="3">
                  <tr>
                    <td width="26%"><h3>Account Info</h3></td>
                    <td width="2%">&nbsp;</td>
                    <td width="33%"><h3>Customer Information</h3></td>
                    <td width="2%">&nbsp;</td>
                    <td width="36%"><h3>Shipping Address</h3></td>
                    <td width="1%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="43" valign="top">
                        <table width="98%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td><?php echo $acc_name;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $acc_email;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $acc_contact;?></td>
                          </tr>
                        </table>    </td>
                    <td>&nbsp;</td>
                    <td valign="top">
                        <table width="98%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td><?php echo $acc_name;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $acc_address;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $acc_email;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $acc_contact;?></td>
                          </tr>
                        </table>    </td>
                    <td>&nbsp;</td>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td><?php echo $ship_name;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $ship_address;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $ship_address2;?></td>
                          </tr>
                          <tr>
                            <td><?php echo $ship_city.''.$ship_locality;?></td>
                          </tr>
                          
                          <tr>
                            <td><?php echo $ship_contact;?></td>
                          </tr>
                        </table>    </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6">&nbsp;</td>
                  </tr> 
                  <tr>
                    <td><h3>Order Status</h3></td>
                    <td>&nbsp;</td>
                    <td><h3>Payment Method</h3></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top"><?php echo $status;?></td>
                    <td>&nbsp;</td>
                    <td valign="top">
                        <table width="99%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td><?php echo $pay_method;?></td>
                          </tr>
                           
                        </table>    </td>
                    <td>&nbsp;</td>
                    <td valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr><td colspan="6"  height="5"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                  <tr><td colspan="6"  height="40" bgcolor="#FFFFFF"><h3 style="padding:0; margin:0">Order Details</h3></td></tr>
                  <tr><td colspan="6"  height="5"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                  <tr>
                    <td colspan="5" valign="top">
                        <?php /*?><table width="100%" cellpadding="2" cellspacing="1" class="table_round">
                          
                          <tr>
                            <td width="34" height="36" align="center" bgcolor="#e5e5e5"class="table_header"><span class="style2">SI</span></td>
                            <td width="183" align="center" bgcolor="#e5e5e5" class="table_header">Name</td>
                            <td width="103" align="center" bgcolor="#e5e5e5" class="table_header">Product</td>
                            <td width="109" align="center" bgcolor="#e5e5e5" class="table_header">Product Code</td>
                            <td width="180" align="center" bgcolor="#e5e5e5" class="table_header">Quantity</td>
                            <td width="159" align="center" bgcolor="#e5e5e5" class="table_header">Price</td>
                            <td width="126" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Total Price</span></td>
                            </tr>
                          <?php
                   $i=0;
                   //$grand_total=0;
                 
                  
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
                      //$grand_total=$grand_total+$sub_total;
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
                         <tr class="table_hover" bgcolor="<?php echo $c; ?>" >
                            <td height="44" align="center"><h6><?php echo $i;?></h6></td>
                            <td align="left" class="section"><h6><?php echo $product_name;?></h6></td>
                            <td align="left" class="section">
                           <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" width="80" height="100" />
                            </td>
                            <td align="left" class="section"><h6><?php echo $pro_code;?></h6></td>
                            <td align="center" class="section"><h6><?php echo $qty;?></h6></td>
                            <td align="left" class="section"><h6><?php echo $unit_price;?></h6></td>
                            <td align="center" class="section"><h6>TK&nbsp;<?php echo $sub_total;?></h6></td>
                            </tr>
                          <?php
                  }
                  ?>
                  <tr>
                        <td colspan="7"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                            <tr>
                            <td colspan="7">
                                <table width="100%" align="right">
                                    <tr>
                                        <td width="86%" align="right"><h2><strong>Total</strong></h2></td>
                                        <td width="14%" align="right"><h2><strong>TK&nbsp;&nbsp;<?php echo number_format($totamount);?></strong></h2></td>
                                    </tr>
                                    <tr>
                                        <td width="86%" align="right"><h2><strong>Shipping</strong></h2></td>
                                        <td width="14%" align="right"><h2><strong>TK&nbsp;&nbsp;<?php echo number_format($shipval);?></strong></h2></td>
                                    </tr>
                                    <tr>
                                        <td width="86%" align="right"><h2><strong>Grand Total</strong></h2></td>
                                        <td width="14%" align="right"><h2><strong>TK&nbsp;&nbsp;<?php echo number_format($total_price);?></strong></h2></td>
                                    </tr>
                                </table>
                            </td>
                            </tr>
                            
                        </table><?php */?> 
                        
                        <?php
                          $i=0;
                          $grand_total=0;                                                  
                          $order_q=$this->db->query("select * from orders_products where order_id ='".$order_id."'");
                          if($order_q->num_rows() > 0){
                          ?>
                            <table width="100%" cellpadding="2" cellspacing="1"  class="customtable">
                              <tr class="theadline">
                                <th width="56" height="36">SI</th>
                                <th width="272" align="center">Name</th>
                                <th width="127" align="center">Category</th>
                                <th width="126" align="center">Image</th>
                                <th width="121" align="center"> Code</th>
                                <th width="112" align="center"> Size</th>
                                <th width="158" align="center">Quantity</th>
                                <th width="125" align="center">Price</th>
                                <th width="143" align="center">Total Price</th>
                              </tr>
                          <input type="hidden" value="<?php echo $order_id;?>" id="orderid" />
                          <?php                                                  
                          foreach($order_q->result() as $rowq){
                          $opid=$rowq->id;
                          $order_id=$rowq->order_id;
                          $product_id=$rowq->product_id;
                          $qty=$rowq->qty;
                          $unit_price=$rowq->unit_price;
                          $sub_total=$rowq->total_price;
                          
                          $order_pro=$this->db->query("select * from product where product_id ='".$product_id."'");
                          foreach($order_pro->result() as $rowpro);
                             if($order_pro->num_rows() > 0){
                                  $main_image=$rowpro->main_image;
                                  $product_name=$rowpro->product_name;
                                  $cat_id=$rowpro->cat_id;
                                  $size=$rowpro->size;
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
                                 <tr bgcolor="<?php echo $c; ?>" style="border-bottom:1px solid #ccc; font-size:13px;">
                                    <td height="44" align="center"><h6><?php echo $i;?></h6></td>
                                    <td align="center" ><h6><?php echo $product_name;?></h6></td>
                                    <td align="center" ><h6><?php echo $cat_id;?></h6></td>
                                     <td align="center" >
                                           <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" 
                                           style="width:80px; height:50px; margin:5px; border:1px solid #333" />                                            </td>
                                      <td align="center" ><h6><?php echo $pro_code;?></h6></td>
                                      <td align="center" ><h6><?php echo $size;?></h6></td>
                                      <td align="right" >
                                         <input type="number"  value="<?php echo $qty;?>" id="changeQty<?php echo $opid;?>"
                                         style="width:60px; height:auto; padding:3px; float:left; font-size:14px; border:1px solid #999; text-align:center;" />                                            </td>
                                   <!-- <td align="center" ><h6><strong><?php //echo $unit_price;?></strong></h6></td>-->
                                    
                                    <td align="right" >
                                            <input type="hidden" value="<?php echo $product_id;?>" id="prodid<?php echo $opid;?>" />
                                         <input type="text"  value="<?php echo $unit_price;?>" id="changePrice<?php echo $opid;?>"
                                         style="width:60px; height:auto; padding:3px; float:left; font-size:14px; border:1px solid #999; text-align:center;" />
                                        <button type="button" onclick="updateOrdeStatus('<?php echo $opid;?>');" class="btn btn-primary" 
                                        style="width:30px; height:auto; float:left; padding:5px; font-size:12px;"><i class="fa fa-refresh"></i></button>                                            </td>
                                    
                                   <td align="center" ><h6><strong><?php echo $sub_total;?></strong></h6></td>
                                    </tr>
                                  <?php
                                  }
                                }
                                 ?>
                             <tr><td colspan="9"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                <tr>
                                    <td height="44" colspan="4" align="left"><h2><strong>Grand Total</strong></h2></td>
                                    <td align="left" >&nbsp;</td>
                                    <td align="center" >&nbsp;</td>
                                    <td align="left" >&nbsp;</td>
                                    <td align="left" >&nbsp;</td>
                                    <td align="right"><h2><strong>TK&nbsp;&nbsp;<?php echo number_format($grand_total);?></strong></h2></td>
                                    </tr>
                                </table>   
                          <?php } ?>
                        </td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
        </div>
	</div>
</div>
