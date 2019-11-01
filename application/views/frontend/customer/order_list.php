<style>
.customtable{
}
.customtable th{
	background:#666;
	color:#fff;
	text-align:center;
	font-size:13px;
}
.customtable td{
	color:#000;
	text-align:center;
	font-size:12px;
	font-weight:bold;
}
</style>
<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
	<div class="container" style="margin:20px auto;">
        <div class="col-sm-3">
            <?php include("leftSidebar.php");?>
        </div>
        <div class="col-sm-9" style="padding:0; margin:0"> 
            <a href="javascript:void(0)" onclick="history.back(-1)" style="padding:10px; width:100%; float:left; text-align:right"> &laquo;&laquo; Back</a>
            <table width="100%" cellpadding="2" cellspacing="1" class="customtable">
        
                              <tr>
                                <th width="37" height="36" align="center">SI</th>
                                <th width="119" align="center">Order </th>
                                <th width="184" align="center">Bill To</th>
                                <th width="169" align="center">Ship To</th>
                                <th width="234" align="center">Order On</th>
                                <th width="278" align="center">Status</th>
                                <th width="137" align="center">Total Price</th>
                                <th width="99" align="center">Details</th>
                                </tr>
                              <?php
                              $i=0;
                      foreach($userOrder->result() as $rowq){
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
                                <td height="44" align="center"><h6><?php echo $i;?></td>
                                <td><?php echo $order_number;?></td>
                                <td><?php echo $name;?></td>
                                <td><?php echo $names;?></td>
                                <td><?php echo $order_time;?></td>
                                <td><?php echo $status;?></td>
                                <td>TK&nbsp;<?php echo $total_price;?></td>
                                <td><a href="<?php echo base_url();?>profile/view_order/<?php echo $order_id;?>" 
                                style="padding:5px; font-size:12px; color:#006600; font-weight:bold"><i class="fa fa-eye"></i> View</a>
                                </td>
                                </tr>
                              <?php
                      }
                      ?>
                            </table>
        </div>
	</div>
 </div