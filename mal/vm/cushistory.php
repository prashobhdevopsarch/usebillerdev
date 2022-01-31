<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['updateprdct']))
	{
		$productid = $_POST['productid'];
		$purchaseprice = $_POST['purchaseprice'];
		$saleprice = $_POST['saleprice'];
		$stock = $_POST['stock'];
		
		$updte = $conn->query("UPDATE vm_products SET pr_purchaseprice='$purchaseprice', pr_saleprice='$saleprice', pr_stock='$stock' WHERE pr_productid='$productid'");
		if($updte)
		{
			header('Location:stocks.php?id=success');
	  }
	  else{
		  header('Location:stocks.php?id=fail');
		}
	}
	if(isset($_GET["delet"]))
	{
		$cusid=$_GET["cusid"];
		$delete=$conn->query("DELETE FROM vm_customer WHERE cs_customerid='$cusid'");
		if($delete)
		{
			header('Location:cushistory.php?id=success');
		}else{
		  header('Location:cushistory.php?id=fail');
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
                    <h3><strong>കസ്റ്റമർ ലിസ്റ്റ്</strong></h3><br>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>ബില്ലിംഗ്</li>
							<li>കസ്റ്റമർ മാനേജ്മെൻറ്</li>
                            <li class="active">കസ്റ്റമർ ലിസ്റ്റ്</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				$stocks = $conn->query("SELECT * FROM vm_products ORDER BY pr_productid ASC");
				$outstocks = $conn->query("SELECT * FROM vm_products WHERE pr_stock < 5");
				
				?>
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                            <?php
							if(isset($_POST['filter']))
							{
								$fromdate = $_POST['fromdate'];
								$todate = $_POST['todate'];
								$filt = $fromdate . "$" . $todate;
							}
							else{
								$filt = "all";
							}
							?>
                                <div class="panel-heading">
								 <h4 class="panel-title">കസ്റ്റമർ ലിസ്റ്റ്</h4>
                                	<a href="customer.php"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right"><i class="fa fa-plus"></i> ആഡ് ന്യൂ കസ്റ്റമർ </button></a>
                                   <a href="customerprint.php?limit" id="alimit"><button type="button"  class="btn btn-primary btn-addon m-b-sm" style="float:right; margin-right:15px;height:40px;"><span class="glyphicon glyphicon-print"></span> കസ്റ്റമർ പ്രിൻറ്</button></a>
								   <input style="float:right;margin-right:1px;height:35px;width:90px;" type="number" min="1" id="limitcus"  onKeyup="limitcusomer(this.value)" >
                                </div>
                                
                                <hr>
                                <div class="panel-body">
                                
                                <?php
								if(isset($_POST['filter']))
											   {
												   $fromdate = $_POST['fromdate'];
												   $todate = $_POST['todate'];
												   $bil = $conn->query("SELECT * FROM vm_customer WHERE DATE(cs_billdate)>='$fromdate' AND DATE(cs_billdate) <= '$todate' AND cs_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY cs_customerid DESC");
												   echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
											   }
											   else{
											   	$bil = $conn->query("SELECT * FROM vm_customer WHERE cs_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY cs_customerid DESC");
												echo "<h3>ഓൾ കസ്റ്റമർ ഡീറ്റെയിൽസ്</h3>";
											   }
								?>
                                    <div class="table-responsive project-stats">  
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>കസ്റ്റമർ ഐഡി</th>
                                                   <!--<th>Bill Date</th>-->
                                                   <th>കസ്റ്റമർ നെയിം</th>
                                                   <th>ഫോൺ</th>
												
                                                  <th>അഡ്രസ്സ്</th>
												   
												  <th>ബാലൻസ്</th>
												  
                                                   <th>ആക്ഷൻ</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   
											   $totalamnt = 0;
											   $today = date('Y-m-d');
											   if(mysqli_num_rows($bil)>0)
											   {
												   $k = 1;
												   while($row = $bil->fetch_assoc())
												   {
											   ?>
                                              
                                               <tr>
                                                   <th scope="row">
												   <?= $k ?>
                                                   </th>
                                                   <td><?= $row['cs_customerid'] ?></td>
                                                   
                                                   <td><?= $row['cs_customername'] ?></td>
                                                   <td><?= $row['cs_customerphone'] ?></td>
                                                  <td><?=$row['cs_address']?></td>
                                                   	<td><?php 
													
                                                   /*$balance=$conn->query("SELECT SUM(be_balance) AS totbal FROM vm_billentry WHERE user_id='".$_SESSION["admin"]."' AND be_isactive='0' AND be_customerid='".$row['cs_customerid']."'");
												$row1=$balance->fetch_assoc();*/
												echo $row['cs_balance'];
												$totalamnt=$totalamnt+$row['cs_balance'];
                                                   
												   
												  ?> 
												   
												  </td>
												  
												   
                                                   <td><a href="view.php?csid=<?=$row['cs_customerid']?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;വ്യൂ </a> <br><a href="editcustomer.php?cusid=<?=$row['cs_customerid']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;എഡിറ്റ്</a>
												   <br><a onClick="return confirm('ആർ യു ഷുവർ യു വാണ്ട് റ്റു ഡിലീറ്റ്?')" href="cushistory.php?cusid=<?=$row['cs_customerid']?>&delet"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;ഡിലീറ്റ്</a>
                                                   
                                                   </td>
                                               </tr>
                                               
                                               <?php
											   $k++;
												   }
											   }
											   ?>
                                           </tbody>
                                        </table>
                                        <table class="table">
                                            <tr>
                                            <td align="right"><strong> ടോട്ടൽ എമൗണ്ട് :</strong></td>
                                            <td width="150">
                                            	<?= $totalamnt ?>
                                            </td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Main Wrapper -->
                <?php
				include("includes/footer.php");
				include("includes/popup.php");
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
<script>
function limitcusomer(limit)
{
	
	document.getElementById("alimit").href = "customerprint.php?limit="+limit;
	
}
</script>
</html>
<?php
}else{
	header("Location:index.php");
}
?>