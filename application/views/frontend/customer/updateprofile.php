<style>
.form-control{
	padding:10px;
	font-size:15px;
	color:#000;
	font-weight:bold;
}
</style>
		<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
			<div class="container" style="margin:20px auto;">
				<div class="col-sm-3">
					<?php include("leftSidebar.php");?>
				</div>
				<div class="col-sm-9" style="background:#f5f5f5"> 
                	<?php echo form_open_multipart('');
						echo $this->session->flashdata('successMsg');
						?>               		
                        <div class="col-sm-10 col-sm-offset-1">                            
                             <div class="col-sm-6">
                                <fieldset id="account" style="margin-top:20px;">
                                    <legend style="font-size:18px; font-weight:bold">Your Personal Details</legend>
                                    
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo $userProfile['fname'];?>"  
                                            required style="margin-bottom:5px;" id="firstname" placeholder="First Name"  name="fname">
                                            <?php echo form_error('fname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" required value="<?php echo $userProfile['lname'];?>" 
                                             style="margin-bottom:5px;" id="lastname" placeholder="Last Name"  name="lname">
                                            <?php echo form_error('lname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo $userProfile['company'];?>" 
                                              style="margin-bottom:5px;" id="company" placeholder="Company"  name="company">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <textarea class="form-control"   style="margin-bottom:5px;" id="address" placeholder="Address" 
                                            name="address"><?php echo $userProfile['address'];?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo $userProfile['country'];?>" 
                                              style="margin-bottom:5px;" id="country" placeholder="Country" name="country">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo $userProfile['city'];?>" 
                                              style="margin-bottom:5px;" id="city" placeholder="City" name="city">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control" value="<?php echo $userProfile['thana'];?>" 
                                              style="margin-bottom:5px;" id="street" placeholder="Street" name="street">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="text" class="form-control"  value="<?php echo $userProfile['zipcode'];?>" 
                                             style="margin-bottom:5px;" id="postcode" placeholder="Post Code"  name="postcode">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="file" name="photo" class="form-control" style="margin-bottom:5px;"/>
                                            <?php
                                            	if($userProfile['photo']!=""){
													echo '<img src="'.base_url('uploads/images/customer/'.$userProfile['photo']).'" style="width:100px; height:auto" />';
												}
											?>
                                            
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
                                            value="<?php echo $userProfile['email'];?>" id="email" placeholder="E-Mail"  name="email">
                                            <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                            <input type="tel" class="form-control" value="<?php echo $userProfile['mobile'];?>" 
                                             required style="margin-bottom:5px;" id="mobile" placeholder="Phone"  name="mobile">
                                            <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                    </div>                                   
                                </fieldset>
                                
                                <div class="form-group required">
                                        <div class="col-sm-11" style="padding:0; margin:0">
                                         <input type="hidden" name="stillimg" value="<?php echo $userProfile['photo']; ?>">
                                    	 <input type="submit" name="editProfile" class="btn btn-success pull-right" value="Update"
                                         style="font-size:18px; padding:7px 15px; border-radius:5px;"/>   
                                     </div>
                                </div>
                             </div>                            
                        </div>
                   <?php echo form_close();?> 
                        
				</div>

			</div>
		</div>
