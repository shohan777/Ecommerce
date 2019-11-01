<style>
.tableDesign{
	border:1px solid #eaeaea;
	border-collapse:collapse;
}

.tableDesign tr{
	padding:10px;
}

.tableDesign tr td{
	padding:10px;
	font-size:16px;
	border-collapse:collapse;
}

.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:2px 5px;
	color:#000;
}
.summTable .theadline td, th{
	padding:2px;
	color:#fff;
	background:#666;
}

		body {
	  background: rgb(204,204,204); 
	}
	page {
	  background: #fff;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  /*height: 29.7cm;*/ 
	  height:auto;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	 /* height: 21cm;  */
	 height:auto;
	}
	page[size="A3"] {
	  width: 29.7cm;
	  height: 42cm;
	}
	page[size="A3"][layout="portrait"] {
	  width: 42cm;
	  height: 29.7cm;  
	}
	page[size="A5"] {
	  width: 14.8cm;
	  height: 21cm;
	}
	page[size="A5"][layout="portrait"] {
	  width: 21cm;
	  height: 14.8cm;  
	}
	@media print {
	  body, page {
		margin: 0;
		box-shadow: 0;
	  }
	}
</style>
<page size="A4" layout="portrait">
    <div style="padding:1cm;">
            <div class="row">
            <div style="width:100%; float:left">	
               <div style="text-align:center; padding:5px 0">
                                  <h2><img src="<?php echo base_url('assets/images/logo.png');?>" style="width:90px; height:auto;text-align: center;" alt="MMK Group" title="MMK Group"></h2>
                                    </div>           	  		
            </div>
            <div class="clearfix"></div>
            <div class="row">
        
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            <div class="row">
                                  <div class="col-md-12">
                                      <table class="table datatable-show-all" width="100%">
                <thead>
                  <tr>
                    <th width="2%" align="center">SI</th>
                    <th width="34%" align="center">Product Name</th>
                    <th width="15%" align="center">Product Category</th>
                    <th width="13%" align="center">Stock</th>
                    <th width="19%" align="center">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                $total =0;
                foreach($stocklist->result() as $productData):
                $product_id=$productData->product_id;
                $productTitle=$productData->product_name;
                $cat_id=$productData->cat_id;
                
                $catquery=$this->Index_model->getAllItemTable('category','caegory_title',$cat_id,'','','cid','desc');
                if($catquery->num_rows() > 0){
                    foreach($catquery->result() as $cat_row);
                    $cateName=$cat_row->cat_name;
                }
                else{
                    $cateName='NULL';
                    }
                
                if($i%2==0){
                    $bgcol = '#f9f9f9';
                }
                else{
                    $bgcol = '#fff';
                }
                $i++;
                ?>
                  <tr bgcolor="<?php echo $bgcol;?>">
                    <td align="left"><?php echo $i;?></td>
                    <td align="left"><?php echo $productTitle; ?></td>
                    <td align="left"><?php echo $cateName; ?></td>
                  <td align="left"> 
                        <?php 
                        $stock=$this->db->query("SELECT sum(pro_qty) as qty FROM stock WHERE pro_id='$product_id'");
                        if($stock->num_rows() > 0){
                            $drwos = $stock->row();
                            $stockQty = $drwos->qty;
                            $total = $total + $drwos->qty;
                        }
                        else{
                            $total=0;
                            $stockQty=0;
                        }
                        echo $stockQty;
                        
                        if($stockQty!='' || $stockQty!=0){
                            $cls='inline';
                        }
                        else{
                            $cls='none';
                        }
                        
                        $returnpro=$this->db->query("SELECT sum(pro_qty) as qty FROM return_product WHERE pro_id='$product_id'");
                        if($returnpro->num_rows() > 0){
                            $rrow = $returnpro->row();
                            $retQty = ' ( '.$rrow->qty.' Qty)';
                        }
                        else{
                            $retQty=0;
                        }
                        
                        $stockout=$this->db->query("SELECT * FROM stock_out WHERE pro_id='$product_id'");
                        ?>                                         
                        </td>
                     <td align="left" class="section">
                    
            
                    <div style="display:<?php echo $cls;?>">
                                              
                       <?php if($stockout->num_rows() > 0){?>  Return <?php echo $retQty;?>
                       <?php } ?>
                    </div>
                                
                </td>
                  </tr>
                <?php
                endforeach;
                ?>  
                  
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    
                     <td align="center"> 
                        <?php echo 'Total Qty : '.$total;?>
                     </td>
                  </tr>
                </tbody>
              </table>
                                  </div>
                                </div>
                        </div>
                </div>
            </div>
        
        </div>
            </div>
    </div>
</page>             