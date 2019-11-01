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
			$address=$mlm_users->address;
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
			$address=set_value('address');
			$photo='';
	}

?>

<script type="text/javascript">
  function checkBalance(){
    var totalbalance = $("#totalbalance").val();
    var unit_price = $("#unit_price").val();
    var reg_form = document.getElementById("reg-form");
    if(parseInt(totalbalance) < parseInt(unit_price)){
        //alert(totalbalance);
       //$("#submit").css('display','none');
       alert("You don't have sufficient balance");
       return false;
       
    }
    else{
      //$("#submit").css('display','inline');
      // document.form.submit();
      // reg_form.submit();
      return true;
    }
  }
</script>
<div class="right_col" role="main">

                    <div class="page-title">
                        <div class="title_left">
                            <h3 style="width: 40%; float: left;">Customer Registration Details</h3>
                            <h3 style="width: 40%; float: right;">
                              Total Balance: <?php echo $commission['wallet'];?> BDT 
                              <input type="hidden" id="totalbalance" value="<?php echo $commission['wallet'];?>"></h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <?php echo form_open_multipart('', array('id'=> 'reg-form', 'class'=>"form-horizontal form-label-left", 'onsubmit'=> 'return checkBalance()'));?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Product Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                <div class="col-sm-6">
                                                 
                                                 <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Product Name: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" name="pro_id" id="pro_id" onKeyUp="getProduct();" class="form-control" />
                                                    <input type="hidden" id="products_id" name="sale_product_id" />                                        
                                                    <div id="prodlist"></div>
                                                    </div>
                                              </div>
                                                  <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Product Code: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="pro_code" id="pro_code" class="form-control col-md-7 col-xs-12" type="text" readonly="readonly"/>
                                                        </div>
                                                  </div>
                                                  
                                			</div>
                                          	    <div class="col-sm-6">
                                                
                                                 
                                             	 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Product Price: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="unit_price" id="unit_price" class="form-control col-md-7 col-xs-12" type="text" readonly="readonly"/>
                                                        </div>
                                                  </div>
                                                 
                                                  
                                                  
                                			</div>
                          						</div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                 <h4 class="panel-title">
                                                   Customer Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                <div class="col-sm-6">
                                                 
                                                 <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Customer Name: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="fullname" id="fullname" class="form-control col-md-7 col-xs-12" type="text"  
                                                    required="required" value="<?php echo $fullname; ?>"/>
                                                    <?php echo form_error('fullname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                              </div>
                                              <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Customer ID: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="code" id="code" class="form-control col-md-7 col-xs-12" type="text"  readonly="readonly" 
                                                    required="required" value="<?php echo $cutomercode; ?>"/>
                                                    <?php echo form_error('code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                              </div>
                                                  <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Father's Name: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="fname" id="fname" class="form-control col-md-7 col-xs-12" type="text"  
                                                       value="<?php echo $fname; ?>"/>
                                                        </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Mother's Name: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="mname" id="mname" class="form-control col-md-7 col-xs-12" type="text"  
                                                  value="<?php echo $mname; ?>"/>
                                                    </div>
                                              </div>
                                             	 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Mobile: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="mobile" id="mobile" type="text" class="form-control col-md-7 col-xs-12"
                                                         value="<?php echo $mobile; ?>"/>
                                                        </div>
                                                  </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> District: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                   <select name="district" id="district" class="form-control col-md-7 col-xs-12"  >                                               
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
                                                        <input name="postal" id="postal" type="text" class="form-control col-md-7 col-xs-12" 
                                                         value="<?php echo $postal; ?>"/>
                                                        </div>
                                                  </div>
                                  				 <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Present Address : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <textarea name="pre_address" class="form-control col-md-7 col-xs-12" placeholder="Present Address"><?php echo $pre_address;?></textarea>
                                                    </div>
                                              </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Permanent Address : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <textarea name="per_address" class="form-control col-md-7 col-xs-12" placeholder="Permanent Address"><?php echo $address;?></textarea>
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
                                                        <input name="nid" id="nid" type="text" class="form-control"
                                                         value="<?php echo $nid; ?>"/>
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
                                                        <input name="account_no" id="account_no" class="form-control col-md-7 col-xs-12"  type="tempnam("  required="required" 
                                                        value="<?php echo $account_no; ?>"/>
                                                        <?php echo form_error('account_no', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Email: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="email" id="email" class="form-control col-md-7 col-xs-12"  type="text"
                                                        value="<?php echo $email; ?>" placeholder="Email Address"/>
                                                        <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                 <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Password: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input name="password" id="password" class="form-control col-md-7 col-xs-12"  type="password"  required="required"
                                                         value="<?php echo set_value('password'); ?>" placeholder="Password : xxxxxxxx"/>
                                                        <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                  </div>
                                                  
                                                  <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Status: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <select name="activation" class="form-control">
                                                        	<option value="1">Active</option>
                                                            <option value="0">Inactive</option>                                                           
                                                        </select>
                                                        </div>
                                                  </div>

												<div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Placement Id: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                         <input type="text" name="place_id" id="place_id" value="<?php echo $defRef;?>" 
                                                         onKeyUp="getMlmUser('place_id','placement_id','placelist');" class="form-control" />
                                                        <input type="hidden" id="placement_id" value="<?php echo $defRefId;?>" name="placement_id"/>                                        
                                                        <div id="placelist"></div>
                                                    
                                                        </div>
                                                  </div>
                                                  <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Referece Id: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                         <input type="text" name="ref_id" id="ref_id" value="<?php echo $defRef;?>" 
                                                         onKeyUp="getMlmUser('ref_id','reference_id','reflist');" class="form-control" />
                                                        <input type="hidden" value="<?php echo $defRefId;?>" id="reference_id"  name="reference_id"/>                                                                             
                                                        <div id="reflist"></div>
                                                    
                                                        </div>
                                                  </div>

                                                  <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Team: </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <select name="team" class="form-control" onchange="checkPlacementExist(this.options[this.selectedIndex].value)">
                                                          <option value="team">Select Team</option>
                                                          <option value="a">Team A</option>
                                                            <option value="b">Team B</option>                                                           
                                                        </select>
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
                                            <input type="hidden" name="mlm_users_id" value="<?php echo $mlm_usersId; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" id="submit" name="registration" class="btn btn-success" value="Submit">
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

                        function checkPlacementExist(team) {
                            var place_id = document.getElementById("placement_id").value;

                            if(place_id == '') {
                                alert("Please select the placement");
                            } else {

                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url()?>mlmuser/checkPlacementExists",
                                    data: ({place_id: place_id, team:team}),

                                    success: function(response)
                                    {
                                        if(response != '0') {
                                            alert('Already exists');
                                            document.getElementById("placement_id").value = '';
                                            document.getElementById("place_id").value = '';
                                        } else {
                                            alert('Ok');
                                        }
                                    }          
                                });
                            }
                            
                        }
                </script>