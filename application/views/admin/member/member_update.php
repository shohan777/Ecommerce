<div class="right_col" role="main">
	<div class="col-md-12">
		<h1>Add Member</h1>
	</div>
	<div class="clearfix"></div>
	<?php echo form_open_multipart('administration/memberUpdate', 'id="category_form"');?>
    <input type="hidden" name="member_id" value="<?php echo $get_memeber['id']; ?>">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="member_name">Name:</label>
			<input type="text" class="form-control" name="member_name" id="member_name" value="<?php echo $get_memeber['member_name'] ; ?>">
		</div>
        <div class="form-group">
			<label for="designation">Designation:</label>
			<input type="text" class="form-control" name="designation" id="designation" value="<?php echo $get_memeber['designation'] ; ?>">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" name="description" id="description" rows="3"><?php echo $get_memeber['description'] ; ?>"</textarea>
		</div>
        <div class="form-group">
			<label for="description">Status</label>
			<select class="form-control" id="sel1" name="status">
                <option value="1" <?php echo ($get_memeber['status'] == 1) ? 'selected':'' ?>>Active</option>
                <option value="2" <?php echo ($get_memeber['status'] == 2) ? 'selected':'' ?>>Inactive</option>
            </select>
		</div>
        <div class="form-group">
			<label for="member_photo">Member Photo</label>
            <img style="width:120px;display:block;" src="<?php echo $image_path.$get_memeber['photo'] ; ?>" alt="">
			<input type="file" class="form-control-file" name="member_photo" id="member_photo"">
		</div>

	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="social_facebook">Facebook:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_facebook" value="<?php echo $member_social[0] ; ?>">
		</div>
        <div class="form-group">
			<label for="social_twitter">Twitter:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_twitter" value="<?php echo $member_social[1] ; ?>">
		</div>
        <div class="form-group">
			<label for="social_linkedin">Linkedin:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_linkedin" value="<?php echo $member_social[2] ; ?>">
		</div>
        <div class="form-group">
			<label for="social_g_plus">Google Plus:</label>
			<input type="text" class="form-control" name="social_link[]" id="social_g_plus" value="<?php echo $member_social[3] ; ?>">
		</div>
		
	</div>
    <div class="col-xs-12">
        <div class="form-group row cat_save">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary btn-lg" name="member_submit" value="member_update">Save</button>
            </div>
        </div>
    </div>
	<?php echo form_close();?>
</div>
