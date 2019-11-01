<div class="left-sidebar">
    <h2><?php echo $userProfile['username'];?></h2>
    <div class="col-sm-12" style="margin:3px 0; padding:0;">
         <div class="boutuqueList">
                <ul>
                    <li><a href="<?php echo base_url('profile');?>">Dashboard<span class="fa fa-angle-double-right pull-right"></span></a></li>
                   <!-- <li><a href="#">Order History <span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="#">Track Order <span class="fa fa-angle-double-right pull-right"></span></a></li>-->
                    <li><a href="<?php echo base_url('profile/wishlist');?>">My Wishlist <span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('profile/order_list');?>">Order List <span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('profile/product_list');?>">Ordered Product List <span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('profile/updateprofile');?>">Update Profile<span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('profile/changepassword');?>">Change Password<span class="fa fa-angle-double-right pull-right"></span></a></li>
                </ul>	
            </div>
    </div>
</div>