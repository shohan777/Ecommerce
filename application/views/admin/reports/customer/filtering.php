<div class="right_col" role="main">

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
							<li>Customer Reports</li>
						</ul>
						<ul class="breadcrumb-elements">
							<div class="heading-btn-group">
                                <a href="javascript:void();" onclick="history.back()" class="btn btn-link btn-float has-text" style="color:#FF0000">
                                <i class="fa fa-arrow-left"></i><span>Back</span></a>
							</div>
						</ul>
				  
					</div>
</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						    <?php echo form_open_multipart('reports/customer_reports', 'class="form-horizontal form-label-left"');?>
                                <div id="registration_form">	
                                  	  <div class="panel-group">
                                      	  <div class="panel-body" style="margin:10% 2%;">
                                                    <div class="form-group">
                                                        <div class="col-sm-4">
                                                            <input type="text" name="username" placeholder="Customer Name" class="form-control" />
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="email" name="email" placeholder="Email" class="form-control" />
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="mobile" placeholder="Mobile" class="form-control" />
                                                        </div>
                                                       </div>
                                                    
                                                       
                                                       
                                                       <div class="form-group">
                                                        <div class="col-sm-12 text-center">
                                                          <input type="submit" name="search_customert" class="btn btn-success  btn-xs" value="Search Student">
                                                          <input type="submit" name="all_customert" class="btn btn-danger  btn-xs" value="All Student">
                                                      </div>
                                                       
                                                    </div>
                                                  
                                                    
    									</div>
                            		  </div>
                            	</div>
                            <?php echo form_close();?>
					</div>
