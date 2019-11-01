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

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
	                       <li>Total Number of product = <?php echo $product_list->num_rows();?></li>
						</ul>

						<ul class="breadcrumb-elements">
							<div class="heading-btn-group">
								<a href="<?php echo base_url('reports/product_reports/print');?>" class="btn btn-link btn-float has-text" style="color:#006600">
                                <i class="glyphicon glyphicon-print"></i><span>Print</span></a>
                                <a href="<?php echo base_url('reports/product_reports/downloads');?>" class="btn btn-link btn-float has-text" style="color:#006600">
                                <i class="glyphicon glyphicon-download"></i><span>Dowload</span></a>
								<a href="<?php echo base_url('reports/product');?>" class="btn btn-link btn-float has-text" style="color:#CC6600">
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
					<div class="panel panel-flat"><?php echo form_open('','id="form_check"');?>
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
                      <?php echo form_close();?>
					</div>
