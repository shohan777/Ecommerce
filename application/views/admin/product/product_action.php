<?php
if($productUpdate->num_rows()>0){
	foreach($productUpdate->result() as $productData);
	$product_id=$productData->product_id;
	$product_name=$productData->product_name;
	$cat_id=$productData->cat_id;
	$scat_id=$productData->scat_id;
	$lcat_id=$productData->lcat_id;
	$pro_code=$productData->pro_code;
	$pro_purchase_price=$productData->purchase_price;
	$pro_price=$productData->price;
	$market_price=$productData->market_price;
	$details=$productData->details;
	$gift_wrap=$productData->gift_wrap;
	$home_delivery=$productData->home_delivery;
	$hot_deals=$productData->hot_deals;
	$main_image=$productData->main_image;
	$thumb=$productData->thumb;
	$photo1=$productData->photo1;
	$photo2=$productData->photo2;
	$photo3=$productData->photo3;
	$photo4=$productData->photo4;
	$color=$productData->color;
	$size=$productData->size;
	 
	$seo_title=$productData->seo_title;
	$seo_details=$productData->seo_details;
	$keyword=$productData->keyword;
	$supplier=$productData->supplier;
	$discount=$productData->discount;
	$dis_type=$productData->dis_type;
    
    if(!empty($productData->product_video)) {
        $link = $productData->product_video;
        $code = explode('?v=', $link);
        $product_video_code = substr($code[1], 0, 11);
    } else {
        $link = "https://www.youtube.com/watch?v=NVDcSyiCPC8";
        $code = explode('?v=', $link);
        $product_video_code = substr($code[1], 0, 11);
    }
 	
	$product_quantity= $this->Index_model->getDataById('stock','pro_id',$product_id,'s_id','desc','1')->row_array();
	$quantity=$product_quantity['pro_qty'];
}
else{
	$product_id='';
	$product_name='';
	$details='';
	$cat_id='';
	$scat_id='';
	$lcat_id='';
	$pro_code='';
    $pro_purchase_price='';
	$pro_price='';
	$market_price='';
	$quantity=1;
	$gift_wrap=1;
	$home_delivery=1;
	$hot_deals=1;
	$details='';
	$main_image='';
	$thumb = '';
	$photo1='';
	$photo2='';
	$photo3='';
	$photo4='';
	$color='';
	$size='';
	$seo_title='';
	$seo_details='';
	$keyword='';
	$supplier='';
	$discount = '';
	$dis_type = '';
}
?>
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

<script>
	function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}
	
	function getCategory(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	
	function getCity_size(strURL) {	
		//alert(strURL);	
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv_size').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	
	function getProColor(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv_color').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	
	function getSubCategory(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('lastcat').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}	
</script>
<div class="right_col" role="main" ng-app="appTable" ng-controller="ItemsController">
	<div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">

					<div class="x_title">
						<h2>Product Registraion Form</h2>
						<a class="btn btn-success pull-right" href="<?php echo base_url('administration/bonusRange'); ?>"><i class="fa fa-plus"
							 aria-hidden="true"></i> Bonus Range</a>
						<a class="btn btn-primary pull-right" href="<?php echo base_url('administration/product_list'); ?>">Poduct List</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
						<div id="registration_form">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
											<h4 class="panel-title">
												Product Information </h4>
										</a>
									</div>

									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">

											<div id="exTab2">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#general" id="invitation" data-toggle="tab"><strong>General Information</strong></a></li>
													<li><a href="#image" data-toggle="tab"><strong>Images</strong></a></li>
													<li><a href="#video" data-toggle="tab"><strong>Video</strong></a></li>
													<li><a href="#price" data-toggle="tab"><strong>Price & Quantity</strong></a></li>
													<li><a href="#colorsize" data-toggle="tab"><strong>Color & Size</strong></a></li>
													<li><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li>
													<li><a href="#preorder" data-toggle="tab"><strong>Pre Order</strong></a></li>

												</ul>

												<div class="tab-content">
													<div class="tab-pane active" id="general">
														<?php /*?>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<select name="supplier" id="supplier" class="form-control col-md-7 col-xs-12">
																	<option value="<?php echo $supplier;?>">
																		<?php echo $supplier;?>
																	</option>
																	<?php
																		foreach($supplierlist->result() as $row){
																		$sub_id=$row->user_id;
																		$sup_name=$row->username;
																		?>
																	<option value="<?php echo $sub_id; ?>">
																		<?php echo $sup_name; ?>
																	</option>
																	<?php
																			}
																			?>
																</select>

															</div>
														</div>
														<?php */?>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Category<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<select name="cat_id" id="cat_id" class="form-control col-md-7 col-xs-12" onChange="getCategory('<?php echo base_url();?>administration/ajaxCategory?cat_id='+this.value);
																	getCity_size('<?php echo base_url();?>administration/ajaxCategorySize?cat_id='+this.value);
																	getProColor('<?php echo base_url();?>administration/ajaxCategoryColor?cat_id='+this.value)"
																 required>
																	<option value="<?php echo $cat_id;?>">
																		<?php echo $cat_id;?>
																	</option>
																	<?php
																		foreach($allcategory->result() as $row){
																		$caegory_title=$row->caegory_title;
																		$cat_name=$row->cat_name;
																		?>
																	<option value="<?php echo $caegory_title; ?>">
																		<?php echo $cat_name; ?>
																	</option>
																	<?php
																		}
																		?>
																</select>
																<?php echo form_error('cat_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div id="citydiv">
																	<select name="subcat_id" id="subcat_id" class="form-control col-md-7 col-xs-12">
																		<option value="<?php echo $scat_id;?>">
																			<?php echo $scat_id;?>
																		</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Category</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div id="lastcat">
																	<select name="lastcat_id" id="lastcat_id" class="form-control col-md-7 col-xs-12">
																		<option value="<?php echo $lcat_id;?>">
																			<?php echo $lcat_id;?>
																		</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="text" name="pro_name" required class="form-control col-md-7 col-xs-12" placeholder='Product Name'
																 value="<?php echo $product_name; ?>" onFocus="this.placeholder=''" onBlur="this.placeholder='Product Name'">
																<?php echo form_error('pro_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Code<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="text" name="pro_code" required class="form-control col-md-7 col-xs-12" placeholder='Product Code'
																 value="<?php echo $pro_code; ?>" onFocus="this.placeholder=''" onBlur="this.placeholder='Product Code'">
																<?php echo form_error('pro_code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Bonus
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<select name="product_bonus" class="form-control">
																	<option value="0">Not Bonus</option>
																	<option value="1">Bonus </option>
																</select>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Details<span class="required">*</span>
															</label>
															<div class="col-md-8 col-sm-8 col-xs-12">
																<textarea type="text" name="full_description" required class="form-control col-md-7 col-xs-12 ckeditor"><?php echo $details; ?></textarea>
																<?php echo form_error('full_description', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
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
													<div class="tab-pane" id="image">
														<div class="form-group">
															<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Main Image<span class="required">*</span>
															</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control" type="file" name="main_images">
																<?php echo form_error('main_images', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
															<?php
															if($main_image!=""){
																?>
															<div class="col-md-1 col-sm-1">
																<img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" style="height:auto; width:100%;" />
															</div>
															<?php
																}
																?>
														</div>
														<div class="form-group">
															<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 1</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control" type="file" name="photo1">
															</div>
															<?php
																if($photo1!=""){
																	?>
															<div class="col-md-1 col-sm-1">
																<img src="<?php echo base_url()?>uploads/images/product/photo1/<?php echo $photo1;?>" style="height:auto; width:100%;" />
															</div>
															<div class="col-md-1 col-sm-1">
																<a href="javascript:void()" onclick="proImageDelete('<?php echo $product_id;?>','product','photo1')"
																 style="color:#ff0000">Delete</a>
															</div>
															<?php
																}
																?>
														</div>
														<div class="form-group">
															<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 2</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control" type="file" name="photo2">
															</div>
															<?php
															if($photo2!=""){
																?>
															<div class="col-md-1 col-sm-1">
																<img src="<?php echo base_url()?>uploads/images/product/photo2/<?php echo $photo2;?>" style="height:auto; width:100%;" />
															</div>
															<div class="col-md-1 col-sm-1">
																<a href="javascript:void()" onclick="proImageDelete('<?php echo $product_id;?>','product','photo2')"
																 style="color:#ff0000">Delete</a>
															</div>
															<?php
																}
																?>
														</div>
														<div class="form-group">
															<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 3</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control" type="file" name="photo3">
															</div>
															<?php
																if($photo3!=""){
																	?>
															<div class="col-md-1 col-sm-1">
																<img src="<?php echo base_url()?>uploads/images/product/photo3/<?php echo $photo3;?>" style="height:auto; width:100%;" />
															</div>
															<div class="col-md-1 col-sm-1">
																<a href="javascript:void()" onclick="proImageDelete('<?php echo $product_id;?>','product','photo3')"
																 style="color:#ff0000">Delete</a>
															</div>
															<?php
																}
																?>
														</div>
														<div class="form-group">
															<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 4</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control" type="file" name="photo4">
															</div>
															<?php
															if($photo4!=""){
																?>
															<div class="col-md-1 col-sm-1">
																<img src="<?php echo base_url()?>uploads/images/product/photo4/<?php echo $photo4;?>" style="height:auto; width:100%;" />
															</div>
															<div class="col-md-1 col-sm-1">
																<a href="javascript:void()" onclick="proImageDelete('<?php echo $product_id;?>','product','photo4')"
																 style="color:#ff0000">Delete</a>
															</div>
															<?php
																}
																?>
														</div>

													</div>
													<div class="tab-pane" id="video">
														<div class="form-group">
															<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Product Video
															</label>
															<div class="col-md-4 col-sm-4 col-xs-12">
																<input class="form-control" type="text" name="product_video" placeholder="e.g https://youtu.be/LcMqwxjmrk8">
																<?php echo form_error('product_video', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
															<?php if(isset($product_video_code)) : ?>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<iframe style="width:100%" height="315" src="https://www.youtube.com/embed/<?php echo $product_video_code; ?>"
																 frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
															</div>
															<?php endif; ?>
														</div>
													</div>
													<div class="tab-pane" id="price">
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Initial Quantity<span class="required">*</span></label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="number" name="quantity" class="form-control" style="width:50%" placeholder='Only Number Allow'
																 value="<?php echo $quantity; ?>" onFocus="this.placeholder=''" onBlur="this.placeholder='Only Number Allow'">
																<?php echo form_error('quantity', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Price <p class="bonus">(If bonus, not
																	need purchase price)</p></label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="number" name="purchase_price" class="form-control" style="width:50%" placeholder='Only Number Allow'
																 value="<?php echo $pro_purchase_price; ?>" onFocus="this.placeholder=''" onBlur="this.placeholder='Only Number Allow'">
																<?php echo form_error('price', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Sale Price <p class="bonus">(If bonus, Not need
																	Sale price)</p></label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="number" name="price" class="form-control" style="width:50%" placeholder='Only Number Allow'
																 value="<?php echo $pro_price; ?>" onFocus="this.placeholder=''" onBlur="this.placeholder='Only Number Allow'">
																<?php echo form_error('price', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Discount <p class="bonus">(If bonus, Not need
																	Discount)</p></label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="number" name="discount" id="discount" class="form-control" style="width:30%; float:left"
																 value="<?php echo $discount;?>">
																<select name="dis_type" class="form-control" style="width:20%; float:left">
																	<option value="<?php echo $dis_type;?>">
																		<?php echo $dis_type;?>
																	</option>
																	<option value="%">%</option>
																	<option value="Tk">Tk</option>
																</select>
															</div>
														</div>

													</div>
													<div class="tab-pane" id="colorsize">
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Size</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div id="citydiv_size">
																	<select name="pro_size[]" id="size_id" class="form-control" multiple="multiple" style="min-height:150px">
																		<?php 
																		 
																		 
																		$expval=explode(',',$size);
																		foreach($expval as $val){
																		?>
																		<option value="<?php echo $val;?>" selected="selected">
																			<?php echo $val;?>
																		</option>
																		<?php
																			}
																			?>
																	</select>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Color</label>
															<div class="col-md-6 col-sm-6 col-xs-12">

																<div id="citydiv_color">
																 																															
																	<select name="pro_color[]" id="color_id" class="form-control" multiple="multiple" style="min-height:150px">
																		<?php 
	
																		$expvalc=explode(',',$color);
																		foreach($expvalc as $valc){
																		?>
																		<option value="<?php echo $valc;?>" selected="selected">
																			<?php echo $valc;?>
																		</option>
																		<?php
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="seo">
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title</label>
															<div class="col-md-8 col-sm-8 col-xs-12">
																<input type="text" name="seo_title" class="form-control" value="<?php echo $seo_title;?>" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Description</label>
															<div class="col-md-8 col-sm-8 col-xs-12">
																<textarea type="text" name="seo_details" class="form-control col-md-7 col-xs-12"><?php echo $seo_details;?></textarea>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keywords</label>
															<div class="col-md-8 col-sm-8 col-xs-12">
																<textarea type="text" name="keyword" class="form-control col-md-7 col-xs-12"><?php echo $keyword; ?></textarea>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="preorder">
														<div class="form-group">
															<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Insert into Pre Order this
																Product ?</label>
															<div class="col-md-8 col-sm-8 col-xs-12" style="margin-top:10px;">
																<input type="radio" name="preorder" value="1" /> Yes
																<input type="radio" name="preorder" value="0" checked="checked" /> No
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
								<input type="hidden" name="product_id" value="<?php echo $product_id;?>" />
								<input type="hidden" name="mainImg" value="<?php echo $main_image;?>" />
								<input type="hidden" name="thumbImg" value="<?php echo $thumb;?>" />
								<input type="hidden" name="photo1" value="<?php echo $photo1;?>" />
								<input type="hidden" name="photo2" value="<?php echo $photo2;?>" />
								<input type="hidden" name="photo3" value="<?php echo $photo3;?>" />

								<input type="reset" class="btn btn-primary" value="Reset">
								<input type="submit" name="registration" class="btn btn-success" value="Submit">
							</div>
						</div>
						<?php echo form_close();?>
					</div>
				</div>
			</div>
		</div>
	</div>
