<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$particulars=$_POST['particulars'];
		$transactiontype=$_POST['type'];
		$date=$_POST['date'];
		$time=$_POST['time'];
		$datetime=date("Y-m-d", strtotime($_POST["date"]))." ".date("H:i", strtotime($_POST["time"]));
		$amount=$_POST['amount'];
		
 $slct_empnum=$conn->query("SELECT	tr_closingbalance FROM vm_transaction ORDER BY tr_id DESC LIMIT 1");
if(mysqli_num_rows($slct_empnum)>0)
 {
$last=$slct_empnum->fetch_assoc();
$openingbalance = $last['tr_closingbalance'] ;
 }
 else{
 $openingbalance =0;
 }

	if($transactiontype=='expense')	
	{
		$closingbalance=$openingbalance-$amount;
	}
	elseif($transactiontype=='income')
	{
		$closingbalance=$openingbalance+$amount;
	}
	
		
		
$insert=$conn->query("insert into vm_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,user_id)
values('$particulars',' $openingbalance','$amount','$closingbalance','$datetime','$transactiontype','".$_SESSION["admin"]."')");

if($insert)
	{header("location:expense.php?id");}
else{header("location:expense.php?er");}
  

		
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
        
        <?php
		include("includes/files.php");
		?>
         <style>
	#results td:hover{
		background-color:rgba(58, 87, 149, 0.28);
		
	}
	.secol table td{
cursor:pointer;
padding:3px;
}
.secol table td:hover{
background-color:rgba(58, 87, 149, 0.39);
}
	

	</style>
    <!-- Styles -->
       
        
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
	
        	
        <!-- Theme Styles -->
        
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
                    <h3><strong>എക്‌സ്‌പെൻസ്‌</strong></h3><br>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
						<li>ബില്ലിംഗ്</li>
                            <li class="active">എക്‌സ്‌പെൻസ്‌</li>
                        </ol>
                    </div>
                </div>
				
				
                                <div id="main-wrapper">
                    <!-- Row -->
                    <div class="row">
                        
                        
                        
                        
                 <!---      <div class="panel-body">
                                <form action="billinghistory.php" method="post">
                                   
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
							</div> -->
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
							
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									സേവ്ഡ് സക്‌സെസ്സ്ഫുള്ളി.
                                    </div>
                                    <?php
								}
								if(isset($_GET['er']))
								{
									
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										
										എറർ ഒക്യൂർഡ്, പ്ളീസ് ട്രൈ എഗൈൻ.
                                    </div>
                                    <?php
								}
								?>
                                <div class="panel-body">
                                    <div class="project-stats">  
                                    
                                   <form class="form-horizontal" name="addbilldetails" method="post" action="" enctype="multipart/form-data">
                                       <div class="table-responsive">
                                       <input type="hidden" name="billno" id="billno" value="">   
                                   <div class="table-responsive">                                        
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
									<th>പർട്ടികുലേഴ്സ്  </th>
									<th>ടൈപ്പ്</th>
									<th>ഡേറ്റ്</th>
									<th>ടൈം</th>
									<th>എമൗണ്ട്</th>
                                    </tr>
                                    </thead>
									<tbody>
									<tr>
									<td><input type="text" required class="form-control" placeholder="പർട്ടികുലേഴ്സ്" name="particulars" id="particulars"></td>
                                    <td style="width:124px;"><select class="form-control" name="type">
                                 <option value="expense">എക്‌സ്‌പെൻസ്‌</option>
                                 <option value="income">ഇൻകം</option>
                                    </select>
									</td>
									<td> <input type="date" name="date" id="date" class="form-control"></td>
									<td><input type="time" name="time" id="time" value="<?= date('H:i') ?>" class="form-control"></td></td>
									<td><input type="text" required  class="form-control" placeholder="എമൗണ്ട്" name="amount" id="amout"></td>
									
                                        </tr>                           
									</tbody>
								    </table>
                                   </div> 
                                    
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" class="btn btn-primary">സേവ്</button>
                                        </div>
										</div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					</div>
					
                <!-- Main Wrapper -->
				
				
				
				
				
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