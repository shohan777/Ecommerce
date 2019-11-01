<script type="text/JavaScript">
function reportsAjaxInline()
{
	
	//var checkval = document.querySelector('input[name="orderstatus"]:checked');
	//document.getElementById(checkval.value).style.backgroundColor="#ffff00";
	/*var checkval = document.querySelector('input[name="orderstatus"]:checked').value;
	//alert(checkval);
	var categories = Array("totalOrder","closedOrder","returnOrder","successOrder");
	var found = categories.includes(checkval);
	//alert(found);
	if(found ==  true){
		document.getElementById(checkval).style.backgroundColor="#ffff00";
	}
	else{
		document.getElementById(checkval).style.backgroundColor="none";
	}*/
	
	
	 //$('input[name="orderstatus"]:checked').closest('tr').addClass('yellow');
	 // $('input[name="orderstatus"]').closest('tr').addClass('yellow');
	 $('input[name="orderstatus"]:checked').closest('tr').addClass("yellow");
	 
	 $('input[name="orderstatus"]').not(":checked").closest('tr').removeClass("yellow");
	 var checkval = document.querySelector('input[name="orderstatus"]:checked').value;
	
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	//alert(todate);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/order_reports_finance_ajax')?>',
			   data: {fdate:fromdate,tdate:todate,orst:checkval},
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
	var fromdate=document.getElementById('torder');
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
                                              <table width="70%">
                                                <tr style="border-bottom:1px solid #003333">
                                                  <td width="241" height="33" align="left"><strong>Particulars</strong></td>
                                                  <td width="137" align="center"><strong>No. of Orders</strong> </td>
                                                  <td width="203" align="center"><strong>Amount in BDT</strong></td>
                                                  <td width="184" align="center"><strong>Collection in BDT</strong></td>
                                                  <td width="133" align="center"><strong>Show Details</strong> </td>
                                              </tr>
                                                <tr id="totalOrder">
                                                  <td width="241" height="33" align="left">Total Orders Received</td>
                                                  <td width="137" align="center"><?php echo $datewisOrder->num_rows();?></td>
                                                  <td width="203" align="center"><?php echo $totalamount;?></td>
                                                  <td width="184" align="center"><?php echo $paidamount;?></td>
                                                  <td width="133" align="center"><input type="radio" name="orderstatus" id="torder" value="totalOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                            </table>
                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;"></div>
                                           <div id="orderlist"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
               