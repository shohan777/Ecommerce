<?php
if($cupon_userUpdate->num_rows()>0){
	foreach($cupon_userUpdate->result() as $cupon_userData);
	$id=$cupon_userData->id;
	$cid=$cupon_userData->cid;
	$user_id=$cupon_userData->user_id;
	$start_date=$cupon_userData->start_date;
	$end_date=$cupon_userData->end_date;
}
else{
	$id='';
	$cid=set_value('cid');
	$user_id=set_value('user_id');
	$start_date=set_value('start_date');
	$end_date=set_value('end_date');
}
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Admin Registraion Form</h2>
                                    
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
                                                   Cupon Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                       
                                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cupon<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            	<?php echo form_error('cid', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                               <select name="cid" class="form-control">
                                                	<option value="">Cupon</option>
                                                    <?php foreach($cupon_list->result() as $cup): ?>
                                                     <option value="<?php echo $cup->id;?>"><?php echo 'Title: '.$cup->cname.' - Code: '.$cup->code;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Customer</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            	<?php echo form_error('user_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                <select name="user_id" class="form-control">
                                                	<option value="all">All Customer</option>
                                                    <?php foreach($customer_list->result() as $cust): ?>
                                                     <option value="<?php echo $cust->user_id;?>"><?php echo $cust->username;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="start_date" class="form-control date-picker" 
                                                placeholder='Start Date' value="<?php echo $start_date; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Start Date'">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">End Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control date-picker" type="text" name="end_date" placeholder="End Date" value="<?php echo $end_date; ?>" >
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