<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>administration/pre_deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}
</script>
<script type="text/javascript">
checked = false;
function checkedAll() {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
	  document.getElementById('form_check').elements[i].checked = checked;
	}
}
function approve(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="<?php echo base_url();?>administration/pre_approved?approve_val="+data;
			window.location.href=hrefdata;
	}
	
}

function deapprove(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="<?php echo base_url();?>administration/pre_deapproved?deapprove_val="+data;
			window.location.href=hrefdata;
	}
	
}

function deletedata(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
		var b = window.confirm('Are you sure, you want to delete this ?');
		if(b==true){
			var hrefdata ="<?php echo base_url();?>member/delete?brid="+data;
			window.location.href=hrefdata;
			}
			else{
			 return;
			 }
	}
	
}
</script>
<div class="right_col" role="main">
                <div class="">

                  <div class="page-title">
                    <div class="title_left">
                            <h3>Purchase Invoice</h3>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                        
                            <div class="x_panel">
                                <div class="x_title">
                                  <div class="clearfix"></div>
                                    
                                   
                              </div>
                                <div class="x_content">
                                  <div class="container">
                                  <form name="form" id="form" action="" method="post" onsubmit="return checkInvoice()">
			<table width="100%" height="607" border="0" cellpadding="0" cellspacing="0" class="d_bg">
			  <tr>
                <td width="100%" height="20" align="center" valign="middle" class="mainTit" style="border-bottom:1px solid #EEEEEE;">&nbsp;</td>
                </tr>
			  <tr>
			    <td align="center" valign="middle">
				<div id="page">
				<table width="98%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td width="17%" height="21">&nbsp;</td>
                    <td width="1%">&nbsp;</td>
                    <td colspan="2"><input name="businessHub" type="hidden" id="businessHub" value="<?php echo $this->session->userdata('bh_admin_hub');?>" /></td>
                    <td width="13%">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="24" class="date">Invoice No </td>
                    <td class="date">:</td>
                    <td width="24%" class="date"><input name="invoice" type="text" id="invoice" class="form-control" value="<?php echo $inv_no;?>" readonly=""></td>
                    <td width="5%" class="date">&nbsp;</td>
                    <td class="date"> Date </td>
                    <td width="2%" class="date">:</td>
                    <td width="38%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="87%"><span class="date">
						<?php 
							$date=date('m/d/Y H:i:s', strtotime('+9 hour'));
							$convert_date=explode(" ",$date);
							
							//Example : 02/03/2015
					    ?>
                          <input name="date" type="text" id="date" class="datepicker input_ form-control" value="<?php echo $convert_date[0];?>" readonly="" />
                        </span></td>
                        <td width="13%">&nbsp;</td>
                      </tr>
                      
                    </table></td>
                    </tr>
                   <tr>
                    <td height="21" class="date">Manual Invoice </td>
                    <td class="date">:</td>
                    <td><span class="date">
                      <input name="minvoice" type="text" id="minvoice" onKeyPress="return checkInt(event, '')" onblur="checkManual()" class="form-control" tabindex="1">
                    </span></td>
                    <td>&nbsp;</td>
                    <td height="21" class="date">Business Name</td>
                    <td class="date">:</td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="40%"><span class="date">
                      <input name="customer" type="text" id="customer" class="input_ vertical form-control" value="" autocomplete="off"/>
                    </span></td>
                        <td width="11%" align="right" class="date">Code :</td>
                        <td width="30%"><input name="custCode" type="text" class="input_ form-control" id="custCode" autocomplete="off" value="" onblur="customerCode25()" style="width:110px;" /></td>
                        <td width="19%"><a href="<?php echo base_url()?>billing/customer_add" class="newFrm">
                      <input type="button" name="Button" value="Add" class="add btn btn-primary"></a></td>
                      </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td height="21"><span class="date">Delivery Date</span>
                      </td>
                    <td height="21" class="date">:</td>
                    <td height="21"><span class="date">
                      <input name="deli_date" type="text" id="deli_date" class="datepicker input_ vertical form-control" tabindex="1" readonly="readonly" />
                    </span></td>
                    <td align="center" class="date1">&nbsp;</td>
                    <td align="left" valign="middle" class="date">Customer</td>
                    <td valign="top" class="date">:</td>
                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="87%" valign="middle"><span class="date">
                      <input name="custo1" type="text" id="custo1" class="input_ form-control" readonly=""/>
                    </span></td>
                        <td width="13%">&nbsp;</td>
                      </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td height="21" class="date" align="left">Selling Method
                    
                      </td>
                    <td height="21" align="center" class="date">:</td>
                    <td height="21" align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr>
                        <td width="19%">Cash</td>
                        <td width="17%" align="left"><input type="radio" name="radio_show_sales" id="cash" value="cash" onclick="payType()" />
                          <label for="radio"></label></td>
                        <td width="50%" align="right">Credit</td>
                        <td width="14%" align="right"><input type="radio" name="radio_show_sales" id="credit" value="credit" onclick="payType()" />
						</td>
                      </tr>
                    </table></td>
                    <td align="center" class="date1">&nbsp;</td>
                    <td align="left" valign="middle" class="date">Due Amount </td>
                    <td valign="top" class="date">:</td>
                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="87%" valign="middle"><span class="date">
                      <input name="due" type="text" id="due" class="input_ form-control" readonly=""/>
                    </span></td>
                        <td width="13%">&nbsp;</td>
                      </tr>
                    </table></td>
                    </tr>
				  <tr>
                    <td height="21" colspan="3">
                    
                        <div id="msg" style="display:none; color:#FF0000;">There is not enough quantity.</div>                      <div id="error" style="display:none; color:#FF0000;">Character not allow</div>
                        <div id="err" style="color:#FF0000;"></div>
                      </td>
                    <td align="center" class="date1">&nbsp;</td>
                    <td align="left" valign="middle" class="date">Price
                      <label for="credit_limit"></label>
                      <input type="hidden" name="credit_limit" id="credit_limit" /></td>
                    <td valign="top" class="date">:</td>
                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="87%" valign="middle">
						<select name="priceSelect" id="priceSelect" class="input_ form-control col-md-7 col-xs-12" style="height:25px; width:92%;">
                          	<option value="1">Wholesale Price </option>
                            <option value="2">Retail Price</option>
                          </select>
						</td>
                        <td width="13%">&nbsp;</td>
                      </tr>
                    </table></td>
                    </tr>
					<tr>
                    <td height="10" colspan="7"></td>
                    </tr>
                  <tr>
                    <td height="21" colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                      <tr>
                        <td width="17%" height="29" align="center" bgcolor="#EBEBEB" class="date">Product Code </td>
                        <td width="17%" align="center" bgcolor="#EBEBEB" class="date">Product Name </td>
                        <td width="9%" align="center" bgcolor="#EBEBEB" class="date">Brand Name </td>
                        <td width="16%" align="center" bgcolor="#EBEBEB" class="date">Qty</td>
                        <td width="13%" align="center" bgcolor="#EBEBEB" class="date">Discount</td>
                        <td width="12%" align="center" bgcolor="#EBEBEB" class="date">Price</td>
                        <td width="16%" align="center" bgcolor="#EBEBEB" class="date">Net Amount </td>
                      </tr>
                      <tr>
                        <td height="5" colspan="7"></td>
                        </tr>
					  <tr>
                        <td height="30" align="left"><span class="date">
                          <input name="pro_code" type="text" id="pro_code" class="vertical input_ form-control" autocomplete="off">
                        </span></td>
                        <td height="30" align="left"><span class="date">
                          <input name="pro_name" type="text" id="pro_name" class="vertical input_ form-control" /><input id="prof_count" type="hidden" value="1" name="prof_count">
                        </span></td>
                        <td align="left"><span class="date">
                          <input name="pack_size" type="text" id="pack_size" class="input_ form-control" size="10" readonly="">
                        </span></td>
                        <td align="center">
                          <input name="qty" type="text" id="qty" class="vertical input_ form-control" size="10" onKeyPress="return checkInt(event, '')" onkeyup="checkQtyP()">
                          <input name="category" type="hidden" id="category" /></td>
                        <td align="left">
						<input name="discount" type="text" id="discount" class="vertical input_ form-control" size="8" onKeyPress="return checkInt(event, '')" onkeyup="discountPersent()"/></td>
                        <td align="right"><span class="date">
                          <input name="prize" type="text" id="prize" class="input_ form-control" size="17" onKeyPress="return checkInt(event, '')" onkeyup="priceRate()">
                          <!--<input name="hiddenDis" type="hidden" id="hiddenDis"/>-->
                        </span></td>
                        <td align="right">
                          <input name="net" type="text" id="net" class="input_ form-control" readonly="" /></td>
					    </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td height="5" colspan="7"></td>
                    </tr>
                  <tr>
                    <td height="21" colspan="7" align="right">
					<div style="height:220px; overflow:scroll; overflow-x:hidden; margin-bottom:5px;">	
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr id="prof_1" style="padding-top:5px;"></tr>
                    </table>
					</div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px solid #EEEEEE;">
                      <tr>
                        <td width="71%" height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="13%" class="date">Payment :</td>
                            <td width="13%"><select name="payment" id="payment" class="input_ form-control col-md-7 col-xs-12" style="height:25px;">
                              <option value="Cash">Cash</option>
                              <option value="Cheque">Cheque</option>
                              <option value="Due">Due</option>
                              <!-- <option value="Advance">Advance</option>-->
                            </select></td>
                            <td width="13%" class="date">Discount :</td>
                            <td width="10%" class="date">
							
							<input name="maindis" type="text" class="input_ form-control" id="maindis" onKeyPress="return checkInt(event, '')" onkeyup="receivedMoneyDis();" size="6" />
							</td>
                            <td width="13%" class="date">Received :</td>
                            <td width="22%"><input name="receiced" type="text" id="receiced" class="input_ form-control" onKeyPress="return checkInt(event, '')" onkeyup="receivedMoneyCom();" /></td>
                            <td width="7%" class="date">&nbsp;Due :</td>
                            <td width="9%"><input name="due_main" type="text" id="due_main" readonly="" class="input_ form-control" size="8" /></td>
                          </tr>
                        </table></td>
                        <td width="13%" align="right" class="date">Total Price : 
                          <input type="hidden" name="main_net" id="main_net" />                          &nbsp;</td>
                        <td width="16%"><input name="net_total" type="text" id="net_total" class="input_ form-control" readonly="" /></td>
                      </tr>
                    </table>
					</td>
                    </tr>
                </table>
				</div>
				</td>
			  </tr>
			  <tr>
			    <td height="43" align="center" valign="middle"  style="border-top:1px solid #EEEEEE;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			      <tr>
			        <td width="50%" align="right" id="msg1">
                                        
					<input type="button" name="Submit" value="Submit" class="btn btn-primary" style="background-color:#093" onclick="checkInvoice()" id="save2" />
			        <input type="button" name="Submit" value="Disable" style="display:none;background-color:#093" class="btn btn-primary" id="save3" />
					  
					  </td>
			        <td width="50%" align="center"><div id="rec_mess" style="font-family:Arial, Helvetica, sans-serif; color:#F00; font-size:14px;"></div></td>
			        </tr>
			      </table></td>
			  </tr>
              </table>
			</form>
                                </div>
                              </div>
                            </div>
                       
                        </div>
                    </div>

                   

                </div>
               