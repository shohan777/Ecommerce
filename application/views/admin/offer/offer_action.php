<?php
if($offerUpdate->num_rows()>0){
	foreach($offerUpdate->result() as $offerData);
	$b_id=$offerData->b_id;
	$offerTitle=$offerData->offer_name;
	$position=$offerData->position;
	$banner=$offerData->banner;
	$image=$offerData->image;
	$url=$offerData->url;
}
else{
	$b_id='';
	$offerTitle=set_value('offer_name');
	$url=set_value('url');
	$position=set_value('position');
	$position='';
	$image='';
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
                                                   offer Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                       
                                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="offer_name" class="form-control col-md-7 col-xs-12" 
                                                placeholder='offer Name' value="<?php echo $offerTitle; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='offer Name'">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">URL</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="url" class="form-control col-md-7 col-xs-12" 
                                                placeholder='URL' value="<?php echo $url; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='URL'">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Position<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select name="position" class="form-control">
                                               		<option value="left">Left</option>
                                                    <option value="center">Center</option>
                                                    <option value="right">Right</option>
                                                    <option value="bottom1">Bottom First</option>
                                                    <option value="bottom2">Bottom Last</option>
                                               </select>
                                             <?php echo form_error('position', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="checkbox" name="banner" value="1">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control" type="file" name="offerPhoto">
                                                <?php if($image!=""){?>
                                                <img src="<?php echo base_url('uploads/images/offer/'.$image); ?>"  style="width:100px; height:auto" />
                                                <?php } ?>
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
                                        <input type="hidden" name="b_id" value="<?php echo $b_id; ?>">
                                         <input type="hidden" name="stillimg" value="<?php echo $image; ?>">
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
               