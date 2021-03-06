<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$company_name = $_POST['company_name'];
		$supplier_name = $_POST['supplier_name'];
		$supplier_phone = $_POST['supplier_phone'];
		$supplier_address = $_POST['supplier_address'];
		$supplier_email = $_POST['supplier_email'];
		$tin_number = $_POST["tin_number"];
		$statecode=$_POST['statecode'];
		$balance=$_POST["balance"];
		
		
		//echo print_r($_POST);
		$insert = $conn->query("INSERT INTO vm_supplier(rs_company_name, rs_name, rs_phone, rs_address, rs_email, user_id, rs_balance, rs_tinnum, rs_statecode) VALUES('$company_name','$supplier_name','$supplier_phone','$supplier_address','$supplier_email','".$_SESSION["admin"]."', '$balance', '$tin_number', '$statecode')");
		if($insert)
		{
			header('Location:supplierlist.php?id=success');
	  }
	  else{
		  header('Location:supplierlist.php?id=fail');
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
                    <h3><strong>????????? ??????????????????</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>???????????????????????????</li>
							<li>?????????????????? ?????????????????????????????????</li>
                            <li class="active">????????? ??????????????????</li>
                        </ol>
                    </div>
                </div>
               
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">????????? ?????????????????? ?????????????????????????????????</h4>
                                    
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									if($_GET['id']=='success')
									{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">??</span></button>
										?????????????????? ???????????? ????????????????????????????????????????????????.
                                    </div>
                                    <?php
									}else{?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">??</span></button>
											?????????????????? ????????? ?????????????????????.
                                    </div>
                                    <?php }
								}
								//$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
								//$row = $profl->fetch_assoc()
								?>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                                    	
										
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-3 control-label">?????????????????? ???????????????</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="company_name" value="" id="company_name" placeholder="?????????????????? ???????????????" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-3 control-label">?????????????????? ???????????????</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="supplier_name" value="" id="supplier_name" placeholder="?????????????????? ???????????????" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">????????? ???????????????</label>
                                            <div class="col-sm-9">
                                                <input type="text"  class="form-control" name="supplier_phone"  id="supplier_phone" placeholder="????????? ???????????????">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">????????????????????????</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="supplier_address" value="" id="supplier_address" placeholder="????????????????????????"></textarea>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">??????????????????</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="supplier_email" value="" id="supplier_email" Placeholder="?????????????????? ?????????">
                                                
                                            </div>
                                        </div>
                                        
                                       <div class="form-group">
                                             <label for="input-help-block" class="col-sm-3 control-label">??????????????? ?????????</label>
                                            <div class="col-sm-9">
                                                <input type="tect" class="form-control" name="tin_number" value="" id="tin_number" Placeholder="??????????????? ?????????">
                                                
                                            </div>
                                        </div>
										 <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">?????????????????????????????? ????????????</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="statecode" id="statecode" required>
												 <option value="">-select</option> 
                                               <option value="AN">Andaman and Nicobar Islands </option>
                                                <option value="AP">Andhra Pradesh</option>
											<option value="AD">Andhra Pradesh (New)</option>
											<option value="AR">Arunachal Pradesh</option>
											<option value="AS">Assam</option>
											<option value="BH">Bihar</option>
											<option value="CH">Chandigarh</option>
											<option value="CT">Chattisgarh</option>
											<option value="DN">Dadra and Nagar Haveli</option>
											<option value="DD">Daman and Diu</option>
										    <option value="DL">Delhi</option>
											<option value="GA">Goa</option>
											<option value="GJ">Gujarat</option>
											<option  value="HR">Haryana</option>
											<option value="HP">Himachal Pradesh</option>
											<option value="JK">Jammu and Kashmir</option>
											<option value="JH">Jharkhand</option>
											<option value="KA">Karnataka</option>
											<option value="KL">Kerala</option>
										    <option value="LD">Lakshadweep Islands</option>
											<option value="MP">Madhya Pradesh</option>
											<option value="MH">Maharashtra</option>
											<option value="MN">Manipur</option>
											<option value="ME">Meghalaya</option>
											<option value="MI">Mizoram</option>
											<option value="NL">Nagaland</option>
										    <option value="OR">Odisha</option>
											<option value="PY">Pondicherry</option>
											<option value="PB">Punjab</option>
											<option value="RJ">Rajasthan</option>
											<option value="SK">Sikkim</option>
											<option value="TN">Tamil Nadu</option>
											<option value="TS">Telangana</option>
											<option value="TR">Tripura</option>
											<option value="UP">Uttar Pradesh</option>
										    <option value="UT">Uttarakhand</option>
											<option value="WB">West Bengal</option>
														
                                                 </select>
                                                
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">?????????????????? ?????????????????????</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="balance" value="" id="balance" Placeholder="?????????????????? ?????????????????????">
                                                
                                            </div>
                                        </div>
										
                                       
                                        
                                            
											<div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" class="btn btn-primary">????????????</button>
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