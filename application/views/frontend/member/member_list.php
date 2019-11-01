<div class="" style="width:100%; background:#FFF;float:left; position:relative;overflow-x:hidden">
	<div class="row" style="background:#fafafa; border-bottom:1px solid #ccc;">
		<div class="container" style="padding:0;">
			<div class="branch_title" style="padding:0; margin:10px;">
				<a href="<?php echo base_url();?>">Home &nbsp;&raquo;&nbsp;</a>
				<a href="<?php echo base_url('/course');?>">Member &nbsp;&raquo;&nbsp;</a>
			</div>
		</div>
	</div>
	<div class="container" style="margin:20px auto;">
		<div class="course-container">
			<h1 class="my-4 text-center text-lg-left">Member List</h1>

			<div class="row text-center text-lg-left">
                <?php if(!empty($members)) : foreach($members as $member) : 
                    
                    $social = unserialize($member['social']);
                ?>

				<div class="col-lg-4 col-md-4 col-xs-6 member-list">
					<div class="member-list-inner">
                        <div class="brief">
                            <p><?php echo $member['description']; ?></p>
                        </div>
                        <div class="thumbnail">
                            <a href="/w3images/lights.jpg">
                                <img class="img-rounded" src="<?php echo $image_path.$member['photo']; ?>" alt="Lights" style="width:100%">
                                <div class="caption">
                                <p><?php echo $member['member_name']; ?></p>
                                </div>
                            </a>
                        </div>
                        <div class="meta-info">
                            <p><?php echo $member['designation']; ?></p>
                            <ul>
                                <li><a href="<?php echo $social[0]; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo $social[1]; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo $social[2]; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo $social[3]; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
					</div>
				</div>
            <?php endforeach; 
                else :
                    echo "No Member Found";
                endif;
            ?>
			</div>
		</div>
	</div>
</div>
