<?php include("tophead.php");?>
<script type="text/javascript">
	$(document).ready(function () {
		$(window).scroll(function () {
			if ($(window).width() > 1024) {
				if ($(this).scrollTop() > 100) {
					//$("#headerarea").addClass("fixed-header");
					$("#headerarea").addClass("fixed-header", {
						duration: 500
					});
				} else {
					//$("#headerarea").removeClass("fixed-header");
					$("#headerarea").removeClass("fixed-header", {
						duration: 500
					});
				}
			}
		});

	});

</script>

<header>
	<div class="cs-headertop clearfix" style="padding: 2px 0 10px;">
		<div class="container-fluid">
			<div class="top-header">
				<div class="top-head">
					<div>
						<ul class="top-home">
							
							<li><a href="<?php echo base_url('/'); ?>" class="home" title="home">Home</a></li>
							 
						</ul>
					</div>
					<div class="top-head-inner">
						<ul class="pull-right">
							<?php if($this->session->userdata('userAccessMail') && $this->session->userdata('userAccessType')=='customer') : ?>

							<li><a href="<?php echo base_url('profile');?>" class="accounts" title="My Accounts">My Accounts</a></li>
							<li><a class="login" href="<?php echo base_url('login/logout');?>" title="Sign Out">Logout</a></li>

							<?php elseif($this->session->userdata('userAccessMail') && $this->session->userdata('userAccessType')=='guest') : ?>

							<li><a class="login" href="<?php echo base_url('login/logout');?>" title="Sign Out icondefault">Logout</a></li>

							<?php else : ?>

							<li><a class="login" href="<?php echo base_url('login');?>" title="Sign in">Sign in</a></li>

							<?php endif; ?>
							<li><a href="#">Checkout</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="main-header clearfix">
				<div class="logo-area">
					<div class="logo wow fadeInUpLeft animated"> <a href="<?php echo base_url();?>">
							<img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" title="Bargainnshop" alt="Bargainnshop" style="height:57px" /></a>
					</div>
				</div>
				<div class="search-option search_res_1">
					<div class="search-box">
						<?php echo form_open('index/search_data','class="form-inline"');?>
						<label for="">Search Product</label>
						<input class="input-text search-field" type="text" name="keyword" placeholder="Search Products">
						<button type="submit" class="search-btn"><i class="fa fa-search icondefault" aria-hidden="true"></i></button>
						<?php echo form_close();?>
					</div>
				</div>

				<div class="" id="cart" >
					<?php
                    
                    if ($cart = $this->cart->contents()){
                        
                        $grand_total1 = 0;
                        foreach ($cart as $item):
                        
                        $totalItem=count($cart);
                        $grand_total1 = $grand_total1 + $item['subtotal'];
                        endforeach;
                        $grandTotalPrice1=$grand_total1;					
                    ?>

					<button type="button" class="dropdown-toggle cart-dropdown-button cart-button">
						<span id="cart-total" style="margin:0; padding:0">
							<i class="fa fa-shopping-cart icondefault" aria-hidden="true" style="margin-top:0; font-size:30px"></i><span
							 class="cart-title">
								<?php echo $totalItem;?></span>
						</span>
					</button>
					<ul class="dropdown-menu pull-right cart-dropdown-menu" style="margin:0; padding:0; border:1px solid #000">
						<li>
							<table class="table" width="100%" style="margin:0; padding:0;">
								<tbody>
									<tr style="background:#2d2d2d; color:#fff">
										<td class="cart-header" >Image</td>
										<td class="cart-header" >Name</td>
										<td class="cart-header"  >Price</td>
										<td class="cart-header" >Qty</td>
										<td class="cart-header"  title="Remove"><i class="fa fa-times"
											 aria-hidden="true" title="Remove"></i>
										 </td>
									</tr>
								</tbody>
							</table>
						</li>
						<?php
                        $grand_total = 0; $i = 1;
                        //print_r($cart);
                        foreach ($cart as $item):
                            
                            echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
                            echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
                            echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
                            echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
                            echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
                            echo form_hidden('cart['. $item['id'] .'][color]', $item['options']['color']);
                            echo form_hidden('cart['. $item['id'] .'][size]', $item['options']['size']);
                            
                            $pro_id=$item['id'];
                            $result=$this->db->query("select * from product where product_id='$pro_id'");
                            $resPro=$result->result();
                            foreach($resPro as $pro);
                            $product_id=$pro->product_id;
                            $main_image=$pro->main_image;
                            $pro_price=$item['price'];
                            
                            $grand_total = $grand_total + $item['subtotal'];
                            
                        ?>
						<li>
							<table class="table" width="100%" style="margin:0; padding:0;">
								<tbody>
									<tr>
										<td width="4%">
											<a href="<?php echo base_url();?>products/<?php echo $pro->slug;?>" style="padding:0; margin:0;">
												<img style="width:40px; height:auto" alt="<?php echo $item['name'];?>" title="<?php echo $item['name'];?>"
												 src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>"></a></td>

										<td width="43%" class="text-left" style="padding:0; margin:0;">
											<a href="<?php echo base_url();?>products/<?php echo $pro->slug;?>" style="font-size:9px;">
												<?php echo $item['name'];?>
											</a></td>
										<td width="17%" class="text-right" style="padding:0; margin:0;">
											<?php echo $pro_price; ?>
										</td>
										<td width="24%" class="text-right" style="padding:0; margin:0;"><i class="fa fa-times" aria-hidden="true"></i>
											<?php echo $item['qty']; ?>
										</td>

										<td width="12%" class="text-right">
											<button title="Remove" type="button" style="padding:3px 5px; border-radius:10px; color:#de5347; background:none; border:none; font-size:15px;"
											 onclick="window.location.href='<?php echo base_url('cart/remove/'.$item['rowid']);?>'"><i class="fa fa-trash-o"
												 aria-hidden="true"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
						</li>
						<?php endforeach;?>
						<li style="border-top:1px solid #ccc; padding:10px 0">
							<table width="100%" class="table" style="margin:0; padding:0;">
								<tr>
									<td style="padding:0 10px; margin:0;">Subtotal</td>
									<td style="padding:0 10px; margin:0;">
										<?php echo $grand_total;?>
									</td>
								</tr>
								<tr>
									<td style="padding:0 10px; margin:0;">Total</td>
									<td style="padding:0 10px; margin:0;">
										<?php 
                                        $grandTotalPrice=$grand_total;						
                                        echo $grandTotalPrice;?>
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td><a href="<?php echo base_url('cart/shopping_cart');?>" class="btn" style="font-size:16px; text-align:left; background:#de5347;border-radius:5px;">View
											Cart</a></td>
									<td><a href="<?php echo base_url('checkout');?>" class="btn" style="font-size:16px; text-align:right; background:#2d2d2d; border-radius:5px;">Checkout</a></td>
								</tr>
							</table>
						</li>
					</ul>
					<?php
                    }
                        else{
                            $totalItem=0;
                            ?>
					<button type="button" class="dropdown-toggle cart-dropdown-button cart-button" >
						<span id="cart-total"><span class="cart-title">
								<?php echo $totalItem;?></span>
						</span>
					</button>
					<?php
                }
                ?>

				</div>
			</div>
			<div class="search-box search_res_2">
				<div class="search-box">
					<?php echo form_open('index/search_data', 'class="form-inline"'); ?>
					<label for="">Search Product</label>
					<input class="input-text search-field" type="text" name="keyword">
					<button type="submit" class="search-btn"><i class="fa fa-search icondefault" aria-hidden="true"></i></button>
					<?php echo form_close(); ?>
				</div>
			</div>

		</div>
	</div>

</header>
