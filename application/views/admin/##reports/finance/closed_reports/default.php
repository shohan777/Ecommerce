<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/closed_reports_finance_ajax')?>',
			   data: {fdate:fromdate,tdate:todate},
			   success: function(data) {
				  //alert("Successfully saved");
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
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
	
	
</style>
<?php $today=date('Y-m-d'); ?>
<div class="right_col" role="main">
                <div class="row">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Order Reports</h3>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('administration/closed_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('administration/closed_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div style="float:left; width:92%">
                                    	<table width="50%" border="0" cellspacing="5" cellpadding="0" align="center">
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
                                	<div id="reportsdisplay">
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
                                                <tr id="closedOrder">
                                                  <td width="241" height="33" align="left">Total Closed Orders</td>
                                                  <td width="137" align="center"><?php echo $closedOrder->num_rows();?></td>
                                                  <td width="203" align="center"><?php echo $ctotalamount;?></td>
                                                  <td width="184" align="center"><?php echo $cpaidamount;?></td>
                                                  <td width="133" align="center"><input type="radio" name="orderstatus" value="closedOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                <tr id="successOrder">
                                                  <td width="241" height="33" align="left">Successfully Delivered</td>
                                                  <td width="137" align="center"><?php echo $successOrders;?></td>
                                                  <td width="203" align="center"><?php echo $stotala;?></td>
                                                  <td width="184" align="center"><?php echo $spaida;?></td>
                                                  <td width="133" align="center"><input type="radio" name="orderstatus" value="successOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                <tr id="returnOrder">
                                                  <td width="241" height="33" align="left">Return Orders</td>
                                                  <td width="137" align="center"><?php echo $returnOrders;?></td>
                                                  <td width="203" align="center"><?php echo $rtotala;?></td>
                                                  <td width="184" align="center"><?php echo $rpaida;?></td>
                                                  <td width="133" align="center"><input type="radio" name="orderstatus" value="returnOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                 <tr id="missOrder">
                                                  <td width="241" height="33" align="left">Miss Delivered</td>
                                                  <td width="137" align="center"><?php echo $missOrders;?></td>
                                                  <td width="203" align="center"><?php echo $mtotala;?></td>
                                                  <td width="184" align="center"><?php echo $mpaida;?></td>
                                                  <td width="133" align="center"><input type="radio" name="orderstatus" value="missOrder" 
                                                  onclick="reportsAjaxInline('missOrder');"/></td>
                                              	</tr>
                                                 <tr id="demageOrder">
                                                  <td width="241" height="33" align="left">Demaged Orders</td>
                                                  <td width="137" align="center"><?php echo $demOrders;?></td>
                                                  <td width="203" align="center"><?php echo $dtotala;?></td>
                                                  <td width="184" align="center"><?php echo $dpaida;?></td>
                                                  <td width="133" align="center"><input type="radio" name="orderstatus" value="demageOrder" 
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                                 <tr id="cancelOrder">
                                                  <td width="241" height="33" align="left">Cancelled Orders</td>
                                                  <td width="137" align="center"><?php echo $canOrders;?></td>
                                                  <td width="203" align="center"><?php echo $ctotala;?></td>
                                                  <td width="184" align="center"><?php echo $cpaida;?></td>
                                                  <td width="133" align="center"><input type="radio" name="orderstatus" value="cancelOrder"  
                                                  onclick="reportsAjaxInline();"/></td>
                                              	</tr>
                                            </table>                                    
                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;"></div>closedOrder
                                          <table width="100%" class="ordertable">
                                            <tr bgcolor="#e5e5e5" class="trTitle">
                                              <td width="43" height="33" align="center">SI</td>
                                              <td width="62" align="center">Order </td>
                                              <td width="146" align="center">Order On</td>
                                              <td width="62" align="center">Invoice</td>
                                              <td width="754" align="center">
                 					 <table width="100%" align="center" cellpadding="0" cellspacing="0">
                                                    <tr style="font-size:10px;">
                                                      <td align="center">P.Code </td>
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
                                              <td width="71" align="center">Total</td>
                                              <td width="79" align="center">Paid</td>
                                              <td width="64" align="center">Due</td>
                                    	</tr>
											<?php
                                                $i=0;
                                              foreach($closedOrder->result() as $rowq){
                                              $order_id=$rowq->order_id;
                                              $order_number=$rowq->order_number;
                                              $order_time=$rowq->order_time;
											  $total_price=$rowq->total_price;
											  $paid_amount=$rowq->paid_amount;
											  $due_amount=$rowq->due_amount;
                                              
											  $invoicequery = $this->Index_model->getAllItemTable('invoice','order_id',$order_id,'date',$today,'inv_id','desc');
											  if($invoicequery->num_rows() > 0){
												  foreach($invoicequery->result() as $inv);
												  $inv_id=$inv->inv_id;
											  }
											  else{
											  	$inv_id=0;
											  }
											                                  
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
                                  
                                      <tr class="trCont" bgcolor="<?php echo $c; ?>" style="font-size:12px;">
                                          <td height="44"><?php echo $i;?></td>
                                          <td align="left"><?php echo $order_number;?></td>
                                          <td align="left"><?php echo $order_time;?></td>
                                           <td align="left"><?php echo $inv_id;?></td>
                                    	  <td align="center">
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
                                         <td align="center"><strong style="color:#C0B418"><?php echo $total_price;?></strong></td>
                                         <td align="center"><strong style="color:#009900"><?php echo $paid_amount;?></strong></td>
                                         <td align="center"><strong style="color:#FF0000"><?php echo $due_amount;?></strong></td>
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
               
                
                <script type="text/javascript">
                        $(document).ready(function () {
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>