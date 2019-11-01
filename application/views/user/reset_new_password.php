<?php $this->load->view('includes/admin_tophead.php');?>
<div class="main_container">
             <div class="col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4" style="margin-top:10%; background:#fff; padding:20px; border-radius:10px; box-shadow:#f9a51a 0 0 4px 4px">
<a href="<?php echo base_url() ?>"> <center> <img class="img-responsive" src="<?php echo base_url('assets/images/logo.png') ?>" style="margin:0 auto 20px"  alt="logo"> </center> </a>	
	<div class="panel panel-primary">
	
	     <?php echo form_open('mlmuser/resetNewPassword', array('class'=>'form-horizontal', 'style'=>'margin-bottom: 0px !important;')); ?>

	
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Set New Password </h4>
						<?php echo $this->session->flashdata('msg');?>
                
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control" id="password" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
								</div>
							</div>
						</div>				
					
		</div>
		<div class="panel-footer">
			<div class="pull-left">
               <?php echo form_reset('', 'Reset',"class='btn btn-danger'"); ?>
			</div>
            <div class="pull-right">
               <?php echo form_submit('submit', 'Log In',"class='btn btn-warning'"); ?>
			</div>
            
		</div>
		
		</form>
		
		
	</div>
 </div>
</div>
</html>