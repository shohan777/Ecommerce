<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Change Password</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');
									echo $this->session->flashdata('globalMsg');
								?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Password Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                        <div class="form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Old Password</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="oldpassword" 
                                          value="<?php echo set_value('oldpassword'); ?>" id="disabledinput" placeholder="Old Password" />
                                        </div>
                                        <div class="col-sm-3">
                                            <?php echo form_error('oldpassword','<p class="label label-danger">','</p>'); ?>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label for="focusedinput" class="col-sm-3 control-label">Password</label>
                                            <div class="col-sm-6">
                                              <input type="password" class="form-control" style="margin:10px 0" name="password" value="<?php echo set_value('password'); ?>"  
                                              placeholder="xxxxx">
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo form_error('password','<p class="label label-danger">','</p>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Confirm Password</label>
                                        <div class="col-sm-6">
                                          <input type="password" class="form-control" style="margin:0px 0 10px 0"  name="confirmpassword" 
                                          value="<?php echo set_value('confirmpassword'); ?>" placeholder="xxxxx">
                                        </div>
                                        <div class="col-sm-3">
                                            <?php echo form_error('confirmpassword','<p class="label label-danger">','</p>'); ?>
                                        </div>
                                    </div>
                                        <div class="col-sm-8 col-sm-offset-3">
                                        
                                            <input type="submit" name="changePassword" value="Change" class='btn btn-success' />
                                        </div>
                                        
                            			</div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
               