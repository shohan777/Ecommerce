<?php
if($chargeUpdate->num_rows()>0){
	foreach($chargeUpdate->result() as $paymentData);
	$id=$paymentData->id;
	$location=$paymentData->location;
	$charge=$paymentData->charge;
	$date=$paymentData->date;
}
else{
	$id = '';
	$location='';
	$charge='';
	$date='';
	}
?>



<div class="right_col" role="main">
                <div class="">
                  <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Bank Deposit Form</h2>
                                    
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
                                                  Payment Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                
                                        
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="location" id="location" class="form-control col-md-7 col-xs-12" 
                                                placeholder='Location' value="<?php echo $location; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Account No.'">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Charge</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="charge" id="charge" class="form-control col-md-7 col-xs-12" onchange="totalprice()" onkeyup="totalprice()" 
                                                placeholder='Total Amount' value="<?php echo $charge; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Total Amount'">
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
                                           <input type="hidden" name="id" value="<?php echo $id; ?>">
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