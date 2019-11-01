
<style>
	.required{
	color:#f00;
}
#exTab2 h3 {
	  color : white;
	  background-color: #428bca;
	  padding : 5px 15px;
	}
.tab-content{
	margin:10px;
	background:#f5f5f5;
	padding:10px;
	border-radius:10px;
	border:1px solid #ccc;
}


.hidden {
    display:none;
}
.button {
    border: 1px solid #f5f5f5;
    padding: 5px;
    background: #000066;
    color: #fff;
    width:100%;
	font-size:16px;
	text-align:center;
}

.button:hover {
    background: #333;
    cursor: pointer;
}
</style>
 
<div class="right_col" role="main" ng-app="appTable" ng-controller="ItemsController">
	<div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Bonus Range Form</h2>
						<a class="btn btn-primary pull-right" href="<?php echo base_url('administration/bonusrangelist'); ?>">Bonus Range List</a>
						<div class="clearfix"></div>
					</div>
					<h2> <?php echo $successMsg ;?></h2>
					<div class="x_content">
						<?php echo form_open_multipart('', 'class="form-horizontal form-label-left"'); ?>
						<div id="registration_form">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">											
											<h4 class="panel-title"></h4>Bonus Range Information </h4>
										</a>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<div id="exTab2">											
												<div class="tab-content">
													<div class="tab-pane active" id="general">													 
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Product Amount<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="text" name="from_pro_amount" required class="form-control col-md-7 col-xs-12" placeholder='From Product Amount'
																  onFocus="this.placeholder=''" onBlur="this.placeholder='From Product Amount'">
															 
															</div>
														</div>	
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Product Amount<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="text" name="to_pro_amount" required class="form-control col-md-7 col-xs-12" placeholder='To Product Amount'
																  onFocus="this.placeholder=''" onBlur="this.placeholder='To Product Amount'">
															 
															</div>
														</div>		
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bonus Amount<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="text" name="bonus_amount" required class="form-control col-md-7 col-xs-12" placeholder=' Bonus Amount'
																  onFocus="this.placeholder=''" onBlur="this.placeholder='Bonus Amount'">
															 
															</div>
														</div>										 
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<select name="status" class="form-control">
																	<option value="1">Enable</option>
																	<option value="0">Disable</option>
																</select>
															</div>
														</div>
													</div>																								 
												 
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								 
								<input type="reset" class="btn btn-primary" value="Reset">
								<input type="submit" name="registration" class="btn btn-success" value="Submit">
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
