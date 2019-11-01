<div class="footer_bottom_menu">
	<div class="footerBottomC">
		<ul>
			<?php foreach($footermenu as $fm): ?>
			<li><a href="<?php echo base_url('content/'.$fm->slug);?>">
					<?php echo $fm->menu_name;?> </a></li>
			<?php endforeach; ?>
			<li><a href="<?php echo base_url('contactus');?>">Contact Us</a></li>
			<!-- <li><a href="<?php //echo base_url('content/seller-application');?>">Seller Application</a></li> -->
		</ul>
	</div>
</div>
<div class="row footerarea">

	<div class="container-fluid">
		<div class="row wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="40">
			<div class="col-sm-12 col-xs-12 footer_dektop">
				<div class="col-sm-4 col-xs-12 footer_sec">
					<div class="col-sm-12 col-xs-12">
						<h5 style="margin-left:10%;">Address </h5>
						<div class="footer-address"    style="margin-left:15%;">
							 <p>House# 19, road# 5, Block# A, </p>
							 <p>Mirpur 10, Dhaka , Bangladesh</p>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12" style="margin-top:40px;">
						<div class="col-sm-3 col-xs-3">
						 <h3 class="mobile"> Mobile:</h3>
						</div>
						<div class="col-sm-9 col-xs-9">
							<h2 class="footerphonen" >
								<?php echo $cmob;?>
							</h2>
						</div>
					</div>
				</div>
				<div class="col-sm-4  col-xs-12 footer_sec">
					<div class="col-sm-12">
						<h5 class="footer-title" style="text-align:center;">We Accept</h5>
						<div class="footer-payment wow fadeInDown animated" style="margin-left:130px;" data-wow-delay="1s" data-wow-offset="40">
							<ul style="text-align:center">
								<li class="mastero"><a href="#"><img alt="" src="<?php echo base_url();?>assets/images/payment/bkash.png"></a></li>
								<li class="visa"><a href="#"><img alt="" src="<?php echo base_url();?>assets/images/payment/rocket.png"></a></li>
								<!-- <li class="currus"><a href="#"><img alt="" src="<?php // echo base_url();?>assets/images/payment/currus.png"></a></li>
								<li class="discover"><a href="#"><img alt="" src="<?php //echo base_url();?>assets/images/payment/discover.png"
										 style="width:40px; height:auto"></a></li>
								<li class="bank"><a href="#"><img alt="" src="<?php //echo base_url();?>assets/images/payment/bank.jpg" style="width:40px; height:auto"></a></li>
						 -->
							</ul>
						</div>
					</div>
					<div class="col-sm-12" style="margin-top:60px;">
						<div class="col-sm-12 wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="40">
							<?php echo form_open("index/subscription");?>
							<?php echo form_error('subcribe', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
							<!-- <h5 style="text-align:center">Newsletter</h5> -->
							<div class="footer_input_area" style="margin:0; padding:0">
								<input type="email" class="footer_input-text" placeholder="info@example.com" name="subcribe">
								<button type="submit" value="Subscribe" class="btn btn-md btn-primary subscribebtn">Subscribe</button>

							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<div class="col-sm-4  col-xs-12 footer_sec">
					<div class="content_footercms_right">
						<div class="footer-contact wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="40">
							<div class="footer-social" style="margin-bottom:30px;">
								<h5 style="text-align:center;">Follow Us</h5>
								<ul class="team-social">
									<li><a href="<?php echo $fbook; ?>" target="_blank"><span class="fa fa-facebook"></span></a></li>						 
									<li><a href="<?php echo $instgrm;?>" target="_blank"><span class="fa fa-instagram"></span></a></li>							 
								</ul>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-xs-12 footer_mobile">
				<?php include('footer_res.php');?>
			</div>
		</div>

		<a id="scrollup">Scroll</a> </footer>
		
	</div>
	<div class="footer-bottom">
			<div class="container">
				<div class="copyright" style="float:left">&copy; Copyrighy <?php echo date('Y'); ?>. All right reserved <a class="yourstore" href="http://www.cmsnbd.com/"> Bargainnshop </a> </div>
				<div class="copyright" style="float:right">Design &amp; Develped By &nbsp;<a class="yourstore" href="http://www.cmsnbd.com/"> CMSN Network </a> </div>
			</div>
	</div>

</div>



<script src="<?php echo base_url();?>assets/javascript/parally.js"></script>

<script>
	$('.parallax').parally({
		offset: -40
	});

	$(document).ready(function () {

		$("#phoneshow").hover(function () {
			//$("#phonenum").css({'display': 'block'});
			$("#phonenum").show("slow");
		}, function () {
			//$("#phonenum").css({'display': 'none'});
			$("#phonenum").hide("slow");
		});

	});

</script>

</body>

</html>
