<?php
$page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    
                    <ul class="menu accordion-menu">
                    
                        <li <?php if($page == 'dashboard.php'){ ?> class="active" <?php } ?>><a href="dashboard.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-print"></span><p>ബില്ലിംഗ്</p></a></li>
                        <li <?php if($page == 'stocks.php' || $page == 'addstocks.php'){ ?> class="active" <?php } ?>><a href="stocks.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>സ്റ്റോക്‌സ്</p></a>  
                        </li>
                   
                        <li <?php if($page == 'outofstocks.php'){ ?> class="active" <?php } ?>><a href="outofstocks.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-close"></span><p>ഔട്ട് ഓഫ് സ്റ്റോക്‌സ്</p></a></li>
                        
                        <li <?php if($page == 'billinghistory.php'){ ?> class="active" <?php } ?>><a href="billinghistory.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>ബില്ലിംഗ് ഹിസ്റ്ററി</p></a>   
                        </li>
                          <li <?php if($page == 'billinghistory.php'){ ?> class="active" <?php } ?>><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>സെയിൽസ് റിട്ടേൺ</p></a>   
                        </li>
						<li <?php if($page == 'expense.php'){ ?> class="active" <?php } ?>><a href="expense.php" class="waves-effect waves-button"><span class="menu-icon fa fa-money"></span><p>എക്‌സ്‌പെൻസ്‌</p></a>   
                        </li>
                        
                         <li <?php if($page == 'daybook.php'){ ?> class="active" <?php } ?>><a href="daybook.php" class="waves-effect waves-button"><span class="menu-icon 	glyphicon glyphicon-time"></span><p>
                         
                         
								ലെഡ്ജർ </p></a>   
                        </li>
                        
                         <li <?php if($page == 'purchase.php'){ ?> class="active" <?php } ?>><a href="purchase.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-shopping-cart"></span><p>പർച്ചേയ്‌സ്</p></a>   
                        </li>
                         <li <?php if($page == 'purchasehistory.php'){ ?> class="active" <?php } ?>><a href="purchasehistory.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p>പർച്ചേയ്‌സ് ഹിസ്റ്ററി</p></a>   
                        </li>
                        <li <?php if($page == 'purchasehistory.php'){ ?> class="active" <?php } ?>><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p>പർച്ചേയ്‌സ് റിട്ടേൺ</p></a>   
                        </li>
						<li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>ടാക്‌സ് റിപ്പോർട്ട്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="puchasevat.php">പർച്ചേയ്‌സ് വാട്ട്</a></li>
                                
                                <li><a href="salesvat.php">സെയിൽസ് വാട്ട്</a></li>
                                
                            </ul>
                        </li>
						
                          <li <?php if($page == 'category.php'){ ?> class="active" <?php } ?>><a href="category.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-duplicate"></span><p>Category</p></a>   
                        </li>
						<li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-align-justify"></span><p>കസ്റ്റമർ മാനേജ്മെൻറ്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="customer.php">ആഡ് കസ്റ്റമർ</a></li>
                                <li><a href="cushistory.php">കസ്റ്റമർ ലിസ്റ്റ്  </a></li>
                                
                            </ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-align-justify"></span><p>സപ്ലയർ മാനേജ്മെൻറ്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="addsupplier.php">ആഡ് സപ്ലയർ</a></li>
                                <li><a href="supplierlist.php">സപ്ലയർ ലിസ്റ്റ്</a></li>
                                
                            </ul>
                        </li>
						
                        
                        <li <?php if($page == 'profile.php'){ ?> class="active" <?php } ?>><a href="profile.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span><p>പ്രൊഫൈൽ</p></a></li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p>സെറ്റിങ്‌സ്</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                
                                <li> <a onClick="return confirm('Do you want to Backup?')" href="backup.php?back=<?=$page?>">ബാക്കപ്പ് </a></li>
                                
                                
                            </ul>
                        </li>

						<li <?php if($page == 'logout.php'){ ?> class="active" <?php } ?>><a href="logout.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-off"></span><p>ലോഗൗട്ട്</p></a></li>
                      
		
						
					  
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div>