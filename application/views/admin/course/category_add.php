<div class="right_col" role="main">
	<div class="col-md-12">
		<h1>Category</h1>
	</div>
	<div class="clearfix"></div>
	<?php echo form_open_multipart('administration/course/category', 'id="category_form"');?>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="cat_name">Name:</label>
			<input type="text" class="form-control" name="category_name" id="category_name">
		</div>
		<div class="form-group">
			<label for="cat_description">Description</label>
			<textarea class="form-control" name="description" id="cat_description" rows="3"></textarea>
		</div>

	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="cat_slug">Slug:</label>
			<input type="text" class="form-control" name="category_slug" id="cat_slug">
		</div>
		<div class="form-group">
			<label for="cat_image">Category Image</label>
			<input type="file" class="form-control-file" name="cat_image" id="cat_image">
			<div class="form-group row cat_save">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary btn-lg" name="category_submit" value="save">Save</button>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
</div>
