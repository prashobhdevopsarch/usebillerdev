<?php
session_start();
if(isset($_SESSION['admin']) && !isset($_SESSION['staf']))
{
	include("includes/config.php");
	if(isset($_POST['updateprdct']))
	{
		$productid = $_POST['productid'];
		$purchaseprice = $_POST['purchaseprice'];
		$saleprice = $_POST['saleprice'];
		$stock = $_POST['stock'];
		
		$updte = $conn->query("UPDATE us_products SET pr_purchaseprice='$purchaseprice', pr_saleprice='$saleprice', pr_stock='$stock' WHERE pr_productid='$productid'");
		if($updte)
		{
			header('Location:stocks.php?id=success');
	  }
	  else{
		  header('Location:stocks.php?id=fail');
		}
	}
	if(isset($_GET["delete"]))
	{
		$bill_id=$_GET["billid"];
    $delet=$conn->query("DELETE FROM administrator_daybook WHERE bill_id='".$bill_id."' and credit='46'");

$deletst=$conn->query("DELETE FROM us_stockreport WHERE billid='".$bill_id."' and sr_mode='PurchaseReturn'");
		$delete=$conn->query("UPDATE  us_purreturnentry SET pre_isactive='1' WHERE pre_billid='$bill_id'");
		$slct=$conn->query("update us_transaction set tr_isactive='1' where tr_billid='$bill_id' and tr_transactiontype='expense'");
		
		if($delete && $slct)
		{
			$updatstk1=updatestockp($conn,$bill_id,'',$_SESSION["admin"]);
			echo $updatstk1;
			if($updatstk1=="succ")
			
			{
			header('Location:purchasereturnhistory.php?id=success');
			}
		}else{
		  header('Location:purchasereturnhistory.php?id=fail');
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
                    <h3><strong>Purchase Return History</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Purchase Return History</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				$stocks = $conn->query("SELECT * FROM us_products ORDER BY pr_productid ASC");
				$outstocks = $conn->query("SELECT * FROM us_products WHERE pr_stock < 5");
				
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
                                	<a href="exportpurchasereturn.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> Print</button></a>
                                    
                                    <h4 class="panel-title">Purchase Return History</h4>
                                </div>
                                
                                
                                <div class="panel-body">
                                <form action="purchasereturnhistory.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
                                <?php
								if(isset($_POST['filter']))
											   {
												   $fromdate = $_POST['fromdate'];
												   $todate = $_POST['todate'];
												   $bil = $conn->query("SELECT * FROM  us_purreturnentry a LEFT JOIN us_supplier b ON b.rs_supplierid=a.pre_customerid WHERE DATE(a.pre_billdate)>='$fromdate' AND DATE(a.pre_billdate) <= '$todate' AND a.pre_isactive='0'AND a.user_id='".$_SESSION["admin"]."' and a.finyear = '".$_SESSION["finyearid"]."' ORDER BY a.pre_billid DESC");
												   echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
											   }
											   else{
											   	$bil = $conn->query("SELECT * FROM us_purreturnentry a LEFT JOIN us_supplier b ON b.rs_supplierid=a.pre_customerid WHERE a.pre_isactive='0' AND a.user_id='".$_SESSION["admin"]."' and a.finyear = '".$_SESSION["finyearid"]."' ORDER BY a.pre_billid DESC");
												echo "<h3>ALL PURCHASE RETURN DETAILS</h3>";
											   }
								?>
                                    <div class="table-responsive project-stats">
                                    <form class="form-horizontal" method="post" action="exportpurchasereturn1.php?fil=<?= $filt ?>">
                                    <button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button></form>
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Bill No</th>
                                                   <th>Bill Date</th>
                                                   <th>Supplier Name</th>
                                                   <th>Phone</th>
												    <th>Return Bill No</th>
                                                   <th>Items</th>
                                                   <th>Total Amount</th>
                                                   <th>Discount</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   
											   $totalamnt = 0;
											   $totaldis=0;
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
                                                   <td><?= $row['pre_billnumber'] ?></td>
                                                   <td>
                                                   <?= date('d-M-Y H:i', strtotime($row['pre_billdate'])) ?>
                                                   </td>
                                                   <td><?= $row['rs_company_name']." ( ".$row['rs_name']." )" ?></td>
                                                   <td><?= $row['rs_phone'] ?></td>
                                                   <td><?= $row['pre_rebill'] ?></td>
												  <td>
                                                   	<?php
													$billid = $row['pre_billid'];
													$itms = $conn->query("SELECT * FROM  us_purreturnitem a LEFT JOIN us_products b ON b.pr_productid=a.pri_productid WHERE a.pri_billid='$billid'");
													$n=1;
													while($row2 = $itms->fetch_assoc())
													{
														echo $n . ". " .$row2['pr_productname'] . ", <b>Unit Price:</b>" . $row2['pri_price'] . ", <b>Qty:</b>" . $row2['pri_quantity'] . ", <b>Total:</b>" . $row2['pri_total'] . "<br/>";
														$n++;
													}
													?>
                                                   </td>
                                                   <td>
                                                       <?php
													   echo $row['pre_total'];
													   $totalamnt = $totalamnt + $row['pre_total'];
													   ?>
                                                   </td>
                                                   <td><?php
													   echo $row['pre_discount'];
													   $totaldis = $totaldis + $row['pre_discount'];
													   ?></td>
                                                 <!--   <td><a href="purchasereturn_print.php?billid=<?=$row['pre_billid']?>"><span class="glyphicon glyphicon-print"></span> print</a><br> -->
												   <td><a href="purchasereturn_print.php?billid=<?=$row['pre_billid']?>&back=<?=$page?>"><span class="glyphicon glyphicon-print"></span>print</a><br>
                                                 <!--  <a href=".php?billid=<?=$row['pre_billid']?>"><span class="glyphicon glyphicon-edit"></span> edit</a>-->
                                                  <a onClick="return confirm('Are you sure you want to delete?')" href="purchasereturnhistory.php?billid=<?=$row['pre_billid']?>&delete"><span class="glyphicon glyphicon-trash"></span> delete</a>
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
                                            <td align="right"><strong>Total Amount:</strong></td>
                                            <td width="150" align="right">
                                            	<?= $totalamnt ?>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td align="right"><strong>Total Discount:</strong></td>
                                            <td width="150" align="right">
                                            	<?= $totaldis ?>
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
        <script src="assets/plugins/3d-bold-navigation/sjs/main.js"></script>
        <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/moment/moment.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
       <!-- <?php include('includes/cssscript.php');?> -->
     
        
    </body>

</html>
<?php
}else{
	header("Location:../index.php");
}
?>