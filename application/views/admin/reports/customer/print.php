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
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:2px 5px;
	color:#000;
}
.summTable .theadline td, th{
	padding:2px;
	color:#fff;
	background:#666;
}

		body {
	  background: rgb(204,204,204); 
	}
	page {
	  background: #fff;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  /*height: 29.7cm;*/ 
	  height:auto;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	 /* height: 21cm;  */
	 height:auto;
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
	  body, page {
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
                         <h2><img src="<?php echo base_url('assets/images/logo.png');?>" style="width:90px; height:auto;text-align: center;" alt="MMK Group" title="MMK Group"></h2>
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
                            
                            </div>
                        </div>
                </div>
            </div>
        
        </div>
            </div>
    </div>
</page>             