<div class="right_col category_list" role="main">
	<div class="ngo-page-header">
		<div class="col-md-6">
			<h1>Registration List</h1>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo form_open_multipart('administration/course/category', 'id="category_form"');?>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Course</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Question 1</th>
					<th>Question 2</th>
					<th>Question 3</th>
					<th>Image</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($registration_list as $registration) : ?>
				<tr>
					<td>
						<?php echo $registration['std_name']; ?>
					</td>
					<td>
						<?php echo $registration['course_name']; ?>
					</td>
					<td>
						<?php echo $registration['phone']; ?>
					</td>
					<td>
						<?php echo $registration['address']; ?>
					</td>
					<td>
						<?php echo $registration['question_1']; ?>
					</td>
					<td>
						<?php echo $registration['question_2']; ?>
					</td>
					<td>
						<?php echo $registration['question_3']; ?>
					</td>
					<td class="cat_img">
						<img src="<?php echo $image_path.$registration['image']; ?>" alt="">
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
