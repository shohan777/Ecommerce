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
<div class="right_col" role="main">
   <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 class="col-sm-2">Total product (<?php echo $product_list->num_rows();?>)</h2>
                                     <h2 class="col-sm-5">
                                    	<?php echo form_open('');?>
                                    	<input type="text" name="keywords" class="form-control" style="width:80%; float:left" 
                                        placeholder="Search By: Product Name, Details,Code.." />
                                        <input type="submit" value="Search" class="btn btn-success" />
                                        <?php echo form_close();?>
                                    </h2>
                                     <h2 class="col-sm-3">
                                     	<?php echo form_open('');?>
                                    	<select name="category" class="form-control" onchange="form.submit();">
                                        	<option value="">Category</option>
                                            <?php
											foreach($allcategory->result() as $row){
											$caegory_title=$row->caegory_title;
											$cat_name=$row->cat_name;
											?>
												<option value="<?php echo $caegory_title; ?>"><?php echo $cat_name; ?></option>
											<?php
											}
											?>
                                        </select>
                                        <?php echo form_close();?>
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
                                        <th width="35%">Product Name</th>
                                        <th width="19%">Product Category</th>
                                        <th width="13%">Product Code</th>
                                        <th width="16%">Product Price</th>
                                        <th width="15%">QTY</th>
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
										$pro_code=$productData->pro_code;
										$qty=$productData->qty;
										$cat_id=$productData->cat_id;
											
										$catquery=$this->Index_model->getAllItemTable('category','caegory_title',$cat_id,'','','cid','desc');
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
											<td><?php echo $productTitle; ?></td>
											<td><?php echo $cateName; ?></td>
											<td><?php echo $pro_code; ?></td>
                                            <td><?php echo $price; ?></td>
                                            <td><?php echo $qty; ?></td>
											
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