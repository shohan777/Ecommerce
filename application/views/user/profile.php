
	<div class="right_col">
        <div class="page-title">
            <div class="title_left" style="text-align:center; width:100%; padding:10px">
                <h1>Profile</h1>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if(isset($status) && !empty($status)) { ?>
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $status; ?>
                <?php ?>
            </div>
            <?php } ?>
                <div class="x_panel">
                    <div class="x_title">
                      <div class="col-md-12 col-sm-12 col-xs-12" style="margin:5% 0 10% 0;">
                        <form class="form-horizontal" action="<?php echo base_url('seller/profile'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="full_name">Seller Code:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name" placeholder="Seller Code" value="<?php echo $seller_data['seller_code'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="full_name">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name" placeholder="Full Name" name="full_name" value="<?php echo $seller_data['full_name'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="mobile">Mobile</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile" value="<?php echo $seller_data['mobile'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="bkash_number">Bkash Number</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="bkash_number" placeholder="Bkash Number" name="bkash_number" value="<?php echo $seller_data['bkash_number'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="bank_account">Bank Account</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="bkash_number" placeholder="Bank Account" name="bank_account" value="<?php echo $seller_data['bank_account'] ?>">
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email</label>
                            <div class="col-sm-10">          
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $seller_data['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="address">Address</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $seller_data['address'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="area">Area</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="area" placeholder="Area" name="area" value="<?php echo $seller_data['area'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="city">City</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $seller_data['city'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Logo<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="profile_image" class="form-control col-md-7">
                                <?php 
                                    if($seller_data['profile_image']!=""){
                                        echo '<img src="'.base_url('uploads/images/seller/profile/'.$seller_data['profile_image']).'" style="width:100px; height:auto" />';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>                 
                    </div>
                    
                </div>
            </div>
        </div>
    
    </div>
	</div>
