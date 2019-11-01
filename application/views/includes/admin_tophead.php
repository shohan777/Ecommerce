<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?></title>
    <link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/table_responsive.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/radio.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pagination.css" />
	
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicons/favicon.ico">

    <!-- <link href="<?php echo base_url();?>asset/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/editor/index.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/select/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/switchery/switchery.min.css" />-->
    <script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>asset/ckeditor/ckeditor.js"></script>
    <script>
	
	function selectedItem()
	{
		//alert('IN');
		var pro_name=document.getElementById("pro_name").value;
		//alert(pro_name);
	   $.ajax({
		type: "POST",
		url: "<?php echo base_url()?>administration/finditem",
		data: ({pro_name: pro_name}),

		success: function(response)
		{
	   
	   		if(response!=0)
			{
				//alert(response);
					  
				var x=response.split('~');
				//alert(x)
				document.getElementById("pro_code").value=x[0];
				document.getElementById("price").value=x[1];
				document.getElementById("pro_id").value=x[2];
			}
			else
			{
				document.getElementById("pro_code").value='';
				document.getElementById("price").value='';
				document.getElementById("pro_id").value='';
			}
		}          
	});
	}
	
	//====================== Number Only
	
	function checkInt(evt, val) {
		evt = (evt) ? evt : window.event
		var charCode = (evt.which) ? evt.which : evt.keyCode
	   // alert(charCode);
		if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57)) {
			//alert_message2(val+' field accepts numbers and decimal points only');
		   // status = "This field accepts numbers only."
			return false
		}
	  //  status = ""
		return true
	}
	
	function hoverChange(id)
	{
		document.getElementById(id).style.borderColor='';
	}	
	
	/*function loadAjaxData(thisval) {
		var getBaseUrl = "<?php echo base_url('administration/getAllSupplierProduct/');?>?supplierid="+thisval;
		//alert(getBaseUrl);
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("suppierWiseProduct").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("GET", getBaseUrl, true);
		  xhttp.send();
	}
*/


	function checkQtyP()
	{
		var qty=document.getElementById("qty").value;
		var mainPrize=document.getElementById("price").value;
		
		if(qty>0)
		{
			var netAmmount=(mainPrize * qty);
			document.getElementById("net").value=netAmmount;
		}
		else
		{
			document.getElementById("net").value='';
			document.getElementById("qty").value='';
			return true;
		}
	}
		
	
	//=================== Control click to call function and check purchase invoice
	
	$(document).keydown(function(e){
	if(e.keyCode==17)
	{
		//alert('In');
		var minvoice=$('#minvoice').val();
		
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		
		if(minvoice=='' || pro_name=='' || qty=='')
		{
			if(minvoice=='')
			{
				document.getElementById('minvoice').style.borderColor='#FF0000';
				document.getElementById('minvoice').focus();
				return true;
			}
			else
			{
				document.getElementById('minvoice').style.borderColor='';
			}
			
			
			if(pro_name=='')
			{
				document.getElementById('pro_name').style.borderColor='#FF0000';
				document.getElementById('pro_name').focus();
				return true;
			}
			else
			{
				document.getElementById('pro_name').style.borderColor='';
			}
			
			if(qty=='')
			{
				document.getElementById('qty').style.borderColor='#FF0000';
				document.getElementById('qty').focus();
				return true;
			}
			else
			{
				document.getElementById('qty').style.borderColor='';
			}
		}
		else if(minvoice!='' && pro_name!='' && qty!='')
		{
				
			var pro_code5=document.getElementsByName("pro_code1[]");
			var j=0;
			for(var i=0;i<pro_code5.length;i++)
			{
				if(pro_code5[i].value==pro_code)
				{
					j++;
					alert("Duplicate Product Not Add ! Please remove duplicate product then add.");
				}
			}
			if(j>0)
			{
				return true;
			}
			else
			{
				addrowsPurchaseInvoice();
			}
		}
	}
});



function addrowsPurchaseInvoice()
		{
			//alert("new row working");
			$(document).ready(function(){
			//alert("In");
			var pro_code=$('#pro_code').val();
			var pro_name=$('#pro_name').val();
			var pro_id=$('#pro_id').val();
			
			var ex = pro_name.split('~');
			var itemid = ex[0];
			var itemname = ex[1];
			
			var qty=$('#qty').val();
			var price=$('#price').val();
			var net=Number($('#net').val());
			var main_net=$('#main_net').val();
			var net_total=$('#net_total').val();
			var total_price_final=(Number(net)+Number(net_total));
			var total_price_final_net=(Number(net)+Number(main_net));
			 //alert(p_c1);
			document.getElementById("net_total").value=total_price_final;
			document.getElementById("main_net").value=total_price_final_net;
			
			if(pro_name!='' && qty!='' && qty>0){
			
			strCountField = '#prof_count';      
			intFields = $(strCountField).val();
			intFields = Number(intFields);    
			newField = intFields + 1;
				
			strNewField = '<tr class="prof blueBox" id="prof_' + newField + '">\
			<input type="hidden" id="id' + newField + '" name="id' + newField + '" value="-1" />\
			<td><input type="text" id="pro_name' + newField + '" name="pro_name1[]" maxlength="10" value="'+itemname+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="pro_code' + newField + '" name="pro_code1[]" maxlength="10" value="'+pro_code+'" class="form-control" readonly="" /></td>\
			<td><input type="hidden" id="pro_id' + newField + '" name="pro_id1[]" maxlength="10" value="'+itemid+'" readonly="" /></td>\
			<td><input type="text" id="qty' + newField + '" name="qty1[]" maxlength="10" value="'+qty+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="price' + newField + '" name="price1[]" maxlength="10" value="'+price+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="net' + newField + '" name="net1[]" maxlength="10" value="'+net+'" class="form-control" readonly="" /></td>\
			<td style="z-index:100;"><img src="<?php echo base_url();?>asset/images/Minus-64.png" width="30" height="30" border="0" id="prof_' + newField + '"  value="prof_' + newField + '" onClick="del(this)" title="Delete" style="cursor:pointer;"></td>\
			</tr>\
		  <div class="nopass"><!-- clears floats --></div>\
		  '
		  ;

			$("#prof_" + intFields).after(strNewField);    
			$("#prof_" + newField).slideDown("medium");
			$(strCountField).val(newField);				
			$('#pro_code').val('');
			$('#pro_name').val('');
			$('#pro_id').val('');
			$('#qty').val('');
			$('#price').val('');
			$('#net').val('');
			//alert(strNewField);
			$("#pro_name").focus();
			document.getElementById('qty').style.borderColor='';
			}
	});
}

function del(id)
{
//alert(id);
//return true;
	var agree=confirm ('Are you want to delete This?')
	{
		if(agree)
		{
			var y= ($(id).attr("id"));
			//alert(y);
			
			var x=y.split('_');
			
			var pro_code="pro_code"+x[1];
			var pro_name="pro_name"+x[1];
			var pro_id="pro_id"+x[1];
			var qty="qty"+x[1];
			var price="price"+x[1];
			var net="net"+x[1];
			
			var netPrize=document.getElementById(net).value;
			
			var total_price=$('#net_total').val();
			var main_net=$('#main_net').val();
			
			var total_price_final=(Number(total_price)-Number(netPrize));
			var total_price_final_net=(Number(main_net)-Number(netPrize));
			//alert(total_price_final);
			document.getElementById("net_total").value=total_price_final;
			document.getElementById("main_net").value=total_price_final_net;
			
			document.getElementById(pro_code).value='';
			document.getElementById(pro_name).value='';
			document.getElementById(pro_id).value='';
			document.getElementById(qty).value='';
			document.getElementById(price).value='';
			document.getElementById(net).value='';
			
			document.getElementById(y).style.display='none';
			return true
		}
		else
		{
			return false;
		}
	}
}


function checkInvoice()
{
	//alert('In');
	
	    var minvoice=$('#minvoice').val();
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		var pro_code5=document.getElementsByName("pro_code1[]");
	
	//alert(pro_code5);
	if(pro_code5.length=='')
	{
		
		var minvoice=$('#minvoice').val();
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		if(minvoice=='')
		{
			document.getElementById('minvoice').style.borderColor='#FF0000';
			document.getElementById('minvoice').focus();
			return true;
		}
		else
		{
			document.getElementById('minvoice').style.borderColor='';
		}
		
		if(pro_name=='')
		{
			document.getElementById('pro_name').style.borderColor='#FF0000';
			document.getElementById('pro_name').focus();
			return true;
		}
		else
		{
			document.getElementById('pro_name').style.borderColor='';
		}
		if(qty=='')
		{
			document.getElementById('qty').style.borderColor='#FF0000';
			document.getElementById('qty').focus();
			return true;
		}
		else
		{
			document.getElementById('qty').style.borderColor='';
		}
		
		if(net_price<=0){
			document.getElementById('qty').style.borderColor='#FF0000';
			document.getElementById('qty').focus();
			return true;
		}
		var pro_code5=document.getElementsByName("pro_code1[]");
		var j=0;
		for(var i=0;i<pro_code5.length;i++)
		{
			if(pro_code5[i].value==pro_code)
			{
				j++;
				alert("Duplicate Product Not Add ! Please remove duplicate product then add.");
			}
		}
		if(j>0){
			return true;
		}
	}
	else
	{
		submitInvoiceBilling(form);	
	}
}


function submitInvoiceBilling(form)
{
	var frm=document.getElementById('form');
	var action_url='<?php echo base_url()?>administration/purchaseinvoice';
	
   // var div_id=divid;
   
    // Create the iframe...
    var iframe = document.createElement("iframe");
    iframe.setAttribute("id","upload_iframe");
    iframe.setAttribute("name","upload_iframe");
    iframe.setAttribute("width","0");
    iframe.setAttribute("height","0");
    iframe.setAttribute("border","0");
    iframe.setAttribute("style","width: 0; height: 0; border: none;");
   
    // Add to document...
    form.parentNode.appendChild(iframe);
   
    window.frames['upload_iframe'].name="upload_iframe";
   
    iframeId = document.getElementById("upload_iframe");
   
    // Add event...
    var eventHandler = function()  {
   
    if (iframeId.detachEvent)
    iframeId.detachEvent("onload", eventHandler);
    else
    iframeId.removeEventListener("load", eventHandler, false);
   
    // Message from server...
    if (iframeId.contentDocument) {
    content = iframeId.contentDocument.body.innerHTML;
    } else if (iframeId.contentWindow) {
    content = iframeId.contentWindow.document.body.innerHTML;
    } else if (iframeId.document) {
    content = iframeId.document.body.innerHTML;
    }
   
    //document.getElementById(div_id).innerHTML = content;
   
    // Del the iframe...
    setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
    }
   
    if (iframeId.addEventListener)
    iframeId.addEventListener("load", eventHandler, true);
    if (iframeId.attachEvent)
    iframeId.attachEvent("onload", eventHandler);
   
    // Set properties of form...
    form.setAttribute("target","upload_iframe");
    form.setAttribute("action", action_url);
    form.setAttribute("method","post");
    form.setAttribute("enctype","multipart/form-data");
    form.setAttribute("encoding","multipart/form-data");
   
    // Submit the form...
    form.submit(); 
	//lastInvoice();
	document.getElementById('rec_mess').innerHTML="Purchase Invoice Successfully submit.";
	
	window.setTimeout(function() {
    window.location.reload();
}, 2000);
}
</script>



   <script>
	
	function pre_selectedItem()
	{
		//alert('IN');
		var pro_name=document.getElementById("pro_name").value;
		//alert(pro_name);
	   $.ajax({
		type: "POST",
		url: "<?php echo base_url()?>administration/pre_finditem",
		data: ({pro_name: pro_name}),

		success: function(response)
		{
	   
	   		if(response!=0)
			{
				//alert(response);
					  
				var x=response.split('~');
				//alert(x)
				document.getElementById("pro_code").value=x[0];
				document.getElementById("price").value=x[1];
				document.getElementById("pro_id").value=x[2];
			}
			else
			{
				document.getElementById("pro_code").value='';
				document.getElementById("price").value='';
				document.getElementById("pro_id").value='';
			}
		}          
	});
	}
	
	//====================== Number Only
	
	function pre_checkInt(evt, val) {
		evt = (evt) ? evt : window.event
		var charCode = (evt.which) ? evt.which : evt.keyCode
	   // alert(charCode);
		if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57)) {
			//alert_message2(val+' field accepts numbers and decimal points only');
		   // status = "This field accepts numbers only."
			return false
		}
	  //  status = ""
		return true
	}
	
	function pre_hoverChange(id)
	{
		document.getElementById(id).style.borderColor='';
	}	
	
	/*function loadAjaxData(thisval) {
		var getBaseUrl = "<?php echo base_url('administration/getAllSupplierProduct/');?>?supplierid="+thisval;
		//alert(getBaseUrl);
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("suppierWiseProduct").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("GET", getBaseUrl, true);
		  xhttp.send();
	}
*/


	function pre_checkQtyP()
	{
		var qty=document.getElementById("qty").value;
		var mainPrize=document.getElementById("price").value;
		
		if(qty>0)
		{
			var netAmmount=(mainPrize * qty);
			document.getElementById("net").value=netAmmount;
		}
		else
		{
			document.getElementById("net").value='';
			document.getElementById("qty").value='';
			return true;
		}
	}
		
	
	//=================== Control click to call function and check purchase invoice
	
	$(document).keydown(function(e){
	if(e.keyCode==17)
	{
		//alert('In');
		var minvoice=$('#minvoice').val();
		
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		
		if(minvoice=='' || pro_name=='' || qty=='')
		{
			if(minvoice=='')
			{
				document.getElementById('minvoice').style.borderColor='#FF0000';
				document.getElementById('minvoice').focus();
				return true;
			}
			else
			{
				document.getElementById('minvoice').style.borderColor='';
			}
			
			
			if(pro_name=='')
			{
				document.getElementById('pro_name').style.borderColor='#FF0000';
				document.getElementById('pro_name').focus();
				return true;
			}
			else
			{
				document.getElementById('pro_name').style.borderColor='';
			}
			
			if(qty=='')
			{
				document.getElementById('qty').style.borderColor='#FF0000';
				document.getElementById('qty').focus();
				return true;
			}
			else
			{
				document.getElementById('qty').style.borderColor='';
			}
		}
		else if(minvoice!='' && pro_name!='' && qty!='')
		{
				
			var pro_code5=document.getElementsByName("pro_code1[]");
			var j=0;
			for(var i=0;i<pro_code5.length;i++)
			{
				if(pro_code5[i].value==pro_code)
				{
					j++;
					alert("Duplicate Product Not Add ! Please remove duplicate product then add.");
				}
			}
			if(j>0)
			{
				return true;
			}
			else
			{
				addrowsPurchaseInvoice();
			}
		}
	}
});



function pre_addrowsPurchaseInvoice()
		{
			//alert("new row working");
			$(document).ready(function(){
			//alert("In");
			var pro_code=$('#pro_code').val();
			var pro_name=$('#pro_name').val();
			var pro_id=$('#pro_id').val();
			
			var ex = pro_name.split('~');
			var itemid = ex[0];
			var itemname = ex[1];
			
			var qty=$('#qty').val();
			var price=$('#price').val();
			var net=Number($('#net').val());
			var main_net=$('#main_net').val();
			var net_total=$('#net_total').val();
			var total_price_final=(Number(net)+Number(net_total));
			var total_price_final_net=(Number(net)+Number(main_net));
			 //alert(p_c1);
			document.getElementById("net_total").value=total_price_final;
			document.getElementById("main_net").value=total_price_final_net;
			
			if(pro_name!='' && qty!='' && qty>0){
			
			strCountField = '#prof_count';      
			intFields = $(strCountField).val();
			intFields = Number(intFields);    
			newField = intFields + 1;
				
			strNewField = '<tr class="prof blueBox" id="prof_' + newField + '">\
			<input type="hidden" id="id' + newField + '" name="id' + newField + '" value="-1" />\
			<td><input type="text" id="pro_name' + newField + '" name="pro_name1[]" maxlength="10" value="'+itemname+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="pro_code' + newField + '" name="pro_code1[]" maxlength="10" value="'+pro_code+'" class="form-control" readonly="" /></td>\
			<td><input type="hidden" id="pro_id' + newField + '" name="pro_id1[]" maxlength="10" value="'+itemid+'" readonly="" /></td>\
			<td><input type="text" id="qty' + newField + '" name="qty1[]" maxlength="10" value="'+qty+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="price' + newField + '" name="price1[]" maxlength="10" value="'+price+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="net' + newField + '" name="net1[]" maxlength="10" value="'+net+'" class="form-control" readonly="" /></td>\
			<td style="z-index:100;"><img src="<?php echo base_url();?>asset/images/Minus-64.png" width="30" height="30" border="0" id="prof_' + newField + '"  value="prof_' + newField + '" onClick="del(this)" title="Delete" style="cursor:pointer;"></td>\
			</tr>\
		  <div class="nopass"><!-- clears floats --></div>\
		  '
		  ;

			$("#prof_" + intFields).after(strNewField);    
			$("#prof_" + newField).slideDown("medium");
			$(strCountField).val(newField);				
			$('#pro_code').val('');
			$('#pro_name').val('');
			$('#pro_id').val('');
			$('#qty').val('');
			$('#price').val('');
			$('#net').val('');
			//alert(strNewField);
			$("#pro_name").focus();
			document.getElementById('qty').style.borderColor='';
			}
	});
}

function pre_del(id)
{
//alert(id);
//return true;
	var agree=confirm ('Are you want to delete This?')
	{
		if(agree)
		{
			var y= ($(id).attr("id"));
			//alert(y);
			
			var x=y.split('_');
			
			var pro_code="pro_code"+x[1];
			var pro_name="pro_name"+x[1];
			var pro_id="pro_id"+x[1];
			var qty="qty"+x[1];
			var price="price"+x[1];
			var net="net"+x[1];
			
			var netPrize=document.getElementById(net).value;
			
			var total_price=$('#net_total').val();
			var main_net=$('#main_net').val();
			
			var total_price_final=(Number(total_price)-Number(netPrize));
			var total_price_final_net=(Number(main_net)-Number(netPrize));
			//alert(total_price_final);
			document.getElementById("net_total").value=total_price_final;
			document.getElementById("main_net").value=total_price_final_net;
			
			document.getElementById(pro_code).value='';
			document.getElementById(pro_name).value='';
			document.getElementById(pro_id).value='';
			document.getElementById(qty).value='';
			document.getElementById(price).value='';
			document.getElementById(net).value='';
			
			document.getElementById(y).style.display='none';
			return true
		}
		else
		{
			return false;
		}
	}
}


function pre_checkInvoice()
{
	//alert('In');
	
	    var minvoice=$('#minvoice').val();
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		var pro_code5=document.getElementsByName("pro_code1[]");
	
	//alert(pro_code5);
	if(pro_code5.length=='')
	{
		
		var minvoice=$('#minvoice').val();
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		if(minvoice=='')
		{
			document.getElementById('minvoice').style.borderColor='#FF0000';
			document.getElementById('minvoice').focus();
			return true;
		}
		else
		{
			document.getElementById('minvoice').style.borderColor='';
		}
		
		if(pro_name=='')
		{
			document.getElementById('pro_name').style.borderColor='#FF0000';
			document.getElementById('pro_name').focus();
			return true;
		}
		else
		{
			document.getElementById('pro_name').style.borderColor='';
		}
		if(qty=='')
		{
			document.getElementById('qty').style.borderColor='#FF0000';
			document.getElementById('qty').focus();
			return true;
		}
		else
		{
			document.getElementById('qty').style.borderColor='';
		}
		
		if(net_price<=0){
			document.getElementById('qty').style.borderColor='#FF0000';
			document.getElementById('qty').focus();
			return true;
		}
		var pro_code5=document.getElementsByName("pro_code1[]");
		var j=0;
		for(var i=0;i<pro_code5.length;i++)
		{
			if(pro_code5[i].value==pro_code)
			{
				j++;
				alert("Duplicate Product Not Add ! Please remove duplicate product then add.");
			}
		}
		if(j>0){
			return true;
		}
	}
	else
	{
		pre_submitInvoiceBilling(form);	
	}
}


function pre_submitInvoiceBilling(form)
{
	var frm=document.getElementById('form');
	var action_url='<?php echo base_url()?>administration/pre_purchaseinvoice';
	
   // var div_id=divid;
   
    // Create the iframe...
    var iframe = document.createElement("iframe");
    iframe.setAttribute("id","upload_iframe");
    iframe.setAttribute("name","upload_iframe");
    iframe.setAttribute("width","0");
    iframe.setAttribute("height","0");
    iframe.setAttribute("border","0");
    iframe.setAttribute("style","width: 0; height: 0; border: none;");
   
    // Add to document...
    form.parentNode.appendChild(iframe);
   
    window.frames['upload_iframe'].name="upload_iframe";
   
    iframeId = document.getElementById("upload_iframe");
   
    // Add event...
    var eventHandler = function()  {
   
    if (iframeId.detachEvent)
    iframeId.detachEvent("onload", eventHandler);
    else
    iframeId.removeEventListener("load", eventHandler, false);
   
    // Message from server...
    if (iframeId.contentDocument) {
    content = iframeId.contentDocument.body.innerHTML;
    } else if (iframeId.contentWindow) {
    content = iframeId.contentWindow.document.body.innerHTML;
    } else if (iframeId.document) {
    content = iframeId.document.body.innerHTML;
    }
   
    //document.getElementById(div_id).innerHTML = content;
   
    // Del the iframe...
    setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
    }
   
    if (iframeId.addEventListener)
    iframeId.addEventListener("load", eventHandler, true);
    if (iframeId.attachEvent)
    iframeId.attachEvent("onload", eventHandler);
   
    // Set properties of form...
    form.setAttribute("target","upload_iframe");
    form.setAttribute("action", action_url);
    form.setAttribute("method","post");
    form.setAttribute("enctype","multipart/form-data");
    form.setAttribute("encoding","multipart/form-data");
   
    // Submit the form...
    form.submit(); 
	//lastInvoice();
	document.getElementById('rec_mess').innerHTML="Purchase Invoice Successfully submit.";
	
	window.setTimeout(function() {
    window.location.reload();
}, 2000);
}
</script>
</head>
