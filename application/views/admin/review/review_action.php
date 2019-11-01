<?php
if($reviewUpdate->num_rows()>0){
	foreach($reviewUpdate->result() as $reviewData);
	$peoductinfoe = $this->db->query("SELECT * FROM product WHERE product_id = '".$reviewData->pro_id."'");
	$prow = $peoductinfoe->row_array();
	$revPro = $prow['product_name'];
	$revProId= $prow['product_id'];
	$revProImg = $prow['main_image'];
	$id=$reviewData->id;
	$username=$reviewData->username;
	$email=$reviewData->email;
	$details=$reviewData->review;
	$review_title=$reviewData->review_title;
}
else{
	$id='';
	$username=set_value('username');
	$details=set_value('details');
	$review_title=set_value('review_title');
	$revProImg = '';
	$revProId = '';
	$revPro = '';
}
?>
<script>
$(document).ready(function() {
        $('.ratings_stars').click(function(){
			  $(this).prevAll().andSelf().addClass('ratings_over');
			  var thisval = $(this).attr('title');
			   $('#ratval').val(thisval);
			   $(this).nextAll().removeClass('ratings_over');
		});
    });
function getProduct(){

	  //alert(pid);
	  var key = $("#pro_id").val();
	  if(key.length > 0){
	  	 $("#prodlist").show(200);
		  var surl = '<?php echo base_url('administration/getProductAjax');?>';
		  $.ajax({ 
			type: "POST", 
			dataType: "json",
			url: surl,  
			data:{'keyword':key},
			cache : false, 
			success: function(response) { 		  
			   $("#prodlist").html(response.prodlist);
			}, 
			error: function (xhr, status) {  
			  alert('Unknown error ' + status); 
			}    
		  });  
	   }
	   else{
	   	$("#prodlist").html('');
	   }
    }	


  function ajaxProduct(pid){
	  var pname = $("#proname"+pid).val();
	  var key = $("#pro_id").val(pname);
	  $("#products_id").val(pid);
	  
	  $("#prodlist").hide(200);
  }	
</script>
<style>
ul.autocomplete{
	width:300px;
	max-height:400px;
	float:left;
	position:absolute;
	height:auto;
	z-index:1;
	background:#fff;
	overflow:scroll;
	display:block;
	margin:0;
	padding:0;
	border:1px solid #ccc;
}
ul.autocomplete li{
	border-bottom:1px solid #ccc;
	padding:5px;
	cursor:pointer;
	text-align:left;
	display:block;
	font-size:12px;
	text-transform:capitalize;
}
.rate_widget {
	overflow:   visible;
	position:   relative;
	width:      100%;;
	height:     32px;
}
.ratings_stars {
	background: url(<?php echo base_url();?>assets/images/star_empty.png) no-repeat;
	float:      left;
	height:     28px;
	padding:    2px;
	width:      32px;
	cursor:pointer;
}

.ratings_over {
	background: url(<?php echo base_url();?>assets/images/star_highlight.png) no-repeat;
}

</style>
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
                                                   review Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                       
                                                        	
                                                            
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-3"><label class="control-label">Product Name *</label></div>
                                                                    <div class="col-sm-9">
                                                                    <input type="text"  id="pro_id" onKeyUp="getProduct();" value="<?php echo $revPro;?>" class="form-control" />
                                                                    <input type="hidden" name="pro_id" id="products_id" value="<?php echo $revProId;?>"/>                                        
                                                                    <div id="prodlist"></div>
                                                                    </div>
                                                                </div>
                                                           </div>
                                                           
                                         				   <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-3"><label class="control-label">Your Name *</label></div>
                                                                    <div class="col-sm-9"><input type="text" name="username" value="<?php echo $username;?>" class="form-control" required/></div>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-3"><label class="control-label">Review Title *</label></div>
                                                                    <div class="col-sm-9"><input type="text" name="review_title" value="<?php echo $review_title;?>" 
                                                                    class="form-control" required /></div>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-3"><label class="control-label">Your Rating</label></div>
                                                                    <div class="col-sm-9">
                                                                        <div class='movie_choice'>
                                                                    <div id="r1" class="rate_widget">
                                                                        <div class="ratings_stars" title="1"></div>
                                                                        <div class="ratings_stars" title="2"></div>
                                                                        <div class="ratings_stars" title="3"></div>
                                                                        <div class="ratings_stars" title="4"></div>
                                                                        <div class="ratings_stars" title="5"></div>
                                                                        <input type="hidden" id="ratval" name="ratingVal" />                                                                        
                                                                    </div>
                                                                </div>
                                                                    </div>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-3"><label class="control-label">Your Comment  *</label></div>
                                                                    <div class="col-sm-9"><textarea name="review" class="form-control" required 
                                                                    style="background:none; border:1px solid #ccc"><?php echo $details;?></textarea></div>
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
                                        <input type="hidden" name="b_id" value="<?php echo $id; ?>">
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
               