
<div class="right_col" role="main">

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
							<li>Stock Reports</li>
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
						    <?php echo form_open_multipart('reports/stock_reports', 'class="form-horizontal form-label-left"');?>
                                <div id="registration_form">	
                                  	  <div class="panel-group">
                                      	  <div class="panel-body" style="margin:10% 2%;">
                                                    <div class="form-group">                                   
                                                            <div class="col-sm-3 col-sm-offset-3">
                                                                <label class="col-sm-2" style="margin-top:26px; font-weight:bold">From</label>
                                                                <div class="col-sm-10">
                                                               <input type="text" name="from_date" class="form-control date-picker" 
                                                               placeholder="From Date"  style="margin-top:20px;"/>
                                                               </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label class="col-sm-2" style="margin-top:26px; font-weight:bold">To</label>
                                                                <div class="col-sm-10">
                                                               <input type="text" name="to_date" class="form-control date-picker"
                                                                placeholder="To Date"  style="margin-top:20px;"/>
                                                                </div>
                                                            </div>
                                                        
                                                       </div>
                                                       
                                                       
                                                       <div class="form-group">
                                                        <div class="col-sm-12 text-center">
                                                          <input type="submit" name="search_stock" class="btn btn-success  btn-xs" value="Search">
                                                          <input type="submit" name="currentstock" class="btn btn-warning  btn-xs" value="Current Stock">
                                                          <!--<input type="submit" name="stockin" class="btn btn-primary  btn-xs" value="Stock IN">
                                                          <input type="submit" name="stockout" class="btn btn-danger  btn-xs" value="Stock OUT">-->
                                                          
                                                      </div>
                                                       
                                                    </div>
                                                   
                                                    
    									</div>
                            		  </div>
                            	</div>
                            <?php echo form_close();?>
					</div>

