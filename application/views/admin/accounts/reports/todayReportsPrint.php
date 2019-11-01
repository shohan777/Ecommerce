<?php $today=date('Y-m-d'); ?>
<style>
.tableDesign{
	border:1px solid #eaeaea;
	border-collapse:collapse;
}

.tableDesign tr{
	padding:10px;
}

.tableDesign tr td{
	padding:10px;
	font-size:16px;
	border-collapse:collapse;
}
</style>
<div class="content-wrapper" style="background:#fff">
                    <div style="width:100%; float:left">	
                                  	  		<div style="text-align:center; padding:5px 0">
                                            <img src="<?php echo base_url('asset/uploads/institute/'.$photo)?>" style="width:15%; height:auto" />
                                            <address style="font-size:13px; text-align:center">
                                                B-34/Ka (1st Floor), Shop No. 28  Khilkhet Super Market, Khilkhet, Dhaka-1229<br />
                                                Cell: +8801673628242, +8801941709999<br />
                                                E-mail: halim.helal@gmail.com, mhistudybd@gmail.com<br />
                                                Web: www.mhinternationalstudy.com
                                            </address>
                                            </div>
                                   </div>
                    <div class="clearfix"></div>
                    <div class="row">
    
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="container">
                                    
                                <div class="row">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                        <div class="container">
                                        	<table align="center" width="50%" border="1" cellpadding="0" cellspacing="0" class="tableDesign">
                                              				<tr><td height="28" colspan="3" align="center">Today's Report Summary</td>
                               				  </tr>
                                                            <tr>
                                                              <td width="53%" height="26" align="right">Total Received</td>
                                                              <td width="4%" align="center">:</td>
                                                              <td width="43%" align="left">
															<?php
															//echo $today;
                                                            $sql1=$this->db->query("select sum(amount) as total from revenue where received_date='".$today."' order by r_id asc");
                                                            if($sql1->num_rows() > 0)
                                                            {
                                                            foreach($sql1->result() as $row1);												
                                                            $t_r_amount=$row1->total;
                                                           	 	echo 'TK '.number_format($t_r_amount,2,'.',',').' /=';
                                                            }
                                                            ?></td>
                                                          </tr>
                                                            <tr>
                                                                <td height="28" align="right">Total Expenses </td>
                                                              <td align="center">:</td>
                                                       	  <td align="left">
																	<?php
                                                            $sql2=$this->db->query("select sum(amount) as total from expenses where received_date='".$today."' order by r_id asc");
                                                                    if($sql2->num_rows() > 0)
                                                                    {
                                                                    foreach($sql2->result() as $row2);												
                                                                    $t_p_amount=$row2->total;
                                                                    echo 'TK '.number_format($t_p_amount,2,'.',',').' /=';
                                                                    }
                                                                    ?>
                                                                    </td>
                                                          </tr>
                                                           <?php
                                                        if($t_r_amount>=$t_p_amount){
                                                            $c='green';
                                                            $conl="Cash in Hands : ";
                                                            $profit=$t_r_amount-$t_p_amount;
                                                        }
                                                        else{
                                                            $c='red';
                                                            $profit=$t_p_amount-$t_r_amount;
                                                            $conl="Today loss : ";
                                                            }
                                                    ?>
                                                
                                                            <tr style="color:<?php echo $c;?>">
                                                                <td align="right" class="flink"><?php echo $conl;?></td>
                                                              <td align="center" class="flink">:</td>
                                                            <td align="left"><?php echo 'TK '.number_format($profit,2,'.',',').' /=';?></td>
                                                          </tr>
                                                        </table>
                                        </div>
                                        
                                        
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; margin-bottom:5px; width:100%; padding:10px">
                                                          Total Expenses</div>
                                                          <table cellpadding="0" cellspacing="0" border="1" width="100%" class="tableDesign">
                                                            <tr bgcolor="#eaeaea">
                                                              <th width="1%" height="29"  align="center">SI</th>
                                                              <th width="10%" align="center">Debit</th>
                                                              <th width="12%" align="center"> Amount</th>
                                                              <th width="15%" align="center">Amount in word</th>
                                                              <th width="14%" align="center">Payment By</th>
                                                              <th width="11%" align="center"> Date</th>
                                                              <th width="8%" align="center">Vroucher</th>
                                                              <th width="29%" align="center">Notes</th>
                                                            </tr>
                                                            <?php
                                                            $i=0;
                                                            $costCount = 0;
                                                            
                                                            $queryCost=$this->db->query("select * from expenses where received_date='".$today."'");
                                                            foreach($queryCost->result() as $payrow){
                                                            $debit=$payrow->debit;
                                                            $costAmount=$payrow->amount;	
                                                            $received_by=$payrow->received_by;
                                                            $voucher=$payrow->voucher;
                                                            $amount_in_word=$payrow->amount_in_word;
                                                            $payment_date=$payrow->received_date;
															$notesp=$payrow->remarks;
                                                            
                                                            
                                                            $querypaymentfor=$this->db->query("select * from debit where camh_id='".$debit."'");
                                                            foreach($querypaymentfor->result() as $pfor);
                                                            
                                                            
                                                            $i++;
                                                            
                                                            ?>
                                                            
                                                            
                                                            <tr>
                                                                <td height="35" align="center"><?php echo $i;?></td>
                                                              <td align="center"><?php echo $pfor->title; ?></td>
                                                                <td align="center"><?php echo $costAmount; ?></td>
                                                                <td align="center"><?php echo $amount_in_word; ?></td>
                                                                <td align="center"><?php echo $cost_by; ?></td>
                                                                <td align="center"><?php echo $payment_date; ?></td>
                                                              <td align="center"><?php echo $voucher; ?></td>
                                                                <td align="center"><?php echo $notesp; ?></td>
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
													  <table cellpadding="0" cellspacing="0" border="1" width="100%" class="tableDesign">
														
																		<tr bgcolor="#eaeaea">
																		  <th width="2%" height="33"  align="center">SI</th>
                                                                          <th width="9%" align="center">Credit</th>
                                                                          <th width="11%" align="center"> Amount</th>
                                                                          <th width="17%" align="center">Amount in word</th>
                                                                          <th width="14%" align="center">Received By</th>
                                                                          <th width="10%" align="center"> Date</th>
                                                                          <th width="8%" align="center">Vroucher</th>
                                                                          <th width="29%" align="center">Notes</th>
													    </tr>
																		<?php
																		$j=0;
																		$incomeCount = 0;
																		
																	    $queryIncome=$this->db->query("select * from revenue where received_date='".$today."'");
																		foreach($queryIncome->result() as $rowS){
																		$debit=$payrow->debit;
																		$incomeAmount=$payrow->amount;	
																		$received_by=$payrow->received_by;
																		$voucher=$payrow->voucher;
																		$amount_in_word=$payrow->amount_in_word;
																		$payment_date=$payrow->received_date;
																		
																		
																		$querypaymentfor=$this->db->query("select * from credit where clmh_id='".$debit."'");
																		foreach($querypaymentfor->result() as $pfor);
																		
																		
																		$j++;
																		
																		?>
																		
																		
																		<tr>
																			<td height="34" align="center"><?php echo $j;?></td>
                                                                          <td align="center"><?php echo $pfor->title; ?></td>
                                                                            <td align="center"><?php echo $costAmount; ?></td>
                                                                            <td align="center"><?php echo $amount_in_word; ?></td>
                                                                            <td align="center"><?php echo $cost_by; ?></td>
                                                                            <td align="center"><?php echo $payment_date; ?></td>
                                                                            <td align="center"><?php echo $voucher; ?></td>
                                                                            <td align="center"><?php echo $voucher; ?></td>
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

                </div>
               