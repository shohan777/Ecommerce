<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/stockin_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}

function productWiseStock(type,keywordVal)
{
	 // var keywordVal=document.getElementById('keyword').value;
	  //alert(keywordVal);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/stockin_reports_ajax')?>',
			   data: {'key':keywordVal,'keytype':type},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  //alert("There was an error. Try again please!");
				}
		 });
}
function supplierWiseStock()
{
	  var keywordVal=document.getElementById('supplierval').value;
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/stockin_reports_ajax')?>',
			   data: {supplier:keywordVal},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  //alert("There was an error. Try again please!");
				}
		 });
}
function currentStock()
{
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('administration/stockin_reports_ajax')?>',
			   data: {currentstock:'currentstock'},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
window.onload=currentStock;
</script>
<style>
.black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: #FFFFFF;
        z-index:10001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 20%;
        left: 25%;
        width: 60%;
        height: 60%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: white;
		box-shadow:0px 0px 15px #999999;
        z-index:10002;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }
	/*.returnContent {
        display: none;
        position: fixed;
        top: 20%;
        left: 20%;
        width: 66%;
        height: 33%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: white;
		box-shadow:0px 0px 15px #999999;
        z-index:10002;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }*/
</style>
<script type="text/javascript">

function loadContent(pid)
{
	document.getElementById('prodcut_id').value=pid;
	$("#light1").show('slow');
	$("#fade").show('slow');
}

function closeButton()
{
	$("#light1").hide('medium');
	$("#fade").hide('medium');
}
function loadContentMinus(pid,proname)
{
	document.getElementById('prodcutId').value=pid;
	document.getElementById('proname').innerHTML=proname;
	$("#light2").show('slow');
	$("#fade").show('slow');
}

function closeButtonMinus()
{
	$("#light2").hide('medium');
	$("#fade").hide('medium');
}

function returnArea(pid,proname)
{
	//alert(pid);
	document.getElementById('returnProduct').value=pid;
	document.getElementById('retproname').innerHTML=proname;
	$("#returnArea").show('slow');
	$("#fade").show('slow');
}

function closereturnArea()
{
	$("#returnArea").hide('medium');
	$("#fade").hide('medium');
}
function loadContentHistory(pid)
{
	$.ajax({
            type: "POST",
            url: "<?php echo base_url();?>administration/inventory_history",
            data: ({'pro_id' : pid}),
            success: function(response){
               if(response=='success')
                {   
                    document.getElementById("light3").innerHTML=response;
					$("#light3").show('slow');
					$("#fade").show('slow');
                }
                else
                {
                    document.getElementById("light3").innerHTML=response;
					$("#light3").show('slow');
					$("#fade").show('slow');
                   
                }
            }          
        });
}

function closeButtonHistory()
{
	$("#light3").hide('medium');
	$("#fade").hide('medium');
}




function prodSaleType()
{
	var thispro = document.getElementById('sell_type').value;
	if(thispro=="Whole Sale"){
		document.getElementById('selltypedata').style.display='inline';
	}
	else if(thispro=="Retailer"){
		document.getElementById('selltypedata').style.display='none';
	}
}
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Current Stock Reports</h3>
                      </div>
                        <div class="title_right">
                        	<div style="text-align:right; float:right; width:50%;">
                            <a href="<?php echo base_url('administration/cleareCachDate');?>" class="btn btn-danger">Clear Cach</a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div style="float:left; width:100%">
                                    	<table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
                                        	<tr>
                                            	<td width="11%">
                                              <input name="from_date" class="form-control date-picker" required type="text" id="from_date" placeholder="From Date :"/></td>
                                              <td width="11%">
                                              <input name="to_date" class="form-control date-picker" required type="text" id="to_date" placeholder="To Date:" ></td>
                                                  <td width="3%">
                                              <input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                                               <td width="23%">
                                              	<select name="category" class="form-control" onchange="productWiseStock('category',this.value);">
                                        	<option value="">Category</option>
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
                                              </td>
                                              <td width="43%">
                                              <input class="form-control"  placeholder="Search Product Name or Product Code" type="text" id="keyword" 
                                              onchange="productWiseStock('product',this.value);" onkeydown="productWiseStock('product',this.value);"/></td>    
                                              
                                              <td width="9%" align="right">
                                              <input type="button" name="button" value="All Products" class="btn btn-info" onclick="currentStock();" style="margin-top:3px;" /></td>
                                              
                                          </tr>
                                            
                                       </table>
                                    </div>
                                  	
                                </div>
                                <div class="x_content">
                                		<div id="reportsdisplay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
 
 
<div id="light1" class="white_content">
<?php echo form_open('administration/stock_update');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
     <div class="form-group">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="font-size:18px; margin-bottom:10px;">Add Quantity</div>
        <div class="col-sm-1"><a href ="javascript:void(0)" title="Close" onclick ="closeButton()">
            <i class="fa fa-close"></i></a></div>
      </div>
     <div class="col-sm-8 col-sm-offset-3" style="margin-top:10%;">
      
      
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Product Qty</label></div>
        <div class="col-sm-7"><input type="text" name="pluse_qty" required placeholder="QTY" class="form-control" style="width:60%;margin-bottom:5px;" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/></div>
      </div>
     
      <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <div class="col-sm-7">
        	<input type="hidden" name="product_id" id="prodcut_id" />
                                        <input type="submit" value="Add" name="add" class="btn btn-primary"/>
        </div>
      </div>
      </div>
</div>
<?php echo form_close();?>
</div>
<div id="light2" class="white_content">
<?php echo form_open('administration/stock_update');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
     
      <div class="form-group">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="font-size:18px; margin-bottom:10px;">Stock Out : <span id="proname"></span></div>
        <div class="col-sm-1"><a href ="javascript:void(0)" title="Close" onclick ="closeButtonMinus()">
            <i class="fa fa-close"></i></a></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Buyer Name</label></div>
        <div class="col-sm-7"><input type="text" name="buyername" required placeholder="Full name" class="form-control" style="width:70%; margin-bottom:5px;" onFocus="this.placeholder=''" 
        onBlur="this.placeholder='Buyer Name'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Buyer Contact</label></div>
        <div class="col-sm-7"><input type="text" name="buyercontact" required placeholder="Contact Number" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
        onBlur="this.placeholder='Buyer Name'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Email Address</label></div>
        <div class="col-sm-7"><input type="text" name="buyeremail" required placeholder="Email Address" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
        onBlur="this.placeholder='Buyer Name'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Product Qty</label></div>
        <div class="col-sm-7"><input type="number" name="minus_qty" maxlength="11" required placeholder="QTY" class="form-control" style="width:20%;margin-bottom:5px;" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Details</label></div>
        <div class="col-sm-7"><textarea rows="2" cols="80" name="remarks" style="width:100%;margin-bottom:5px;" class="form-control"></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <div class="col-sm-7">
        	<input type="hidden" name="product_id" id="prodcutId" />
                                        <input type="submit" value="Minus" name="minus"  class="btn btn-primary"/>
        </div>
      </div>
</div>
<?php echo form_close();?>

</div>
<div id="returnArea" class="white_content">
<?php echo form_open('administration/stock_update');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
     
      <div class="form-group">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="font-size:18px; margin-bottom:10px;">Return : <span id="retproname"></span></div>
        <div class="col-sm-1"><a href ="javascript:void(0)" title="Close" onclick ="closereturnArea()">
            <i class="fa fa-close"></i></a></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Invoice Number</label></div>
        <div class="col-sm-7"><input type="text" name="invoiceno" required placeholder="Invoice Number" class="form-control" style="width:70%; margin-bottom:5px;" onFocus="this.placeholder=''"  onBlur="this.placeholder='Invoice Number'"/></div>
      </div>
       <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Return Sale Type</label></div>
        <div class="col-sm-7">
        	<select name="sell_type" id="sell_type" class="form-control" style="width:70%;margin-bottom:5px;" onchange="prodSaleType();">
            	<option value="Retailer">Retailer</option>
                <option value="Whole Sale">Whole Sale</option>
            </select>
        </div>
      </div>
      <div id="selltypedata" style="display:none">
          <div class="form-group">
            <div class="col-sm-3"><label class="control-label">Buyer Name</label></div>
            <div class="col-sm-7"><input type="text" name="buyername" placeholder="Full name" class="form-control" style="width:70%; margin-bottom:5px;" onFocus="this.placeholder=''" 
            onBlur="this.placeholder='Buyer Name'"/></div>
          </div>
          <div class="form-group">
            <div class="col-sm-3"><label class="control-label">Buyer Contact</label></div>
            <div class="col-sm-7"><input type="text" name="buyercontact" placeholder="Contact Number" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
            onBlur="this.placeholder='Buyer Name'"/></div>
          </div>
          <div class="form-group">
            <div class="col-sm-3"><label class="control-label">Email Address</label></div>
            <div class="col-sm-7"><input type="text" name="buyeremail" placeholder="Email Address" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
            onBlur="this.placeholder='Buyer Name'"/></div>
          </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Product Qty</label></div>
        <div class="col-sm-7"><input type="number" name="return_qty" maxlength="11" required placeholder="QTY" class="form-control" style="width:20%;margin-bottom:5px;" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Details</label></div>
        <div class="col-sm-7"><textarea rows="2" cols="80" name="remarks" style="width:100%;margin-bottom:5px;" class="form-control"></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <div class="col-sm-7">
        	 <input type="hidden" name="product_id" id="returnProduct" />
             <input type="submit" value="Return" name="return"  class="btn btn-primary"/>
        </div>
      </div>
</div>
<?php echo form_close();?>

</div>
<div id="light3" class="historyContent"></div>
<div id="fade" class="black_overlay"></div>
              
                <script type="text/javascript">
                        $(document).ready(function () {
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>