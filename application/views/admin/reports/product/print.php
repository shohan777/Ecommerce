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
                                        <th width="34%">Product Name</th>
                                        <th width="22%">Category</th>
                                        <th width="22%">Price</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
									if($product_list->num_rows() > 0){
										foreach($product_list->result() as $productData):
										$product_id=$productData->product_id;
										$productTitle=$productData->product_name;
										$price=$productData->price;
										$cat_id=$productData->cat_id;
										
										
										$catquery=$this->Index_model->getAllItemTable('category','cid',$cat_id,'','','cid','desc');
										if($catquery->num_rows() > 0){
											foreach($catquery->result() as $cat_row);
											$cateName=$cat_row->cat_name;
										}
										else{
											$cateName='NULL';
											}
										
										$i++;
										?>
										  <tr>
											<td><?php echo $i;?></td>
											<td><?php echo stripslashes($productTitle); ?></td>
											<td><?php echo $cateName; ?></td>
											<td><?php echo $price; ?></td>
											 
										  </tr>
										<?php
										endforeach;
									}
									else{
										echo '<h2 style="width:100%; height:auto; font-size:30px; color:#dd5044; text-shadow:#db473c 1px 1px; text-align:center; margin:10% auto">
                                    <i class="fa fa-frown-o" aria-hidden="true"></i> No Product Found</h2>';
									}
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