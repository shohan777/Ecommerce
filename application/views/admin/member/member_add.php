<div class="right_col" role="main">
	<div class="col-md-12">
		<h1>Add Member</h1>
	</div>
	<div class="clearfix"></div>
	<?php echo form_open_multipart('administration/memberAdd', 'id="category_form"');?>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="member_name">Name:</label>
			<input type="text" class="form-control" name="member_name" id="member_name">
		</div>
        <div class="form-group">
			<label for="designation">Designation:</label>
			<input type="text" class="form-control" name="designation" id="designation">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" name="description" id="description" rows="3"></textarea>
		</div>
        <div class="form-group">
			<label for="member_photo">Member Photo</label>
			<input type="file" class="form-control-file" name="member_photo" id="member_photo">
		</div>

	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="social_facebook">Facebook:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_facebook">
		</div>
        <div class="form-group">
			<label for="social_twitter">Twitter:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_twitter">
		</div>
        <div class="form-group">
			<label for="social_linkedin">Linkedin:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_linkedin">
		</div>
        <div class="form-group">
			<label for="social_g_plus">Google Plus:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_g_plus">
		</div>
		
	</div>
    <div class="col-xs-12">
        <div class="form-group row cat_save">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary btn-lg" name="member_submit" value="member_add">Save</button>
            </div>
        </div>
    </div>
	<?php echo form_close();?>
</div>
