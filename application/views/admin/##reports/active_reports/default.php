<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/JavaScript">

function cancel_order(oid,pid,status){
 //alert(oid);
  var confirmval = confirm("\t\t Are you sure ? \n You want to change delivery status ?");
	if(confirmval == true){
		  var surl = '<?php echo base_url('administration/cancel_order');?>';
		  $.ajax({ 
			type: "POST", 
			url: surl,  
			data:{'orderid':oid,'proid':pid,'status':status},
			cache : false, 
			success: function() { 				 
			   window.location.reload();
			}, 
			error: function (xhr, st) {  
			  alert('Unknown error ' + st); 
			}    
		  });  
	}
	else{
		return false;
	}
}
function returnPayment(oid,pid,status){
 //alert(oid);
  var confirmval = confirm("\t\t Are you sure ? \n You want to change delivery status ?");
	if(confirmval == true){
		  var surl = '<?php echo base_url('administration/payment_refund');?>';
		  $.ajax({ 
			type: "POST", 
			url: surl,  
			data:{'orderid':oid,'proid':pid,'status':status},
			cache : false, 
			success: function() { 				 
			   window.location.reload();
			}, 
			error: function (xhr, st) {  
			  alert('Unknown error ' + st); 
			}    
		  });  
	}
	else{
		return false;
	}
}
	
/*function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/active_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate},
			   success: function(data) {
				  //alert("Successfully saved");
				 $("#orderlist").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}*/


function reportsAjaxInline()
{
	 $('input[name="orderstatus"]:checked').closest('tr').addClass("yellow");
	 $('input[name="orderstatus"]').not(":checked").closest('tr').removeClass("yellow");
	 var checkval = document.querySelector('input[name="orderstatus"]:checked').value;
	
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;

	//alert(checkval);
	$.ajax({
		   type: "GET",
		   url: '<?php echo base_url('administration/order_reports_ajax')?>',
		   data: {'fdate':fromdate,'tdate':todate,'orst':checkval,'action':'ajax'},
		   success: function(data) {
			  //alert("Successfully saved");
			 $("#orderlist").html(data);
			},
			error: function() {
			  alert("There was an error. Try again please!");
			}
	 });
}
window.onload = triggerClick();

function triggerClick(){
	var fromdate=document.getElementById('allOrder');
	fromdate.click();
}


function updateOrdeStatus(id,proid,qty,oid){
	var ordstatus = $("#status"+id).val();
	//alert(oid);
	  var confirmval = confirm("\t\t Are you sure ? \n You want to change delivery status ?");
		if(confirmval == true){
				//var ordstatus = $("#status"+id).val();

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
		document.getElementById("submitbtnret").style.display="inline";
		document.getElementById("submitbtn").style.display="none";
		document.getElementById("retamount").style.display="inline";
		document.getElementById("productList").style.display="none";
	}
	else if(param=="orderplace"){
		document.getElementById("submitbtnret").style.display="none";
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
          window.location.reload();
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


/*function partialFunc(oid)
{
		alert(oid);
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
}*/
</script>
<?php $today=date('Y-m-d'); ?>
<div class="right_col" role="main">
    <div class="container">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="width:100%; float:left">
                        <h3 style="width:30%; float:left;">Active Order</h3>
                        <div style="float:left; width:62%;">
                            <table width="80%" border="0" cellspacing="5" cellpadding="0" align="left">
                        <tr>
                          <td width="19%"><label class="control-label">From Date :</label></td>
                          <td width="30%"><input name="from_date" class="form-control date-picker"  type="text" id="from_date"/></td>
                          <td width="4%">&nbsp;</td>
                          <td width="12%"><label class="control-label">To Date:</label></td>
                          <td width="26%"><input name="to_date" class="form-control date-picker" type="text" id="to_date" ></td>
                          <td width="9%"><input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                        </tr>
                      </table>
                        </div>
                        <div style="float:right; width:8%"><a href="<?php echo base_url('administration/cleareCachDate');?>" class="btn btn-danger">Clear Cach</a></div>
                    </div>
                    <div class="x_content">
                    <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                        
                            <div class="container">
                                <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;"></div>
                                <table width="100%" >
                                  <tr>
                                    <td width="49%"><table width="96%">
                                    <tr  class="botBorSucTitle">
                                      <td width="309" height="33" align="left"><strong>Particulars</strong></td>
                                      <td width="151" align="center"><strong>No. of Orders</strong> </td>
                                      <td width="141" align="center"><strong>Show Details</strong> </td>
                                   </tr>
                                    <tr id="totalOrder" class="botBorSuc">
                                      <td width="309" height="33" align="left">All Orders Received</td>
                                      <td width="151" align="center"><?php echo $datewisOrder->num_rows();?></td>
                                      <td width="141" align="center">
                                      <label>
                                      <input type="radio" class="success-input radio" name="orderstatus" id="allOrder" value="allOrder" onclick="reportsAjaxInline();" checked="checked"/>
                                      </label></td>
                                  </tr>
                                    <tr id="totalOrder" class="botBorSuc">
                                      <td width="309" height="33" align="left">Approved</td>
                                      <td width="151" align="center"><?php echo $App;?></td>
                                      <td width="141" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="appS" value="appS" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                  <tr id="totalOrder" class="botBorSuc">
                                      <td width="309" height="33" align="left">Checking & Packing</td>
                                      <td width="151" align="center"><?php echo $sChkpk;?></td>
                                      <td width="141" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="chkpS" value="chkpS" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                  <tr id="totalOrder" class="botBorSuc">
                                      <td width="309" height="33" align="left">Dispatch</td>
                                      <td width="151" align="center"><?php echo $dispatchS;?></td>
                                      <td width="141" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sDis" value="sDis" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                  <tr id="succDelivered" class="botBorSuc">
                                      <td width="290" height="33" align="left"> Successfully Delivered</td>
                                      <td width="201" align="center"><?php echo $succDelivered;?></td>
                                      <td width="125" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sDel" value="sDel" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                  
                                  
                                  
                                    <tr id="returnOrder" class="botBorSuc">
                                      <td width="290" height="33" align="left">Return Orders</td>
                                      <td width="201" align="center"><?php echo $succReturn;?></td>
                                      <td width="125" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sRet" value="sRet" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                     <tr id="missOrder" class="botBorSuc">
                                      <td width="290" height="33" align="left">Miss Delivered</td>
                                      <td width="201" align="center"><?php echo $succMiss;?></td>
                                      <td width="125" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sMis" value="sMis" 
                                      onclick="reportsAjaxInline('missOrder');"/></td>
                                    </tr>
                                     <tr id="demageOrder" class="botBorSuc">
                                      <td width="290" height="33" align="left">Demaged Orders</td>
                                      <td width="201" align="center"><?php echo $succDemage;?></td>
                                      <td width="125" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sDem" value="sDem" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                    
                                     <tr id="demageOrder" class="botBorSuc">
                                      <td width="290" height="33" align="left">Partial</td>
                                      <td width="201" align="center"><?php echo $succDemage;?></td>
                                      <td width="125" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sPartial" value="sPartial" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                    
                                    
                                     <tr id="pendDelivered" class="botBorSuc">
                                      <td width="290" height="33" align="left">Delivery Payment</td>
                                     <td width="201" align="center" valign="middle"><?php echo $succPaidDelivered;?></td>
                                     <td width="125" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="delPay" value="delPay" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                    
                                     <tr id="totalOrder" class="botBorSuc">
                                      <td width="309" height="33" align="left">Return Received</td>
                                      <td width="151" align="center"><?php echo $succReceived;?></td>
                                      <td width="141" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="retRec" value="retRec" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                  
                                  
                                    <tr id="totalOrder" class="botBorSuc">
                                      <td width="309" height="33" align="left">Payment Received</td>
                                      <td width="151" align="center"><?php echo $succPayment;?></td>
                                      <td width="141" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sRec" value="sRec" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                     <tr id="totalOrder" class="botBorSuc">
                                      <td width="309" height="33" align="left">Payment Refund</td>
                                      <td width="151" align="center"><?php echo $payRef;?></td>
                                      <td width="141" align="center"><input type="radio" class="success-input radio" name="orderstatus" id="sRef" value="sRef" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                     <tr id="cancelOrder" class="botBorSuc">
                                      <td width="290" height="33" align="left">Cancelled Orders</td>
                                      <td width="201" align="center"><?php echo $pendCancelled;?></td>
                                      <td width="125" align="center"><input type="radio" class="success-input radio" name="orderstatus" value="sCan"  
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                </table></td>
                                    <td width="2%">&nbsp;</td>
                                        <td width="49%"><table width="100%">
                                    <tr class="botBorPenTitle">
                                      <td width="303" height="33" align="left"><strong>Particulars</strong></td>
                                      <td width="148" align="center"><strong>No. of Orders</strong> </td>
                                      <td width="157" align="center"><strong>Show Details</strong> </td>
                                   </tr>
                                    <tr id="totalOrder" class="botBorPen">
                                      <td width="303" height="33" align="left" colspan="3">&nbsp;</td>
                                      
                                  </tr>
                                   <tr class="botBorPen">
                                      <td width="303" height="33" align="left">Pending Approved</td>
                                      <td width="148" align="center" valign="middle"><?php echo $pApp;?></td>
                                     <td width="157" align="center"><input type="radio" class="pending-input radio" name="orderstatus" 
                                      id="pApp" value="pApp" onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                  <tr class="botBorPen">
                                      <td width="303" height="33" align="left">Checking & Packing</td>
                                      <td width="148" align="center" valign="middle"><?php echo $Chkpk;?></td>
                                    <td width="157" align="center"><input type="radio" class="pending-input radio" name="orderstatus" 
                                      id="pChkp" value="pChkp" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                  <tr class="botBorPen">
                                      <td width="303" height="33" align="left">Dispatch</td>
                                      <td width="148" align="center" valign="middle"><?php echo $dispatchP;?></td>
                                    <td width="157" align="center"><input type="radio" class="pending-input radio" name="orderstatus" 
                                      id="pDis" value="pDis" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                 
                                   <tr id="pendDelivered" class="botBorPen">
                                      <td width="290" height="33" align="left">Pending  Delivered</td>
                                     <td width="201" align="center" valign="middle"><?php echo $pendDelivered;?></td>
                                     <td width="125" align="center"><input type="radio" class="pending-input radio" name="orderstatus" id="pDel" value="pDel" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                    
                                    
                                    <tr id="returnOrder" class="botBorPen">
                                      <td width="290" height="33" align="left">Pending Return Orders</td>
                                      <td width="201" align="center" valign="middle"><?php echo $pendReturn;?></td>
                                      <td width="125" align="center"><input type="radio" class="pending-input radio" name="orderstatus" id="pRet" value="pRet" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                     <tr id="missOrder" class="botBorPen">
                                      <td width="290" height="33" align="left">Pending Miss Delivered</td>
                                      <td width="201" align="center" valign="middle"><?php echo $pendMiss;?></td>
                                      <td width="125" align="center"><input type="radio" class="pending-input radio" name="orderstatus" id="pMis" value="pMis" 
                                      onclick="reportsAjaxInline('missOrder');"/></td>
                                    </tr>
                                     <tr id="demageOrder" class="botBorPen">
                                      <td width="290" height="33" align="left">Pending Demaged Orders</td>
                                      <td width="201" align="center" valign="middle"><?php echo $pendDemage;?></td>
                                      <td width="125" align="center"><input type="radio" class="pending-input radio" name="orderstatus" id="pDem" value="pDem" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                     <tr class="botBorPartial">
                                      <td width="290" height="33" align="left">Partial Order</td>
                                      <td width="201" align="center" valign="middle"><a href="javascript:void();" onclick="partialFunc('<?php echo $partOrd;?>');">
									  <?php echo $partTotal;?></a></td>
                                      <td width="125" align="center"><input type="radio" class="partial-input radio" name="orderstatus" id="partial" value="partial"  
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                    <tr id="pendDelivered" class="botBorPen">
                                      <td width="290" height="33" align="left">Pending Delivery Payment</td>
                                     <td width="201" align="center" valign="middle"><?php echo $pendPaidDelivered;?></td>
                                     <td width="125" align="center"><input type="radio" class="pending-input radio" name="orderstatus" id="pDelPay" value="pDelPay" 
                                      onclick="reportsAjaxInline();"/></td>
                                    </tr>
                                    
                                    <tr class="botBorPen">
                                      <td width="303" height="33" align="left">Pending Return Receive</td>
                                      <td width="148" align="center" valign="middle"><?php echo $pendReceived;?></td>
                                      <td width="157" align="center"><input type="radio" class="pending-input radio" 
                                      name="orderstatus" id="pRec" value="pRec" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                  
                                  
                                     <tr class="botBorPen">
                                      <td width="303" height="33" align="left">Pending Payment Receive</td>
                                      <td width="148" align="center" valign="middle"><?php echo $pendPayment;?></td>
                                      <td width="157" align="center"><input type="radio" class="pending-input radio" name="orderstatus" id="pRec" value="pRec" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                 
                                    <tr id="totalOrder" class="botBorPen">
                                      <td width="303" height="33" align="left">Pending Payment Refund</td>
                                      <td width="148" align="center" valign="middle"><?php echo $pendRef;?></td>
                                      <td width="157" align="center"><input type="radio" class="pending-input radio" name="orderstatus" id="pRef" value="pRef" 
                                      onclick="reportsAjaxInline();"/></td>
                                  </tr>
                                     
                                     
                                      <tr id="missOrder" class="botBorPen">
                                      <td width="290" height="33" align="left" colspan="3">&nbsp;</td>
                                    </tr>
                                </table></td>
                                  </tr>
                                </table>
                                     
                                    
                                
                                
                            <div id="orderlist">                               
                               <table class="table datatable-show-all ordertable" width="100%">
                                <tr bgcolor="#010101" class="trTitle">
                                  <td width="35" height="33" align="center"><div class="order_title1">SI</div></td>
                                  <td width="68" align="center"><div class="order_title1">Order </div></td>
                                  <td width="96" align="center"><div class="order_title1">Order On</div></td>
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
                                  <td width="64" align="center"><div class="order_title1">Close</div></td>
                                </tr>
                                <?php
                                  $i=0;
                                  foreach($datewisOrder->result() as $rowq){
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
                                      <td colspan="2" style="padding:0; margin:0">
                                        <table width="100%" align="center">
                                        <?php 
                                        $orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                        foreach($orderProducts->result() as $ordPro){
                                            $ordproid = $ordPro->product_id;
                                            $ordQty = $ordPro->qty;
                                            
                                            $sql = "SELECT * FROM product WHERE product_id = ?";
                                            $prodcutlist = $this->db->query($sql,$ordproid);
                                            foreach($prodcutlist->result() as $pro);
                                            //////// Get all Changed Status//////////////////////////
                                            $sqlu = "SELECT * FROM stock_order_product_status WHERE order_id = ? AND product_id = ?";
                                            $orderstatusd = $this->db->query($sqlu,array($order_id,$ordproid));
                                            if($orderstatusd->num_rows() > 0){
                                                foreach($orderstatusd->result() as $ords);
                                                $status=$ords->status;
												$ret_type=$ords->ret_type;
                                            }
                                            else{
                                                $status = 'Pending';
												$ret_type = '';
                                            }
                                        ?>
                                        <tr>
                                            <td width="9%" align="center"><div class="order_title"><?php echo $pro->pro_code;?></div></td>
                                            <td width="81%">  
                                            <?php
												//////// Get User Permisson Value form session//////////////////////////
                                                 $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
                                               
											    //////// Get Returnable Order Status for return next action//////////////////////////
                                                $matcharray = array("return","miss_delivery","damage_delivery");
												
												//////// Get User Permisson Value form session//////////////////////////
                                                $sql = 'SELECT * FROM order_status WHERE type = ?  ORDER BY sequence ASC';
                                                $stmt = $this->db->query($sql, 'in_stock');
                                                foreach ($stmt->result() as $row) {
                                                $statusTypeId = $row->id;
                                                
                                                $finalSt = explode(',',$status);
												//////// match changed order status with all status//////////////////////////
                                                if(in_array($row->name, $finalSt)){
                                                    $bgcolor = $row->color;
                                                    $ordt = "'".$order_time."'";
													 
                                                    if(in_array($row->access_name, $matcharray)){														
                                                        $actionname = $row->name;
                                                        $titleval = 'Change action for '.$row->name;
                                                        $cursor =  'cursor:pointer';
                                                        $font =  'noText';
														if($ret_type==''){
															$bgcolor = $row->color;
															$clssect = 'onclick="loadContent('.$statusTypeId.','.$order_id.','.$ordproid.','.$ordt.','.$ordQty.')"';
														}
														else{
															$bgcolor = '#db473c';
															$clssect = '';
														}
														
                                                    }
                                                    else{
                                                        $actionname = $row->name;
                                                        $titleval = $row->name;
                                                        $cursor =  'cursor:default';
                                                        $font =  'noText';
														 $clssect = '';
                                                    }
                                                    
                                                    if($order_status=='Closed'){
                                                        $clssect = '';
                                                    }
                                                    $saction = $clssect;
                                                    ?>
                                                    <div class="order_title">
                                                         <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                         style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" <?php echo $saction; ?> 
                                                         value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
                                                    </div>
                                                    <?php													
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
                                                                ?>
                                                                <div class="order_title">
                                                                     <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                                     style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" 
                                                                     value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
                                                                </div>
                                                                <?php
                                                            }
                                                            else{
                                                                 ?>
                                                                <div class="order_title">
                                                                 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                                 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;"
                                                                 onclick="updateOrdeStatus(<?php echo $statusTypeId.','.$ordproid.','.$ordQty.','.$order_id;?>)" 
                                                                 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
                                                            </div>
                                                                <?php	
                                                            }										
                                                        }
                                                        else{
                                                           ?>
                                                            <div class="order_title">
                                                                 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                                 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" 
                                                                 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
                                                            </div>
                                                        <?php	
                                                        }
                                                        
                                                    }
                                                    else{
                                                        if($order_status=='Closed'){
                                                            ?>
                                                            <div class="order_title">
                                                                 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                                 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;"
                                                                 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
                                                            </div>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <div class="order_title">
                                                                 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                                 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;"
                                                                 onclick="updateOrdeStatus(<?php echo $statusTypeId.','.$ordproid.','.$ordQty.','.$order_id;?>)" 
                                                                 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
                                                            </div>
                                                            <?php
                                                        }										
                                                    }
                                                }
                                             } 
                                         ?> 
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
        </div>
    </div>
</div>  
    
    <div id="fade" class="black_overlay"></div>        
<div id="orderlight" class="historyContent"></div>
<script type="text/javascript">
            $(document).ready(function () {
                //alert('dfd');
                $('.date-picker').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            });
        </script>