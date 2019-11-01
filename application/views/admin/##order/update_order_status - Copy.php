
<div class="white_content" style="text-align:center">
      <table width="100%" border="0" cellspacing="2" cellpadding="3"  align="center">
          <tr>
            <td height="52" align="left" valign="top">
                <a href ="javascript:void(0)" title="Close" onclick ="closeButton()" id="popclose"><i class="fa fa-close"></i></a> </td>
                <td colspan="2" valign="bottom"><h2>Status:  <?php echo $ord_status;?></h2></td>
              </tr>
          
          <tr>
            <td height="15" colspan="3"></td>
          </tr>
           <tr>
            <td colspan="3" align="center">
            	<table width="50%" align="center">
                	<tr>
                        <td width="40%"><h3><input type="radio" value="full_order" name="retType" id="retType" style="padding:10px; width:20px; height:20px;" 
                         onclick="orderListDispl('full');"/> Full Order</h3></td>
                        <td width="10%"></td>
                        <td width="40%"><h3><input type="radio" value="part_order" name="retType" id="retType" style="padding:10px; width:20px; height:20px;" 
                        onclick="orderListDispl('partial');"/> Partial Order</h3></td>
                      </tr>
                </table>
            </td>
          </tr>
          
          
          
           <tr>
            <td colspan="3" align="center">
            	<div  id="productList" style="display:none">
            		<table width="80%" align="center" border="1" bordercolor="#ccc" style="border-collapse:collapse; font-size:15px; padding:10px;">
                	<?php 
					foreach($orderProducts->result() as $ordPro){
						$sql = "SELECT * FROM product WHERE product_id = ?";
						$prodcutlist = $this->db->query($sql,$ordPro->product_id);
						foreach($prodcutlist->result() as $pro);
					?>
                	<tr>
                      <td width="3%" style="padding:7px;">
                      <input type="checkbox" value="<?php echo $ordPro->product_id;?>" name="product_id" style="padding:10; width:15px; height:15px;" onclick="checkProdId();" />
                      </td>
                      <td width="48%" style="padding:7px;"><?php echo $pro->product_name;?></td>
                      <td width="20%" style="padding:7px;"><?php echo $pro->pro_code;?></td>
                      <td width="13%" style="padding:7px;"><?php echo $ordPro->qty;?></td>
                      <td width="16%" style="padding:7px;"><?php echo $ordPro->unit_price;?></td>
                  </tr>
				 	<?php
                     }
                    ?>
                    
                    <tr>
                    	<td colspan="5"><textarea name="remarks" id="remarksval" class="form-control" placeholder="Remarks" style="margin-top:10px;"></textarea></td>
                    </tr>
                </table>
                </div>
            </td>
          </tr>
          
          <tr>
            <td valign="top" colspan="3">
            	<input type="hidden" name="product_id" id="returnProduct" />
                <input type="hidden" name="returnType" id="returnType" />
                <input type="hidden" name="oid" id="oid" value="<?php echo $orderid;?>" />
                <input type="hidden" name="status" id="status"  value="<?php echo $ord_status;?>"/>

                <span id="loaderHide"><button type="button" onclick="updateOrdeStatus();" class="btn btn-success btn-submit">Submit</button></span>
                <span id="LoadingImage" style="display:none;"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>
            </td>
          </tr>
        </table>
</div>


<div id="fade" class="black_overlay"></div>        
<div id="orderlight" class="historyContent"></div>
