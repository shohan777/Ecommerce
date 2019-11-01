<script src="<?php echo base_url();?>assets/mainslider/sliderengine/amazingslider.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/mainslider/sliderengine/amazingslider-1.css">

<script src="<?php echo base_url();?>assets/mainslider/sliderengine/initslider-1.js"></script>

<div id="amazingslider-wrapper-1" style="display:block;position:relative;margin:0px auto 0px;">
	<div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
		<ul class="amazingslider-slides" style="display:none;">
			<?php 
			$i=0;
			foreach($bannerslider->result() as $banner):
				$image=$banner->image;
				$banner_name1=$banner->banner_name;
				if($i==0){
					$class='banner-image tab-content';
				}
				else{
					$class='banner-image tab-content fk-hidden';	
				}
			?>
			<li>
				<a href=" ">
					<img src="<?php echo base_url('uploads/images/banner/'.$image)?>" style="width:100%; height:auto" />
				</a>
			</li>

			<?php 
				$i++;
				endforeach;
			?>
		</ul>

	</div>
</div>
