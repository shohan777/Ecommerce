
<div class="right_col" role="main">

<!-- Page header -->
<div class="page-header">
    

    <div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
        <ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
                <li>Transaction Reports</li>
        </ul>

        <ul class="breadcrumb-elements">
            <div class="heading-btn-group">
                
                <a href="<?php echo base_url('reports/transaction_reports/print');?>"
                 onclick="javascript:void window.open('<?php echo base_url('reports/transaction_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;" 
                 class="btn btn-link btn-float has-text" style="color:#009900">
                <i class="glyphicon glyphicon-print"></i><span>Print</span></a>
                
                <a href="<?php echo base_url('reports/transaction');?>" class="btn btn-link btn-float has-text" style="color:#CC6600">
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
                                                            	<td height="44" colspan="3" align="center"><h4>Total's Report Summary</h4> </td>
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
                                                            </strong>   
                                                            </td>
                                                            <td width="53%">Total Revenue </td>
                                                          </tr>
                                                          	<tr>
                                                              <td width="43%" align="left" colspan="2"><strong>
																<?php
                                                                //echo $today;
                                                                $sqlf=$this->db->query("select sum(paid_amount) as totalf from orders ".$whereclusefee);
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
                                                              <td width="53%" align="left">Order Collect</td>
                                                          	</tr>
                                                            <tr>
                                                              <td width="43%" align="left" colspan="3">
                                                              <strong style="color:green"><?php echo 'Total: Tk '.$totalIncome.' /='; ?></strong>   
                                                                </td>
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
                                                            		$sql2=$this->db->query("select sum(amount) as total from expenses ".$wherecluse);
                                                                    if($sql2->num_rows() > 0)
                                                                    {
                                                                    foreach($sql2->result() as $row2);												
                                                                    $t_p_amount=$row2->total;
                                                                    echo 'TK '.number_format($t_p_amount,2,'.',',').' /=';
                                                                    }
                                                                    ?></strong>  </td>
                                                          </tr>
                                                            <?php
																if($totalIncome>=$t_p_amount){
																	$c='green';
																	$conl="Cash in Hands : ";
																	$profit=$totalIncome-$t_p_amount;
																}
																else{
																	$c='red';
																	$profit=$t_p_amount-$totalIncome;
																	$conl="Total loss : ";
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
                                                            
                                                            $queryCost=$this->db->query("select * from expenses ".$wherecluse);
                                                            foreach($queryCost->result() as $payrow){
															$debit=$payrow->debit;
															$master_heada=$payrow->master_head;
                                                            $costAmount=$payrow->amount;	
                                                            $received_by=$payrow->received_by;
                                                            $voucher=$payrow->voucher;
                                                            $amount_in_word=$payrow->amount_in_word;
                                                            $payment_date=$payrow->received_date;
															//$notesp=$payrow->remarks;
                                                            
                                                            
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
																		
																	    $queryIncome=$this->db->query("select * from revenue ".$wherecluse);
																		foreach($queryIncome->result() as $payrow){
																		$credit=$payrow->credit;
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
                                                                            <td align="center"><?php echo $credit; ?></td>
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
                                                    <div class="row">
                                                      <div class="col-md-12">
													  <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px; padding:10px">
													  Total Order Collection</div>
													  <table cellpadding="0" cellspacing="0" border="0" width="100%" 
                                                          class="table table-bordered datatable datatable-show-all" id="table_export">
                                                        <thead>
                                                            <tr>
                                                              <th width="1%">#</th>
                                                              <th width="8%">Order Number</th>
                                                              <th width="13%">Customer</th>
                                                              <th width="10%">Order Date/Time</th>
                                                              <th width="14%">Total Products</th>
                                                              <th width="14%">Order Amount</th>
                                                              <th width="9%">Shipping Charge</th>
                                                              <th width="7%">Total Amount</th>
                                                              <th width="10%">Paid Amount</th>
                                                              <th width="8%">Due Amount</th>
                                                              <th width="11%">Payment Status</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
															$count = 1;
															$tmount = 0;
															$tpaid = 0;
															$tdue = 0;
															$tship = 0;
															$tprice = 0;
															
															 $feeslist=$this->db->query("select * from orders ".$whereclusefee);
															foreach($feeslist->result() as $row):
																$order_number = $row->order_number;
																$customer_id = $row->customer_id;
																$order_time = $row->order_time;
																$amount = $row->amount;
																$shippingcharge = $row->shipping;
																$total_price = $row->total_price;
																$paid_amount = $row->paid_amount;
																$due_amount = $row->due_amount;
																$payment_status = $row->payment_status;
																
																$fgquery = $this->db->query("SELECT * FROM customer WHERE user_id='".$customer_id."'");
																if($fgquery->num_rows() > 0){
																	$fgr = $fgquery->row_array();
																	$username = $fgr['username'];
																}
																else{
																	$username = '';
																}
																
																$ftquery = $this->db->query("SELECT * FROM orders_products WHERE order_id='".$row->order_id."'");
																$totalProducts = $ftquery->num_rows();
																
																
															?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $order_number;?></td>
                                                                <td><?php echo $username;?></td>
                                                              	<td><?php echo $order_time;?></td>
                                                                <td><?php echo $totalProducts;?></td>
                                                                <td><?php echo $amount;?></td>
                                                                <td><?php echo $shippingcharge;?></td>
                                                                <td><?php echo $total_price.' TK';?></td>
                                                                <td><?php echo $paid_amount.' TK';?></td>
                                                                <td><?php echo $due_amount.' TK';?></td>
                                                                <td><?php echo $payment_status;?></td>                                                                
                                                            </tr>
                                                     		 
                                                            <?php 
															$tmount = $tmount + $amount;
															$tship = $tship + $shippingcharge;
															$tprice = $tprice + $total_price;
															$tpaid = $tpaid + $paid_amount;
															$tdue = $tdue + $due_amount;
															endforeach;?>
                                                            
                                                            
                                                        </tbody>
                                                        <tfoot>
                                                        	<tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                                                                                
                                                                <td><strong>Total</strong></td>
                                                                <td><strong><?php echo $tmount.' Tk';?></strong></td>
                                                                <td><strong><?php echo $tship.' Tk';?></strong></td>
                                                                <td><strong><?php echo $tprice.' Tk';?></strong></td>
                                                                <td><strong><?php echo $tpaid.' Tk';?></strong></td>
                                                                <td><strong><?php echo $tdue.' Tk';?></strong></td> 
                                                                <td></td>                                                      
                                                            </tr>
                                                        </tfoot>
                                                    </table>
													</div>
                                                    </div>
                                                    
													<div class="container" style="font-size:20px; border-top:1px solid #ccc; float:left; text-align:center; width:100%; margin-bottom:5px; padding:10px;">
													<?php
													$totalincomecount = $tpaid + $incomeCount;
													if($totalincomecount >= $costCount){
														$c='green';
														$con="Gross Amount as Balance : ";
														$loss=number_format($totalincomecount-$costCount,2,'.',',');
													}
													else{
														$c='red';
														$loss=number_format($costCount-$totalincomecount,2,'.',',');;
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


</div>
</div>          
</div>
