<style>
.required{
	color:#f00;
}
</style>
<script type="text/javascript">

function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url($urlname);?>/deleteData/'+tablename+'/'+colid,
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
	function totalprice(){
		//alert("In");
		var amount = document.getElementById('investamount').value;
		//alert(amount);
		if(amount!=""){
		document.getElementById('number').value=amount;
		}
		else{
			amount=0;	
		}
		
		var bigNumArry = new Array('', ' thousand', ' million', ' billion', ' trillion', ' quadrillion', ' quintillion');

    var output = '';
    var numString =   document.getElementById('number').value;
    var finlOutPut = new Array();

    if (numString == '0') {
        document.getElementById('container').value = 'Zero';
        return;
    }

    if (numString == 0) {
        document.getElementById('container').value = 'messeg tell to enter numbers';
        return;
    }

    var i = numString.length;
    i = i - 1;

    //cut the number to grups of three digits and add them to the Arry
    while (numString.length > 3) {
        var triDig = new Array(3);
        triDig[2] = numString.charAt(numString.length - 1);
        triDig[1] = numString.charAt(numString.length - 2);
        triDig[0] = numString.charAt(numString.length - 3);

        var varToAdd = triDig[0] + triDig[1] + triDig[2];
        finlOutPut.push(varToAdd);
        i--;
        numString = numString.substring(0, numString.length - 3);
    }
    finlOutPut.push(numString);
    finlOutPut.reverse();
    for (j = 0; j < finlOutPut.length; j++) {
        finlOutPut[j] = triConvert(parseInt(finlOutPut[j]));
    }

    var bigScalCntr = 0; //this int mark the million billion trillion... Arry

    for (b = finlOutPut.length - 1; b >= 0; b--) {
        if (finlOutPut[b] != "dontAddBigSufix") {
            finlOutPut[b] = finlOutPut[b] + bigNumArry[bigScalCntr] + ' ';
            bigScalCntr++;
        }
        else {
            //replace the string at finlOP[b] from "dontAddBigSufix" to empty String.
            finlOutPut[b] = ' ';
            bigScalCntr++; //advance the counter  
        }
    }
        for(n = 0; n<finlOutPut.length; n++){
            output +=finlOutPut[n];
        }
    document.getElementById('container').value = output;//print the output
	}
	
	
	
	
	
	function totalpriceEdit(){
		//alert("In");
		var amount = document.getElementById('investamountE').value;
		//alert(amount);
		if(amount!=""){
		document.getElementById('numberE').value=amount;
		}
		else{
			amount=0;	
		}
		
		var bigNumArry = new Array('', ' thousand', ' million', ' billion', ' trillion', ' quadrillion', ' quintillion');

    var output = '';
    var numString =   document.getElementById('numberE').value;
    var finlOutPut = new Array();

    if (numString == '0') {
        document.getElementById('containerE').value = 'Zero';
        return;
    }

    if (numString == 0) {
        document.getElementById('containerE').value = 'messeg tell to enter numbers';
        return;
    }

    var i = numString.length;
    i = i - 1;

    //cut the number to grups of three digits and add them to the Arry
    while (numString.length > 3) {
        var triDig = new Array(3);
        triDig[2] = numString.charAt(numString.length - 1);
        triDig[1] = numString.charAt(numString.length - 2);
        triDig[0] = numString.charAt(numString.length - 3);

        var varToAdd = triDig[0] + triDig[1] + triDig[2];
        finlOutPut.push(varToAdd);
        i--;
        numString = numString.substring(0, numString.length - 3);
    }
    finlOutPut.push(numString);
    finlOutPut.reverse();
    for (j = 0; j < finlOutPut.length; j++) {
        finlOutPut[j] = triConvert(parseInt(finlOutPut[j]));
    }

    var bigScalCntr = 0; //this int mark the million billion trillion... Arry

    for (b = finlOutPut.length - 1; b >= 0; b--) {
        if (finlOutPut[b] != "dontAddBigSufix") {
            finlOutPut[b] = finlOutPut[b] + bigNumArry[bigScalCntr] + ' ';
            bigScalCntr++;
        }
        else {
            //replace the string at finlOP[b] from "dontAddBigSufix" to empty String.
            finlOutPut[b] = ' ';
            bigScalCntr++; //advance the counter  
        }
    }
        for(n = 0; n<finlOutPut.length; n++){
            output +=finlOutPut[n];
        }
    document.getElementById('containerE').value = output;//print the output
	}
</script>
<script type="text/javascript">
function triConvert(num){
    var ones = new Array('', ' one', ' two', ' three', ' four', ' five', ' six', ' seven', ' eight', ' nine', ' ten', ' eleven', ' twelve', ' thirteen', ' fourteen', ' fifteen', ' sixteen', ' seventeen', ' eighteen', ' nineteen');
    var tens = new Array('', '', ' twenty', ' thirty', ' forty', ' fifty', ' sixty', ' seventy', ' eighty', ' ninety');
    var hundred = ' hundred';
    var output = '';
    var numString = num.toString();

    if (num == 0) {
        return 'dontAddBigSufix';
    }
    //the case of 10, 11, 12 ,13, .... 19 
    if (num < 20) {
        output = ones[num];
        return output;
    }

    //100 and more
    if (numString.length == 3) {
        output = ones[parseInt(numString.charAt(0))] + hundred;
        output += tens[parseInt(numString.charAt(1))];
        output += ones[parseInt(numString.charAt(2))];
        return output;
    }

    output += tens[parseInt(numString.charAt(0))];
    output += ones[parseInt(numString.charAt(1))];

    return output;
}   
</script>



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
  function getHeadList(strURL) {		
		var req = getXMLHTTP();
		//alert(strURL);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('masterhead').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	function getSubHeadList(strURL) {		
		var req = getXMLHTTP();
		var liabilities = document.getElementById('liabilities').value;	
		var master_head = document.getElementById('master_head').value;	
		//alert(master_head);
		var finalurl = strURL+'?liab_id='+liabilities+'&masterH='+master_head;
		//alert(req);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subhead').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", finalurl, true);
			req.send(null);
		}
				
	}
	
	
	
	
	
	
	
	function getHeadListEdit(strURL) {		
		var req = getXMLHTTP();
		//alert(strURL);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('masterheadE').innerHTML=req.responseText;						
					} else {
						alert("Sorry ! \n Something Wrong! Please Select Currect Information:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	function getSubHeadListEdit(strURL) {		
		var req = getXMLHTTP();
		var liabilities = document.getElementById('liabilitiesE').value;	
		var master_head = document.getElementById('master_headE').value;	
		
		var finalurl = strURL+'?liab_idE='+liabilities+'&masterHE='+master_head;
		//alert(req);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subheadE').innerHTML=req.responseText;						
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
<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
							<li>Revenue Information</li>
						</ul>

						
				  </div>
</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						     <?php //echo form_open('', 'class="form-horizontal form-label-left"');?>
                                   <div class="row">
                                        <div class="col-md-12">
                                        
                                            <!------CONTROL TABS START------>
                                            <ul class="nav nav-tabs bordered" style="margin:10px 10px 0 10px;">
                                                <li class="active">
                                                    <a href="#list" data-toggle="tab"><i class="entypo-list"></i> Sub Head List</a></li>
                                                <li>
                                                    <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>Add New  </a></li>
                                          </ul>
                                      <!------CONTROL TABS END------>
                                            
                                        
                                            <div class="tab-content">
                                                <!----TABLE LISTING STARTS-->
                                                <div class="tab-pane box active" id="list">
                                                	<?php echo $this->session->flashdata('successMsg');?>
                                                    <table width="100%" class="table table-bordered datatable datatable-show-all" id="table_export">
                                                        <thead>
                                                            <tr>
                                                              <th width="2%">#</th>
                                                              <th width="8%">Liabilities</th>
                                                              <th width="11%">Master </th>
                                                              <th width="12%"> Head</th>
                                                              <th width="6%"> Amount</th>
                                                              <th width="20%"> Word</th>
                                                              <th width="16%"> Received By</th>
                                                              <th width="17%"> Received Date</th>
                                                              <th width="8%">Action</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
														<?php $count = 1;
                                                        foreach($revenueList->result() as $row):
                                                              $liabilities		= $row->liabilities;
                                                              $master_head		= $row->master_head;
                                                              $sub_head			= $row->sub_head;
                                                              $amount			= $row->amount;
                                                              $amount_in_word	= $row->amount_in_word;
                                                              $received_by		= $row->received_by;
                                                              $received_date	= $row->received_date;
                                                            
                                                            if($liabilities==1){
                                                                $liabilities_name = 'Current Liabilities';
                                                                $queryMaster = $this->db->query("SELECT * FROM current_liabilities_master_head WHERE clmh_id='".$master_head."'");
                                                                $mrow = $queryMaster->row_array();
																$mHead = $mrow['title'];
                                                                
                                                                $querySub = $this->db->query("SELECT * FROM current_liabilities_sub_head WHERE clsh_id='".$sub_head."'");
                                                                $srow = $querySub->row_array();
																$sHead = $srow['title'];
                                                            }
                                                            elseif($liabilities==2){
                                                                $liabilities_name = 'Long Term Liabilities';
																$queryMaster = $this->db->query("SELECT * FROM longterm_liabilities_master_head WHERE flmh_id='".$master_head."'");
                                                                $mrow = $queryMaster->row_array();
																$mHead = $mrow['title'];
                                                                
                                                                $querySub = $this->db->query("SELECT * FROM longterm_liabilities_sub_head WHERE flsh_id='".$sub_head."'");
                                                                $srow = $querySub->row_array();
																$sHead = $srow['title'];
                                                            }
                                                             
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $liabilities_name;?></td>
                                                                <td><?php echo $mHead;?></td>
                                                                <td><?php echo $sHead;?></td>
                                                                <td><?php echo $amount;?></td>
                                                                <td><?php echo $amount_in_word;?></td>
                                                                <td><?php echo $received_by;?></td>
                                                                <td><?php echo $received_date;?></td>
                                                               
                                                                <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                        Action <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                                        
                                                                        <!-- EDITING LINK -->
                                                                        <li><a href="#" data-toggle="modal" data-target="#editModal<?php echo $row->r_id;?>" style="color:#FF9900">
                                                                        <i class="glyphicon glyphicon-pencil"></i>Edit</a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="javascript:void();" onclick="openPage1('<?php echo $row->r_id;?>','revenue','r_id');" 
                                                                        style="color:#ff0000"><i class="glyphicon glyphicon-trash"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>                                                                </td>
                                                            </tr>
                                                            <div id="editModal<?php echo $row->r_id;?>" class="modal fade" role="dialog">
                                                          <div class="modal-dialog">
                                                          <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title" style="width:30%; float:left">Master Head {Edit}</h4>
                                                                <h4 class="modal-title" id="succssMsg" style="float:right; margin-right:1%; width:60%; color:#00CC00"></h4>
                                                              </div>
                                                              <div class="modal-body">
                                                                   
																   
																   
																   
																   
																   <div class="col-sm-11 col-sm-offset-1" style="margin-bottom:30px;">
                                                                         
                                                                        <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Liabilities
                                                                            <span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                            <select name="liabilities" id="liabilitiesE" required class="form-control col-md-7 col-xs-12"
                                                                            onChange="getHeadListEdit('<?php echo base_url($urlname);?>/ajaxAccountsData?liabilitiesE='+this.value);">
                                                                                <option value="<?php echo $liabilities;?>"><?php echo $liabilities_name;?></option>
                                                                                <option value="1">Current Liabilities</option>
                                                                                <option value="2">Long Term Liabilities</option>
                                                                            </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Master Head
                                                                            <span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                               <div id="masterheadE">
                                                                                <select name="master_head" required class="form-control col-md-7 col-xs-12">
                                                                                    <option value="<?php echo $master_head;?>"><?php echo $mHead;?></option>
                                                                                </select>
                                                                               </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Sub Head</label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                               <div id="subheadE">
                                                                                <select name="sub_head" class="form-control col-md-7 col-xs-12">
                                                                                    <option value="<?php echo $sub_head;?>"><?php echo $sHead;?></option>
                                                                                </select>
                                                                               </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                  		 <div class="form-group" style="margin:7px;">
                                                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Amount
                                                                                <span class="required">*</span></label>
                                                                                  <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" required name="amount" id="investamountE" 
                                                                                            class="form-control col-md-7 col-xs-12" 
                                                                                            onchange="totalpriceEdit()" onkeyup="totalpriceEdit()" 
                                                                                            placeholder='Total Amount' value="<?php echo $amount;?>"  
                                                                                            onFocus="this.placeholder=''" onBlur="this.placeholder='Total Amount'">
                                                                                        </div>
                                                                            </div>
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Amount In Word</label>
                                                                              <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                <input type="hidden" id="numberE" size="15" onkeyup="totalpriceEdit();"
                                                                                onkeydown="return (event.ctrlKey || event.altKey 
                                                                                                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                                                                                                || (95<event.keyCode && event.keyCode<106)
                                                                                                || (event.keyCode==8) || (event.keyCode==9) 
                                                                                                || (event.keyCode>34 && event.keyCode<40) 
                                                                                                || (event.keyCode==46) )"/>
                                                                                        <input type="text" name="amount_in_word" class="form-control col-md-7 col-xs-12" 
                                                                                        id="containerE" style="text-transform:capitalize" 
                                                                                        value="<?php echo $amount_in_word;?>">
                                                                                    </div>
                                                                           </div>          
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Deposit By</label>
                                                                          <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                <input type="text" name="received_by" class="form-control col-md-7 col-xs-12" 
                                                                                placeholder='Received By' value="<?php echo $received_by;?>"  
                                                                                onFocus="this.placeholder=''" onBlur="this.placeholder='Received By'">
                                                                            </div>
                                                                        </div>          
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Deposit Date</label>
                                                                          <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                <input type="date" name="received_date" class="form-control col-md-7 col-xs-12 date-picker" 
                                                                                placeholder='Deposit Date' value="<?php echo $received_date;?>"  
                                                                                onFocus="this.placeholder=''" 
                                                                                onBlur="this.placeholder='Deposit Date'">
                                                                            </div>
                                                                        </div> 
                                                               
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                              </div>
                                                              <div class="modal-footer">
                                                                 <input type="hidden" name="r_id" value="<?php echo $row->r_id; ?>">
                                                                  <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              </div>
                                                            </div>
                                                          <?php echo form_close();?>                                                          </div>
                                                        </div>
                                                            <?php endforeach;?>
                                                        </tbody>
                                                    </table>
                                              </div>
                                                
                                                <div class="tab-pane box" id="add" style="padding: 5px">
                                                    <div class="box-content">
                                                        <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                                               <div class="col-sm-6 col-sm-offset-2">
                                                               	 
                                                                        <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Liabilities
                                                                            <span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                            <select name="liabilities" id="liabilities" required class="form-control col-md-7 col-xs-12"
                                                                            onChange="getHeadList('<?php echo base_url($urlname);?>/ajaxAccountsData?liabilities='+this.value);">
                                                                                <option value="">Liabilities</option>
                                                                                <option value="1">Current Liabilities</option>
                                                                                <option value="2">Long Term Liabilities</option>
                                                                            </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Master Head
                                                                            <span class="required">*</span></label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                               <div id="masterhead">
                                                                                <select name="master_head" required class="form-control col-md-7 col-xs-12">
                                                                                    <option value="">Master Head</option>
                                                                                </select>
                                                                               </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 hidden-xs">Sub Head</label>
                                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                               <div id="subhead">
                                                                                <select name="sub_head" class="form-control col-md-7 col-xs-12">
                                                                                    <option value="">Sub Head</option>
                                                                                </select>
                                                                               </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                  		 <div class="form-group" style="margin:7px;">
                                                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Amount
                                                                                <span class="required">*</span></label>
                                                                                  <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" required name="amount" id="investamount" 
                                                                                            class="form-control col-md-7 col-xs-12" onchange="totalprice()" onkeyup="totalprice()" 
                                                                                            placeholder='Total Amount' value="<?php echo set_value('amount'); ?>"  
                                                                                            onFocus="this.placeholder=''" onBlur="this.placeholder='Total Amount'">
                                                                                        </div>
                                                                            </div>
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Amount In Word</label>
                                                                              <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                <input type="hidden" id="number" size="15" onkeyup="totalprice();"
                                                                                onkeydown="return (event.ctrlKey || event.altKey 
                                                                                                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                                                                                                || (95<event.keyCode && event.keyCode<106)
                                                                                                || (event.keyCode==8) || (event.keyCode==9) 
                                                                                                || (event.keyCode>34 && event.keyCode<40) 
                                                                                                || (event.keyCode==46) )"/>
                                                                                        <input type="text" name="amount_in_word" class="form-control col-md-7 col-xs-12" 
                                                                                        id="container" style="text-transform:capitalize" 
                                                                                        value="<?php echo set_value('amount_in_word'); ?>">
                                                                                    </div>
                                                                           </div>          
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Received By</label>
                                                                          <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                <input type="text" name="received_by" class="form-control col-md-7 col-xs-12" 
                                                                                placeholder='Received By' value="<?php echo set_value('received_by'); ?>"  
                                                                                onFocus="this.placeholder=''" onBlur="this.placeholder='Received By'">
                                                                            </div>
                                                                        </div>          
                                                                         <div class="form-group" style="margin:7px;">
                                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Received Date</label>
                                                                          <div class="col-md-8 col-sm-8 col-xs-12">
                                                                                <input type="date" name="received_date" class="form-control col-md-7 col-xs-12 date-picker" 
                                                                                placeholder='Received Date' value="<?php echo set_value('received_date'); ?>"  
                                                                                onFocus="this.placeholder=''" 
                                                                                onBlur="this.placeholder='Received Date'">
                                                                            </div>
                                                                        </div> 
                                                               
                                                                 <div class="ln_solid"></div>
                            									 <div class="f	orm-group" style="margin:20px;">
                                                                    <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                                                                        <input type="reset" class="btn btn-primary" value="Reset">
                                                                        <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                                                    </div>
                                                                </div>                                                            
                                                        </div>
                                                        <?php echo form_close();?>              
                                                    </div>                
                                                </div>
                                                
                                            </div>
                                        </div>
					  </div>
                               <?php //echo form_close();?>
					</div>
