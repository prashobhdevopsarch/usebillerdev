<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['update']))
	{
		$shopid = $_POST['shopid'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		/*$vat = $_POST['vat'];
		$vat1 = $_POST['vat1'];*/
		$tin_number=$_POST["tin_number"];
		
		$updte = $conn->query("UPDATE vm_shopprofile SET sp_shopname='$name', sp_shopaddress='$address', sp_phone='$phone', sp_mobile='$mobile', sp_email='$email', sp_vatreadymades='$vat', sp_vatmillgoods='$vat1', sp_tin='$tin_number' WHERE sp_shopid='$shopid'");
		if($updte)
		{
			header('Location:profile.php?id=success');
	  }
	  else{
		  header('Location:profile.php?id=fail');
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
                    <h3><strong>ഡാഷ്‌ബോർഡ്</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li></li>
                            <li class="active">ഡാഷ്‌ബോർഡ്</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				$stocks = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION["admin"]."' ORDER BY pr_productid ASC");
				$customer = $conn->query("SELECT cs_customerid FROM vm_customer WHERE user_id='".$_SESSION["admin"]."' AND cs_isactive='0'");
				$balance=$conn->query("SELECT SUM(rs_balance) AS totbal FROM vm_supplier WHERE user_id='".$_SESSION["admin"]."' AND rs_isactive='0'");
				$row=$balance->fetch_assoc();
				$oldbalance=$conn->query("SELECT SUM(cs_balance) AS totold FROM vm_customer WHERE user_id='".$_SESSION["admin"]."' AND cs_isactive='0'");
				$slct=$oldbalance->fetch_assoc();
				$totalbal= $slct['totold'];
				$totalcridt=$row['totbal'];
				$outstocks = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION["admin"]."' AND pr_stock < 5");
				$totbil = $conn->query("SELECT be_billid FROM vm_billentry WHERE user_id='".$_SESSION["admin"]."' AND be_isactive='0'");
				$todybil = $conn->query("SELECT be_billid FROM vm_billentry WHERE user_id='".$_SESSION["admin"]."' AND DATE(be_billdate)='$today' AND be_isactive='0'");
				
				?>
                <div id="main-wrapper">
                	<div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?= mysqli_num_rows($stocks) ?></p>
                                        <span class="info-box-title">സ്റ്റോക്‌സ്</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-box-progress">
                                        <div class="progress progress-xs progress-squared bs-n">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?= mysqli_num_rows($outstocks) ?></p>
                                        <span class="info-box-title">ഔട്ട് ഓഫ് സ്റ്റോക്‌സ്</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-box-progress">
                                        <div class="progress progress-xs progress-squared bs-n">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter"><?= mysqli_num_rows($totbil) ?></span></p>
                                        <span class="info-box-title">ടോട്ടൽ ബിൽസ്</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-box-progress">
                                        <div class="progress progress-xs progress-squared bs-n">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?= mysqli_num_rows($todybil) ?></p>
                                        <span class="info-box-title">ടുഡേ  ബിൽസ്</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-box-progress">
                                        <div class="progress progress-xs progress-squared bs-n">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-lg-4 col-md-4">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter"><?= mysqli_num_rows($customer) ?></span></p>
                                        <span class="info-box-title">ടോട്ടൽ കസ്റ്റമേഴ്സ് </span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-box-progress">
                                        <div class="progress progress-xs progress-squared bs-n">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-4 col-md-4">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter"><?php if($totalbal==""){ echo 0;}else {echo $totalbal; } ?></span></p>
                                        <span class="info-box-title">കസ്റ്റമർ ബാലൻസ്</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-box-progress">
                                        <div class="progress progress-xs progress-squared bs-n">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter"><?php if($totalcridt==""){ echo 0; } else { echo $totalcridt; }  ?></span></p>
                                        <span class="info-box-title">സപ്ലയർ ബാലൻസ്</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-box-progress">
                                        <div class="progress progress-xs progress-squared bs-n">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
                    </div>
                    <!-- Row -->
                    
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
        
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>