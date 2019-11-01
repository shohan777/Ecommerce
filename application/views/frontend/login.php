<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
<div class="container">
  <div class="row">
	 <div class="col-md-12" style="margin:10% 0">
  		<?php echo form_open('login/userLogin');?>
                <div class="col-sm-6">
                 <?php echo $this->session->flashdata('invalidmsg');?>
                  <div class="form-group col-sm-12 col-md-12 col-lg-12">  
                      <div class="col-sm-3 col-md-3 col-lg-3"><label class="control-label">Email</label></div> 
                         <div class="col-sm-8 col-md-8 col-lg-8">  
                         <input name="email" id="email" class="form-control" style="padding:10px;" type="text"  required="required" 
                         value="<?php echo set_value('email'); ?>" placeholder="Email Address Or Mobile No."/></div>
                            <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                        </div>
                  <div class="form-group col-sm-12 col-md-12 col-lg-12">  
                  <div class="col-sm-3 col-md-3 col-lg-3"> <label class="control-label">Password</label></div> 
                     <div class="col-sm-8 col-md-8 col-lg-8">  
                     <input name="password" id="password" class="form-control" style="padding:10px;" type="password"  
                     required="required" value="<?php echo set_value('password'); ?>" placeholder="Password"/></div>
                        <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                    </div>                                         
                  <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-3">
                     <a class="agree" href="<?php echo base_url('registration');?>" 
                     style="text-align:left; text-transform:capitalize; color:#003399; font-weight:bold">New Customer ?</a>
                    </div>
                    <div class="col-sm-3">
                    <input name="login" id="login" type="submit" value="Login" class="btn btn-primary"  style="float:right; margin-right:8px;"  /></div>
                </div>
             </div>
        <?php echo form_close();?>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <div style="width:100%;"><h4 style="text-align:center; margin-bottom:5%; font-weight:bold">-------- OR --------</h4></div>
            <div class="col-sm-6">
                
                <?php
					if(!empty($authURL)) {
						echo '<a href="'.$authURL.'"><img src="'.base_url("assets/images/fblogin.png").'" style="width:100%; height:auto; margin-bottom:5px;" /></a>';
					}else{
					?>
					<div class="wrapper">
						<h1>Facebook Profile Details </h1>
						<div class="welcome_txt">Welcome <b><?php echo $userData['first_name']; ?></b></div>
						<div class="fb_box">
							<div style="position: relative;">
								<img src="<?php echo $userData['cover']; ?>" />
								<img style="position: absolute; top: 90%; left: 45%;" src="<?php echo $userData['picture']; ?>"/>
							</div>
							<p><b>Facebook ID : </b><?php echo $userData['oauth_uid']; ?></p>
							<p><b>Name : </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
							<p><b>Email : </b><?php echo $userData['email']; ?></p>
							<p><b>Gender : </b><?php echo $userData['gender']; ?></p>
							<p><b>Locale : </b><?php echo $userData['locale']; ?></p>
							<p><b>You are login with : </b>Facebook</p>
							<p><b>Profile Link : </b><a href="<?php echo $userData['link']; ?>" target="_blank">Click to visit Facebook page</a></p>
							<p><b>Logout from <a href="<?php echo $logoutURL; ?>">Facebook</a></b></p>
						</div>
					</div>
					<?php } ?>
            </div>
            
            
            <!--<div class="col-sm-6">
                <a href="<?php //echo $loginURL; ?>"><img src="<?php echo base_url("assets/images/googlelogni.png");?>" style="width:100%; height:auto" /></a>
            </div>-->
            
          <?php /*?> <?php if(isset($userData) && $userData!=""){?>
            <div class="wrapper">
                <div class="welcome_txt">Welcome <b><?php echo $userData['first_name']; ?></b></div>
                <div class="fb_box">
                    <p class="image"><img src="<?php echo $userData['picture_url']; ?>" alt="" width="300" height="220"/></p>
                    <p><b>Facebook ID : </b><?php echo $userData['oauth_uid']; ?></p>
                    <p><b>Name : </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
                    <p><b>Email : </b><?php echo $userData['email']; ?></p>
                    <p><b>Gender : </b><?php echo $userData['gender']; ?></p>
                    <p><b>Locale : </b><?php echo $userData['locale']; ?></p>
                    <p><b>You are login with : </b>Facebook</p>
                    <p><a href="<?php echo $userData['profile_url']; ?>" target="_blank">Click to Visit Facebook Page</a></p>
                    <p><b>Logout from <a href="<?php echo $logoutUrl; ?>">Facebook</a></b></p>
                </div>
            </div>
    		<?php } ?>
    <?php */?>
        </div>
  
  	 </div>
  </div>
</div>
</div>