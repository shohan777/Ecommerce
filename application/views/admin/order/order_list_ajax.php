<table width="100%" cellpadding="2" cellspacing="1" class="table_round">
          
                                      <tr>
                                        <td width="37" height="36" align="center" bgcolor="#e5e5e5"class="table_header"><span class="style2">SI</span></td>
                                        <td width="119" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order </span></td>
                                        <td width="184" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Bill To</span></td>
                                        <td width="169" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Ship To</span></td>
                                        <td width="234" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order On</span></td>
                                        <td width="278" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Status</span></td>
                                        <td width="137" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Total Price</span></td>
                                        <td width="99" align="center" bgcolor="#e5e5e5" class="table_header">&nbsp;</td>
                                        </tr>
                                      <?php
                                      $i=0;
                              foreach($orderinfo->result() as $rowq){
                              $order_id=$rowq->order_id;
                              $order_number=$rowq->order_number;
                              $order_time=$rowq->order_time;
                              $customer_id=$rowq->customer_id;
                              $status=$rowq->status;
                              $total_price=$rowq->total_price;
                              
                              $customerQ=$this->db->query("select * from customer where user_id='$customer_id'");
                              if($customerQ->num_rows()>0){
                                  $rowCCount=$customerQ->result();
                                  foreach($rowCCount as $rowc);
                                  $check_id=$rowc->user_id;
                                  $name=$rowc->username;
                              }
                              else{
                                  $check_id='';
                                  $name='';
                              }
                              $shipping=$this->db->query("select * from shiping_info where userid='$customer_id'");
                              if($shipping->num_rows() > 0){
                                  $rowSCount=$shipping->result();
                                  foreach($rowSCount as $rows);
                                  $shipping_id=$rows->id;
                                  $names=$rows->fname.' '.$rows->lname;
                              }
                              else{
                                $shipping_id='';
                                $names='';
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
                                     <tr class="table_hover" bgcolor="<?php echo $c; ?>" >
                                        <td height="44" align="center"><h6><?php echo $i;?></h6></td>
                                        <td align="left" class="section"><h6><?php echo $order_number;?></h6></td>
                                        <td align="left" class="section"><h6><?php echo $name;?></h6></td>
                                        <td align="center" class="section"><h6><?php echo $names;?></h6></td>
                                        <td align="left" class="section"><h6><?php echo $order_time;?></h6></td>
                                        <td align="center" valign="middle" class="section">
                                      		<select name="status" id="status<?php echo $order_id;?>" class="form-control" style="width:60%; float:left; margin:3px;">
                                                <option value="<?php echo $status;?>"><?php echo $status;?></option>
                                                <option value="Processing">Processing</option>
                                                <option value="Shipped">Shipped</option>
                                                <option value="On Hold">On Hold</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                    		<a onclick="update_status(<?php echo $order_id;?>);" class="btn btn-primary" title="Save Order Status"
                                            style="padding:0 5px; margin-top:5px; font-size:12px;">Save</a>
                                        </td>
                                        <td align="center" class="section"><h6>TK&nbsp;<?php echo $total_price;?></h6></td>
                                        <td align="left" class="section">
                                            <a href="<?php echo base_url();?>administration/view_order/<?php echo $order_id;?>" class="btn btn-success"  title="View Order Details"
                                            style="padding:0 5px; font-size:12px;"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void();" onclick="orderDelete('<?php echo $order_id;?>');" 
                                            class="btn btn-danger"  title="Delete Order" style="padding:0 5px; font-size:12px;"><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>
                                      <?php
                              }
                              ?>
                                    </table>