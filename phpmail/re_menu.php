<style>

a:link{ text-decoration: none;
	color: gray;
}
	
a:visited{ text-decoration: none;
	color: gray;
}
a:hover{ text-decoration: none;
	color: black;
	font-weight: bolder;
	/*letter-spacing: 1px;*/
	font-size:12px;
}
</style>
<div class="container">
<a href="../index.php" class="brand">
VTG
<!--<img src="images/main-logo.png" alt="Ohmy website template">--></a>
                        <nav id="mainMenu" class="clearfix">
                            <ul>
                                <li><img name="" src="../images/user-icon.jpg" width="52" height="32" alt="" />(<?php echo $user_name ; ?>)</li>
                                <li><a href="../home.php" class="firstLevel">Home</a>
                              </li>     
                           <?php if($user_rule=='6') { ?>
                                 <li><a href="../report_mm_head.php" class="firstLevel last">MM</a></li>
  <li><a href="../home_sd_all.php" class="firstLevel last">SD</a></li>
  <!--<li><a href="report_dpd_head.php" class="firstLevel last">DPD</a></li>-->
   <li><a href="../home_dpd_all.php" class="firstLevel last">All(DPD)</a></li>
                                 <li><a href="../home_dpd_fabric.php" class="firstLevel last">Fab. Booking</a></li>
                                                           <?php } ?>
                                                           
                                                           <?php if($user_rule=='1') { ?>
                                 <li><a href="../home_sd.php" class="firstLevel last">Work Space (SD)</a></li>
                                 <li><a href="../home_sd_all.php" class="firstLevel last">All Sample</a></li>
                                       <li><a href="../sample_out.php" class="firstLevel last">Sample Out</a></li>
                                                           <?php } ?>  
                                                            <?php if($user_rule=='2') { ?>
                                 <li><a href="../home_mm.php" class="firstLevel last">Work(MM)</a></li>
                                 <li><a href="../home_mm_sto.php" class="firstLevel last">STO</a></li>
                                 <li><a href="../home_mm_sto_all.php" class="firstLevel last">STO(ALL)</a></li>
                                                           <?php } ?> 
                                                            <?php if($user_rule=='3') { ?>
                                 <li><a href="../home_dpd.php" class="firstLevel last">Work(DPD)</a></li>
                                 <li><a href="../home_dpd_all.php" class="firstLevel last">All(DPD)</a></li>
                                 <li><a href="../home_dpd_fabric.php" class="firstLevel last">Fab. Booking</a></li>
                                 <li><a href="../sample_out.php" class="firstLevel last">Sample Out</a></li>
                                                           <?php } ?> 
                                                           <?php if($user_rule=='4') { ?>
                                 <li><a href="../home_sample.php" class="firstLevel last">Work Space (Sample)</a></li>
                                                           <?php } ?>  
                                                           <?php if($user_rule=='7') { ?>
                                 <li><a href="../home_check.php" class="firstLevel last">Work Space (Check list)</a></li>
                                 <li><a href="../check_list.php" class="firstLevel last">Check list details</a></li>
                                                           <?php } ?> 
                                                            <?php if($user_rule=='8') { ?>
                                 <li><a href="../home_dying.php" class="firstLevel last">Work Space (Dying)</a></li>
                                 <li><a href="../home_dying_all.php" class="firstLevel last">All Work</a></li>
                                                           <?php } ?>  
                                                             <?php if($user_rule=='9') { ?>
                                 <li><a href="../home_store.php" class="firstLevel last">Work (Store)</a></li>
                                 <li><a href="../home_store_all.php" class="firstLevel last">All Work</a></li>
                                 <li><a href="../store_rack.php" class="firstLevel last">Rack in</a></li>
                                                           <?php } ?>  
                                                           
                                                                  <?php if($user_rule=='10') { ?>
                                 <li><a href="../home_knitting.php" class="firstLevel last">Work Space(Knitting)</a></li>
                                 <li><a href="../home_knitting_all.php" class="firstLevel last">All Work</a></li>
                                                           <?php } ?>  
                                                           
                                                           
                                <li><a href="../forced.php" class="firstLevel last">Accounts</a>
                               <!-- 
                                <ul>
                                <li><a href="forced.php" class="firstLevel last">Accounts</a>
                                </li></ul><--></li>
                                
                                
                                </li>                                             
                                <li><a href="../logout.php" class="firstLevel last">Logout</a></li>
                                
                                
                            </ul>
						</nav>
						</div>