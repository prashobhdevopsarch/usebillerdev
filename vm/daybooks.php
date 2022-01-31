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
   
     
     
    
    $delete=$conn->query("UPDATE administrator_account_name SET isactive='1' and user_id='1' WHERE refid='$bill_id'");
    
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
                    <h3><strong>DAYBOOK</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Accounts</li>
                            <li class="active">DAYBOOK</li>
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
                                              
                                    <a href="bankbook.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right;"><i class="fa fa-backward"></i> BANK BOOK</button></a>
                                    <a href="cashbook.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> CASH BOOK</button></a>
                                    <a href="profitandloss.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> TRADING & PROFIT LOSS ACCOUNT</button></a>
                                    <a href="balancesheet.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> BALANCE SHEET</button></a>
                                    <a href="trailbalance.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right; margin-right: 15px"><i class="fa fa-backward"></i> TRAIL BALANCE</button></a>
                                    <!--<a href="exporthistory1.php?fil=<?= $filt ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span> Print</button></a>-->
                                    <h4 class="panel-title">DAYBOOK</h4>
                                </div>
                                
                                
                                <div class="panel-body">
                               <!-- <form action="billinghistory.php" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>-->
                                <?php
                                
                                if(isset($_POST['filter']))
                                               {
                                                 
                                                   $bil = $conn->query("SELECT * FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and user_id='1'  ORDER BY refid DESC");
                                                  
                                               }
                                               else{
                                                $bil = $conn->query("SELECT * FROM administrator_daybook where  finyear = '".$_SESSION["finyearid"]."' and mode='1' and user_id='1' ORDER BY refid DESC ");
                                               
                                               }
                                ?>
                                <?php
                                if(isset($_GET['id']))
                                {
                                    if($_GET["id"]=="success")
                                    {
                                    ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Deleted successfully.
                                    </div>
                                    <?php
                                }}
                                ?>

                                 <?php
                                if(isset($_GET['id1']))
                                {
                                    if($_GET["id1"]=="success")
                                    {
                                    ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Inserted successfully.
                                    </div>
                                    <?php
                                }}
                                ?>
                                    <div class="table-responsive project-stats"> 
                                    <br><br><br> 
                                   <!-- <button type="button"  style="float: right;" class="btn btn-primary btn-rounded"  onClick="showmodel()" float="right"><span class="glyphicon glyphicon-plus"></span>Add New</button><br><br>-->
                                    <form class="form-horizontal" method="post" action="ledger.php?fil=<?= $filt ?>">
                                    <!--<button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button>-->
                                       <table id="example" class="table" style="width: 100%; cellspacing: 0; text-align: center" border="1">
                                           <thead>
                                               <tr >
                                                   
                                                   <th style="text-align: center;">#</th>
                                                   <th style="text-align: center;">PARTICULARS</th>
                                                   <th style="text-align: center;">DEBIT</th>
                                                   <th style="text-align: center;">CREDIT</th>
                                                   <th style="text-align: center;">AMOUNT</th>
                                                   <th style="text-align: center;">DATE</th>
                                                       
                                                 
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
                                              
                                               if(mysqli_num_rows($bil)>0)
                                               {
                                                   $k = 1;
                                                   while($row = $bil->fetch_assoc())
                                                   {
                                               ?>
                                              
                                               <tr>
                                               
                                                   <th scope="row">
                                                   <?= $k ?>
                                                   </th>
                                                   <td><?php 
                                                   echo $row['description'];
                                                     
                                                  
                                                     ?></td>
                                                  
                                                   
                                                   
                                                   <td>
                                                       <?php

                                                      
                                                      

                                                        $part = $conn->query("SELECT * FROM administrator_account_name WHERE refid='".$row['debit']."' ");
                                                   $parts=$part->fetch_assoc();
                                                   echo $parts['acc_name'];
                                                     
                                                       ?>
                                                   </td>
                                                   <td>
                                                       <?php
                                                       

                                                        $part1 = $conn->query("SELECT * FROM administrator_account_name WHERE refid='".$row['credit']."' ");
                                                   $parts1=$part1->fetch_assoc();
                                                   echo $parts1['acc_name'];
                                                     
                                                       ?>
                                                   </td>
                                                    <td>
                                                       <?php
                                                       echo $row['dayBookAmount'];
                                                     
                                                       ?>
                                                   </td>
                                                    <td>
                                                       <?php
                                                       echo $row['dayBookDate'];
                                                     
                                                       ?>
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
     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Ledger</h4>
        </div>
        <div class="modal-body">
        <form action="ledger.php" method="post">
      
          <table class="pay" style="width:100%;">
       
        <tr>
        <td>Name</td><td><input  class="form-control" id="lname" name="lname"></td>
        </tr>
        <tr>
        <td>Group Head</td><td><select class="form-control" required id="ghead" name="ghead" >
             <option >--Select--</option>
             <?php
              $head = $conn->query("SELECT * FROM us_groupheads ");
               while($rowh = $head->fetch_assoc())
                                                   {
              ?>
            <option value="<?= $rowh['gr_id'] ?>"><?= $rowh['gr_head'] ?></option>
            <?php }
            ?>
            
        </select> </td>
        </tr>
        <tr>
        <td>Opening Balance</td><td><input  class="form-control" id="obalance" name="obalance"></td>
        </tr>
        <tr>
        <td>Closing Balance</td><td><input  class="form-control" id="cbalance" name="cbalance"></td>
        </tr>
         <tr>
        <td>Note</td><td><input  class="form-control" id="note" name="note"></td>
        </tr>
        <tr>
        
        
        <td></td><td align="right"><button class="btn btn-success" name="update1" type="submit">Update</button></td>
        
        </tr>
        </table>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
</div>
</div>


      </div>

      <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Ledger</h4>
          <input id="refid" name="refid" type="hidden">
        </div>
        <div class="modal-body">
        <form action="ledger.php" method="post">
      
          <table class="pay" style="width:100%;">
       
        <tr>
        <td>Name</td><td><input  class="form-control" id="lname1" name="lname1"></td>
        </tr>
        <tr>
        <td>Group Head</td><td><select class="form-control" required id="ghead1" name="ghead1" >
             <option >--Select--</option>
             <?php
              $head = $conn->query("SELECT * FROM us_groupheads ");
               while($rowh = $head->fetch_assoc())
                                                   {
              ?>
            <option value="<?= $rowh['gr_id'] ?>"><?= $rowh['gr_head'] ?></option>
            <?php }
            ?>
            
        </select> </td>
        </tr>
        <tr>
        <td>Opening Balance</td><td><input  class="form-control" id="obalance1" name="obalance1"></td>
        </tr>
        <tr>
        <td>Closing Balance</td><td><input  class="form-control" id="cbalance1" name="cbalance1"></td>
        </tr>
         <tr>
        <td>Note</td><td><input  class="form-control" id="note1" name="note1"></td>
        </tr>
        <tr>
        
        
        <td></td><td align="right"><button class="btn btn-success" name="update11" type="submit">Update</button></td>
        
        </tr>
        </table>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
</div>
</div>


      </div>

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