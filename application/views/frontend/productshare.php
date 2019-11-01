<div class="socialdiv">
<a href="javascript:void();"  onclick="socialLink('https://www.facebook.com/sharer/sharer.php?u=')" class="facebook_bg socialbtn"> <i class="fa fa-facebook"></i> </a> 
</div>
<div class="socialdiv">
<a href="javascript:void();"  onclick="socialLink('https://twitter.com/home?status=')" class="twitter_bg socialbtn"> <i class="fa fa-twitter"></i></a>
</div>
<div class="socialdiv">
<a href="javascript:void();"  onclick="socialLink('https://plus.google.com/share?url=')" class="google_bg socialbtn"> <i class="fa fa-google-plus"></i></a>
</div>
<div class="socialdiv">
<a href="javascript:void();"  onclick="socialLink('https://pinterest.com/pin/create/button/?url=&media=')" class="pinterest_bg socialbtn" style="background:#ee4e47">
<i class="fa fa-instagram"></i></a>
</div>
<div class="socialdiv">
<a href="javascript:void();"  onclick="socialLink('https://pinterest.com/pin/create/button/?url=&media=')" class="pinterest_bg socialbtn">
<i class="fa fa-pinterest"></i></a>
</div>

<script>
function socialLink(url) {
    var myWindow = window.open(url+"<?php echo base_url('products/'.$slug);?>", "", "width=600,height=400");
}
</script>