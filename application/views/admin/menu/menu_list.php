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
                                    <h2 style="float:left">Total menu (<?php echo $menu_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('administration/menu_registration');?>" class="btn btn-primary">New Menu</a></h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th>SI</th>
                                        <th>Menu Name</th>
                                        <th>Parent Menu</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($menu_list->result() as $menuData):
									$m_id=$menuData->m_id;
									$menuTitle=$menuData->menu_name;
									$root_id=$menuData->root_id;

									$query=$this->db->query("select * from menu where m_id='".$root_id."'");
									if($query->num_rows() > 0){
										foreach($query->result() as $pmenu);
										$parentmenu = $pmenu->menu_name;
									}
									else{
										$parentmenu = '';
									}
									$i++;
									
									
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $menuTitle; ?></td>
                                        <td><?php echo $parentmenu; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('administration/menu_registration/'.$m_id);?>" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-edit"></span> Edit
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $m_id;?>','menu','m_id');" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-remove-circle"></span> Remove
                                            </a>
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
               