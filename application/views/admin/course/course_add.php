<div class="right_col" role="main">
	<div class="col-md-12">
		<h1>Course</h1>
	</div>
	<div class="clearfix"></div>
	<?php echo form_open_multipart('administration/course/category', 'id="category_form"');?>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="course_name">Name:</label>
			<input type="text" class="form-control" name="course_name" id="course_name">
		</div>
		<div class="form-group">
			<label for="course_category">Category:</label>
			<select class="form-control" id="course_category" name="cat_id">
				<?php foreach($categories as $category) : ?>
					<option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="cat_description">Description</label>
			<textarea class="form-control" name="description" id="cat_description" rows="3"></textarea>
		</div>

	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="course_duration">Course Duration:</label>
			<input type="text" class="form-control" name="course_duration" id="course_duration">
		</div>
		<div class="form-group">
			<label for="course_price">Price:</label>
			<input type="number" class="form-control" name="course_price" id="course_price">
		</div>
		<div class="form-group">
			<label for="course_image">Category Image</label>
			<input type="file" class="form-control-file" name="course_image" id="course_image">
			<div class="form-group row cat_save">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary btn-lg" name="course_add" value="course_add">Save</button>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
</div>
