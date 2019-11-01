 <?php
 if($order_q->num_rows() > 0){
	  foreach($order_q->result() as $rowq);
	  $order_id=$rowq->order_id;
	  $order_number=$rowq->order_number;
	  $order_time=$rowq->order_time;
	  $order_status=$rowq->status;
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
<style>
.noText {
    color: transparent;
    text-indent: -9999px;
    font-size: 0px;
    line-height: 16px; /* retains height */
	width:20px; height:20px; 
    border-radius:50%; border:none;
  }
</style>
<script type="text/javascript">
/*function update_status(id){
	var status = document.getElementById("status").value;
	window.location.href='<?php echo base_url();?>administration/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}*/


function update_status(id,orderid){
	var status = document.getElementById("status"+id).value;
	//alert(status);
	var confirmval = confirm("\t\t Are you sure ? \n You want to change delivery status ?");
	if(confirmval == true){
		window.location.href='<?php echo base_url();?>administration/update_status?status='+status+"&&id="+orderid+"&&table="+'orders';
	}
	else{
		return false;
	}
}
function showAdvence(){
	var e = document.getElementById("choseoption");
	var strUser = e.options[e.selectedIndex].value;
	//alert(strUser);
	if(strUser=='Advence'){
		document.getElementById("advencepayment").style.display='inline';
	}
	else{
		document.getElementById("advencepayment").style.display='none';
	}
}

function checkPay(){
	var total_price = document.getElementById("total_price").value;
	var paid_amount = document.getElementById("paid_amount").value;
	if(parseInt(paid_amount) > parseInt(total_price)){
		//alert("You can't pay more than Order Total price and not less than 10 Taka");
		document.getElementById("paid_amount").value='';
		document.getElementById("errormsg").innerHTML="You can't pay more than Order Total price and not less than 10 Taka";
		document.getElementById("errormsg").style.color="#dd5044";
		document.getElementById("paid_amount").focus();
		//return false;
	}
	else{
		document.getElementById("errormsg").innerHTML="Valid Data";
		document.getElementById("errormsg").style.color="#19a15f";
	}
}
</script>
<style>
.noText {
    color: transparent;
    text-indent: -9999px;
    font-size: 0px;
    line-height: 16px; /* retains height */
	width:20px; height:20px; 
    border-radius:50%; border:none;
  }
.black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: #333;
        z-index:10001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        position: fixed;
        top: 10%;
        left: 25%;
        width: 60%;
        height: 60%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: #ffffff;
		box-shadow:0px 0px 15px #999999;
        z-index:1000000;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }
	
</style>
<script type="text/javascript">
/*$(document).ready(function(){
	alert('dfd');
});*/
function loadContent(id,orderid)
{
	var status = document.getElementById("status"+id).value;
	
		$.ajax({
            type: "POST",
            url: "<?php echo base_url();?>administration/update_order_status",
            data: {'statusid':id,'orderid':orderid,'status':status},
            success: function(response){
				document.getElementById("orderlight").innerHTML=response;
				$("#orderlight").show('slow');
				$("#fade").show('slow');
            },
			error: function(){
				alert('error');
			}         
        });
}

function closeButton()
{
	$("#orderlight").hide('medium');
	$("#fade").hide('medium');
}

function orderListDispl(param)
{
	if(param=="partial"){
		document.getElementById("productList").style.display="inline";
		document.getElementById("returnType").value="partial";
	}
	else if(param=="full"){
		document.getElementById("productList").style.display="none";
		document.getElementById("returnType").value="fullorder";
	}
	
}


function checkProdId() {		
		//var subid = document.getElementById("allsubjectid"+sid);
		var checkedValues = $('input:checkbox[name=product_id]:checked').map(function() {
				return this.value;
			}).get();
		//alert(checkedValues);
		
		document.getElementById("returnProduct").value = checkedValues;
		/*txt=[];
		  for (i=0;i<subid.options.length;i++){
		   if (subid.options[i].selected){
			txt[txt.length]=subid.options[i].value;
		   }
		  }
		 document.getElementById("withextsub"+sid).value = txt;*/
	 
		
	}
	
 function updateOrdeStatus(){
   $("#LoadingImage").show();
   $("#loaderHide").hide();
   	  var oid = $("#oid").val();
	  var proid = $("#returnProduct").val();
	  var ordstatus = $("#status").val();
	  var returnType = $("#returnType").val();
	  var remval = $("#remarksval").val();

   	  var surl = '<?php echo base_url('administration/update_order_status_action');?>';
	  
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'orderid':oid,'product_id':proid,'status':ordstatus,'rettype':returnType,'remarks':remval},
        cache : false, 
        success: function(response) { 
          $("#LoadingImage").hide();
		  $("#loaderHide").show();
		  $('#popclose').trigger('click');
		  
		  $("#userstatus").html(response.jsonmsg);
		   $("#userstatus").css('color',response.color);
         // alert(response.apply); 
        }, 
        error: function (xhr, status) {  
          $("#LoadingImage").hide();
		  $("#loaderHide").show();
          alert('Unknown error ' + status); 
        }    
      });  
    }
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Order Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:right">
                                    <?php /*?><?php echo form_open('administration/new_invoice');?>
                                     <input type="hidden" name="order_id" value="<?php echo $order_id;?>" />
                                     <input type="hidden" name="orderNumber" value="<?php echo $order_number;?>" />
                                     <input type="hidden" name="cust_id" value="<?php echo $customer_id;?>" />
                                     <input type="hidden" name="ship_id" value="<?php echo $shipping_id;?>" />
                                     <select name="choseoption" id="choseoption" class="form-control" style="width:45%; float:left; margin-right:5px;" onchange="showAdvence();">
	                                    <option value="Post Payment" selected="selected">Post Payment</option>
                                     	<option value="Advence">Advence Payment</option>                                       
                                     </select>
                                     <input type="text"  name="advencepayment" id="advencepayment" class="form-control" 
                                     placeholder="Advence Payment" style="width:35%; float:left; margin-right:5px; display:none"  />
                                     <input type="submit" name="invoiceCreate" value="Get Invoice"class="btn btn-primary" />
                                    <?php echo form_close();?><?php */?>
                                    
                                    
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invoiceModal">Get Invoice</button>
                                    <div class="modal fade" id="invoiceModal">
                                    	<div class="modal-dialog" role="dialog">
                                        	<div class="modal-content">
                                            	<div class="modal-header">
                                                	<button type="button" class="close" data-dismiss="modal">&times;</button>
        											<h4 class="modal-title">Payment</h4>                                                     
                                                </div>
                                        		<div class="modal-body">
                                                	<div class="col-sm-12">
                                                     	<div class="col-sm-5"><label class="control-label" style="font-size:13px">Total Amount :</label></div>
                                                        <div class="col-sm-7"><?php echo $total_price;?></div>
                                                     </div>
                                                     <div class="col-sm-12">
                                                     	<div class="col-sm-5"><label class="control-label" style="font-size:13px">Paid Amount :</label></div>
                                                        <div class="col-sm-7"><?php echo $paid_amount;?></div>
                                                     </div>
                                                     <div class="col-sm-12">
                                                     	<div class="col-sm-5"><label class="control-label" style="font-size:13px">Due Amount :</label></div>
                                                        <div class="col-sm-7"><?php echo $due_amount;?></div>
                                                     </div>
                                                     <div class="col-sm-12">
                                                     	<div class="col-sm-5"><label class="control-label" style="font-size:13px">Payment Status :</label></div>
                                                        <div class="col-sm-7"><?php echo $payment_status;?></div>
                                                     </div>
                                                     
                                                	<?php echo form_open('administration/new_invoice');?>
                                                     
                                                     <div class="col-sm-12">
                                                     	<div class="col-sm-3"><label class="control-label" style="font-size:13px">Payment Type</label></div>
                                                        <div class="col-sm-7">
                                                          <select name="choseoption" id="choseoption" class="form-control" 
                                                          style="width:45%; padding:3px; margin-bottom:5px; float:left; margin-right:5px;" 
                                                          onchange="showAdvence();">
                                                            <option value="Post Payment" selected="selected">Post Payment</option>
                                                            <option value="Advence">Advence Payment</option>                                       
                                                         </select>
                                                        </div>
                                                        
                                                     </div>
                                                     <div class="col-sm-12" style="display:none" id="advencepayment">
                                                     	<div class="col-sm-3"><label class="control-label" style="font-size:13px">Pay Amount</label></div>
                                                        <div class="col-sm-9">
                                                        <input type="text" name="paid_amount" id="paid_amount" style="padding:3px;" onkeyup="checkPay()" onblur="checkPay();"  
                                                            class="form-control" placeholder="Paid Amount" />
                                     
                                                            <div id="errormsg" style="font-size:12px; padding:2px;"></div>
                                                        </div>                                                        
                                                     </div>
                                                     <div class="col-sm-12 pull-right">
                                                         <input type="hidden" name="total_price" id="total_price" value="<?php echo $total_price;?>" />
                                                         <input type="hidden" name="order_id" value="<?php echo $order_id;?>" />
                                                         <input type="hidden" name="orderNumber" value="<?php echo $order_number;?>" />
                                                         <input type="hidden" name="cust_id" value="<?php echo $customer_id;?>" />
                                                         <input type="hidden" name="ship_id" value="<?php echo $shipping_id;?>" />
                                                         <input type="submit" name="invoiceCreate" value="Get Invoice" class="btn btn-primary" />
                                                     </div>
													<?php echo form_close();?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('failedMsg');?></div>
                                <div class="container">
                                  <table width="100%" border="0" cellspacing="3" cellpadding="3">
                                      <tr>
                                        <td width="26%"><h3>Account Info</h3></td>
                                        <td width="2%">&nbsp;</td>
                                        <td width="33%"><h3>Billing Information</h3></td>
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
                                            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                              <tr>
                                                <td><?php echo $bill_name;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $bill_address1;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $bill_country.' , '.$bill_city.' , '.$bill_street.' , '.$bill_postcode;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $bill_company;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $bill_contact;?></td>
                                              </tr>
                                            </table>    </td>
                                        <td>&nbsp;</td>
                                        <td valign="top">
                                            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                              <tr>
                                                <td><?php echo $ship_name;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $ship_address1;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $ship_country.' , '.$ship_city;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $ship_company;?></td>
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
                                        <td colspan="6">
                                        	<table width="100%">
                                            	<tr>
                                       <!-- <td width="63%" height="26"><h3>Order Status</h3></td>
                                        <td width="5%">&nbsp;</td>-->
                                        <td width="32%"><h3>Payment Method</h3></td>
                                        </tr>
                                     			 <tr>
                                        
                                                <td align="left"><?php echo $pay_method;?></td>
                                        </tr>
                                            </table>
                                        </td>
                                      </tr> 
                                     
                                      <tr><td colspan="6"  height="5"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                      <tr><td colspan="6"  height="40" bgcolor="#FFFFFF"><h3 style="padding:0; margin:0">Order Details</h3></td></tr>
                                      <tr><td colspan="6"  height="5"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                      <tr>
                                        <td colspan="5" valign="top">
                                            
                                                    <table class="table datatable-show-all ordertable" width="100%">
                                    <tr bgcolor="#e5e5e5" class="trTitle">
                                      <td width="34" height="33" align="center">SI</td>
                                      <td width="58" align="center">Order </td>
                                      <td width="101" align="center">Order On</td>
                                      <td width="89" align="center">Supplier</td>
                                      <td width="56" align="center"> Code </td>
       	    				    <td width="882" align="center">
                           	   			
										  <?php
                                            $sql = 'SELECT * FROM order_status WHERE type = ? ORDER BY sequence ASC';
                                            $stmt = $this->db->query($sql, 'in_stock');
                                            foreach ($stmt->result() as $row) {												
                                        ?>
                                  <div style="width:6%; float:left; margin-right:1px; text-align:left; font-weight:bold; font-size:8px;"><?php echo $row->name;?></div>
                          <?php } ?>                       
                                      </td>
                                     <!-- <td width="10" align="center">Closed</td>-->
                                      <td width="23" align="center">&nbsp;</td>
                                    </tr>
                                    <?php
										
										
										if($order_status=='Closed'){
											$bgclose = '#19a15f';	
											$closetitle = 'Order Closed';
											$rowbg = '#aaaaaa';
											$opacity = 'style="opacity:0.5"';
											$rowtitle = 'Order Closed';		 
										}
										else{
											$bgclose = '#7A7A7A';
											$closetitle = 'Close Order';
											$rowbg = '#f5f5f5';	
											$opacity = 'style="opacity:1"';
											$rowtitle = '';
											$closesection ='';
										}
										
									?>
                                  
                                      <tr class="trCont" bgcolor="<?php echo $rowbg; ?>" <?php echo $opacity;?> title="<?php echo $rowtitle;?>">
                                      <td height="44">1</td>
                                      <td align="left"><?php echo $order_number;?></td>
                                      <td align="left"><?php echo $order_time;?></td>
                                    	<td colspan="3" style="padding:0; margin:0">
                                        	<table width="100%" align="center">
													<?php 
													$orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                                    foreach($orderProducts->result() as $ordPro){
														$ordproid = $ordPro->product_id;
														$ordQty = $ordPro->qty;
														
                                                        $sql = "SELECT * FROM product WHERE product_id = ?";
                                                        $prodcutlist = $this->db->query($sql,$ordproid);
                                                        foreach($prodcutlist->result() as $pro);
														
														if($pro->supplier!=""){
														 $sql = "SELECT * FROM supplier WHERE user_id = ?";
                                                         $supllierquer = $this->db->query($sql,$pro->supplier);
                                                         $suplier = $supllierquer->row_array();
														 $supname = $suplier['username'];
														}
														else{
															$supname = '';
														}
														
														$sqlu = "SELECT * FROM stock_order_product_status WHERE order_id = ? AND product_id = ?";
                                                        $orderstatusd = $this->db->query($sqlu,array($order_id,$ordproid));
														if($orderstatusd->num_rows() > 0){
                                                        	foreach($orderstatusd->result() as $ords);
															$status=$ords->status;
														}
														else{
															$status='Pending';
														}
                                                    ?>
                                                    <tr>
                                                    	<td width="10%" align="center"><div style="width:79px; float:left"><?php echo $supname;?></div></td>
                                                    	<td width="10%" align="center"><?php echo $pro->pro_code;?></td>
                                                        
                                                      <td width="80%">  
                                                        <?php
                                                             $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
                                                            
                                                            $matcharray = array("return","miss_delivery","damage_delivery");
                                                            $sql = 'SELECT * FROM order_status WHERE type = ?  ORDER BY sequence ASC';
                                                            $stmt = $this->db->query($sql, 'pre_stock');
                                                            foreach ($stmt->result() as $row) {
                                                            
                                                            $finalSt = explode(',',$status);
                                                            if(in_array($row->name, $finalSt)){
                                                                $bgcolor = $row->color;
                                                                
                                                                if(in_array($row->access_name, $matcharray)){
                                                                    $actionname = 'A';
                                                                    $titleval = 'Change action for '.$row->name;
                                                                    $cursor =  'cursor:pointer';
                                                                    $font =  'changeText';
                                                                }
                                                                else{
                                                                    $actionname = '';
                                                                    $titleval = $row->name;
                                                                    $cursor =  'cursor:default';
                                                                    $font =  'noText';
                                                                }
                                                                
                                                                //$saction = 'onclick="loadContent('.$row->id.','.$ordproid.','.$order_time.','.$order_id.')"';	
                                                                $ordt = "'".$order_time."'";
																
																if($order_status=='Closed'){
																	$clssect = '';
																}
																else{
																	 $clssect = 'onclick="loadContent('.$row->id.','.$order_id.','.$ordproid.','.$ordt.','.$ordQty.')"';
																}										
                                                                $saction = $clssect;													
                                                            }
                                                            else{
                                                                $bgcolor = $row->default_color;
                                                                $font =  'noText';
                                                                $cursor =  'cursor:pointer';
                                                                $actionname = $row->name;
                                                                $titleval = $row->name;
                                                                
                                                                if(($this->session->userdata('AdminType')!="Precident") && ($this->session->userdata('AdminType')!="CEO") && 
                                                                 ($this->session->userdata('AdminType')!="Country Manager")){
                                                                    
                                                                    if(in_array($row->access_name, $userAccess)){
																		if($order_status=='Closed'){
																			$clssect1 = '';
																		}
																		else{
																			 $clssect1 = 'onclick="updateOrdeStatus('.$row->id.','.$ordproid.','.$ordQty.','.$order_id.')"';
																		}										
																		$saction = $clssect1;
                                                                    }
                                                                    else{
                                                                        $saction = '';
                                                                    }
                                                                }
                                                                else{
																	if($order_status=='Closed'){
																		$clssect2 = '';
																	}
																	else{
																		 $clssect2 = 'onclick="updateOrdeStatus('.$row->id.','.$ordproid.','.$ordQty.','.$order_id.')"';
																	}										
                                                                	$saction = $clssect2;
                                                                }
                                                            }
                                                ?>
                                                    <div style="width:6%; float:left;margin-right:1px; cursor:default">
                                                     <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                     style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" <?php echo $saction; ?> 
                                                     value="<?php echo $actionname;?>" name="status" id="status<?php echo $row->id;?>">
                                                </div>
                                                <?php } ?> 
                                                </td>
                                       		  </tr>
                                                    <?php
                                                     }
													
                                                    ?>
                                                    
                                                </table>
                                        </td>
                                      
                                        <td align="left" style="padding:5px 0; margin:5px 0">
                                        <div style="width:100%; float:left;">
                                         <input type="button" class="noText" title="Closed Order" value="Closed" name="closedstatus" id="closedstatus" 
                                         style="width:80%; margin-right:5px; float:left;background:<?php echo $bgclose;?>;" onclick="updateClosedOrder(<?php echo $order_id;?>);">
                                        
                                      </div>
                                       </td>
                                    </tr>
                                   
                                  </table> 
                                				    <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
                                              
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
                                              <tr><td colspan="7"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                                    <tr>
                                                        <td height="44" colspan="2" align="left"><h2><strong>Grand Total</strong></h2></td>
                                                         <td align="left" class="section">&nbsp;</td>
                                                        <td align="center" class="section">&nbsp;</td>
                                                        <td align="left" class="section">&nbsp;</td>
                                                         <td align="left" class="section">&nbsp;</td>
                                                        <td align="right"><h2><strong>TK&nbsp;&nbsp;<?php echo number_format($grand_total);?></strong></h2></td>
                                                        </tr>
                                                    </table> 
                                        </td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
               