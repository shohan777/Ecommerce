<table width="100%" class="ordertable">
                                            <tr bgcolor="#e5e5e5" class="trTitle">
                                              <td width="23" height="33" align="center">SI</td>
                                              <td width="63" align="center">Order </td>
                                              <td width="197" align="center">Order On</td>
                                              <td width="106" align="center">Invoice No</td>
                                              <td width="144" align="center">Product Code </td>
                                    		  <td width="756" align="center">
                                              <?php
												$sql = 'SELECT * FROM order_status WHERE type = ?';
												$stmt = $this->db->query($sql, 'in_stock');
												foreach ($stmt->result() as $row) {												
											?>
                      								<div style="width:7.6%; float:left; text-align:left; font-weight:bold"><?php echo $row->short_name;?></div>
                                             <?php } ?>                       
                                     		 </td>
                                    </tr>
											<?php
                                                $i=0;
											 if($datewisOrder!=0){
                                              foreach($datewisOrder->result() as $rowq){
                                              $order_id=$rowq->order_id;
                                              $order_number=$rowq->order_number;
                                              $order_time=$rowq->order_time;
                                              
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
                                  
                                          <tr class="trCont" bgcolor="<?php echo $c; ?>">
                                              <td height="44"><?php echo $i;?></td>
                                              <td align="left"><?php echo $order_number;?></td>
                                              <td align="left"><?php echo $order_time;?></td>
                                              <td align="left"><?php echo $inv_id;?></td>
                                              <td colspan="2">
                                                <table width="100%" align="center">
                                                        <?php 
                                                        $orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                                        foreach($orderProducts->result() as $ordPro){
                                                            $ordproid = $ordPro->product_id;
                                                            $ordQty = $ordPro->qty;
                                                            
                                                            $sql = "SELECT * FROM product WHERE product_id = ?";
                                                            $prodcutlist = $this->db->query($sql,$ordproid);
                                                            foreach($prodcutlist->result() as $pro);
                                                            
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
                                                        <td width="16%" align="center"><?php echo $pro->pro_code;?></td>
                                                        <td width="84%">  
                                                        <?php
                                                             $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
                                                            
                                                            $matcharray = array("return","miss_delivery","damage_delivery");
                                                            $sql = 'SELECT * FROM order_status WHERE type = ?';
                                                            $stmt = $this->db->query($sql, 'in_stock');
                                                            foreach ($stmt->result() as $row) {
                                                            
                                                            $finalSt = explode(',',$status);
                                                            if(in_array($row->name, $finalSt)){
                                                                $bgcolor = $row->color;
                                                                
                                                                if(in_array($row->access_name, $matcharray)){
                                                                    $actionname = 'A';
                                                                    $titleval = 'Change action for '.$row->name;
                                                                    $cursor =  'cursor:default';
                                                                    $font =  'changeText';
                                                                }
                                                                else{
                                                                    $actionname = '';
                                                                    $titleval = $row->name;
                                                                    $cursor =  'cursor:default';
                                                                    $font =  'noText';
                                                                }
                                                                
                                                                //$saction = 'onclick="loadContent('.$row->id.','.$ordproid.','.$order_time.','.$order_id.')"';	
                                                                $ordt = "'".$order_time."'";
                                                                $saction = '';															
                                                            }
                                                            else{
                                                                $bgcolor = $row->default_color;
                                                                $font =  'noText';
                                                                $cursor =  'cursor:default';
                                                                $actionname = $row->name;
                                                                $titleval = $row->name;
                                                                
                                                                if(($this->session->userdata('AdminType')!="Precident") && ($this->session->userdata('AdminType')!="CEO") && 
                                                                 ($this->session->userdata('AdminType')!="Country Manager")){
                                                                    
                                                                    if(in_array($row->access_name, $userAccess)){
                                                                        $saction = '';
                                                                    }
                                                                    else{
                                                                        $saction = '';
                                                                    }
                                                                }
                                                                else{
                                                                    $saction = '';
                                                                }
                                                            }
                                                        ?>
                                                    <div style="width:7.6%; float:left; cursor:default">
                                                         <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                         style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" <?php echo $saction; ?> 
                                                         value="<?php echo $actionname;?>" name="status" id="status<?php echo $row->id;?>">
                                                    </div>
                                                <?php } ?> 
                                                </td>
                                                    </tr>
                                                        <?php
                                                         }
                                                        ?>
                                                        
                                                    </table>
                                            </td>
                                        </tr>
                                        <?php
									 	 }
									  }
									  else{
									  	echo '<h2>No Data Found</h2>';
									  }
									  ?>
                                  </table>