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
		$acc=$conn->query("SELECT se_debitid,se_creditid FROM us_ser WHERE se_billid='$bill_id'");
			$rowacc=$acc->fetch_assoc();
			$debitid= $rowacc["se_debitid"];
			$creditid= $rowacc["se_creditid"];
			$delet=$conn->query("DELETE FROM administrator_daybook WHERE bill_id='".$bill_id."' and credit='5'");
		$deletst=$conn->query("DELETE FROM us_stockreport WHERE billid='".$bill_id."' and sr_mode='Sales'");
		
		$delete=$conn->query("UPDATE us_ser SET se_isactive='1' WHERE se_billid='$bill_id'");
		$slct=$conn->query("update us_transaction set tr_isactive='1' where tr_billid='$bill_id' and tr_transactiontype='income'");
		
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
                    <h3><strong>Service Billing History</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Service Billing History</li>
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
							//$bill=$_POST['bill'];
							
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
                                	<a href="serviceexport.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> Print</button></a>
                                    <h4 class="panel-title">Service Billing History</h4>
                                </div>
                                
                                
                                <div class="panel-body">
                                <form action="servicebillreport.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
                                <?php
								
								if(isset($_POST['filter']))
											   {
												   $fromdate = $_POST['fromdate'];
												   $todate = $_POST['todate'];
												   $bil = $conn->query("SELECT * FROM us_ser WHERE DATE(se_billdate)>='$fromdate' AND DATE(se_billdate) <= '$todate' AND se_isactive='0' AND se_mod='1' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY se_billid DESC");
												   echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
											   }
											   else{
											   	$bil = $conn->query("SELECT * FROM us_ser WHERE se_isactive='0' AND se_mod='1' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY se_billid DESC");
												echo "<h3>ALL BILL DETAILS</h3>";
											   }
								?>
                                    <div class="table-responsive project-stats">  
									<a href="billinghistoryw.php" style="display:none;"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:left;"><span class=""></span>WHOLESALE</button></a><br><br>
                                    <form class="form-horizontal" method="post" action="servicehistory.php?fil=<?= $filt ?>">
                                    <button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button>
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                           <thead>
                                               <tr>
                                               		<th></th>
                                                   <th>#</th>
                                                   <th>Bill No</th>
                                                   <th>Bill Date</th>
                                                   <th>Customer Name</th>
                                                   <th>Phone</th>
												   
                                                   <th>Items</th>
                                                
                                                   <th>Total</th>
                                                  
                                                  
                                                   <th style="width:72px;">Action</th>
                                               
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
                                               <td> <input type="checkbox" name="bill[]" id="bill<?=$k?>" value="<?= $row['se_billid'] ?>"></td>
                                                   <?php echo $row['se_billid'] ?> 
                                                   <td scope="row">
												   <?= $k ?>
                                                   </td>
                                                   <td>Bill-<?= $row['se_billid'] ?></td>
                                                   <td>
                                                   <?= date('d-M-Y H:i', strtotime($row['se_billdate'])) ?>
                                                   </td>
                                                   <td><?php if($row['se_customerid']=='0'){ $csid=0; echo $row['se_customername'];}
												   else{
													   $slctcust=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row['se_customerid']."'");
														$rowcus=$slctcust->fetch_assoc();
													   echo $rowcus["cs_customername"];
													   $csid=$rowcus["cs_customerid"];
													   }?></td>
                                                   <td><?php if($row['se_customerid']=='0'){ echo $row['se_customermobile'];}else{echo $rowcus["cs_customerphone"];} ?></td>
												<!--  -->
												     
												 
                                                   
                                                   <td>
                                                   	<?php
													$billid = $row['se_billid'];
													$itms = $conn->query("SELECT * FROM us_seritem  WHERE se_billid='$billid'");
													$n=1;
													while($row2 = $itms->fetch_assoc())
													{
	
														echo $qty = $row2['se_quantity'];
	
														echo $n . ". " .$row2['se_item'] . ", <b>Unit Price:</b>" . $row2['se_price1'] .  "<br/>";
														$n++;
													}
													?>
                                                   </td>
												  
                                                   <td>
                                                       <?php
                                                       $amt3=0; 
                                                       $bill2=$conn->query("SELECT * FROM us_seritem a LEFT JOIN us_products b ON b.pr_productid=a.se_productid WHERE a.se_billid='$billid' LIMIT 15");
                                                       $tot=0;

                                                       while($row6=$bill2->fetch_assoc())
                                                           $amt3=$amt3+$row6['se_price1'];
                                                       echo $amt3;
                                                       
													   ?>
                                                   </td>
												  
                                                   <td>
												   <!-- <a href="bill_print_A5.php?billid=<?=$row['se_billid']?>&csid=<?=$csid?>&back=<?=$page?>"><span class="glyphicon glyphicon-print"></span> TAX print A5 </a><br>-->
												   
												   
                                                  <!-- <a href="bill_print_cus.php?billid=<?=$row['se_billid']?>"><span class="glyphicon glyphicon-print"></span> TAX print 8</a><br>-->
												   <a href="bill_print_AS.php?billid=<?=$row['se_billid']?>&csid=<?=$csid?>&back=<?=$page?>"><span class="glyphicon glyphicon-print"></span> SBill print</a><br>
                                                  <!--<a href="editbill.php?billid=<?=$row['se_billid']?>"><span class="glyphicon glyphicon-edit"></span> edit</a><br>-->
                                                  
                                                 <?php if($row['se_customerid']=='0') {?><a onClick="return confirm('Are you sure you want to delete?')" href="servicebillreport.php?billid=<?=$row['se_billid']?>&delete"><span class="glyphicon glyphicon-trash"></span> delete</a><?php }?> 
                                                   </td>
                                               </tr>
                                               
                                               <?php
											   $k++;
												   }
											   }
											   ?>
                                           </tbody>
                                        </table>
                                    </form>

                                    <table class="table">
                                        <tr>
                                            <td align="right"><strong>Total Amount:</strong></td>
                                            <td width="150">
                                            	<?= $gtotal ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Total Discount:</strong></td>
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