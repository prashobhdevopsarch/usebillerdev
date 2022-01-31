<?php

session_start();
include("includes/config.php");
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $particulars = $_POST['particulars'];
    //$transactiontype=$_POST['type'];
    $transactiontype = "expense";
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
    $slct = $conn->query("SELECT * FROM us_transaction WHERE rpt_status = 'v' ORDER BY tr_id DESC LIMIT 1");
    $rowacnt = $slct->fetch_assoc();
    $rpno = $rowacnt["rpt_no"];
    if ($rpno == 0) {
        $rpno = 1;
    } else {
        $rpno = $rpno + 1;
    }
    $note=$note." - Voucher No :".$rpno;
    $insrtacnt = $conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,mode,dr_cr,user_id) VALUES('" . $_SESSION["admin"] . "',NOW(),'$particulars','$name','Y','$amount','$note','" . $_SESSION["finyearid"] . "','1','D','" . $_SESSION["admin"] . "')");
    $acntid2 = $conn->insert_id;

    $insert = $conn->query("insert into us_transaction(tr_name,tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,user_id, tr_mode, tr_accid,finyear,rpt_no,rpt_status)
values('$name','$particulars',' $openingbalance','$amount','$closingbalance','$datetime','$note','" . $_SESSION["admin"] . "', '1','$acntid2','" . $_SESSION["finyearid"] . "','$rpno','v')");
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