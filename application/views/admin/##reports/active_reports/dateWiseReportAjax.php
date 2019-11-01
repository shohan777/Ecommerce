<script type="text/JavaScript">
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
</script>
<style>
.yellow{
	background:#FFFF00;
}
.red{
	background:#ff0000;
}
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
	background:#666;
	
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

.botBorPenTitle{
	border-bottom:2px solid #d9534f;
	color:#d9534f;
	font-weight:bold;
	font-size:15px;
}
.botBorPen{
	border-bottom:1px solid #d9534f;
	text-shadow:#f5f5f5 1px 1px;
	color:#d9534f;
	font-weight:bold;
}
.botBorSucTitle{
	border-bottom:2px solid #009900;
	color:#009900;
	font-weight:bold;
	font-size:15px;
}
.botBorSuc{
	border-bottom:1px solid #009900;
	text-shadow:#f5f5f5 1px 1px;
	color:#009900;
	font-weight:bold;
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
 <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="title_left">
                                    <h4>Order Summery for : 
                                    <strong><?php 
                                    if(isset($fromdate) && $fromdate!=""){
                                        echo '<span style="color:#B42005; margin-right:10px;">'.$fromdate.'</span> to <span style="color:#009900; margin-left:10px;">'.$todate.'</span>';
                                    }
                                    ?></strong>
                                    </h4>
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
                                                  <input type="radio" name="orderstatus" id="allOrder" value="allOrder" onclick="reportsAjaxInline();"/></td>
                                           	  </tr>
                                                <tr id="totalOrder" class="botBorSuc">
                                                  <td width="309" height="33" align="left">Payment Received</td>
                                                  <td width="151" align="center"><?php echo $paidProOrders;?></td>
                                                  <td width="141" align="center"><input type="radio" name="orderstatus" id="payRec" value="payRec" 
                                                  onclick="reportsAjaxInline();"/></td>
                                           	  </tr>
                                                <tr id="totalOrder" class="botBorSuc">
                                                  <td width="309" height="33" align="left">Payment Refund</td>
                                                  <td width="151" align="center"><?php echo $payRef;?></td>
                                                  <td width="141" align="center"><input type="radio" name="orderstatus" id="payRef" value="payRef" 
                                                  onclick="reportsAjaxInline();"/></td>
                                           	  </tr>
                                              <tr id="succDelivered" class="botBorSuc">
                                                  <td width="290" height="33" align="left">Successfully Delivered</td>
                                                  <td width="201" align="center"><?php echo $succDelivered;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="succDelivered" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                <tr id="returnOrder" class="botBorSuc">
                                                  <td width="290" height="33" align="left">Return Orders</td>
                                                  <td width="201" align="center"><?php echo $returnOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="returnOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                 <tr id="missOrder" class="botBorSuc">
                                                  <td width="290" height="33" align="left">Miss Delivered</td>
                                                  <td width="201" align="center"><?php echo $missOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="missOrder" 
                                                  onclick="reportsAjaxInline('missOrder');"/></td>
                                              	</tr>
                                                 <tr id="demageOrder" class="botBorSuc">
                                                  <td width="290" height="33" align="left">Demaged Orders</td>
                                                  <td width="201" align="center"><?php echo $demOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="demageOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                 <tr id="cancelOrder" class="botBorSuc">
                                                  <td width="290" height="33" align="left">Cancelled Orders</td>
                                                  <td width="201" align="center"><?php echo $canOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="cancelOrder"  
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
                                                  <td width="303" height="33" align="left">Pending Payment Receive</td>
                                                  <td width="148" align="center"><?php echo $pendPaidForPro;?></td>
                                                  <td width="157" align="center"><input type="radio" name="orderstatus" id="PencessOrder" value="PencessOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                           	  </tr>
                                                <tr id="totalOrder" class="botBorPen">
                                                  <td width="303" height="33" align="left">Pending Payment Refund</td>
                                                  <td width="148" align="center">&nbsp;</td>
                                                  <td width="157" align="center"><input type="radio" name="orderstatus" id="returnOrder" value="returnOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                           	  </tr>
                                               <tr id="pendDelivered" class="botBorPen">
                                                  <td width="290" height="33" align="left">Pending  Delivered</td>
                                                 <td width="201" align="center"><?php echo $pendDelivered;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" id="pendDelivered" value="pendDelivered" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                <tr id="returnOrder" class="botBorPen">
                                                  <td width="290" height="33" align="left">Pending Return Orders</td>
                                                  <td width="201" align="center"><?php echo $returnOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="returnOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                 <tr id="missOrder" class="botBorPen">
                                                  <td width="290" height="33" align="left">Pending Miss Delivered</td>
                                                  <td width="201" align="center"><?php echo $missOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="missOrder" 
                                                  onclick="reportsAjaxInline('missOrder');"/></td>
                                              	</tr>
                                                 <tr id="demageOrder" class="botBorPen">
                                                  <td width="290" height="33" align="left">Pending Demaged Orders</td>
                                                  <td width="201" align="center"><?php echo $demOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="demageOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                 <tr id="cancelOrder" class="botBorPen">
                                                  <td width="290" height="33" align="left">Pending Cancelled Orders</td>
                                                  <td width="201" align="center"><?php echo $canOrders;?></td>
                                                  <td width="125" align="center"><input type="radio" name="orderstatus" value="cancelOrder"  
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                            </table></td>
                                              </tr>
                                            </table>
                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;"></div>
                                           <div id="orderlist"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
               