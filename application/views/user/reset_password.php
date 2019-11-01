<?php $this->load->view('includes/admin_tophead.php');?>
<div class="main_container">
             <div class="col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4" style="margin-top:10%; background:#fff; padding:20px; border-radius:10px; box-shadow:#f9a51a 0 0 4px 4px">
<a href="<?php echo base_url() ?>"> <center> <img class="img-responsive" src="<?php echo base_url('assets/images/logo.png') ?>" style="margin:0 auto 20px"  alt="logo"> </center> </a>	
	<div class="panel panel-primary">
	
	     <?php echo form_open('mlmuser/resetPasswordAction', array('class'=>'form-horizontal', 'style'=>'margin-bottom: 0px !important;')); ?>

	
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Type Your ID </h4>
						<?php echo $this->session->flashdata('msg');?>
                
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control" id="username" placeholder="Username">
								</div>
							</div>
						</div>				
					
		</div>
		<div class="panel-footer">
			<div class="pull-left">
               <?php echo form_reset('', 'Reset',"class='btn btn-danger'"); ?>
			</div>
            <div class="pull-right">
               <?php echo form_submit('submit', 'Submit',"class='btn btn-warning'"); ?>
			</div>
            
		</div>
		
		</form>
		
		
	</div>
 </div>
</div>
</html>