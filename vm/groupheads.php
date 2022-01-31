<?php
session_start();
if(isset($_SESSION['admin']))
{
    include("includes/config.php");
   
    if(isset($_POST["update1"]))
    {
        
        $ghead=$_POST["ghead"];
        
        $types=$_POST["types"];
        
        //echo print_r($_POST);
       
        
        $instrt=$conn->query("INSERT INTO us_groupheads(gr_head, gr_type) VALUES('$ghead','$types')");
           
       
        if($instrt )
        {
            //$suc=minusbalance($conn,$newpay,$_SESSION["admin"],$csid);
            
            header("location:groupheads.php?id=success");
            
        }else{header('Location:groupheads.php?id=faill');}
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
                    <h3><strong>GROUP HEADS</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Accounts</li>
                            <li class="active">Group Heads</li>
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
                                    <h4 class="panel-title">Group Heads</h4>
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
                                                 
                                                   $bil = $conn->query("SELECT * FROM us_groupheads");
                                                  
                                               }
                                               else{
                                                $bil = $conn->query("SELECT * FROM us_groupheads ");
                                               
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
                                        Group Head added successfully.
                                    </div>
                                    <?php
                                }}
                                ?>
                                    <div class="table-responsive project-stats">  
                                    <button type="button"  style="float: right;" class="btn btn-primary btn-rounded"  onClick="showmodel()" float="right"><span class="glyphicon glyphicon-plus"></span>Add New</button><br><br>
                                    <form class="form-horizontal" method="post" action="groupheads.php?fil=<?= $filt ?>">
                                    <!--<button type="submit" class="btn btn-primary" name="print_bar" style="float:right;">Export</button>-->
                                       <table id="example" class="table" style="width: 100%; cellspacing: 0; text-align: center" border="1">
                                           <thead>
                                               <tr >
                                                   
                                                   <th style="text-align: center;">#</th>
                                                   <th style="text-align: center;">GROUP HEAD</th>
                                                   <th style="text-align: center;">TYPE</th>
                                                   
                                                  
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
                                                   <td><?= $row['gr_head'] ?></td>
                                                  
                                                   
                                                   
                                                   <td>
                                                       <?php
                                                       echo $row['gr_type'];
                                                     
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
                    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Group Head</h4>
        </div>
        <div class="modal-body">
        <form action="groupheads.php" method="post">
      
          <table class="pay" style="width:100%;">
       
        <tr>
        <td>Head</td><td><input  class="form-control" id="ghead" name="ghead"></td>
        </tr>
        <tr>
        <td>Type</td><td><select class="form-control" required id="types" name="types" >
             <option >--Select--</option>
            <option value="ASSET">ASSET</option>
             <option value="LIABILITY">LIABILITY</option>
        </select> </td>
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
        <script type="text/javascript">
            
            function showmodel()
        {
          
            
            $('#myModal').modal('show'); 
        }
        </script>
        
    </body>

</html>
<?php
}else{
    header("Location:index.php");
}
?>