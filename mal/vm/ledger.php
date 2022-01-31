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
                    <h3><strong>Ledger</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Ledger</li>
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
                                    <h4 class="panel-title">Ledger</h4></br>
									
									
                                </div>
                                
                                
                                <div class="panel-body">
								
                                <form action="ledger.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
								
                                <?php
								
								if(isset($_POST['filter']))
								{
									$fromdate=$_POST["fromdate"];
									$todate=$_POST["todate"];
								     
								echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
								}else
								{
									$fromdate=date('Y-m')."-01";
									$todate=date("Y-m-t", strtotime($fromdate));
								     
								echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
								}
								?>                              
                                    <div class="table-responsive project-stats">  
                                      <table class="display table" style="width: 95%; cellspacing: 0;">
                                        <thead>
										   
										  
										  
										  
                                           <tr>
											<th>Account Name</th>
											
                                            <th style="text-align:right">Debit</th>
                                            <th style="text-align:right">Credit</th>
                                           </tr>
									    </thead>
                                        <tbody>
										
										<tr>
										<?php $total_d=0;$total_c=0;?>
										<td>SALES</td><td style="text-align:right"><?php 
										$slct=$conn->query("SELECT SUM(tr_transactionamount) AS total FROM vm_transaction WHERE tr_particulars='Sales' AND DATE(tr_date)>='$fromdate' AND DATE(tr_date)<='$todate' AND tr_isactive='0' AND user_id='".$_SESSION['admin']."'");
										$row=$slct->fetch_assoc();echo $row["total"];$total_d=$total_d+$row["total"];
										?></td><td style="text-align:right"></td>
                                        
                                        </tr>
                                        <tr>
                                        <td>PURCHASE</td><td style="text-align:right"></td><td style="text-align:right"><?php 
										$slct=$conn->query("SELECT SUM(tr_transactionamount) AS total FROM vm_transaction WHERE tr_particulars='Purchase' AND DATE(tr_date)>='$fromdate' AND DATE(tr_date)<='$todate' AND tr_isactive='0' AND user_id='".$_SESSION['admin']."'");
										$row=$slct->fetch_assoc();echo $row["total"];$total_c=$total_c+$row["total"];
										?></td>
                                        
                                        </tr>
                                        <tr>
                                        <td>SALES RETURN</td><td style="text-align:right"></td><td style="text-align:right"><?php 
										$slct=$conn->query("SELECT SUM(tr_transactionamount) AS total FROM vm_transaction WHERE tr_particulars='Sales Return' AND DATE(tr_date)>='$fromdate' AND DATE(tr_date)<='$todate' AND tr_isactive='0' AND user_id='".$_SESSION['admin']."'");
										$row=$slct->fetch_assoc();echo $row["total"];$total_c=$total_c+$row["total"];
										?></td>
                                        
                                        </tr>
                                        <tr>
                                        <td>PURCHASE RETURN</td><td style="text-align:right"><?php 
										$slct=$conn->query("SELECT SUM(tr_transactionamount) AS total FROM vm_transaction WHERE tr_particulars='Purchase Return' AND DATE(tr_date)>='$fromdate' AND DATE(tr_date)<='$todate' AND tr_isactive='0' AND user_id='".$_SESSION['admin']."'");
										$row=$slct->fetch_assoc();echo $row["total"];$total_d=$total_d+$row["total"];
										?></td><td style="text-align:right"></td>
                                        
                                        <tr>
                                        </tr>
                                        <td>OTHERS</td><td style="text-align:right"><?php 
										$slct=$conn->query("SELECT SUM(tr_transactionamount) AS total FROM vm_transaction WHERE tr_particulars!='Sales' AND tr_particulars!='Purchase' AND tr_particulars!='Sales Return' AND tr_particulars!='Purchase Return' AND DATE(tr_date)>='$fromdate' AND DATE(tr_date)<='$todate' AND tr_isactive='0' AND user_id='".$_SESSION['admin']."' AND tr_transactiontype='income'");
										$row=$slct->fetch_assoc();echo $row["total"];$total_d=$total_d+$row["total"];
										?></td><td style="text-align:right"><?php 
										$slct=$conn->query("SELECT SUM(tr_transactionamount) AS total FROM vm_transaction WHERE tr_particulars!='Sales' AND tr_particulars!='Purchase' AND tr_particulars!='Sales Return' AND tr_particulars!='Purchase Return' AND DATE(tr_date)>='$fromdate' AND DATE(tr_date)<='$todate' AND tr_isactive='0' AND user_id='".$_SESSION['admin']."' AND tr_transactiontype='expense'");
										$row=$slct->fetch_assoc();echo $row["total"];$total_c=$total_c+$row["total"];
										?></td>
                                        
                                        </tr>
										 
										
										</tbody>
										<tfoot>
                                        <th>Total</th><td style="text-align:right"><?=$total_d?></td><td style="text-align:right"><?=$total_c?></td>
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