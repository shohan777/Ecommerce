<div class="right_col" style="padding: 0 10px;">
    <div class="page-title">
        <div class="title_left" style="text-align:center; width:100%; padding:10px">
            <h1>Order History</h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Order ID</th>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Customer</th>
                <th>Customer Mobile</th>
                <th style="width:20%">Shipping Address</th>
                <th>Order Date</th>
            </tr>
            </thead>
            <tbody>
                <?php if($product_list) :
                    $i = 1;
                    foreach($product_list->result() as $product) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $product->order_id; ?></td>
                    <td><?php echo $product->product_name; ?></td>
                    <td><?php echo $product->pro_qty; ?> pcs</td>
                    <td><?php echo $product->total_price; ?></td>
                    <td><?php echo $product->customer_name; ?></td>
                    <td><?php echo $product->customer_mobile; ?></td>
                    <td><?php echo $product->shipping_address; ?></td>
                    <td><?php echo $product->order_date; ?></td>
                </tr>
                <?php $i++; endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="controls">
            <div id="paginationData" class="tsc_pagination">
                <ul><?php echo "<li>". $pagination."</li>"; ?></ul>
            </div>
        </div>
    </div>

</div>

