<?php
if($adminUpdate->num_rows()>0){
	foreach($adminUpdate->result() as $adminData);
	$user_id=$adminData->id;
	$username=$adminData->username;
	$contactno=$adminData->contactno;
	$admin_type=$adminData->admin_type;
	$admin_access=$adminData->admin_access;
	$email=$adminData->email;
	$password=$adminData->pass_hints;
	
	if($admin_type == 'Employee'){
			$style='';
		}
		else{
			$style='style="display:none"';		
		}
	$userAccess=explode(',',$adminData->admin_access);
}
else{
	$user_id='';
	$username=set_value('username');
	$contactno='';
	$admin_type='';
	$admin_access='';
	$email=set_value('email');
	$password=set_value('password');
	$userAccess='';
	$style='style="display:none"';
	}
?>
<style>
.required{
	color:#f00;
}
</style>
<script>
function userAccess(){
		var userType = document.getElementById('userRoll').value;
		//alert(userType);
		if(userType=='Precident' || userType=='CEO' || userType=='Country Manager'){
			document.getElementById('user_access').style.display='none';
		}
		else{
			document.getElementById('user_access').style.display='block';	
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
                                    <h2>Admin Registraion Form</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo $this->session->flashdata('successMsg');?>
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><h4 class="panel-title">
                                                   Registration Information </h4></a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                        			    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="username" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Username' value="<?php echo $username; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Username'">
                                             <?php echo form_error('username', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                     				    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contact No.<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="contactno" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Contact No' value="<?php echo $contactno; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Contact No'">
                                            </div>
                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Admin Type<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select name="admintype" class="form-control" id="userRoll" onChange="userAccess();">
                                                                	<option value="<?php $admin_type;?>"><?php $admin_type;?></option>
                                                                    <?php
																		$admininfo=$this->Index_model->getAllItemTable('users','','','admin_type','Precident','id','desc');
																		if($admininfo->num_rows() == 0){
																		?>
																		<option value="Super Admin">Super Admin</option>
																		<?php
																		}															
																	?>
                                                                    <option value="Sub Admin">Sub Admin</option>
                                                                    <option value="Country Manager">Country Manager</option>
                                                                    <option value="Customer Care">Customer Care</option>
                                                                    <option value="Brand Promoter">Brand Promoter</option>
                                                                    <option value="Stock Manager">In Stock Manager</option>
                                                                    <option value="Fenance Officer">Fenance Officer</option>
                                                                    <option value="Delivery Admin">Delivery Admin</option>
                                                                    <option value="Delivery Man">Delivery Man</option>
                                                                    <option value="After sales service">After sales service</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if($adminUpdate->num_rows()>0){?>       
                                                            <div class="form-group" id="user_access" <?php echo $style;?>>
                                                                <label for="focusedinput" class="col-sm-3 control-label">Employee Access</label>                                                                
                                                                <div class="col-sm-3">
                                                                  <input type="checkbox" name="userAccess[]" value="instock_product"
                                                                  <?php if(in_array('instock_product',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Product<br>
                                                                  <input type="checkbox" name="userAccess[]" value="order"
                                                                  <?php if(in_array('order',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Order<br>
                                                                  <input type="checkbox" name="userAccess[]" value="return"
                                                                  <?php if(in_array('return',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Return<br>
                                                                  <input type="checkbox" name="userAccess[]" value="stock"
                                                                   <?php if(in_array('stock',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Stock<br>
                                                                  <input type="checkbox" name="userAccess[]" value="accounts"
                                                                  <?php if(in_array('accounts',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Accounts<br>
                                                                  <input type="checkbox" name="userAccess[]" value="reports"
                                                                  <?php if(in_array('reports',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Reports<br>
                                                                   
                                                                </div>
                                                                <div class="col-sm-3">
                                                                  <input type="checkbox" name="userAccess[]" value="email_message"
                                                                  <?php if(in_array('category',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Email & Message<br>
                                                                  <input type="checkbox" name="userAccess[]" value="customer"
                                                                  <?php if(in_array('category',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Customer List<br>
                                                                  <input type="checkbox" name="userAccess[]" value="category"
                                                                  <?php if(in_array('category',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Product Category<br>
                                                                  <input type="checkbox" name="userAccess[]" value="product_entry"
                                                                  <?php if(in_array('product_entry',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Product Entry<br>
                                                                  <input type="checkbox" name="userAccess[]" value="menu"
                                                                  <?php if(in_array('menu',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Menu<br>
                                                                  <input type="checkbox" name="userAccess[]" value="banner"
                                                                  <?php if(in_array('banner',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Banner<br>
                                                                  <input type="checkbox" name="userAccess[]" value="content"
                                                                  <?php if(in_array('content',$userAccess)){echo "checked";}?>> &nbsp;&nbsp;Content<br>
                                                                </div>
                                                               
                                                                </div>
                                                            <?php }
                                                            else{
                                                            ?>
                                                            <div class="form-group" id="user_access" style="display:none">
                                                                <label for="focusedinput" class="col-sm-3 control-label">Employee Access</label>
                                                               
                                                                <div class="col-sm-3">
                                                                  <input type="checkbox" name="userAccess[]" value="instock_product"> &nbsp;&nbsp;Product<br>
                                                                  <input type="checkbox" name="userAccess[]" value="pre_stock"> &nbsp;&nbsp;Stock<br>
                                                                  <input type="checkbox" name="userAccess[]" value="pre_accounts"> &nbsp;&nbsp;Accounts<br>
                                                                  <input type="checkbox" name="userAccess[]" value="pre_reports"> &nbsp;&nbsp;Finance Reports<br>
                                                                  <input type="checkbox" name="userAccess[]" value="order"> &nbsp;&nbsp;Order<br>
                                                                  <input type="checkbox" name="userAccess[]" value="pre_return"> &nbsp;&nbsp;Return<br>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                  <input type="checkbox" name="userAccess[]" value="email_message"> &nbsp;&nbsp;Email & Message<br>
                                                                  <input type="checkbox" name="userAccess[]" value="customer"> &nbsp;&nbsp;Customer List<br>
                                                                  <input type="checkbox" name="userAccess[]" value="category"> &nbsp;&nbsp;Product Category<br>
                                                                  <input type="checkbox" name="userAccess[]" value="product_entry"> &nbsp;&nbsp;Product Upload<br>
                                                                  <input type="checkbox" name="userAccess[]" value="menu"> &nbsp;&nbsp;Menu<br>
                                                                  <input type="checkbox" name="userAccess[]" value="banner"> &nbsp;&nbsp;Banner<br>
                                                                  <input type="checkbox" name="userAccess[]" value="content"> &nbsp;&nbsp;Content<br>
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="email" name="email" required class="form-control col-md-7 col-xs-12"
                                                                placeholder='Login Email' onFocus="this.placeholder=''" value="<?php echo $email; ?>" onBlur="this.placeholder='Login Email'">
                                                                 <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="password" name="password" required class="form-control col-md-7 col-xs-12" 
                                                                placeholder='Password' onFocus="this.placeholder=''" onBlur="this.placeholder='Password'" 
                                                                value="<?php echo $password; ?>">
                                                                <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="confirmpassword" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Confirm Password' onFocus="this.placeholder=''" onBlur="this.placeholder='Confirm Password'" value="<?php echo $password; ?>">
                                                <?php echo form_error('confirmpassword', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
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
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
               