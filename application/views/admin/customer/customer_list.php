<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>administration/deleteData/'+tablename+'/'+colid,
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
</script>
<script type="text/javascript">
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
			var hrefdata ="<?php echo base_url();?>administration/approved?approve_val="+data;
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
			var hrefdata ="<?php echo base_url();?>administration/deapproved?deapprove_val="+data;
			window.location.href=hrefdata;
	}
	
}

function deletedata(){
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
			var hrefdata ="<?php echo base_url();?>administration/delete?brid="+data;
			window.location.href=hrefdata;
			}
			else{
			 return;
			 }
	}
	
}
</script>
<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php echo form_open('', 'name="formUserSearch" id="form_check"');?>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left">Total Customer (<?php echo $customer_list->num_rows();?>)</h2>
                                    <h2 style="float:right">
                                    <a href="<?php echo base_url('administration/customer_registration');?>" class="btn btn-primary">New customer</a>
                                    <input type="button" class="btn btn-primary" style="background-color:#093"  onclick="approve();" value="Approve"/>
                                    <input type="button" class="btn btn-primary" style="background-color:#690"  onclick="deapprove();" value="Disapprove" />
                                    <input type="button" class="btn btn-primary" style="background-color:#f00" onclick="deletedata();" value="Delete" />
                                    </h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" /></th>
                                        <th width="22%">Customer Name</th>
                                         <th width="19%">Contact</th>
                                         <th width="20%">Email</th>
                                          <th width="21%">Status</th>
                                        <th width="14%">Action</th>
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
                                        <td>
                                        <input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="<?php echo $customerId;?>" /></td>
                                        <td align="left"><?php echo $customer_name; ?></td>
                                        <td align="left"><?php echo $contact; ?></td>
                                        <td align="left"><?php echo $email; ?></td>
                                        <td width="21%" align="left">
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
                                            </td>                                       </td>
                                      <td width="14%" align="left"> 
                                         	<a href="<?php echo base_url('administration/customer_registration/'.$customerId);?>" class="btn btn-warning btn-xs" title="Edit"
                                            style="font-size:14px; padding:0px 5px">
          										<span class="fa fa-edit"></span>                                    </a> 
                                            <a href="<?php echo base_url('administration/customer_list/'.$customerId);?>" class="btn btn-success btn-xs" title="Details"
                                            style="font-size:14px; padding:0px 5px">
          										<span class="fa fa-file"></span>                                        </a>
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $customerId;?>','customer','user_id');" class="btn btn-danger btn-xs" 
                                            title="Delete" style="font-size:14px; padding:0px 5px">
          										<span class="fa fa-trash"></span>                                            </a>                                        
                                       </td>
                                      </tr>
                                    <?php
                                    endforeach;
									?>  
                                      
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div>
                       <?php echo form_close();?>  
                        </div>
                    </div>

                   

                </div>
               