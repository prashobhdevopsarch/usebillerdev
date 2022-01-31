<?php
$page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<style>
.menu.accordion-menu>li>a, body:not(.page-horizontal-bar):not(.small-sidebar) .menu.accordion-menu a {
    text-align: left;
}
</style>
<div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    
                    <ul class="menu accordion-menu">
                    	<li <?php if($page == 'home.php'){ ?> class="active" <?php } ?>><a href="home.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-dashboard"></span> ഡാഷ്‌ബോർഡ്</p></a>
                    	<li class="droplink <?php if($page == 'dashboard.php' || $page == 'purchase.php' || $page == 'salesreturn.php' || $page == 'purchasereturn.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-print"></span> ബില്ലിംഗ്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'dashboard.php'){ ?> class="active" <?php } ?>><a href="dashboard.php">സെയിൽസ് ബില്ലിംഗ്</a></li>
                                
                                <li<?php if($page == 'purchase.php'){ ?> class="active" <?php } ?>><a href="purchase.php">പർച്ചേയ്‌സ് ബില്ലിംഗ്</a></li>
                                
                                <li<?php if($page == 'salesreturn.php' ){ ?> class="active" <?php } ?>><a href="salesreturn.php">സെയിൽസ് റിട്ടേൺ</a></li>
                                
                                <li<?php if($page == 'purchasereturn.php' ){ ?> class="active" <?php } ?>><a href="purchasereturn.php">പർച്ചേയ്‌സ് റിട്ടേൺ</a></li>
                            </ul>
                        </li>
                        <li class="droplink <?php if($page == 'billinghistory.php' || $page == 'purchasehistory.php' || $page == 'salesreturnhistory.php' || $page == 'purchasereturnhistory.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-book"></span> റിപ്പോർട്ട്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'billinghistory.php'){ ?> class="active" <?php } ?>><a href="billinghistory.php">സെയിൽസ് റിപ്പോർട്ട്</a></li>
                                
                                <li<?php if($page == 'purchasehistory.php'){ ?> class="active" <?php } ?>><a href="purchasehistory.php">പർച്ചേയ്‌സ് റിപ്പോർട്ട്</a></li>
                                
                                <li<?php if($page == 'salesreturnhistory.php'){ ?> class="active" <?php } ?>><a href="salesreturnhistory.php">സെയിൽസ് റിട്ടേൺ</a></li>
                                
                                <li<?php if($page == 'purchasereturnhistory.php'){ ?> class="active" <?php } ?>><a href="purchasereturnhistory.php">പർച്ചേയ്‌സ് റിട്ടേൺ</a></li>
                            </ul>
                        </li>
                        <li class="droplink <?php if($page == 'stocks.php' || $page == 'addstocks.php' || $page == 'outofstocks.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-folder-open"></span> &nbsp;സ്റ്റോക്‌സ്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'stocks.php'){ ?> class="active" <?php } ?>><a href="stocks.php">സ്റ്റോക്‌സ് റിപ്പോർട്ട്</a></li>
                                
                                <li<?php if($page == 'outofstocks.php'){ ?> class="active" <?php } ?>><a href="outofstocks.php">ഔട്ട് ഓഫ് സ്റ്റോക്‌സ്</a></li>
                                
                            </ul>
                        </li>
                        <li class="droplink <?php if($page == 'puchasevat.php' || $page == 'salesvat.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-briefcase"></span> ടാക്‌സ്  റിപ്പോർട്ട്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'puchasevat.php'){ ?> class="active" <?php } ?>><a href="puchasevat.php">പർച്ചേയ്‌സ് ടാക്‌സ് </a></li>
                                
                                <li<?php if($page == 'salesvat.php'){ ?> class="active" <?php } ?>><a href="salesvat.php">സെയിൽസ് ടാക്‌സ് </a></li>
                                
                            </ul>
                        </li>
                        
                   
                        
                        
                           
                        </li>
                             
                        </li>
						<li <?php if($page == 'expense.php'){ ?> class="active" <?php } ?>><a href="expense.php" class="waves-effect waves-button"><p><span class="menu-icon fa fa-money"></span> എക്‌സ്‌പെൻസ്‌</p></a>   
                        </li>
                        
                         <li <?php if($page == 'daybook.php'){ ?> class="active" <?php } ?>><a href="daybook.php" class="waves-effect waves-button"><p><span class="menu-icon 	glyphicon glyphicon-time"></span> ഡേബുക്ക്</p></a>   
                        </li>
                        
                        <li class="droplink <?php if($page == 'category.php' || $page == 'customer.php' || $page == 'addsupplier.php' || $page == 'cushistory.php' || $page == 'supplierlist.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-cog"></span> സെറ്റിങ്‌സ്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'category.php'){ ?> class="active" <?php } ?>><a href="category.php">ആഡ് കാറ്റഗറി</a></li>
                                <li<?php if($page == 'customer.php'){ ?> class="active" <?php } ?>><a href="customer.php">ആഡ് കസ്റ്റമർ</a></li>
                                <li<?php if($page == 'addsupplier.php'){ ?> class="active" <?php } ?>><a href="addsupplier.php">ആഡ് സപ്ലയർ</a></li>
                                <li<?php if($page == 'cushistory.php'){ ?> class="active" <?php } ?>><a href="cushistory.php">കസ്റ്റമർ ലിസ്റ്റ്</a></li>
                                <li<?php if($page == 'supplierlist.php'){ ?> class="active" <?php } ?>><a href="supplierlist.php">സപ്ലയർ ലിസ്റ്റ്</a></li>
                                <li<?php if($page == 'barcodemenu.php'){ ?> class="active" <?php } ?>><a href="barcodemenu.php">ബാർകോഡ്</a></li>
                                <li> <a onClick="return confirm('Do you want to Backup?')" href="backup.php?back=<?=$page?>">ബാക്കപ്പ്</a></li>
                                
                                
                            </ul>
                        </li>
                         
						
						
                          
						
                        
						
                        
                        <li <?php if($page == 'profile.php'){ ?> class="active" <?php } ?>><a href="profile.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-user"></span> പ്രൊഫൈൽ</p></a></li>
                        

						<li <?php if($page == 'logout.php'){ ?> class="active" <?php } ?>><a href="logout.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-off"></span> ലോഗൗട്ട്</p></a></li>
                      
		
						
					  
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div>