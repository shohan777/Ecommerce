<div class="right_col category_list" role="main">
	<div class="ngo-page-header">
		<div class="col-md-6">
			<h1>Course List</h1>
		</div>
		<div class="col-md-6">
			<a href="<?php echo base_url('administration/course/course_add') ?>" class="cat_add btn btn-primary pull-right">Add Course</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<table class="table table-bordered" id="course_form">
			<thead>
				<tr>
					<th>Course Name</th>
					<th>Category</th>
					<th>Course Duration</th>
					<th>Price</th>
					<th>Description</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($courses as $course) : ?>
					<tr>
						<td><?php echo $course['course_name'] ?></td>
						<td><?php echo $course['category_name'] ?></td>
						<td><?php echo $course['course_duration'] ?></td>
						<td><?php echo $course['course_price'] ?></td>
						<td><?php echo $course['description'] ?></td>
						<td class="course_img"><img src="<?php echo $image_path.$course['image']; ?>" alt=""></td>
						<td><a href="<?php echo base_url('administration/course/course_edit').'/'.$course['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>


	</div>
</div>
