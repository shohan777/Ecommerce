<script type="text/javascript">
	function openPage1(pid, tablename, colid) {
		var b = window.confirm('Are you sure, you want to Delete This ?');
		if (b == true) {
			$.ajax({
				type: "GET",
				url: '<?php echo base_url($urlname)?>/deleteData/' + tablename + '/' + colid,
				data: "deleteId=" + pid,
				success: function () {
					alert("Successfully saved");
					window.location.reload(true);
				},
				error: function () {
					alert("There was an error. Try again please!");
				}
			});
		} else {
			return;
		}

	}


	checked = false;

	function checkedAll() {
		if (checked == false) {
			checked = true
		} else {
			checked = false
		}
		for (var i = 0; i < document.getElementById('form_check').elements.length; i++) {
			document.getElementById('form_check').elements[i].checked = checked;
		}
	}

	function approve() {
		var summeCode = document.getElementsByName("summe_code[]");
		var j = 0;
		var data = new Array();

		for (var i = 0; i < summeCode.length; i++) {
			if (summeCode[i].checked) {
				data[j] = summeCode[i].value;
				j++;

			}

		}
		if (data == "") {
			alert("Please check one or more!");
			return false;
		} else {
			var hrefdata = "<?php echo base_url($urlname);?>/approve?approve_val=" + data + "&tablename=student" + "&id=std_id" +
				"&status=active";
			window.location.href = hrefdata;
		}

	}

	function deapprove() {
		var summeCode = document.getElementsByName("summe_code[]");
		var j = 0;
		var data = new Array();

		for (var i = 0; i < summeCode.length; i++) {
			if (summeCode[i].checked) {
				data[j] = summeCode[i].value;
				j++;

			}

		}
		if (data == "") {
			alert("Please check one or more!");
			return false;
		} else {
			var hrefdata = "<?php echo base_url($urlname);?>/deapprove?approve_val=" + data + "&tablename=student" +
				"&id=std_id" + "&status=active";
			window.location.href = hrefdata;
		}

	}

	function deletedata(tablename) {
		var summeCode = document.getElementsByName("summe_code[]");
		var j = 0;
		var data = new Array();

		for (var i = 0; i < summeCode.length; i++) {
			if (summeCode[i].checked) {
				data[j] = summeCode[i].value;
				j++;

			}

		}
		if (data == "") {
			alert("Please check one or more!");
			return false;
		} else {
			var b = window.confirm('Are you sure, you want to delete this ?');
			if (b == true) {
				var hrefdata = '<?php echo base_url($urlname)?>/deleteAllData/' + tablename + '/std_id/' + data;
				window.location.href = hrefdata;
			} else {
				return;
			}
		}

	}

</script>
<div class="right_col" role="main">

	<!-- Page header -->
	<div class="page-header">


		<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
			<ul class="breadcrumb" style="font-size:20px;">
				<li>Total Number of orders =
					<?php echo $orders_list->num_rows();?>
				</li>
			</ul>

			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="<?php echo base_url('reports/orders_reports/print');?>" class="btn btn-link btn-float has-text" style="color:#006600">
						<i class="glyphicon glyphicon-print"></i><span>Print</span></a>
					<a href="<?php echo base_url('reports/orders_reports/downloads');?>" class="btn btn-link btn-float has-text" style="color:#006600">
						<i class="glyphicon glyphicon-download"></i><span>Dowload</span></a>
					<a href="<?php echo base_url('reports/orders');?>" class="btn btn-link btn-float has-text" style="color:#CC6600">
						<i class="glyphicon glyphicon-filter"></i><span>Filtering</span></a>
					<a href="javascript:void();" onclick="history.back()" class="btn btn-link btn-float has-text" style="color:#FF0000">
						<i class="fa fa-arrow-left"></i><span>Back</span></a>
				</div>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Page length options -->
		<div class="panel panel-flat">
			<table width="100%" cellpadding="2" cellspacing="1" class="table_round">
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
				<tr class="table_hover" bgcolor="<?php echo $c; ?>">
					<td height="44" align="center">
						<h6>
							<?php echo $i;?>
						</h6>
					</td>
					<td align="left" class="section">
						<h6>
							<?php echo $order_number;?>
						</h6>
					</td>
					<td align="left" class="section">
						<h6>
							<?php echo $name;?>
						</h6>
					</td>
					<td align="center" class="section">
						<h6>
							<?php echo $names;?>
						</h6>
					</td>
					<td align="left" class="section">
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
