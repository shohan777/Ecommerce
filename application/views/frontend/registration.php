<style>
.form-control{
	padding:10px;
	font-size:15px;
	color:#000;
	font-weight:bold;
}
</style>
<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
<div class="container">
  <div class="row">
	 <div class="col-md-12">
  			<?php echo form_open('registration/useraction');?>
           	 <div class="col-sm-9 col-sm-offset-2">                            
                             <div class="col-sm-6">
                                <fieldset id="account" style="margin-top:20px;">
                                    <legend style="font-size:18px; font-weight:bold">Your Personal Details</legend>
                                    
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo set_value('fname');?>"  
                                            required style="margin-bottom:5px;" id="firstname" placeholder="First Name"  name="fname">
                                            <?php echo form_error('fname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" required value="<?php echo set_value('lname');?>" 
                                             style="margin-bottom:5px;" id="lastname" placeholder="Last Name"  name="lname">
                                            <?php echo form_error('lname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo set_value('company');?>" 
                                              style="margin-bottom:5px;" id="company" placeholder="Company"  name="company">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <textarea class="form-control"   style="margin-bottom:5px;" id="address" placeholder="Address" 
                                            name="address"><?php echo set_value('address');?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo set_value('country');?>" 
                                              style="margin-bottom:5px;" id="country" placeholder="Country" name="country">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo set_value('city');?>" 
                                              style="margin-bottom:5px;" id="city" placeholder="City" name="city">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo set_value('street');?>" 
                                              style="margin-bottom:5px;" id="street" placeholder="Street" name="street">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control"  value="<?php echo set_value('postcode');?>" 
                                             style="margin-bottom:5px;" id="postcode" placeholder="Post Code"  name="postcode">
                                        </div>
                                    </div>                                
                                    <div class="form-group">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <select name="gender" id="gender" class="form-control"  style="margin-bottom:5px;">
                                            	<option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                             </div>                             
                             <div class="col-sm-6">
                                <fieldset id="account" style="margin-top:20px;">
                                    <legend style="font-size:18px; font-weight:bold">Login Details</legend>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="email" class="form-control" required style="margin-bottom:5px;" 
                                            value="<?php echo set_value('email');?>" id="email" placeholder="E-Mail"  name="email">
                                            <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="tel" class="form-control" value="<?php echo set_value('mobile');?>" 
                                             required style="margin-bottom:5px;" id="mobile" placeholder="Phone"  name="mobile">
                                            <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="password" class="form-control" required value="<?php echo set_value('password');?>" 
                                             style="margin-bottom:5px;" id="password" placeholder="Password"  name="password">
                                            <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="password" class="form-control" required value="<?php echo set_value('confirmpassword');?>" 
                                             style="margin-bottom:5px;" id="confirmpassword" 
                                            placeholder="Password Confirm"  name="confirmpassword">
                                            <?php echo form_error('confirmpassword', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <div class="buttons">
                                    <div class="pull-right" style="text-transform:lowercase">
                                    <div>
                                        <input type="checkbox" value="1" required name="agree"> 
                                        <span style="text-transform:uppercase">I</span>
                                         have read and agree to the <a class="agree" href="<?php echo base_url('content/privacy-policy');?>"><b>Privacy Policy</b></a> and 
                                        <a class="agree" href="<?php echo base_url('content/terms-&-condition');?>"><b>Terms & Condition</b></a>
                                    </div>
                                    <div style="margin-top:30px;">
                                        <button name="savedata" type="submit" class="btn btn-primary" value="Save"
                                         style="font-size:16px; padding:5px; border-radius:5px;"><i class="fa fa-save"></i> Save</button>
                                         <a class="agree" href="<?php echo base_url('login');?>" 
                                         style="text-align:center; float:right; text-transform:capitalize; color:#003399; font-weight:bold">Already Registered ?</a>
                                         </div>
                                    </div>
                                </div>
                             </div>
                            <div class="row"><h2 id="userStatus" style="color:#009900; text-align:center"></h2></div>
                        </div>
            <?php echo form_close();?>
  
  	 </div>
  </div>
</div>
</div>