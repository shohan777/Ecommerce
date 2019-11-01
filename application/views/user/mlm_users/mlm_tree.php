<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
<style>
  a:hover,a:focus{
    outline: none;
    text-decoration: none;
}
.tab .nav-tabs{ border-bottom: 2px solid #e8e8e8; }
.tab .nav-tabs li a{
    display: block;
    padding: 10px 20px;
    margin: 0 5px 1px 0;
    background: #fff;
    font-size: 20px;
    font-weight: 700;
    color: #112529;
    text-align: center;
    border: none;
    border-radius: 0;
    z-index: 2;
    position: relative;
    transition:all 0.3s ease 0s;
}
.tab .nav-tabs li a:hover,
.tab .nav-tabs li.active a{
    color: #198df8;
    border: none;
}
.tab .nav-tabs li.active a:before{
    content: "\f107";
    font-family: fontawesome;
    font-size: 25px;
    font-weight: 700;
    color: #198df8;
    margin: 0 auto;
    position: absolute;
    bottom: -30px;
    left: 0;
    right: 0;
}
.tab .nav-tabs li.active a:after{
    content: "";
    width: 100%;
    height: 3px;
    background: #198df8;
    position: absolute;
    bottom: -1px;
    left: 0;
    z-index: -1;
    transition: all 0.3s ease 0s;
}
.tab .tab-content{
    padding: 30px 20px 20px;
    margin-top: 0;
    background: #fff;
    font-size: 15px;
    color: #7a9181;
    line-height: 30px;
    border-radius: 0 0 5px 5px;
}
.tab .tab-content h3{
    font-size: 24px;
    margin-top: 0;
}
@media only screen and (max-width: 479px){
    .tab .nav-tabs li{
        width: 100%;
        text-align: center;
    }
    .tab .nav-tabs li.active a:before{
        content: "\f105";
        bottom: 15%;
        left: 0;
        right: auto;
    }
}
  </style>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Tree</a></li>
                    <!--<li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">List</a></li>-->
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                       <div class="col-sm-12">
                       		<div class="usertree1">
                            	<img src="<?php echo base_url('assets/images/userdef.png');?>" class="uerimg" />
                                <div class="treeuname"><?php echo $userinfo['code'];?></div>
                                <div class="treeuname"><?php echo $userinfo['fullname'];?> </div>
                                <div class="teampoint">
                                A Team Point : (<?php echo $treepoints['team_A_point'];?>) <?php echo $treepoints['team_A_total'];?>    
                                B Team Point : (<?php echo $treepoints['team_B_point'];?>) <?php echo $treepoints['team_B_total'];?>
                                </div>
                            </div>  
                            <div class="col-sm-6">
                            	<div class="usertree1">
                                    <a href="<?php echo base_url('mlmuser/mlm_users_tree/'.$teamainfo['user_id']);?>">
                                    <img src="<?php echo base_url('assets/images/userdef.png');?>" class="uerimg" /></a>
                                    <div class="treeuname"><?php echo $teamainfo['code'];?></div>
                                    <div class="treeuname"><?php echo $teamainfo['fullname'];?> </div>
                                    <div class="teampoint">
                                    A Team Point : (<?php echo $teamApoint['team_A_point'];?>) <?php echo $teamApoint['team_A_total'];?>    
                                    B Team Point : (<?php echo $teamApoint['team_B_point'];?>) <?php echo $teamApoint['team_B_total'];?>
                                    </div>
                                </div> 
                            	<div class="col-sm-12">
                                    <div class="col-sm-6">
                                       <div class="usertree1">
                                    	<a href="<?php echo base_url('mlmuser/mlm_users_tree/'.$teama2info['user_id']);?>">
                                        <img src="<?php echo base_url('assets/images/userdef.png');?>" class="uerimg" /></a>
                                            <div class="treeuname"><?php echo $teama2info['code'];?></div>
                                            <div class="treeuname"><?php echo $teama2info['fullname'];?> </div>
                                            <div class="teampoint">
                                            A Team Point : (<?php echo $teamA2point['team_A_point'];?>) <?php echo $teamA2point['team_A_total'];?>    
                                            B Team Point : (<?php echo $teamA2point['team_B_point'];?>) <?php echo $teamA2point['team_B_total'];?>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="usertree1">
                                            <a href="<?php echo base_url('mlmuser/mlm_users_tree/'.$teamb2info['user_id']);?>">
                                            <img src="<?php echo base_url('assets/images/userdef.png');?>" class="uerimg" /></a>
                                            <div class="treeuname"><?php echo $teamb2info['code'];?></div>
                                            <div class="treeuname"><?php echo $teamb2info['fullname'];?> </div>
                                            <div class="teampoint">
                                            A Team Point : (<?php echo $teamB2point['team_A_point'];?>) <?php echo $teamB2point['team_A_total'];?>    
                                            B Team Point : (<?php echo $teamB2point['team_B_point'];?>) <?php echo $teamB2point['team_B_total'];?>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                            	<div class="usertree1">
                                	<a href="<?php echo base_url('mlmuser/mlm_users_tree/'.$teambinfo['user_id']);?>">
                                    <img src="<?php echo base_url('assets/images/userdef.png');?>" class="uerimg" /></a>
                                    <div class="treeuname"><?php echo $teambinfo['code'];?></div>
                                    <div class="treeuname"><?php echo $teambinfo['fullname'];?> </div>
                                    <div class="teampoint">
                                    A Team Point : (<?php echo $teamBpoint['team_A_point'];?>) <?php echo $teamBpoint['team_A_total'];?>    
                                    B Team Point : (<?php echo $teamBpoint['team_B_point'];?>) <?php echo $teamBpoint['team_B_total'];?>
                                    </div>
                                </div> 
                            	<div class="col-sm-12">
                       		<div class="col-sm-6">
                            	<div class="usertree1">
                            		<a href="<?php echo base_url('mlmuser/mlm_users_tree/'.$teama3info['user_id']);?>">
                                    <img src="<?php echo base_url('assets/images/userdef.png');?>" class="uerimg" /></a>
                                    <div class="treeuname"><?php echo $teama3info['code'];?></div>
                                    <div class="treeuname"><?php echo $teama3info['fullname'];?> </div>
                                    <div class="teampoint">
                                    A Team Point : (<?php echo $teamA3point['team_A_point'];?>) <?php echo $teamA3point['team_A_total'];?>    
                                    B Team Point : (<?php echo $teamA3point['team_B_point'];?>) <?php echo $teamA3point['team_B_total'];?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                            	<div class="usertree1">
                            		<a href="<?php echo base_url('mlmuser/mlm_users_tree/'.$teamb3info['user_id']);?>">
                                    <img src="<?php echo base_url('assets/images/userdef.png');?>" class="uerimg" /></a>
                                    <div class="treeuname"><?php echo $teamb3info['code'];?></div>
                                    <div class="treeuname"><?php echo $teamb3info['fullname'];?> </div>
                                    <div class="teampoint">
                                    A Team Point : (<?php echo $teamB3point['team_A_point'];?>) <?php echo $teamB3point['team_A_total'];?>    
                                    B Team Point : (<?php echo $teamB3point['team_B_point'];?>) <?php echo $teamB3point['team_B_total'];?>
                                    </div>
                                </div> 
                            </div>
                       </div>
                            </div>                           
                       </div>
                        
                    </div>
                    
                    
                    
                    <!--<div role="tabpanel" class="tab-pane fade" id="Section2">
                        <h3>Section 2</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nec urna aliquam, ornare eros vel, malesuada lorem. Nullam faucibus lorem at eros consectetur lobortis. Maecenas nec nibh congue, placerat sem id, rutrum velit. Phasellus porta enim at facilisis condimentum. Maecenas pharetra dolor vel elit tempor pellentesque sed sed eros. Aenean vitae mauris tincidunt, imperdiet orci semper, rhoncus ligula. Vivamus scelerisque.</p>
                    </div>-->
                    
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>


</div>
               