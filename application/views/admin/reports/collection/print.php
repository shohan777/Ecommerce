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

.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:2px 5px;
	color:#000;
}
.summTable .theadline td, th{
	padding:2px;
	color:#fff;
	background:#666;
}

		body {
	  background: rgb(204,204,204); 
	}
	page {
	  background: #fff;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  /*height: 29.7cm;*/ 
	  height:auto;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	 /* height: 21cm;  */
	 height:auto;
	}
	page[size="A3"] {
	  width: 29.7cm;
	  height: 42cm;
	}
	page[size="A3"][layout="portrait"] {
	  width: 42cm;
	  height: 29.7cm;  
	}
	page[size="A5"] {
	  width: 14.8cm;
	  height: 21cm;
	}
	page[size="A5"][layout="portrait"] {
	  width: 21cm;
	  height: 14.8cm;  
	}
	@media print {
	  body, page {
		margin: 0;
		box-shadow: 0;
	  }
	}
</style>
<page size="A4" layout="portrait">
    <div style="padding:1cm;">
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
    </div>
</page>             