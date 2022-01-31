	<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	
	  /* $particulars=$_POST['particulars'];
		$transactiontype=$_POST['type'];
		$date=$_POST['date'];
		$time=$_POST['time'];
		$datetime=date("Y-m-d", strtotime($_POST["date"]))." ".date("H:i", strtotime($_POST["time"]));
		$amount=$_POST['amount'];*/
	
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
                    <h3><strong>Profit</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Profit</li>
                        </ol>
                    </div>
                </div>
                
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                          
							
                                <div class="panel-heading">
                                	<!--<a href="daybook.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> Print</button></a>-->
                                    <h4 class="panel-title">Profit</h4></br>
									
									
                                </div>
                                
                                
                                
								
                                <form action="profit.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
                                
                               
                                <?php
								
								if(isset($_POST['filter']))
								{
									$fromdate=$_POST['fromdate'];
								    $todate=$_POST['todate'];
									
									$sql1="select * from us_billitems where bi_isactive='0' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND DATE(bi_billdate)>='$fromdate' AND DATE(bi_billdate)<='$todate' "; 
								     
								echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
								}else
								{
									$today=date("y-m-d");
									$opn=findopnbal($conn,$today,$_SESSION["admin"]);
									$sql1="select * from us_billitems where bi_isactive='0' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND DATE(bi_billdate)='$today'"; 
								     
								}
								?>                              
                                    <div class="table-responsive project-stats">  
                                      <table id="example" class="display table" style="width: 95%; cellspacing: 0;">
                                        <thead>
										  
										  
										  
                                           <tr>
										    <th>#</th>
                                            <th>Date</th>
											<th>Bill No</th>
											<th>Particulars</th>
                                            <th >SalePrice</th>
                                            <th >Quantity</th>
                                            <th >Total Amt</th>
                                            <th>Net Amount</th>
                                            <th>Discount</th>
                                             <th >Profit</th>
                                           </tr>
									    </thead>
                                        <tbody>
										<?php
										
										$slct=$conn->query("$sql1");
												   $k = 1;
												   $gtot=0;
												   while($row =$slct->fetch_assoc())
												   {
													   
													  
													   ?>
										
										<tr>
										<th scope="row"><?= $k ?></th>
										<td><?= date('d-M-Y H:i', strtotime($row['bi_billdate'])) ?></td>
										<?php
										$billno=$row['bi_billid'];
										$proid=$row['bi_productid'];
										$sel= $conn->query("SELECT be_billnumber FROM us_billentry WHERE be_isactive='0' AND be_billid='$billno'");
										$row1=$sel->fetch_assoc();
										$sel2= $conn->query("SELECT pr_productname FROM us_products WHERE pr_isactive='0' AND pr_productid='$proid'");
										$row2=$sel2->fetch_assoc();
										?>
										<td><?= $row1["be_billnumber"] ?></td>
										<td><?= $row2['pr_productname'] ?></td>
										 <td>
										 <?= $row['bi_price'] ?>
									     </td>
                                        
                                         <td>
                                         <?= $row['bi_quantity'] ?>
                                         </td>
										 <td >
										 <?php $pri=$row['bi_price'] * $row['bi_quantity'];
										 echo $pri;?>
									     </td>
                                         <td>
                                         <?php $tax=$row['bi_price']*($row['bi_vatper']/(100+$row['bi_vatper']));
										 $net=$row['bi_price']-$tax;
										 $totnet=$net*$row['bi_quantity'];
										 echo round($totnet,2);
										  ?>
                                         </td>
                                       <td>
                                         <?= $row['bi_disc'] ?>
                                         </td>
                                      
										 <td>  <?php  $Purprice =round($row['bi_purprice'] * $row['bi_quantity'],2);
									           $saleprice =round($row['bi_price'] * $row['bi_quantity'],2);
											   $dis=$row['bi_disc'];
											   $tot=$totnet - $Purprice-$dis;
											   echo round($tot,2);
											   $gtot=$gtot+$tot;
									    ?></td>
										</tr>
										<?php
											   $k++;
												   }
											   
											   ?>
										</tbody>
										<tfoot>
										 <th colspan="6">Total</th>
										 <td align="right"></td>
									     <td align="right"><?=$gtot?></td>
										 </tr>
										 
										 
											  
										</tfoot>
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