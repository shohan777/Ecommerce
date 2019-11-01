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
.ordertable{
	width:100%;
	height:auto;
	border:1px solid #ccc;
}	
.ordertable .trTitle{
	background:#666;
	/*box-shadow:#666 0 0 1px 1px;*/
	
}
.ordertable .trTitle td{
	padding:5px 10px;
	color:#fff;
	overflow:hidden;
	border:none;
}

.ordertable .trCont{
	border-bottom:1px solid #ccc;
}
.ordertable .trCont td{
	padding:5px 10px;
	overflow:hidden;
	border:none;
}
	
</style>
<script type="text/javascript">


function updateOrdeStatus(id,proid,oid){
   //$("#LoadingImage").show();
   //$("#loaderHide").hide();
   	  //var oid = $("#oid").val();
	  //var proid = $("#returnProduct").val();
	  var confirmval = confirm("\t\t Are you sure ? \n You want to change delivery status ?");
		if(confirmval == true){
				var ordstatus = $("#status"+id).val();
			  //var returnType = $("#returnType").val();
			  //var remval = $("#remarksval").val();
		
			  var surl = '<?php echo base_url('administration/update_order_status_action');?>';
			  
			  $.ajax({ 
				type: "POST", 
				dataType: "json",
				url: surl,  
				data:{'orderid':oid,'product_id':proid,'status':ordstatus},
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
	
	
/*function loadContent(id,orderid)
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
                                    <h3 id="userstatus" style="width:50%; float:left; text-align:right"></h3>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table width="100%" class="ordertable">
                                    <tr bgcolor="#e5e5e5" class="trTitle">
                                      <td align="center">SI</td>
                                      <td align="center">Order </td>
                                      <td align="center">Order On</td>
                                      
                                      <td colspan="9" align="center">
                                        <table width="100%" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td align="center">P. Code </td>
                                              <td align="center">China.UC</td>
                                              <td align="center">IUC</td>
                                              <td align="center">PUC</td>
                                              <td align="center">Photo.UC</td>
                                              <td align="center">SUC</td>
                                              <td align="center">DUC</td>
                                              <td align="center">CHUC</td>
                                              <td align="center">OUC</td>
                                              <td align="center">PRUC</td>
                                              <td align="center">CUC</td>  
                                          </tr>
                                        </table>
                                      </td>
                                        
                                     
                                      
                                      
                                      <td align="center">Total Price</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    <?php
									  foreach($orderinfo->result() as $rowq){
									  $order_id=$rowq->order_id;
									  $order_number=$rowq->order_number;
									  $order_time=$rowq->order_time;
									  $total_price=$rowq->total_price;
									  
									  									  
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
                                  
                                      <tr class="trCont" bgcolor="<?php echo $c; ?>">
                                      <td height="44"><?php echo $i;?></td>
                                      <td align="center"><?php echo $order_number;?></td>
                                      <td align="center"><?php echo $order_time;?></td>
                                    	<td colspan="9" align="center">
                                        	<table width="100%" align="center" cellpadding="0" cellspacing="0">
													<?php 
													$orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                                    foreach($orderProducts->result() as $ordPro){
														$ordproid = $ordPro->product_id;
                                                        $sql = "SELECT * FROM product WHERE product_id = ?";
                                                        $prodcutlist = $this->db->query($sql,$ordproid);
                                                        foreach($prodcutlist->result() as $pro);
														
														$sqlpp = "SELECT * FROM product_price WHERE product_id = ?";
                                                        $propriceq = $this->db->query($sqlpp,$ordproid);
                                                        foreach($propriceq->result() as $pprow);
														
														
                                                    ?>
                                                    <tr>
                                                    	<td align="center"><?php echo $pro->pro_code;?></td>                                                         
                                                        <td align="center"><?php echo $pprow->china_unit_cost;?></td> 
                                                        <td align="center"><?php echo $pprow->import_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->packing_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->photography_unit_cost;?></td> 
                                                        <td align="center"><?php echo $pprow->sda_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->delivery_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->cashhandle_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->officeexp_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->profit_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->customer_unit_cost;?></td>  
                                                  </tr>
                                                    <?php
                                                     }
                                                    ?>
                                                    
                                                </table>
                                        </td>
                                        <td align="center"><?php echo $total_price;?></td>
                                        <td align="center" class="section"><a href="<?php echo base_url();?>administration/view_order/<?php echo $order_id;?>" 
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
               
