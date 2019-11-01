<table class="table table-striped" width="100%">
    <tr bgcolor="#ccc">
      <th width="23%" height="34" align="left">Product Name</th>
      <th width="13%" height="34" align="left">Product Code</th>
      <th width="15%" align="center">Product Category</th>
       <th width="13%" align="left">Quantity</th>
      <th width="16%" colspan="2" align="right"> Total Stock</th>
       <th width="19%" align="center">Action</th>
    </tr>
    <?php
    $i=0;
    $costCount = 0;
    $total =0;
    foreach($stockreport->result() as $payrow){
      
      $productquery=$this->db->query("select * from product where product_id='".$payrow->pro_id."' order by product_id asc");
      if($productquery->num_rows() > 0){
        foreach($productquery->result() as $pro);
        $StPname = $pro->product_name;
        $StPcode = $pro->pro_code;
        $StPqty = $pro->qty;
		$cat_id=$pro->cat_id;
      }
      else{
        $StPname = '';
        $StPcode = '';
        $StPqty = '';
		$cat_id = '';
      }
      

		$catquery=$this->Index_model->getAllItemTable('category','caegory_title',$cat_id,'','','cid','desc');
		if($catquery->num_rows() > 0){
			foreach($catquery->result() as $cat_row);
			$cateName=$cat_row->cat_name;
		}
		else{
			$cateName='NULL';
			}
		
                                                          
    if($i%2==0){
        $clr='#fff';
    }
    else{
        $clr='#eaeaea';
    }
    $i++;
    
	$stock=$this->db->query("SELECT sum(pro_qty) as qty FROM stock WHERE pro_id='".$payrow->pro_id."'");
	if($stock->num_rows() > 0){
		$drwos = $stock->row();
		$stockQty = $drwos->qty;
		$total = $total +$drwos->qty;
	}
	else{
		$total=0;
		$stockQty=0;
	}
	//echo $stockQty;
	
	if($stockQty!='' || $stockQty!=0){
		$cls='inline';
	}
	else{
		$cls='none';
	}
	
	$returnpro=$this->db->query("SELECT sum(pro_qty) as qty FROM return_product WHERE pro_id='".$payrow->pro_id."'");
	if($returnpro->num_rows() > 0){
		$rrow = $returnpro->row();
		$retQty = ' ( '.$rrow->qty.' Qty)';
	}
	else{
		$retQty=0;
	}
	?>     
    <tr bgcolor="<?php echo $clr;?>">
      <td height="31" align="left"><?php echo $StPname;?></td>
      <td align="left"><?php echo $StPcode;?></td>
      <td align="left"><?php echo $cateName; ?></td>
      <td align="left"><?php echo $StPqty;?></td>
      <td colspan="2" align="center" valign="bottom" style="bottom:0;"><?php echo $payrow->pro_qty;?></td>
	<td align="left" class="section">        
         <div style="display:<?php echo $cls;?>">
        <a  href="javascript:void()" onclick ="loadContent(<?php echo $payrow->pro_id;?>)" style="text-decoration:none;">
                <i class="fa fa-plus"></i></a>&nbsp;&nbsp;
    <a  href="javascript:void()" onclick ="loadContentMinus(<?php echo $payrow->pro_id;?>,'<?php echo $StPname;?>')" style="text-decoration:none;">
    <i class="fa fa-minus"></i></a>&nbsp;&nbsp;
    <!--<a  href="<?php echo base_url('administration/inventory_history/'.$payrow->pro_id);?>" style="text-decoration:none;">
    <i class="fa fa-history"></i></a>&nbsp;&nbsp;-->
    <a  href="javascript:void()" onclick ="returnArea(<?php echo $payrow->pro_id;?>,'<?php echo $StPname;?>')" style="text-decoration:none;">
    Return <?php echo $retQty;?></a></div>
                    
    </td>
</tr>
    
    <?php
    $costCount = $costCount + $payrow->pro_qty;
    }	
    
    ?>
    
     <tr>
         <th align="right" colspan="8">
         <div style="float:right; font-size:18px">Total Product = <?php echo $costCount;?></div></th>
      </tr>
    </table>                          
