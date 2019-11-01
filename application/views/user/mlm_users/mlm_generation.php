<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="breadcrumb">
                        Detail of Generation Commission / <strong><a href="./mlm_wallet">Back</a></strong>
                    </div>
                    <?php
                        if($total_transaction) : ?>
                    <table class="table table-striped" width="100%">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; $gen_point_total = 0; foreach($total_transaction as $transaction) : ?>
                          <tr>
                            <td><?php echo $i; ?></td>                
                            <td><?php echo $transaction['date'] ?></td>         
                            <td><?php echo $transaction['generation_com']; ?></td>       
                          </tr>
                        <?php $i++;$gen_point_total+=$transaction['generation_com']; endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td></td>
                                <td><strong><?php echo $gen_point_total;?></strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <?php else :
                        echo $no_data;
                        endif; 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
               