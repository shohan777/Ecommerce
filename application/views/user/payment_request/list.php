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
                                    <h2 style="float:right"><a href="<?php echo base_url('mlmuser/payment_request');?>" class="btn btn-primary">New Request</a></h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th width="11%">P. Method</th>
                                        <th width="9%">Account</th>                                        
                                        <th width="9%">Req. Amount</th>                                       
                                        <th width="9%">Req. Date</th>
                                        <th width="10%">Exp. Date</th>
                                        <th width="11%">Particular</th>
                                        <th width="11%">App. Date</th>
                                        <th width="9%">App. By</th>
                                        <th width="5%">Paid </th>
                                        <th width="6%">Status</th>
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
									$req_date=$rdata->req_date;
									$expected_date=$rdata->expected_date;
									$particular=$rdata->particular;
									$approved_date=$rdata->approved_date;
									$paid_amount=$rdata->paid_amount;
									$approved_by=$rdata->approved_by;
									$created_at=$rdata->created_at;
									$status=$rdata->status;
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $pay_method; ?></td>
                                        <td><?php echo $account; ?></td>
                                        <td><?php echo $reqamount; ?></td>
                                        <td><?php echo $req_date; ?></td>
                                        <td><?php echo $expected_date; ?></td>
                                        <td><?php echo $particular; ?></td>
                                        <td><?php echo $approved_date; ?></td>
                                        <td><?php echo $approved_by; ?></td>
                                        <td><?php echo $paid_amount; ?></td>
                                        <td><?php echo $status; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('mlmuser/payment_request/'.$bd_id);?>" class="btn btn-warning btn-xs">
          										<span class="glyphicon glyphicon-edit"></span>
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $bd_id;?>','payment_requests','id');" class="btn btn-danger btn-xs">
          										<span class="fa fa-trash"></span>
                                            </a>
                                            </td>
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
               