<style>
.noText {
	color: transparent;
	text-indent: -9999px;
	font-size: 0px;
    line-height: 16px; /* retains height */
	width:20px; height:20px; 
    border-radius:50%; border:none;
  }
.changeText {
	color: #fff;
	font-size: 12px;
    line-height: 16px;
	text-align:center;
	font-weight:bold;
	width:20px; 
	height:20px; 
    border-radius:50%; 
	border:none;
  }
  
.ordertable{
	width:100%;
	height:auto;
	border:1px solid #ccc;
	border-collapse:collapse;
}	
.ordertable .trTitle{
	background:#010101;
	
	/*box-shadow:#666 0 0 1px 1px;*/
	
}
.ordertable .trTitle td{
	padding:5px 10px;
	color:#fff;
	overflow:hidden;
	border:none;
	text-align:center;
}

.ordertable .trCont{
	border-bottom:1px solid #ccc;
}
.ordertable .trCont td{
	padding:5px 10px;
	overflow:hidden;
	border:none;
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


function updateOrdeStatus(id,proid,qty,oid){
	  var confirmval = confirm("\t\t Are you sure ? \n You want to change delivery status ?");
		if(confirmval == true){
				var ordstatus = $("#status"+id).val();

			  var surl = '<?php echo base_url('administration/update_order_status_action');?>';
			  //alert(qty);
			  $.ajax({ 
				type: "POST", 
				dataType: "json",
				url: surl,  
				data:{'orderid':oid,'product_id':proid,'status':ordstatus,'quantity':qty},
				cache : false, 
				success: function(response) { 
				  //$("#LoadingImage").hide();
				  //$("#loaderHide").show();
				  
				  $("#userstatus").html(response.jsonmsg);
				   $("#userstatus").css('color',response.color);
				   window.location.reload();
				 // alert(response.apply); 
				}, 
				error: function (xhr, status) {  
				 // $("#LoadingImage").hide();
				  //$("#loaderHide").show();
				  alert('Unknown error ' + status); 
				}    
			  });  
		}
		else{
			return false;
		}
	  
    }
	
	
function loadContent(id,oid,proid,ordtime,oqty)
{
		var ordstatus = $("#status"+id).val();
		//alert(ordtime);
		$.ajax({
            type: "POST",
            url: "<?php echo base_url();?>administration/update_order_status",
			data:{'orderid':oid,'product_id':proid,'status':ordstatus,'orderdate':ordtime,'quantity':oqty},
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
	//alert(param);
	document.getElementById("back_type").value=param;
	if(param =="returnpay"){
		document.getElementById("submitbtn").style.display="inline";
		document.getElementById("retamount").style.display="inline";
		document.getElementById("productList").style.display="none";
	}
	else if(param=="orderplace"){
		document.getElementById("submitbtn").style.display="inline";
		document.getElementById("productList").style.display="inline";
		document.getElementById("retamount").style.display="none";
	}
}


function changeproduct(productid)
{
	//alert(productid);
	$.ajax({
            type: "POST",
            url: "<?php echo base_url();?>administration/getProductInfo",
			dataType: "json",
			data:{'product_id':productid},
			cache : false, 
            success: function(response){
				//alert(response.p_code);
				$("#proimg").html(response.p_image);
				$("#procode").val(response.p_code);
				$("#proprice").val(response.p_rice);
				$("#colorsize").html(response.colorsize);
            },
			error: function(){
				alert('error');
			}         
        });
}


function updateNewOrder(){
   $("#LoadingImage").show();
   $("#loaderHide").hide();
   
   	  var bktype = $("#back_type").val();
	  var oid = $("#oid").val();
	  var proid = $("#ordproid").val();
	  var newproid = $("#newproid").val();
	  var ordstatus = $("#ordstatus").val();
	  var orderdate = $("#orderdate").val();
	  var retamount = $("#retamount").val();
	  var oldqty = $("#oldqty").val();
	  var newqty = $("#newqty").val();

   	  var surl = '<?php echo base_url('administration/update_new_order');?>';
	  
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'back_type':bktype,'orderid':oid,'oldpro':proid,'newpro':newproid,'oldqty':oldqty,'newqty':newqty,'status':ordstatus,'orderdate':orderdate,'retamount':retamount},
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



function updateClosedOrder(id){
	  var confirmval = confirm("\t\t Are you sure ? \n You want to Closed this Order ?");
		if(confirmval == true){
				var ordstatus = $("#closedstatus").val();
				//alert(id);
			  var surl = '<?php echo base_url('administration/update_closed_order');?>';
			  $.ajax({ 
				type: "POST", 
				dataType: "json",
				url: surl,  
				data:{'orderid':id,'ordstatus':ordstatus},
				cache : false, 
				success: function(response) { 
				  
				  $("#userstatus").html(response.jsonmsg);
				  $("#userstatus").css('color',response.color);
				   window.location.reload();
				}, 
				error: function (xhr, status) {  
				  alert('Unknown error ' + status); 
				}    
			  });  
		}
		else{
			return false;
		}
	  
    }
/*function productWiseStock()
{
	  var keywordVal=document.getElementById('keyword').value;
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/stockin_reports_ajax')?>',
			   data: {key:keywordVal},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  //alert("There was an error. Try again please!");
				}
		 });
}*/
</script>

<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left; width:50%">Total Order (<?php echo $orderinfo->num_rows();?>)</h2>
                                    <h3 id="userstatus" style="width:50%; float:left; text-align:right"><!--<input type="text" />--></h3>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <!--<table width="100%" class="ordertable">-->
                                  <table class="table datatable-show-all ordertable" width="100%">
                                    <tr bgcolor="#010101" class="trTitle">
                                      <td width="35" height="33" align="center"><div class="order_title1">SI</div></td>
                                      <td width="68" align="center"><div class="order_title1">Order </div></td>
                                      <td width="96" align="center"><div class="order_title1">Order On</div></td>
                                      <td width="91" align="center"><div class="order_title1">Supplier</div></td>
                                      <td width="57" align="center"><div class="order_title1"> Code </div></td>
       	    				    <td width="874" align="center">
                           	   			
										  <?php
                                            $sql = 'SELECT * FROM order_status WHERE type = ? ORDER BY sequence ASC';
                                            $stmt = $this->db->query($sql, 'in_stock');
                                            foreach ($stmt->result() as $row) {												
                                        ?>
                                  <div class="order_title"><?php echo $row->name;?></div>
                          <?php } ?>                       
                                      </td>
                                     <!-- <td width="10" align="center">Closed</td>-->
                                      <td width="64" align="center">&nbsp;</td>
                                    </tr>
                                    <?php
										$i=0;
									  foreach($orderinfo->result() as $rowq){
									  $order_id=$rowq->order_id;
									  $order_number=$rowq->order_number;
									  $order_status=$rowq->status;
									  $order_time=$rowq->order_time;
									   				  
										if($i%2!=0)
										{
										$c="#f5f5f5";
										}
										else
										{
										$c="#FFFFFF";
										}
										
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
											$rowbg = $c;	
											$opacity = 'style="opacity:1"';
											$rowtitle = '';
											$closesection ='';
										}
										$i++;
									?>
                                  
                                      <tr class="trCont" bgcolor="<?php echo $rowbg; ?>" <?php echo $opacity;?> title="<?php echo $rowtitle;?>">
                                      <td height="44"><div class="order_title1"><?php echo $i;?></div></td>
                                      <td align="left"><div class="order_title1"><?php echo $order_number;?></div></td>
                                      <td align="left"><div class="order_title1"><?php echo $order_time;?></div></td>
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
                                                    	<td width="10%" align="center"><div class="order_title1"><?php echo $supname;?></div></td>
                                                    	<td width="9%" align="center"><div class="order_title1"><?php echo $pro->pro_code;?></div></td>
                                                        
                                                        <td width="81%">  
                                                        <?php
                                                             $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
                                                            
                                                            $matcharray = array("return","miss_delivery","damage_delivery");
                                                            $sql = 'SELECT * FROM order_status WHERE type = ?  ORDER BY sequence ASC';
                                                            $stmt = $this->db->query($sql, 'in_stock');
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
                                                    <div class="order_title">
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
                                        <div class="order_title1">
                                         <input type="button" class="noText closed_action" title="Closed Order" value="Closed" name="closedstatus" id="closedstatus" 
                                         style="background:<?php echo $bgclose;?>;" onclick="updateClosedOrder(<?php echo $order_id;?>);">
                                         
                                        <a href="<?php echo base_url();?>administration/view_order/<?php echo $order_id;?>" title="View Order Details" 
                                        class="btn btn-primary order_view_action"><i class="fa fa-eye"></i></a>
                                      </div>
                                       </td>
                                    </tr>
                                    <?php
									  }
									  ?>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
               
<div id="fade" class="black_overlay"></div>        
<div id="orderlight" class="historyContent"></div>
