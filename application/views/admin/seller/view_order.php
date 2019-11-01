<?php 
if($seller_order_data) : 
    extract($seller_order_data->row_array());
endif; ?>

<script type="text/javascript">

function update_status(id){
var seller_id = document.getElementById("seller_id").value;
var product_id = document.getElementById("product_id").value;
var total_price = document.getElementById("total_price").value;
var status = document.getElementById("status").value;
window.location.href='<?php echo base_url();?>administration/update_status?status='+status+"&&id="+id+"&&table="+'sbgift_seller_order'+"&&seller_id="+seller_id+"&&product_id="+product_id+"&&total_price="+total_price;
}


</script>
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:5px;
	color:#000;
}
.summTable .theadline td, th{
	padding:5px;
	color:#fff;
	background:#333;
}
.modallabel{
	font-size:15px; 
	font-weight:bold; 
	color:#333;
}
</style>

<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Order Details</h3>
            </div>
            
        </div>
        <div class="clearfix"></div>
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- ######## -->
                        <h2 style="float:left; width:50%; text-align:left">
                        <a href="<?php echo base_url('administration/seller_order') ?>" class="btn btn-primary">&#8592; Back</a>
                        <!-- ######## -->
                        </h2>
                        <h2 style="float:right; width:50%; text-align:right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invoiceModal">Get Invoice</button>
                        <!-- ######## -->
                        </h2>
                        <div class="clearfix"></div>
                        
                        
                    </div>
                    <div class="x_content">
                    <div style="width:100%"><?php echo $this->session->flashdata('failedMsg');?></div>
                    <div class="container">
                        <table width="100%" border="0" cellspacing="3" cellpadding="3">
                                <tr>
                                <td width="33%"><h3>Customer Information</h3></td>
                                <td width="36%"><h3>Shipping Address</h3></td>
                                </tr>
                                <tr>
                                <td valign="top">
                                    <table width="98%" border="0" cellspacing="1" cellpadding="1">
                                        <tr>
                                        <td><?php echo $customer_name;?></td>
                                        </tr>
                                        <tr>
                                        <td><?php echo $shipping_address;?></td>
                                        </tr>
                                        <tr>
                                        <td><?php echo $customer_mobile;?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td valign="top">
                                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                        <tr>
                                        <td><?php echo $customer_name;?></td>
                                        </tr>
                                        <tr>
                                        <td><?php echo $shipping_address;?></td>
                                        </tr>
                                        <tr>
                                        <td><?php echo $customer_mobile;?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>&nbsp;</td>
                                </tr>
                                <tr>
                                <td colspan="6">&nbsp;</td>
                                </tr> 
                                <tr>
                                <td><h3>Order Status</h3></td>
                                </tr>
                                <tr>
                                <td valign="top">
                                    <select name="status" id="status" class="form-control" style="width:60%; float:left; margin:3px;padding:5px">
                                        <option value="Processing" <?php echo ($seller_order_status == 'Processing') ? 'selected' : '' ?>>Processing</option>
                                        <option value="Cancelled" <?php echo ($seller_order_status == 'Cancelled') ? 'selected' : '' ?>>Cancelled</option>
                                        <option value="Delivered" <?php echo ($seller_order_status == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
                                    </select>
                                    <input type="hidden" id="seller_id" name="seller_id" value="<?php echo $seller_id ?>">
                                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ?>">
                                    <input type="hidden" id="total_price" name="seller_id" value="<?php echo $total_price ?>">
                                    <button type="button" onclick="update_status(<?php echo $order_id;?>);" class="btn btn-primary" style="margin:3px;">Save</button>  
                                </td>
                                </tr>
                                <tr><td colspan="6"  height="5"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                <tr><td colspan="6"  height="40" bgcolor="#FFFFFF"><h3 style="padding:0; margin:0">Order Details</h3></td></tr>
                                <tr><td colspan="6"  height="5"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                
                                <!-- ****************** -->
                                <tr>
                                <td colspan="5" valign="top">
                                    <table style="width:100%" class="table summTable">
                                        <tr class="theadline">
                                        <td width="56" height="36" align="center"><span class="style2">SI</span></td>
                                        <td width="472" align="center">Name</td>
                                        <td width="127" align="center">Category</td>
                                        <td width="226" align="center">Image</td>
                                        <td width="121" align="center"> Code</td>
                                        <td width="158" align="center">Quantity</td>
                                        <td width="125" align="center">Price</td>
                                        <td width="143" align="center"><span class="style2">Total Price</span></td>
                                        </tr>
                                        <input type="hidden" value="<?php echo $order_id;?>" id="orderid" />
                                        <tr style="border-bottom:1px solid #ccc; font-size:13px;">
                                            <td height="44" align="center"><h6>1</h6></td>
                                            <td align="center" ><h6><?php echo $product_name;?></h6></td>
                                            <td align="center" ><h6><?php echo $cat_id;?></h6></td>
                                            <td align="center" >
                                                <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" 
                                                style="width:80px; height:50px; margin:5px; border:1px solid #333" />
                                            </td>
                                            <td align="center" ><h6><?php echo $pro_code;?></h6></td>
                                            <td align="center" ><h6><?php echo $pro_qty;?></h6></td>
                                            <td align="center" ><h6><?php echo $price;?></h6></td>
                                            
                                            <td align="center" ><h6><strong>TK <?php echo $total_price;?></strong></h6></td>
                                        </tr>
                                    </table>
                                </td>
                                </tr>
                                
                                <!-- ****************** -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
               