<script type="text/javascript">
$(document).ready(function(){
	//var cuponcheck = $("#cupon");
	$("input[type='radio']").click(function(){
		if($(this).is(':checked')){
			var thisval = $(this).val();
			if(thisval==1){
				$("#codearea").show();
			}
			else{
				$("#codearea").hide();
			}
		}
	});
	
});

function cuponFunc()
{
		var cuponcode=document.getElementById('cuponcode').value;
		var totalprice=document.getElementById('totalprice').value;
	
		$.ajax({
			   type: "POST",
			   url: '<?php echo base_url('checkout/checkcupon')?>',
			   data: {'cupon':cuponcode,'tprice':totalprice},
			   dataType:'JSON',
			   success: function(data) {
				 $("#msgc").html(data.msg);
				 $("#grndtotal").html(data.grandtotal);
				 $("#cuponprice").val(data.cuponprice);
				 $("#total_price").val(data.grandtotal);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
</script>
<div class="col-sm-12" style="padding:5px; float:left; box-shadow:#1f89ca 0 0 3px 3px;background-color:#57b1e8; height:auto; opacity:0.9; font-size:11px;">
<?php if ($cart = $this->cart->contents()){ ?>
    
   	<table width="100%" border="0" bordercolor="#FFFFFF" cellpadding="0" cellspacing="0" 
    style="border-collapse:collapse; color:#1f89ca; font-size:13px;background-color:#ffffff;; opacity:1;padding: 0 8px;display: block;">
			<thead>
            <tr><td height="45" colspan="78" style=" font-weight:bold; font-size:18px; text-align:left; padding-left:10px">Cart Items</td>
            </tr>
				<tr>
				  <td width="20%" height="21" style="width:20%;  border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">Product </td>
                  <td width="2%">&nbsp;</td>
				  <td width="31%" style=" border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">Price</td>
                  <td width="2%">&nbsp;</td>
				  <td width="14%" style="border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">
				  Qty</td>
                  <td width="1%"></td>
                  <td width="22%"  style="border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">Total Price</td>
				  <td width="8%">&nbsp;</td>
			  </tr>
              <tr>
				  <td width="20%" height="2" style="width:20%;  border-bottom:1px solid #CCCCCC;"></td>
                <td width="2%"></td>
				  <td width="31%" style="width:10%;  border-bottom:1px solid #CCCCCC;"></td>
                <td width="2%"></td>
			    <td width="14%" style="width:10%;  border-bottom:1px solid #CCCCCC;"></td>
                <td width="1%"></td>
                <td width="22%" style="width:10%; border-bottom:1px solid #CCCCCC;"></td>
			    <td width="8%" style="width:8%;"></td>
			  </tr>
			</thead>
            <tbody>
			<?php
			$grand_total = 0; $i = 1;
			foreach ($cart as $item):
				echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
				echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
				echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
				echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
				echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
				echo form_hidden('cart['. $item['id'] .'][color]', $item['options']['color']);
				echo form_hidden('cart['. $item['id'] .'][size]', $item['options']['size']);
				
					$grand_total = $grand_total + $item['subtotal'];                   
                    $prosize = $item['options']['size'];
                    $procolor = $item['options']['color'];
					
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
						$prodiscount = $discount.''.$dis_type.' ( '.$disamount.' Tk )';
					}
					elseif(isset($dis_type) && $dis_type=='Tk'){
						$pro_price = $ptotalprice - $discount;
						$prodiscount = $discount.''.$dis_type;
					}
				  }
				  else{
					 $pro_price=$pro->price;
					 $prodiscount = '';
				  }
			?>
				<tr>
					<td height="23" align="left" style="border-bottom:1px solid #CCCCCC; padding:2px;">
					<?php //echo $product['name']; 
					//$string=$product['images'];
				   //$photoTrolly=substr($string, 49, 36);
					?>
                    <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" title="<?php echo $item['name'];?>" width="40" height="40" />
                    </td>
                    <td>&nbsp;</td>
					<td align="right" style="border-bottom:1px solid #CCCCCC;">
                    <span class="cart_title">BDT <?php 
					if(is_numeric($pro_price)){
						echo number_format($pro_price,2);
					}
					else{
						echo $pro_price;
					}
					 ?></span></td>
                  <td>&nbsp;</td>
					<td align="right"  style="border-bottom:1px solid #CCCCCC;"><span class="left_nav_text"><?php echo $item['qty']; ?></span></td>
                  <td align="right">&nbsp;</td>
				  <td align="right" style="border-bottom:1px solid #CCCCCC;"><span class="cart_title"><?php echo number_format($item['subtotal'],2) ?></span></td>
                  <td>&nbsp;</td>
		  </tr>
			<?php   
			$i++;
			endforeach; 
			$grandTotalPrice = $grand_total;
				?>
		</tbody>
	
		<tfoot>
        <tr><td colspan="8">&nbsp;</td></tr>
			<tr>
				<td height="27" colspan="3"><strong>Sub Total</strong></td>
			<td colspan="4" align="right" id="gc_subtotal_price"><?php echo number_format($grand_total,2); ?></td>
            <td>&nbsp;</td>
		  </tr>
			<tr>
				<td height="23" colspan="3"><strong>Shipping Charge</strong></td>
			  <td colspan="4" align="right"><span id="shipval"></span></td>
                <td>&nbsp;</td>
		  </tr>	
            <tr>
				<td height="29" colspan="3"><strong>Have any Cupon ?</strong></td>
				<td colspan="4" align="right">
                	<input type="radio" name="cupon" id="yes" value="1" /> Yes
                    <input type="radio" name="cupon" id="no" value="0" checked="checked" /> No
                </td>
                <td>&nbsp;</td>
		  </tr>
           
           <tr id="codearea" style="display:none">
				<td height="32" colspan="7" align="right">
   	   				<input type="text" name="cuponcode" id="cuponcode" class="form-control" style="width:70%; float:left" placeholder="Enter Cupon Code" />
                    <input type="button" class="btn btn-warning" style="width:30%; float:left" value="Apply" onclick="cuponFunc();" />
                    <div id="msgc"></div>
                </td>
              <td>&nbsp;</td>
		  </tr>
			
            <tr>
				<td colspan="3" height="32"><strong>Grand Total</strong></td>
				<td colspan="4" align="right" >
                 <div id="grndtotal">
				 	<?php $grandTotalPrice=$grand_total;
						  echo number_format($grandTotalPrice,2); 
					?>
                </div>
                    <input type="hidden" id="totalprice" value="<?php echo $grandTotalPrice;?>" />
                </td>
                <td>&nbsp;</td>
		  </tr>                                                                                                                                                
		</tfoot>
		
	</table>
    
<?php
}
else{
  ?>
 <div style="color:#F00; font-size:16px; text-align:center"><?php echo $message?></div>
	
  <?php
  }
  ?>
</div>
