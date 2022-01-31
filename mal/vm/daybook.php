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
                    <h3><strong>ലെഡ്ജർ</strong></h3><br>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>ബില്ലിംഗ്</li>
                            <li class="active">ലെഡ്ജർ</li>
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
                                    <h4 class="panel-title">ലെഡ്ജർ</h4></br>
									
									
                                </div>
                                
                                
                                <div class="panel-body">
								
                                <form action="daybook.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">ഫിൽറ്റർ</button>
                                </form>
								
                                <?php
								
								if(isset($_POST['filter']))
								{
									$fromdate=$_POST['fromdate'];
								    $todate=$_POST['todate'];
									$opn=findopnbal($conn,$fromdate,$_SESSION["admin"]);
									$sql1="select * from vm_transaction where tr_isactive='0' AND user_id='".$_SESSION["admin"]."' AND DATE(tr_date)>='$fromdate' AND DATE(tr_date)<='$todate' "; 
								     
								echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";
								}else
								{
									$today=date("y-m-d");
									$opn=findopnbal($conn,$today,$_SESSION["admin"]);
									$sql1="select * from vm_transaction where tr_isactive='0' AND user_id='".$_SESSION["admin"]."' AND DATE(tr_date)='$today'"; 
								     
								}
								?>                              
                                    <div class="table-responsive project-stats">  
                                      <table id="example" class="display table" style="width: 95%; cellspacing: 0;">
                                        <thead>
										   
										  <?php
										  $clsbal=0;
										  $dtotal=$opn;
										  $ctotal=0;
										  $opbal=0;
										  
										   ?>
										  <tr>
										  <th colspan="4">ഓപ്പണിങ് ബാലൻസ് </th>
										  
										  <td align="right"><?= $opn ?></td>
										  <td></td>
										  </tr>
										  
                                           <tr>
										    <th>#</th>
                                            <th>ഡേറ്റ്</th>
											<th>ബിൽ നം</th>
											<th>പർട്ടികുലേഴ്സ്</th>
                                            <th style="text-align:right">ഡെബിറ്റ്</th>
                                            <th style="text-align:right">ക്രെഡിറ്റ്</th>
                                           </tr>
									    </thead>
                                        <tbody>
										<?php
										
										$slct=$conn->query("$sql1");
												   $k = 1;
												   while($row =$slct->fetch_assoc())
												   {
													   
													   $deb=0;
													   $cre=0;
													   $debit='';
													   $credit='';
													   ?>
										
										<tr>
										<th scope="row"><?= $k ?></th>
										<td><?= date('d-M-Y H:i', strtotime($row['tr_date'])) ?></td>
										<?php
										$billno=$row['tr_billid'];
										$sel= $conn->query("SELECT be_billnumber FROM vm_billentry WHERE be_isactive='0' AND be_billid='$billno'");
										$row1=$sel->fetch_assoc();
										?>
										<td><?= $row1["be_billnumber"] ?></td>
										<td><?= $row['tr_particulars'] ?></td>
										 <td align="right">
										 <?php
										 
										 if($row['tr_transactiontype'] == 'income')
										 {echo $row['tr_transactionamount'];
										 $dtotal=$dtotal+$row['tr_transactionamount'];
										 }else
										 echo "";?>
									     </td>
										 <td align="right">
										 <?php
										 if($row['tr_transactiontype'] == 'expense')
										 {echo $row['tr_transactionamount'];
										 $cre=$row['tr_transactionamount'];
										 $ctotal=$ctotal+$row['tr_transactionamount'];
										 }else{
												   echo "";}
												   $clsbal=$dtotal-$ctotal?>
									     </td>
										 
										</tr>
										<?php
											   $k++;
												   }
											   
											   ?>
										</tbody>
										<tfoot>
										 <th colspan="4">ടോട്ടൽ</th>
										 <td align="right"><?=$dtotal?></td>
									     <td align="right"><?=$ctotal?></td>
										 </tr>
										 
										 <tr>
										  <th colspan="4">ക്ലോസിങ്  ബാലൻസ്</th>
										  <td align="right"><?=$clsbal?></td>
										  <td></td>
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