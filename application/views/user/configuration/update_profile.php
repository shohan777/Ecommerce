<?php
if($mlm_usersUpdate->num_rows()>0){
	foreach($mlm_usersUpdate->result() as $mlm_users);
			$mlm_usersId=$mlm_users->user_id;
			$fullname=$mlm_users->fullname;
			$fname=$mlm_users->fname;
			$mname=$mlm_users->mname;
			$code=$mlm_users->code;
			$pre_address=$mlm_users->pre_address;
			$per_address=$mlm_users->per_address;
			$postal=$mlm_users->postal;
			$nid=$mlm_users->nid;
			$dob=$mlm_users->dob;
			$account=$mlm_users->account;
			$account_no=$mlm_users->account_no;
			$entry_product=$mlm_users->entry_product;
			$password=$mlm_users->password;
			$activation=$mlm_users->activation;
			$mobile=$mlm_users->mobile;
			$district=$mlm_users->district;
			$email=$mlm_users->email;
			$gender=$mlm_users->gender;
}
else{
			$mlm_usersId='';
			$fullname=set_value('fullname');
			$fname=set_value('fname');
			$mname=set_value('mname');
			$code=set_value('code');
			$pre_address=set_value('pre_address');
			$per_address=set_value('per_address');
			$postal=set_value('postal');
			$nid=set_value('nid');
			$dob = set_value('mobile');	
			$account=set_value('mobile');
			$account_no=set_value('mobile');
			$entry_product=set_value('mobile');
			$mobile=set_value('mobile');
			$district='';
			$email=set_value('email');
			$gender='';
			$photo='';
	}
?>

<div class="right_col" role="main">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Customer Registration Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                  
                                  	  <div class="panel-group" id="accordion">
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                 <h4 class="panel-title">
                                                   Personal Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                 <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Customer Name: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="fullname" id="fullname" class="form-control" type="text"  
                                                        required="required" value="<?php echo $fullname; ?>"/>
                                                        <?php echo form_error('fullname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12"> Father's Name: </label>
                                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                            <input name="fname" id="fname" class="form-control" type="text"  
                                                            required="required" value="<?php echo $fname; ?>"/>
                                                            <?php echo form_error('fname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                            </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Mother's Name: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="mname" id="mname" class="form-control" type="text"  
                                                        required="required" value="<?php echo $mname; ?>"/>
                                                        <?php echo form_error('mname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12"> Mobile: </label>
                                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                            <input name="mobile" id="mobile" type="text" class="form-control" required="required"
                                                             value="<?php echo $mobile; ?>"/>
                                                            <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                            </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> District: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                       <select name="district" id="district" class="form-control" required >                                               
                                                        <option value="<?php echo $district;?>"><?php echo $district;?></option>
                                                        <?php
                                                        foreach($countryAll->result() as $row){
                                                        $country_name=$row->name;
                                                        $country_id=$row->location_id;
                                                        ?>
                                                        <option value="<?php echo $country_id; ?>"><?php echo ucfirst($country_name); ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                        </div>
                                                  </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12"> Postal Code: </label>
                                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                            <input name="postal" id="postal" type="text" class="form-control" value="<?php echo $postal; ?>"/>
                                                            </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Present Address : </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <textarea name="pre_address" class="form-control" placeholder="Present Address"><?php echo $pre_address;?></textarea>
                                                        </div>
                                                  </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Permanent Address : </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <textarea name="per_address" class="form-control" placeholder="Permanent Address"><?php echo $per_address;?></textarea>
                                                        </div>
                                                  </div>
                                                    
                                                </div>
                                          	   		<div class="col-sm-6">
                                                 <div class="form-group">        
                                                    <label class="control-label col-sm-3">Gender <span style="color:#ff0000">*</span></label>
                                                       <label class="control-label">Male &nbsp;</label><input type="radio" name="gender" value="Male"  />&nbsp;&nbsp;&nbsp;
                                                      <label class="control-label">Female &nbsp;</label><input type="radio" name="gender" value="Female"  />             
                                                    </div>
                                                 
                                             	 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> DOB: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="dob" id="dob" type="text" class="form-control datepicker"
                                                         value="<?php echo $dob; ?>"/>
                                                        </div>
                                                  </div>
                                                 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> NID: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="nid" id="nid" type="text" class="form-control" required
                                                         value="<?php echo $nid; ?>"/>
                                                        <?php echo form_error('nid', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                   <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Account: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <select name="account" class="form-control">
                                                        	<option value="Bank">Bank</option>
                                                            <option value="bKash">bKash</option>
                                                            <option value="BBL">BBL</option>
                                                            <option value="CBL">CBL</option>
                                                            <option value="DBBL">DBBL</option>
                                                            <option value="SIBL">SIBL</option>
                                                            <option value="Rocket">Rocket</option>
                                                            <option value="mCash">mCash</option>
                                                            <option value="uCash">uCash</option>
                                                        </select>
                                                        </div>
                                                  </div>
                                  				 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Account No.: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="account_no" id="account_no" class="form-control"  type="text"  required="required" 
                                                        value="<?php echo $account; ?>"/>
                                                        <?php echo form_error('account_no', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Email: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="email" id="email" class="form-control"  type="email"  required="required" 
                                                        value="<?php echo $email; ?>" placeholder="Email Address"/>
                                                        <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                
                                			</div>
                                            		</div>
                          						</div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
               
               
               <script type="text/javascript">
                        $(document).ready(function () {
							//alert('dfd');
                            $('.datepicker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>