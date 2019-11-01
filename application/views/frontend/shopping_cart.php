<script>
	function clear_cart() {
	var result = confirm('Are you sure want to clear all Shopping?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}

function remove_item(id) {
	var result = confirm('Are you sure want to Remove this item from cart');
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/"+id;
	}else{
		return false; // cancel button
	}
}

function orderFormSub()
    {
		<?php
			if($this->session->userdata('userAccessMail'))
			{
			$url='checkout/ordersubmitted';
			}
			else{
			$url='checkout';
			}
		?>
       document.orderform.action = "<?php echo base_url($url);?>";
       document.orderform.submit();          
       return true;
    }

    function updateCart()
    {
		//alert('dfd');
       document.orderform.action = "<?php echo base_url('cart/update_cart');?>";
       document.orderform.submit();          
       return true;
    }

function productINcDec(si,pid)
{
	var proQuantity = document.getElementById('proQuantity'+si).value;
	if(pid=="Plus"){
		document.getElementById('proQuantity'+si).value = parseInt(proQuantity) + 1;
		updateProductQty(si);
	}
	else if(pid=="Minus"){
		if(document.getElementById('proQuantity'+si).value!=1){
			document.getElementById('proQuantity'+si).value = parseInt(proQuantity) - 1;
			updateProductQty(si);
		}
		else{
			alert('Minimum Quantity is Selected');
		}
	}
}


function updateProductQty(id){
			var rowid = $("#rowid"+id).val();
			var price = $("#price"+id).val();
			var qty = $("#proQuantity"+id).val();
			var cart = $("#cart").val();
			//alert(price);
			var surl = '<?php echo base_url('cart/update_cart');?>';
			  $.ajax({ 
				type: "POST", 
				url: surl,  
				data:{'rowid':rowid,'qty':qty,'price':price},
				success: function(response) { 
				 // $("#userstatus").html(response.jsonmsg);
				   //$("#userstatus").css('color',response.color);
				  // alert(response);
				   window.location.reload();
				}, 
				error: function (xhr, status) {  
				  alert('Unknown error ' + status); 
				}    
			  });  
    }
</script>
<style>
	.btn.focus, .btn:focus, .btn:hover {
    color: #fff;
    text-decoration: none;
		background: #1f89ca;
}
</style>
<div class="row" style="background:#FFF;z-index:-1; position:relative; width:100%; float:left">
	<div class="container" style="margin:20px auto;">
		<?php if ($cart = $this->cart->contents()){	
		echo form_open_multipart($url, array('class'=>'form-horizontal','role'=>'form','name'=>'orderform'));?>
		<div class="col-sm-12" id="content">
			<div class="col-sm-8 col-sm-offset-2">
				<h3 class="productblock-title col-sm-5 col-xs-12 pull-left">Shopping Cart &nbsp;<span class="col-sm-4 col-xs-12 pull-right">(<small>
							<?php echo count($cart);?> Items</small>)</span></h3>
			</div>
			<div class=" ">
				<table class="table table-bordered table-responsive" width="100%">
					<thead>
						<tr id="optoin_bar">
							<td class="text-center">Image</td>
							<td class="text-center">Product Name</td>
							<td class="text-center">Product Code</td>
							<td class="text-center">Color & Size</td>
							<td class="text-center">Quantity</td>
							<td class="text-center">Unit Price</td>
							<td class="text-center">Total</td>
							<td class="text-center">Remove</td>
						</tr>
					</thead>
					<tbody>
						<?php
							$grand_total = 0; $i = 0;
							//echo form_open('cart/update_cart');
							foreach ($cart as $item):
								$bounusid = ($item['bonus_id'])? $item['bonus_id']:0;
								$querdata =	$this->db->query("SELECT * from product where product_id = {$bounusid}");
								$bonusdvalue = $querdata->row();
								// print "<pre>";
								// print_r($bonusdvalue);
						
							echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
							echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
							echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
							echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
							echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
							echo form_hidden('cart['. $item['id'] .'][color]', $item['options']['color']);
							echo form_hidden('cart['. $item['id'] .'][size]', $item['options']['size']);
							echo form_hidden('cart['. $item['id'] . '][bonus_id]', $bounusid);
							
							$grand_total = $grand_total + $item['subtotal'];
							$productAllId[] = $item['id'];
							$qty[] = $item['qty'];
							$unitPrice[] = $item['price'];
							$subtotal[] = $item['subtotal'];
							$prosize = $item['options']['size'];
							$procolor = $item['options']['color'];
							
							$pro_id=$item['id'];
							$result=$this->db->query("select * from product where product_id='$pro_id'");
							$resPro=$result->result();

							// print "<pre>";
							// print_r($item);

							foreach($resPro as $pro);
							$product_id=$pro->product_id;
							$main_image=$pro->main_image;
							$pro_code=$pro->pro_code;	
							$size=$pro->size;	
							$color=$pro->color;	
									
							$i++;
						?>
						<tr>
							<td class="text-center">
								<a href="<?php echo base_url();?>index/product_details/<?php echo $product_id;?>">
									<img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" alt="<?php echo $item['name'];?>"
									 style="width:80px; height:auto"></a>
							</td>

							<td class="text-center"><a href="<?php echo base_url();?>index/product_details/<?php echo $product_id;?>">
									<?php echo $item['name'];?></a>
							</td>
							<td class="text-center">
								<?php echo $pro_code;?>
							</td>
							<td class="text-center">
								<div style="width:20px; height:20px; display:inline; text-align:center; background:<?php echo $procolor;?>;">&nbsp;&nbsp;&nbsp;&nbsp;</div>
								<div class="colsize">Size:
									<?php echo $prosize;?>
								</div>
							</td>
							<td class="text-center">
								<div class="cart_quantity">
									<div class="qty_area_c">
										<a href="javascript:void()" class="qty_plus" onclick="productINcDec('<?php echo $i;?>','Plus')"><i class="fa fa-plus"></i></a>
										<?php //echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="5" size="1" class="qty_cont_c" id="proQuantity'.$i.'"'); ?>
										<input type="text" value="<?php echo  $item['qty'];?>" name="qty" id="proQuantity<?php echo $i;?>" class="qty_cont_c"
										 maxlength="5" size="1" />
										<input type="hidden" value="<?php echo  $item['rowid'];?>" name="rowid" id="rowid<?php echo $i;?>" />
										<a href="javascript:void()" class="qty_minus" onclick="productINcDec('<?php echo $i;?>','Minus')"><i class="fa fa-minus"></i></a>
									</div>
								</div>
							</td>

							<td class="text-center">
								<?php echo 'BDT '.$item['price'].' Tk';?>
								<input type="hidden" value="<?php echo  $item['price'];?>" name="price" id="price<?php echo $i;?>" /></td>
							<td class="text-center">
								<?php echo 'BDT '.$item['subtotal'].' TK';?>
							</td>
							<td class="text-center">
								<button title="Remove" type="button" style="padding:3px 5px; border-radius:10px; color:#de5347; background:none; border:none; font-size:22px;"
								 onclick="remove_item('<?php echo $item['rowid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

							</td>

							<!------------------ for bouns-------------------------->
							<?php if($bonusdvalue){ ?>
								</tr>
								<td class="text-center">
									<a href="">
										<img src="<?php echo base_url() ?>uploads/images/product/main_img/thumnail/<?php echo ($bonusdvalue)? $bonusdvalue->thumb:''; ?>"
										style="width:80px; height:50px"></a>
								</td>

								<td class="text-center"><a href="<?php echo base_url(); ?>index/product_details/<?php echo $product_id; ?>">
										<?php echo ($bonusdvalue) ? $bonusdvalue->product_name:''; ?>

								</td>


								<td class="text-center">
									code
								</td>
								<td class="text-center">
									size
								</td>
								<td class="text-center">

								</td>

								<td class="text-center">
									<?php echo ($bonusdvalue) ? $bonusdvalue->price:''; ?>
								</td>
								<td class="text-center">
									0
								</td>
								<td class="text-center">
									No Delete

								</td>
								</tr>
							<?php } ?>
						<!------------------- end for bonus ----------------->



						<input type="hidden" value="<?php echo $item['id'];?>" name="product_id<?php echo $i;?>" />
						<input type="hidden" value="<?php echo $item['qty'];?>" name="qty<?php echo $i;?>" />
						<input type="hidden" value="<?php echo $item['price'];?>" name="unit_price<?php echo $i;?>" />
						<input type="hidden" value="<?php echo $item['subtotal'];?>" name="sub_total<?php echo $i;?>" />
						<input type="hidden" value="<?php echo $prosize;?>" name="prosize<?php echo $i;?>" />
						<input type="hidden" value="<?php echo $procolor;?>" name="procolor<?php echo $i;?>" />
						<?php   endforeach; ?>
						<?php
							$pro_array = join(',', $productAllId);
							$grandTotalPrice = $grand_total;
							?>
						<input type="hidden" value="<?php echo $pro_array;?>" name="productId" />

					</tbody>
					<tfoot>
						<tr>
							<td colspan="6" align="right">Total products (tax incl.)</td>
							<td colspan="1" align="right">
								<?php echo number_format($grand_total,2); ?>
							<td colspan="1" align="right">&nbsp;</td>
							</td>
						</tr>

						<tr>
							<td colspan="6" align="right"><strong>Grand Total</strong></td>
							<td colspan="1" align="right"><strong>
									<?php echo number_format($grandTotalPrice,2);?></strong></td>
							<td colspan="1" align="right">&nbsp;</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="buttons">
				<div class="pull-left"><a class="btn" href="javascript:void();" onclick="history.back(-1);" style="background:#2d2d2d;border-radius:5px; padding:10px 15px;">Continue
						Shopping</a></div>
				<div class="pull-right"><a class="btn" href="<?php echo base_url('checkout');?>" style="background:#de5347;border-radius:5px; padding:10px 15px">Checkout</a></div>
			</div>
		</div>
		<?php
			//echo form_close();
			}
			else{
				?>
		<div class="heading-counter warning" style="text-align:center; font-size:20px; color:#f00">Your shopping cart is
			Empty</span>
		</div>
		<?php
			}
		?>
	</div>
</div>
</div>
