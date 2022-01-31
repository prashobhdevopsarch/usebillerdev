<?php
session_start();
if(isset($_SESSION['admin']))
{
    include("includes/config.php");

    if(isset($_POST["update1"]))
    {

        $ghead=$_POST["ghead"];
        
        $lname=$_POST["lname"];
        $note=$_POST["note"];
        $obalance=$_POST["obalance"];
        $cbalance=$_POST["cbalance"];
        //echo print_r($_POST);

        
        $instrt=$conn->query("INSERT INTO administrator_account_name(acc_name, act_group_head ,opening_balance,closing_balance,note,finyear) VALUES('$lname','$ghead','$obalance','$cbalance','$note','".$_SESSION["finyearid"]."')");


        if($instrt )
        {
            //$suc=minusbalance($conn,$newpay,$_SESSION["admin"],$csid);

            header("location:ledger.php?id1=success");
            
        }else{header('Location:ledger.php?id1=faill');}
    }
     if(isset($_GET["delete"]))
    {
        $bill_id=$_GET["billid"];




        $delete=$conn->query("UPDATE administrator_account_name SET isactive='1'  WHERE refid='$bill_id'");

        if($delete)
        {




          header('Location:ledger.php?id=success');
      }else{
          header('Location:ledger.php?id=fail');
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
     <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    .pay td{
        padding:10px;
    }
      .container { margin:150px auto;}
    .treegrid-indent {
        width: 0px;
        height: 16px;
        display: inline-block;
        position: relative;
    }
     .treegrid-expander {
        width: 0px;
        height: 16px;
        display: inline-block;
        position: relative;
        left:-17px;
        cursor: pointer;
    }
    .grid-container {
  display: grid;
  grid-template-columns: auto auto;
  border-bottom:1px solid #FFF;
  padding: 10px;

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
                <h3><strong>BALANCE SHEET</strong></h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li>Accounts</li>
                        <li class="active">Balance Sheet</li>
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
                             <a href="daybooks.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; "><i class="fa fa-backward"></i> DAY BOOK</button></a>
                             <a href="bankbook.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px;"><i class="fa fa-backward"></i> BANK BOOK</button></a>
                             <a href="cashbook.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> CASH BOOK</button></a>
                             <a href="profitandloss.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> TRADING & PROFIT LOSS ACCOUNT</button></a>
                            
                             <a href="trailbalance.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> TRAIL BALANCE</button></a>
                             <!--<a href="exporthistory1.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> Print</button></a>-->
                             <h4 class="panel-title"><U></U></h4>
                         </div>


                         <div class="panel-body">
                               <!-- <form action="billinghistory.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>-->

                                 
                                <div class="table-responsive project-stats"> 
                                    <br>
                                    <br> 
                                     <!--<form action="balancesheet.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>-->
<br>
 <?php



                     if(isset($_POST['filter']))
                         {
                           $fromdate = $_POST['fromdate'];
                           $todate = $_POST['todate'];
                        $blopen = $conn->query("SELECT * FROM administrator_account_name where refid='1' ");
                            $blbils = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND finyear = '".$_SESSION["finyearid"]."' and credit='43'  and mode='1'   and dr_cr='C' Group BY credit ORDER BY refid ");
                             $blbils1 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND  finyear = '".$_SESSION["finyearid"]."' and credit='46' and mode='1' and dr_cr='C' Group BY credit ORDER BY refid
 ");
                              $bldex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='1' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  ");
                               $bldexpay = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='1' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  ");

                              $bldexnew = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='18' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  ");

                              $bldex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='17' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  ");
                               $debtor = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='2' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D' ");
                               $debtorpay = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='2' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C' ");
                              $blbil5 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND   finyear = '".$_SESSION["finyearid"]."' and credit='5'  and mode='1'   and dr_cr='C' Group BY credit ORDER BY refid ");
                               $blbil2 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND   finyear = '".$_SESSION["finyearid"]."' and debit='4'  and mode='1'  and dr_cr='D' Group BY debit ORDER BY refid ");

                               $blinex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='13' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  ");
                               $blinex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='15' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  ");
                                   $deb = $conn->query("SELECT sum(dayBookAmount) as cashamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND  finyear = '".$_SESSION["finyearid"]."' and mode='1' and dr_cr='D' AND credit='1'  ");
                               $cred = $conn->query("SELECT sum(dayBookAmount) as cashamnt1 FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND  finyear = '".$_SESSION["finyearid"]."' and mode='1' and dr_cr='C' and debit='1'  ");
                               $debbank = $conn->query("SELECT sum(dayBookAmount) as cashamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND finyear = '".$_SESSION["finyearid"]."' and mode='1' and dr_cr='D'  AND credit='13' ");
                               $credbank = $conn->query("SELECT sum(dayBookAmount) as cashamnt1 FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND finyear = '".$_SESSION["finyearid"]."' and mode='1'  and dr_cr='C' and debit='13' ");
                           echo "<h4>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h4>";
                         }



                         else{
                           $blopen = $conn->query("SELECT * FROM administrator_account_name where refid='1' ");
                            $blbils = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and credit='43'  and mode='1'   and dr_cr='C' Group BY credit ORDER BY refid ");
                             $blbils1 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where finyear = '".$_SESSION["finyearid"]."' and credit='46' and mode='1'  and dr_cr='C' Group BY credit ORDER BY refid
 ");
                              $bldex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE b.act_group_head='1' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C' ");
                              $bldexpay = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE   b.act_group_head='1' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  ");
                              $bldexnew = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE b.act_group_head='18' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  ");

                              $bldex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE b.act_group_head='17' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                              $blbil5 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and credit='5'  and mode='1'    and dr_cr='C' Group BY credit ORDER BY refid ");
                               $blbil2 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and debit='4'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");

                                $debtor = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE  b.act_group_head='2' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  ");
                                $debtorpay = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE  b.act_group_head='2' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C' ");
                               $blinex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE b.act_group_head='13' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'");
                               $blinex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE b.act_group_head='15' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  ");
                               $deb = $conn->query("SELECT sum(dayBookAmount) as cashamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and mode='1' and dr_cr='D' AND credit='1'  ");
                               $cred = $conn->query("SELECT sum(dayBookAmount) as cashamnt1 FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and mode='1' and dr_cr='C' and debit='1'  ");
                               $debbank = $conn->query("SELECT sum(dayBookAmount) as cashamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and mode='1' and dr_cr='D'  AND credit='13' ");
                               $credbank = $conn->query("SELECT sum(dayBookAmount) as cashamnt1 FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and mode='1'  and dr_cr='C' and debit='13' ");
                        //echo "<h3>ALL BILL DETAILS</h3>";
                         }
                ?>

                                    <!-- <button type="button"  style="float: right;" class="btn btn-primary btn-rounded"  onClick="showmodel()" float="right"><span class="glyphicon glyphicon-plus"></span>Add New</button><br><br>-->
                                    <form class="form-horizontal" method="post" action="balancesheet.php?fil=<?= $filt ?>">
                                        <!--<button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button>-->

                                         <div class="box" style="border: 1px solid black">

                                            <div class="panel panel-default">

                                                <div class="panel-heading"><B>BALANCE SHEET</B>
                                                    <div class="muted pull-right">

                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="panel-body">
<?php
include('balinc.php');
?>

      <!-- --------------GRID 1-1  --------------------------- -->
                                                      <div class="grid-container" >
                                                        <div class="grid-item" style="border-right: 1px solid black">
                                                  <table width="80%"  cellpadding="3" cellspacing="3">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                                <tr height="30px" style="border-bottom: solid 1px black; ">
                                                                    <th><h4><b>LIABILITIES</b></h4></th><td></td>
                                                                    <th style="text-align:right;"><h4><b>Amount(Rs)</b></h4></th>
                                                                    
                                                                   
                                                                </tr>
                                                                <tr height="40px"><td width="20%" style="text-align:left;">Opening Stock</td><td></td> <td align="right" width="10%">
                                                                 <?php
                                                                  $exptotbl=0;
                                                                  $pur=0;
                                                                  
                                                       $open1bl = $blopen->fetch_assoc();
                                                       echo $open1bl['opening_balance'];
                                                       $exptotbl=$exptotbl+$open1bl['opening_balance'];
                                                                 ?>
                                                             </td>
                                                       </tr>
                                                       <tr height="40px"><td width="20%">Capital</td><td></td> <td align="right" width="10%">
                                                          <?php
                                                           
                                                            while($rowsbl = $blbils->fetch_assoc())
                                                   {
                                                    echo $rowsbl['amnt'];
                                                   $exptotbl=$exptotbl+$rowsbl['amnt'];
                                                       //$debittot=$debittot+$rows['billamnt'];
                                                   }
                                                          ?>
                                                       </td>
                                                </tr>
                                                       
                                            <?php
                             
                             if(mysqli_num_rows($bldex)>0)
                                               {
                                                ?>
                                                 <tr height="40px"><td width="20%" style="text-align:left;"><u><b>CURRENT LIABILITIES</b></u></td> <td align="right" width="10%">
                                       
                                   </td><td></td></tr>
                                                <?php
                               $rowdxbl = $bldex->fetch_assoc();
                               $rowdxblpay = $bldexpay->fetch_assoc();
                                                  

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;">Sundry Creditors</td><td></td> <td align="right" width="10%">

                                   <?php 
                                   $credpay=$rowdxbl['amnt']-$rowdxblpay['amnt'];
                                   echo $credpay; 
                                    $exptotbl=$exptotbl+$credpay; 
                                   ?>
                               </td> 
                           </tr>
                          
                         
                                       <?php
                                     }
                               while($rowdxblnew = $bldexnew->fetch_assoc())
                                                   {

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;"><?= $rowdxblnew['acc_name'] ?></td><td></td> <td align="right" width="10%">
                                   <?php echo $rowdxblnew['amnt']; 
                                    $exptotbl=$exptotbl+$rowdxblnew['amnt']; 
                                   ?>
                               </td> 
                           </tr>
                           <?php
                       }
                           ?>
                            </tbody>
       </table>

       </div>                
                                                
                                                 

<!--  ----------------------GRID 1-2--------------------------------- -->

                              <div class="grid-item" style="margin-left: 30px;"><table width="80%" style="" cellpadding="3" cellspacing="3">
                                    <thead>
                                    </thead>
                                            <tbody>
                                                                <tr height="30px" style="border-bottom: solid 1px black; ">
                                                                   
                                                                    <th><h4><b>ASSETS</b></h4></th><td></td>
                                                                    <th style="text-align:right;"><h4><b>Amount(Rs)</b></h4></th>
                                                                </tr>
                                                              
                                                               <?php
                                                               $blsale=0;
                                                               $blintot=0;
                                                       
                             if(mysqli_num_rows($bldex1)>0)
                                               {
                                                ?>
                                                 <tr height="40px"><td width="20%" style="text-align:left;"><B><U>FIXED ASSETS</U></B></td> <td align="right" width="10%">
                                       
                                   </td><td></td></tr>
                                                <?php
                               while($rowdx1bl = $bldex1->fetch_assoc())
                                                   {

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;"><?= $rowdx1bl['acc_name']; ?></td><td></td> <td align="right" width="10%">
                                   <?php echo $rowdx1bl['amnt']; 
                                    $blintot=$blintot+$rowdx1bl['amnt']; 
                                   ?>
                               </td> 
                           </tr>
                           <?php }
                       }
                           ?>
                            <tr height="40px"><td width="20%" style="text-align:left;"><B><U>CURRENT ASSETS</U></B></td> <td align="right" width="10%">
                                       
                                   </td><td></td></tr>
                                                       <tr height="40px"> <td width="20%">Closing Stock</td><td></td> <td align="right" width="10%">
                                                      <?php

                                                      $vmprd=$conn->query("SELECT * from us_products where pr_isactive='0' ");

                                                      $amountz=0;

                                                     while($rowprd = $vmprd->fetch_assoc())
                                                   {

                                                    $date= date('d-m-Y');
                                                    
                                                      $vmsr=$conn->query("SELECT * from us_stockreport where sr_itemid='".$rowprd['pr_productid']."' order by sr_date desc limit 1");
                                                        
                                                        if($rowsr = $vmsr->fetch_assoc())
                                                       {
                                                      $amountz = $amountz +  $rowsr['sr_amount'];
                                                        }
                                                        else{

                                                          $vmprd1=$conn->query("SELECT * from us_products where pr_productid='".$rowprd['pr_productid']."' ");

                                                          $rowsrprd = $vmprd1->fetch_assoc();

                                                         $amountz = $amountz + ($rowsrprd['pr_stock']*$rowsrprd['pr_purchaseprice']);

                                                        } }

                                                      $close=$amountz;
                                                      echo $close;
                                                      $blintot=$blintot+$close;
                                                       ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                 
                                                       $deb1 = $deb->fetch_assoc();

                                                        
                                                       $cred1 = $cred->fetch_assoc();

                                                
                                                       $debb1 = $debbank->fetch_assoc();

                                                        
                                                       $credb1 = $credbank->fetch_assoc();
                                                       $cash=$cred1['cashamnt1']-$deb1['cashamnt'];
                                                         $cashbank=$credb1['cashamnt1']-$debb1['cashamnt'];
                                                ?>
                                                <tr height="40px"> <td width="20%">Cash in hand</td><td></td> <td align="right" width="10%">
                                                  <?php echo $cash;
                                                  $blintot=$blintot+$cash;
                                                  ?>
                                                </td>
                                              </tr>
                                               <tr height="40px"> <td width="20%">Cash in bank</td><td></td> <td align="right" width="10%">
                                                  <?php echo $cashbank;
                                                  $blintot=$blintot+$cashbank;
                                                  ?>
                                                </td>
                                              </tr>
                                              <?php
                               $rowdebt = $debtor->fetch_assoc();
                                 $rowdebtpay = $debtorpay->fetch_assoc();               

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;">Sundry debtors</td><td></td> <td align="right" width="10%">

                                   <?php 
                                    $debtbal=$rowdebt['amnt']-$rowdebtpay['amnt'];
                                   echo $debtbal; 
                                   $blintot=$blintot+$debtbal; 
                                   ?>
                               </td> 
                           </tr>
                          
                                                 </tbody>
                                          </table>

                                        </div>


<!-- ---------------------------------GRID 2-1-------------------------------------- -->

                          <div class="grid-item" style="border-right: 1px solid black"><table width="80%"  cellpadding="3" cellspacing="3">
                                                            <thead>
                                                            </thead>
                                                            <tbody>

                                                              <?php
                                                               $exptot1=0;
                                                              if($incsum>$expsum){
                                                                //$dif=$intot-$exptot; 
                                                              ?>
                                                          <tr height="40px">
                                                  <td width="20%" style="text-align:left;"><b>Gross Profit</b></td> <td></td><td align="right" width="10%"><b>
                                                   <?php echo $diftot;
                                                   $exptotbl=$exptotbl+$diftot;
                                                   ?>
                                               </b></td>
                                               
                                          </tr>
                                          <?php }
                                          ?>
                                          <tr height="40px" style="border-top: solid 1px black; "><td width="20%" style="text-align:left;"><b>Total</b></td> <td></td><td align="right" width="10%" class="total">
                                            <b>
                                            <?php 
                                            echo $exptotbl;
                                            ?>
                                          </b>
                                        </td> 
                                    </tr>
                                       

                           </tbody>
                       </table>
                    </div>


<!-- ----------------------------------GRID 2-2------------------------------------ -->

                                      <div class="grid-item" style="margin-left: 30px;"><table width="80%" style="" cellpadding="3" cellspacing="3">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                              <?php
                                                              $intot1=0;
                                                              if($expsum>$incsum){
                                                               
                                                              ?>
                                                                       <tr height="40px">
                                                  
                                               <td width="20%"><b>Gross Loss</b></td><td></td> <td align="right" width="10%"><b>
                                                 <?php echo $dif1tot;
                                                  $blintot=$blintot+$dif1tot;
                                                   ?>
                                              </b></td>
                                          </tr>
                                          <?php }else{
                                          ?>
                                           <tr height="40px">
                                                  
                                               <td width="20%"></td><td></td> <td align="right" width="10%">
                                                 
                                              </td>
                                          </tr>
                                          <?php }
                                          ?>
                                          <tr height="40px" style="border-top: solid 1px black; " >
                                           <td width="20%"><b>Total</b></td><td></td> <td align="right" width="10%" class="total"><b>
                                            <?php
                                            echo $blintot;
                                             ?>
                                           </b>
                                        </td>
                                    </tr>
                              
                           </tbody>
                    </table>
              </div>
   




<!-- ----------------------------------GRID 3-1------------------------------------ -->

   


<!-- ----------------------------------GRID 3-2------------------------------------ -->

                       
<!-- ----------------------------------GRID 4-1------------------------------------ -->



<!--  FOR REFERANCE -->

</div>
</div>
</div>
  </form>
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

</div>
  </div>
 
</div>
  </div>
 <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="js1/javascript.js"></script>
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
<script type="text/javascript">

    function showmodel()
    {


        $('#myModal').modal('show'); 
    }
    function showmodel1(id)
    {
      document.getElementById("refid").value=Number(id);

      $('#myModal1').modal('show'); 
  }
</script>
 </body>
 </html>
<?php
}else{
    header("Location:index.php");
}
?>