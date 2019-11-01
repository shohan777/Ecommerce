<?php
if($bannerUpdate->num_rows()>0){
	foreach($bannerUpdate->result() as $bannerData);
	$b_id=$bannerData->b_id;
	$bannerTitle=$bannerData->banner_name;
	$details=$bannerData->subtitle;
	$bimage=$bannerData->image;
	$bgcolor=$bannerData->bg_color;
}
else{
	$b_id='';
	$bannerTitle=set_value('banner_name');
	$subtitle=set_value('subtitle');
	$details='';
	$bimage='';
	$bgcolor='';
	}
?>
<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Banner Registraion Form</h2>
                                    
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
                                                   Banner Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                       
                                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="banner_name" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='URL' value="<?php echo $bannerTitle; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='URL'">
                                             <?php echo form_error('banner_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Banner Photo</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control" type="file" name="bannerPhoto">
                                                <?php if($bimage!=""){?>
                                                <img src="<?php echo base_url('uploads/images/banner/'.$bimage); ?>" style="width:100px; height:auto" />
                                                <?php } ?>
                                            </div>
                                        </div>
                                                        <?php /*?><div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Details<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea type="text" name="subtitle" class="form-control ckeditor"><?php echo $details; ?></textarea>
                                            </div>
                                        </div><?php */?>
                                                        
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="hidden" name="b_id" value="<?php echo $b_id; ?>">
                                         <input type="hidden" name="stillimg" value="<?php echo $bimage; ?>">
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
               