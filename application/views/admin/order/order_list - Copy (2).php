<script type="text/javascript">
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

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left; width:50%">Total Order (<?php echo $orderinfo->num_rows();?>)</h2>
                                    <h3 id="userstatus" style="width:50%; float:left; text-align:right"></h3>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
                                    <tr>
                                      <td width="17" height="33" align="center" bgcolor="#e5e5e5"class="table_header"><span class="style2">SI</span></td>
                                      <td width="103" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order </span></td>
                                      <!-- <td width="184" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Bill To</span></td>
            <td width="169" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Ship To</span></td>-->
                                      <td width="234" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order On</span></td>
                                      <td width="705" align="center" bgcolor="#e5e5e5" class="table_header">
                           	   			
                                              <?php
												$sql = 'SELECT * FROM order_status WHERE type = ?';
												$stmt = $this->db->query($sql, 'in_stock');
												foreach ($stmt->result() as $row) {												
											?>
                                              <div style="width:9%; float:left; text-align:left; font-weight:bold"><?php echo $row->short_name;?></div>
                                             <?php } ?>                       
                                             </td>
                                      <td width="151" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Total Price</span></td>
                                      <td width="74" align="center" bgcolor="#e5e5e5" class="table_header">&nbsp;</td>
                                    </tr>
                                    <?php
									  $i=0;
									  
									  
									 
							   		  //print_r($userAccess);
									  foreach($orderinfo->result() as $rowq){
									  $order_id=$rowq->order_id;
									  $order_number=$rowq->order_number;
									  $order_time=$rowq->order_time;
									  $customer_id=$rowq->customer_id;
									  $status=$rowq->status;
									  $total_price=$rowq->total_price;
									  
									  $payInfo=$this->db->query("SELECT * FROM payment_info WHERE order_id='".$order_id."'");
										  foreach($payInfo->result() as $rowc);
										  $customer_id		=	$rowc->customer_id;
										  $billing_id		=	$rowc->billing_id;
										  $shipping_id		=	$rowc->shipping_id;
										  $pay_method		=	$rowc->pay_method;
										  $transition_id	=	$rowc->transition_id;
										  $card_number		=	$rowc->card_number;
										  
										  $customerQ=$this->db->query("select * from customer where user_id='".$customer_id."'");
										  if($customerQ->num_rows()>0){
											  $rowCCount=$customerQ->result();
											  foreach($rowCCount as $rowc);
											  $name=$rowc->firstname.' '.$rowc->lastname;
										  }
										  else{
											  $name='';
										  }
									  
									  
										  $shipping=$this->db->query("select * from shiping_info where id='".$shipping_id."'");
										  $rowSCount=$shipping->result();
										  foreach($rowSCount as $rows);
										  $sname=$rows->fname.' '.$rows->lname;
									  
									  
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
                                      <td align="left" class="section"><h6><?php echo $order_number;?></h6></td>
                                      <!--<td align="left" class="section"><h6><?php echo $name;?></h6></td>
            							<td align="center" class="section"><h6><?php echo $sname;?></h6></td>-->
                                      <td align="left" class="section"><h6><?php echo $order_time;?></h6></td>
                                      <td valign="top">
                                          
                                            <?php
												 $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
												
												$matcharray = array("return","miss_delivery","damage_delivery");
												$sql = 'SELECT * FROM order_status WHERE type = ?';
												$stmt = $this->db->query($sql, 'in_stock');
												foreach ($stmt->result() as $row) {
												
												$finalSt = explode(',',$status);
												if(in_array($row->name, $finalSt)){
													$bgcolor = $row->color;
												}
												else{
													$bgcolor = $row->default_color;
												}
												
												if(($this->session->userdata('AdminType')!="Precident") && 
												 ($this->session->userdata('AdminType')!="CEO") && 
												 ($this->session->userdata('AdminType')!="Country Manager")){
													
													if(in_array($row->access_name, $userAccess)){
														if(in_array($row->access_name, $matcharray)){
															$saction = 'onclick="alert(ddf)"';
														}
														else{
															$saction = 'onclick="update_status('.$row->id.','.$order_id.')"';
														}
														$cursor =  'cursor:pointer';
													}
													else{
														$saction = '';
														$cursor =  'cursor:default';
													}
												}
												else{
													if(in_array($row->access_name, $matcharray)){
															$saction = 'onclick="loadContent('.$row->id.','.$order_id.')"';
														}
														else{
															$saction = 'onclick="update_status('.$row->id.','.$order_id.')"';
														}
													//$saction = 'onclick="update_status('.$row->id.','.$order_id.')"';
													$cursor =  'cursor:pointer';
												}
												
												
											?>
                                            <div style="width:9%; float:left; cursor:default">
                                              <?php
                                              	if($bgcolor == '#cccccc'){
												?>
                                                    <input type="button" class="noText" title="<?php echo $row->name;?>" 
                                                    style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>"  <?php echo $saction; ?> 
                                                    value="<?php echo $row->name;?>" name="status" id="status<?php echo $row->id;?>" >
                                                <?php
												}
												else{
												?>
                                                    <input type="button" class="noText" title="<?php echo $row->name;?>" style="background:<?php echo $bgcolor;?>;cursor:text" 
                                                     value="<?php echo $row->name;?>" name="status" id="status<?php echo $row->id;?>">
                                                <?php
												}
											  ?>
                                              
                                              	</div>
                                            <?php } ?> 
                                          </td>
                                      <td align="center" class="section"><h6>TK&nbsp;<?php echo $total_price;?></h6></td>
                                      <td align="left" class="section"><a href="<?php echo base_url();?>administration/view_order/<?php echo $order_id;?>" 
                                      class="btn btn-primary" style="padding:5px; font-size:12px;">View Order</a> </td>
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

                    

                </div>
               
       
<div id="fade" class="black_overlay"></div>        
<div id="orderlight" class="historyContent"></div>
