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
                                    <h2 style="float:left">Total color (<?php echo $color_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('administration/color_registration');?>" class="btn btn-primary">New color</a></h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th width="25%">Product Category</th>
                                        <th>Color</th>
                                        <th width="22%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($color_list->result() as $colorData):									
									$color_id=$colorData->color_id;
									$cat_id=$colorData->cat_id;
									$catWiseSize=$colorData->color;
									$colorCode=$colorData->color_title;
									
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
                                        <?php /*?><td width="33%">
                                        <?php 
											$categoryColor = $this->db->query("SELECT * FROM color WHERE cat_id = '".$cat_id."'");
											foreach($categoryColor->result() as $catcol):
										?>											
                                            <div style=" width:20px; height:20px; border:1px solid #000; float:left; margin:2px; background:<?php echo $catcol->color_title;?>" 
                                            title="<?php echo $catcol->color; ?>"></div>
                                            <?php endforeach;?>
                                        </td><?php */?>
                                        <td width="33%">						
                                            <div style=" width:20px; height:20px; border:1px solid #000; float:left; margin:2px; background:<?php echo $colorCode;?>" 
                                            title="<?php echo $catWiseSize; ?>"></div>
                                        </td>
                                        
                                         <td> 
                                         	<a href="<?php echo base_url('administration/color_registration/'.$color_id);?>" class="btn btn-default btn-sm">
          										<span class="fa fa-pencil"></span> Edit                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $color_id;?>','color','color_id');" class="btn btn-default btn-sm">
          										<span class="fa fa-trash"></span> Remove                                            </a>                                            </td>
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
               