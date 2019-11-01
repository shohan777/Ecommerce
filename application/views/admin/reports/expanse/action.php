
<div class="right_col" role="main">

<!-- Page header -->
<div class="page-header">
    

    <div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
        <ul class="breadcrumb" style="font-size:20px;margin-left:20px;">
                <li>Transaction Reports</li>
        </ul>

        <ul class="breadcrumb-elements">
            <div class="heading-btn-group">
                
                <a href="<?php echo base_url('reports/expanse_reports/print');?>"
                 onclick="javascript:void window.open('<?php echo base_url('reports/expanse_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;" 
                 class="btn btn-link btn-float has-text" style="color:#009900">
                <i class="glyphicon glyphicon-print"></i><span>Print</span></a>
                
                <a href="<?php echo base_url('reports/expanse');?>" class="btn btn-link btn-float has-text" style="color:#CC6600">
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
													echo 'Total Expanse '.number_format($costCount,2,'.',',').' /='; 
												}
												?></strong>
                                                </div>                 
                                                </div>
                                                
                                            </div>
                                        </div>
					 			  </div>
                               <?php echo form_close();?>
					</div>


</div>
</div>          
</div>
