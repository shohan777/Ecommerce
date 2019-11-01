<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>administration/deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}
</script>
<style>
.noText {
	color: transparent;
	text-indent: -9999px;
	font-size: 0px;
    line-height: 16px; /* retains height */
	width:20px; height:20px; 
    border-radius:50%; border:none;
  }
.changeText {
	color: #fff;
	font-size: 12px;
    line-height: 16px;
	text-align:center;
	font-weight:bold;
	width:20px; 
	height:20px; 
    border-radius:50%; 
	border:none;
  }
  
.ordertable{
	width:100%;
	height:auto;
	border:1px solid #ccc;
	border-collapse:collapse;
}	
.ordertable .trTitle{
	background:#666;
	
	/*box-shadow:#666 0 0 1px 1px;*/
	
}
.ordertable .trTitle td{
	padding:5px 10px;
	color:#fff;
	overflow:hidden;
	border:none;
	text-align:center;
}

.ordertable .trCont{
	border-bottom:1px solid #ccc;
}
.ordertable .trCont td{
	padding:5px 10px;
	overflow:hidden;
	border:none;
}
	
	.black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: #333;
        z-index:10001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        position: fixed;
        top: 10%;
        left: 25%;
        width: 60%;
        height: 60%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: #ffffff;
		box-shadow:0px 0px 15px #999999;
        z-index:1000000;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }
</style>
<?php $today=date('Y-m-d'); ?>
<div class="right_col" role="main">
                <div class="row">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Paid for Delivery Reports</h3>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('administration/ragular_finance_reports/paid_for_product/print');?>" onclick="javascript:void window.open('<?php echo base_url('administration/ragular_finance_reports/paid_for_product/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                        <div class="container">
                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;"></div>
                                          <table width="100%" class="ordertable">
                                    <tr bgcolor="#e5e5e5" class="trTitle">
                                      <td align="center">SI</td>
                                      <td align="center">Order </td>
                                      <td align="center">Order On</td>
                                      
                                      <td colspan="9" align="center">
                                        <table width="100%" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td align="center">P. Code </td>
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
                                        
                                     
                                      
                                      
                                      <td align="center">Total Price</td>
                                    </tr>
                                    <?php
										$i=0;
									  foreach($orderinfo->result() as $rowq){
									  $order_id=$rowq->order_id;
									  $order_number=$rowq->order_number;
									  $order_time=$rowq->order_time;
									  $total_price=$rowq->total_price;
									  
									  									  
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
                                      <td align="center"><?php echo $order_number;?></td>
                                      <td align="center"><?php echo $order_time;?></td>
                                    	<td colspan="9" align="center">
                                        	<table width="100%" align="center" cellpadding="0" cellspacing="0">
													<?php 
													$orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                                    foreach($orderProducts->result() as $ordPro){
														$ordproid = $ordPro->product_id;
                                                        $sql = "SELECT * FROM product WHERE product_id = ?";
                                                        $prodcutlist = $this->db->query($sql,$ordproid);
                                                        foreach($prodcutlist->result() as $pro);
														
														$sqlpp = "SELECT delivery_unit_cost FROM product_price WHERE product_id = ?";
                                                        $propriceq = $this->db->query($sqlpp,$ordproid);
                                                        foreach($propriceq->result() as $pprow);
														
														
                                                    ?>
                                                    <tr>
                                                    	<td align="center"><?php echo $pro->pro_code;?></td>                                                         
                                                        <td align="center">0</td> 
                                                        <td align="center">0</td>  
                                                        <td align="center">0</td>  
                                                        <td align="center">0</td> 
                                                        <td align="center">0</td>  
                                                        <td align="center"><span style="color:#006600; font-weight:bold;"><?php echo $pprow->delivery_unit_cost;?></span></td>  
                                                        <td align="center">0</td>  
                                                        <td align="center">0</td>  
                                                        <td align="center">0</td>  
                                                        <td align="center">0</td>  
                                                  </tr>
                                                    <?php
                                                     }
                                                    ?>
                                                    
                                                </table>
                                        </td>
                                        <td align="center"><?php echo $total_price;?></td>
                                    </tr>
                                    <?php
									  }
									  ?>
                                  </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               