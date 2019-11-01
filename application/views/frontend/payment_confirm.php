<html>
<head>
<script>
function clear_cart() {
		setTimeout("location.href = '<?php echo base_url(); ?>cart/remove/all';",5000);
}
</script>
</head>
<body onLoad="clear_cart();">
<div class="row" style="background:#FFF;z-index:-1; position:relative; width:100%; float:left">
    <div class="container" style="margin:20px auto;">
        <div class="content_details">
			<div class="col-sm-12" style="text-align:center; padding:40px; font-size:15px;">
            	<h2>Successfully Order Submitted</h2>
            	<div class="col-sm-12" style="line-height:20px;">Thanks for Online shopping with Bargainnshop<br />
                Your Shopping Information Details already sent to your email address</div>
			</div>
		    
</div>
		</div>
 </div>
</body>
</html>
