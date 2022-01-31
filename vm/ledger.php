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
                    <h3><strong>LEDGER</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Accounts</li>
                            <li class="active">Ledger</li>
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
                                    <h4 class="panel-title">LEDGER</h4>
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
                                                 
                                                   $bil = $conn->query("SELECT * FROM administrator_account_name where isactive=0 and finyear = '".$_SESSION["finyearid"]."'   ORDER BY refid ASC");
                                                  
                                               }
                                               else{
                                                $bil = $conn->query("SELECT * FROM administrator_account_name where isactive=0 and finyear = '".$_SESSION["finyearid"]."'  ORDER BY refid ASC ");
                                               
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
                                    <button type="button"  style="float: right;" class="btn btn-primary btn-rounded"  onClick="showmodel()" float="right"><span class="glyphicon glyphicon-plus"></span>Add New</button><br><br>
                                    <form class="form-horizontal" method="post" action="ledger.php?fil=<?= $filt ?>">
                                    <!--<button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button>-->
                                       <table id="example" class="table" style="width: 100%; cellspacing: 0; text-align: center" border="1">
                                           <thead>
                                               <tr >
                                                   
                                                   <th style="text-align: center;">#</th>
                                                   <th style="text-align: center;">NAME</th>
                                                   <th style="text-align: center;">GROUP HEAD</th>
                                                   <th style="text-align: center;">OPENING BALANCE</th>
                                                   <th style="text-align: center;">CLOSING BALANCE</th>
                                                   <th style="text-align: center;">NOTE</th>
                                                  <th style="text-align: center;">ACTION</th>
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
                                                   <td><?= $row['acc_name'] ?></td>
                                                  
                                                   
                                                   
                                                   <td>
                                                       <?php

                                                       $grp = $conn->query("SELECT * FROM us_groupheads where gr_id='".$row['act_group_head']."' ");
                                                       $rowg = $grp->fetch_assoc();
                                                       echo $rowg['gr_head'];
                                                     
                                                       ?>
                                                   </td>
                                                   <td>
                                                       <?php
                                                       echo $row['opening_balance'];
                                                     
                                                       ?>
                                                   </td>
                                                    <td>
                                                       <?php
                                                       echo $row['closing_balance'];
                                                     
                                                       ?>
                                                   </td>
                                                    <td>
                                                       <?php
                                                       echo $row['note'];
                                                     
                                                       ?>
                                                   </td>
                                                   <td>
                                                    <?php
                                                    if($row['refid'] == '1'){

                                                    ?>
                                                    <a href="cashbook.php?refid=1"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php
                                                  }
                                                    else if($row['refid'] == '13'){

                                                    ?>
                                                    <a href="bankbook.php?refid=13"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <?php }
                                                      else {

                                                        ?>
                                                    <a href="ledgerview.php?refid=<?=$row['refid']?>"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <?php } ?>
                                                    
                                                   <!-- <span class="glyphicon glyphicon-edit"  onClick="showmodel1(<?= $row["refid"] ?>,'<?= $row["acc_name"] ?>','<?= $rowg['gr_head'] ?>','<?= $row["opening_balance"] ?>','<?= $row["closing_balance"] ?>','<?= $row["note"] ?>')" title="edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                   
                                                   <a onClick="return confirm('Are you sure you want to delete?')" href="ledger.php?billid=<?=$row['refid']?>&delete"><span class="glyphicon glyphicon-remove" title="delete"></span></a>--></td>
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
          <input id="refid" name="refid" type="text">
        </div>
        <div class="modal-body">
        <form action="ledger.php" method="post">
      
          <table class="pay" style="width:100%;">
       
        <tr>
        <td>Name</td><td><input  class="form-control" id="lname1" type="text" name="lname1"></td>
        </tr>
        <tr>
        <td>Group Head</td><td><select class="form-control"  required id="ghead1"  name="ghead1" >
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
         function showmodel1(refid,accname,head,opening,closing,note)
        {
         //alert("");
          document.getElementById("refid").value=Number(refid);
           document.getElementById("lname1").value=accname;
            document.getElementById("ghead1").value=head;
             document.getElementById("obalance1").value=opening;
              document.getElementById("cbalance1").value=closing;
            document.getElementById("note1").value=note;
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