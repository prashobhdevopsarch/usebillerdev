<div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="home.php" class="logo-text"><img src="assets/logo.png" width="100px" /></a>
                    </div><!-- Logo Box -->
                    
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-left">
                                <li>		
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                                </li>                                 
                            </ul>
                            <?php
						//include("config.php");
						$slct_shop=$conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION['admin']."'");
						$row_shop=$slct_shop->fetch_assoc();
						$active=$row_shop["sp_acnttype"];
						$startdate=$row_shop["sp_adddate"];
						$trailpriod=$row_shop["sp_trlprd"];
						if($active==0)
						{
						$date1 = date('Y-m-d');
						
						$diff = abs(strtotime($startdate) - strtotime($date1));
						
						$years = floor($diff / (365*60*60*24));
						$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
						$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						$endtrail=$trailpriod-$days;
						?>
                            <div class="nav navbar-nav" style="background:#F00; height:60px;padding: 5px;">
                            
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#myModal_msg" href="#">
                    	
                        
                        <span style="width:100%">Activate Your Account</span><br /><span style="width:100%">trial ends in <?=$endtrail?> day</span>
                    </a>
                               
                           </div>
                           <?php }?>
                            <ul class="nav navbar-nav navbar-right">
                            
                            
                                
                                
                                
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?= $_SESSION['name'] ?><i class="fa fa-angle-down"></i></span>
                                       
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="profile.php"><i class="fa fa-user"></i>Profile</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"><a href="password.php"><i class="fa fa-undo"></i>Change Password</a></li>
                                        <li role="presentation" class="divider"></li>
                                        
                                        <li role="presentation"><a href="logout.php"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
										
										 
										
										 
                                        
                                        
                                       
                                    </ul>
                                </li>
                                <li>
                                    <a href="logout.php" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                    </a>
                                </li>
                                
                               
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div>
    <div class="modal fade" id="myModal_msg" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Please Contact Us : 7293404311</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        
      </div>
      
    </div>
  </div>
  