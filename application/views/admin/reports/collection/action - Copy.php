
<div class="right_col" role="main">

<!-- Page header -->
<div class="page-header">
    

    <div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
        <ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
                <li>Collection Reports</li>
        </ul>

        <ul class="breadcrumb-elements">
            <div class="heading-btn-group">
                
                <a href="<?php echo base_url('reports/collection_reports/print');?>"
                 onclick="javascript:void window.open('<?php echo base_url('reports/collection_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;" 
                 class="btn btn-link btn-float has-text" style="color:#009900">
                <i class="glyphicon glyphicon-print"></i><span>Print</span></a>
                
                <a href="<?php echo base_url('reports/collection');?>" class="btn btn-link btn-float has-text" style="color:#CC6600">
                <i class="glyphicon glyphicon-filter"></i><span>Filtering</span></a>
                
                
                <a href="javascript:void();" onclick="history.back()" class="btn btn-link btn-float has-text" style="color:#FF0000">
                <i class="fa fa-arrow-left"></i><span>Back</span></a>
            </div>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

<div class="panel panel-flat">
<div id="resonsedata">
<div id="LoadingImageE" style="display:none; width:100%; height:auto;margin:20% 50%;">
<img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:150px; height:auto" /></div>
<div id="registration_form">	

 <div class="panel panel-flat">
						     <?php echo form_open('', 'class="form-horizontal form-label-left"');?>
                                   <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs bordered" style="margin:10px 10px 10px 10px;">
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
                                                            $sql1=$this->db->query("select sum(amount) as total from revenue ".$wherecluse);
                                                            if($sql1->num_rows() > 0)
                                                            {
                                                            foreach($sql1->result() as $row1);												
                                                            $t_r_amount=$row1->total;
                                                           	 	echo 'TK '.number_format($t_r_amount,2,'.',',').' /=';
                                                            }
                                                            ?>
                                                            </strong>                                                            </td>
                                                            <td width="53%">Total Revenue </td>
                                                          </tr>
                                                          			
                                                                </table>                                                              </td>
                                                          </tr>
                                                            
                                                            <tr style="color:#006600">
                                                                <td height="34" align="right" class="flink">Total Collection</td>
                                                                <td height="34" align="center" class="flink">:</td>
                                                                <td align="left"><strong>
                                                                <?php echo 'TK '.number_format($t_r_amount,2,'.',',').' /=';?>		
                                                                </strong>                                                    </td>
                                                          </tr>
                                                        </table>
                                                       </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="tab-pane box" id="add" style="padding: 5px">
                                                    
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
																		
																	    $queryIncome=$this->db->query("select * from revenue ".$wherecluse);
																		foreach($queryIncome->result() as $payrow){
																		$debit=$payrow->credit;
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
													$totalincomecount = $incomeCount;													
												?>
												<strong style="color:#009900"><?php echo 'Total Collection '.number_format($totalincomecount,2,'.',',').' /='; ?></strong></div>                 
                                                </div>
                                                
                                            </div>
                                        </div>
					 			  </div>
                               <?php echo form_close();?>
					</div>


</div>
</div>          
</div>
