<?php include('admin_tophead.php');?>
<script>
	$(document).ready(function () {
		//alert('dfd');
		$("#instock_menu").click(function () {
			$("#instock_item").slideToggle();
		});
		$("#prestock_menu").click(function () {
			$("#prestock_item").slideToggle();
		});
	});

</script>

<body class="nav-md">
	<!--<div class="container body">-->
	<div class="top_nav">

		<div class="nav_menu">
			<div class="navbar nav_title" style="height:auto; background:none">
				<a href="#"><img class="admin-logo" src="<?php echo base_url('uploads/images/company/'.$clogo);?>" alt="<?php echo $cname;?>"></a>
			</div>
			<nav role="navigation">
				<div class="nav toggle">
					<a id="menu_toggle"><i class="fa fa-bars"></i></a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="">
						<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img src="<?php echo base_url();?>asset/images/img.jpg" alt="">
							<?php echo $this->session->userdata('AdminAccessName');?>
							<span class=" fa fa-angle-down"></span>
						</a>
						<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
							<li><a href="javascript:;"> Profile</a></li>
							<li><a href="<?php echo base_url('administration/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
							</li>
						</ul>
					</li>

				</ul>
			</nav>
		</div>

	</div>

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="margin:0; padding:0;background:#0e3863;">
		<div class="left_col">
			<div id="sidebar-menu" class="main_menu_side main_menu" style="margin-top:60px;">

				<?php if($this->session->userdata('AdminType')=="Super Admin" || 
							  $this->session->userdata('AdminType')=="Sub Admin" || 
							  $this->session->userdata('AdminType')=="Country Manager"):?>

				<div class="menu_section">
					<h3 style="font-size:16px">Master Setup</h3>
					<ul class="nav side-menu">

						<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/dashboard');?>">Dashboard</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-certificate"></i> Course <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/course/courses_list');?>">Courses List</a></li>
								<li><a href="<?php echo base_url('administration/course/category');?>">Courses Category</a></li>
								<li><a href="<?php echo base_url('administration/registration_list');?>">Registration list</a></li>
							</ul>
						</li>

						<li><a><i class="fa fa-desktop"></i>Configuration<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/configuration');?>">General Setting</a></li>
								<li><a href="<?php echo base_url('administration/passwordChange');?>"><i class="icon-alert"></i> Change
										Password</a></li>
							</ul>
						</li>

						<li><a><i class="fa fa-user"></i>Administration<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/admin_list');?>">Admin List</a></li>
								<li><a href="<?php echo base_url('administration/admin_registration');?>">New Admin Registration</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-bars"></i>Additional Menu<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/menu_list');?>">Menu List</a></li>
								<li><a href="<?php echo base_url('administration/menu_registration');?>">Menu Registration</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-newspaper-o"></i>Website Content<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/article_list');?>">Content List</a></li>
								<li><a href="<?php echo base_url('administration/article_registration');?>">Content Modification</a></li>
							</ul>
						</li>

						<li><a><i class="fa fa-picture-o"></i>Homepage Banner<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/banner_list');?>">Banner List</a></li>
								<li><a href="<?php echo base_url('administration/banner_registration');?>">Banner Modification</a></li>
							</ul>
						</li>

						<li><a><i class="fa fa-newspaper-o"></i>Shipping Charge<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/shipping_charge_list');?>">Shipping Charge List</a></li>
								<li><a href="<?php echo base_url('administration/shipping_charge_registration');?>">New Charge Entry</a></li>
							</ul>
						</li>

						<li><a><i class="fa fa-picture-o"></i>Offer<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/offer_list');?>">Offer List</a></li>
								<li><a href="<?php echo base_url('administration/offer_registration');?>">Offer Modification</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-picture-o"></i>Cupon<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/cupon_list');?>">Cupon List</a></li>
								<li><a href="<?php echo base_url('administration/cupon_registration');?>">Cupon Modification</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-picture-o"></i>Cupon Assign<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/cupon_user_list');?>">Assigned Cupon List</a></li>
								<li><a href="<?php echo base_url('administration/cupon_user_registration');?>">Cupon Assigned</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-picture-o"></i>Review Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/review_list');?>">Review List</a></li>
								<li><a href="<?php echo base_url('administration/review_registration');?>">Review Entry</a></li>
							</ul>
						</li>

						<li><a><i class="fa fa-picture-o"></i>Subcription Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/subscription_list');?>">Subcription List</a></li>
							</ul>
						</li>


						<?php /*?>
						<li><a><i class="fa fa-picture-o"></i>Supplier Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/supplier_list');?>">Supplier List</a></li>
								<li><a href="<?php echo base_url('administration/supplier_registration');?>">New Supplier</a></li>
							</ul>
						</li>
						<?php */?>

						<li><a><i class="fa fa-bars"></i>Product Category<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/category_list');?>">Category List</a></li>
								<li><a href="<?php echo base_url('administration/category_registration');?>">New Category</a></li>
								<li><a href="<?php echo base_url('administration/sub_category_list');?>">Sub Category List</a></li>
								<li><a href="<?php echo base_url('administration/sub_category_registration');?>">New Sub Category</a></li>
								<li><a href="<?php echo base_url('administration/last_category_list');?>">Last Category List</a></li>
								<li><a href="<?php echo base_url('administration/last_category_registration');?>">New Last Category</a></li>
							</ul>
						</li>

						<li><a><i class="fa fa-bars"></i>Product Size<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/size_list');?>">Size List</a></li>
								<li><a href="<?php echo base_url('administration/size_registration');?>">New Size</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-bars"></i>Product Color<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/color_list');?>">Color List</a></li>
								<li><a href="<?php echo base_url('administration/color_registration');?>">New Color</a></li>
							</ul>
						</li>
						<li><a href="<?php echo base_url('administration/product_registration');?>" style="color:#fff; font-size:15px; text-transform:uppercase;letter-spacing: .5px; font-weight: bold;text-shadow: 1px 1px #000; ">
								<i class="fa fa-plus"></i> Product Upload</a>
						</li>
						<li><a href="<?php echo base_url('administration/product_list');?>" style="color:#fff; font-size:15px; text-transform:uppercase;letter-spacing: .5px; font-weight: bold;text-shadow: 1px 1px #000; ">
								<i class="fa fa-bars"></i> Product List</a>
						</li>
					</ul>

				</div>

				<div class="menu_section">
					<h3 style="font-size:16px; margin-left:5px; padding:0;">Order & Customer</h3>
					<ul class="nav side-menu">
						<li><a><i class="fa fa-users"></i>Our Customer<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/customer_list');?>">Customer List</a></li>
								<li><a href="<?php echo base_url('administration/customer_registration');?>">New Customer</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-shopping-cart"></i>Order<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">

								<li><a href="<?php echo base_url('administration/order_list');?>">Order List</a></li>
								<li><a href="<?php echo base_url('administration/seller_order');?>">Seller Order List</a></li>
								<!--<li><a href="<?php echo base_url('administration/final_order?s='.base64_encode('success'));?>">Successfull Order</a></li>
                                        <li><a href="<?php echo base_url('administration/final_order?s='.base64_encode('return'));?>">Returned Order</a></li>
                                        <li><a href="<?php echo base_url('administration/final_order?s='.base64_encode('miss'));?>">Miss Delivered Order</a></li>
                                        <li><a href="<?php echo base_url('administration/final_order?s='.base64_encode('demage'));?>">Demaged Order</a></li>
                                        <li><a href="<?php echo base_url('administration/final_order?s='.base64_encode('cancel'));?>">Cancelled Order</a></li>-->
							</ul>
						</li>



						<li><a><i class="fa fa-archive"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/stockin_reports');?>">Stock Management</a></li>

							</ul>
						</li>


					</ul>
				</div>

				<div class="menu_section">
					<h3 style="font-size:16px; margin-left:5px; padding:0;">Seller</h3>
					<ul class="nav side-menu">
						<li><a><i class="fa fa-shopping-cart"></i>Seller<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/seller');?>"><i class="icon-gear"></i> Seller Application</a></li>
							</ul>
						</li>
					</ul>
				</div>

				<div class="menu_section">
					<h3 style="font-size:16px; margin-left:5px; padding:0;">Accounts</h3>
					<ul class="nav side-menu">
						<li><a><i class="fa fa-shopping-cart"></i>Opening Balance<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/opening_asset');?>"><i class="icon-gear"></i> Asset</a></li>
								<li><a href="<?php echo base_url('administration/opening_liabilities');?>"><i class="icon-alert"></i>
										Liabilitues</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-shopping-cart"></i>Assets<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="javascript:void()"><i class="icon-gear"></i> Current Assets</a>
									<ul class="nav side-menu">
										<li><a href="<?php echo base_url('administration/current_asset_master_head');?>">
												<i class="icon-gear"></i> Master Head</a></li>
										<li><a href="<?php echo base_url('administration/current_asset_sub_head');?>"><i class="icon-alert"></i> Sub
												Head</a></li>
									</ul>
								</li>
								<li><a href="<?php echo base_url('administration/datewise_reports');?>"><i class="icon-alert"></i> Fixed Asset</a>
									<ul class="nav side-menu">
										<li><a href="<?php echo base_url('administration/fixed_asset_master_head');?>">
												<i class="icon-gear"></i> Master Head</a></li>
										<li><a href="<?php echo base_url('administration/fixed_asset_sub_head');?>"><i class="icon-alert"></i> Sub
												Head</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a><i class="fa fa-shopping-cart"></i>Liabilities<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="javascript:void();"><i class="icon-gear"></i> Current Liabilities</a>
									<ul class="nav side-menu">
										<li><a href="<?php echo base_url('administration/current_liabilities_master_head');?>">
												<i class="icon-gear"></i> Master Head</a></li>
										<li><a href="<?php echo base_url('administration/current_liabilities_sub_head');?>">
												<i class="icon-alert"></i> Sub Head</a></li>
									</ul>
								</li>
								<li><a href="javascript:void();"><i class="icon-alert"></i> Long-term Liabilities</a>
									<ul class="nav side-menu">
										<li><a href="<?php echo base_url('administration/longterm_liabilities_master_head');?>">
												<i class="icon-gear"></i> Master Head</a></li>
										<li><a href="<?php echo base_url('administration/longterm_liabilities_sub_head');?>">
												<i class="icon-alert"></i> Sub Head</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a><i class="fa fa-shopping-cart"></i>Revenue<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/revenue');?>"><i class="icon-gear"></i> Revenue</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-shopping-cart"></i>Expenses<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/expenses');?>"><i class="icon-gear"></i> Expenses</a></li>
							</ul>
						</li>
					</ul>
				</div>


				<div class="menu_section">
					<h3 style="font-size:16px; margin-left:5px; padding:0;">Reports</h3>
					<ul class="nav side-menu">
						<li><a href="<?php echo base_url('reports/product');?>">
								<i class="fa fa-bar-chart" aria-hidden="true"></i> Product Reports</a></li>
						<li><a href="<?php echo base_url('reports/orders');?>">
								<i class="fa fa-bar-chart" aria-hidden="true"></i> Order Reports</a></li>
						<li><a href="<?php echo base_url('reports/customer');?>">
								<i class="fa fa-bar-chart" aria-hidden="true"></i> Customer Reports</a></li>
						<li><a href="<?php echo base_url('reports/transaction');?>">
								<i class="fa fa-bar-chart" aria-hidden="true"></i> Transaction Reports/Balance Sheet</a></li>
						<li><a href="<?php echo base_url('reports/expanse');?>">
								<i class="fa fa-bar-chart" aria-hidden="true"></i> Expense Reports</a></li>
						<li><a href="<?php echo base_url('reports/collection');?>">
								<i class="fa fa-bar-chart" aria-hidden="true"></i> Collection Reports</a></li>
						<li><a href="<?php echo base_url('reports/stock');?>">
								<i class="fa fa-bar-chart" aria-hidden="true"></i> Stock Reports</a></li>

					</ul>
				</div>

				<?php 
						 endif;
						 if(($this->session->userdata('AdminType')!="Super Admin") && 
						 ($this->session->userdata('AdminType')!="Sub Admin") && ($this->session->userdata('AdminType')!="Country Manager")){
							   $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
							   ?>

				<div class="menu_section">
					<h3 style="font-size:16px; margin-left:5px; padding:0;">
						<?php echo $this->session->userdata('AdminType');?>
					</h3>
					<ul class="nav side-menu">
						<?php if(in_array('category',$userAccess)){?>
						<li><a><i class="fa fa-bars"></i>Category<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/category_list');?>">Category List</a></li>
								<li><a href="<?php echo base_url('administration/category_registration');?>">New Category</a></li>
								<li><a href="<?php echo base_url('administration/sub_category_list');?>">Sub Category List</a></li>
								<li><a href="<?php echo base_url('administration/sub_category_registration');?>">New Sub Category</a></li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('product_entry',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>Product Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/product_registration');?>">New Product</a></li>
							</ul>
						</li>
						<?php } ?>

						<?php if(in_array('instockproduct',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>In Stock Product<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/product_list');?>">Product List</a></li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('order',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>In Stock Order<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/order_list');?>">Order List</a></li>
							</ul>
						</li>
						<?php } ?>

						<?php if(in_array('stock',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/purchasestock');?>">Stock Management</a></li>
								<li> <a href="<?php echo base_url('administration/purchasestock');?>">Stock Out</a></li>

							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('accounts',$userAccess)){?>
						<li><a><i class="fa fa-bars"></i> Asset & Investment<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/asset_investment_list');?>">Asset List</a></li>
								<li><a href="<?php echo base_url('administration/asset_investment_registration');?>">New Asset</a>
								</li>
							</ul>
						</li>

						<li><a><i class="fa fa-bars"></i> Internal Cost<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/internal_cost_list');?>">Cost List</a></li>
								<li><a href="<?php echo base_url('administration/internal_cost_registration');?>">New Cost</a>
								</li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('reports',$userAccess)){?>
						<li><a><i class="fa fa-bars"></i> Reports<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/daily_sale_reports');?>">Daily Sales Report</a></li>
								<li><a href="<?php echo base_url('administration/datewise_sale_reports');?>">Date Wise Sales Report</a></li>

								<li><a href="<?php echo base_url('administration/today_reports');?>">Daily Balance Sheet</a></li>
								<li><a href="<?php echo base_url('administration/datewise_reports');?>">Date Wise Balance Sheet</a></li>

								<li><a href="<?php echo base_url('administration/purchasereport');?>">Purchase Invoice Reports</a></li>
								<li> <a href="<?php echo base_url('administration/stockin_reports');?>">Current Stock Report</a></li>
								<!--
                                         <li> <a href="<?php echo base_url()?>storestock_report/sales_invoice">Salesman Invoice History</a></li>
                                        <li> <a href="<?php echo base_url()?>userstock_report/showroom">Showroom Invoice History</a></li>
                                        <li> <a href="<?php echo base_url('administration/stockout_reports');?>">Stockout History</a></li>-->
							</ul>
						</li>
						<?php } ?>



						<?php if(in_array('pre_product',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>Pre Order Product<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/pre_product_list');?>">Product List</a></li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('pre_order',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>Pre Stock Order<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/pre_order_list');?>">Order List</a></li>
							</ul>
						</li>
						<?php } ?>

						<?php if(in_array('pre_stock',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/pre_purchasestock');?>">Stock Management</a></li>
								<li> <a href="<?php echo base_url('administration/pre_purchasestock');?>">Stock Out</a></li>

							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('pre_accounts',$userAccess)){?>
						<li><a><i class="fa fa-bars"></i> Asset & Investment<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/pre_asset_investment_list');?>">Asset List</a></li>
								<li><a href="<?php echo base_url('administration/pre_asset_investment_registration');?>">New Asset</a>
								</li>
							</ul>
						</li>

						<li><a><i class="fa fa-bars"></i> Internal Cost<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/pre_internal_cost_list');?>">Cost List</a></li>
								<li><a href="<?php echo base_url('administration/pre_internal_cost_registration');?>">New Cost</a>
								</li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('pre_reports',$userAccess)){?>
						<li><a><i class="fa fa-bars"></i> Reports<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/pre_daily_sale_reports');?>">Daily Sales Report</a></li>
								<li><a href="<?php echo base_url('administration/pre_datewise_sale_reports');?>">Date Wise Sales Report</a></li>
								<li><a href="<?php echo base_url('administration/pre_today_reports');?>">Daily Balance Sheet</a></li>
								<li><a href="<?php echo base_url('administration/pre_datewise_reports');?>">Date Wise Balance Sheet</a></li>
								<li><a href="<?php echo base_url('administration/pre_purchasereport');?>">Purchase Invoice Reports</a></li>
								<li> <a href="<?php echo base_url('administration/pre_stockin_reports');?>">Current Stock Report</a></li>
							</ul>
						</li>
						<?php } ?>






						<?php if(in_array('email_message',$userAccess)){?>
						<li><a><i class="fa fa-comment"></i>Email & Messages<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/customerQuery_list');?>">Email</a></li>
								<li><a href="<?php echo base_url('administration/customerQuery_list');?>">Messages</a></li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('customer',$userAccess)){?>
						<li><a><i class="fa fa-users"></i>Customer<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/customer_list');?>">Customer List</a></li>
							</ul>
						</li>
						<?php } ?>





						<?php if(in_array('menu',$userAccess)){?>
						<li><a><i class="fa fa-bars"></i>Menu Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/menu_list');?>">Menu List</a></li>
								<li><a href="<?php echo base_url('administration/menu_registration');?>">Menu Registration</a></li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('content',$userAccess)){?>
						<li><a><i class="fa fa-font"></i>Article Manage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/article_list');?>">Article List</a></li>
								<li><a href="<?php echo base_url('administration/article_registration');?>">Article Registration</a></li>
							</ul>
						</li>
						<?php } ?>
						<?php if(in_array('banner',$userAccess)){?>
						<li><a><i class="fa fa-picture-o"></i>Banner Banage<span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url('administration/banner_list');?>">Banner List</a></li>
								<li><a href="<?php echo base_url('administration/banner_registration');?>">Banner Registration</a></li>
							</ul>
						</li>
						<?php } ?>

					</ul>
				</div>

				<?php } ?>


			</div>




			<div class="sidebar-footer hidden-small">
				<a data-toggle="tooltip" data-placement="top" title="Settings">
					<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
				</a>
				<a data-toggle="tooltip" data-placement="top" title="FullScreen">
					<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
				</a>
				<a data-toggle="tooltip" data-placement="top" title="Lock">
					<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
				</a>
				<a data-toggle="tooltip" data-placement="top" title="Logout">
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
