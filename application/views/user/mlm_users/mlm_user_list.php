
<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th>Reference ID</th>
                                        <th >Team A Point</th>
                                        <th >Team B Point</th>
                                        <th >Wallet</th>
                                        <th >Source Tax</th>
                                        <th >Team A Total</th>
                                        <th >Team B Total</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($mlm_user_list as $user):
										$ref_id=$user->ref_id;
										$team_A_point=$user->team_A_point;
										$team_B_point=$user->team_B_point;
										$Wallet=$user->wallet;
										$archive=$user->archive_point;
										$vanish=$user->vanish_point;
										$team_A_total=$user->team_A_total;
										$team_B_total=$user->team_B_total;
									$i++;
									
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td align="left"><?php echo $ref_id; ?></td>
                                        <td align="left"><?php echo $team_A_point; ?></td>
                                        <td align="left"><?php echo $team_B_point; ?></td>
                                        <td align="left"><?php echo $mlm_total_wallet['credit']; ?></td>
                                        <td align="left"><?php echo $mlm_total_wallet['source_tax']; ?></td>
                                        <td align="left"><?php echo $team_A_total; ?></td>
                                        <td align="left"><?php echo $team_B_total; ?></td>
                                      </tr>
                                    <?php
                                    endforeach;
									?>  
                                      
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   

                </div>
               