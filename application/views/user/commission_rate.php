<style>
.badge {
    background-color: #14bf11;
}
.badge_not_set {
    background-color: #999;
}
</style>
<div class="right_col" style="padding: 0 10px;">
    <div class="page-title">
        <div class="title_left" style="text-align:center; width:100%; padding:10px">
            <h1>Category Commission Rate</h1>
        </div>
    </div>
    <div class="row">
        <div class="page-content-center" style="width: 75%; margin: 0 auto;">
            <?php if($commission_rates) : 
                foreach($commission_rates->result() as $commission_rate) : ?>
                <ul class="list-group">
                    <li class="list-group-item"><?php echo $commission_rate->cat_name; ?> <span class="badge <?php echo ($commission_rate->seller_commission) ? "" : 'badge_not_set'; ?>"><?php echo ($commission_rate->seller_commission) ? $commission_rate->seller_commission."%" : 'Not Set'; ?></span></li>
                </ul>
            <?php endforeach; endif ?>
        </div>
    </div>


</div>

