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
    				<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:justify">
                        <h3 class="headline">Change Password</h3>
                            <div class="row">
                            
                            <div class="col-lg-11 col-lg-offset-1">
                       
                        <?php echo form_open('');?>
                           
                           <div class="form-group" style="margin-bottom:5px; height:30px">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-7">
                                    <?php echo $this->session->flashdata('globalMsg');?>
                                </div>
                           </div>
                           
                           <div class="form-group" style="margin-bottom:5px;">
                                <div class="col-sm-3"><label class="control-label">Old Password :</label></div>
                                <div class="col-sm-7">
                                    <input type="password" name="oldpassword" value="<?php echo set_value('oldpassword');?>" class="form-control" style="margin-bottom:5px;" />
                                     <?php echo form_error('oldpassword','<p class="label label-danger">','</p>'); ?>
                                </div>
                           </div>
                           <div class="form-group" style="margin-bottom:5px;">
                                <div class="col-sm-3"><label class="control-label">newPass :</label></div>
                                <div class="col-sm-7">
                                    <input type="password" name="newPass" value="<?php echo set_value('newPass');?>" class="form-control" style="margin-bottom:5px;" />
                                    <?php echo form_error('newPass','<p class="label label-danger">','</p>'); ?>
                                </div>
                           </div>
                           <div class="form-group" style="margin-bottom:5px;">
                                <div class="col-sm-3"><label class="control-label">Retype- Password :</label></div>
                                <div class="col-sm-7">
                                    <input type="password" name="confirmpassword" value="<?php echo set_value('confirmpassword');?>" class="form-control" style="margin-bottom:5px;"/>
                                    <?php echo form_error('confirmpassword','<p class="label label-danger">','</p>'); ?>
                                </div>
                           </div>
                           
                            <div class="form-group col-sm-10">
                                <input type="submit" name="passwordChange" value="Submit" class="btn btn-primary pull-right"/>
                           </div>
                           
                       <?php echo form_close();?> 
                        </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
