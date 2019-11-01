<div class="right_col" style="padding: 0 10px;">
    <div class="page-title">
        <div class="title_left" style="text-align:center; width:100%; padding:10px">
            <h1>Product list</h1>
        </div>
    </div>
    <?php
        if(isset($status) && !empty($status)) { ?>
            <div class="row">
                <div class="alert alert-dismissible <?php echo ($status_outlook) ? $status_outlook : '';?>">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $status; ?>
                </div>
            </div>
        <?php }
    ?>
    <div class="row seller-product-list">
        <?php if($product_list) :
        foreach($product_list->result() as $product) : ?>
            <a href="#" data-toggle="modal" data-target="#pro-<?php echo $product->product_id; ?>">
                <div class="col-md-3 product-list-item">
                    <div class="item-inner">
                        <div class="pro-img">
                            <img src="<?php echo base_url(). '/uploads/images/product/main_img/' . $product->main_image; ?>" alt="">
                        </div>
                        <div class="pro-meta">
                            <h4><?php echo $product->product_name; ?></h4>
                            <p><?php echo $product->price; ?> ৳</p>
                        </div>
                        <button class="btn btn-success seller-sell-btn">Sell</button>
                    </div>
                </div>
            </a>


            <!-- Modal -->
            <div id="pro-<?php echo $product->product_id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Order &#x2192; <?php echo $product->product_name; ?></h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('seller/product_list') ?>" method="POST">
                        <div class="form-group col-md-6" style="padding-left:0">
                            <label for="seller_sale_qty">Customer Name <span class="field-required">*</span></label>
                            <input type="text" class="form-control" name="customer_name" required>
                        </div>
                        <div class="form-group col-md-6" style="padding-right:0">
                            <label for="seller_sale_qty">Customer Mobile <span class="field-required">*</span></label>
                            <input type="text" class="form-control" name="customer_mobile" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="pro_id" value="<?php echo $product->product_id; ?>">
                            <label for="seller_sale_qty">Sale Quantity <span class="field-required">*</span></label>
                            <input type="hidden" value="<?php echo $product->price; ?>">
                            <input type="number" class="form-control" id="seller_sale_qty" name="pro_qty" onkeyup="totalPrice(this);" required>
                            <input type="hidden" name="total_price">
                        </div>
                        <div class="form-group">
                            <label for="comment">Shipping Address</label>
                            <textarea class="form-control" rows="2" name="shipping_address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment">Remarks</label>
                            <textarea class="form-control" rows="2" name="remarks" ></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary" style="font-weight:700;">Order</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="btn btn-info" style="text-align:left;float:left;margin:0;">Total: <span id="pro-<?php echo $product->product_id; ?>-total_price">00</span> ৳</p>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
            </div>
        <?php endforeach; endif; ?>
    </div>

    <div class="row">
        <div class="controls">
            <div id="paginationData" class="tsc_pagination">
                <ul><?php echo "<li>". $pagination."</li>"; ?></ul>
            </div>
        </div>
    </div>

</div>
<script>
    function totalPrice(ele) {
        var pro_qty = parseInt($(ele).val());
        var per_pro_price = parseInt($(ele).prev().val());
        if(pro_qty > 0) {
            $(ele).parents('.modal-body').next().children('p').children('span').text(per_pro_price * pro_qty);
            $(ele).next().val(per_pro_price * pro_qty);
        } else {
            $(ele).parents('.modal-body').next().children('p').children('span').text(0);
            $(ele).next().val(0);
        }
        
    }
</script>
