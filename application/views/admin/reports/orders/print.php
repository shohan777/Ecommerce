<script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
<script type="text/JavaScript">
	function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var customer_id=document.getElementById('customer_id').value;
	//alert(customer_id);
	if(customer_id!='' || fromdate!="" || todate!=""){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/sale_reports_ajax')?>',
			   data: {'fdate':fromdate,'tdate':todate,'customer_id':customer_id},
			   success: function(data) {
				  //alert("Successfully saved");
				 $("#reportPrintDisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
}
window.onload=reportsAjax;
</script>
<style>
	.summTable {
		borders-collapse: collapse;
	}

	.summTable td,
	th {
		padding: 2px 5px;
		color: #000;
	}

	.summTable .theadline td,
	th {
		padding: 2px;
		color: #fff;
		background: #666;
	}

	body {
		background: rgb(204, 204, 204);
	}

	page {
		background: #fff;
		display: block;
		margin: 0 auto;
		margin-bottom: 0.5cm;
		box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
	}

	page[size="A4"] {
		width: 21cm;
		/*height: 29.7cm;*/
		height: auto;
	}

	page[size="A4"][layout="portrait"] {
		width: 29.7cm;
		/* height: 21cm;  */
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

		body,
		page {
			margin: 0;
			box-shadow: 0;
		}
	}

</style>
<page size="A4" layout="portrait">
	<div style="padding:1cm;">
		<div class="row">
			<div style="width:100%; float:left">
				<div style="text-align:center; padding:5px 0">
					<h2><img src="<?php echo base_url('assets/images/logo.png');?>" style="width:90px; height:auto;text-align: center;"
						 alt="MMK Group" title="MMK Group"></h2>
					<address style="font-size:13px; text-align:center">
					</address>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">

						<div class="x_content">
							<div id="reportPrintDisplay">

								<div class="row">
									<table width="100%" cellpadding="2" cellspacing="1" class="table_round" border="1" style="border-collapse:collapse">
										<tr>
											<td width="37" height="36" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">SI</span></td>
											<td width="119" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order </span></td>
											<td width="184" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Bill To</span></td>
											<td width="169" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Ship To</span></td>
											<td width="234" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order On</span></td>
											<td width="278" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Status</span></td>
											<td width="137" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Total Price</span></td>
										</tr>
										<?php
                   $i=0;
								  foreach($orders_list->result() as $rowq){
								  $order_id=$rowq->order_id;
								  $order_number=$rowq->order_number;
								  $order_time=$rowq->order_time;
								  $customer_id=$rowq->customer_id;
								  $status=$rowq->status;
								  $total_price=$rowq->total_price;
								  
								  $customerQ=$this->db->query("select * from customer where user_id='$customer_id'");
								  if($customerQ->num_rows()>0){
									  $rowCCount=$customerQ->result();
									  foreach($rowCCount as $rowc);
									  $check_id=$rowc->user_id;
									  $name=$rowc->username;
								  }
								  else{
									  $check_id='';
									  $name='';
								  }
								  $shipping=$this->db->query("select * from shiping_info where userid='$customer_id'");
								  if($shipping->num_rows() > 0){
									  $rowSCount=$shipping->result();
									  foreach($rowSCount as $rows);
									  $shipping_id=$rows->id;
									  $names=$rows->fname.' '.$rows->lname;
								  }
								  else{
									$shipping_id='';
									$names='';
								  }
								  
									$i++;
									?>
										<tr class="table_hover">
											<td height="44" align="center">
												<h6>
													<?php echo $i;?>
												</h6>
											</td>
											<td align="center" class="section">
												<h6>
													<?php echo $order_number;?>
												</h6>
											</td>
											<td align="center" class="section">
												<h6>
													<?php echo $name;?>
												</h6>
											</td>
											<td align="center" class="section">
												<h6>
													<?php echo $names;?>
												</h6>
											</td>
											<td align="center" class="section">
												<h6>
													<?php echo $order_time;?>
												</h6>
											</td>
											<td align="center" valign="middle" class="section">
												<?php echo $status;?>
											</td>
											<td align="center" class="section">
												<h6>TK&nbsp;
													<?php echo $total_price;?>
												</h6>
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
</page>
