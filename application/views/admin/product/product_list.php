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
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">


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
                                     <h2  class="col-sm-2 pull-right" style="text-align:right">
                                    <a href="<?php echo base_url('administration/product_registration');?>" class="btn btn-primary">New Product</a></h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                    <div class="container">
                                      <table class="table table-striped" width="100%">
                                        <thead>
                                          <tr>
                                            <th width="2%">SI</th>
                                            <th width="34%">Product Name</th>
                                            <th width="22%">Product Category</th>
                                            <th width="22%">Quantity</th>
                                            <th width="22%">Supplier</th>
                                            <th width="18%">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=0;
                                        foreach($product_list->result() as $productData):
                                        $product_id=$productData->product_id;
                                        $productTitle=$productData->product_name;
                                        $supplier=$productData->supplier;
                                        $cat_id=$productData->cat_id;
                                        $pro_qty=$productData->pro_qty;
                                        
                                        $supplierq=$this->Index_model->getAllItemTable('supplier','user_id',$supplier,'','','user_id','desc');
                                        if($supplierq->num_rows() > 0){
                                            foreach($supplierq->result() as $s_row);
                                            $supName=$s_row->username;
                                        }
                                        else{
                                            $supName='NULL';
                                        }
                                            
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
                                            <td><?php echo stripslashes($productTitle); ?></td>
                                            <td><?php echo $cateName; ?></td>
                                            <td><?php echo $pro_qty; ?></td>
                                            <td><?php echo $supName; ?></td>
                                             <td> 
                                                <a href="<?php echo base_url('administration/product_registration/'.$product_id);?>" class="btn btn-default btn-sm">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a> 
                                                <a href="javascript:void();" onclick="openPage1('<?php echo $product_id;?>','product','product_id');" class="btn btn-default btn-sm">
                                                    <span class="glyphicon glyphicon-remove-circle"></span> Remove
                                                </a>
                                                </td>
                                          </tr>
                                        <?php
                                        endforeach;
                                        ?>  
                                          
                                        </tbody>
                                      </table>
                                      <div class="row">
                                            <div class="controls">
                                                <div id="paginationData" class="tsc_pagination">
                                                      <ul><?php echo "<li>". $pagination."</li>"; ?></ul>
                                                   </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
               