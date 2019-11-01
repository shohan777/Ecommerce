<style>
    .delivered {
        color: #3c763d;
    }
    .processing {
        color: #31708f;
    }
    .cancelled {
        color: #a94442;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        border-top: 1px solid #fff;
    }
</style>
<div class="right_col" style="padding: 0 10px;">
    <div class="page-title">
        <div class="title_left" style="text-align:center; width:100%; padding:10px">
            <h1>Seller Order History</h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Customer</th>
                <th>Customer Mobile</th>
                <th style="width:20%">Shipping Address</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if($product_list) :
                $i = 1;
                foreach($product_list->result() as $product) : 
                    if($product->status == 'Cancelled') : ?>
                    <tr class="cancelled" style="background: #f2dede">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $product->order_id; ?></td>
                        <td><?php echo $product->total_price; ?></td>
                        <td><?php echo $product->customer_name; ?></td>
                        <td><?php echo $product->customer_mobile; ?></td>
                        <td><?php echo $product->shipping_address; ?></td>
                        <td><?php echo $product->order_date; ?></td>
                        <td><?php echo $product->status; ?></td>
                        <td align="left" class="section">
                            <a href="<?php echo base_url();?>administration/seller_view_order/<?php echo $product->order_id;?>" class="btn btn-success"  title="View Order Details"
                            style="padding:0 5px; font-size:12px;"><i class="fa fa-eye"></i></a>
                            <a href="javascript:void();" onclick="orderDelete('<?php echo $product->order_id;?>');" 
                            class="btn btn-danger"  title="Delete Order" style="padding:0 5px; font-size:12px;"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php else : ?>
                    <tr class="<?php echo ($product->status == 'Delivered') ? 'delivered' : 'processing' ?>" style="background: <?php echo ($product->status == 'Delivered') ? '#DFF0D8' : '#bce8f1' ?>">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $product->order_id; ?></td>
                        <td><?php echo $product->total_price; ?></td>
                        <td><?php echo $product->customer_name; ?></td>
                        <td><?php echo $product->customer_mobile; ?></td>
                        <td><?php echo $product->shipping_address; ?></td>
                        <td><?php echo $product->order_date; ?></td>
                        <td><?php echo $product->status; ?></td>
                        <td align="left" class="section">
                            <a href="<?php echo base_url();?>administration/seller_view_order/<?php echo $product->order_id;?>" class="btn btn-success"  title="View Order Details"
                            style="padding:0 5px; font-size:12px;"><i class="fa fa-eye"></i></a>
                            <a href="javascript:void();" onclick="orderDelete('<?php echo $product->order_id;?>');" 
                            class="btn btn-danger"  title="Delete Order" style="padding:0 5px; font-size:12px;"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endif; ?>
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

