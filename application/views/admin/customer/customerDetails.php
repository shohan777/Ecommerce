<?php
if($customerDetails->num_rows()>0){
	foreach($customerDetails->result() as $customer);
			$customerId=$customer->user_id;
			$fname=$customer->fname;
			$lname=$customer->lname;
			$company=$customer->company;
			$mobile=$customer->mobile;
			$email=$customer->email;
			$gender=$customer->gender;
			$address=$customer->address;
			$zipcode=$customer->zipcode;
			$country=$customer->country;
			$city=$customer->city;
			$street=$customer->thana;
			$password=$customer->password;
			$passwordHints=$customer->passwordHints;
			$photo=$customer->photo;
}
else{
			$customerId='';
			$fname= set_value('fname');
			$lname= set_value('lname');
			$company= set_value('company');
			$mobile=set_value('mobile');
			$email=set_value('email');
			$gender=set_value('gender');
			$address=set_value('address');
			$zipcode= set_value('postcode');
			$country= set_value('country');
			$city=set_value('city');
			$street=set_value('street');
			$password=set_value('password');
			$passwordHints=set_value('password');
			$photo='';
	}
?>
<script>
function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
		document.getElementById("showhideicon").innerHTML = "<i class='fa fa-eye-slash'></i>";
		x.value = "<?php echo $passwordHints;?>";
    } else {
        x.type = "password";
		document.getElementById("showhideicon").innerHTML = "<i class='fa fa-eye'></i>";
		x.value = "<?php echo $password;?>";
    }
}
</script>

<style>
	.customtable{
	
	}
	
	.customtable td{
		padding:5px;
	}
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

<div class="right_col" role="main">

                    
                    <div class="clearfix"></div>
                    <div class="row">


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                    <div class="col-sm-12">   
                                    	<h2 style="font-size:18px; font-weight:bold">Details for <?php echo $fname.' '.$lname;?></h2>
                                        <div class="col-sm-6">			                        
                           					<table class="table-bordered customtable" width="100%">
                                          <tr>
                                            	<td width="29%" height="37"><strong>First Name</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $fname;?></td>
                                          </tr>
                                            <tr>
                                            	<td width="29%" height="37"><strong>Last Name</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $lname;?></td>
                                          </tr>
                                          <tr>
                                            	<td width="29%" height="37"><strong>Company Name</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $company;?></td>
                                          </tr>
                                            <tr>
                                            	<td width="29%" height="37"><strong>Mobile</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $mobile;?></td>
                                          </tr>
                                          <tr>
                                            	<td width="29%" height="37"><strong>Email</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $email;?></td>
                                          </tr>
                                           <tr>
                                            	<td width="29%" height="37"><strong>Password</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%">
											  <div  class="col-sm-11" style="padding:0; margin:0">
                                                    	<input type="password" required value="<?php echo $password;?>" 
                                                     style="border:none; background:none" id="password" placeholder="Password"  name="password">
                                                    </div>
                                                    <div  class="col-sm-1">
                                                    <a href="javascript:void()" onclick="showPassword()" style="font-size:18px;" id="showhideicon"><i class="fa fa-eye"></i> </a>
                                                    </div>
                                             </td>
                                          </tr>
                                           
                                          </tr>
                                        </table>
                                        </div>
                                        <div class="col-sm-6">			                        
                           					<table class="table-bordered customtable" width="100%">
                                          
                                            <tr>
                                            	<td width="29%" height="37"><strong>Country</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $country;?></td>
                                          </tr>
                                          <tr>
                                            	<td width="29%" height="37"><strong>City</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $city;?></td>
                                          </tr>
                                           <tr>
                                            	<td width="29%" height="37"><strong>Street</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $street;?></td>
                                          </tr>
                                          <tr>
                                            	<td width="29%" height="37"><strong>Zip Code</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $zipcode;?></td>
                                          </tr>
                                           <tr>
                                            	<td width="29%" height="37"><strong>Address</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                                <td width="68%"><?php echo $address;?></td>
                                          </tr>
                             			  
                                            <tr>
                                            	<td width="29%" height="37"><strong>Photo</strong></td>
                                                <td width="3%" align="center"><strong>:</strong></td>
                                               <td width="68%">
											   	<?php
                                                    if($photo!=""){
                                                        echo '<img src="'.base_url('uploads/images/customer/'.$photo).'" style="width:100px; height:auto" />';
                                                    }
                                                ?>                                               </td>
                                          </tr>
                                        </table>
                                        </div>
                                	</div> 
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    	<fieldset style="margin:10px">
                                        <legend style="margin:5px; padding:2px;">Order List</legend>
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
                                <td><a href="<?php echo base_url();?>administration/view_order/<?php echo $order_id;?>" 
                                style="padding:5px; font-size:12px; color:#006600; font-weight:bold"><i class="fa fa-eye"></i> View</a>
                                </td>
                                </tr>
                              <?php
                      }
                      ?>
                            </table>
			                            </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               