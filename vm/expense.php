<?php
session_start();
if (isset($_SESSION['admin'])) {
    include("includes/config.php");
    if (isset($_POST['submit1'])) {
        $name = $_POST['name'];
        $particulars = $_POST['particulars'];
        //$transactiontype=$_POST['type'];
        $transactiontype = "income";
        $date = $_POST['date'];
        $time = $_POST['time'];
        $note = $_POST['note'];
        $datetime = date("Y-m-d", strtotime($_POST["date"])) . " " . date("H:i:s", strtotime($_POST["time"]));
        $datecc = date("Y-m-d", strtotime($_POST["date"]));
        $amount = $_POST['amount'];

        $slct_empnum = $conn->query("SELECT	tr_closingbalance FROM us_transaction ORDER BY tr_id DESC LIMIT 1");
        if (mysqli_num_rows($slct_empnum) > 0) {
            $last = $slct_empnum->fetch_assoc();
            $openingbalance = $last['tr_closingbalance'];
        } else {
            $openingbalance = 0;
        }

        if ($transactiontype == 'expense') {
            $closingbalance = $openingbalance - $amount;
        } elseif ($transactiontype == 'income') {
            $closingbalance = $openingbalance + $amount;
        }

        $slct = $conn->query("SELECT * FROM us_transaction WHERE rpt_status = 'r' ORDER BY tr_id DESC LIMIT 1");
        $rowacnt = $slct->fetch_assoc();
        $rpno = $rowacnt["rpt_no"];
        if ($rpno == 0) {
            $rpno = 1;
        } else {
            $rpno = $rpno + 1;
        }
          $note=$note." - Receipt No :".$rpno;
        $insrtacnt = $conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,mode,dr_cr,user_id) VALUES('" . $_SESSION["admin"] . "',NOW(),'$name','$particulars','Y','$amount','$note','" . $_SESSION["finyearid"] . "','1','C','" . $_SESSION["admin"] . "')");
        $acntid2 = $conn->insert_id;

        $insert = $conn->query("insert into us_transaction(tr_name,tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,user_id, tr_mode, tr_accid,finyear,rpt_no,rpt_status)
values('$name','$particulars',' $openingbalance','$amount','$closingbalance','$datetime','$note','" . $_SESSION["admin"] . "', '1','$acntid2','" . $_SESSION["finyearid"] . "','$rpno','r')");
        $trid = $conn->insert_id;
        if ($insert) {
            if ($transactiontype == 'expense') {
                header("location:expensevoucher.php?trid=$trid");
            } else if ($transactiontype == 'income') {
                header("location:expensereciept.php?trid=$trid");
            }
        } else {
            header("location:expense.php?er");
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
                        <h3><strong>Expense</strong></h3>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="active">Expense</li>
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
    if (isset($_GET['id'])) {
        ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            Saved successfully.
                                        </div>
        <?php
    }
    if (isset($_GET['er'])) {
        ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

                                            Error occured, please try again.
                                        </div>
        <?php
    }
    ?>
                                    <div class="panel-body">

                                        <div class="project-stats">  
                                            <div class="page-breadcrumb">
                                                <a href="jurnel.php"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right">Jurnel</button></a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="contra.php"><button type="button"  class="btn btn-primary btn-addon m-b-sm" style="float: right;margin-right:13px;">Contra</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="expense.php"><button type="button"  class="btn btn-primary btn-addon m-b-sm" style="float: right;margin-right:13px;">Receipt & Voucher</button></a>


                                                <ol class="breadcrumb">
                                                    <h1>Voucher</h1>
                                                </ol>
                                            </div>
                                            &nbsp;Voucher No:
                                            <?php
                                            
                                            $slct = $conn->query("SELECT * FROM us_transaction WHERE rpt_status = 'v' ORDER BY tr_id DESC LIMIT 1");
        $rowacnt = $slct->fetch_assoc();
        $rpno = $rowacnt["rpt_no"];
        if ($rpno == 0) {
            $rpno = 1;
        } else {
            $rpno = $rpno + 1;
        }
                 echo  $rpno;                          ?>
                                            <form class="form-horizontal"  method="post" action="voucher.php" enctype="multipart/form-data">
                                                <div class="table-responsive">
                                                    <input type="hidden" name="billno" id="billno" value="">   
                                                    <div class="table-responsive">                                        
                                                        <table class="table" id="drgcartitms">
                                                            <thead>
                                                                <tr>
                                                                    <th>Pay Mode</th>
                                                                    <th>Pay To</th>
                                                                    <th>Note</th>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width:124px;"><select name="name" style="width: 136px;" id="name" class="form-control">
    <?php
    $sql1 = "SELECT * FROM administrator_account_name WHERE act_group_head IN ('7', '8') and user_id ='" . $_SESSION["admin"] . "' ";
    $sql = $conn->query("$sql1");

    while ($rowcat = $sql->fetch_assoc()) {
        ?>

                                                                                <option  value="<?= $rowcat["refid"] ?>"><?= $rowcat["acc_name"] ?>

                                                                                </option>
    <?php } ?>
                                                                        </select></td>

                                                                    <td style="width:124px;"><select style="width: 136px;" name="particulars"  class="form-control">
    <?php
    $sql2 = "SELECT * FROM administrator_account_name where user_id ='" . $_SESSION["admin"] . "'";
    $sqlq = $conn->query("$sql2");

    while ($rowcat1 = $sqlq->fetch_assoc()) {
        ?>

                                                                                <option  value="<?= $rowcat1["refid"] ?>"><?= $rowcat1["acc_name"] ?>

                                                                                </option>
                                                                            <?php } ?>
                                                                        </select></td>
                                                                    <td style="width:124px;"><input type="text" required  class="form-control" placeholder="Note" name="note" id="note">
                                                                    </td>
                                                                    <td> <input type="date" name="date" id="date" class="form-control"></td>
                                                                    <td><input type="time" name="time" id="time" value="<?= date('H:i') ?>" class="form-control"></td></td>
                                                                    <td><input type="text" required  class="form-control" placeholder="Amount" name="amount" id="amout"></td>

                                                                </tr>                           
                                                            </tbody>
                                                        </table>
                                                    </div> 

                                                    <div class="form-group" align="right" style="padding-right:30px;">
                                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                                        <button type="submit" name="submit" class="btn btn-primary">Save & Print</button>
                                                    </div></div>
                                            </form>
                                        </div>
                                        <div class="page-breadcrumb">
                                            <ol class="breadcrumb">
                                                <h1>Reciept</h1>
                                            </ol>
                                        </div>
                                         &nbsp;Reciept No:
                                            <?php
                                            
                                            $slct = $conn->query("SELECT * FROM us_transaction WHERE rpt_status = 'r' ORDER BY tr_id DESC LIMIT 1");
        $rowacnt = $slct->fetch_assoc();
        $rpno = $rowacnt["rpt_no"];
        if ($rpno == 0) {
            $rpno = 1;
        } else {
            $rpno = $rpno + 1;
        }
                 echo  $rpno;                          ?>
                                        <div class="project-stats">  

                                            <form class="form-horizontal" name="addbilldetails" method="post" action="expense.php" enctype="multipart/form-data">
                                                <div class="table-responsive">
                                                    <input type="hidden" name="billno" id="billno" value="">   
                                                    <div class="table-responsive">                                        
                                                        <table class="table" id="drgcartitms">
                                                            <thead>
                                                                <tr>
                                                                    <th>Pay From</th>
                                                                    <th>To</th>
                                                                    <th>Note</th>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width:124px;"><select style="width: 136px;" name="particulars"  class="form-control">
    <?php
    $sql2 = "SELECT * FROM administrator_account_name where user_id ='" . $_SESSION["admin"] . "'";
    $sqlq = $conn->query("$sql2");

    while ($rowcat1 = $sqlq->fetch_assoc()) {
        ?>

                                                                                <option  value="<?= $rowcat1["refid"] ?>"><?= $rowcat1["acc_name"] ?>

                                                                                </option>
    <?php } ?>
                                                                        </select></td>
                                                                    <td style="width:124px;"><select name="name" style="width: 136px;" id="nme<?= $k ?>" class="form-control">
    <?php
    $sql1 = "SELECT * FROM administrator_account_name WHERE act_group_head IN ('7', '8') and user_id ='" . $_SESSION["admin"] . "' ";
    $sql = $conn->query("$sql1");

    while ($rowcat = $sql->fetch_assoc()) {
        ?>

                                                                                <option  value="<?= $rowcat["refid"] ?>"><?= $rowcat["acc_name"] ?>

                                                                                </option>
                                                                            <?php } ?>
                                                                        </select></td>


                                                                    <td style="width:124px;"><input type="text" required  class="form-control" placeholder="Note" name="note" id="note">
                                                                    </td>
                                                                    <td> <input type="date" name="date" id="date" class="form-control"></td>
                                                                    <td><input type="time" name="time" id="time" value="<?= date('H:i') ?>" class="form-control"></td></td>
                                                                    <td><input type="text" required  class="form-control" placeholder="Amount" name="amount" id="amout"></td>

                                                                </tr>                           
                                                            </tbody>
                                                        </table>
                                                    </div> 

                                                    <div class="form-group" align="right" style="padding-right:30px;">
                                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                                        <button type="submit" name="submit1" class="btn btn-primary">Save & Print</button>
                                                    </div></div>
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
} else {
    header("Location:index.php");
}
?>