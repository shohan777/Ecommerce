<script>
window.onload=window.print();
</script>
<style>
.tableDesign{
	border:1px solid #ccc;
	border-collapse:collapse;
}

.tableDesign tr{
	padding:5px;
}

.tableDesign tr td{
	padding:5px;
	font-size:16px;
}
</style>
    <div style="width:800px; height:auto; margin:0 auto;">
                             
                                <div class="x_content">
                                   <table width="100%">
                                   		<thead>
                                        	<tr>
                                              <th width="10%" valign="top" colspan="1"><h5 style="font-size:11px; padding:0; margin:0">Customer Copy</h5></th>
                                              <th colspan="4">
                                                <div style="text-align:center; padding:5px 0; width:100%;">
                                                
                                                <?php if($photo!=""){
                                                ?>
                                                <img src="<?php echo base_url('asset/uploads/institute/'.$photo)?>" style="width:10%; height:auto" />
                                                <?php
                                                }
                                                else{
                                                ?>
                                                <img src="<?php echo base_url('assets/images/logo.png')?>" style="width:10%; height:auto" />
                                                <?php
                                                }
                                                ?>
                                                <address style="font-size:13px; text-align:center">
                                                <?php echo strip_tags($address, '<br>');?><br />
                                                    Cell: 	<?php echo $contact;?><br />
                                                    E-mail: <?php echo $email;?><br />
                                                    Web: 	<?php echo $website;?>
                                                </address>
                                                </div>
                                              </th>
                                          </tr>
                                        </thead>
                                   		<tbody>
                                           <tr>
                                              <td colspan="5" style="padding:5px">Voucher No: </td>
                                           </tr>
                                        	<tr>
                                              <td colspan="5">
                                              	<table width="100%" class="tableDesign" border="1">
                                                    <tr bgcolor="#cccccc" style="font-weight:bold">
                                                          <td width="24%" height="31">Receiver</td>
                                                          <td width="22%">Account</td>
                                                          <td width="36%">Head</td>
                                                          <td width="18%">Total Amounts</td>
                                                      </tr>
                                                        <tr>
                                                          <td width="24%" height="31"><?php echo $received_by;?></td>
                                                          <td width="22%"><?php echo $asset;?></td>
                                                          <td width="36%"><?php echo $master_head.' / '.$sub_head;?></td>
                                                          <td width="18%"><?php echo number_format($amount,'2','.','').'/= Taka';?></td>
                                                      </tr>
                                                </table>
                                              </td>
                                                                                            
                                           </tr>
                                        </tbody>
                                        <tfoot>
                                        	<tr>
                                              <td colspan="5">&nbsp;</td>
                                           </tr>
                                           <tr>
                                              <td colspan="5">&nbsp;</td>
                                           </tr>
                                           <tr>
                                              <td height="31" colspan="2" align="left">
                                              	<div style="border-top:1px solid #ccc; border-right:none;">
                                                    <h5 style="font-size:13px; padding:3px; margin:0; color:#333; font-family:Arial, Helvetica, sans-serif">
                                                    Depositor's Signature<br />
                                                    <br /><?php echo date('l, d F, Y',strtotime($received_date));?></h5>
                                                </div>
                                              </td>
                                              <td width="46%" colspan="1">&nbsp;</td>
                                              <td width="26%" colspan="2" align="right">
                                              	<div style="border-top:1px solid #ccc; border-right:none;">
                                                    <h5 style="font-size:13px; padding:3px; margin:0; color:#333; font-family:Arial, Helvetica, sans-serif">
                                                    Recipient Signature<br />
                                                    <br /><?php echo date('l, d F, Y',strtotime($received_date));?></h5>
                                                </div>
                                              </td>
                                          </tr>
                                        </tfoot>
                                   </table>
                                </div>
                               
                                   
                               <div style="border-bottom:1px dashed #999; width:100%; float:left; height:30px; margin-bottom:40px;">&nbsp;</div>
                                
                                
                                <div class="x_content">
                                   <table width="100%">
                                   		<thead>
                                        	<tr>
                                              <th width="10%" valign="top" colspan="1"><h5 style="font-size:11px; padding:0; margin:0">Office Copy</h5></th>
                                              <th colspan="4">
                                                <div style="text-align:center; padding:5px 0; width:100%;">
                                                
                                                <?php if($photo!=""){
                                                ?>
                                                <img src="<?php echo base_url('asset/uploads/institute/'.$photo)?>" style="width:10%; height:auto" />
                                                <?php
                                                }
                                                else{
                                                ?>
                                                <img src="<?php echo base_url('assets/images/logo.png')?>" style="width:10%; height:auto" />
                                                <?php
                                                }
                                                ?>
                                                <address style="font-size:13px; text-align:center">
                                                <?php echo strip_tags($address, '<br>');?><br />
                                                    Cell: 	<?php echo $contact;?><br />
                                                    E-mail: <?php echo $email;?><br />
                                                    Web: 	<?php echo $website;?>
                                                </address>
                                                </div>
                                              </th>
                                          </tr>
                                        </thead>
                                   		<tbody>
                                           <tr>
                                              <td colspan="5" style="padding:5px">Voucher No: </td>
                                           </tr>
                                        	<tr>
                                              <td colspan="5">
                                              	<table width="100%" class="tableDesign" border="1">
                                                    <tr bgcolor="#cccccc" style="font-weight:bold">
                                                          <td width="24%" height="31">Receiver</td>
                                                          <td width="22%">Account</td>
                                                          <td width="36%">Head</td>
                                                          <td width="18%">Total Amounts</td>
                                                      </tr>
                                                        <tr>
                                                          <td width="24%" height="31"><?php echo $received_by;?></td>
                                                          <td width="22%"><?php echo $asset;?></td>
                                                          <td width="36%"><?php echo $master_head.' / '.$sub_head;?></td>
                                                          <td width="18%"><?php echo number_format($amount,'2','.','').'/= Taka';?></td>
                                                      </tr>
                                                </table>
                                              </td>
                                                                                            
                                           </tr>
                                        </tbody>
                                        <tfoot>
                                        	<tr>
                                              <td colspan="5">&nbsp;</td>
                                           </tr>
                                           <tr>
                                              <td colspan="5">&nbsp;</td>
                                           </tr>
                                           <tr>
                                              <td height="31" colspan="2" align="left">
                                              	<div style="border-top:1px solid #ccc; border-right:none;">
                                                    <h5 style="font-size:13px; padding:3px; margin:0; color:#333; font-family:Arial, Helvetica, sans-serif">
                                                    Depositor's Signature<br />
                                                    <br /><?php echo date('l, d F, Y',strtotime($received_date));?></h5>
                                                </div>
                                              </td>
                                              <td width="46%" colspan="1">&nbsp;</td>
                                              <td width="26%" colspan="2" align="right">
                                              	<div style="border-top:1px solid #ccc; border-right:none;">
                                                    <h5 style="font-size:13px; padding:3px; margin:0; color:#333; font-family:Arial, Helvetica, sans-serif">
                                                    Recipient Signature<br />
                                                    <br /><?php echo date('l, d F, Y',strtotime($received_date));?></h5>
                                                </div>
                                              </td>
                                          </tr>
                                        </tfoot>
                                   </table>
                                </div>
                                









                        </div>
