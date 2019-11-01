<table width="100%" class="ordertable">
                                            <tr bgcolor="#e5e5e5" class="trTitle">
                                              <td width="43" height="33" align="center">SI</td>
                                              <td width="62" align="center">Order </td>
                                              <td width="146" align="center">Order On</td>
                                              <td width="62" align="center">Invoice</td>
                                              <td width="754" align="center">
                 								 <table width="100%" align="center" cellpadding="0" cellspacing="0">
                                                    <tr style="font-size:10px;">
                                                      <td align="center">P.Code </td>
                                                      <td align="center">China.UC</td>
                                                      <td align="center">IUC</td>
                                                      <td align="center">PUC</td>
                                                      <td align="center">Photo.UC</td>
                                                      <td align="center">SUC</td>
                                                      <td align="center">DUC</td>
                                                      <td align="center">CHUC</td>
                                                      <td align="center">OUC</td>
                                                      <td align="center">PRUC</td>
                                                      <td align="center">CUC</td>  
                                                  </tr>
                                                </table>
                                              </td>
                                              <td width="71" align="center">Total</td>
                                              <td width="79" align="center">Paid</td>
                                              <td width="64" align="center">Due</td>
                                    	</tr>
											<?php
											  $i=0;
                                              foreach($datewisOrder->result() as $rowq){
                                              $order_id=$rowq->order_id;
                                              $order_number=$rowq->order_number;
                                              $order_time=$rowq->order_time;
											  $total_price=$rowq->total_price;
											  $paid_amount=$rowq->paid_amount;
											  $due_amount=$rowq->due_amount;
                                              
											   $invoicequery=$this->Index_model->getItemBetween('invoice','order_id',$order_id,'date',$fromdate,$todate,'order_id','desc');
											  if($invoicequery->num_rows() > 0){
												  foreach($invoicequery->result() as $inv);
												  $inv_id=$inv->inv_id;
											  }
											  else{
											  	$inv_id=0;
											  }
											                                  
                                                if($i%2!=0)
                                                {
                                                $c="#f5f5f5";
                                                }
                                                else
                                                {
                                                $c="#FFFFFF";
                                                }
                                                $i++;
                                            ?>
                                  
                                      <tr class="trCont" bgcolor="<?php echo $c; ?>" style="font-size:12px;">
                                          <td height="44"><?php echo $i;?></td>
                                          <td align="left"><?php echo $order_number;?></td>
                                          <td align="left"><?php echo $order_time;?></td>
                                           <td align="left"><?php echo $inv_id;?></td>
                                    	  <td align="center">
                                        	<table width="100%" align="center" cellpadding="0" cellspacing="0">
													<?php 
													$orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                                    foreach($orderProducts->result() as $ordPro){
														$ordproid = $ordPro->product_id;
                                                        $sql = "SELECT * FROM product WHERE product_id = ?";
                                                        $prodcutlist = $this->db->query($sql,$ordproid);
                                                        foreach($prodcutlist->result() as $pro);
														
														$sqlpp = "SELECT * FROM product_price WHERE product_id = ?";
                                                        $propriceq = $this->db->query($sqlpp,$ordproid);
                                                        foreach($propriceq->result() as $pprow);
														
														
                                                    ?>
                                                    <tr>
                                                    	<td align="center"><?php echo $pro->pro_code;?></td>                                                         
                                                        <td align="center"><?php echo $pprow->china_unit_cost;?></td> 
                                                        <td align="center"><?php echo $pprow->import_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->packing_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->photography_unit_cost;?></td> 
                                                        <td align="center"><?php echo $pprow->sda_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->delivery_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->cashhandle_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->officeexp_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->profit_unit_cost;?></td>  
                                                        <td align="center"><?php echo $pprow->customer_unit_cost;?></td>  
                                                  </tr>
                                                    <?php
                                                     }
                                                    ?>
                                                    
                                                </table>
                                        </td>
                                         <td align="center"><strong style="color:#C0B418"><?php echo $total_price;?></strong></td>
                                         <td align="center"><strong style="color:#009900"><?php echo $paid_amount;?></strong></td>
                                         <td align="center"><strong style="color:#FF0000"><?php echo $due_amount;?></strong></td>
                                    </tr>
                                    <?php
									  }
									  ?>
                                  </table>