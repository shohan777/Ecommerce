<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
<div class="container" style="margin:20px auto;">
    <div class="content_details">
    <div class="col-sm-11">
           <?php if($articledetails['headline']){?>
                <h2><?php echo stripslashes($articledetails['headline']);?></h2>
                <p><?php echo stripslashes($articledetails['details']);?></p>
            <?php 
			}
			else{
				echo '<h2>'.$title.'</h2>';
				echo '<h2 style="color:#f00; text-align:center; margin:5%;">No Data Found</h2>';
			} 
			?>
		</div>
    </div>
    </div>
</div>
