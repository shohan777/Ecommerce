<script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
<script type="text/JavaScript">
function reportsPrintAjax()
{

	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var printd = "print";
	//alert(fromdate);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/datewise_sale_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate,printdata:printd},
			   success: function(data) {
				 // alert("Successfully saved");
				 $("#reportPrintDisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
window.onload=reportsPrintAjax;
</script>
<style>
	body {
	  background: rgb(204,204,204); 
	}
	page {
	  background: white;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  min-height: 29.7cm; 
	  height: auto;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	   min-height: 29.7cm; 
	   height: auto; 
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
	  }
	}
	
	
	.printfontsize{
		font-size:18px;
		border-color:#000;
	}
</style>
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:5px;
	color:#000;
}
.summTable .theadline td, th{
	padding:5px;
	color:#fff;
	background:#333;
}
</style>
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
function update_status(id){
var status = document.getElementById("status").value;
window.location.href='<?php echo base_url();?>administration/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}
window.onload=print();
</script>
<page size="A4" layout="portrait">
	<div style="width:97%; height:auto;padding:0.5cm;">
        <div style="width:100%; height:auto">
            <div style="padding:0; margin:0; width:30%; float:left">
                <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo.png" alt="" style="width:100%; height:auto;" /></a>
            </div>
            <div style="width:40%; float:right; text-align:left; margin-left:30%;">
                <address style="width:85%; float:left">
                                            <h2><strong>PROJECT OFFICE</strong></h2>                                            
                                            <?php echo ucfirst($cadd);?><br />
                                            Contact : <?php echo $cmob;?><br />
                                            Email : <?php echo $cem;?><br />    
                                        </address>
            </div>
        </div>
        <div style="width:100%; height:auto">
        	<div  style="width:30%; float:left">
                <h2>Invoice Number # 01</h2>
                <h2>Order Number # 3471</h2>
            </div>
            <div style="width:40%; float:right; text-align:left; margin-left:30%;">
                <h2><strong>SOLD TO</strong></h2>
                <table width="98%" border="0" cellspacing="1" cellpadding="1">
                    <tr><td><?php echo $acc_name;?></td></tr>
                    <tr><td><?php echo $acc_email;?></td></tr>
                    <tr><td><?php echo $acc_contact;?></td></tr>
                </table>
            </div>
            
        </div>
        <div style="width:100%; height:auto">
         <table class="summTable" border="1">
          <tr class="theadline">
            <td align="center" bgcolor="#e5e5e5"class="table_header"><strong><span class="style2">SI</span></strong></td>
            <td align="center" bgcolor="#e5e5e5" class="table_header"><strong>Name</strong></td>
            <td align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product</strong></td>
            <td align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product Code</strong></td>
            <td align="center" bgcolor="#e5e5e5" class="table_header"><strong>Quantity</strong></td>
            <td align="center" bgcolor="#e5e5e5" class="table_header"><strong>Price</strong></td>
            <td align="center" bgcolor="#e5e5e5" class="table_header"><strong><span class="style2">Total Price</span></strong></td>
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
            <td height="44" align="center"><?php echo $i;?></td>
            <td align="center" class="section"><?php echo $product_name;?></td>
            <td align="center" class="section" style="width:4%; padding:5px">
           <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" width="100%" height="auto" style="margin:2px;" />
         </td>
          <td align="center" class="section"><?php echo $pro_code;?></td>
          <td align="center" class="section"><?php echo $qty;?></td>
            <td align="center" class="section"><?php echo $unit_price;?></td>
           <td align="center" class="section">TK&nbsp;<?php echo $sub_total;?></td>
           </tr>
          <?php
		  }
		  ?>
		  <tr><td colspan="7" align="center"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
		  <tr>
           <td height="44" colspan="2" align="center">&nbsp;</td>
           <td align="center" class="section">&nbsp;</td>
           <td align="center" class="section">&nbsp;</td>
           <td align="center" class="section">&nbsp;</td>
            <td align="center" colspan="2">
                <table width="100%" align="center">
                    <tr>
                        <td><span>Total Amount</span></td>
                        <td align="right"><span style="padding:0; margin:0">TK&nbsp;&nbsp;<?php echo number_format($grand_total);?></span></td>
                    </tr>
                    <tr>
                        <td><span>Paid Amount</span></td>
                        <td align="right"><span style="padding:0; margin:0">TK&nbsp;&nbsp;<?php echo number_format($paid_amount);?></span></td>
                    </tr>
                    <tr>
                        <td><span>Due Amount</span></td>
                        <td align="right"><span style="padding:0; margin:0">TK&nbsp;&nbsp;<?php echo number_format($due_amount);?></span></td>
                    </tr>
                </table>
            
            </td>
           </tr>
        </table>
        </div>
    </div>      
</page>        