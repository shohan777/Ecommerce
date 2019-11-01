<script type="text/javascript">
	function removeWishlist(proid) {
		var b = window.confirm('Are you sure ? You want to remove this product from your wishlist');
		if (b == true) {
			$.ajax({
				type: "GET",
				url: '<?php echo base_url()?>index/removeWishlistProduct/',
				data: "wid=" + proid,
				success: function () {
					alert("Successfully Removed");
					window.location.reload(true);
				},
				error: function () {
					alert("There was an error. Try again please!");
				}
			});
		} else {
			return;
		}

	}

	function getSizeValue(thisvalue, id) {
		$('.thissizeclass').css('opacity', '1');
		$('#getSize').val(thisvalue);
		$("#thissize" + id).css('opacity', '0.2');

	}

	function getColorValue(thisvalue, id) {
		$('.thisclass').css('opacity', '1');
		$('#getColor').val(thisvalue);
		$("#thisid" + id).css('opacity', '0.2');
	}

	function getSizeValue1(thisvalue, i, k) {
		$('.thissizeclass1').css('opacity', '1');
		$('#getSize1' + i).val(thisvalue);
		$("#thissize1" + i + k).css('opacity', '0.2');

	}

	function getColorValue1(thisvalue, i, j) {
		$('.thisclass1').css('opacity', '1');
		$('#getColor1' + i).val(thisvalue);
		$("#thisid1" + i + j).css('opacity', '0.2');
	}

</script>
<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
	<div class="container" style="margin:20px auto;">
		<div class="gallerypage" style="float:left">
			<div class="row" id="content">
				<div class=" col-sm-12 col-xs-12">
					<div class="row">
						<div class="grid-list-wrapper">
							<?php 
            if($productgallery->num_rows() > 0){
                $i=0;
                foreach($productgallery->result() as $gallery):
                  $product_id=$gallery->product_id;
                  $slug=$gallery->slug;
                  $product_name=$gallery->product_name;
                  $thumb=$gallery->thumb;
                  $prosummery=$gallery->details;
                  $discount=$gallery->discount;
                  $dis_type=$gallery->dis_type;
                  $ptotalprice=$gallery->price;
                  $color=$gallery->color;
                  $size=$gallery->size;
                  
                   if(isset($discount) && $discount > 0){
                    if(isset($dis_type) && $dis_type=='%'){
                        $disamount = ($ptotalprice*$discount)/100;
                        $pro_price = $ptotalprice - $disamount;
                        $prodiscount = $discount.''.$dis_type.' ( '.$disamount.' Tk )';
                    }
                    elseif(isset($dis_type) && $dis_type=='Tk'){
                        $pro_price = $ptotalprice - $discount;
                        $prodiscount = $discount.''.$dis_type;
                    }
                    else{
                        $pro_price = $ptotalprice;
                        $prodiscount = '';
                    }
                  }
                  else{
                     $pro_price = $ptotalprice;
                     $prodiscount = '';
                  }
                              
                  $i++;
        
                  echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
							<input type="hidden" value="<?php echo $product_id;?>" name="id" />
							<input type="hidden" value="<?php echo $product_name;?>" name="name" />
							<input type="hidden" value="<?php echo $pro_price;?>" name="price" />

							<div class="col-sm-3 col-xs-12" style="padding:0; margin:0">
								<div class="product_grid_view" id="girdview<?php echo $product_id;?>" onmouseover="cartHoverEffect(<?php echo $product_id;?>);">
									<div class="product_thumb_area">
										<div class="pro_img">
											<a href="<?php echo base_url();?>products/<?php echo $slug;?>">
												<img src="<?php echo base_url()?>uploads/images/product/main_img/thumnail/<?php echo $thumb;?>" alt="<?php echo $product_name;?>"
												 title="<?php echo $product_name;?>" />
											</a>
										</div>
										<div style="display:none" class="wish_cart_area" id="wisharea<?php echo $product_id;?>">
											<?php 
                                if(!$this->session->userdata('userAccessId')){?>
											<a title="Add to Wishlist" class="heart" href="<?php echo base_url('login');?>"> <i class="fa fa-heart-o"></i>
											</a>
											<?php
												}
												else{
														$customerId = $this->session->userdata('userAccessId');
														$wishlistquery = $this->Index_model->db->query("select * from customer_wishlist where customer_id='".$customerId."' 
														and product_id='".$product_id."'");
														if($wishlistquery->num_rows() > 0){
														foreach($wishlistquery->result() as $wishval);
												?>
											<a href="javascript:void();" onclick="removeWishlist(<?php echo $wishval->wid;?>);" class="heart" title="This product already in listed your wishlist"
											 style="color:#009900"> <i class="fa fa-heart" aria-hidden="true"></i> </a>
											<?php
													}
													else{
												?>
											<a href="<?php echo base_url();?>index/wishlistProduct/<?php echo $product_id;?>" class="heart" title="Add to Wishlist">
												<i class="fa fa-heart-o"></i> </a>
											<?php	
														}
												}
												?>
											<button type="submit" class="addtocart" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
										</div>
										<div class="pro_details_area">
											<?php if($color!=""){?>
											<ul style="margin: 0; padding:5px;">
												<?php 
														$k= 0;
														$proColor = explode(',',$color);
														foreach($proColor as $proCol):
														$k++;
												?>
												<li style="width:20px; height:20px; display:inline; text-align:center; margin:0; background:<?php echo $proCol;?>; cursor:pointer"
												 onclick="getColorValue1('<?php echo $proCol;?>','<?php echo $i;?>','<?php echo $k;?>')" id="thisid1<?php echo $i;?><?php echo $k;?>"
												 class="thisclass1">
													&nbsp;&nbsp;&nbsp;</li>
												<?php endforeach;?>
												<input type="hidden" name="procolor1" id="getColor1<?php echo $i;?>" />
											</ul>
											<?php } ?>
											<?php if($size!=""){?>
											<ul style="margin: 0; padding:5px;">
												<?php 
															$j=0;
															$proSize = explode(',',$size);
															foreach($proSize as $proSz):
															$j++;
													?>
												<li style=" width:20px; height:20px; display:inline; border:1px solid #ccc; font-size:12px; 
                                    background:#f5f5f5; font-weight:bold; padding:5px; text-align:center; margin:0; cursor:pointer"
												 onclick="getSizeValue1('<?php echo $proSz;?>','<?php echo $i;?>','<?php echo $j;?>')" id="thissize1<?php echo $i;?><?php echo $j;?>"
												 class="thissizeclass1">
													<?php echo $proSz;?>
												</li>
												<?php endforeach;?>
												<input type="hidden" name="prosize1" id="getSize1<?php echo $i;?>" />
											</ul>
											<?php } ?>
											<div class="pro_name">
												<a href="<?php echo base_url();?>products/<?php echo $slug;?>" title="<?php echo $product_name;?>">
													<?php echo stripslashes($product_name);?></a></div>
											<div style="width:200px; height:auto; margin:0 auto; text-align:center">
												<?php if($prodiscount!="") {?>
												<div class="pro_price" style="float:left">
													<?php if($pro_price!="") { echo '&#2547;'.number_format($pro_price,2,'.',','); };?>
												</div>
												<!-- <div class="saveprice"> - <?php echo $prodiscount;?></div>-->
												<div style="color:#FF0000; text-decoration:line-through;">
													<?php echo '&#2547;'.$ptotalprice.' Tk';?>
												</div>
												<?php 
                                    }
                                    else{
                                      ?>
												<div class="pro_price" style="float:left">
													<?php if($pro_price!="") { echo '&#2547;'.number_format($pro_price,2,'.',','); };?>
												</div>
												<?php 
															}
														?>
														<div class="pro_cart_area">
															<button type="submit" class="buy-now" name="submit_type" value="addcart"><i class="fa fa-shopping-cart"></i>
																Buy Now
															</button>
													</div> 
											</div>
										 
										</div>
									</div>
								</div>
							</div>

							<?php
                        endforeach;
                    }
                    else{
                        echo '<h2 style="color:#f00; text-align:center;text-transform:uppercase; margin-top:10%; 
                        margin:auto float:left; font-size:30px;">
                        Sorry ! Product not found</h2>';
                   }
                ?>


							<?php echo form_close();?>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!--<script>
 function productsFiltering(){
   $("#loadImg").show();
   $("#loaderHide").hide();
   	  var pid = $("#id").val();
	  var pname = $("#name").val();
	   var pprice = $("#price").val();
	  //alert(jid);
   	  var surl = '<?php echo base_url('products/gallery/'.$pageurl); ?>';
	  alert(surl);
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'id':pid,'name':pname,'price':pprice},
        cache : false, 
        success: function(response) { 
          $("#loadImg").hide();
		  $("#loaderHide").show();
		  
		   $("#userstatus"+si).html(response.msg);
		   //$("#userstatus"+si).css('display','inline');
		  // $("#userstatus"+si).css('color',response.color);
         // alert(response.apply); 
        }, 
        error: function (xhr, status) {  
          $("#loadImg").hide();
		  $("#loaderHide").show();
          alert('Unknown error ' + status); 
        }    
      });  
    }
</script>-->
	<script type="text/javascript">
		function cartHoverEffect(id) {
			$(".product_grid_view").hover(function () {
				$(this).addClass('product_grid_viewHover');
				//$("#wisharea"+id).show('slow');
				//$(".wish_cart_area").slideUp(200);
			}, function () {
				$(this).removeClass('product_grid_viewHover');
				//$("#wisharea"+id).hide('slow');
				//$(".wish_cart_area").slideDown(200);
			});
		}

		/* if ( screen.width > 1024 ){ 
			 var isScrolledIntoView = function(elem) {
				var $elem = $(elem);
				var $window = $(window);
			
				var docViewTop = $window.scrollTop();
				var docViewBottom = docViewTop + $window.height();
			
				var elemTop = $elem.offset().top;
				var elemBottom = elemTop + $elem.height();
			
				return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
			}
			
			$(window).on('scroll', function () {
				//alert('dgrgfd');
				$('#column-left').toggle(!isScrolledIntoView('#footerarea'));
			});
		 }*/

	</script>
