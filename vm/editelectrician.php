<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$electid = $_POST['electid'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$elec_phone = $_POST['elec_phone'];
		$email = $_POST['email'];
		//$tin_number=$_POST["tin_number"];
		//$statecode=$_POST['statecode'];
		
		//$balance=$_POST['balance'];
		$update = $conn->query("UPDATE us_elec SET el_name='$name', el_phone='$elec_phone', el_address='$address', el_email='$email' WHERE el_id='$electid'");
		if($update)
		{
			header('Location:elelist.php?id=success');
	  }
	  else{
		  header('Location:editelectrician.php?id=fail&eleid='.$electid);
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
                    <h3><strong>Edit Elecrician</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            
							<li>Electrician Management</li>
                            <li class="active">Edit Electrician</li>
                        </ol>
                    </div>
                </div>
                
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Edit Electrician Details</h4>
                                    
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Electrician Added Successfully.
                                    </div>
                                    <?php
								}
								//$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
								//$row = $profl->fetch_assoc()
								?>
								<?php
								$today = date('Y-m-d');
								$eleid=$_GET["eleid"];
								$cus = $conn->query("SELECT * FROM us_elec WHERE user_id='".$_SESSION["admin"]."' AND el_id='$eleid' AND el_isactive='0'");
								if($row=$cus->fetch_assoc())
								{
									?>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                                    	<input type="hidden" name="electid" value="<?= $eleid ?>">
										<table class="table">
										<td align="right"><input type="text" class="form-control" style="width: 110px; display: inline;" name="date" id="date" value="<?= date('d-M-Y') ?>"> &nbsp; 
                                            <input type="text" class="form-control" style="width: 70px; display: inline;" name="time" id="time" value="<?= date('H:i') ?>"></td>
											</table>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-3 control-label">Electrician Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" value="<?=$row["el_name"]?>" id="electrician_name" placeholder="Electrician Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Phone Number</label>
                                            <div class="col-sm-9">
                                                <input type="text"  class="form-control" value="<?=$row["el_phone"]?>" name="elec_phone"  id="elec_phone" placeholder="Phone Number">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="address"  id="elec_address" placeholder="Address"><?=$row["el_address"]?></textarea>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" value="<?=$row["el_email"]?>" id="customer_email" Placeholder="Email ID">
                                                
                                            </div>
                                        </div>
                                       <!-- <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">GSTIN</label>
                                            <div class="col-sm-9">
                                                <input type="tect" class="form-control" name="tin_number" value="<?=$row["cs_tin_number"]?>" id="tin_number" Placeholder="GSTIN">
                                                
                                            </div>
                                        </div>-->
										<!-- <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">State Code</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="statecode" id="statecode">
                                                	<option  <?php  if($row['cs_statecode']=='AN'){ ?> selected  <?php } ?> value="AN">Andaman and Nicobar Islands </option>
                                                    
											<option <?php  if($row['cs_statecode']=='AP'){ ?> selected  <?php } ?> value="AP">Andhra Pradesh</option>
											<option <?php  if($row['cs_statecode']=='AD'){ ?> selected  <?php } ?> value="AD">Andhra Pradesh (New)</option>
											<option <?php  if($row['cs_statecode']=='AR'){ ?> selected  <?php } ?> value="AR">Arunachal Pradesh</option>
											<option <?php  if($row['cs_statecode']=='AS'){ ?> selected  <?php } ?> value="AS">Assam</option>
											<option <?php  if($row['cs_statecode']=='BH'){ ?> selected  <?php } ?> value="BH">Bihar</option>
											<option <?php  if($row['cs_statecode']=='CH'){ ?> selected  <?php } ?> value="CH">Chandigarh</option>
											<option <?php  if($row['cs_statecode']=='CT'){ ?> selected  <?php } ?> value="CT">Chattisgarh</option>
											<option <?php  if($row['cs_statecode']=='DN'){ ?> selected  <?php } ?> value="DN">Dadra and Nagar Haveli</option>
											<option <?php  if($row['cs_statecode']=='DD'){ ?> selected  <?php } ?> value="DD">Daman and Diu</option>
										    <option <?php  if($row['cs_statecode']=='DL'){ ?> selected  <?php } ?> value="DL">Delhi</option>
											<option <?php  if($row['cs_statecode']=='GA'){ ?> selected  <?php } ?> value="GA">Goa</option>
											<option <?php  if($row['cs_statecode']=='GJ'){ ?> selected  <?php } ?> value="GJ">Gujarat</option>
											<option <?php  if($row['cs_statecode']=='HR'){ ?> selected  <?php } ?> value="HR">Haryana</option>
											<option <?php  if($row['cs_statecode']=='HP'){ ?> selected  <?php } ?> value="HP">Himachal Pradesh</option>
											<option <?php  if($row['cs_statecode']=='JK'){ ?> selected  <?php } ?> value="JK">Jammu and Kashmir</option>
											<option <?php  if($row['cs_statecode']=='JH'){ ?> selected  <?php } ?> value="JH">Jharkhand</option>
											<option <?php  if($row['cs_statecode']=='KA'){ ?> selected  <?php } ?> value="KA">Karnataka</option>
											<option <?php  if($row['cs_statecode']=='KL'){ ?> selected  <?php } ?> value="KL">Kerala</option>
										    <option <?php  if($row['cs_statecode']=='LD'){ ?> selected  <?php } ?> value="LD">Lakshadweep Islands</option>
											<option <?php  if($row['cs_statecode']=='MP'){ ?> selected  <?php } ?> value="MP">Madhya Pradesh</option>
											<option <?php  if($row['cs_statecode']=='MH'){ ?> selected  <?php } ?> value="MH">Maharashtra</option>
											<option <?php  if($row['cs_statecode']=='MN'){ ?> selected  <?php } ?> value="MN">Manipur</option>
											<option <?php  if($row['cs_statecode']=='ME'){ ?> selected  <?php } ?> value="ME">Meghalaya</option>
											<option <?php  if($row['cs_statecode']=='MI'){ ?> selected  <?php } ?> value="MI">Mizoram</option>
											<option <?php  if($row['cs_statecode']=='NL'){ ?> selected  <?php } ?> value="NL">Nagaland</option>
										    <option <?php  if($row['cs_statecode']=='OR'){ ?> selected  <?php } ?> value="OR">Odisha</option>
											<option <?php  if($row['cs_statecode']=='PY'){ ?> selected  <?php } ?> value="PY">Pondicherry</option>
											<option <?php  if($row['cs_statecode']=='PB'){ ?> selected  <?php } ?> value="PB">Punjab</option>
											<option <?php  if($row['cs_statecode']=='RJ'){ ?> selected  <?php } ?> value="RJ">Rajasthan</option>
											<option <?php  if($row['cs_statecode']=='SK'){ ?> selected  <?php } ?> value="SK">Sikkim</option>
											<option <?php  if($row['cs_statecode']=='TN'){ ?> selected  <?php } ?> value="TN">Tamil Nadu</option>
											<option <?php  if($row['cs_statecode']=='TS'){ ?> selected  <?php } ?> value="TS">Telangana</option>
											<option <?php  if($row['cs_statecode']=='TR'){ ?> selected  <?php } ?> value="TR">Tripura</option>
											<option <?php  if($row['cs_statecode']=='UP'){ ?> selected  <?php } ?> value="UP">Uttar Pradesh</option>
										    <option <?php  if($row['cs_statecode']=='UT'){ ?> selected  <?php } ?> value="UT">Uttarakhand</option>
											<option <?php  if($row['cs_statecode']=='WB'){ ?> selected  <?php } ?> value="WB">West Bengal</option>
														
                                                 </select>
                                                
                                            </div>
                                        </div>-->
										<!--<div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Balance Amount</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="balance" value="<?=$row["el_balance"]?>" id="balance" Placeholder="Balance Amount" required>
                                                
                                            </div>
                                        </div>-->
										
                                       
                                        
                                            
											<div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" onclick="return confirm('Do you want to Save?') " class="btn btn-primary">Save</button>
                                        </div>
                                     </form>
                                
                            </div>
							<?php }?>
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