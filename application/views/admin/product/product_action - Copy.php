<?php
if($productUpdate->num_rows()>0){
	foreach($productUpdate->result() as $productData);
	$product_id=$productData->product_id;
	$product_name=$productData->product_name;
	$cat_id=$productData->cat_id;
	$scat_id=$productData->scat_id;
	$lcat_id=$productData->lcat_id;
	$pro_code=$productData->pro_code;
	$pro_price=$productData->price;
	$market_price=$productData->market_price;
	$qty=$productData->qty;
	$details=$productData->details;
	$gift_wrap=$productData->gift_wrap;
	$home_delivery=$productData->home_delivery;
	$hot_deals=$productData->hot_deals;
	$main_image=$productData->main_image;
	$photo1=$productData->photo1;
	$photo2=$productData->photo2;
	$photo3=$productData->photo3;
	$color=$productData->color;
	$size=$productData->size;
	$seo_title=$productData->seo_title;
	$seo_details=$productData->seo_details;
	$keyword=$productData->keyword;
	$supplier=$productData->supplier;
	
	$queryPrice = $this->db->query("SELECT * FROM product_price WHERE product_id='".$product_id."'");
	if($queryPrice->num_rows() > 0){
		$rowp = $queryPrice->row_array();
		$proprice_id = $rowp['id'];
		$china_unit_cost = $rowp['china_unit_cost'];
		$photography_unit_cost = $rowp['photography_unit_cost'];
		$import_unit_cost = $rowp['import_unit_cost'];
		$packing_unit_cost = $rowp['packing_unit_cost'];
		$sda_unit_cost = $rowp['sda_unit_cost'];
		$delivery_unit_cost = $rowp['delivery_unit_cost'];
		$cashhandle_unit_cost = $rowp['cashhandle_unit_cost'];
		$officeexp_unit_cost = $rowp['officeexp_unit_cost'];
		$profit_unit_cost = $rowp['profit_unit_cost'];
		$customer_unit_cost = $rowp['customer_unit_cost'];
	}
	else{
		$proprice_id ='';
		$china_unit_cost = '';
		$photography_unit_cost='';
		$import_unit_cost ='';
		$packing_unit_cost = '';
		$sda_unit_cost = '';
		$delivery_unit_cost = '';
		$cashhandle_unit_cost = '';
		$officeexp_unit_cost = '';
		$profit_unit_cost = '';
		$customer_unit_cost ='';
	}
}
else{
	$product_id='';
	$product_name='';
	$details='';
	$cat_id='';
	$scat_id='';
	$lcat_id='';
	$pro_code='';
	$pro_price='';
	$market_price='';
	$qty='';
	$gift_wrap=1;
	$home_delivery=1;
	$hot_deals=1;
	$details='';
	$main_image='';
	$photo1='';
	$photo2='';
	$photo3='';
	$color='';
	$size='';
	$seo_title='';
	$seo_details='';
	$keyword='';
	$supplier='';
	
	$proprice_id ='';
	$china_unit_cost = '';
	$photography_unit_cost='';
	$import_unit_cost ='';
	$packing_unit_cost = '';
	$sda_unit_cost = '';
	$delivery_unit_cost = '';
	$cashhandle_unit_cost = '';
	$officeexp_unit_cost = '';
	$profit_unit_cost = '';
	$customer_unit_cost ='';
}
?>

<link rel="stylesheet" href="<?php echo  base_url('asset/colorpicker/css/colorpicker.css');?>" type="text/css" />
<!--<script type="text/javascript" src="<?php echo  base_url('asset/colorpicker/js/jquery.js');?>"></script>-->
<script type="text/javascript" src="<?php echo  base_url('asset/colorpicker/js/colorpicker.js');?>"></script>
<script type="text/javascript" src="<?php echo  base_url('asset/colorpicker/js/eye.js');?>"></script>
<script type="text/javascript" src="<?php echo  base_url('asset/colorpicker/js/utils.js');?>"></script>
<script type="text/javascript" src="<?php echo  base_url('asset/colorpicker/js/layout.js?ver=1.0.2');?>"></script>
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

<script src="<?php echo base_url('asset/js/angularjs.min.js');?>"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("#uploadTrigger").click(function(){
	   $("#uploadFile").click();
	});
});

var app = angular.module("appTable",[]);
app.controller("ItemsController",function($scope) {

	//////////// Color Popup /////////////////
	$scope.items = [{newItemName:''}];
   	 	$scope.addItem = function (index) {
            $scope.items.push({newItemName:''});
        }
		var newDataList = [];
		 $scope.deleteItem = function (index) {
			 if(!index){
				alert("\tDelete Error. \n Root Row not deletable.");
				$scope.items.push({newItemName:''});
			}
            $scope.items.splice(index, 1);
        }
		
		
		////////////Size Quantity Popup /////////////////
	$scope.itemss = [{newItemSize:''}];
   	 	$scope.addSizeItem = function (index) {
            $scope.itemss.push({newItemSize:''});
        }
		var newDataList = [];
		 $scope.deleteSizeItem = function (index) {
			 if(!index){
				alert("\tDelete Error. \n Root Row not deletable.");
				$scope.itemss.push({newItemSize:''});
			}
            $scope.itemss.splice(index, 1);
        }
	
});
	
	
</script>
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
<div class="right_col" role="main"  ng-app="appTable" ng-controller="ItemsController">
  <div>
     
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Product Registraion Form</h2>
                                    
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
                                                        <li class="active"><a  href="#general" id="invitation" data-toggle="tab"><strong>Product Information</strong></a></li>
                                                        <li><a href="#image" data-toggle="tab"><strong>Images</strong></a></li>
                                                        <li><a href="#price" data-toggle="tab"><strong>Price Information</strong></a></li>
                                                        <li><a href="#colorsize" data-toggle="tab"><strong>Color and Size</strong></a></li>
                                                        <li><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li>
                                                        <li><a href="#preorder" data-toggle="tab"><strong>Pre Order</strong></a></li>
                                                    </ul>
        
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="supplier" id="supplier" class="form-control col-md-7 col-xs-12">
                                    <option value="<?php echo $supplier;?>"><?php echo $supplier;?></option>
                                    <?php
                                    foreach($supplierlist->result() as $row){
                                    $sub_id=$row->user_id;
                                    $sup_name=$row->username;
                                    ?>
                                        <option value="<?php echo $sub_id; ?>"><?php echo $sup_name; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                 
                                </div>
                            </div>
                            <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Category<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="cat_id" id="cat_id" class="form-control col-md-7 col-xs-12"  
                                    onChange="getCategory('<?php echo base_url();?>administration/ajaxCategory?cat_id='+this.value);"
                                     required>
                                    <option value="<?php echo $cat_id;?>"><?php echo $cat_id;?></option>
                                    <?php
                                    foreach($allcategory->result() as $row){
                                    $caegory_title=$row->caegory_title;
                                    $cat_name=$row->cat_name;
                                    ?>
                                        <option value="<?php echo $caegory_title; ?>"><?php echo $cat_name; ?></option>
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
                                                    <option value="<?php echo $scat_id;?>"><?php echo $scat_id;?></option>
                                         </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="lastcat">
                                         <select name="lastcat_id" id="lastcat_id" class="form-control col-md-7 col-xs-12"> 
                                               <option value="<?php echo $lcat_id;?>"><?php echo $lcat_id;?></option>
                                         </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="pro_name" required class="form-control col-md-7 col-xs-12" 
                                    placeholder='Product Name' value="<?php echo $product_name; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Product Name'">
                                 <?php echo form_error('pro_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Code<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="pro_code" required class="form-control col-md-7 col-xs-12" 
                                    placeholder='Product Code' value="<?php echo $pro_code; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Product Code'">
                                 <?php echo form_error('pro_code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
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
                             <!--<div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="quantity"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $qty; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                    <?php echo form_error('quantity', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>-->
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
                                    <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>"  style="height:auto; width:100%;" />
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 2</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="file" name="photo1">
                                </div>
                                 <?php
                                if($main_image!=""){
                                    ?>
                                <div class="col-md-1 col-sm-1">
                                    <img src="<?php echo base_url()?>uploads/images/product/photo1/<?php echo $photo1;?>"  style="height:auto; width:100%;" />
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
                                if($main_image!=""){
                                    ?>
                                <div class="col-md-1 col-sm-1">
                                    <img src="<?php echo base_url()?>uploads/images/product/photo2/<?php echo $photo2;?>"  style="height:auto; width:100%;" />
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 2</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="file" name="photo3">
                                </div>
                                 <?php
                                if($main_image!=""){
                                    ?>
                                <div class="col-md-1 col-sm-1">
                                    <img src="<?php echo base_url()?>uploads/images/product/photo3/<?php echo $photo3;?>"  style="height:auto; width:100%;" />
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                                        
                        </div>
                        <div class="tab-pane" id="price">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">China unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="china_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $china_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Import unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="import_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $import_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Pcking unit cost </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="packing_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $packing_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Photography unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="photography_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $photography_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Stock & Demage Adjustment unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="sda_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $sda_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Delivery unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="delivery_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $delivery_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Cash Handling unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="cashhandle_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $cashhandle_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Office Expense unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="officeexp_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $officeexp_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Profit unit cost</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="profit_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $profit_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Customer unit cost<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="customer_unit_cost"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $customer_unit_cost; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                </div>
                            </div>           
                        </div>
                        <div class="tab-pane" id="colorsize">
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Color</label>
                        <div class="col-md-11 col-sm-11 col-xs-12">
                      	  <div ng-repeat="item in items" ng-model="newItemName" style="width:90%; float:left;">
                            <div style="width:90%; float:left;">
                                 <div style="width:100%;">
                                     <input type="text" name="color[]"  class="form-control colorSelector" style="width:15%; float:left; margin-right:5px;" 
                                     placeholder="Color" value="<?php echo $import_unit_cost; ?>">
                                     <input type="text" name="size[]"  class="form-control" style="width:36%; float:left; margin-right:5px;" 
                                     placeholder="Size with Comma separator" value="<?php echo $import_unit_cost; ?>" >
                                     <input type="text" name="qty[]"  class="form-control" style="width:36%; float:left; margin-right:5px;" 
                                     placeholder="Quantity with Comma separator"  value="<?php echo $import_unit_cost; ?>" >
                                 </div>      
                                 <div style="width:100%; margin-bottom:10px; float:left">
                                 	<div class="col-md-3 col-sm-4 col-xs-12">
                                        <input class="form-control button" id="uploadFile" type="file" name="color_img[]">
                                        <?php echo form_error('main_images', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
										<?php
                                        if($main_image!=""){
                                            ?>
                                            <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>"  style="height:auto; width:80px;" />
                                        <?php
                                        }
                                        ?>
                                       </div>
                                       
                                </div>
                                    
                                 </div>
                               <div style="width:10%; float:right;">
                                <a ng-click="deleteItem($index)" class="btn btn-danger btn-xs" title="Remove This Row"><i class="glyphicon glyphicon-minus"></i></a></div>   
                        </div>
                            <div style="width:10%; float:left">
                                <a href="javascript:void();" ng-click="addItem()" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></a>
                            </div>
                        </div>
                        
                   		 </div>
                </div>
                        <div class="tab-pane" id="seo">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Details</label>
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
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Insert into Pre Order this Product ?</label>
                                <div class="col-md-8 col-sm-8 col-xs-12" style="margin-top:10px;">
                                    <input type="radio" name="preorder" value="1"/> Yes
                                    <input type="radio" name="preorder" value="0" checked="checked"/> No
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">URL</label>
                                <div class="col-md-8 col-sm-8 col-xs-12" style="margin-top:10px;">
                                    <input type="text" name="preurl" class="form-control"/>
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
                                        <input type="hidden" name="proprice_id" value="<?php echo $proprice_id;?>" />
                                        <input type="hidden" name="mainImg" value="<?php echo $main_image;?>" />
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
               
<script>
/*$('#colorSelector').ColorPicker({
	color: '#0000ff',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#colorSelector').css('backgroundColor', '#' + hex);
	}
});*/


$(document).ready(function(){
	//alert('dfd');
	$('.colorSelector').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
			$(el).css('backgroundColor', '#'+hex);
			$(el).css('color', '#FFFFFF');
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
			
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
});
   </script>