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
                                    <h2 style="float:left">Total size (<?php echo $size_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('administration/size_registration');?>" class="btn btn-primary">New size</a></h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>SI</th>
                                        <th>Product Category</th>
                                        <th>Category Wise Size</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($size_list->result() as $sizeData):
									$size_id=$sizeData->size_id;
									$cat_id=$sizeData->cat_id;
									$catWiseSize=$sizeData->size;
									
									$cateQuery = $this->Index_model->getAllItemTable('category','caegory_title',$cat_id,'','','cid','desc');
									if($cateQuery->num_rows() > 0){
										foreach($cateQuery->result() as $catRow);
										$cat_name=$catRow->cat_name;
									}
									else{
										$cat_name='';
									}
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $cat_name; ?></td>
                                        <td><?php echo $catWiseSize; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('administration/size_registration/'.$size_id);?>" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-edit"></span> Edit
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $size_id;?>','size','size_id');" class="btn btn-default btn-sm">
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

                </div>
               