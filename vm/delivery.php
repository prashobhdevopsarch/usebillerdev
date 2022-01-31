<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$billid = $_POST['bs_billid'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone = $_POST['cutomer_phone'];
		$docket_number = $_POST['docket_number'];
		$date = $_POST['date'];
		$invoice = $_POST['invoice_number'];
		$Delivery_date = $_POST['Delivery_date'];
		
		
    
        
		
		$insert = $conn->query("INSERT INTO us_delivery(bs_customer,bs_phone,bs_address,bs_Docket,bs_date,	bs_billnumber,bs_delivery,user_id) VALUES('$name','$phone','$address','$docket_number','$date','$invoice','$Delivery_date','".$_SESSION["admin"]."')");
    if($insert)
		{
			header('Location:bill_print_A456.php?billid=$billid&id=success');
	  }
	  else{
		  header('Location:delivery.php?id=fail');
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
             <?php
				
				if(isset($_GET['billno']))
				{
					$billno = $_GET['billno'];
				}
				else{
					$stocks = $conn->query("SELECT * FROM us_delivery WHERE user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."'  ORDER BY 	bs_billid DESC LIMIT 1");
					if(mysqli_num_rows($stocks)>0)
					{
						$row = $stocks->fetch_assoc();
						$billno = $row['bs_billid'] + 1;
					}
					else{
						$billno = 1;
					}
				}
				
				?>
             <div class="page-inner">
                <div class="page-title">
                    <h3><strong>Delivery Note</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
							<li>Customer Management</li>
                            <li class="active">Delivery Note</li>
                        </ol>
                    </div>
                </div>
            <!-- Page Sidebar -->
            
                
                         
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Delivery Note:</h4>
                                    <input type="text" class="form-control" name="billno" id="billno" value="<?= $billno ?>" style="width:50px;border: 0;font-size: 20px;background: white"><br><br>
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									if($_GET['id']=='success')
									{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Delivery note  Added Successfully.
                                    </div>
                                    <?php
									}else{?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        delivery note Add Failed.
                                    </div>
                                    <?php }
								}
								//$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
								//$row = $profl->fetch_assoc()
								?>
                                
                                      <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                                    	<input type="hidden" name="bs_devno" value="<?= $row['bs_devno'] ?>">
										<!--<table class="table">
										<td align="right"><input type="text" class="form-control" style="width: 110px; display: inline;" name="date" id="date" value="<?= date('d-M-Y') ?>"> &nbsp; 
                                            <input type="text" class="form-control" style="width: 70px; display: inline;" name="time" id="time" value="<?= date('H:i') ?>"></td>
											</table>-->
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-3 control-label">Customer Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" value="" id="customer_name" placeholder="Customer Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Phone Number</label>
                                            <div class="col-sm-9">
											
                                             <input type="text" class="form-control" name="cutomer_phone"  id="cutomer_phone" placeholder="Phone Number">    
                                              
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Date</label>
                                            <div class="col-sm-9">
											
                                            <input type="text" class="form-control" style="width: 110px; display: inline;" name="date" id="date" value="<?= date('yy/m/d') ?>">
                                              
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="address" value="" id="customer_address" placeholder="Address"></textarea>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Docket Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="docket_number" value="" id="docket_number" Placeholder="Docket Number">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Invoice Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="invoice_number" value="" id="invoice_number" Placeholder="Invoice number">
                                                
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Delivery Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="Delivery_date" value="0" id="Delivery_date" Placeholder="Balance Amount">
                                                
                                            </div>
                                        </div>
										
                                       
                                        
                                            
											<div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" onclick="return confirm('Do you want to Save?') " class="btn btn-primary">Save and print</button>
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