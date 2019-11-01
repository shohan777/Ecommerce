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
                                                              <td width="53%" height="30" align="right"><h5>Total Received </h5></td>
                                                              <td width="4%" align="center">:</td>
                                                              <td width="43%" align="left">
                                                            <h5><strong>
															<?php
															//echo $today;
                                                            $sql1=$this->db->query("select sum(amount) as total from revenue where received_date between '".$fromdate."' and '".$todate."' order by r_id asc");
                                                            if($sql1->num_rows() > 0)
                                                            {
                                                            foreach($sql1->result() as $row1);												
                                                            $t_r_amount=$row1->total;
                                                           	 	echo 'TK '.number_format($t_r_amount,2,'.',',').' /=';
                                                            }
                                                            ?>
                                                            </strong>   
                                                            </h5>                                                     </td>
                                                          </tr>
                                                            <tr>
                                                                <td height="31" align="right"><h5>Total Expenses</h5> </td>
                                                                <td height="31" align="center">:</td>
                                                              	<td align="left">
                                                                    <h5>
                                                                    <strong>
																	<?php
                                                            $sql2=$this->db->query("select sum(amount) as total from expenses where received_date between '".$fromdate."' and '".$todate."' order by r_id asc");
                                                                    if($sql2->num_rows() > 0)
                                                                    {
                                                                    foreach($sql2->result() as $row2);												
                                                                    $t_p_amount=$row2->total;
                                                                    echo 'TK '.number_format($t_p_amount,2,'.',',').' /=';
                                                                    }
                                                                    ?></strong>  </h5>                                                      </td>
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
                                                            
                                                            $queryCost=$this->db->query("select * from expenses where received_date between '".$fromdate."' and '".$todate."'");
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
													  <table cellpadding="0" cellspacing="0" border="0" width="100%" 
                                                          class="table table-bordered datatable datatable-show-all" id="table_export">
														
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
																		
																	    $queryIncome=$this->db->query("select * from revenue where received_date between '".$fromdate."' and '".$todate."'");
																		foreach($queryIncome->result() as $rowS){
																		$debit=$payrow->debit;
																		$incomeAmount=$payrow->amount;	
																		$received_by=$payrow->received_by;
																		$voucher=$payrow->voucher;
																		$amount_in_word=$payrow->amount_in_word;
																		$payment_date=$payrow->received_date;
																		
																		
																		$querypaymentfor=$this->db->query("select * from credit where clmh_id='".$debit."'");
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