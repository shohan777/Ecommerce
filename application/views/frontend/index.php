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

	function getSizeValue(thisvalue, i, k) {
		$('.thissizeclass').css('opacity', '1');
		$('#getSize' + i).val(thisvalue);
		$("#thissize" + i + k).css('opacity', '0.2');

	}

	function getColorValue(thisvalue, i, j) {
		$('.thisclass').css('opacity', '1');
		$('#getColor' + i).val(thisvalue);
		$("#thisid" + i + j).css('opacity', '0.2');
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
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2 paddingmarginsize">
			<!-- ========================== category start  Developer name : Md.Haidar Ali ================================== -->
			<div class="col-sm-12 paddingmarginsize" style="border-right: 1px dotted #0873bb;" >
				<div class="main-menu main-menu-collapse">
					<div class="menu-title">
						<span>Categories</span>
					</div>
					<?php include('category_list.php'); ?>
				</div>
			</div>
			<!-- ========================== category end Developer name : Md.Haidar Ali ================================== -->

			<!-- ========================== border top start  Developer name : Md.Haidar Ali ================================== -->
			<div class="col-sm-12">
				<p style="border-top: 1px dotted #0054a6;"></p>
			</div>
			<div style="clear:both"></div>

			<!-- ==========================  border top end Developer name : Md.Haidar Ali ================================== -->


			<!-- ========================== Top sell item start Developer name : Md.Haidar Ali ================================== -->
			 <div class="col-sm-12" style="border-right: 1px dotted #0873bb;" >
				<div class="sidebar-wrapper">
				<h2 style="text-transform:uppercase;">Top Sell products</h2>
				<div class="sidebar-inner">

					<?php if ($top_sale_product) : ?>
					<?php foreach ($top_sale_product->result_array() as $product) : ?>
					<div class="sidebar-item">
						<div class="img">
							<img class="img-rounded img-thumbnail" src="<?php echo base_url('/uploads/images/product/main_img/') . $product['main_image'] ?>"
							 alt="<?php echo $product['product_name'] ?>" title="<?php echo $product['product_name'] ?>">
						</div>
						<a href="<?php echo base_url(); ?>products/<?php echo $product['slug']; ?>">
							<div class="meta">
								<p>
									<?php echo $product['product_name'] ?>
								</p>
								<p>&#2547; <span>
										<?php echo $product['price'] ?></span></p>
							</div>
						</a>
					</div>
					<?php endforeach;
				endif; ?>
				</div>
			</div>
			 </div>
			<!-- ==========================  Top sell item end  Developer name : Md.Haidar Ali ================================== -->
		
		</div>
		<div class="col-sm-10">
			 <!-- ========================== Free item start  Developer name : Md.Haidar Ali ==================================-->
			 <style>
				.thumbnail a>img, .thumbnail>img {height: 100px;}
			 </style>
			<div class="col-sm-12" >
					<div class="free-items">
						<p>Free Items</p>
					</div>
					<?php if ($bonusproduct) : ?>
						<?php foreach ($bonusproduct->result_array() as $product) : ?>
							<div class="col-sm-2">
							<div class="thumbnail">
								<img src="<?php echo base_url() ?>uploads/images/product/main_img/thumnail/<?php echo $product['thumb'] ?>" alt="<?php echo $product['product_name']; ?>" title="<?php echo $product['product_name']; ?>" >
								<div class="caption">
									<h3 style="color: #0054a6;"><?php echo $product['product_name']; ?></h3>									
								</div>
							</div>
							</div>
					<?php endforeach; endif; ?>		 
			</div>
			<!-- ========================== Free item end  Developer name : Md.Haidar Ali ================================== -->

		
			<!-- ==========================  category wise product start  Developer name : Md.Haidar Ali ================================== -->
			 
			 <div class="col-sm-12 home-grid" style="padding:0; overflow:hidden;">
				<ul>
					<?php 
						$query_cat = $this->db->query("select * from category where status=1 order by sequence asc limit 10");
						foreach ($query_cat->result() as $row_cat) {
							$cat_id = $row_cat->caegory_title;
							$cat_name = $row_cat->cat_name;
							?>
							<li><a href="<?php echo base_url('products/gallery/' . $cat_id); ?>">
								
								<?php 
							$productdata = $this->db->query("SELECT * from product WHERE cat_id = '{$cat_id}' && `product_bonus` = '0' LIMIT 16");
										//$querydata = $productdata->result();

							if (count($productdata->result()) > 0) {
								echo "<h1 class='categorywiseproduct'>" . $cat_name . "</h1>";
							}
							$l = 0;
							foreach ($productdata->result() as $bsl) :
								$nproduct_id = $bsl->product_id;
							$nslug = $bsl->slug;
							$nproduct_name = $bsl->product_name;
							$nthumb = $bsl->thumb;
							$nprosummery = $bsl->details;
							$ndiscount = $bsl->discount;
							$ndis_type = $bsl->dis_type;
							$nptotalprice = $bsl->price;
							$ncolor = $bsl->color;
							$nsize = $bsl->size;
							$l++;

							if (isset($ndiscount) && $ndiscount > 0) {
								if (isset($ndis_type) && $ndis_type == '%') {
									$ndisamount = ($nptotalprice * $ndiscount) / 100;
									$npro_price = $nptotalprice - $ndisamount;
									$nprodiscount = $ndiscount . '' . $ndis_type . ' ( ' . $ndisamount . ' Tk )';
								} elseif (isset($ndis_type) && $ndis_type == 'Tk') {
									$npro_price = $nptotalprice - $ndiscount;
									$nprodiscount = $ndiscount . '' . $ndis_type;
								} else {
									$npro_price = $nptotalprice;
									$nprodiscount = '';
								}
							} else {
								$npro_price = $nptotalprice;
								$nprodiscount = '';
							}
							?>

								<!-- <div class="home-product-grid-wrapper"> -->
								<?php
								echo form_open(base_url('cart/add'), array('class' => 'home-product-grid')); ?>
								<input type="hidden" value="<?php echo $nproduct_id; ?>" name="id" />
								<input type="hidden" value="<?php echo $nproduct_name; ?>" name="name" />
								<input type="hidden" value="<?php echo $npro_price; ?>" name="price" />
								<div class="item">
									<div class="product_grid_view" id="girdview<?php echo $nproduct_id; ?>" onmouseover="cartHoverEffect(<?php echo $nproduct_id; ?>);">
										<div class="product_thumb_area">
											<div class="pro_img">
												<a href="<?php echo base_url(); ?>products/<?php echo $nslug; ?>">
													<img src="<?php echo base_url() ?>uploads/images/product/main_img/thumnail/<?php echo $nthumb; ?>" alt="<?php echo $nproduct_name; ?>"
													title="<?php echo $nproduct_name; ?>" />
												</a>
											</div>
											<div style="display:none;" class="wish_cart_area" id="wisharea<?php echo $nproduct_id; ?>">
												<?php 
												if (!$this->session->userdata('userAccessId')) { ?>
												<a title="Add to Wishlist" class="heart" href="<?php echo base_url('login'); ?>"> <i class="fa fa-heart-o"></i>
												</a>
												<?php

												} else {
												$ncustomerId = $this->session->userdata('userAccessId');
												$nwishlistquery = $this->Index_model->db->query("select * from customer_wishlist where customer_id='" . $ncustomerId . "' 
															and product_id='" . $nproduct_id . "'");
												if ($nwishlistquery->num_rows() > 0) {
													foreach ($nwishlistquery->result() as $nwishval);
													?>
												<a href="javascript:void();" onclick="removeWishlist(<?php echo $nwishval->wid; ?>);" class="heart" title="This product already in listed your wishlist"
												style="color:#009900"> <i class="fa fa-heart" aria-hidden="true"></i> </a>
												<?php

												} else {
													?>
												<a href="<?php echo base_url(); ?>index/wishlistProduct/<?php echo $nproduct_id; ?>" class="heart" title="Add to Wishlist">
													<i class="fa fa-heart-o"></i> </a>
												<?php	
													}
													}
													?>
										<button type="submit" class="addtocart" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
									</div>
									<div class="pro_details_area">
										<?php if ($ncolor != "") { ?>
										<ul style="margin: 0; padding:5px;">
											<?php 
											$m = 0;
											$nproColor = explode(',', $ncolor);
											foreach ($nproColor as $nproCol) :
												$m++;
											?>
											<li style="width:20px; height:20px; display:inline; text-align:center; margin:0; background:<?php echo $nproCol; ?>; cursor:pointer"
											onclick="getColorValue1('<?php echo $nproCol; ?>','<?php echo $l; ?>','<?php echo $m; ?>')" id="thisid1<?php echo $l; ?><?php echo $m; ?>"
											class="thisclass1">
												&nbsp;&nbsp;&nbsp;</li>
											<?php endforeach; ?>
											<input type="hidden" name="color" id="getColor1<?php echo $l; ?>" />
										</ul>
											<?php 
											} ?>
											<?php if ($nsize != "") { ?>
											<ul style="margin: 0; padding:5px;">
												<?php 
											$n = 0;
											$nproSize = explode(',', $nsize);
											foreach ($nproSize as $nproSz) :
												$n++;
											?>
											<li style=" width:20px; height:20px; display:inline; border:1px solid #ccc; font-size:12px; 
											background:#f5f5f5; font-weight:bold; padding:5px; text-align:center; margin:0; cursor:pointer"
											onclick="getSizeValue1('<?php echo $nproSz; ?>','<?php echo $l; ?>','<?php echo $n; ?>')" id="thissize1<?php echo $l; ?><?php echo $n; ?>"
											class="thissizeclass1">
												<?php echo $nproSz; ?>
											</li>
											<?php endforeach; ?>
											<input type="hidden" name="size" id="getSize1<?php echo $l; ?>" />
										</ul>
											<?php 
												} ?>
										<div class="pro_name">
											<a href="<?php echo base_url(); ?>products/<?php echo $nslug; ?>" title="<?php echo $nproduct_name; ?>">
												<?php echo stripslashes($nproduct_name); ?></a>
										</div>
										<div style="width:100%; height:auto; margin:0 auto; text-align:center">
											<?php if ($nprodiscount != "") { ?>
											<div class="pro_price" style="float:left">
												<?php if ($npro_price != "") {
												echo '&#2547;' . number_format($npro_price, 2, '.', ',');
												}; ?>
											</div>

											<!-- <div class="saveprice"> - <?php echo $nprodiscount; ?></div>-->
											<div class="discount_price" style="color:#FF0000; text-decoration:line-through;float:right;">
												<?php echo '&#2547;' . $nptotalprice . ' Tk'; ?>
											</div>
											<?php 
											} else {
											?>
											<div class="pro_price" style="float:left">
												<?php if ($npro_price != "") {
												echo '&#2547;' . number_format($npro_price, 2, '.', ',');
											}; ?>
											</div>
											<?php 
												}
												?>

											<!-- <div class="pro_cart_area">
												<button type="submit" class="buy-now" name="submit_type" value="addcart"><i class="fa fa-shopping-cart"></i>
													Buy Now
												</button>
											</div> -->
											<div class="pro_cart_area">
											 
												<a href="<?php echo base_url(); ?>products/<?php echo $nslug; ?>" type="submit" class="buy-now" name="submit_type" value="addcart">
												<i class="fa fa-shopping-cart"></i>	Buy now
												</a>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<?php 
					echo form_close();
					endforeach;

					?>
					</a>
					<div style="clear:both"></div>
					<?php 
					if (count($productdata->result()) > 0) {
						echo '<hr/>';
					}
					?>					
					</li>
					<?php
					}
					?>       
				</ul>
			</div>
			<!-- ==========================  category wise product end  Developer name : Md.Haidar Ali ================================== -->

			<!-- ==========================  sticky cart start  Developer name : Md.Haidar Ali ================================== -->
				<!-- Sticky Cart -->
				<?php if ($cart = $this->cart->contents()) {
				$grand_total1 = 0;
				foreach ($cart as $item) :
					$totalItem = count($cart);
				$grand_total1 = $grand_total1 + $item['subtotal'];
				endforeach;
				$grandTotalPrice1 = $grand_total1;
				?>


				<div id="cart" class="sticky-cart">
					<div class="sticky-cart-control">
						<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
					</div>
					<ul class="" style="margin:0; padding:0;">
						<li>
							<table class="table sticky-cart-table" width="100%" style="margin:0; padding:0;">
								<tbody>
									<tr style="background:#eb0a8d; color:#fff">
										<td class="cart-header">Image</td>
										<td class="cart-header">Name</td>
										<td class="cart-header">Price</td>
										<td class="cart-header">Qty</td>
									</tr>
								</tbody>
							</table>
						</li>
						<?php
							$grand_total = 0;
							$i = 1;
							//print_r($cart);
							foreach ($cart as $item) :
								echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
							echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
							echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
							echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
							echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
							echo form_hidden('cart[' . $item['id'] . '][color]', $item['options']['color']);
							echo form_hidden('cart[' . $item['id'] . '][size]', $item['options']['size']);

							$pro_id = $item['id'];
							$result = $this->db->query("select * from product where product_id='$pro_id'");
							$resPro = $result->result();
							foreach ($resPro as $pro);
							$product_id = $pro->product_id;
							$main_image = $pro->main_image;
							$pro_price = $item['price'];

							$grand_total = $grand_total + $item['subtotal'];

							?>
						<li>
							<table class="table sticky-table-bottom" width="100%" style="margin:0; padding:0;">
								<tbody>
									<tr>
										<td width="4%">
											<a href="<?php echo base_url(); ?>products/<?php echo $pro->slug; ?>" style="padding:0; margin:0;">
												<img style="width:40px; height:auto" alt="<?php echo $item['name']; ?>" title="<?php echo $item['name']; ?>"
												src="<?php echo base_url() ?>uploads/images/product/main_img/<?php echo $main_image; ?>">
											</a>
										</td>

										<td width="43%" class="text-left" style="padding:0; margin:0;">
											<a href="<?php echo base_url(); ?>products/<?php echo $pro->slug; ?>" style="font-size:13px;">
												<?php echo $item['name']; ?>
											</a>
										</td>
										<td width="17%" class="text-right" style="padding:0; margin:0;">
											<?php echo $pro_price; ?>
										</td>
										<td width="24%" class="text-right" style="padding:0; margin:0;">
											<i class="fa fa-times" aria-hidden="true"></i>
											<?php echo $item['qty']; ?>
										</td>

										<td width="12%" class="text-right">
											<button title="Remove" type="button" style="padding:3px 5px; border-radius:10px; color:#de5347; background:none; border:none; font-size:15px;"
											onclick="window.location.href='<?php echo base_url('cart/remove/' . $item['rowid']); ?>'">
												<i class="fa fa-trash-o" aria-hidden="true"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</li>
						<?php endforeach; ?>
						<li style="padding:0;background: #473d75;">
							<table width="100%" class="table sticky-table-bottom sticky-table-price" style="margin:0; padding:0;">
								<tr>
									<td style="padding:0 10px; margin:0;">Subtotal</td>
									<td style="padding:0 10px; margin:0;">
										<?php echo $grand_total; ?>
									</td>
								</tr>
								<tr>
									<td style="padding:0 10px; margin:0;">Total</td>
									<td style="padding:0 10px; margin:0;">
										<?php 
									$grandTotalPrice = $grand_total;
									echo $grandTotalPrice;
									?>
									</td>
								</tr>
								<tr class="sticky-cart-control-btn">
									<td style="width:100%">
										<a href="<?php echo base_url('cart/shopping_cart'); ?>" class="btn" style="font-size:16px; text-align:left; background:#0c1dda;border-radius:5px;">View
											Cart</a>
									</td>
									<td>
										<a href="<?php echo base_url('checkout'); ?>" class="btn" style="font-size:16px; text-align:right; background:#eb0a8d; border-radius:5px;">Checkout</a>
									</td>
								</tr>
							</table>
						</li>
					</ul>
					<?php

					}
					?>
					<!-- Sticky Cart End -->

				</div>
			<!-- ==========================   sticky cart end  Developer name : Md.Haidar Ali ================================== -->

			 
		</div>
	</div>
</div>



<script>
	var sticky_i = 1;
	$(".sticky-cart-control").click(function () {
		sticky_i++;
		var cart = $('.sticky-cart');
		if (sticky_i % 2 == 0) {
			console.log(sticky_i);
			cart.animate({
				right: '-297px'
			}, 350);
			$(this).children('i').removeClass('fa-arrow-circle-right');
			$(this).children('i').addClass('fa-arrow-circle-left');
		} else {
			console.log('dd' + sticky_i);
			cart.animate({
				right: '0'
			}, 350);
			$(this).children('i').removeClass('fa-arrow-circle-left');
			$(this).children('i').addClass('fa-arrow-circle-right');
		}
		// $(this).children('i').removeClass('fa-arrow-circle-right');
		// $(this).children('i').addClass('fa-arrow-circle-left');
	})

</script>
