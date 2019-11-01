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

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
foreach($productdetails->result() as $details);
	  $prid=$details->product_id;
	  $slug=$details->slug;
	  $product_name=$details->product_name;
	  $pro_code=$details->pro_code;
	  $cat_id=$details->scat_id;
	  $main_image=$details->main_image;
	  $photo1=$details->photo1;
	  $photo2=$details->photo2;
	  $photo3=$details->photo3;
	  $prosummery=$details->details;
	  $short_desc=$details->short_desc;
	  $preorder=$details->preorder;
	  $discount=$details->discount;
	  $dis_type=$details->dis_type;
	  $ptotalprice=$details->price;
	  $size=$details->size;
	  $color=$details->color;

    if(!empty($details->product_video)) {
        $link = $details->product_video;
        $code = explode('?v=', $link);
        $product_video_code = substr($code[1], 0, 11);
    }
	 
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
	  
	  $stockPro = $this->Index_model->db->query("select * from stock  where pro_id='".$prid."'");
	  if($stockPro->num_rows() > 0){
	 	$stockArray = $stockPro->row_array();
	    $totalqrtyinstock =$stockArray['pro_qty'];
	  }
	  else{
	  	$totalqrtyinstock ='0';
	  }
												
	 
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/product_zoom/css/smoothproducts.css">
<!-- <script src="<?php echo base_url()?>assets/lib/jquery/jquery-1.11.2.min.js" type="text/javascript"></script> -->
<style>
	.black_overlay{
    display: none;
    position: fixed;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: #ccc;
    -moz-opacity: 0.8;
    opacity:.80;
    filter: alpha(opacity=80);
}
.white_content {
    display: none;
    position: fixed;
    top: 20%;
    left: 20%;
    width: 50%;
    height: 50%;
    float:left;
    padding: 10px;
    border: 3px solid #FFFFFF;
    background-color: #fff;
    box-shadow:0px 0px 15px #999999;
    z-index:1;
    overflow: auto;
    -moz-border-radius:5px;
    border-radius:5px;
}

.required{
	color:#f00;
}
</style>
<script type="text/javascript">
	$(document).ready(function () {
		$('.ratings_stars').click(function () {
			$(this).prevAll().andSelf().addClass('ratings_over');
			var thisval = $(this).attr('title');
			$('#ratval').val(thisval);
			$(this).nextAll().removeClass('ratings_over');
		});
	});


	function productINcDec(pid) {
		var proQuantity = document.getElementById('proQuantity').value;
		if (pid == "Plus") {
			document.getElementById('proQuantity').value = parseInt(proQuantity) + 1;
		} else if (pid == "Minus") {
			if (document.getElementById('proQuantity').value != 1) {
				document.getElementById('proQuantity').value = parseInt(proQuantity) - 1;
			} else {
				alert('Minimum Quantity is Selected');
			}
		}
	}

</script>
<script type="text/javascript">
	function loadContent() {
		$("#light3").show('slow');
		$("#fade").show('slow');
	}

	function closeButton() {
		$("#light3").hide('medium');
		$("#fade").hide('medium');
	}

</script>
<script>
	function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	}
	
	function getProSizes(strURL) {		
		
		var req = getXMLHTTP();
		//alert(req);
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('sizelist').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
</script>

<div class="container-fluid" style="z-index:-1; position:relative; width:100%; float:left;overflow:hidden">
	<div class="row" style="background:#fafafa; border-bottom:1px solid #ccc;">
		<div class="" style="padding:0;">
			<div class="branch_title" style="padding:0; margin:10px;">
				<a href="<?php echo base_url();?>">Home &nbsp;&raquo;&nbsp;</a>
				<a href="<?php echo base_url('products/gallery/'.$procategory);?>">Product &nbsp;&raquo;&nbsp;</a>
				<?php echo $branchmark;?>
			</div>
		</div>
	</div>
	<div class="row" style="background:#fff; margin-top:5px; box-shadow:0 0 2px 2px #ccc; padding:10px;">
		<div class="col-sm-2 ">
			<div class="main_cat">
				<div class="cat-title">
					<span>Categories</span>
				</div>
				<?php include('category_list.php'); ?>
			</div>
		</div>
		<div class="col-sm-10 " id="center_column">
			<div id="product">
				<div class="primary-box row">
					<?php echo form_open_multipart(base_url('cart/add'));?>
					<input type="hidden" value="<?php echo $prid;?>" name="id" />
					<input type="hidden" value="<?php echo $product_name;?>" name="name" />
					<input type="hidden" value="<?php echo $pro_price;?>" name="price" />
					<div class="pb-left-column col-xs-12 col-sm-5">
						<div class="product-image">
							<div class="page">
								<div class="sp-loading">
									<img src='<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>' style="width:100%; height:auto" />
								</div>
								<div class="sp-wrap">
									<div class="product-img-thumb" id="gallery_01">
										<a href="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>">
											<img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" />
										</a>
										<a href="<?php echo base_url()?>uploads/images/product/photo1/<?php echo $photo1;?>">
											<img src="<?php echo base_url()?>uploads/images/product/photo1/<?php echo $photo1;?>" />
										</a>
										<a href="<?php echo base_url()?>uploads/images/product/photo2/<?php echo $photo2;?>">
											<img src="<?php echo base_url()?>uploads/images/product/photo2/<?php echo $photo2;?>" />
										</a>
										<a href="<?php echo base_url()?>uploads/images/product/photo3/<?php echo $photo3;?>">
											<img src="<?php echo base_url()?>uploads/images/product/photo3/<?php echo $photo3;?>" />
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pb-right-column prod_details col-xs-12 col-sm-6">
						<h1 class="pro_name">
							<?php echo $product_name;?>
						</h1>
						<div class="info-orther" style="width:100%; float:left; height:auto">
							<div class="col-sm-6" style="margin:0; padding:0">
								<div style="color:#888">Product Code: #
									<?php echo $pro_code;?>
								</div>
							</div>
							<div class="col-sm-6 pull-right">
								<div style="color:#888;font-size:15px; text-align:right"> <span class="in-stock">
										<?php 
									if($preorder!=1){
										if($totalqrtyinstock > 0){
											echo '<span style="color:green;font-size:16px">'.$totalqrtyinstock.' Items In Stock</span>';
										}
										else{
											echo '<span style="color:red;font-size:16px">Out of Stock</span>';
										}
									}
									else{
										echo '<span style="color:#FFCC00;font-size:16px">Pre Order Product</span>';
									}
									?>
									</span>
								</div>
							</div>

							<div class="col-sm-6 pull-left" style="margin:0; padding:0">
								<div style="color:#888">
									<div class="grade">
										<span>Rating : </span>
										<?php if($total_rating==5){?>
										<span class="reviewRating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										<?php 
											}
											elseif($total_rating==4){
											?>
										<span class="reviewRating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										<span><i class="fa fa-star"></i></span>
										<?php 
											}
											elseif($total_rating==3){
											?>
										<span class="reviewRating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										<span>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										<?php 
											}
											elseif($total_rating==2){
											?>
										<span class="reviewRating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										<span>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										<?php 
											}
											elseif($total_rating==1){
											?>
										<span class="reviewRating">
											<i class="fa fa-star"></i>
										</span>
										<span>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										<?php 
										}
										?>
									</div>

								</div>
								<div style="color:#888">
									<i class="fa fa-comment-o"></i> Read reviews (
									<?php echo $prodctreview->num_rows();?>)
								</div>
							</div>
							<div class="col-sm-6 pull-right">
								<div style="color:#888; text-align:right">
									<i class="fa fa-pencil"></i> <a href="javascript:void();" onclick="loadContent();"> Write your review !</a>
								</div>
							</div>

						</div>
						<div class="pro_short_desc">
							<?php echo $short_desc;?>
						</div>

						<!--<div class="col-sm-3">-->
						<div class="product_attributes">
							<div class="pro_price">

								<?php if($prodiscount!="") {
								?>
								<h3 style="color:#FF0000; text-decoration:line-through;"> Price BDT
									<?php echo $ptotalprice.' Tk';?>
								</h3>
								BDT
								<?php if($pro_price!="") { echo number_format($pro_price,2,'.',','); };?>
								<small style="color:#009900; font-size:13px;"> Save
									<?php echo $prodiscount;?></small>
								<?php 
								}
								else{
									  if($pro_price!="") { 
									  	echo 'BDT '.number_format($pro_price,2,'.',','); 
									  }
								}
								 ?>

							</div>
							<div class="col-sm-12" style="margin:0; padding:0">
								<div class="col-sm-6" style="margin:0; padding:0">
									<div class="pro_quantity">
										<div class="col-sm-4" style="margin:0; padding:0">Quantity:</div>
										<div class="col-sm-4" style="margin:0; padding:0">
											<div class="qty_area">
												<a href="javascript:void()" class="qty_action_plus" onclick="productINcDec('Plus')"><i class="fa fa-plus"></i></a>
												<input id="proQuantity" name="productQuantity" type="text" value="1" class="qty_cont">
												<a href="javascript:void()" class="qty_action_minus" onclick="productINcDec('Minus')"><i class="fa fa-minus"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12" style="margin:0; padding:0">

								<?php if($color!=""){?>
								<ul style="margin: 0; padding:5px 0;">
									<li style="float:left; margin-right:10px;">Color : </li>
									<?php 
											$k=0;
                                            $proColor = explode(',',$color);
                                            foreach($proColor as $proCol):
											$k++;
                                        ?>
									<li style=" width:20px; height:20px; display:inline; text-align:center; margin:0; background:<?php echo $proCol;?>; cursor:pointer"
									 onclick="getColorValue('<?php echo $proCol;?>','<?php echo $k;?>')" id="thisid<?php echo $k;?>" class="thisclass">
										&nbsp;&nbsp;&nbsp;</li>
									<?php endforeach;?>
									<input type="hidden" name="color" id="getColor" />
								</ul>
								<?php } ?>
								<?php if($size!=""){?>
								<ul style="margin: 0; padding:5px 0;">
									<li style="float:left; margin-right:10px;">Size : </li>
									<?php 
										$j=0;
										$proSize = explode(',',$size);
										foreach($proSize as $proSz):
										$j++;
                                    ?>
									<li style=" width:20px; height:20px; display:inline; border:1px solid #ccc; font-size:12px; 
                                    background:#f5f5f5; font-weight:bold; padding:5px; text-align:center; margin:0; cursor:pointer"
									 onclick="getSizeValue('<?php echo $proSz;?>','<?php echo $j;?>')" id="thissize<?php echo $j;?>" class="thissizeclass">
										<?php echo $proSz;?>
									</li>

									<?php endforeach;?>
									<input type="hidden" name="size" id="getSize" />
								</ul>
								<?php } ?>
							</div>
							<?php if($totalqrtyinstock > 0) : ?>
							<div class="col-sm-12" style="margin-bottom:10px;padding-left:0">
								<div class="col-sm-3" style="margin:0; padding:0">
									<div class="pro_cart_area">
										<button type="submit" class="addtocart" name="submit_type" value="addcart"><i class="fa fa-shopping-cart"></i>
											Add to Cart</button>
									</div>
								</div>
								<div class="col-sm-3" style="margin:0; padding:0">
									<div class="pro_cart_area">
										<!-- <a title="Add to Wishlist" class="prow" href="<?php //echo base_url('checkout');?>"> <i class="fa fa-heart-o"></i> Buy Now</a> -->
										<button type="submit" class="addtocart" name="submit_type" value="gocheckout"><i class="fa fa-shopping-cart"></i>
											Buy Now</button>
									</div>
								</div>
							</div>
							<?php else : ?>
							<div class="col-sm-12" style="margin-bottom:10px;padding-left:0">
								<div class="col-sm-3" style="margin:0; padding:0">
									<div class="pro_cart_area">
										<button type="submit" class="btn btn-warning" disabled="disabled">Out Of Stock</button>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<div class="col-sm-12" style="margin-bottom:10px;padding-left:0;">
								<div class="payment_area">
									<div class="col-sm-2" style="padding-left:0;">Payment:</div>
									<div class="col-sm-10">
										<img alt="Master Card" src="<?php echo base_url();?>assets/images/payment/matercard.png" class="paymentm">
										<img alt="Visa" src="<?php echo base_url();?>assets/images/payment/visa.png" class="paymentm">
										<img alt="American Express" src="<?php echo base_url();?>assets/images/payment/american.png" class="paymentm">
										<img alt="bKash" src="<?php echo base_url();?>assets/images/payment/bkash.png" class="paymentm">
										<img alt="Payza" src="<?php echo base_url();?>assets/images/payment/payza.png" class="paymentm">
										<img alt="Bank" src="<?php echo base_url();?>assets/images/payment/bank.png" class="paymentm">
										<img alt="Rocket" src="<?php echo base_url();?>assets/images/payment/rocket.png" class="paymentm">
										<img alt="Paypal" src="<?php echo base_url();?>assets/images/payment/paypal.png" class="paymentm">
										<img alt="Cash on Delivery" src="<?php echo base_url();?>assets/images/payment/cod.png" class="paymentm">
									</div>
								</div>
							</div>
							<div class="col-sm-12" style="margin-bottom:10px;padding-left:0;">
								<div class="payment_area">
									<div class="col-sm-2" style="padding-left:0;">Shipping:</div>
									<div class="col-sm-10">
										<img style="width: 80px;" alt="Express Bahan" title="Express Bahan" src="<?php echo base_url();?>assets/images/shipping/Bahon-Logo.png"
										 class="paymentm">
										<img style="width: 80px;" alt="DHL" title="DHL" src="<?php echo base_url();?>assets/images/shipping/dhl.jpg"
										 class="paymentm">
										<img style="width: 100px;" alt="SA Paribahan" title="SA Paribahan" src="<?php echo base_url();?>assets/images/shipping/sa_paribahan.jpg"
										 class="paymentm">
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<!---------------------------- Jcursol Slide -------------------->
							
								 

								<div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
									<div class="carousel-inner">
										<div class="item active">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/pineapple-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size "><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/paprika-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/avocado-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/banana-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/onion-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/asparagus-96.png"
													 class="img-responsive"></a></div>
										</div>
										<div class="item">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/paprika-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/avocado-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/banana-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/onion-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/asparagus-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/watermelon-96.png"
													 class="img-responsive"></a></div>
													 
										</div>
										<div class="item">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/avocado-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/banana-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/onion-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/asparagus-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/watermelon-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/eggplant-96.png"
													 class="img-responsive"></a></div>
										</div>
										<div class="item">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/banana-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/onion-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/asparagus-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/watermelon-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/eggplant-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/pineapple-96.png"
													 class="img-responsive"></a></div>
										</div>
										<div class="item">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/onion-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/asparagus-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/watermelon-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/eggplant-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/pineapple-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/paprika-96.png"
													 class="img-responsive"></a></div>
										</div>
										<div class="item">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/asparagus-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/watermelon-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/eggplant-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/pineapple-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/paprika-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/avocado-96.png"
													 class="img-responsive"></a></div>
										</div>
										<div class="item">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/watermelon-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/eggplant-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/pineapple-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/paprika-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/avocado-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/banana-96.png"
													 class="img-responsive"></a></div>
										</div>
										<div class="item">
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/eggplant-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/pineapple-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/paprika-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/avocado-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/banana-96.png"
													 class="img-responsive"></a></div>
											<div class="col-md-2 col-sm-6 col-xs-12 carousal-size"><a href=""><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/onion-96.png"
													 class="img-responsive"></a></div>
										</div>
									</div>
									<a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
									<a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
								</div>
								<script>

								$(document).ready(function() { $('#myCarousel').carousel({ pause: true, interval: false, }); });

								</script>
			
								 
								 


								<!---------------------------- End Jcursol Slide -------------------->
							</div>


						</div>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-1">
						<div class="row" style="top:40%; z-index:99">
							<?php include("productshare.php")?>
						</div>

					</div>
					<?php echo form_close();?>
				</div>






				<div class="row" style="padding:0; margin:0; margin-bottom:30px;">
					<div class="productinfo-tab">
						<ul class="nav nav-tabs">
							<li class="active protabtitle"><a href="#tab-description" data-toggle="tab">Description</a></li>
							<li class="protabtitle"><a href="#tab-review" data-toggle="tab">Reviews (
									<?php echo $prodctreview->num_rows;?>)</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab-description">
								<div class="cpt_product_description">
									<?php echo stripslashes($prosummery);?>
								</div>
							</div>
							<div class="tab-pane" id="tab-review">
								<div id="reviews" class="tab-panel">
									<div class="product-comments-block-tab">
										<div id="reviewDisplay">
											<?php
                                    if($prodctreview->num_rows()>0){
                                        foreach($prodctreview->result() as $prorating):
                                    ?>
											<div class="comment row">
												<div class="col-sm-3 author">
													<div class="grade">
														<span>Rating</span>
														<?php if($prorating->ratval==5){?>
														<span class="reviewRating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</span>
														<?php 
                                                }
                                                elseif($prorating->ratval==4){
                                                ?>
														<span class="reviewRating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</span>
														<span><i class="fa fa-star"></i></span>
														<?php 
                                                }
                                                elseif($prorating->ratval==3){
                                                ?>
														<span class="reviewRating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</span>
														<span>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</span>
														<?php 
                                                }
                                                elseif($prorating->ratval==2){
                                                ?>
														<span class="reviewRating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</span>
														<span>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</span>
														<?php 
                                                }
                                                elseif($prorating->ratval==1){
                                                ?>
														<span class="reviewRating">
															<i class="fa fa-star"></i>
														</span>
														<span>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</span>
														<?php 
                                                }
                                                ?>
													</div>
													<div class="info-author">
														<span><strong>
																<?php echo $prorating->username;?></strong></span>
														<em>
															<?php echo $prorating->date;?></em>
													</div>
												</div>
												<div class="col-sm-9 commnet-dettail">
													<h3>
														<?php echo $prorating->review_title;?>
													</h3>
													<p>
														<?php echo $prorating->review;?>
													</p>
												</div>
											</div>
											<?php endforeach;
                                    }
                                    else{
                                        echo '<p>There are no review yet. Would you like to submit your reviews ?</p>';	
                                    }
                                    ?>
											<p>
												<a class="btn-comment" id="reviewWrite" href="javascript:void();" onclick="loadContent();">Write your
													review !</a>
											</p>
										</div>

									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="product_video">
					<?php if(isset($product_video_code)) : ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<iframe style="width:100%" height="315" src="https://www.youtube.com/embed/<?php echo $product_video_code; ?>"
						 frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
					<?php endif; ?>
				</div>
				<div class="page-product-box">
					<div class="branch_title" style="margin:0; padding:0">
						<h2 style="margin:0; padding:0">You may also Like</h2>
						<div class="br_pro" style="text-align:left; margin:20px 0 0 0;"></div>
					</div>
					<div id="related-slidertab" class="owl-carousel">
						<?php 
							$i=0;
							foreach($relatedproducts->result() as $gallery):
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
        
                 	 	echo form_open(base_url('cart/add'));?>
						<input type="hidden" value="<?php echo $product_id;?>" name="id" />
						<input type="hidden" value="<?php echo $product_name;?>" name="name" />
						<input type="hidden" value="<?php echo $pro_price;?>" name="price" />
						<div class="item">
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
						echo form_close();
						endforeach;
						?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/product_zoom/js/smoothproducts.min.js"></script>
<script type="text/javascript">
	/* wait for images to load */
	$(window).load(function () {
		$('.sp-wrap').smoothproducts();
	});

</script>

<div id="light3" class="white_content">

	<div class="col-sm-12" style="background:#fff;position:relative; z-index:3">
		<div style="margin-bottom:20px;">
			<div class="col-sm-12">
				<div class="col-sm-11">
					<h1 style="font-size:22px;">Review</h1>
				</div>
				<div class="col-sm-1"><a href="javascript:void(0)" title="Close" onclick="closeButton()">Close</a></div>
			</div>

		</div>
		<?php echo form_open_multipart('products/access/review', array('class'=>'form-horizontal','role'=>'form')); ?>
		<h4>
			<?php echo $this->session->flashdata('globalMsg'); ?>
		</h4>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="col-sm-3"><label class="control-label">Your Name *</label></div>
				<div class="col-sm-9"><input type="text" name="username" class="form-control" required /></div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="col-sm-3"><label class="control-label">Review Title *</label></div>
				<div class="col-sm-9"><input type="text" name="review_title" class="form-control" required /></div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="col-sm-3"><label class="control-label">Your Rating</label></div>
				<div class="col-sm-9">
					<div class='movie_choice'>
						<div id="r1" class="rate_widget">
							<div class="ratings_stars" title="1"></div>
							<div class="ratings_stars" title="2"></div>
							<div class="ratings_stars" title="3"></div>
							<div class="ratings_stars" title="4"></div>
							<div class="ratings_stars" title="5"></div>
							<input type="hidden" id="ratval" name="ratingVal" />
							<input type="hidden" name="pro_id" value="<?php echo $prid;?>" />
							<input type="hidden" name="slug" value="<?php echo $slug;?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="col-sm-3"><label class="control-label">Your Comment *</label></div>
				<div class="col-sm-9"><textarea name="review" class="form-control" required style="background:none; border:1px solid #ccc"></textarea></div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12 pull-right">
				<input type="submit" name="submit" class="btn btn-success" value="Submit Review" />
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
<div id="fade" class="black_overlay"></div>

<script>
	var ckbox = $('#check_custom_order');

	$('input[name="check_custom_order"]').on('click', function () {
		if (ckbox.is(':checked')) {
			$("#customer-order-wrapper").show();
		} else {
			$("#customer-order-wrapper").hide();
			$("#inputGroupFile01").val('');
			$("#custom_order_text").val('');
		}

	});
	$('.sp-large').zoom();

</script>
