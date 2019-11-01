<div class="" style="width:100%; background:#FFF;float:left; position:relative;overflow-x:hidden">
  <div class="row" style="background:#fafafa; border-bottom:1px solid #ccc;">
		<div class="container" style="padding:0;">
			<div class="branch_title" style="padding:0; margin:10px;">
                <a href="<?php echo base_url();?>">Home &nbsp;&raquo;&nbsp;</a>
                <a href="<?php echo base_url('/course');?>">Course &nbsp;&raquo;&nbsp;</a>
            </div>
        </div>
    </div>
	<div class="container" style="margin:20px auto;">
		<div class="course-container">
			<h1 class="my-4 text-center text-lg-left">Course List</h1>

      <div class="row text-center text-lg-left">

        <?php foreach($courses as $course) : ?>

          <div class="col-lg-3 col-md-4 col-xs-6 course-list">
          <div class="course-list-inner">
            <a href="<?php echo base_url('course/detail').'/'.$course['id'] ?>">
            <h3><?php echo $course['course_name'] ?></h3>
            <p><?php echo $course['course_price'] ?> <span>BDT</span></p>
          </a>
          </div>
        </div>

        <?php endforeach; ?>
      </div>
		</div>
	</div>
</div>
