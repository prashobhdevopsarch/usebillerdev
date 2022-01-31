<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	/*if(isset($_POST['submit']))
	{
		$shopid=$_POST['shopid'];
		$itemname=$_POST['name'];
		$unit=$_POST['unit'];
		$price=$_POST['price'];
		
		
		if($insert)
		{
			header('Location:customer.php?id=success');
	  }
	  else{
		  header('Location:customer.php?id=fail');
		}
	}*/
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
                    <h3><strong>Create Barcode</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
							<li class="active">Create Barcode</li>
                           
                        </ol>
                    </div>
                </div>
               <?php
				$today = date('Y-m-d');
				$stocks = $conn->query("SELECT * FROM us_products WHERE user_id='".$_SESSION['admin']."' ORDER BY pr_productcode ASC");
				
				
				?>
               
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Enter Barcode Details</h4>
                                    
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									if($_GET['id']=='success')
									{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Barcode Generated Successfully.
                                    </div>
                                    <?php
									}else{?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Barcode Generated Failed.
                                    </div>
                                    <?php }
								}
								$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
								$row = $profl->fetch_assoc()
								?>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="create.php">
                                    	<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                           <thead>
                                               <tr>
													<th></th>
                                                   <th>#</th>
                                                   <th>Product Code</th>
                                                   
												   <th>Product Name</th>
												   <th>Type</th>
                                                   <th>Selling Price</th>
                                                  <th></th>
												   
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   $today = date('Y-m-d');
											   $total=0;
											   if(mysqli_num_rows($stocks)>0)
											   {
												   $k = 1;
												   
												   while($row = $stocks->fetch_assoc())
												   {
											   ?>
                                              
                                               <tr>
                                               
                                                   <th scope="row">
												    
                                               <input type="checkbox" name="productid[]" id="productid<?= $row['pr_productid'] ?>" value="<?= $row['pr_productid'] ?>">
												   </th>
												   <td><?= $k ?></td>
                                                   <td><?= $row['pr_productcode'] ?> </td>
												   <td><?= $row['pr_productname'] ?> 
                                                   
                                                   </td>
                                                   <td><select name="type" id="type<?= $k ?>" class="form-control">
													<?php
													$type = $row['pr_type'];
													$sql1="SELECT * FROM us_catogory " ;
													$sql= $conn->query("$sql1");
                                        
													while($rowcat=$sql->fetch_assoc())
													{?>
                                                
													<option <?php
															if($rowcat["ca_categoryid"]==$type)
																{?>selected <?php }?> value="<?=$rowcat["ca_categoryid"]?>"><?=$rowcat["ca_categoryname"]?>
																
															</option>
													<?php }?>
													</select>
												   
                                                   
                                                   </td>
												   	
                                                   
                                                   
                                                   <td>
                                                       <?= $row['pr_saleprice'] ?>
                                                   </td>
                                                   <td><input type="text" name="cunt<?= $row['pr_productid'] ?>" value="<?= $row['pr_stock'] ?>"></td>
												   
                                                   
												   
													
                                               </tr>
                                               
                                               <?php
											   $k++;
												   }
											   }
											   ?>
						                  </tbody>
										  
                                        </table>
										<button type="submit" class="btn btn-primary" name="print_bar">Print</button>
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
}
else{
	header("Location:index.php");
}
?>