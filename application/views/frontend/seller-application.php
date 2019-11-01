<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
    <div class="container" style="margin:20px auto;">
        <div class="content_details">
            <div class="col-sm-12">
                <?php
                    if(isset($status) && !empty($status)) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $status; ?>
                        </div>
                    <?php }
                ?>
                <h2>Seller Application Form</h2>
                <form class="form-horizontal" action="<?php echo base_url('seller/application'); ?>" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="full_name">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name" placeholder="Full Name" name="full_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="mobile">Mobile</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email</label>
                            <div class="col-sm-10">          
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Apply</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="address">Address</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="address" placeholder="Address" name="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="area">Area</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="area" placeholder="Area" name="area">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="city">City</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="city" placeholder="City" name="city">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
