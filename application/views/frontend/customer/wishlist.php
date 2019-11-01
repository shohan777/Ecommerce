<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
<div class="container" style="margin:20px auto;">
				<div class="col-sm-3">
					<?php include("leftSidebar.php");?>
				</div>
				
				<div class="col-sm-9">
    				<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:justify;">
                        <h3 class="headline">My Products</h3>
                            <div style="width:98%; float:left; padding:0; margin:0 1%; position:relative;">
                <?php 
						if($userOrder->num_rows() > 0){
							$i=0;
							foreach($orderproductList->result() as $gallery):
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
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding:0; margin:0">					
									<div class="product_grid_view" id="girdview<?php echo $product_id;?>" onmouseover="cartHoverEffect(<?php echo $product_id;?>);">
									  <div class="product_thumb_area">
										 <div class="pro_img">                                     
											<a href="<?php echo base_url();?>products/<?php echo $slug;?>">
												<img src="<?php echo base_url()?>uploads/images/product/main_img/thumnail/<?php echo $thumb;?>" alt="<?php echo $product_name;?>" 
												title="<?php echo $product_name;?>"/>
											</a>                                           
										</div>
										 <div class="wish_cart_area" id="wisharea<?php echo $product_id;?>">                         
											<?php 
											if(!$this->session->userdata('userAccessId')){?>
												<a title="Add to Wishlist" class="heart" href="<?php echo base_url('login');?>"> <i class="fa fa-heart-o"></i> </a>
											<?php
											}
											else{
												$customerId = $this->session->userdata('userAccessId');
												$wishlistquery = $this->Index_model->db->query("select * from customer_wishlist where customer_id='".$customerId."' 
												and product_id='".$product_id."'");
												if($wishlistquery->num_rows() > 0){
												foreach($wishlistquery->result() as $wishval);
												?>
												<a href="javascript:void();" onclick="removeWishlist(<?php echo $wishval->wid;?>);" class="heart" 
												title="This product already in listed your wishlist" style="color:#009900"> <i class="fa fa-heart" aria-hidden="true"></i> </a>
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
													$proColor = explode(',',$color);
													foreach($proColor as $proCol):
												?>	
												<li style=" width:20px; height:20px; display:inline; text-align:center; margin:0; background:<?php echo $proCol;?>;">&nbsp;&nbsp;&nbsp;</li>
												<?php endforeach;?>
											  </ul>	
											<?php } ?>
											<?php if($size!=""){?>
											  <ul style="margin: 0; padding:5px;">
												<?php 
													$proSize = explode(',',$size);
													foreach($proSize as $proSz):
												?>	
												<li style=" width:20px; height:20px; display:inline; border:1px solid #ccc; font-size:12px; background:#f5f5f5; font-weight:bold; padding:5px; text-align:center; margin:0;"><?php echo $proSz;?></li>
												<?php endforeach;?>
											  </ul>	
											<?php } ?>
										 <div class="pro_name">                              
											  <a href="<?php echo base_url();?>products/<?php echo $slug;?>" title="<?php echo $product_name;?>"><?php echo stripslashes($product_name);?></a></div>
											  <div class="pro_price"><?php echo '&#2547;'.$pro_price;?> </div>						   
										</div>
									  </div>
								</div>
								
					 		   </div>  
							<?php 
							
							echo form_close();
							endforeach;
							}
							else{
									echo '<h2 style="color:#f00; text-align:center;text-transform:uppercase; margin-top:10%; 
									margin:auto float:left; font-size:30px;">
									Sorry ! Product not found</h2>';
							   }
						?>
                
                </div>
                    </div>
				</div>
			</div>
		</div>
