<?php //echo $datewisOrder->num_rows();?>
<table class="table datatable-show-all ordertable" width="100%">
                                    <tr bgcolor="#010101" class="trTitle">
                                      <td width="35" height="33" align="center"><div class="order_title1">SI</div></td>
                                      <td width="68" align="center"><div class="order_title1">Order </div></td>
                                      <td width="96" align="center"><div class="order_title1">Order On</div></td>
                                      <!--<td width="91" align="center"><div class="order_title1">Supplier</div></td>-->
                                      <td width="57" align="center"><div class="order_title1"> Code </div></td>
       	    				    	  <td width="874" align="center">
                           	   			
										   <?php
                                            $sql = 'SELECT * FROM order_status WHERE type = ? ORDER BY sequence ASC';
                                            $stmt = $this->db->query($sql, 'in_stock');
                                            foreach ($stmt->result() as $row) {												
                                        	?>
                                          	 <div class="order_title"><?php echo $row->name;?></div>
                          				   <?php } ?>                       
                                      </td>
                                     <!-- <td width="10" align="center">Closed</td>-->
                                      <td width="64" align="center"><div class="order_title1">Close</div></td>
                                    </tr>
                                    <?php
										$i=0;
									  if($totalrecords > 0){
										  foreach($datewisOrder->result() as $rowq){
										  $order_id=$rowq->order_id;
										  $order_number=$rowq->order_number;
										  $order_status=$rowq->status;
										  $order_time=$rowq->order_time;
														  
											if($i%2!=0)
											{
											$c="#f5f5f5";
											}
											else
											{
											$c="#FFFFFF";
											}
											
											if($order_status=='Closed'){
												$bgclose = '#19a15f';	
												$closetitle = 'Order Closed';
												$rowbg = '#aaaaaa';
												$opacity = 'style="opacity:0.5"';
												$rowtitle = 'Order Closed';		 
											}
											else{
												$bgclose = '#7A7A7A';
												$closetitle = 'Close Order';
												$rowbg = $c;	
												$opacity = 'style="opacity:1"';
												$rowtitle = '';
												$closesection ='';
											}
											$i++;
										?>
									  
										  <tr class="trCont" bgcolor="<?php echo $rowbg; ?>" <?php echo $opacity;?> title="<?php echo $rowtitle;?>">
										  <td height="44"><div class="order_title1"><?php echo $i;?></div></td>
										  <td align="left"><div class="order_title1"><?php echo $order_number;?></div></td>
										  <td align="left"><div class="order_title1"><?php echo $order_time;?></div></td>
										  <td colspan="2" style="padding:0; margin:0">
												<table width="100%" align="center">
														<?php 
														$orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
														foreach($orderProducts->result() as $ordPro){
															$ordproid = $ordPro->product_id;
															$ordQty = $ordPro->qty;
															
															$sql = "SELECT * FROM product WHERE product_id = ?";
															$prodcutlist = $this->db->query($sql,$ordproid);
															foreach($prodcutlist->result() as $pro);
															
															if($pro->supplier!=""){
															 $sql = "SELECT * FROM supplier WHERE user_id = ?";
															 $supllierquer = $this->db->query($sql,$pro->supplier);
															 $suplier = $supllierquer->row_array();
															 $supname = $suplier['username'];
															}
															else{
																$supname = '';
															}
															
															$sqlu = "SELECT * FROM stock_order_product_status WHERE order_id = ? AND product_id = ?";
															$orderstatusd = $this->db->query($sqlu,array($order_id,$ordproid));
															if($orderstatusd->num_rows() > 0){
																foreach($orderstatusd->result() as $ords);
																$status=$ords->status;
															}
															else{
																$status='Pending';
															}
														?>
														<tr>
															<!--<td width="10%" align="center"><div class="order_title1"><?php echo $supname;?></div></td>-->
															<td width="9%" align="center"><div class="order_title"><?php echo $pro->pro_code;?></div></td>
															
															<td width="81%">  
															<?php
																 $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
																
																$matcharray = array("return","miss_delivery","damage_delivery");
																$sql = 'SELECT * FROM order_status WHERE type = ?  ORDER BY sequence ASC';
																$stmt = $this->db->query($sql, 'in_stock');
																foreach ($stmt->result() as $row) {
																$statusTypeId = $row->id;
																
																$finalSt = explode(',',$status);
																if(in_array($row->name, $finalSt)){
																	$bgcolor = $row->color;
																	
																	if(in_array($row->access_name, $matcharray)){
																		$actionname = $row->name;
																		$titleval = 'Change action for '.$row->name;
																		$cursor =  'cursor:pointer';
																		$font =  'noText';
																	}
																	else{
																		$actionname = $row->name;
																		$titleval = $row->name;
																		$cursor =  'cursor:default';
																		$font =  'noText';
																	}
																	
																	//$saction = 'onclick="loadContent('.$statusTypeId.','.$ordproid.','.$order_time.','.$order_id.')"';	
																	$ordt = "'".$order_time."'";
																	
																	if($order_status=='Closed'){
																		$clssect = '';
																	}
																	else{
																		 $clssect = 'onclick="loadContent('.$statusTypeId.','.$order_id.','.$ordproid.','.$ordt.','.$ordQty.')"';
																	}										
																	$saction = $clssect;
																	?>
																	<div class="order_title">
																		 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
																		 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" <?php echo $saction; ?> 
																		 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
																	</div>
																	<?php													
																}
																else{
																	$bgcolor = $row->default_color;
																	$font =  'noText';
																	$cursor =  'cursor:pointer';
																	$actionname = $row->name;
																	$titleval = $row->name;
																	
																	if(($this->session->userdata('AdminType')!="Precident") && ($this->session->userdata('AdminType')!="CEO") && 
																	 ($this->session->userdata('AdminType')!="Country Manager")){
																		
																		if(in_array($row->access_name, $userAccess)){
																			if($order_status=='Closed'){
																				?>
																				<div class="order_title">
																					 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
																					 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" 
																					 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
																				</div>
																				<?php
																			}
																			else{
																				 ?>
																				<div class="order_title">
																				 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
																				 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;"
																				 onclick="updateOrdeStatus(<?php echo $statusTypeId.','.$ordproid.','.$ordQty.','.$order_id;?>)" 
																				 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
																			</div>
																				<?php	
																			}										
																		}
																		else{
																		   ?>
																			<div class="order_title">
																				 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
																				 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" 
																				 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
																			</div>
																		<?php	
																		}
																		
																	}
																	else{
																		if($order_status=='Closed'){
																			?>
																			<div class="order_title">
																				 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
																				 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;"
																				 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
																			</div>
																			<?php
																		}
																		else{
																			?>
																			<div class="order_title">
																				 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
																				 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;"
																				 onclick="updateOrdeStatus(<?php echo $statusTypeId.','.$ordproid.','.$ordQty.','.$order_id;?>)" 
																				 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
																			</div>
																			<?php
																		}										
																	}
																}
													?>
														<!--<div class="order_title">
														 <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
														 style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" <?php echo $saction; ?> 
														 value="<?php echo $actionname;?>" name="status" id="status<?php echo $statusTypeId;?>">
													</div>-->
													<?php } ?> 
													</td>
														</tr>
														<?php
														 }
														?>
													</table>
											</td>
										  
											<td align="left" style="padding:5px 0; margin:5px 0">
											<div class="order_title1">
											 <input type="button" class="noText closed_action" title="Closed Order" value="Closed" name="closedstatus" id="closedstatus" 
											 style="background:<?php echo $bgclose;?>;" onclick="updateClosedOrder(<?php echo $order_id;?>);">
											 
											<a href="<?php echo base_url();?>administration/view_order/<?php echo $order_id;?>" title="View Order Details" 
											class="btn btn-primary order_view_action"><i class="fa fa-eye"></i></a>
										  </div>
										   </td>
										</tr>
										<?php
										  }
										}
										  ?>
                                  </table>