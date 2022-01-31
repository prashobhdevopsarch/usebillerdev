<?php
session_start();
if (isset($_SESSION['admin'])) {
    include("includes/config.php");

    if (isset($_POST['update'])) {
        $billid = $_POST['billid'];
        $customerid = $_POST['customerid'];
        $balance = $_POST['balance'];
        $newpayment = $_POST['newpay'];
        $newbalance = $_POST['newbalance'];

        //echo print_r($_POST);
        $sql = "INSERT INTO us_payment(pa_billid, pa_customerid, pa_balance, pa_newpayment, pa_newbalance, pa_updatedon, user_id) VALUES('$billid','$customerid','$balance','$newpayment','$newbalance',NOW(),'" . $_SESSION["admin"] . "')";
        $sql1 = $conn->query("$sql");
        $payid = $conn->insert_id;
        if ($sql1) {

            $sql2 = $conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");

            $row = $sql2->fetch_assoc();
            $updatebal = $row['be_balance'] - $newpayment;
            $updatepaid = $row['be_paidamount'] + $newpayment;

            $sql3 = "UPDATE  us_billentry SET be_balance='$updatebal', be_paidamount='$updatepaid' WHERE be_billid='$billid'";
            $sql4 = $conn->query("$sql3");

            $sql5 = $conn->query("SELECT * FROM us_customer WHERE cs_customerid='$customerid'");
            $rowcat = $sql5->fetch_assoc();
            $updatebal1 = $rowcat['cs_balance'] - $newpayment;


            if ($sql1) {
                header("Location:newpay_print.php?id=success&payid=" . $payid);
            } else {
                header('Location:view.php?id=faill&csid=' . $customerid);
            }
        } else {
            header('Location:view.php?id=faill2&csid=' . $customerid);
        }
    }

    if (isset($_POST["update1"])) {

        $acount = $_POST["acount"];

        $newbal = $_POST["newbalance"];
        $csid = $_POST["csid"];
        $newpay = $_POST["newpay"];
        $balance = $_POST["balance"];
        //echo print_r($_POST);
        //$supid=$_GET['supid'];
        $slctacntname = $conn->query("SELECT * FROM us_supplier a, administrator_account_name b WHERE b.refid=a.rs_acntid AND a.rs_supplierid='$csid'");
        $cusacnt = $slctacntname->fetch_assoc();
        $scntname = $cusacnt["acc_name"];
        $ref = $cusacnt["refid"];
        $slct = $conn->query("SELECT * FROM us_transaction WHERE rpt_status = 'v' ORDER BY tr_id DESC LIMIT 1");
        $rowacnt = $slct->fetch_assoc();
        $rpno = $rowacnt["rpt_no"];
        if ($rpno == 0) {
            $rpno = 1;
        } else {
            $rpno = $rpno + 1;
        }
        $slct_empnum = $conn->query("SELECT	tr_closingbalance FROM us_transaction ORDER BY tr_id DESC LIMIT 1");
        if (mysqli_num_rows($slct_empnum) > 0) {
            $last = $slct_empnum->fetch_assoc();
            $openingbalance = $last['tr_closingbalance'];
        } else {
            $openingbalance = 0;
        }
        $closingbalance = $openingbalance - $newpay;
        //$instrt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description) VALUES('".$_SESSION["admin"]."',NOW(),'$scntname','$acount','Y','$newpay','Supplier Balance Payment')");
        $insrtacnt = $conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount,finyear,mode,dr_cr,user_id,description) VALUES('" . $_SESSION["admin"] . "',NOW(),'$ref','1','Y','$newpay','" . $_SESSION["finyearid"] . "','1','D','" . $_SESSION["admin"] . "','Supplier Balance Payment - Voucher No:$rpno')");
        $trid = $conn->insert_id;
        $insert = $conn->query("insert into us_transaction(tr_name,tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,user_id, tr_mode, tr_accid,finyear,rpt_no,rpt_status)
values('1','$ref',' $openingbalance','$newpay','$closingbalance',NOW(),'Supplier Balance Payment - Voucher No:$rpno','" . $_SESSION["admin"] . "', '1','$trid','" . $_SESSION["finyearid"] . "','$rpno','v')");
        $tridd = $conn->insert_id;
        $update = $conn->query("UPDATE us_supplier SET rs_balance='$newbal' WHERE rs_supplierid='$csid'");

        $sql = "INSERT INTO us_payment(pa_customerid, pa_balance, pa_newpayment, pa_newbalance, pa_updatedon, user_id, pa_mode, pa_transactionid) VALUES('$csid','$balance','$newpay','$newbal',NOW(),'" . $_SESSION["admin"] . "','2','$trid')";
        $sql1 = $conn->query("$sql");
        $payid = $conn->insert_id;
        $max_slct1 = $conn->query("SELECT pe_billid,pe_paidamount,pe_balance,pe_billdate FROM us_purentry WHERE  user_id='" . $_SESSION["admin"] . "' AND pe_supplierid='$csid' AND pe_isactive='0'  and pe_balance>0   ORDER  BY pe_billdate");
        $newpay = -($newpay);
        while (($max_row1 = $max_slct1->fetch_assoc()) && $newpay < 0) {

            $paid = $max_row1['pe_paidamount'];
//$payment=$payment+$amount[$n];
            $balance1 = $max_row1['pe_balance'];
            $pay = $newpay;
            $newpay = $balance1 + $newpay;

            if ($newpay < 0) {

                $new = 0;
                $paid = $paid + $balance1;
            } else {
                $new = $newpay;
                $paid = $paid + (-($pay));
            }
            $bid1 = $max_row1['pe_billid'];

            $update1N = "UPDATE us_purentry SET  pe_balance='$new', pe_paidamount='$paid',pe_paid='1'   WHERE pe_billid='" . $bid1 . "' and pe_balance>'0' and user_id='" . $_SESSION["admin"] . "' and pe_supplierid='$csid' ";

echo "UPDATE us_purentry SET  pe_balance='$new', pe_paidamount='$paid',pe_paid='1'   WHERE pe_billid='" . $bid1 . "' and pe_balance>'0' and user_id='" . $_SESSION["admin"] . "' and pe_supplierid='$csid'";


            $update11N = $conn->query($update1N);
        }
//exit();
        if ($update && $sql1) {
           // $suc = minusbalancepur($conn, $newpay, $_SESSION["admin"], $csid);
           
                $b = "supplierview.php?supid=" . $csid;

                header("location:expensevoucher.php?back=$b&trid=$tridd");
                //header("location:newpay_print.php?id=success&payid=".$payid."&back=supplierview.php?supid=".$csid);
            
        } else {
            header('Location:supplierview.php?id=faill2&csid=' . $csid);
        }
    }
    if (isset($_GET["delete"])) {
        $billid = $_GET["billid"];
        $supid = $_GET["supid"];
        $oldbal = $_GET["oldbal"];
        $acc = $conn->query("SELECT * FROM us_purentry WHERE pe_billid='$billid'");
        $rowacc = $acc->fetch_assoc();
        $debitid = $rowacc["pe_debitid"];
        $creditid = $rowacc["pe_creditid"];
        //$creditid= $rowacc["be_creditid"];
        if ($debitid != "" && $creditid != "") {
            $delet2 = $conn->query("DELETE FROM administrator_daybook WHERE refid='" . $debitid . "'");
            $delet3 = $conn->query("DELETE FROM administrator_daybook WHERE refid='" . $creditid . "'");
        }

        $delete = $conn->query("UPDATE us_purentry SET pe_isactive='1' WHERE pe_billid='$billid' AND pe_supplierid='$supid'");
        $slct = $conn->query("update us_transaction set tr_isactive='1' where tr_billid='$billid' and tr_transactiontype='expense' AND user_id='" . $_SESSION["admin"] . "'");
        if ($delete && $slct) {
            $cusbal = $conn->query("UPDATE us_supplier SET rs_balance='$oldbal' WHERE rs_supplierid='$supid'");
            $updatstk = updatestockp($conn, $billid, $csid, $_SESSION["admin"]);
            if ($updatstk == "succ") {
                header('Location:supplierview.php?id=success&supid=' . $supid);
            } else {
                header('Location:view.supplierview?id=faill1&supid=' . $supid);
            }
        }//else{header('Location:supplierview.php?id=faill&supid='.$supid);}
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
                        <h3><strong>Supplier Details</strong></h3>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="dashboard.php">Billing</a></li>
                                <li>Supplier Management</a></li>
                                <li>Supplier List</a></li>
                                <li class="active">View</li>
                            </ol>
                        </div>
                    </div>

                    <div id="main-wrapper">
                        <!-- Row -->
                        <div class="row">

                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Supplier Details</h4>

                                        <a href="supplierlist.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right"><i class="fa fa-backward"></i> back</button></a>
                                    </div>
                                    <div class="panel-body">
    <?php
    if (isset($_GET['id'])) {
        if ($_GET["id"] == "fail") {
            ?>
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    Error occured.. Please try again...
                                                </div>
            <?php
        }
    }
    ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                        <?php
                                        $supid = $_GET['supid'];
                                        $slct = $conn->query("SELECT * FROM us_supplier WHERE rs_supplierid='$supid'");
                                        $rowcus = $slct->fetch_assoc();
                                        ?>
                                                <table class="pading">
                                                    <tbody>


                                                        <tr><td><h4>Company Name</h4></td><td> &nbsp;: <?= $rowcus["rs_company_name"] ?></td></tr>
                                                        <tr><td><h4>Supplier Name</h4></td><td> &nbsp;: <?= $rowcus["rs_name"] ?></td></tr>
                                                        <tr><td><h4>Phone Number</h4></td><td> &nbsp;: <?= $rowcus["rs_phone"] ?></td></tr>
                                                        <tr><td><h4>Address</h4></td><td> &nbsp;: <?= $rowcus["rs_address"] ?></td></tr>
                                                        <tr><td><h4>Email</h4></td><td> &nbsp; : <?= $rowcus["rs_email"] ?></td></tr>
                                                        <tr><td><h4>GSTIN</h4></td><td> &nbsp; : <?= $rowcus["rs_tinnum"] ?></td></tr>
                                                        <tr><td colspan="2">&nbsp;</td></tr>
                                                        <tr><td><h4>Balance</h4></td><td> &nbsp; : <?= $rowcus["rs_balance"] ?> </td></tr>

                                                        <tr><td><button type="button" class="btn btn-primary btn-rounded" onClick="showmodel(<?= $rowcus["rs_balance"] ?>)">Pay</button></td><td> &nbsp; <button type="button" class="btn btn-primary btn-rounded" onClick="showHint(2,<?= $supid ?>)">Pay History</button></td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
    <!--<table class="table">
        <td align="right">Total Amount:</td>
        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;"></td>
    </table>-->



                                    </div>
                                </div>
    <?php
    if (isset($_GET['id'])) {
        if ($_GET["id"] == "success") {
            ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            Updated  successfully.
                                        </div>
            <?php
        }
    }
    ?>
                                <div id="main-wrapper">

                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12" style="padding:0px;">
                                            <div class="panel panel-white">

    <?php
    //$bill=$_POST['bill'];

    if (isset($_POST['filter'])) {
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];
        $filt = $fromdate . "$" . $todate;
    } else {
        $filt = "all";
    }
    ?>
        <div class="panel-heading"><!--<a href="custexport_printrealhelper.php?fil=<?= $filt ?>&csid=<?= $customerid ?>" target="blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" onclick="return confirm('Do you want to Print a Statement?')" style="float:right;"><span class="glyphicon glyphicon-print"></span>Statement</button></a>-->
                                                    <a href="sup_bill_report.php?fil=<?= $filt ?>&supid=<?= $supid ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span>Print</button></a>
                                                    <a href="sup_bill_export.php?fil=<?= $filt ?>&supid=<?= $supid ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right; margin-right:10px;"><span class="glyphicon glyphicon-print"></span>Export</button></a>
                                                    <h4 class="panel-title">Supplier History</h4>
                                                </div>



                                                <div class="panel-body">
                                                    <form action="supplierview.php?supid=<?= $supid ?>" method="post">
                                                        <input type="date" name="fromdate" id="fromdate">
                                                        <input type="date" name="todate" id="todate">
                                                        <button type="submit" name="filter">Filter</button>
                                                    </form>
                                                <?php
                                                if (isset($_POST['filter'])) {
                                                    $fromdate = $_POST['fromdate'];
                                                    $todate = $_POST['todate'];
                                                    $tablconn = $conn->query("SELECT * FROM us_purentry WHERE DATE(pe_billdate)>='$fromdate' AND DATE(pe_billdate) <= '$todate' AND pe_isactive='0' AND user_id='" . $_SESSION["admin"] . "' AND pe_supplierid='$supid' ORDER BY pe_billid DESC");
                                                    echo "<h3>From Date: " . date('d-M-Y', strtotime($fromdate)) . " &nbsp; &nbsp; To Date: " . date('d-M-Y', strtotime($todate)) . "</h3>";
                                                } else {
                                                    $tablconn = $conn->query("SELECT * FROM us_purentry WHERE pe_isactive='0' AND user_id='" . $_SESSION["admin"] . "' AND pe_supplierid='$supid' ORDER BY pe_billid DESC");
                                                    echo "<h3>ALL BILL DETAILS</h3>";
                                                }
                                                ?>



                                                    <div class="panel-body">
                                                        <div class="table-responsive project-stats">  
                                                            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">


                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Bill No</th>
                                                                        <th>Bill Date</th>                  
                                                                        <th>Items</th>
                                                                        <th>Total</th>
                                                                        <th>Discount</th>
                                                                        <th>OB</th>
                                                                        <th>Grant Total</th>
                                                                        <th>Paid Amount</th>
                                                                        <th>Balance</th>
                                                                        <th>status</th>
                                                                        <th>#</th>
                                                                        <th>Action</th>


                                                                    </tr>
                                                                </thead>
                                                                <tbody>
    <?php
    $k = 1;

    $totalamnt = 0;
    $today = date('Y-m-d');


    if ($tablconn) {
        while ($rowcat = $tablconn->fetch_assoc()) {
            ?>
                                                                            <tr>


                                                                                <td><?= $k ?></td>
                                                                                <td><?= $rowcat["pe_billnumber"] ?></td>
                                                                                <td>
            <?= date('d-m-Y', strtotime($rowcat['pe_billdate'])) ?>
                                                                                </td>
                                                                                <td>
                                                                            <?php
                                                                            $billid = $rowcat['pe_billid'];
                                                                            $itms = $conn->query("SELECT * FROM us_puritems a LEFT JOIN us_products b ON b.pr_productid=a.pi_productid WHERE a.pi_billid='$billid'");
                                                                            $n = 1;
                                                                            while ($row2 = $itms->fetch_assoc()) {
                                                                                echo $n . ". " . $row2['pr_productname'] . ", <b>Purchase Price:</b>" . $row2['pi_price'] . ", <b>Qty:</b>" . $row2['pi_quantity'] . ", <b>Discount:</b>, <b>Total:</b>" . $row2['pi_total'] . "<br/>";
                                                                                $n++;
                                                                            }
                                                                            ?>
                                                                                </td>
                                                                                <td><?= $rowcat['pe_total'] ?></td>
                                                                                <td><?= $rowcat['pe_discount'] ?></td>
                                                                                <td><?= $rowcat['pe_oldbal'] ?></td>
                                                                                <td>
            <?= $rowcat['pe_gtotal']; ?>
                                                                                </td>
                                                                                <td><?= $rowcat['pe_paidamount'] ?></td>
                                                                                <td>
            <?php
            echo $rowcat['pe_balance'];

            // echo   $_GET['csbal'];
            ?>
                                                                                </td>
                                                                                <td><?php
                                                                                    $date1 = date_create(date('d-m-Y', strtotime($rowcat['pe_billdate'])));
                                                                                    $date2 = date_create(date('d-m-Y'));
                                                                                    $diff = date_diff($date1, $date2);

                                                                                    echo $diff->format("%a days");
                                                                                    ?>     </td>
                                                                                <td>
            <?php
            if ($rowcat['pe_paid'] == '1' && $rowcat['pe_balance'] == '0') {
                ?>
                                                                                        <button type="button" class="btn btn-primary btn-rounded" style="background-color: green;">CLOSED</button>
                <?php
            } else if ($rowcat['pe_balance'] > '0') {
                ?>
                                                                                        <button type="button" class="btn btn-primary btn-rounded" style="background-color: red;">PENDING</button>
                                                                                        <?php
                                                                                    } else {
                                                                                        
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                                      <!-- <td>
                                                                                    <?php if ($rowcat['pe_balance'] != 0) { ?><button class="btn btn-success" onClick="newpay(<?= $rowcat['pe_billid'] ?>,<?= $customerid ?>,<?= $rowcat['be_balance'] ?>)" id="myBtn">Received</button><?php } else {
                                                                        echo "<b>Completed</b>";
                                                                    } ?>
                                                                                                       </td>-->
                                                                                <td><a href="purc_print.php?billid=<?= $rowcat['pe_billid'] ?>&back=<?= $page ?>&supid=<?= $_GET["supid"] ?>"><span class="glyphicon glyphicon-print"></span> print</a><br>
                                                                                    <?php
                                                                                    $slctdil = $conn->query("SELECT pe_billid FROM us_purentry WHERE user_id='" . $_SESSION["admin"] . "' AND pe_supplierid='$supid' AND pe_isactive='0' ORDER BY pe_billid DESC LIMIT 1");
                                                                                    $rowdel = $slctdil->fetch_assoc();
                                                                                    if ($rowdel["pe_billid"] == $rowcat["pe_billid"]) {
                                                                                        ?> 

                                                                                        <a onClick="return confirm('Are you sure you want to delete?')" href="supplierview.php?billid=<?= $rowcat['pe_billid'] ?>&delete&supid=<?= $_GET["supid"] ?>&oldbal=<?= $rowcat['pe_oldbal'] ?>"><span class="glyphicon glyphicon-trash"></span> delete</a><?php } ?>
                                                                                </td>


                                                                                </button></a></td>


                                                                            </tr>
            <?php $k++;
        }
    } ?>

                                                                    </tr>

                                                                </tbody>

                                                            </table>

                                                        </div>   


                                                        <!-- <div class="form-group" align="right" style="padding-right:30px;">
                                                         <label for="input-help-block" class="col-sm-2 control-label"></label>
                                                        
                                                         </div>-->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Main Wrapper -->
                        </div>
    <?php
    include("includes/footer.php");
    ?>
                    </div><!-- Page Inner -->
            </main><!-- Page Content -->
            <div class="cd-overlay"></div>
    <?php
    include("includes/footerfiles.php");
    ?>

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Balance Payment</h4>
                        </div>
                        <div id="popbal" class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>


            <div class="modal fade" id="myModalpay" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Balance Payment</h4>
                        </div>
                        <div class="modal-body">
                            <form action="supplierview.php" method="post">
                                <input type="hidden" name="csid" value="<?= $_GET["supid"] ?>">
                                <table class="pay" style="width:100%;">
                                    <tr>
                                        <td>Acount</td><td><select required class="form-control" id="acount" name="acount">
    <?php
    $slctacnt = $conn->query("SELECT * FROM administrator_account_name WHERE act_group_head='7' OR act_group_head='8'");
    while ($rowacnt = $slctacnt->fetch_assoc()) {
        ?>
                                                    <option value="<?= $rowacnt["acc_name"] ?>"><?= $rowacnt["acc_name"] ?></option>
    <?php } ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Balance</td><td><input readonly class="form-control" id="balance1" name="balance"></td>
                                    </tr>
                                    <tr>
                                        <td>New Payment</td><td><input class="form-control" onKeyUp=" calnewbal1()" required id="newpay1" name="newpay" value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>New Balance</td><td><input readonly class="form-control" id="newbalance1" name="newbalance"></td>
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


            <div class="modal fade" id="myModalrcv" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New Payment</h4>
                        </div>
                        <div class="modal-body">
                            <form action="supplierview.php" method="post">
                                <input id="billid" name="billid" type="hidden">
                                <input id="customerid" name="customerid" type="hidden">
                                <input name="back" value="<?= $page ?>" type="hidden">
                                <table class="pay" style="width:100%;">

                                    <tr>
                                        <td>Balance</td><td><input readonly class="form-control" id="balance" name="balance"></td>
                                    </tr>
                                    <tr>
                                        <td>New Payment</td><td><input class="form-control" onKeyUp=" calnewbal()" required id="newpay" name="newpay" value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>New Balance</td><td><input readonly class="form-control" id="newbalance" name="newbalance"></td>
                                    </tr>
                                    <tr>
                                        <td></td><td align="right"><button class="btn btn-success" name="update" type="submit">Update</button></td>
                                    </tr>
                                </table>
                            </form>

                        </div>

                    </div>

                </div>
            </div>




            <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
            <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
            <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
            <script src="assets/js/pages/table-data.js"></script>

            <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
            <script src="assets/plugins/summernote-master/summernote.min.js"></script>
            <script src="assets/js/pages/form-elements.js"></script>



            <script>

                                            function showmodel(bal)
                                            {
                                                document.getElementById("balance1").value = Number(bal);
                                                document.getElementById("newbalance1").value = Number(bal);

                                                $('#myModalpay').modal('show');
                                            }

                                            function newpay(billidvar, customeridvar, balancevar)
                                            {

                                                //alert(billidvar+" "+customeridvar+" "+balancevar);
                                                document.getElementById("billid").value = billidvar;
                                                document.getElementById("customerid").value = customeridvar;
                                                document.getElementById("balance").value = balancevar;
                                                document.getElementById("newbalance").value = balancevar;
                                                $('#myModalrcv').modal('show');

                                            }
                                            function calnewbal()
                                            {

                                                var bal = document.getElementById("balance").value;
                                                var newpay = document.getElementById("newpay").value;

                                                var newbal = Number(bal) - Number(newpay);

                                                document.getElementById("newbalance").value = newbal;


                                            }
                                            function calnewbal1()
                                            {

                                                var bal = document.getElementById("balance1").value;
                                                var newpay = document.getElementById("newpay1").value;

                                                var newbal = Number(bal) - Number(newpay);

                                                document.getElementById("newbalance1").value = newbal;


                                            }


                                            function showHint(mode, csid) {
                                                if (mode.length == 0) {
                                                    document.getElementById("popbal").innerHTML = "";
                                                    return;
                                                } else {
                                                    var xmlhttp = new XMLHttpRequest();
                                                    xmlhttp.onreadystatechange = function () {
                                                        if (this.readyState == 4 && this.status == 200) {
                                                            document.getElementById("popbal").innerHTML = this.responseText;
                                                            $('#myModal').modal('show');
                                                        }
                                                    };
                                                    xmlhttp.open("GET", "payhstry.php?mode=" + mode + "&csid=" + csid, true);
                                                    xmlhttp.send();
                                                }
                                            }
                                            function productsearch(srchky, num)
                                            {

                                                if (srchky == "")
                                                {
                                                    document.getElementById('results' + num).style.display = 'none';
                                                } else {
                                                    $.ajax({
                                                        url: "searchproducts.php",
                                                        type: "POST",
                                                        data: {key: srchky, number: num},
                                                        success: function (data, textStatus, jqXHR)
                                                        {
                                                            $('#serchreslt' + num).html(data);
                                                        },

                                                    });
                                                    //document.getElementsByClassName('secol').style.display='none';
                                                    document.getElementById('results' + num).style.display = 'inline';
                                                }
                                            }

                                            var k = 2;
                                            function addproductfields()
                                            {
                                                var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr' + k + '"><td><input type="hidden" name="prodid[]" id="prodid' + k + '"><input type="text" autocomplete="off" class="form-control" name="productcode[]" id="productcode' + k + '" placeholder="Product Code" style="width:100px;"></td> <td><input type="text" autocomplete="off" class="form-control" name="productname[]" id="productname' + k + '" placeholder="Product Name"></td><td><select name="type[]" id="type' + k + '" class="form-control"><option value="1">Readymades</option><option value="2">Millsgoods</option></select></td><td><input type="text" class="form-control" placeholder="Price" name="price[]" id="price' + k + '" style="width:100px;"></td><td><input type="text" class="form-control" placeholder="Sale Price" name="saleprice[]" id="saleprice' + k + '" style="width:100px;"></td><td><input type="number" class="form-control" min="1" value="1" onChange="calculatetotal(' + k + ')" onKeyUp="calculatetotal(' + k + ')" name="qty[]" id="qty' + k + '" placeholder="Qty" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(' + k + ')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
                                                $('#cartitems').append(fields);
                                                k = k + 1;
                                            }

                                            function addtoproduct(prodid, mlname, enname, purprice, saleprice, unt, stock, num)
                                            {
                                                var exists = 0;
                                                $('input[name^="prodid"]').each(function () {
                                                    if ($(this).val() == prodid)
                                                    {
                                                        exists = 1;
                                                    }
                                                });
                                                if (exists == 0)
                                                {
                                                    $('#prodid' + num).val(prodid);
                                                    $('#productname' + num).val(enname);
                                                    $('#productmlname' + num).val(mlname);
                                                    $('#price' + num).val(purprice);
                                                    $('#saleprice' + num).val(saleprice);
                                                    $('#unit' + num).val(unt);
                                                    $('#prestock' + num).val(stock);

                                                    $('#productname' + num).attr('readonly', true);
                                                    $('#productmlname' + num).attr('readonly', true);

                                                    /*if($('#totalprice').val() == "")
                                                     {
                                                     $('#totalprice').val(price);
                                                     }
                                                     else{
                                                     var total = Number($('#totalprice').val())+Number(price);
                                                     $('#totalprice').val(total);
                                                     }*/

                                                    document.getElementById('results' + num).style.display = 'none';
                                                } else {
                                                    alert("Product already selected.");
                                                }
                                            }

                                            function removeproduct(num)
                                            {
                                                if (confirm("Are you sure?"))
                                                {
                                                    var deltotal = $('#total' + num).val();
                                                    var minustotal = Number($('#totalprice').val()) - Number(deltotal);
                                                    $('#totalprice').val(minustotal);
                                                    $('table#drgcartitms tr#tr' + num).remove();
                                                }
                                            }
            </script>

        </body>

    </html>
    <?php
} else {
    header("Location:index.php");
}
?>