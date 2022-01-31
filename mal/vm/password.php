<?php
session_start();
if(isset($_SESSION['admin']))
{
	
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		
		$shopid=$_POST['shopid'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$newpassword=$_POST['newpassword'];
		$con_password=$_POST['con_password'];
		
			if($newpassword==$con_password)
			{
				
				
					$st=$conn->query("SELECT * FROM vm_shopprofile WHERE sp_username='$username' AND sp_password='$password' AND sp_shopid='$shopid'");
					if($st->num_rows>0)
					{
					
						$st=$conn->query("UPDATE vm_shopprofile SET sp_password='$newpassword' WHERE sp_shopid='".$_SESSION['admin']."'" );
						header("Location:password.php?suc1=success");
					}
					else
					{
						header('Location:password.php?fail1=incorrect&?show');
					}
			}
			else
			{
				header('Location:password.php?fail2=failed');
				
			}
			
			
	}
		
	

if(isset($_POST['submituser']))
	{
		
		$shopid=$_POST['shopid'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$n_username=$_POST['n_username'];
		
		$st=$conn->query("SELECT * FROM vm_shopprofile WHERE sp_username='$username' AND sp_password='$password' AND sp_shopid='$shopid'");
					if($st->num_rows>0)
					{
			
						$st=$conn->query("SELECT * FROM vm_shopprofile WHERE sp_username='$n_username'");
						if($st->num_rows>0)
						{
							header('Location:password.php?fail3=exist');
						
						
						}
						else
						{
							$st=$conn->query("UPDATE vm_shopprofile SET sp_username='$n_username' WHERE sp_shopid='".$_SESSION['admin']."'" );
							header("Location:password.php?suc2=success");
						}
			
					}
			
			
			
	}
	
?>
<!DOCTYPE html>
<html>  
<head>  
        <!-- Title -->
         <title>US e-Biller</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Utpara administrator" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Utpara Solutions" />
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        
        <!-- Theme Styles -->
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
                        
    </head>
    <body class="page-header-fixed">
    
        <div class="overlay"></div>   
        <main class="page-content content-wrap">
            <?php
			include("includes/topheader.php");
			?>
            <!-- Navbar -->
            <?php
			include("includes/adminsidebar.php");
			?>
            <!-- Page Sidebar -->
            <div class="page-inner">
                <div class="page-title">
                    <h3><strong>Change Password</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Profile</li>
                            <li class="active">Change Password</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				$stocks = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION["admin"]."' ORDER BY pr_productid ASC");
				$outstocks = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION["admin"]."' AND pr_stock < 5");
				$totbil = $conn->query("SELECT be_billid FROM vm_billentry WHERE user_id='".$_SESSION["admin"]."' AND be_isactive='0'");
				$todybil = $conn->query("SELECT be_billid FROM vm_billentry WHERE user_id='".$_SESSION["admin"]."' AND DATE(be_billdate)='$today' AND be_isactive='0'");
				
				?>
                <div id="main-wrapper">
                 
					<!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Change Password</h4>
                                    
                                </div>
                                <?php
								if(isset($_GET['suc1']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Password has been changed.
                                    </div>
                                    <?php
								}
								
								?>
								<?php
								if(isset($_GET['suc2']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Username has been changed.
										</div>
								<?php } ?>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                                    	<input type="hidden" name="shopid" value="<?= $_SESSION['admin'] ?>">
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="username"  placeholder="Enter Username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Current Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password"  placeholder="Enter Password">
                                                
                                            </div>
                                        </div>
										<?php
								if(isset($_GET['fail1']))
								{
									?>
									
                                    <span style="color:red;margin-left:200px;font-weight:bold">
                                        Inavalid Password or Username
										 </span>
										 
								<?php  } ?>
                                   
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="newpassword" placeholder="Enter New Password">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="con_password"  placeholder="Confirm New Password">
                                                
                                            </div>
                                        </div>
										<?php
                                        if(isset($_GET['fail2']))
									{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Confirm Password is Incorrect
										 </div>
										<?php  } ?>
                                        
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <button type="button" onClick="usernamechange()" name="update" style="float:right" class="btn btn-primary">Change Username</button>
												
                                            </div>
											</div>
										</form>
										</div>
										</div>
										<div id="showdiv"<?php 
										if(isset($_GET['show'])){?> style="display:block" <?php }else{?>style="display:none"<?php }?>>
										<div class="panel panel-white">
										<div class="panel-heading">
											<h4 class="panel-title">Change Username</h4>
                                    
										</div>
										
                                    
										<div class="panel-body">
										 <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
										<input type="hidden" name="shopid" value="<?= $_SESSION['admin'] ?>">
											 <div class="form-group">
                                            
                               
											 <label for="input-help-block" class="col-sm-2 control-label">Username</label>
											 <div class="col-sm-10">
                                                <input type="text" class="form-control" name="username"  placeholder="Enter Username">
												</div>
												</div>
												<div class="form-group">
                                            
                               
											 <label for="input-help-block" class="col-sm-2 control-label" >Password</label>
											 <div class="col-sm-10">
                                                <input type="password" style="float:right" class="form-control" name="password"  placeholder="Enter Password">
												</div>
												</div>
												<?php
								if(isset($_GET['fail3']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Already Exists
                                    </div>
								<?php }?>
									
											<div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">New Username</label>
                                            <div class="col-sm-10">
												<input type="text" class="form-control" name="n_username"  placeholder="Enter New Username">
                                             </div>   
                                            </div>
                                        
										 <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" name="submituser" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        
                                     </form>
                                </div>
                            </div>
							</div>
                        </div>
                    </div>
                </div><!-- Main Wrapper -->
                <?php
				include("includes/footer.php");
				?>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>
	

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/moment/moment.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        <script>
		function usernamechange()
		{
			document.getElementById('showdiv').style.display="block";
		}
		
		</script>
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>