<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="breadcrumb">
                        Total Balance: <?php echo $commission['wallet'];?> BDT
                    </div>
                    <?php
                        if($commission) : ?>
                    <table class="table table-striped" width="100%">
                        <thead>
                        <tr>
                            <th>Wallet Type</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Show Detail</th>
                        </tr>
                        </thead>
                        <tbody>
						  <tr>
                            <td>Withdrawal Request</td>                
                            <td>0</td>         
                            <td>0</td>         
                            <td><a class="btn btn-primary btn-sm" href="../mlmuser/mlm_withdrawal">Show Detail</a></td>         
                          </tr>
                          <tr>
                            <td>Sells Commission</td>                
                            <td>0</td>         
                            <td><?php echo $commission['sells']; ?></td>         
                            <td><a class="btn btn-primary btn-sm" href="#">Show Detail</a></td>         
                          </tr>
                          <tr>
                            <td>Matching Commission</td>                
                            <td>0</td>         
                            <td><?php echo $commission['matching']; ?></td>         
                            <td><a class="btn btn-primary btn-sm" href="../mlmuser/detail_matching">Show Detail</a></td>         
                          </tr>
                          <tr>
                            <td>Generation Commission</td>                
                            <td>0</td>         
                            <td><?php echo $commission['generation']; ?></td>         
                            <td><a class="btn btn-primary btn-sm" href="../mlmuser/detail_generation">Show Detail</a></td>         
                          </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>0</strong></td>
                                <td><strong><?php echo $commission['total_credit'];?></strong></td>
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
               