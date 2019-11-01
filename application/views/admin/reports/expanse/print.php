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
            <div style="width:100%; float:left">	
               <div style="text-align:center; padding:5px 0">
                                    
                                   <h2><img src="<?php echo base_url('assets/images/logo.png');?>" style="width:90px; height:auto;text-align: center;" alt="MMK Group" title="MMK Group"></h2>
                                    </div>           	  		
            </div>
            <div class="clearfix"></div>
            <div class="row">
        
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            <div id="reportPrintDisplay">
                                	<div class="row">
                                                     	<div class="col-md-12">
                                                        <table class="table-striped" align="center" width="50%" border="0">
                                              				<tr>
                                                            	<td height="44" colspan="3" align="center"><h4>Today's Report Summary</h4> </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="53%" height="31" align="right">Total Expenses</td>
                                                                <td width="4%" height="31" align="center">:</td>
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
                                                          
                                                
                                                            <tr style="color:#CC0000">
                                                                <td height="34" align="right" class="flink">Total Expanse</td>
                                                                <td height="34" align="center" class="flink">:</td>
                                                                <td align="left"><strong>
                                                                <?php echo 'TK '.number_format($t_p_amount,2,'.',',').' /=';?>		
                                                                </strong>                                                    </td>
                                                          </tr>
                                                        </table>
                                                        </div>
                                                    </div>
                                  <div class="row">
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
                                                           // $debit=$payrow->debit;
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
                                        
                                        
                                        <div class="container" style="font-size:20px; border-top:1px solid #ccc; float:left; 
                                                    text-align:center; width:100%; margin-bottom:5px; padding:10px;">
													
												<strong style="color:#FF0000">
												<?php 
												if($costCount!="" || $costCount > 0){
													echo 'Total Expanse'.number_format($costCount,2,'.',',').' /='; 
												}
												?></strong>
                                                </div>                 
                                    </div>
                            
                            </div>
                        </div>
                </div>
            </div>
        
        </div>
            </div>
    </div>
</page>             