<div class="right_col" role="main">

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
							<li>Order Reports</li>
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
						    <?php echo form_open_multipart('reports/orders_reports', 'class="form-horizontal form-label-left"');?>
                                <div id="registration_form">	
                                  	  <div class="panel-group">
                                      	  <div class="panel-body" style="margin:10% 2%;">
                                                    <div class="form-group">
                                                        <div class="col-sm-5 col-sm-offset-4">
                                                            <select name="cat_id" id="cat_id" class="form-control selectboxit">
                                                                 <option value="">Sister Concern</option>
                                                                   <?php foreach($sisterconcern->result() as $clsd){?>
                                                                <option value="<?php echo $clsd->cid;?>"><?php echo $clsd->cat_name;?></option>
                                                                <?php } ?>
                                                                </select>
                                                                <?php echo form_error('class_id','<p style="color:#ff0000;margin:0;">', '</p>');?>
                                                        </div>
                                                        
                                                        
                                                       </div>
                                                       
                                                       
                                                       <div class="form-group">
                                                        <div class="col-sm-12 text-center">
                                                          <input type="submit" name="search_student" class="btn btn-success  btn-xs" value="Search Orders">
                                                          <input type="submit" name="all_student" class="btn btn-danger  btn-xs" value="All Orders">
                                                      </div>
                                                       
                                                    </div>
                                                  
                                                    
    									</div>
                            		  </div>
                            	</div>
                            <?php echo form_close();?>
					</div>
