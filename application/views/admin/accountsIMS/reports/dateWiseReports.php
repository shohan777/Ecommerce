<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url($urlname.'/datewise_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate},
			   success: function(data) {
				 // alert(data);
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
</script>

<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
							<li>Credit Information</li>
						</ul>
                        <ul class="breadcrumb-elements">
							<div class="heading-btn-group">
                                
                                <a href="<?php echo base_url($urlname.'/datewise_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url($urlname.'/datewise_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;" 
                                 class="btn btn-info" style="margin:7px 3px"><i class="fa fa-print"></i> Print</a>
                            	
							</div>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<div class="content">
					
					<div class="panel panel-flat"> 
                    	<div class="row" style="padding:10px;">
                            <table width="50%" border="0" cellspacing="5" cellpadding="0" align="center">
                                        <tr>
                                          <td width="19%"><label class="control-label">From Date :</label></td>
                                          <td width="30%"><input name="from_date" class="form-control date-picker" autocomplete="on"  type="text" id="from_date"/></td>
                                          <td width="4%">&nbsp;</td>
                                          <td width="12%"><label class="control-label">To Date:</label></td>
                                          <td width="26%"><input name="to_date" class="form-control date-picker" type="text"  autocomplete="on" id="to_date" ></td>
                                          <td width="9%"><input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                                        </tr>
                                      </table>
                        </div>
                    		<div id="reportsdisplay"></div>
                    </div>
