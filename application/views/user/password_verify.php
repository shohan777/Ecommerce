<?php $this->load->view('includes/admin_tophead.php');?>
<div class="main_container">
             <div class="col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4" style="margin-top:10%; background:#fff; padding:20px; border-radius:10px; box-shadow:#f9a51a 0 0 4px 4px">
<a href="<?php echo base_url() ?>"> <center> <img class="img-responsive" src="<?php echo base_url('assets/images/logo.png') ?>" style="margin:0 auto 20px"  alt="logo"> </center> </a>	
	<div class="panel panel-primary">
	
	     <?php echo form_open('mlmuser/userLogin', array('class'=>'form-horizontal', 'style'=>'margin-bottom: 0px !important;')); ?>

	
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Verification </h4>
				<?php echo $this->session->flashdata('msg');?>
        
				<div class="form-group">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" name="username" class="form-control" id="username" placeholder="Username">
						</div>
					</div>
					<span>Type your verification code here</span>
				</div>	
		</div>
		<div class="panel-footer">
			<div class="pull-left">
               <?php echo form_reset('', 'Reset',"class='btn btn-danger'"); ?>
			</div>
            <div class="pull-right">
               <a href="#" class="btn btn-warning" onclick="verification()">Submit</a>
			</div>
            
		</div>
		
		</form>
		
		
	</div>
 </div>
</div>
<script>
	function verification()
	{
		
		var verify_code = document.getElementById('username').value;
		$.ajax({
		type: "POST",
		url: "<?php echo base_url()?>mlmuser/resetPasswordVerification",
		data: ({verify_code: verify_code}),
		dataType: 'json',
		success: function(response)
		{
			
			if(response) {
				if(response['msg'] == "okDone") {
					alert("Success");
					window.location.href = response.redirect;
				} else {
					alert("Wrong Verification Code");
				}
			}

		}          
	});
	}
</script>
</html>