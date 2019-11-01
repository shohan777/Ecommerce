<style>
    .inactive {
        background: #ef6c00;
    }
    .s_active {
        background: #43a047;
    }
    .table {
        display: block;
        width: 100%;
    }
</style>
<div class="right_col category_list" role="main">
	<div class="ngo-page-header">
		<div class="col-md-6">
			<h1>Seller List</h1>
		</div>
		<!-- <div class="col-md-6">
			<a href="<?php //echo base_url('administration/memberAdd') ?>" class="cat_add btn btn-primary pull-right">Add Member</a>
		</div> -->
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12 col-sm-12 col-xs-12">
        <?php
            if($seller_application) { ?>
                <table class="table table-bordered table-responsive" id="course_form">
                <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Seller Code</th>
                        <th class="text-center">Seller Balance</th>
                        <th class="text-center">Seller Name</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Eamil</th>
                        <th class="text-center">Bkash</th>
                        <th class="text-center">Bank Account</th>
                        <th class="text-center">Area</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="min-height: 66px;display: inline-block;width: 114px;">Action</th>
                    </tr>
                </thead>
                <tbody style="font-weight: 700;color:#fff">
                    <?php $i=1; foreach($seller_application as $seller_item) : ?>
                        <tr class="<?php echo ($seller_item['status'] == 2) ? 's_active' : 'inactive'; ?>">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $seller_item['seller_code']; ?></td>
                            <td><?php echo $seller_item['balance']; ?></td>
                            <td><?php echo $seller_item['full_name']; ?></td>
                            <td><?php echo $seller_item['mobile']; ?></td>
                            <td><?php echo $seller_item['email']; ?></td>
                            <td><?php echo $seller_item['bkash_number']; ?></td>
                            <td><?php echo $seller_item['bank_account']; ?></td>
                            <td><?php echo $seller_item['area']; ?></td>
                            <td><?php echo $seller_item['city']; ?></td>
                            <td><?php echo ($seller_item['status'] == 2) ? 'Approve' : 'Disapprove'; ?></td>
                            <td><button style="padding: 5px 10px;margin-right:3px;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#seller_id-<?php echo $seller_item['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button><a href="<?php echo base_url('administration/memberUpdate').'?member_id='.$seller_item['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

                            <!-- Modal -->
                            <div id="seller_id-<?php echo $seller_item['id']; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog" style="z-index: 9999">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?php echo $seller_item['full_name'].'['.$seller_item['seller_code'].']'; ?></h4>
                                    </div>
                                    <div class="modal-body">
                                    <form action="<?php echo base_url('administration/seller'); ?>" method="POST">
                                    <input type="hidden" name="seller_id" value="<?php echo $seller_item['id']; ?>">
                                    <div class="form-group">
                                        <label for="sel1">Seller Status:</label>
                                        <select class="form-control" id="sel1" name="update_status">
                                            <option value="2" <?php echo ($seller_item['status'] == 2) ? 'selected' : ''; ?>>Approve</option>
                                            <option value="1" <?php echo ($seller_item['status'] != 2) ? 'selected' : ''; ?>>Disapprove</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="seller_pass">Set password:</label>
                                        <input type="password" class="form-control" id="seller_pass" name="seller_pass">
                                    </div>
                                    <div class="form-group" style="display:<?php echo ($seller_item['status'] == 2) ? 'block' : 'none'; ?>">
                                        <label for="balance">Send Balance:</label>
                                        <input type="number" class="form-control" id="balance" name="balance">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal END -->
                        </tr>
                    <?php $i++; endforeach; ?>

                </tbody>
            </table>
            <?php } else {
                echo "<h3 class='text-center'>No data Found</h3>";
            }
        
        ?>

	</div>
</div>
