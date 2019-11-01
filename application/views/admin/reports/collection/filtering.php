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
<div class="right_col" role="main">

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
							<li>Transaction Reports</li>
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
						    <?php echo form_open_multipart('reports/collection_reports', 'class="form-horizontal form-label-left"');?>
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
                                                          <input type="submit" name="search_tran" class="btn btn-success  btn-xs" value="Search">
                                                          <input type="submit" name="alltran" class="btn btn-danger  btn-xs" value="All Collection">
                                                          <input type="submit" name="todaytran" class="btn btn-warning  btn-xs" value="Today">
                                                          
                                                      </div>
                                                       
                                                    </div>
                                                   
                                                    
    									</div>
                            		  </div>
                            	</div>
                            <?php echo form_close();?>
					</div>

