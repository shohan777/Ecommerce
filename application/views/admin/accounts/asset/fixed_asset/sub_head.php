<style>
.required{
	color:#f00;
}
</style>
<script type="text/javascript">

function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url($urlname);?>/deleteData/'+tablename+'/'+colid,
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

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
							<li>Fixed Asset Master Head Information</li>
						</ul>

						
				  </div>
</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						     <?php echo form_open('', 'class="form-horizontal form-label-left"');?>
                                   <div class="row">
                                        <div class="col-md-12">
                                        
                                            <!------CONTROL TABS START------>
                                            <ul class="nav nav-tabs bordered" style="margin:10px 10px 10px 10px;">
                                                <li class="active">
                                                    <a href="#list" data-toggle="tab"><i class="entypo-list"></i> Sub Head List</a></li>
                                                <li>
                                                    <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>Add New  </a></li>
                                          </ul>
                                      <!------CONTROL TABS END------>
                                            
                                        
                                            <div class="tab-content">
                                                <!----TABLE LISTING STARTS-->
                                                <div class="tab-pane box active" id="list">
                                                	<?php echo $this->session->flashdata('successMsg');?>
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable datatable-show-all" id="table_export">
                                                        <thead>
                                                            <tr>
                                                              <th width="1%">#</th>
                                                              <th width="23%">Head Title</th>
                                                              <th width="11%"> Code</th>
                                                              <th width="47%"> Details</th>
                                                              <th width="47%"> Master Head</th>
                                                              <th width="18%">Action</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $count = 1;
															foreach($fixed_asset_sub_head_list->result() as $row):
																$title = $row->title;
																$code = $row->code;
																$details = $row->details;
																$master_head= $row->master_head;
																
																$queryMaster = $this->db->query("SELECT * FROM fixed_asset_master_head WHERE famh_id='".$master_head."'");
																$mrow = $queryMaster->row_array();
															?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $title;?></td>
                                                                <td><?php echo $code;?></td>
                                                                <td><?php echo $details;?></td>
                                                                <td><?php echo $mrow['title'];?></td>
                                                                <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                        Action <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                                        
                                                                        <!-- EDITING LINK -->
                                                                        <li><a href="#" data-toggle="modal" data-target="#editModal<?php echo $row->fash_id;?>" style="color:#FF9900">
                                                                        <i class="glyphicon glyphicon-pencil"></i>Edit</a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="javascript:void();" onclick="openPage1('<?php echo $row->fash_id;?>','fixed_asset_sub_head','fash_id');" 
                                                                        style="color:#ff0000"><i class="glyphicon glyphicon-trash"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>                                                                </td>
                                                            </tr>
                                                            <div id="editModal<?php echo $row->fash_id;?>" class="modal fade" role="dialog">
                                                          <div class="modal-dialog">
                                                          <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title" style="width:30%; float:left">Master Head {Edit}</h4>
                                                                <h4 class="modal-title" id="succssMsg" style="float:right; margin-right:1%; width:60%; color:#00CC00"></h4>
                                                              </div>
                                                              <div class="modal-body">
                                                                   <div class="col-sm-11 col-sm-offset-1" style="margin-bottom:30px;">
                                                                         
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Master Head
                                                                            <span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                                <select name="master_head" required class="form-control col-md-7 col-xs-12">
                                                                                    <?php foreach($master_head_list->result() as $mrow):?>
                                                                                    <option value="<?php echo $mrow->famh_id;?>"> <?php echo $mrow->title;?> </option>
                                                                                    <?php endforeach;?>
                                                                                </select>
                                                                             <?php echo form_error('master_head', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Title<span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                                <input type="text" name="title" required class="form-control col-md-7 col-xs-12" 
                                                                                placeholder='Title' value="<?php echo $title; ?>"  onFocus="this.placeholder=''" 
                                                                                onBlur="this.placeholder='Title'" 
                                                                                oninvalid="this.setCustomValidity('Please Enter Title')" oninput="setCustomValidity('')">
                                                                             <?php echo form_error('title', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Code<span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                                <input type="text" name="code" required class="form-control col-md-7 col-xs-12" 
                                                                                placeholder='Code' value="<?php echo $code; ?>"  onFocus="this.placeholder=''" 
                                                                                onBlur="this.placeholder='Code'" 
                                                                                oninvalid="this.setCustomValidity('Please Enter Code')" oninput="setCustomValidity('')">
                                                                             <?php echo form_error('code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Details<span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                                <textarea name="details" class="form-control" placeholder="Details"><?php echo $details; ?></textarea>
                                                                            </div>
                                                                        </div>      
                                                                    </div>
                                                              </div>
                                                              <div class="modal-footer">
                                                                 <input type="hidden" name="fash_id" value="<?php echo $row->fash_id; ?>">
                                                                  <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              </div>
                                                            </div>
                                                          <?php echo form_close();?>                                                          </div>
                                                        </div>
                                                            <?php endforeach;?>
                                                        </tbody>
                                                    </table>
                                              </div>
                                                
                                                <div class="tab-pane box" id="add" style="padding: 5px">
                                                    <div class="box-content">
                                                        <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                                               <div class="col-sm-6 col-sm-offset-2">
                                                               	 <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Master Head
                                                                            <span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                                <select name="master_head" required class="form-control col-md-7 col-xs-12">
                                                                                    <?php foreach($master_head_list->result() as $mrow):?>
                                                                                    <option value="<?php echo $mrow->famh_id;?>"> <?php echo $mrow->title;?> </option>
                                                                                    <?php endforeach;?>
                                                                                </select>
                                                                             <?php echo form_error('master_head', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                            </div>
                                                                        </div>
                                                                 <div class="form-group" style="margin:7px;">
                                                                    <label class="control-label col-md-4 col-sm-4 hidden-xs">Title<span class="required">*</span></label>
                                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                                        <input type="text" name="title" required class="form-control col-md-7 col-xs-12" 
                                                                        placeholder='Title' value="<?php echo set_value('title'); ?>"  onFocus="this.placeholder=''" 
                                                                        onBlur="this.placeholder='Title'" 
                                                                        oninvalid="this.setCustomValidity('Please Enter Title')" oninput="setCustomValidity('')">
                                                                     <?php echo form_error('title', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                    </div>
                                                                </div>
                                                           		 <div class="form-group" style="margin:7px;">
                                                                    <label class="control-label col-md-4 col-sm-4 hidden-xs">Code</label>
                                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                                        <input type="text" name="code" class="form-control col-md-7 col-xs-12" 
                                                                        placeholder='Code' value="<?php echo set_value('code'); ?>"  onFocus="this.placeholder=''" 
                                                                        onBlur="this.placeholder='Code'" 
                                                                        oninvalid="this.setCustomValidity('Please Enter Code')" oninput="setCustomValidity('')">
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group" style="margin:7px;">
                                                                    <label class="control-label col-md-4 col-sm-4 hidden-xs">Details</label>
                                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                                        <textarea name="details" class="form-control" placeholder="Details"></textarea>
                                                                    </div>
                                                                </div>
                                                               
                                                                 <div class="ln_solid"></div>
                            									 <div class="f	orm-group" style="margin:20px;">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                        <input type="reset" class="btn btn-primary" value="Reset">
                                                                        <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                                                    </div>
                                                                </div>                                                            
                                                        </div>
                                                        <?php echo form_close();?>              
                                                    </div>                
                                                </div>
                                                
                                            </div>
                                        </div>
					  </div>
                               <?php echo form_close();?>
					</div>
