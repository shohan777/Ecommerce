<div class="right_col category_list" role="main">
	<div class="ngo-page-header">
		<div class="col-md-6">
			<h1>Category List</h1>
		</div>
		<div class="col-md-6">
			<a href="<?php echo base_url('administration/course/category_add') ?>" class="cat_add btn btn-primary pull-right">Add Category</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo form_open_multipart('administration/course/category', 'id="category_form"');?>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Slug</th>
					<th>Image</th>
					<th>Descriptioni</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($categories as $category) : ?>
				<tr>
					<td>
						<?php echo $category['category_name']; ?>
					</td>
					<td>
						<?php echo $category['category_slug']; ?>
					</td>
					<td class="cat_img">
						<img src="<?php echo $image_path.$category['cat_image']; ?>" alt="">
					</td>
					<td>
						<?php echo $category['description']; ?>
					</td>
					<td>
						<a href="<?php echo base_url('administration/course/category_edit').'/'.$category['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>


	</div>
</div>
