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
		$acc=$conn->query("SELECT be_debitid,be_creditid FROM us_billentry WHERE be_billid='$bill_id'");
			$rowacc=$acc->fetch_assoc();
			$debitid= $rowacc["be_debitid"];
			$creditid= $rowacc["be_creditid"];
		if($debitid!="")
			{
			$delet2=$conn->query("DELETE FROM administrator_daybook WHERE refid='".$debitid."'");
			}
			if($creditid!="")
			{
			$delet3=$conn->query("DELETE FROM administrator_daybook WHERE refid='".$creditid."'");
			}
		$delete=$conn->query("UPDATE us_billentry SET be_isactive='1' WHERE be_billid='$bill_id'");
		$slct=$conn->query("update us_transaction set tr_isactive='1' where tr_billid='$bill_id' and tr_transactiontype='income'");
		
		if($delete && $slct)
		{
			
			$updatstk=updatestock($conn,$bill_id,'',$_SESSION["admin"]);
			echo $updatstk;
			if($updatstk=="succ")
			
			{
			header('Location:cashsale.php?id=success');
			}
				
			
			else{header('Location:cashsale.php?id=fail');}
		}else{
		  header('Location:cashsale.php?id=fail');
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
                    <h3><strong>Cash Sale Reports</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Cash Sale Reports</li>
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
                                	<!--<a href="exporthistory1.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> Print</button></a>-->
                                    <h4 class="panel-title">Cash Sale Reports</h4>
                                </div>
                                
                                
                                <div class="panel-body">
                                <form action="cashsale.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
                                <?php
								
								if(isset($_POST['filter']))
											   {
												   $fromdate = $_POST['fromdate'];
												   $todate = $_POST['todate'];
												   $bil = $conn->query("SELECT * FROM us_billentry WHERE DATE(be_billdate)>='$fromdate' AND DATE(be_billdate) <= '$todate' AND be_isactive='0' AND be_balance=0 AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY be_billid DESC");
												   echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
											   }
											   else{
											   	$bil = $conn->query("SELECT * FROM us_billentry WHERE be_isactive='0' AND be_balance=0 AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY be_billid DESC");
												echo "<h3>ALL CASH SALE DETAILS</h3>";
											   }
								?>
                                    <div class="table-responsive project-stats">  
									<a href="creditsale.php" ><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:left;"><span class=""></span>CREDIT SALE</button></a><br><br>
                                    <form class="form-horizontal" method="post" action="exporthistory.php?fil=<?= $filt ?>">
                                    <!--<button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button>-->
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                           <thead>
                                               <tr>
                                               		<th></th>
                                                   <th>#</th>
                                                   <th>Bill No</th>
                                                    <th>Type</th>
                                                   <th>Bill Date</th>
                                                   <th>Customer Name</th>
                                                   <th>Phone</th>
                                                   <th>Items</th>
                                                   <th>GST</th>
                                                   <th>Total</th>
                                                   <th>Coolie</th>
												   <th>Discount</th>
                                                   <th>Grant Total</th>
                                                   <th style="width:72px; display: none;">Action</th>
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
                                               <td> <input type="checkbox" name="bill[]" id="bill<?=$k?>" value="<?= $row['be_billid'] ?>"></td>
                                                   <th scope="row">
												   <?= $k ?>
                                                   </th>
                                                   <td><?= $row['be_billnumber'] ?></td>
                                                   <td><?php if($row['be_mod'] == 1){
                                                   	echo "RETAIL";
                                                   }
                                                   else{
                                                   		echo "WHOLESALE";
                                                   } ?></td>
                                                   <td>
                                                   <?= date('d-M-Y H:i', strtotime($row['be_billdate'])) ?>
                                                   </td>
                                                   <td><?php if($row['be_customerid']=='0'){ $csid=0; echo $row['be_customername'];}
												   else{
													   $slctcust=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row['be_customerid']."'");
														$rowcus=$slctcust->fetch_assoc();
													   echo $rowcus["cs_customername"];
													   $csid=$rowcus["cs_customerid"];
													   }?></td>
                                                   <td><?php if($row['be_customerid']=='0'){ echo $row['be_customermobile'];}else{echo $rowcus["cs_customerphone"];} ?></td>
                                                   <td>
                                                   	<?php
													$billid = $row['be_billid'];
													$itms = $conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
													$n=1;
													while($row2 = $itms->fetch_assoc())
													{
														
														
	
	echo $qty = $row2['bi_quantity'];
		
	
	
	
														echo $n . ". " .$row2['pr_productname'] . ", <b>Unit Price:</b>" . $row2['bi_price'] . ", <b>Qty:</b>" . $qty . ", <b>Total:</b>" . $row2['bi_total'] . "<br/>";
														$n++;
													}
													?>
                                                   </td>
												   <td>
                                                      <?php
													  
													  
													  
													  $gst = $conn->query("SELECT SUM(bi_cgst_amt) AS cgst  FROM us_billitems  WHERE bi_billid='$billid'");
													  $rowgst=$gst->fetch_assoc();
													  
													  $cgst=$rowgst['cgst'];
													  
													  $gst1 = $conn->query("SELECT SUM(bi_sgst_amt) AS sgst  FROM us_billitems  WHERE bi_billid='$billid'");
													  $rowgst1=$gst1->fetch_assoc();
													  $sgst=$rowgst1['sgst'];
													  
													  $gst2 = $conn->query("SELECT SUM(bi_igst_amt) AS igst  FROM us_billitems  WHERE bi_billid='$billid'");
													  $rowgst2=$gst2->fetch_assoc();
													  $igst=$rowgst2['igst'];
													  
													  
													  
													  
													    $totgst = $rowgst['cgst']+$rowgst1['sgst']+$rowgst2['igst'];
														
														 echo round($totgst, 2); 
													  
													  
													  
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
													   $total = $row['be_gtotal']+$row['be_coolie'];
													   $gtotal = $gtotal + $total;
													   echo $total;
													   ?></td>
                                                   <td style="display: none;"><a href="bill_print.php?billid=<?=$row['be_billid']?>&csid=<?=$csid?>&back=<?=$page?>"><span class="glyphicon glyphicon-print"></span> TAX print </a><br>
                                                  <!-- <a href="bill_print_cus.php?billid=<?=$row['be_billid']?>"><span class="glyphicon glyphicon-print"></span> TAX print 8</a><br>-->
												   <a href="bill_print_cus1.php?billid=<?=$row['be_billid']?>&csid=<?=$csid?>&back=<?=$page?>"><span class="glyphicon glyphicon-print"></span> Bill print</a><br>
                                                  <a href="editbill.php?billid=<?=$row['be_billid']?>"><span class="glyphicon glyphicon-edit"></span> edit</a><br>
                                                 <?php if($row['be_customerid']=='0') {?><a onClick="return confirm('Are you sure you want to delete?')" href="cashsale.php?billid=<?=$row['be_billid']?>&delete"><span class="glyphicon glyphicon-trash"></span> delete</a><?php }?> 
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
          <!--<?php include('includes/cssscript.php');?>-->
       
        
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>