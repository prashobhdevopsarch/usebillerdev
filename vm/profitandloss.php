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




        $delete=$conn->query("UPDATE administrator_account_name SET isactive='1' WHERE refid='$bill_id'");

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
                <h3><strong>TRADING & PROFIT LOSS ACCOUNT</strong></h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li>Accounts</li>
                        <li class="active">Trading & Profit Loss Account</li>
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
                             
                             <a href="balancesheet.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> BALANCE SHEET</button></a>
                             <a href="trailbalance.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> TRAIL BALANCE</button></a>
                             <!--<a href="exporthistory1.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> Print</button></a>-->
                             <h4 class="panel-title"></h4>
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
                                  <form action="profitandloss.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
<br>
 <?php



                     if(isset($_POST['filter']))
                         {
                           $fromdate = $_POST['fromdate'];
                           $todate = $_POST['todate'];
                           echo $fromdate;
                           
                        //$open = $conn->query("SELECT * FROM administrator_account_name where refid='1' ");

                           //opening stock
                            $vmprds=$conn->query("SELECT * from us_products where pr_isactive='0' ");
                                           $amountz1=0;
                                               while($rowprds = $vmprds->fetch_assoc())
                                                   {
                                                    //$date= date('d-m-Y');
                                                     $fromdatey = strtotime ( '-1 day' , strtotime ( $fromdate )) ;

                                                     $fromdate1 = date ('Y-m-d' , $fromdatey );
                $vmsr1=$conn->query("SELECT * from us_stockreport where sr_itemid='".$rowprds['pr_productid']."' and DATE(sr_date)='$fromdate1'  order by sr_date desc limit 1");
                                                      if($rowsr1 = $vmsr1->fetch_assoc())
                                                       {
                                                    $amountz1 = $amountz1 +  $rowsr1['sr_amount'];
                                                        }
                                                        else{
                                                  $vmprds1=$conn->query("SELECT * from us_products where pr_productid='".$rowprds['pr_productid']."' ");
                                                  $rowsrprd1s = $vmprds1->fetch_assoc();


                                                 $vmpr=$conn->query("SELECT * from us_catogory where ca_categoryid='".$rowsrprd1s['pr_type']."' ");

                                                 $rowcat = $vmpr->fetch_assoc();

                                                 $taxper=$rowcat['ca_vat'];

                                                 $taxamt=$rowsrprd1s['pr_purchaseprice']*$taxper/100;
                                                 $purprice= $rowsrprd1s['pr_purchaseprice']+$taxamt;



                                        $amountz1 = $amountz1 + ($rowsrprd1s['pr_stock']*$purprice);

                                                        } 
                                                      }
                                                        $openbal=$amountz1;

                            $bils = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND finyear = '".$_SESSION["finyearid"]."' and debit='6'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");
                             $bils1 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND  finyear = '".$_SESSION["finyearid"]."' and credit='46' and mode='1'  and dr_cr='C' Group BY credit ORDER BY refid
 ");
                              $dex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='12' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                              $dex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='14' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  Group BY a.credit ORDER BY a.refid");
                              $bil5 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND   finyear = '".$_SESSION["finyearid"]."' and credit='5'  and mode='1'   and dr_cr='C' Group BY credit ORDER BY refid ");
                               $bil2 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where DATE(dayBookDate)>='$fromdate' AND DATE(dayBookDate) <= '$todate' AND   finyear = '".$_SESSION["finyearid"]."' and debit='4'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");

                               $inex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND b.act_group_head='13' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                               $inex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE DATE(a.dayBookDate)>='$fromdate' AND DATE(a.dayBookDate) <= '$todate' AND  b.act_group_head='15' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  Group BY a.credit ORDER BY a.refid");
                               //closing stock
                               $vmprd=$conn->query("SELECT * from us_products where pr_isactive='0' ");
                                           $amountz=0;
                                               while($rowprd = $vmprd->fetch_assoc())
                                                   {
                                                    $date= date('Y-m-d');
                                                     $vmsr=$conn->query("select * from us_stockreport where sr_itemid='".$rowprd['pr_productid']."' and DATE(sr_date)='$todate' order by sr_date desc limit 1");
                                                      if($rowsr = $vmsr->fetch_assoc())
                                                       {
                                                      $amountz = $amountz +  $rowsr['sr_amount'];
                                                        }
                                                        else{
                                                  $vmprd1=$conn->query("SELECT * from us_products where pr_productid='".$rowprd['pr_productid']."' and pr_date >= '$fromdate' and pr_date <'$todate' ");
                                                  $rowsrprd = $vmprd1->fetch_assoc();
                                                  
                                                   $vmpr=$conn->query("SELECT * from us_catogory where ca_categoryid='".$rowsrprd['pr_type']."' ");

                                                 $rowcat = $vmpr->fetch_assoc();

                                                 $taxper=$rowcat['ca_vat'];

                                                 $taxamt=$rowsrprd['pr_purchaseprice']*$taxper/100;
                                                 $purprice= $rowsrprd['pr_purchaseprice']+$taxamt;



                                        $amountz = $amountz + ($rowsrprd1s['pr_stock']*$purprice);

                                                        } }
                           echo "<h4>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h4>";
                         }



                         else{
                           $open = $conn->query("SELECT * FROM administrator_account_name where refid='1' ");
                           $open1 = $open->fetch_assoc();
                                                      $openbal=$open1['opening_balance'];
                            $bils = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and debit='6'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");
                             $bils1 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where finyear = '".$_SESSION["finyearid"]."' and credit='46' and mode='1'  and dr_cr='C' Group BY credit ORDER BY refid
 ");
                              $dex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE b.act_group_head='12' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                              $dex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE b.act_group_head='14' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  Group BY a.credit ORDER BY a.refid");
                              $bil5 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and credit='5'  and mode='1'  and dr_cr='C' Group BY credit ORDER BY refid ");
                               $bil2 = $conn->query("SELECT *,sum(dayBookAmount) as amnt,sum(bill_amnt) as billamnt FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and debit='4'  and mode='1'   and dr_cr='D' Group BY debit ORDER BY refid ");

                               $inex = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.debit= b.refid WHERE b.act_group_head='13' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='D'  Group BY a.debit ORDER BY a.refid");
                               $inex1 = $conn->query( "SELECT *,sum(a.dayBookAmount) as amnt,b.act_group_head FROM administrator_daybook a LEFT JOIN administrator_account_name b ON a.credit= b.refid WHERE b.act_group_head='15' and a.finyear = '".$_SESSION["finyearid"]."' and a.mode='1' and a.dr_cr='C'  Group BY a.credit ORDER BY a.refid");

                               //closing stock

                                       $vmprd=$conn->query("SELECT * from us_products where pr_isactive='0' ");
                                           $amountz=0;
                                               while($rowprd = $vmprd->fetch_assoc())
                                                   {
                                                    $date= date('Y-m-d');
                                                     $vmsr=$conn->query("SELECT * from us_stockreport where sr_itemid='".$rowprd['pr_productid']."' and DATE(sr_date)='$date' order by sr_date desc limit 1");
                                                      if($rowsr = $vmsr->fetch_assoc())
                                                       {
                                                      $amountz = $amountz +  $rowsr['sr_amount'];
                                                        }
                                                        else{
                                                  $vmprd1=$conn->query("SELECT * from us_products where pr_productid='".$rowprd['pr_productid']."' ");
                                                  $rowsrprd = $vmprd1->fetch_assoc();



                                                  $vmpr=$conn->query("SELECT * from us_catogory where ca_categoryid='".$rowsrprd['pr_type']."' ");

                                                 $rowcat = $vmpr->fetch_assoc();

                                                 $taxper=$rowcat['ca_vat'];

                                                 $taxamt=$rowsrprd['pr_purchaseprice']*$taxper/100;
                                                 $purprice= $rowsrprd['pr_purchaseprice']+$taxamt;





                                                  $amountz = $amountz + ($rowsrprd['pr_stock']*$purprice);

                                                        } }
                       // echo "<h3>ALL BILL DETAILS</h3>";
                         }
                ?>

                                    <!-- <button type="button"  style="float: right;" class="btn btn-primary btn-rounded"  onClick="showmodel()" float="right"><span class="glyphicon glyphicon-plus"></span>Add New</button><br><br>-->
                                    <form class="form-horizontal" method="post" action="profitandloss.php?fil=<?= $filt ?>">
                                        <!--<button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button>-->

                                         <div class="box" style="border: 1px solid black">

                                            <div class="panel panel-default">

                                             
                                                <div class="panel-heading">P/L Statement
                                                    <div class="muted pull-right">

                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="panel-body">


      <!-- --------------GRID 1-1  --------------------------- -->
                                                    	<div class="grid-container" >
                                                        <div class="grid-item" style="border-right: 1px solid black">
                                                 	<table width="80%"  cellpadding="3" cellspacing="3">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                                <tr height="30px" style="border-bottom: solid 1px black; ">
                                                                    <th><h4><b>Expenses</b></h4></th><td></td>
                                                                    <th style="text-align:right;"><h4><b>Amount(Rs)</b></h4></th>
                                                                    
                                                                   
                                                                </tr>
                                                                <tr height="40px"><td width="20%" style="text-align:left;">Opening Stock</td><td></td> <td align="right" width="10%">
                                                                 <?php
                                                                  $exptot=0;
                                                                  $pur=0;
                                                                 	
                                                       
                                                       echo $openbal;
                                                       $exptot=$exptot+$openbal;
                                                                 ?>
                                                             </td>
                                                       </tr>
                                                       <tr height="40px"><td width="20%">By Purchase</td> <td align="right" width="10%">
                                                          <?php
                                                           
                                                            while($rows = $bils->fetch_assoc())
                                                   {
                                                   	echo $rows['billamnt'];
                                                    $pur=$pur+$rows['billamnt'];
                                                       //$debittot=$debittot+$rows['billamnt'];
                                                   }
                                                          ?>
                                                       </td><td></td> 
                                                </tr>

                                                 <tr height="40px"><td width="20%">By Returns</td> <td align="right" width="10%">
                                                          <?php
                                                           if(mysqli_num_rows($bils1) > 0){
                                                            while($rows1 = $bils1->fetch_assoc())
                                                   {

                                                    echo $rows1['amnt'];
                                                    $pur=$pur-$rows1['amnt'];
                                                    $exptot=$exptot+$pur;
                                                    //echo $exptot;
                                                      // $debittot=$debittot+$rows1['amnt'];
                                                   }
                                                 }else{
                                                  echo "0";
                                                   $pur=$pur-0;
                                                    $exptot=$exptot+$pur;
                                                 }
                                                          ?>
                                                       </td> <td style="text-align: right;"><?php echo $pur; ?></td>
                                                </tr>
                                            <?php
                             
                             if(mysqli_num_rows($dex)>0)
                                               {
                                               	?>
                                               	 <tr height="40px"><td width="20%" style="text-align:left;"><U><B>DIRECT EXPENSES</B></U></td> <td align="right" width="10%">
                                       
                                   </td><td></td></tr>
                                               	<?php
                               while($rowdx = $dex->fetch_assoc())
                                                   {

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;"><?= $rowdx['acc_name']; ?></td><td></td> <td align="right" width="10%">
                                   <?php echo $rowdx['amnt']; 
                                    $exptot=$exptot+$rowdx['amnt']; 
                                   ?>
                               </td> 
                           </tr>
                           <?php }
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
                                                                   
                                                                    <th><h4><b>Income</b></h4></th><td></td>
                                                                    <th style="text-align:right;"><h4><b>Amount(Rs)</b></h4></th>
                                                                </tr>
                                                                <tr height="40px"><td width="20%">By Sales</td> <td align="right" width="10%">
                                                               <?php
                                                               $sale=0;
                                                               $intot=0;
                                                               
                                                               while($row5 = $bil5->fetch_assoc())
                                                   {
                                                   	echo $row5['billamnt'];
                                                    $sale=$sale+$row5['billamnt'];

                                                       //$debittot=$debittot+$row['billamnt'];
                                                   }

                                                               ?>
                                                           </td><td></td>
                                                       </tr>
                                                        <tr height="40px"><td width="20%">By Returns</td> <td align="right" width="10%">
                                                               <?php
                                                              if(mysqli_num_rows($bil2) > 0){
                                                               while($row2 = $bil2->fetch_assoc())
                                                   {
                                                    echo $row2['amnt'];
                                                    $sale=$sale-$row2['amnt'];
                                                      // $debittot=$debittot+$row2['amnt'];
                                                   } }else{
                                                  echo "0";
                                                   $sale=$sale-0;
                                                    //$exptot=$exptot+$sale;
                                                 }

                                                               ?>
                                                           </td><td style="text-align: right;"><?php echo $sale;

                                                            $intot=$intot+$sale; ?></td>
                                                       </tr>

                                                                    <?php
                             
                             if(mysqli_num_rows($dex1)>0)
                                               {
                                                ?>
                                                 <tr height="40px"><td width="20%" style="text-align:left;"><b><u>DIRECT INCOME</u></b></td> <td align="right" width="10%">
                                       
                                   </td><td></td></tr>
                                                <?php
                               while($rowdx1 = $dex1->fetch_assoc())
                                                   {

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;"><?= $rowdx1['acc_name']; ?></td><td></td> <td align="right" width="10%">
                                   <?php echo $rowdx1['amnt']; 
                                    $intot=$intot+$rowdx1['amnt']; 
                                   ?>
                               </td> 
                           </tr>
                           <?php }
                       }
                           ?>
                                                       <tr height="40px"> <td width="20%">Closing Stock</td><td></td> <td align="right" width="10%">
                                                      <?php


                                                      $close=$amountz;
                                                      echo $close;
                                                      $intot=$intot+$close;
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
                                                              if($intot>$exptot){
                                                                $dif=$intot-$exptot; 
                                                              ?>
                                                          <tr height="40px">
                                                  <td width="20%" style="text-align:left;"><b>Gross Profit</b></td> <td></td><td align="right" width="10%"><b>
                                                   <?php echo $dif;
                                                   $exptot1=$exptot+$dif;
                                                   ?>
                                               </b></td>
                                               
                                          </tr>
                                          <?php }
                                          ?>
                                          <tr height="40px" style="border-bottom: solid 1px black; "><td width="20%" style="text-align:left;"><b>Total</b></td> <td></td><td align="right" width="10%" class="total">
                                            <b>
                                            <?php if($exptot1 > 0){ echo $exptot1; }
                                            else{
                                              echo $exptot;
                                            }

                                            ?>
                                          </b>
                                        </td> 
                                    </tr>
                                       <tr height="40px"><td width="20%" style="text-align:left;"></td><td></td> <td align="right" width="10%" class="total">
                                            
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
                                                              if($exptot>$intot){
                                                                $dif1=$exptot-$intot; 
                                                              ?>
                                                                       <tr height="40px">
                                                  
                                               <td width="20%"><b>Gross Loss</b></td><td></td> <td align="right" width="10%"><b>
                                                 <?php echo $dif1;
                                                   $intot1=$intot+$dif1;
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
                                          <tr height="40px" style="border-bottom: solid 1px black; ">
                                           <td width="20%"><b>Total</b></td><td></td> <td align="right" width="10%" class="total"><b>
                                            <?php
                                            if($intot1>0){
                                            echo $intot1;
                                          }
                                          else{
                                             echo $intot;
                                          }
                                             ?>
                                           </b>
                                        </td>
                                    </tr>
                             <tr height="40px"><td width="20%" style="text-align:left;"></td><td></td> <td align="right" width="10%" class="total">
                                            
                                        </td> 
                                    </tr>
                           </tbody>
                    </table>
              </div>
   




<!-- ----------------------------------GRID 3-1------------------------------------ -->

                        <div class="grid-item" style="border-right: 1px solid black"><table width="80%" style="" cellpadding="3" cellspacing="3">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                               <?php
                                                              $expsum=0;
                                                              if($exptot>$intot){
                                                                $dif1=$exptot-$intot; 
                                                              ?>
                                                                       <tr height="40px">
                                                  
                                               <td width="20%"><b>By Gross Loss</b></td><td></td> <td align="right" width="10%"><b>
                                                 <?php echo $dif1;
                                                   $expsum=$expsum+$dif1;
                                                   ?>
                                              </b></td>
                                          </tr>
                                          <?php }
                                  
                             if(mysqli_num_rows($inex)>0)
                                               {
                                               	?>
                                               	 <tr height="40px"><td width="20%" style="text-align:left;"><b><u>INDIRECT EXPENSES</u></b></td> <td align="right" width="10%">
                                       
                                   </td>
                              </tr>
                                               	<?php
                               while($rowinx = $inex->fetch_assoc())
                                                   {

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;"><?= $rowinx['acc_name']; ?></td> <td align="right" width="10%">
                                   <?php echo $rowinx['amnt']; 

                                   $expsum=$expsum+$rowinx['amnt'];

                                   ?>
                               </td> 
                           </tr>
                           <?php }
                       }
                           ?>
                       </tbody>
                         </table></div>



<!-- ----------------------------------GRID 3-2------------------------------------ -->

                       <div class="grid-item" style="margin-left: 30px;"><table width="80%" style="" cellpadding="3" cellspacing="3">
                                                             <thead>
                                                            </thead>
                                                            <tbody>
                                                               <?php
                                                               $incsum=0;
                                                              if($intot>$exptot){
                                                                $dif=$intot-$exptot; 
                                                              ?>
                                                          <tr height="40px">
                                                  <td width="20%" style="text-align:left;">By Gross Profit</td> <td></td><td align="right" width="10%"><b>
                                                   <?php echo $dif;
                                                   $incsum=$incsum+$dif;
                                                   ?>
                                               </b></td>
                                               
                                          </tr>
                                          <?php }
                                          if(mysqli_num_rows($inex1)>0)
                                               {
                                                ?>
                                                 <tr height="40px"><td width="20%" style="text-align:left;"><b><u>INDIRECT INCOME</u></b></td> <td align="right" width="10%">
                                       
                                   </td>
                              </tr>
                                                <?php
                               while($rowinx1 = $inex1->fetch_assoc())
                                                   {

                               ?>
                               <tr height="40px"><td width="20%" style="text-align:left;"><?= $rowinx1['acc_name']; ?></td> <td></td><td align="right" width="10%">
                                   <?php echo $rowinx1['amnt']; 

                                   $incsum=$incsum+$rowinx1['amnt'];

                                   ?>
                               </td> 
                           </tr> 
                           <?php 
                         }}
                           ?>    
           </tbody>
       </table></div>


<!-- ----------------------------------GRID 4-1------------------------------------ -->

               <div class="grid-item" style="border-right: 1px solid black"><table width="80%" style="" cellpadding="3" cellspacing="3">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                               <?php
                                                               $expsum1=0;
                                                              if($incsum>$expsum){
                                                                $diftot=$incsum-$expsum; 
                                                              ?>
                                                          <tr height="40px">
                                                  <td width="20%" style="text-align:left;"><font color="red"><b>Net Profit</b></font></td> <td></td><td align="right" width="10%"><font color="red"><b>
                                                   <?php echo $diftot;
                                                   $expsum1=$expsum+$diftot;
                                                   ?>
                                               </b></font></td>
                                               
                                          </tr>
                                          <?php }else{
                                          ?>
                                           <tr height="40px">
                                                  
                                               <td width="20%"></td><td></td> <td align="right" width="10%">
                                                 
                                              </td>
                                          </tr>
                                          <?php }
                                          ?>
                                        
                                          <tr height="40px" style="border-top: solid 1px black; "><td width="20%" style="text-align:left;"><b>Total</b></td> <td></td><td align="right" width="10%" class="total">
                                            <b>
                                            <?php if($expsum1 > 0){ echo $expsum1; }
                                            else{
                                              echo $expsum;
                                            }

                                            ?>
                                          </b>
                                        </td> 
                                    </tr>
                                           </tbody>
       </table></div>
   


<!-- ----------------------------------GRID 4-2------------------------------------ -->

                        <div class="grid-item" style="margin-left: 30px;"><table width="80%" style="" cellpadding="3" cellspacing="3">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                                    <?php
                                                              $incsum1=0;
                                                              if($expsum>$incsum){
                                                                $dif1tot=$expsum-$incsum; 
                                                              ?>
                                                                       <tr height="40px">
                                                  
                                               <td width="20%"><font color="red"><b>Net Loss</b></font></td><td></td> <td align="right" width="10%"><font color="red"><b>
                                                 <?php echo $dif1tot;
                                                   $incsum1=$incsum+$dif1tot;
                                                   ?>
                                              </b></font></td>
                                          </tr>
                                          <?php }else{
                                          ?>
                                           <tr height="40px">
                                                  
                                               <td width="20%"></td><td></td> <td align="right" width="10%">
                                                 
                                              </td>
                                          </tr>
                                          <?php }
                                          ?>
                                          <tr height="40px" style="border-top: solid 1px black; ">
                                           <td width="20%"><b>Total</b></td><td></td> <td align="right" width="10%" class="total"><b>
                                            <?php
                                            if($incsum1>0){
                                            echo $incsum1;
                                          }
                                          else{
                                             echo $incsum;
                                          }
                                             ?>
                                           </b>
                                        </td>
                                    </tr>
                                                               </tbody>
       </table></div>
</div>


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