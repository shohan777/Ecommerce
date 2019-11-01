<?php
if($requestUpdate->num_rows()>0){
	foreach($requestUpdate->result() as $rdata);
	$id=$rdata->id;
	$pay_method=$rdata->pay_method;
	$account=$rdata->account;
	$transfer_to=$rdata->transfer_to;
	$amount=$rdata->amount;									
	$expected_date=$rdata->transfer_date;
	$particular=$rdata->particular;
}
else{
	$id='';
	$pay_method=set_value('pay_method');
	$account=set_value('account');
	$amount=set_value('amount');									
	$expected_date=set_value('expected_date');
	$transfer_to=set_value('transfer_to');
	$particular=set_value('particular');
}
?>
<script>

function paymentMethod(status){
	//alert(status);
	if(status=="Bank"){
		document.getElementById('bankinfo').style.display="inline";
		document.getElementById('bkash_no').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else if(status=="bKash"){
		document.getElementById('bkash_no').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else{
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('bkash_no').style.display="none";
	}
}


</script>
<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="width:50%; float:left; padding:0; margin:10px 0 0 0">Request Form</h2>
                    <h2 style="width:50%; float:right; text-align:right; padding:0; margin:10px 0 0 0">Total Balance : <?php echo 'BDT '.$totalbalance['credit'];?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                    <div class="row" style="padding:10px">
                                
                       <div class="col-sm-8" style="margin:0; padding:0">
                        
                         <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> Transfer To: </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                 <input type="text" name="ref_id" id="ref_id" autocomplete="off" onKeyUp="getMlmUser('ref_id','reference_id','reflist');" class="form-control" />
                                <input type="hidden" id="reference_id"  name="transfer_to"/>                                        
                                <div id="reflist"></div>
                            
                                </div>
                          </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            	<label class="control-label col-md-4 col-sm-4 col-xs-12">Transfer Date<span class="required">*</span></label>
                           		 <div class="col-md-6 col-sm-6 col-lg-8">
                               <input type="text" name="expected_date" id="expected_date" value="<?php echo $expected_date;?>" 
                               required class="form-control col-md-7 col-xs-12 date-picker" 
                                placeholder='Date' onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Date'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Payment Method<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select class="form-control" name="pay_method" id="pay_method" 
                               style="width:50%; float:left" onchange="paymentMethod(this.value)">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="bKash">bKash</option>
                              </select>
                                <select class="form-control" name="bankinfo" id="bankinfo" style="width:50%; float:left; display:none">
                                    <?php foreach($bank_list->result() as $brow):?>
                                        <option value="<?php echo $brow->b_id;?>">
                                        <?php echo $brow->bank_name.' - '.$brow->account_no;?></option>
                                    <?php endforeach;?>
                                </select>
                                <div  style="width:50%; float:left;">
                              <input type="text" name="bkash_no" id="bkash_no" class="form-control" style="width:100%; float:left; display:none" 
                              placeholder="bKash No." />
                              </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Transfer Amount<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="amount"  id="amount" required class="form-control col-md-7 col-xs-12" value="<?php echo $amount;?>"  
                                placeholder='Total Amount' onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Total Amount'">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Particular<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <textarea type="text" name="particular" id="particular" required class="form-control"><?php echo $particular; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8 col-lg-offset-4">
                            	<input type="hidden" name="id" value="<?php echo $id;?>" />
                                <input type="submit" class="btn btn-success" name="registration" value="Submit" />
                            </div>
                        </div>   
                               
                      </div> 
                      
                      
                    </div>    
               <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>              
                
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