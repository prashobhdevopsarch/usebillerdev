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
		$delete=$conn->query("UPDATE us_salreturnentry SET sre_isactive='1' WHERE sre_billid='$bill_id'");
		$slct=$conn->query("update us_transaction set tr_isactive='1' where tr_billid='$bill_id' and tr_transactiontype='expense'");
		
		if($delete && $slct)
		{
			$updatstk1=updatestockp($conn,$bill_id,'',$_SESSION["admin"]);
			echo $updatstk1;
			if($updatstk1=="succ")
			
			{
			header('Location:allsale.php?id=success');
			}
		}else{
		  header('Location:allsale.php?id=fail');
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
                    <h3><strong>TOTAL SALE REPORT</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">TOTAL SALE REPORT</li>
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
							  $years = $_POST['fyear'];
							}
							else{
								$filt = "all";
							}
							?>
                                <div class="panel-heading">
                                	
                                 <a href="reports.php" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="fa fa-backward"></span> Back</button></a>-->
                                    
                                    <h4 class="panel-title">TOTAL SALE REPORT</h4>
                                </div>
                                
                                
                                <div class="panel-body">
                                <form action="allsale.php" method="post">
                                    <select class="form-control"  name="fyear" style="width: 150px;">
  
                                         <?php  
                                        $fyear1= $conn->query("SELECT * FROM us_financialyear ");
                                        while($rowcat=$fyear1->fetch_assoc()) 
                    {
                    ?>
                  <option <?php if($rowcat['fy_default']=='1'){ ?> selected  <?php } ?>  value="<?= $rowcat['fy_id']?>"><?= $rowcat['fy_name']?></option>
                  <?php } ?>
</select>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-addon m-b-sm" name="filter">Filter</button>
                                </form>
                                <?php
								if(isset($_POST['filter']))
											   {
												   $years = $_POST['fyear'];
												   $bil = $conn->query("SELECT count(`be_billnumber`) as cnt,SUM(`be_gtotal`) as sm,EXTRACT(YEAR FROM be_billdate) as yr,EXTRACT(MONTH FROM be_billdate) as mnth FROM us_billentry WHERE be_isactive='0'  and finyear='$years' Group BY EXTRACT(MONTH FROM be_billdate),EXTRACT(YEAR FROM be_billdate) ORDER BY be_billdate DESC");


                            $bil1 = $conn->query("SELECT count(`be_billnumber`) as cnt,SUM(`be_gtotal`) as sm FROM us_billentry WHERE be_isactive='0'  and finyear='$years' and be_balance>0  ORDER BY be_billdate DESC"); 

                             $bil2 = $conn->query("SELECT count(`be_billnumber`) as cnt,SUM(`be_gtotal`) as sm FROM us_billentry WHERE be_isactive='0'  and finyear='$years' and be_balance=0  ORDER BY be_billdate DESC");


												     //echo "<h3>Year: ".$years."</h3>";
											   }
											   else{
											   	$bil = $conn->query("SELECT count(`be_billnumber`) as cnt,SUM(`be_gtotal`) as sm,EXTRACT(YEAR FROM be_billdate) as yr,EXTRACT(MONTH FROM be_billdate) as mnth FROM us_billentry WHERE be_isactive='0' and finyear = '".$_SESSION["finyearid"]."' Group BY EXTRACT(MONTH FROM be_billdate),EXTRACT(YEAR FROM be_billdate) ORDER BY be_billdate DESC");

                          $bil1 = $conn->query("SELECT count(`be_billnumber`) as cnt,SUM(`be_gtotal`) as sm FROM us_billentry WHERE be_isactive='0' and be_balance>0 and finyear = '".$_SESSION["finyearid"]."'  ORDER BY be_billdate DESC");

                          $bil2 = $conn->query("SELECT count(`be_billnumber`) as cnt,SUM(`be_gtotal`) as sm FROM us_billentry WHERE be_isactive='0' and be_balance=0 and finyear = '".$_SESSION["finyearid"]."'  ORDER BY be_billdate DESC");
												echo "<h3>ALL SALES REPORTS</h3>";
											   }
								?>
                                    <div class="table-responsive project-stats">  
                                    <form class="form-horizontal" method="post" action="exportsalereturn1.php?fil=<?= $filt ?>">
                                   <!-- <button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button></form> -->
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0; ">
                                           <thead>
                                               <tr>
                                                 <th>Sl No.</th>
                 
                  <th>Month</th>
                  <th>Total Sale</th>
                  <th>Total Amount</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   
											   $totalamnt = 0;
                         $totsale=0;
											   $totaldis=0;
											   $today = date('Y-m-d');
											   if(mysqli_num_rows($bil)>0)
											   {
												   $k = 1;
												   while($row = $bil->fetch_assoc())
												   {
                            
											   ?>
                                              <b>
                                               <tr style="font-size: 14px;">
                    <td><?= $k?></td>
                  
                    <td><?php $mon= $row['mnth'];
                    if($mon == '1'){ echo "JANUARY";}
                    else if($mon == '2'){ echo "FEBRUARY";}
                    else if($mon == '3'){ echo "MARCH";}
                    else if($mon == '4'){ echo "APRIL";}
                    else if($mon == '5'){ echo "MAY";}
                    else if($mon == '6'){ echo "JUNE";}
                    else if($mon == '7'){ echo "JULY";}
                    else if($mon == '8'){ echo "AUGUST";}
                    else if($mon == '9'){ echo "SEPTEMBER";}
                    else if($mon == '10'){ echo "OCTOBER";}
                    else if($mon == '11'){ echo "NUVEMBER";}
                    else if($mon == '12'){ echo "DECENMER";}
                   
                    ?></td>

                      <td><?php echo $row["cnt"];
                      $totsale=$totsale+$row["cnt"];
                      ?></td>
                    <td><?php echo $row["sm"];
                    $totalamnt=$totalamnt+$row["sm"];
                    ?></td>
                   
                </tr>
                    </b>                           
                                               <?php
											   $k++;
												   }
											   }
											   ?>

                         <?php
                         $row1 = $bil1->fetch_assoc();
                            $row2 = $bil2->fetch_assoc();
                            ?>
                                           </tbody>
                                        </table>
                                        <table class="table" border="0" style="height: 220px;">
                                          <tr style="width: 20px;">
                                            <td align="right"><strong><h3>Total Cash Sale:</h3></strong></td>
                                            <td width="150" align="center"><h3>
                                              <?= $row2["cnt"] ?></h3>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td align="right"><strong><h3>Total Credit Sale:</h3></strong></td>
                                            <td width="150" align="center"><h3>
                                              <?= $row1["cnt"] ?></h3>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td align="right"><strong><h3>Total Sale:</h3></strong></td>
                                            <td width="150" align="center"><h3>
                                            	<?= $totsale ?></h3>
                                            </td>
                                            </tr>
                                             <tr>
                                            <td align="right"><strong><h3>Total Cash Sale Amount:</h3></strong></td>
                                            <td width="150" align="center"><h3>
                                              <?= $row2["sm"] ?></h3>
                                            </td>
                                            </tr>
                                             <tr>
                                            <td align="right"><strong><h3>Total Credit Sale Amount:</h3></strong></td>
                                            <td width="150" align="center"><h3>
                                              <?= $row1["sm"] ?></h3>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td align="right"><strong><h3>Total Amount:</h3></strong></td>
                                            <td width="150" align="center"><h3>
                                            	<?= $totalamnt ?></h3>
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
<!--<?php include('includes/cssscript.php');?>-->       
        
        
     
        
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>