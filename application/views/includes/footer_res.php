<!DOCTYPE html>
<html>
<head>
<style>
.footer_accordion {
    background-color: #0e3863;
    color: #fff;
    cursor: pointer;
    padding: 15px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
	border-bottom:1px solid #ccc;
}

.footer_accordion.active, .footer_accordion:hover {
    background-color: #f9a51c;
}

.footer_accordion:after {
    content: '\002B';
    color: #fff;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}

.footer_accordion.active:after {
    content: "\2212";
}

.footer_panel {
    padding: 0 18px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}
.paymentarea{
	width:100%;
	height:auto;
	margin:auto;
	padding:20px 0 0 30px;
	text-align:center;
}
</style>
</head>
<body>

<button class="footer_accordion">WE ARE AVAILABLE</button>
<div class="footer_panel">
	<div class="paymentarea">
        <div class="col-sm-12 col-xs-12">
           <div class="footer-apps"  style="width:100%; float:left;">
              <ul>
                          <li><a href="#"><img alt="Android" title="Android" src="<?php echo base_url();?>assets/images/android3.png"></a></li>
                          <li><a href="#"><img alt="IOS" title="IOS" src="<?php echo base_url();?>assets/images/ios.png"></a></li>
                          <li><a href="#"><img alt="Windows" title="Windows" src="<?php echo base_url();?>assets/images/windows.png"></a></li>
                          <li><a href="#"><img alt="Black Berry" title="Black Berry" src="<?php echo base_url();?>assets/images/blackberry.png"></a></li>
                          <li><a href="#"><img alt="Mobile Version" src="<?php echo base_url();?>assets/images/mobile.png" title="Mobile Version" style="width: 15px;"></a></li>
                        </ul>
            </div>     
           <div style="width:100%; float:left;  text-align:left; margin:30px 0">
           		<img alt="" src="<?php echo base_url();?>assets/images/call.png" class="blink-logo"> 
                <span style="font-size:22px; margin:5px 0 0 20px;">01783-999 909</span>
           </div>         
        </div>
    </div>
</div>

<button class="footer_accordion">WE ACCEPT</button>
<div class="footer_panel">
    <div class="paymentarea">
       <ul style="text-align:center">
                      <li class="mastero"><a href="#"><img alt="" src="<?php echo base_url();?>assets/images/payment/mastero.png"></a></li>
                      <li class="visa"><a href="#"><img alt="" src="<?php echo base_url();?>assets/images/payment/visa.png"></a></li>
                      <li class="currus"><a href="#"><img alt="" src="<?php echo base_url();?>assets/images/payment/currus.png"></a></li>
                      <li class="discover"><a href="#"><img alt="" src="<?php echo base_url();?>assets/images/payment/discover.png" style="width:40px; height:auto"></a></li>
                      <li class="bank"><a href="#"><img alt="" src="<?php echo base_url();?>assets/images/payment/bank.jpg" style="width:40px; height:auto"></a></li>
                    </ul>
    </div>
</div>

<button class="footer_accordion">FOLLOW US</button>
<div class="footer_panel">
   <div class="paymentarea">
  		<ul class="team-social">
          <li><a href="#"><span class="fa fa-facebook" style="font-size:30px;"></span></a></li>
          <li><a href="#"><span class="fa fa-twitter" style="font-size:30px;"></span></a></li>
          <li><a href="#"><span class="fa fa-instagram" style="font-size:30px;"></span></a></li>
          <!--<li><a href="#"><span class="fa fa-linkedin"></span></a></li>-->
          <li><a href="#"><span class="fa fa-google-plus" style="font-size:30px;"></span></a></li>
          <li><a href="#"><span class="fa fa-youtube-play" style="font-size:30px;"></span></a></li>
          
        </ul>
   </div>
</div>

<button class="footer_accordion">NEWSLETTER</button>
<div class="footer_panel">
  
  <div class="paymentarea">
  		<div class="col-sm-12 wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="40">
                    <form>
                      <div class="footer_input_area" style="margin:0; padding:0">
                        <input type="text" class="footer_input-text" placeholder="info@example.com">
                        <button type="submit" value="Subscribe"  class="btn btn-md btn-primary subscribebtn">Subscribe &nbsp;&gt;</button>
                        </div>
                    </form>
                    </div>
   </div>
                    
</div>

<script>
var acc = document.getElementsByClassName("footer_accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var footer_panel = this.nextElementSibling;
    if (footer_panel.style.maxHeight){
      footer_panel.style.maxHeight = null;
    } else {
      footer_panel.style.maxHeight = footer_panel.scrollHeight + "px";
    } 
  }
}
</script>

</body>
</html>
