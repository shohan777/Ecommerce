<?php 
$prodiscount = 0;
?>
<script>
	$(document).ready(function(){
	$("#districts").trigger('change');
	$("#shippingcharge").trigger('change');
});
function shippingCharge(){
	var thisval = $('#districts').val();
}
function clear_cart() {
	var result = confirm('Are you sure want to clear all Shopping?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}



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
	
	function getCity(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	

$(document).ready(function(){ 
	
	$('#same_billing').on('change', function() {
			$('#diffShiop').slideUp();
	});
	
	$('#difference_billing').on('change', function() {
			$('#diffShiop').slideDown();
	});
	
	$('#billing-new').on('change', function() {
			$('#billing_existing_area').slideUp();
			$('#billing_new_area').slideDown();
	});
	
	$('#billing-existing').on('change', function() {
			$('#billing_new_area').slideUp();
			$('#billing_existing_area').slideDown();
	});
	
	$('#shipping-new').on('change', function() {
			$('#shipping_existing_area').slideUp();
			$('#shipping_new_area').slideDown();
	});
	
	$('#shipping-existing').on('change', function() {
			$('#shipping_new_area').slideUp();
			$('#shipping_existing_area').slideDown();
	});
	
	
	$('#register-new').on('change', function() {
			$('#guest_mode').hide();
			$('#new-userInfo').show();
	});
	
	$('#guestacc').on('change', function() {
			$('#new-userInfo').hide();
			$('#guest_mode').show();
	});
	
	


	
});


function guestFunc(){
	///////////////Guest Mode Reg ////////////////
$(document).ready(function(){ 
var firstname = $("#gfirstname").val();
var gmobile = $("#gmobile").val();
var gemail = $("#gemail").val();
var gaddress = $("#gaddress").val();
//alert(lastname);
	$.ajax({
	  type:'POST',
	  url: "<?php echo base_url('checkout/guest_mode');?>",
	  data: {fname:firstname,mobile:gmobile,email:gemail,address:gaddress},
		  success: function(data) {
			//alert('Success');
			$("#guestStatus").html(data);
			window.location.reload();
		  },
		  error: function (request, status, error) {
			alert(request.responseText);
		}
	});	
});
}


function newuserFunc(){
	///////////////Guest Mode Reg ////////////////
$(document).ready(function(){ 
var firstname = $("#firstname").val();
var mobile = $("#mobile").val();
var email = $("#email").val();
var address = $("#address").val();
var gender = $("#gender").val();
var country = $("#country").val();
var city = $("#city").val();
var postcode = $("#postcode").val();
var password = $("#password").val();
//alert(lastname);
	$.ajax({
	  type:'POST',
	  url: "<?php echo base_url('checkout/new_user');?>",
	  data: {
	  		fname:firstname,
			mobile:mobile,
			email:email,
			address:address,
			gender:gender,
			country:country,
			city:city,
			postcode:postcode,
			password:password
			},
		  success: function(data) {
			$("#userStatus").html(data);
			window.location.reload();
		  },
		  error: function() {
			 alert('Your Sign Incorrect');
		  }
	});	
});
}


function paymentImage(val){
	if(val=='bKash'){
		document.getElementById('bkashCon').style.display='block';
        document.getElementById('rocketCon').style.display='none';
        document.getElementById('rocket_trnasitionId').value='';
	}
	else if(val=='rocket'){
        document.getElementById('rocketCon').style.display='block';
        document.getElementById('bkashCon').style.display='none';
        document.getElementById('bkash_trnasitionId').value='';
	} else {
        document.getElementById('bkashCon').style.display='none';
        document.getElementById('rocketCon').style.display='none';
    }
}


function shipCharge(){
	var val = document.getElementById('shippingcharge').value;
	var gTotal =document.getElementById('totalprice').value;
	if(val!=""){
		document.getElementById('shipval').style.display='block';
		document.getElementById('shipval').innerHTML=val;
		$("#grndtotal").html(parseInt(gTotal)+parseInt(val));
		$("#shipVal").val(parseInt(val));
		$("#withoutSip").val(parseInt(gTotal));
		$("#total_price").val(parseInt(gTotal)+parseInt(val));
	}
	else{
		document.getElementById('shipval').style.display='none';
		$("#grndtotal").html(gTotal);
		$("#total_price").val(gTotal);
		$("#shipVal").val(0);
		$("#withoutSip").val(parseInt(gTotal));
	}
		
}
</script>
<style>
	.form-control{
	padding:10px;
}
</style>
<div class="row" style="width:100%; background:#FFF; z-index:-1; position:relative; float:left">
	<div class="container" style="margin:20px auto;position:relative;">

		<div class="col-sm-3" style="float:right">
			<?php include('checkoutTrolly.php');?>
		</div>
		<div class="col-sm-9" id="content" style="float:left">
			<h3 class="productblock-title">Checkout</h3>
			<div id="accordion" class="panel-group">

				<?php
          if($this->session->userdata('userAccessMail')==''){        
          ?>
				<div class="panel panel-default">

					<div class="panel-heading" id="optoin_bar">
						<h4 class="panel-title"><a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse">Step
								1: Checkout Options </a></h4>
					</div>
					<div id="collapse-checkout-option" role="heading">
						<div class="panel-body">
							<div class="row">
								<?php echo form_open('checkout/login', array('class'=>'form-inline','name'=>'form1','id'=>'form1')); ?>
								<div class="col-sm-12">
									<h2>Returning Customer</h2>
									<p>I am a returning customer</p>
									<div class="form-group">
										<label for="input-email" class="control-label">E-Mail</label>
										<input type="email" class="form-control" required placeholder="E-Mail" name="email" style="padding:8px; margin-bottom:10px">
									</div>
									<div class="form-group">
										<label for="input-password" class="control-label">Password</label>
										<input type="password" class="form-control" required placeholder="Password" name="password" style="padding:8px; margin-bottom:10px">
										<a href="">Forgotten Password</a></div>
									<input type="submit" class="btn btn-primary" data-loading-text="Loading..." value="Login" name="userlogin">
								</div>
								<?php echo form_close();?>
							</div>

							<div class="row">
								<div id="new-userInfo" style="background:#f5f5f5; padding:10px; margin:10px; box-shadow:#ddd 0 0 1px 1px;">
									<h2>New Customer</h2>
									<p>I am a New customer</p>
									<div class="col-sm-6" style="margin:0; padding:0">
										<fieldset id="account">
											<legend>Your Personal Details</legend>

											<div class="form-group required">
												<div class="col-sm-10">
													<input type="text" class="form-control" style="margin-bottom:5px;" id="firstname" placeholder="Name" name="firstname">
												</div>
											</div>
											<div class="form-group required">
												<div class="col-sm-10">
													<input type="text" class="form-control" style="margin-bottom:5px;" id="country" placeholder="Country" name="country">
												</div>
											</div>
											<div class="form-group required">
												<div class="col-sm-10">
													<input type="text" class="form-control" style="margin-bottom:5px;" id="city" placeholder="City" name="city">
												</div>
											</div>
											<div class="form-group required">
												<div class="col-sm-10">
													<textarea class="form-control" style="margin-bottom:5px;" id="address" placeholder="Address" name="address"></textarea>
												</div>
											</div>
										</fieldset>
									</div>
									<div class="col-sm-6" style="margin:0; padding:0">
										<fieldset>
											<legend>Login Details</legend>
											<div class="form-group required">
												<div class="col-sm-10">
													<input type="email" class="form-control" style="margin-bottom:5px;" id="email" placeholder="E-Mail" name="email">
												</div>
											</div>
											<div class="form-group required">
												<div class="col-sm-10">
													<input type="tel" class="form-control" style="margin-bottom:5px;" id="mobile" placeholder="Phone" name="mobile">
												</div>
											</div>
											<div class="form-group required">
												<div class="col-sm-10">
													<input type="password" class="form-control" style="margin-bottom:5px;" id="password" placeholder="Password"
													 name="password">
												</div>
											</div>
											<div class="form-group required">
												<div class="col-sm-10">
													<input type="password" class="form-control" style="margin-bottom:5px;" id="confirmpassword" placeholder="Password Confirm"
													 name="confirmpassword">
												</div>
											</div>
										</fieldset>

										<div class="buttons">
											<div class="pull-right">
												<input type="checkbox" value="1" name="agree">
												I have read and agree to the <a class="agree" href="<?php echo base_url('content/privacy-policy');?>"><b>Privacy
														Policy</b></a> and
												<a class="agree" href="<?php echo base_url('content/terms-&-condition');?>"><b>Terms & Condition</b></a><br />

												&nbsp;
												<input type="button" onclick="newuserFunc();" class="btn btn-primary" value="Confirm Order" style="margin-top:20px;">
											</div>
										</div>
									</div>
									<div class="row">
										<h2 id="userStatus" style="color:#009900; text-align:center"></h2>
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>
				<?php 
          }
          else{
		  //echo $this->session->userdata('userAccessId');
           ?>
				<?php echo form_open('checkout/ordersubmitted', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>

				<div class="panel panel-default">
					<div class="panel-heading" id="optoin_bar">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed">Step 2: Delivery Details</a></h4>
					</div>
					<div id="collapse-shipping-address" role="heading">
						<div class="panel-body">
							<div class="col-sm-8 col-sm-offset-2">
								<div class="radio">
									<label><input type="radio" checked="checked" value="1" name="same_billing" id="same_billing"> Same as Billing
										Address</label>
									<label><input type="radio" value="0" name="same_billing" id="difference_billing"> Difference Delivery Address</label>
								</div>
								<div id="diffShiop" style="display:none">
									<div class="form-group required">
										<label for="input-payment-firstname" class="col-sm-3 control-label">Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="sfirstname" placeholder="Name" value="" name="sfirstname">
										</div>
									</div>
									<div class="form-group required">
										<label for="input-payment-country" class="col-sm-3 control-label">Country</label>
										<div class="col-sm-9">
											<input type="text" name="scountry" id="scountry" class="form-control" value="Bangladesh" readonly="readonly" />
										</div>
									</div>
									<div class="form-group required">
										<label for="input-payment-country" class="col-sm-3 control-label">Districts</label>
										<div class="col-sm-9">
											<select name="city" class="form-control" id="districts" onchange="shippingCharge(this.value)">
												<?php  foreach($districts as $dist):?>
												<option value="<?php echo $dist->name;?>">
													<?php echo $dist->name;?>
												</option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group required">
										<label for="input-payment-address-1" class="col-sm-3 control-label">Address</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="saddress1" placeholder="Address" name="saddress1"></textarea>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" id="optoin_bar">
						<h4 class="panel-title"><a class="accordion-toggle collapsed">Step 3: Payment Method</a></h4>
					</div>
					<div id="collapse-payment-method" role="heading">
						<div class="panel-body">
							<div class="col-sm-8 col-sm-offset-2">
								<div class="row">
									<p>Please select the preferred payment method to use on this order.</p>
									<div class="radio">
										<label class="col-sm-3">
											<input type="radio" name="paymentMethod" checked="checked" required value="Cash on Delivery" onclick="paymentImage(this.value);">
											Cash On Delivery </label>

										<label class="col-sm-3">
											<input type="radio" name="paymentMethod" required value="bKash" id="bkash_mathod" onclick="paymentImage(this.value);">
											bKash </label>

										<label class="col-sm-3">
											<input type="radio" name="paymentMethod" required value="rocket" id="rocket_mathod" onclick="paymentImage(this.value);">
											Rocket </label>
									</div>
									<div style="font-size:12px;width:100%; margin:auto; float:left; text-align:left; display:none" id="bkashCon">
										<strong>Dear valuable customer,</strong><br />
										You have to make the bKash payment on our official bKash number <strong style="color:red;letter-spacing:2px;font-size:15px;"> <br>
											<?php echo $bkash;?></strong> <br />
										Once the payment is confirmed and clear by bKash then call us about this payment.<br />
										Plese input here your <strong>bkash number</strong> after payment
										<input type="text" name="bkash_trnasitionId" id="bkash_trnasitionId" style="width:200px; margin:0 0 10px 5px; border:1px solid #999" />
										<input type="hidden" name="price" id="price" style="width:200px; margin-left:5px" value="<?php //echo $grandTotalPrice;?>" />
									</div>
									<div style="font-size:12px;width:100%; margin:auto; float:left; text-align:left; display:none" id="rocketCon">
										<strong>Dear valuable customer,</strong><br />
										You have to make the Rocket payment on our official Rocket number <strong style="color:red;letter-spacing:2px;font-size:15px;"> <br>
											<?php echo $rocket;?></strong> <br />
										Once the payment is confirmed and clear by Rocket then call us about this payment.<br />
										Plese input here your <strong>rocket number</strong> after payment
										<input type="text" name="rocket_trnasitionId" id="rocket_trnasitionId" style="width:200px; margin:0 0 10px 5px; border:1px solid #999" />
										<input type="hidden" name="price" id="price" style="width:200px; margin-left:5px" value="<?php //echo $grandTotalPrice;?>" />
									</div>
								</div>

								<div class="row" style="margin-top:30px;">
									<p><strong>Add Comments About Your Order</strong></p>
									<p>
										<textarea class="form-control" rows="3" name="comment"></textarea>
									</p>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="buttons">
					<div class="pull-right">
						<input type="submit" data-loading-text="Loading..." class="btn btn-primary" id="button-confirm" name="confirmorder"
						 value="Confirm Order" style="background:#5bb75b;border-radius:5px; padding:10px 15px">
					</div>
				</div>

				<?php
				$grand_total = 0; $i = 1; $totaldiscount = 0;
				foreach ($cart as $item):
					echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
					echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
					echo form_hidden('cart['. $item['id'] .'][bonus_id]', $item['bonus_id']);
					echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
					echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
					echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
					echo form_hidden('cart['. $item['id'] .'][color]', $item['options']['color']);
					echo form_hidden('cart['. $item['id'] .'][size]', $item['options']['size']);
					
					$grand_total = $grand_total + $item['subtotal'];
					$productAllId[] = $item['id'];
					$bonusproductid = $item['bonus_id'];
				 
					$prosize = $item['options']['size'];
					$procolor = $item['options']['color'];
					$custom_order_text = (isset($item['custom_order_text'])) ? $item['custom_order_text'] : null;
					$custom_order_images = (isset($item['custom_order_images'])) ? $item['custom_order_images'] : null;
						
					$pro_id=$item['id'];
					  $result=$this->db->query("select * from product where product_id='$pro_id'");
					  $resPro=$result->result();
					  foreach($resPro as $pro);
					  $product_id=$pro->product_id;
					  $main_image=$pro->main_image;
					  $pro_price=$pro->price;
					  $pro_code=$pro->pro_code;
					  $main_image=$pro->main_image;
					  $discount=$pro->discount;
					  $dis_type=$pro->dis_type;
					  $ptotalprice=$pro->price;
					  
					   if(isset($discount) && $discount > 0){
						if(isset($dis_type) && $dis_type=='%'){
							$disamount = ($ptotalprice*$discount)/100;
							$pro_price = $ptotalprice - $disamount;
							//$prodiscount = $discount.''.$dis_type.' ( '.$disamount.' Tk )';
							$prodiscount = $disamount;
						}
						elseif(isset($dis_type) && $dis_type=='Tk'){
							$pro_price = $ptotalprice - $discount;
							//$prodiscount = $discount.''.$dis_type;
							$prodiscount = $discount;
						}
					  }
					  else{
						 $pro_price=$pro->price;
						 $prodiscount = 0;
					  }
				?>

				<input type="hidden" value="<?php echo $main_image;?>" name="mainimg<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $pro_code;?>" name="pro_code<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $item['name'];?>" name="pro_name<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $item['id'];?>" name="product_id<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $item['bonus_id'];?>" name="bonus_id<?php echo $i;?>" />
				 
				<input type="hidden" value="<?php echo $item['qty'];?>" name="qty<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $item['price'];?>" name="unit_price<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $item['subtotal'];?>" name="sub_total<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $prosize;?>" name="prosize<?php echo $i;?>" />
				<input type="hidden" value="<?php echo $procolor;?>" name="procolor<?php echo $i;?>" />

				<?php if(isset($custom_order_text)) : ?>
				<input type="hidden" value="<?php echo $custom_order_text;?>" name="custom_order_text<?php echo $i;?>" />
				<?php endif; ?>
				<?php if(isset($custom_order_images)) : ?>
				<input type="hidden" value="<?php echo $custom_order_images;?>" name="custom_order_images<?php echo $i;?>" />
				<?php endif; ?>

				<?php   
				$i++;
				
				$totaldiscount = $totaldiscount + $prodiscount;
				endforeach; 
				
				$pro_array = join(',', $productAllId);				
				$grandTotalPrice = $grand_total;
				?>
				<input type="hidden" value="<?php echo $pro_array;?>" name="productId" />
				<input type="hidden" value="<?php echo $totaldiscount;?>" name="totaldiscount" />
				<?php
                    $order_q=$this->db->query("select * from orders order by order_id desc limit 1");
                    if($order_q->num_rows() > 0){
                        foreach($order_q->result() as $ord);
                        $orderN=$ord->order_number;
                            $orderNum=$orderN+1;
                    }
                    else{
                        $orderNum=1111;
                    }
                    ?>
				<input type="hidden" name="order_number" value="<?php echo $orderNum;?>" />
				<input type="hidden" name="shipVal" id="shipVal" />
				<input type="hidden" name="withoutSip" id="withoutSip" />
				<input type="hidden" name="total_price" id="total_price" value="<?php echo $grandTotalPrice;?>" />
				<input type="hidden" name="cuponprice" id="cuponprice" />
				<?php echo form_close();?>
				<?php 
                }
               ?>
			</div>
		</div>
	</div>
</div>
