<?php
if($cuponUpdate->num_rows()>0){
	foreach($cuponUpdate->result() as $cuponData);
	$id=$cuponData->id;
	$cname=$cuponData->cname;
	$code=$cuponData->code;
	$price=$cuponData->price;
	$discount=$cuponData->discount;
	$dis_type=$cuponData->dis_type;
}
else{
	$id='';
	$cname=set_value('cname');
	$code=set_value('code');
	$price=set_value('price');
	$discount = '';
	$dis_type = '';
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
                                                   cupon Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                       
                                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="cname" class="form-control col-md-7 col-xs-12" 
                                                placeholder='Name' value="<?php echo $cname; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Name'">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="code" class="form-control col-md-7 col-xs-12" 
                                                placeholder='Code' value="<?php echo $code; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Code'">
                                            </div>
                                        </div>
                                        
                                        
                                        <?php /*?><div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control" type="text" name="price" placeholder="Price" value="<?php echo $price; ?>" >
                                            </div>
                                        </div><?php */?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" name="discount" id="discount" required class="form-control" style="width:30%; float:left" 
                                                value="<?php echo $discount;?>">
                                                    <select name="dis_type" class="form-control"  style="width:20%; float:left">
                                                        <option value="%"><?php echo $dis_type;?></option>
                                                        <option value="%">%</option>
                                                        <option value="Tk">Tk</option>
                                                    </select>
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
               