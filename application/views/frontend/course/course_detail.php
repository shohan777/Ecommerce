
<div class="row" style="width:100%; background:#FFF; position:relative; float:left">
	<div class="row" style="background:#fafafa; border-bottom:1px solid #ccc;">
		<div class="container" style="padding:0;">
			<div class="branch_title" style="padding:0; margin:10px;">
                <a href="<?php echo base_url();?>">Home &nbsp;&raquo;&nbsp;</a>
                <a href="<?php echo base_url('course/');?>">Course &nbsp;&raquo;&nbsp;</a>
                <?php echo $course_id;?>
            </div>
        </div>
    </div>
	<div class="container" style="margin:20px auto;">
		<div class="course-detail-container">
			<!-- Page Heading -->
			<h1 class="my-4"><strong>Course Detail</strong>
				<small>Secondary Text</small>
			</h1>

			<!-- Project One -->
			<div class="row">
				<div class="col-md-7">
					<div class="course-img">
						<img class="img-fluid rounded mb-3 mb-md-0" src="<?php echo $image_path.$course_detail['image'] ?>" alt="">
					</div>
				</div>
				<div class="col-md-5">
					<h3>
						<?php echo $course_detail['course_name'] ?>
					</h3>
					<p class="course-meta">
						<span>Course Duration: </span>
						<?php echo $course_detail['course_duration'] ?>
					</p>
					<p class="course-meta">
						<span>Course Price: </span>
						<?php echo $course_detail['course_price'] ?> BDT</p>
					<p>
						<?php echo $course_detail['description'] ?>
					</p>
					<a class="btn btn-primary enroll-btn" data-toggle="modal" data-target="#myModal" href="#">Enroll This Course</a>
				</div>
			</div>
			<!-- /.row -->

			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog" style="z-index: 9999">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Course Registration</h4>
						</div>
						<div class="modal-body">
              <form action="<?php echo base_url('course/detail').'/'.$course_detail['id'] ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="course_id" value="<?php echo $course_detail['id'] ?>">
                <input type="hidden" name="course_id" value="<?php echo $course_detail['id'] ?>">
								<div class="form-group">
									<label for="std_name">Name</label>
									<input type="text" class="form-control" id="std_name" name="std_name">
								</div>
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" id="phone" name="phone">
								</div>
								<div class="form-group">
									<label for="address">Address</label>
									<input type="text" class="form-control" id="address" name="address">
								</div>
								<div class="form-group">
									<label for="comment">Why do you want to do this course?</label>
									<textarea class="form-control" name="question_1" rows="3" id="comment"></textarea>
                </div>
                <div class="form-group">
									<label for="comment">Any previous experience in this matter?</label>
									<textarea class="form-control" name="question_2" rows="3" id="comment"></textarea>
                </div>
                <input type="file" class="form-control-file" name="std_image" id="std_image">
								<button style="margin-top:25px;" type="submit" class="btn btn-default" name="course_registration" value="course_registration">Submit</button>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
			<!-- Modal End -->
		</div>

	</div>
</div>
