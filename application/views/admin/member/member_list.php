<div class="right_col category_list" role="main">
	<div class="ngo-page-header">
		<div class="col-md-6">
			<h1>Member List</h1>
		</div>
		<div class="col-md-6">
			<a href="<?php echo base_url('administration/memberAdd') ?>" class="cat_add btn btn-primary pull-right">Add Member</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<table class="table table-bordered" id="course_form">
			<thead>
				<tr>
					<th>Sl</th>
					<th>Member Name</th>
					<th>Designation</th>
					<th>Brief</th>
					<th>Photo</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                <?php $i=1; foreach($member_list as $member_item) : ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td class="col-xs-3"><?php echo $member_item['member_name']; ?></td>
						<td><?php echo $member_item['designation']; ?></td>
						<td><?php echo $member_item['description']; ?></td>
						<td class="course_img"><img src="<?php echo $image_path.$member_item['photo']; ?>" alt=""></td>
						<td><a href="<?php echo base_url('administration/memberUpdate').'?member_id='.$member_item['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
					</tr>
				<?php $i++; endforeach; ?>
			</tbody>
		</table>


	</div>
</div>
