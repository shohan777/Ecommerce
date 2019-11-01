<script type="text/javascript">
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
      function getGroupList(strURL) {		
		var req = getXMLHTTP();
		//alert(req);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('groupid').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	 function getSecList(strURL) {		
		var req = getXMLHTTP();
		//alert(req);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('sectiondivid').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	function getShift(strURL) {		
		
		var req = getXMLHTTP();
		//alert(req);
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('shiftid').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	
	function getPeriod(strURL) {		
	
		
		var clsid = document.getElementById('class_id').value;
		var groupid = document.getElementById('group_id').value;
		var secid = document.getElementById('section_id').value;
		var shid = document.getElementById('shift_id').value;
		var day = document.getElementById('day').value;
		
		var finalurl = strURL+'?class_idPeriod='+clsid+'&&group_id='+groupid+'&&section_id='+secid+'&&shift_id='+shid+'&&day='+day;
		//alert(finalurl);
		var req = getXMLHTTP();
		//alert(finalurl);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('periodDis').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", finalurl, true);
			req.send(null);
		}
					
	}
	
	
	
	function getSubject(strURL) {		
		
		var clsid = document.getElementById('class_id').value;
		if(document.getElementById('group_id').value!=""){
			var groupid = document.getElementById('group_id').value;
			var finalurl = strURL+'?class_idSub='+clsid+'&&group_id='+groupid;
		}
		else{
			var finalurl = strURL+'?class_idSub='+clsid;
		}
		
		
		var req = getXMLHTTP();
		//alert(finalurl);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subjectDis').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", finalurl, true);
			req.send(null);
		}
					
	}
     </script>
<div class="right_col">

				<div class="content">
					<div class="col-md-12 col-sm-12 col-xs-12">
                        <h1 style="font-size:35px; text-align:center; text-shadow:#ccc 1px 1px"><?php echo $this->session->userdata('AdminAccessName');?> Reports</h1>
                        
                        
                        
                        <div class="col-sm-3">
                        	<div class="new_bg"><a href="<?php echo base_url('reports/product');?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Product  Reports</a></div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="new_bg"><a href="<?php echo base_url('reports/orders');?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Order  Reports</a></div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="new_bg"><a href="<?php echo base_url('reports/customer');?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Customer  Reports</a></div>
                        </div> 
                        <div class="col-sm-3">
                        	<div class="new_bg"><a href="<?php echo base_url('reports/transaction');?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Transaction/Balance Sheet</a></div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="new_bg"><a href="<?php echo base_url('reports/expanse');?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Expense Reports</a></div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="new_bg"><a href="<?php echo base_url('reports/collection');?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Collection Reports</a></div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="new_bg"><a href="<?php echo base_url('reports/stock');?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Stock Reports</a></div>
                        </div>
                        
                    </div>
