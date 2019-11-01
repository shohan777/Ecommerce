<?php
if($customerUpdate->num_rows()>0){
	foreach($customerUpdate->result() as $customer);
			$customerId=$customer->user_id;
			$fname=$customer->fname;
			$lname=$customer->lname;
			$company=$customer->company;
			$mobile=$customer->mobile;
			$email=$customer->email;
			$gender=$customer->gender;
			$address=$customer->address;
			$zipcode=$customer->zipcode;
			$country=$customer->country;
			$city=$customer->city;
			$street=$customer->thana;
			$password=$customer->password;
			$passwordHints=$customer->passwordHints;
			$photo=$customer->photo;
}
else{
			$customerId='';
			$fname= set_value('fname');
			$lname= set_value('lname');
			$company= set_value('company');
			$mobile=set_value('mobile');
			$email=set_value('email');
			$gender=set_value('gender');
			$address=set_value('address');
			$zipcode= set_value('postcode');
			$country= set_value('country');
			$city=set_value('city');
			$street=set_value('street');
			$password=set_value('password');
			$passwordHints=set_value('password');
			$photo='';
	}
?>
<script>
function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
		document.getElementById("showhideicon").innerHTML = "<i class='fa fa-eye-slash'></i>";
		x.value = "<?php echo $passwordHints;?>";
    } else {
        x.type = "password";
		document.getElementById("showhideicon").innerHTML = "<i class='fa fa-eye'></i>";
		x.value = "<?php echo $password;?>";
    }
}
</script>
<div class="right_col" role="main">

                    
                    <div class="clearfix"></div>
                    <div class="row">


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div class="col-sm-10 col-sm-offset-1">                            
                                     <div class="col-sm-6">
                                        <fieldset id="account" style="margin-top:20px;">
                                            <legend style="font-size:18px; font-weight:bold">Your Personal Details</legend>
                                            
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="text" class="form-control" value="<?php echo $fname;?>"  
                                                    required style="margin-bottom:5px;" id="firstname" placeholder="First Name"  name="fname">
                                                    <?php echo form_error('fname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="text" class="form-control" required value="<?php echo $lname;?>" 
                                                     style="margin-bottom:5px;" id="lastname" placeholder="Last Name"  name="lname">
                                                    <?php echo form_error('lname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                            </div>    
                                            <div class="form-group">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="text" class="form-control" value="<?php echo $company;?>" 
                                                      style="margin-bottom:5px;" id="company" placeholder="Company"  name="company">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <textarea class="form-control"   style="margin-bottom:5px;" id="address" placeholder="Address" 
                                                    name="address"><?php echo $address;?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="text" class="form-control" value="<?php echo $country;?>" 
                                                      style="margin-bottom:5px;" id="country" placeholder="Country" name="country">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="text" class="form-control" value="<?php echo $city;?>" 
                                                      style="margin-bottom:5px;" id="city" placeholder="City" name="city">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="text" class="form-control" value="<?php echo $street;?>" 
                                                      style="margin-bottom:5px;" id="street" placeholder="Street" name="street">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="text" class="form-control"  value="<?php echo $zipcode;?>" 
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
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                     <input type="file" name="photo" class="form-control" style="margin-bottom:5px;"/>
												<?php
                                                    if($photo!=""){
                                                        echo '<img src="'.base_url('uploads/images/customer/'.$photo).'" style="width:100px; height:auto" />';
                                                    }
                                                ?>
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
                                                    value="<?php echo $email;?>" id="email" placeholder="E-Mail"  name="email">
                                                    <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="tel" class="form-control" value="<?php echo $mobile;?>" 
                                                     required style="margin-bottom:5px;" id="mobile" placeholder="Phone"  name="mobile">
                                                    <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="col-sm-11" style="padding:0; margin:0">
                                                	<div  class="col-sm-11" style="padding:0; margin:0">
                                                    <input type="password" class="form-control" required value="<?php echo $password;?>" 
                                                     style="margin-bottom:5px;" id="password" placeholder="Password"  name="password">
                                                    <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                                    <div  class="col-sm-1">
                                                    <a href="javascript:void()" onclick="showPassword()" style="font-size:18px;" id="showhideicon"><i class="fa fa-eye"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        </fieldset>
                                        
                                     </div>
                                </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input type="hidden" name="customer_id" value="<?php echo $customerId; ?>">
                                            <input type="hidden" name="stillimg" value="<?php echo $photo; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
               