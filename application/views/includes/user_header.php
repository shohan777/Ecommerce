<?php include('admin_tophead.php');?>
<?php 
    $seller_balance = $this->Index_model->seller_balance($this->session->userdata('SellerID'))->row_array();
?>
<script>
$(document).ready(function(){
	//alert('dfd');
	$("#instock_menu").click(function(){
		$("#instock_item").slideToggle();
	});
	$("#prestock_menu").click(function(){
		$("#prestock_item").slideToggle();
	});
});
</script>
<style>
    .user-profile {
        position: relative;
    }
    .seller_code {
        position: absolute;
        left: 38px;
        bottom: -15px;
        right: 0;
        margin: 0 auto;
        text-align: right;
        font-weight: 700;
        color: #d84315;
        font-size: 12px;
        padding-right: 19px;
    }
</style>
<body class="nav-md" style="background: #172d44;">
    <!--<div class="container body">-->
    		<div class="top_nav">

                <div class="nav_menu">
               		<div class="navbar nav_title" style="height:auto; background:none">
                        <a href="#"><img src="<?php echo base_url();?>/uploads/images/company/<?php echo $clogo ?>"  style="width:70%; height:auto"></a>
                    </div>
                    <nav role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="balance" style="float:left;padding:15px 0 0;">
                            <p style="margin-bottom: 0;font-weight: 700;font-size:14px;color:<?php echo ($seller_balance['balance'] > 1) ? 'green' : 'red' ;?>">Balance: <span><?php echo $seller_balance['balance'] ;?></span> BDT</p>
                            <p style="margin-bottom: 0;font-weight: 700;font-size:14px;color:<?php echo ($seller_balance['commission'] > 1) ? 'green' : 'red' ;?>">Commission: <span><?php echo $seller_balance['commission'] ;?></span> BDT</p>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url();?>uploads/images/seller/profile/<?php echo $this->session->userdata('SellerImage');?>" alt=""><?php echo $this->session->userdata('SellerName');?>
                                    <span class="seller_code"><?php echo $this->session->userdata('SellerCode');?></span>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo base_url('seller/profile');?>">  Profile</a></li>
                                    <li><a href="<?php echo base_url('seller/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="margin:0; padding:0;background: #172d44;">
            	<div class="left_col">
                    <div id="sidebar-menu" class="main_menu_side main_menu" style="margin-top:60px;">

                        	
                                <div class="menu_section">
                                <h3 style="font-size:16px">Function</h3>
                                <ul class="nav side-menu">
                             
                                    <li><li><a href="<?php echo base_url('seller/dashboard');?>">Dashboard</a></li></li>

                                    <li><a><i class="fa fa-home"></i> Sell <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('seller/product_list') ?>"><i class="fa fa-bank"></i>Product</a></li>
                                            <li><a href="<?php echo base_url('seller/order_list') ?>"><i class="fa fa-bank"></i>Order History</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo base_url('seller/commission_rate') ?>"><i class="fa fa-bank"></i>Commission Rate</a></li>
                                    
                                    <li><a href="<?php echo base_url('seller/profile') ?>"><i class="fa fa-bank"></i>Profile</a></li>
                                                        
                                 </ul>
                              </div>
                    </div>
                    
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">&nbsp;</a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">&nbsp;</a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">&nbsp;</a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('seller/logout');?>">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            