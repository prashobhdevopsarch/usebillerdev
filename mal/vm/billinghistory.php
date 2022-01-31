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
	if(isset($_GET["delete"]))
	{
		$bill_id=$_GET["billid"];
		$delete=$conn->query("UPDATE vm_billentry SET be_isactive='1' WHERE be_billid='$bill_id'");
		$slct=$conn->query("update vm_transaction set tr_isactive='1' where tr_billid='$bill_id' and tr_transactiontype='income'");
		if($delete && $slct)
		{
			
			$updatstk=updatestock($conn,$bill_id,'',$_SESSION["admin"]);
			echo $updatstk;
			if($updatstk=="succ")
			
			{
			header('Location:billinghistory.php?id=success');
			}
				
			
			else{header('Location:billinghistory.php?id=fail');}
		}else{
		  header('Location:billinghistory.php?id=fail');
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
                    <h3><strong>ബില്ലിംഗ് ഹിസ്റ്ററി</strong></h3><br>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>ബില്ലിംഗ്</li>
                            <li class="active">ബില്ലിംഗ് ഹിസ്റ്ററി</li>
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
                                	<a href="exporthistory.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> പ്രിൻറ്</button></a>
                                    <h4 class="panel-title">ബില്ലിംഗ് ഹിസ്റ്ററി</h4>
                                </div>
                                
                                
                                <div class="panel-body">
                                <form action="billinghistory.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">ഫിൽറ്റർ </button>
                                </form>
                                <?php
								if(isset($_POST['filter']))
											   {
												   $fromdate = $_POST['fromdate'];
												   $todate = $_POST['todate'];
												   $bil = $conn->query("SELECT * FROM vm_billentry WHERE DATE(be_billdate)>='$fromdate' AND DATE(be_billdate) <= '$todate' AND be_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY be_billid DESC");
												   echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
											   }
											   else{
											   	$bil = $conn->query("SELECT * FROM vm_billentry WHERE be_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY be_billid DESC");
												echo "<h3>ഓൾ ബിൽ ഡീറ്റെയിൽസ്</h3>";
											   }
								?>
                                    <div class="table-responsive project-stats">  
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>ബിൽ നം</th>
                                                   <th>ബിൽ ഡേറ്റ്</th>
                                                   <th>കസ്റ്റമർ നെയിം</th>
                                                   <th>ഫോൺ</th>
                                                   <th>ഐറ്റംസ് </th>
                                                   <th>ടോട്ടൽ</th>
                                                   <th>കൂലി</th>
												   <th>ഡിസ്‌കൗണ്ട്</th>
                                                   <th>ഗ്രാൻറ് ടോട്ടൽ</th>
                                                   <th style="width:72px;">ആക്ഷൻ </th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   $gtotal=0;
											   $totaldis=0;
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
                                                   <td><?= $row['be_billnumber'] ?></td>
                                                   <td>
                                                   <?= date('d-M-Y H:i', strtotime($row['be_billdate'])) ?>
                                                   </td>
                                                   <td><?php if($row['be_customerid']=='0'){ $csid=0; echo $row['be_customername'];}
												   else{
													   $slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row['be_customerid']."'");
														$rowcus=$slctcust->fetch_assoc();
													   echo $rowcus["cs_customername"];
													   $csid=$rowcus["cs_customerid"];
													   }?></td>
                                                   <td><?php if($row['be_customerid']=='0'){ echo $row['be_customermobile'];}else{echo $rowcus["cs_customerphone"];} ?></td>
                                                   <td>
                                                   	<?php
													$billid = $row['be_billid'];
													$itms = $conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
													$n=1;
													while($row2 = $itms->fetch_assoc())
													{
														echo $n . ". " .$row2['pr_productname'] . ", <b>Unit Price:</b>" . $row2['bi_price'] . ", <b>Qty:</b>" . $row2['bi_quantity'] . ", <b>Total:</b>" . $row2['bi_total'] . "<br/>";
														$n++;
													}
													?>
                                                   </td>
												   
                                                   <td>
                                                       <?php
													   echo $row['be_total'];
													   $totalamnt = $totalamnt + $row['be_total'];
													   ?>
                                                   </td>
												   <td><?= $row['be_coolie'] ?></td>
                                                   <td><?php
													   echo $row['be_discount'];
													   $totaldis = $totaldis + $row['be_discount'];
													   ?></td>
												   <td><?php
													   $total = $row['be_total']+$row['be_coolie']-$row['be_discount'];
													   $gtotal = $gtotal + $total;
													   echo $total;
													   ?></td>
                                                   <td><a href="bill_print.php?billid=<?=$row['be_billid']?>&csid=<?=$csid?>&back=<?=$page?>"><span class="glyphicon glyphicon-print"></span> ടാക്‌സ് പ്രിൻറ് </a><br><br>
                                                  <!-- <a href="bill_print_cus.php?billid=<?=$row['be_billid']?>"><span class="glyphicon glyphicon-print"></span> TAX print 8</a><br>-->
												   <a href="bill_print_cus1.php?billid=<?=$row['be_billid']?>&csid=<?=$csid?>&back=<?=$page?>"><span class="glyphicon glyphicon-print"></span> ബിൽ പ്രിൻറ്</a><br><br>
                                                  <!-- <a href="editbill.php?billid=<?=$row['be_billid']?>"><span class="glyphicon glyphicon-edit"></span> എഡിറ്റ്</a><br> -->
                                                 <?php if($row['be_customerid']=='0') {?><a onClick="return confirm('ആർ യു ഷുവർ യു വാണ്ട് റ്റു ഡിലീറ്റ്?')" href="billinghistory.php?billid=<?=$row['be_billid']?>&delete"><span class="glyphicon glyphicon-trash"></span> ഡിലീറ്റ് </a><?php }?> 
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
                                            <td align="right"><strong>ടോട്ടൽ എമൗണ്ട്:</strong></td>
                                            <td width="150">
                                            	<?= $gtotal ?>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td align="right"><strong>ടോട്ടൽ ഡിസ്‌കൗണ്ട്:</strong></td>
                                            <td width="150">
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