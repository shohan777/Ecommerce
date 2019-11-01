<style>
.required{
	color:#f00;
}
</style>
<script type="text/javascript">

function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url($urlname);?>/deleteData/'+tablename+'/'+colid,
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

<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
							<li>Credit Information</li>
						</ul>
                        <ul class="breadcrumb-elements">
							<div class="heading-btn-group">
                                
                                <a href="<?php echo base_url($urlname.'/today_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url($urlname.'/today_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;" 
                                 class="btn btn-info" style="margin:7px 3px"><i class="fa fa-print"></i> Print</a>
                            	
							</div>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						     <?php echo form_open('', 'class="form-horizontal form-label-left"');?>
                                   <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs bordered" style="margin:10px 10px 0 10px;">
                                                <li class="active"><a href="#list" data-toggle="tab"><i class="entypo-list"></i> Summery</a></li>
                                                <li><a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>Details </a></li>
                                           </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane box active" id="list">
                                                	 <div class="row">
                                                     	<div class="col-md-12">
                                                        <table class="table-striped" align="center" width="50%" border="0">
                                              				<tr>
                                                            	<td height="44" colspan="3" align="center"><h4>Today's Report Summary</h4> </td>
                                                            </tr>
                                                            <tr>
                                                              <td width="53%" height="30" align="right" valign="top">Total Received </td>
                                                              <td width="4%" align="center" valign="top">:</td>
                                                              <td align="center" valign="top">
                                                              	<table width="100%" cellpadding="0" cellspacing="0">
                                                                	<tr>
                                                              
                                                              <td width="43%" align="left" colspan="2"><strong>
															<?php
															//echo $today;
                                                            $sql1=$this->db->query("select sum(amount) as total from revenue where received_date='".$today."' order by r_id asc");
                                                            if($sql1->num_rows() > 0)
                                                            {
                                                            foreach($sql1->result() as $row1);												
                                                            $t_r_amount=$row1->total;
                                                           	 	echo 'TK '.number_format($t_r_amount,2,'.',',').' /=';
                                                            }
                                                            ?>
                                                            </strong>   
                                                            </td>
                                                            <td width="53%">Total Revenue </td>
                                                          </tr>
                                                          			<tr>
                                                              
                                                              <td width="43%" align="left" colspan="2"><strong>
															<?php
															//echo $today;
                                                            $sqlf=$this->db->query("select sum(paid_amount) as totalf from fee_generate 
															where submit_date='".$today."' order by fg_id asc");
                                                            if($sqlf->num_rows() > 0)
                                                            {
                                                            foreach($sqlf->result() as $rowf);												
                                                            $totFee=$rowf->totalf;
                                                           	 	echo 'TK '.number_format($totFee,2,'.',',').' /=';
                                                            }
															
															
															$totalIncome = $totFee + $t_r_amount;
                                                            ?>
                                                            </strong>   
                                                            </td>
                                                              <td width="53%" align="left">Fee Collect</td>
                                                          </tr>
                                                                </table>
                                                              </td>
                                                          </tr>
                                                            <tr>
                                                                <td height="31" align="right">Total Expenses</td>
                                                                <td height="31" align="center">:</td>
                                                              	<td align="left">
                                                                   
                                                                    <strong>
																	<?php
                                                            $sql2=$this->db->query("select sum(amount) as total from expenses where received_date='".$today."' order by r_id asc");
                                                                    if($sql2->num_rows() > 0)
                                                                    {
                                                                    foreach($sql2->result() as $row2);												
                                                                    $t_p_amount=$row2->total;
                                                                    echo 'TK '.number_format($t_p_amount,2,'.',',').' /=';
                                                                    }
                                                                    ?></strong>  </td>
                                                          </tr>
                                                            <?php
																if($t_r_amount>=$t_p_amount){
																	$c='green';
																	$conl="Cash in Hands : ";
																	$profit=$totalIncome-$t_p_amount;
																}
																else{
																	$c='red';
																	$profit=$t_p_amount-$t_r_amount;
																	$conl="Today loss : ";
																	}
															?>
                                                
                                                            <tr style="color:<?php echo $c;?>">
                                                                <td height="34" align="right" class="flink"><?php echo $conl;?></td>
                                                                <td height="34" align="center" class="flink">:</td>
                                                                <td align="left"><strong>
                                                                <?php echo 'TK '.number_format($profit,2,'.',',').' /=';?>		
                                                                </strong>                                                    </td>
                                                          </tr>
                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="tab-pane box" id="add" style="padding: 5px">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; margin-bottom:5px; width:100%; padding:10px">
                                                          Total Expenses</div>
                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%" 
                                                          class="table table-bordered datatable datatable-show-all" id="table_export">
                                                            <tr bgcolor="#eaeaea">
                                                              <th width="1%" height="29"  align="center">SI</th>
                                                              <th width="10%" align="center">Debit</th>
                                                              <th width="10%" align="center">Head</th>
                                                              <th width="12%" align="center"> Amount</th>
                                                              <th width="15%" align="center">Amount in word</th>
                                                              <th width="14%" align="center">Payment By</th>
                                                              <th width="11%" align="center"> Date</th>
                                                             <!-- <th width="8%" align="center">Vroucher</th>
                                                              <th width="29%" align="center">Notes</th>-->
                                                            </tr>
                                                            <?php
                                                            $i=0;
                                                            $costCount = 0;
                                                            
                                                            $queryCost=$this->db->query("select * from expenses where received_date='".$today."'");
                                                            foreach($queryCost->result() as $payrow){
                                                            $debit=$payrow->debit;
															$master_heada=$payrow->master_head;
                                                            $costAmount=$payrow->amount;	
                                                            $received_by=$payrow->received_by;
                                                            $voucher=$payrow->voucher;
                                                            $amount_in_word=$payrow->amount_in_word;
                                                            $payment_date=$payrow->received_date;
															$notesp=$payrow->remarks;
                                                            
                                                            
                                                            $querypaymentfor=$this->db->query("select * from current_asset_master_head where camh_id='".$master_heada."'");
                                                            foreach($querypaymentfor->result() as $pfor);
                                                            
                                                                                          
                                                            if($i%2==0){
                                                                $clr='#fff';
                                                            }
                                                            else{
                                                                $clr='#f5f5f5';
                                                            }
                                                            $i++;
                                                            
                                                            ?>
                                                            
                                                            
                                                            <tr bgcolor="<?php echo $clr;?>">
                                                                <td align="center"><?php echo $i;?></td>
                                                                <td align="center"><?php echo 'Asset'; ?></td>
                                                                <td align="center"><?php echo $pfor->title; ?></td>
                                                                <td align="center"><?php echo $costAmount; ?></td>
                                                                <td align="center"><?php echo $amount_in_word; ?></td>
                                                                <td align="center"><?php echo $received_by; ?></td>
                                                                <td align="center"><?php echo $payment_date; ?></td>
                                                                <?php /*?><td align="center"><?php echo $voucher; ?></td>
                                                                <td align="center"><?php echo $notesp; ?></td><?php */?>
                                                            </tr>
                                                            
                                                            <?php
                                                            $costCount = $costCount + $costAmount;
                                                            }	
                                                            
                                                            ?>
                                                            
                                                              <tr bgcolor="#F9F9F9">
                                                                 <td align="right" colspan="9" style="font-size:16px; text-align:right; font-variant:bold">
                                                                 <strong>Total Amount = <?php echo 'TK '.number_format($costCount,2,'.',',').' /=';?></strong></td>
                                                              </tr>
                                                            </table>
                                                      </div>
													</div>
													<div class="row">
                                                      <div class="col-md-12">
													  <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px; padding:10px">
													  Total Received</div>
													  <table cellpadding="0" cellspacing="0" border="0" width="100%" 
                                                          class="table table-bordered datatable datatable-show-all" id="table_export">
														
																		<tr bgcolor="#eaeaea">
																		  <th width="2%" height="33"  align="center">SI</th>
                                                                          <th width="9%" align="center">Credit</th>
                                                                          <th width="10%" align="center">Head</th>
                                                                          <th width="11%" align="center"> Amount</th>
                                                                          <th width="17%" align="center">Amount in word</th>
                                                                          <th width="14%" align="center">Received By</th>
                                                                          <th width="10%" align="center"> Date</th>
                                                                          <!--<th width="8%" align="center">Vroucher</th>
                                                                          <th width="29%" align="center">Notes</th>-->
													    </tr>
																		<?php
																		$j=0;
																		$incomeCount = 0;
																		
																	    $queryIncome=$this->db->query("select * from revenue where received_date='".$today."'");
																		foreach($queryIncome->result() as $payrow){
																		$debit=$payrow->liabilities;
																		$master_head=$payrow->master_head;
																		$incomeAmount=$payrow->amount;	
																		$received_by=$payrow->received_by;
																		$voucher=$payrow->voucher;
																		$amount_in_word=$payrow->amount_in_word;
																		$payment_date=$payrow->received_date;
																		
																		
																		$querypaymentfor=$this->db->query("select * from current_liabilities_master_head where clmh_id='".$master_head."'");
																		foreach($querypaymentfor->result() as $pfor);
																		
																						  
																		if($j%2==0){
																			$clr='#fff';
																		}
																		else{
																			$clr='#f5f5f5';
																		}
																		$j++;
																		
																		?>
																		
																		
																		<tr bgcolor="<?php echo $clr;?>">
																			<td align="center"><?php echo $j;?></td>
                                                                            <td align="center"><?php echo 'Liabilities'; ?></td>
                                                                            <td align="center"><?php echo $pfor->title; ?></td>
                                                                            <td align="center"><?php echo $incomeAmount; ?></td>
                                                                            <td align="center"><?php echo $amount_in_word; ?></td>
                                                                            <td align="center"><?php echo $received_by; ?></td>
                                                                            <td align="center"><?php echo $payment_date; ?></td>
                                                                           <?php /*?> <td align="center"><?php echo $voucher; ?></td>
                                                                            <td align="center"><?php echo $voucher; ?></td><?php */?>
																		</tr>
																		
																		<?php
																		$incomeCount = $incomeCount + $incomeAmount;
																		}	
																		
																		?>
																		
																		 <tr bgcolor="#F9F9F9">
																			 <th align="right" colspan="8" style="font-size:16px; text-align:right; font-variant:bold">
																				 <strong>Total Amount = <?php echo 'TK '.number_format($incomeCount,2,'.',',').' /=';?></strong></th>
																		  </tr>
														
														
														
																		
														</table>
													</div>
                                                    </div>
													<div class="container" style="font-size:20px; border-top:1px solid #ccc; float:left; text-align:center; width:100%; margin-bottom:5px; padding:10px;">
													<?php
													if($incomeCount>=$costCount){
														$c='green';
														$con="Gross Amount as Balance : ";
														$loss=number_format($incomeCount-$costCount,2,'.',',');
													}
													else{
														$c='red';
														$loss=number_format($costCount-$incomeCount,2,'.',',');;
														$con="Gross Amount as Outstanding : ";
														}
												?>
												<strong style="color:<?php echo $c;?>"><?php echo $con.' TK '.$loss.' /='; ?></strong></div>                 
                                                </div>
                                                
                                            </div>
                                        </div>
					 			  </div>
                               <?php echo form_close();?>
					</div>
