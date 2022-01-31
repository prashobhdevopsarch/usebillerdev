<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['update']))
	{
		$shopid = $_POST['shopid'];
		$name = $_POST['name'];
        $slogan = $_POST['slogan'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$statecode=$_POST['statecode'];
		/*$vat = $_POST['vat'];
		$vat1 = $_POST['vat1'];*/
		$acname=$_POST['acname'];
		$acno=$_POST['acno'];
		$acifsc=$_POST['acifsc'];
		$acbranch=$_POST['acbranch'];
		$tin_number=$_POST["tin_number"];
		
		$updte = $conn->query("UPDATE us_shopprofile SET sp_shopname='$name', sp_slogan='$slogan', sp_shopaddress='$address', sp_phone='$phone', sp_mobile='$mobile', sp_email='$email', sp_vatreadymades='$vat', sp_vatmillgoods='$vat1', sp_tin='$tin_number', sp_stcode='$statecode', sp_bank='$acname', sp_accno='$acno', sp_ifsc='$acifsc', sp_branch='$acbranch' WHERE sp_shopid='$shopid'");
		if($updte)
		{
			$_SESSION['stcode']=$statecode;
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
                    <h3><strong>Shop Profile</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Shop Profile</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				$stocks = $conn->query("SELECT * FROM us_products WHERE user_id='".$_SESSION["admin"]."' ORDER BY pr_productid ASC");
				$customer = $conn->query("SELECT cs_customerid FROM us_customer WHERE user_id='".$_SESSION["admin"]."' AND cs_isactive='0'");
				$balance=$conn->query("SELECT SUM(rs_balance) AS totbal FROM us_supplier WHERE user_id='".$_SESSION["admin"]."' AND rs_isactive='0'");
				$row=$balance->fetch_assoc();
				$oldbalance=$conn->query("SELECT SUM(cs_balance) AS totold FROM us_customer WHERE user_id='".$_SESSION["admin"]."' AND cs_isactive='0'");
				$slct=$oldbalance->fetch_assoc();
				$totalbal= $slct['totold'];
				$totalcridt=$row['totbal'];
				$outstocks = $conn->query("SELECT * FROM us_products WHERE user_id='".$_SESSION["admin"]."' AND pr_stock < 5");
				$totbil = $conn->query("SELECT be_billid FROM us_billentry WHERE user_id='".$_SESSION["admin"]."' AND be_isactive='0'");
				$todybil = $conn->query("SELECT be_billid FROM us_billentry WHERE user_id='".$_SESSION["admin"]."' AND DATE(be_billdate)='$today' AND be_isactive='0'");
				
				?>
                <div id="main-wrapper">
                	<div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?= mysqli_num_rows($stocks) ?></p>
                                        <span class="info-box-title">Stocks</span>
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
                                        <span class="info-box-title">Out of Stocks</span>
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
                                        <span class="info-box-title">Total Bills</span>
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
                                        <span class="info-box-title">Today Bills</span>
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
                                        <span class="info-box-title">Total customers</span>
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
                                        <span class="info-box-title">Customer Balance</span>
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
                                        <span class="info-box-title">Supplier Balance</span>
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
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Profile</h4>
                                    
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Profile Updated Successfully.
                                    </div>
                                    <?php
								}
								$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
								$row = $profl->fetch_assoc()
								?>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                                    	<input type="hidden" name="shopid" value="<?= $row['sp_shopid'] ?>">
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Shop Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" value="<?= $row['sp_shopname'] ?>" id="input-Default">
                                            </div>
                                        </div>
                                        <input type="hidden" name="shopid" value="<?= $row['sp_shopid'] ?>">
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Slogan</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="slogan" value="<?= $row['sp_slogan'] ?>" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="address" value="<?= $row['sp_shopaddress'] ?>" id="input-help-block">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phone" value="<?= $row['sp_phone'] ?>" id="input-help-block">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="text"  pattern=".{10}" class="form-control" name="mobile" value="<?= $row['sp_mobile'] ?>" id="input-help-block">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email" value="<?= $row['sp_email'] ?>" id="input-help-block">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">GSTIN</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="tin_number" value="<?= $row['sp_tin'] ?>" id="input-help-block">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">State Code</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="statecode" id="statecode">
                                                	<option  <?php  if($row['sp_stcode']=='AN'){ ?> selected  <?php } ?> value="AN">Andaman and Nicobar Islands </option>
                                                    
											<option <?php  if($row['sp_stcode']=='AP'){ ?> selected  <?php } ?> value="AP">Andhra Pradesh</option>
											<option <?php  if($row['sp_stcode']=='AD'){ ?> selected  <?php } ?> value="AD">Andhra Pradesh (New)</option>
											<option <?php  if($row['sp_stcode']=='AR'){ ?> selected  <?php } ?> value="AR">Arunachal Pradesh</option>
											<option <?php  if($row['sp_stcode']=='AS'){ ?> selected  <?php } ?> value="AS">Assam</option>
											<option <?php  if($row['sp_stcode']=='BH'){ ?> selected  <?php } ?> value="BH">Bihar</option>
											<option <?php  if($row['sp_stcode']=='CH'){ ?> selected  <?php } ?> value="CH">Chandigarh</option>
											<option <?php  if($row['sp_stcode']=='CT'){ ?> selected  <?php } ?> value="CT">Chattisgarh</option>
											<option <?php  if($row['sp_stcode']=='DN'){ ?> selected  <?php } ?> value="DN">Dadra and Nagar Haveli</option>
											<option <?php  if($row['sp_stcode']=='DD'){ ?> selected  <?php } ?> value="DD">Daman and Diu</option>
										    <option <?php  if($row['sp_stcode']=='DL'){ ?> selected  <?php } ?> value="DL">Delhi</option>
											<option <?php  if($row['sp_stcode']=='GA'){ ?> selected  <?php } ?> value="GA">Goa</option>
											<option <?php  if($row['sp_stcode']=='GJ'){ ?> selected  <?php } ?> value="GJ">Gujarat</option>
											<option <?php  if($row['sp_stcode']=='HR'){ ?> selected  <?php } ?> value="HR">Haryana</option>
											<option <?php  if($row['sp_stcode']=='HP'){ ?> selected  <?php } ?> value="HP">Himachal Pradesh</option>
											<option <?php  if($row['sp_stcode']=='JK'){ ?> selected  <?php } ?> value="JK">Jammu and Kashmir</option>
											<option <?php  if($row['sp_stcode']=='JH'){ ?> selected  <?php } ?> value="JH">Jharkhand</option>
											<option <?php  if($row['sp_stcode']=='KA'){ ?> selected  <?php } ?> value="KA">Karnataka</option>
											<option <?php  if($row['sp_stcode']=='KL'){ ?> selected  <?php } ?> value="KL">Kerala</option>
										    <option <?php  if($row['sp_stcode']=='LD'){ ?> selected  <?php } ?> value="LD">Lakshadweep Islands</option>
											<option <?php  if($row['sp_stcode']=='MP'){ ?> selected  <?php } ?> value="MP">Madhya Pradesh</option>
											<option <?php  if($row['sp_stcode']=='MH'){ ?> selected  <?php } ?> value="MH">Maharashtra</option>
											<option <?php  if($row['sp_stcode']=='MN'){ ?> selected  <?php } ?> value="MN">Manipur</option>
											<option <?php  if($row['sp_stcode']=='ME'){ ?> selected  <?php } ?> value="ME">Meghalaya</option>
											<option <?php  if($row['sp_stcode']=='MI'){ ?> selected  <?php } ?> value="MI">Mizoram</option>
											<option <?php  if($row['sp_stcode']=='NL'){ ?> selected  <?php } ?> value="NL">Nagaland</option>
										    <option <?php  if($row['sp_stcode']=='OR'){ ?> selected  <?php } ?> value="OR">Odisha</option>
											<option <?php  if($row['sp_stcode']=='PY'){ ?> selected  <?php } ?> value="PY">Pondicherry</option>
											<option <?php  if($row['sp_stcode']=='PB'){ ?> selected  <?php } ?> value="PB">Punjab</option>
											<option <?php  if($row['sp_stcode']=='RJ'){ ?> selected  <?php } ?> value="RJ">Rajasthan</option>
											<option <?php  if($row['sp_stcode']=='SK'){ ?> selected  <?php } ?> value="SK">Sikkim</option>
											<option <?php  if($row['sp_stcode']=='TN'){ ?> selected  <?php } ?> value="TN">Tamil Nadu</option>
											<option <?php  if($row['sp_stcode']=='TS'){ ?> selected  <?php } ?> value="TS">Telangana</option>
											<option <?php  if($row['sp_stcode']=='TR'){ ?> selected  <?php } ?> value="TR">Tripura</option>
											<option <?php  if($row['sp_stcode']=='UP'){ ?> selected  <?php } ?> value="UP">Uttar Pradesh</option>
										    <option <?php  if($row['sp_stcode']=='UT'){ ?> selected  <?php } ?> value="UT">Uttarakhand</option>
											<option <?php  if($row['sp_stcode']=='WB'){ ?> selected  <?php } ?> value="WB">West Bengal</option>
														
                                                 </select>
                                                
                                            </div>
                                        </div>
                                       
                                        <h3>Bank Details</h3>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="acname" value="<?= $row['sp_bank'] ?>" id="input-help-block">
                                                
                                            </div>
                                             </div>
                                            <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Account No</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="acno" value="<?= $row['sp_accno'] ?>" id="input-help-block">
                                              </div>   
                                            </div>
                                            <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">IFSC Code</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="acifsc" value="<?= $row['sp_ifsc'] ?>" id="input-help-block">
                                               </div>  
                                            </div>
                                            <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Branch</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="acbranch" value="<?= $row['sp_branch'] ?>" id="input-help-block">
                                                </div> 
                                                </div>
                                                 <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                            </div>
                                            </div>
											<div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                               <a href="password.php"><button type="button" name="change_pass" style="float:right ; margin-right:20px" class="btn btn-primary">Change Password</button></a>
												
                                            </div>
                                        </div>
                                     </form>
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
        
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>