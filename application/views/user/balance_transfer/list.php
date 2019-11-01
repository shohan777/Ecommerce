<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>administration/deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}
</script>

<div class="right_col" role="main">
                <div class="">
                  <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total Record (<?php echo $request_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('mlmuser/balance_transfer');?>" class="btn btn-primary">New Request</a></h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th width="11%">Transfer To</th>
                                        <th width="11%">P. Method</th>
                                        <th width="9%">Account</th>                                        
                                        <th width="9%">Transfer Amount</th>                                       
                                        <th width="10%">Transfer Date</th>
                                        <th width="11%">Particular</th>
                                        <th width="8%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($request_list->result() as $rdata):
									$bd_id=$rdata->id;
									$pay_method=$rdata->pay_method;
									$account=$rdata->account;
									$reqamount=$rdata->amount;									
									$transfer_to=$rdata->transfer_to;
									$transfer_date=$rdata->transfer_date;
									$particular=$rdata->particular;
									
									$usertoq = $this->Index_model->getAllItemTable('mlm_users','user_id',$transfer_to,'','','user_id','desc');
									if($usertoq->nuM_rows() > 0){
										$tranr = $usertoq->row_array();
										$username = $tranr['fullname'];
									}
									else{
										$username = '';
									}
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $pay_method; ?></td>
                                        <td><?php echo $account; ?></td>
                                        <td><?php echo $reqamount; ?></td>
                                        <td><?php echo $transfer_date; ?></td>
                                        <td><?php echo $particular; ?></td>
                                        <td> 
                                       	   <a href="<?php echo base_url('mlmuser/balance_transfer/'.$bd_id);?>" class="btn btn-warning btn-xs">
       										   <span class="glyphicon glyphicon-edit"></span>                                           </a> 
                                           <a href="javascript:void();" onclick="openPage1('<?php echo $bd_id;?>','balance_transfers','id');" class="btn btn-danger btn-xs">
       										   <span class="fa fa-trash"></span>                                           </a>                                           </td>
                                      </tr>
                                    <?php
                                    endforeach;
									?>  
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>

                </div>
               