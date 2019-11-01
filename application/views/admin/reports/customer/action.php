<script type="text/javascript">

function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url($urlname)?>/deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}


checked = false;
function checkedAll() {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
	  document.getElementById('form_check').elements[i].checked = checked;
	}
}
function approve(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="<?php echo base_url($urlname);?>/approve?approve_val="+data+"&tablename=student"+"&id=std_id"+"&status=active";
			window.location.href=hrefdata;
	}
	
}

function deapprove(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="<?php echo base_url($urlname);?>/deapprove?approve_val="+data+"&tablename=student"+"&id=std_id"+"&status=active";
			window.location.href=hrefdata;
	}
	
}

function deletedata(tablename){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
		var b = window.confirm('Are you sure, you want to delete this ?');
		if(b==true){
			var hrefdata ='<?php echo base_url($urlname)?>/deleteAllData/'+tablename+'/std_id/'+data;
			window.location.href=hrefdata;
			}
			else{
			 return;
			 }
	}
	
}

</script>
<div class="right_col" role="main">
				<div class="page-header">
					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
	                       <li>Total Number of customer = <?php echo $customer_list->num_rows();?></li>
						</ul>

						<ul class="breadcrumb-elements">
							<div class="heading-btn-group">
								<a href="<?php echo base_url('reports/customer_reports/print');?>" class="btn btn-link btn-float has-text" style="color:#006600">
                                <i class="glyphicon glyphicon-print"></i><span>Print</span></a>
                                <a href="<?php echo base_url('reports/customer_reports/downloads');?>" class="btn btn-link btn-float has-text" style="color:#006600">
                                <i class="glyphicon glyphicon-download"></i><span>Dowload</span></a>
								<a href="<?php echo base_url('reports/customer');?>" class="btn btn-link btn-float has-text" style="color:#CC6600">
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
                          <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th width="22%">Customer Name</th>
                                         <th width="19%">Contact</th>
                                         <th width="20%">Email</th>
                                         <th width="14%">Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($customer_list->result() as $customer):
										$customerId=$customer->user_id;
										$customer_name=$customer->username;
										$contact=$customer->mobile;
										$email=$customer->email;
										$active=$customer->active;
									$i++;
									
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        
                                        <td align="left"><?php echo $customer_name; ?></td>
                                        <td align="left"><?php echo $contact; ?></td>
                                        <td align="left"><?php echo $email; ?></td>
                                        <td width="14%" align="left">
                                        	<?php
                                            	if($active==1){
													?>
														<span style="background:#060; padding:5px; color:white;"><i class="fa fa-check"></i></span>
													<?php
													}
													else{
														?>
														<span style="background:#C00; padding:5px; color:white;"><i class="fa fa-close"></i></span>
                                                        <?php
														}
											?>
                                        </td>
                                         
                                      </tr>
                                    <?php
                                    endforeach;
									?>  
                                      
                                    </tbody>
                                  </table>
					</div>
