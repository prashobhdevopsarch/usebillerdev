<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	
	if(isset($_POST['submit']))
	{
		$category_name = $_POST['category_name'];
		$vat = $_POST['vat'];
		
		
		
		$sql1="INSERT INTO us_catogory(ca_categoryname, user_id, ca_vat, ca_updatedtime ) VALUES('".$category_name."','".$_SESSION["admin"]."','".$vat."',NOW())";
			$sql= $conn->query("$sql1");
			
		
			
	
	if($sql)
	  {
		  header('Location:category.php?id=success');
	  }
	  else{
		  header('Location:category.php?id=fail');
		 
	  }
	}
	if(isset($_POST['update']))
	{
		$category_name = $_POST['category_name'];
		$vat = $_POST['vat'];
		$id=$_GET["catid"];
		
		
			$sql1="UPDATE us_catogory SET ca_categoryname='$category_name',ca_vat='$vat' WHERE ca_categoryid='$id'";
			$sql= $conn->query("$sql1");
			
		
			
	
	if($sql)
	  {
		  header('Location:category.php?id=success');
	  }
	  else{
		  header('Location:category.php?id=fail');
		 
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
        
        <?php
		include("includes/files.php");
		?>
        <link href="assets/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        
        
        
        
        <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        
        
        <style>

        .dropbtn {
    background-color: #2B384E;
    color: white;
    padding: 8px;
   border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    font-size: 13px;
    font-weight: 600;
    transition: box-shadow linear 0.4s;
    width: 300px;
    height: 60px;
    border-radius: 10px;
}
    

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    width: 300px;
    border-bottom: 10px;
    border-right: 10px;
    border-right: 10px;
}


.dropdown-content a {
    color: #2B384E;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}


.dropdown-content a:hover {background-color: #2B384E; text-decoration: none; color: white;}


.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #2B384E;

}
	</style>
                        
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
                    <h3><strong>All Reports</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php">Billing</a></li>
                            <li class="active">All Reports</li>
                        </ol>
                    </div>
                </div>
                
                <div id="main-wrapper" >
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white" style="height: 450px;">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Reports</h2>
                                    
                                  
                                </div>
                                <div class="panel-body">
                               </div>
                                <div class="w3-container" style="padding: 50px">

                                  <div class="row">
  <div class="col-sm-3">
  <div class="dropdown">
  <button class="dropbtn">Sales</button>
  <div class="dropdown-content">
    <b>
       <a href="allsale.php">All</a>
    <a href="billinghistory.php">Retail</a>
    <a href="billinghistoryw.php">Wholesale</a>
    <a href="cashsale.php">Cash Sale</a>
    <a href="creditsale.php">Credit Sale</a>
     <a href="cushistory.php">Customer Wise Report</a>
        <a href="servicebillreport.php">Service report</a>
         <a href="perfomoreport.php">Perfomo invoice</a>
 </b>
  </div>
   

</div></div>
  <div class="col-sm-3">
    <div class="dropdown">
  <button class="dropbtn">Purchase</button>
  <div class="dropdown-content">
    <b>
 <a href="allpurchase.php">All</a>
 <a href="purchasehistory.php">Purchase</a>
    <a href="cashpurchase.php">Cash</a>
    <a href="creditpurchase.php">Credit</a>
    <!--<a href="supplierlist">Supplierwise Report</a>-->

</b>
  </div>

</div></div>
  <div class="col-sm-3"><div class="dropdown">
  <button class="dropbtn">Sale Return</button>
  <div class="dropdown-content">
    <b>
    <a href="#">All</a>
    <a href="salesreturnhistory.php">Sales Return</a>
    
</b>
  </div>

</div></div>
<div class="col-sm-3">
  <div class="dropdown">
  <button class="dropbtn">Purchase Return</button>
  <div class="dropdown-content">
    <b>
    <a href="#">All</a>
    <a href="purchasereturnhistory.php">Purchase Return</a>
   
</b>
  </div>


</div></div>
</div>

<div class="row" style="padding-top: 100px">

<div class="col-sm-3"><div class="dropdown">
  <button class="dropbtn">Estimation</button>
  <div class="dropdown-content">
    <b>
  
    <a href="estimationhistory.php">Estimation History</a>
   
</b>
  </div>
  </div></div>
<div class="col-sm-3"><div class="dropdown">
  <button class="dropbtn">Stock</button>
  <div class="dropdown-content"><b>
    <a href="stocks.php">Stock Report</a>
    <a href="outofstocks.php">Out of stocks</a>
   
</b>
  </div>

</div></div>
<div class="col-sm-3" >
  <div class="dropdown">
  <button class="dropbtn">Tax Report</button>
  <div class="dropdown-content"><b>
    <a href="puchasevat.php">Purchase Tax</a>
    <a href="salesvatr.php">Retail Tax</a>
    <a href="salesvatw.php" style="display:none;">Wholesale Tax</a>
</b>
  </div>

</div>
</div>
<div class="col-sm-3" >
  <div class="dropdown">
  <button class="dropbtn">Financial Statements</button>
  <div class="dropdown-content"><b>
    <a href="daybooks.php">Daybook</a>
    <a href="cashbook.php">Cash book</a>
    <a href="bankbook.php">Bank book</a>
    <a href="trailbalance.php">Trail balance</a>
    <a href="profitandloss.php">Trading &Profitloss Account</a>
    <a href="balancesheet.php">Balance Sheet</a>
</b>
  </div>

</div>
</div>
</div>

  



</div>









  </div>
</div>
                                    
                                    <!--<table class="table">
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;"></td>
                                    </table>-->
                                       
                                        
                                       
                       
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
        <?php
		include("includes/footerfiles.php");
		?>
        
        
        
        
       
        
       <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/plugins/summernote-master/summernote.min.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>
        
        
        
       
        
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>