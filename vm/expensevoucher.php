<html>
    <title></title>
    <head> 
    </head>
    <body  onLoad="window.print()">

       <?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="expense.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
  <?php
        session_start();
        include("includes/config.php");
        if (isset($_GET["billid"])) {
            $billid = $_GET["billid"];
            $slct = $conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
            $row = $slct->fetch_assoc();
            $cnt = $conn->query("SELECT COUNT(bi_billitemid) AS cnt FROM vm_billitems WHERE bi_billid='$billid'");
            $row12 = $cnt->fetch_assoc();
            $billitems = $conn->query("SELECT * FROM vm_billitems WHERE bi_billid='$billid'");
            $row8 = $billitems->fetch_assoc();
            $cnt1 = $row12["cnt"];
            $r = 1;
            $numbill = $cnt1 / 32;
            $numbill = $numbill + 1;
            $ttl = intval($numbill);
        }

        $profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='" . $_SESSION["admin"] . "'");
        $row3 = $profl->fetch_assoc();
//        $bill = $conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
//        $row4 = $bill->fetch_assoc();
//        $cust = $conn->query("SELECT * FROM vm_customer WHERE cs_customerid='" . $row4["be_customerid"] . "'");
//        $row5 = $cust->fetch_assoc();
        ?>


        <?php
        ?>
        <table style="text-align:center;" width="100%"  border="0" > 
            <tr style="border-bottom: 1px #808080 solid;" height="9px">
                <td>
                    <span class="s1"><B><?= $row3["sp_shopname"] ?></span></B><br>
                    <span class="s2"><?= $row3["sp_shopaddress"] ?><br>
                        <?= $row3["sp_phone"] ?>&nbsp;<?= $row3["sp_mobile"] ?><br>
        <?= $row3["sp_email"] ?></span><br>
     <span class="s4">GSTIN : <?= $row3["sp_tin"] ?><br>
                        <br>
                        <span class="s3" ><b>CASH VOUCHER</b></span>

                </td>
            </tr>
            <tr>
                &nbsp;
            </tr>
         </table > 

        <table style="border-bottom: 1px #808080 solid;" width="100%" border="0" cell >
            <?php
            if (isset($_GET['trid'])) {
                $trid = $_GET['trid'];
                $slct = $conn->query("SELECT * FROM us_transaction WHERE tr_id='$trid'");
                $row1 = $slct->fetch_assoc();
            }
            ?>
             <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
            <tr  rowspan="2"><td style="text-align:left">&nbsp;&nbsp;Voucher No:&nbsp; <?= $row1["rpt_no"] ?></td><td  style="text-align:right">Dated As:&nbsp;<?=$row1["tr_date"]?>&nbsp;&nbsp;</td></tr>
             <?php
            $slct = $conn->query("SELECT acc_name FROM administrator_account_name WHERE refid='" . $row1["tr_particulars"] . "'");
            $row3 = $slct->fetch_assoc();
            ?><tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
             <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
            <tr><td colspan="1" style="text-align:left">&nbsp;&nbsp;To :&nbsp;<?= $row3["acc_name"] ?> </td><td>Amount :&nbsp;<?= $row1["tr_transactionamount"] ?></td></tr>
             <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
            <tr><td style="text-align:left" colspan="2">&nbsp;&nbsp;For:&nbsp; <?= $row1["tr_transactiontype"] ?></td></tr>
              
 <?php
            $slct = $conn->query("SELECT acc_name FROM administrator_account_name WHERE refid='" . $row1["tr_name"] . "'");
            $row2 = $slct->fetch_assoc();
            ?>
             <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
            <tr><td colspan="2" style="text-align:left">&nbsp;&nbsp;Mode Of Pay:&nbsp; <?= $row2["acc_name"] ?></td></tr>
           <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
            <tr  ><td colspan="2"></td></tr>
            
 
   <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
    <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr> <tr  ><td  colspan="2">&nbsp;&nbsp;</td></tr>
    <tr  ><td style="text-align:right"  colspan="1">Approved By</td><td style="text-align:right"  colspan="1">Signature</td></tr>
    
    
        </table>


        <footer></footer>


        <script>

        </script>
        <link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
        <style>
            table {
                border-collapse: collapse;
            }
            table td
            {
                height:15px;
            }


            @media print
            {
                @page {width:auto;
                       height:50px;}
                /*size:250mm 170mm; margin:0;
                }*/
                .printButtonClass{display:none;}
                .table{width:100%;}
                <!--.table th{font-size:10px;}-->
                .printButtonClass{display:none;}
                .s1{font-size:17px;}
                .s2{font-size:13px;}
                .s3{font-size:12px;}
                .s4{font-size:12px;}
                .s5{font-size:15px;}
                .s6{font-size:9px;}
                .s7{font-size:8px;}
                footer {page-break-after:always;}
                /*font-weight: lighter;*/
            }

            /*@font-face{font-family:abc;
            src: url(includes/dotmat.ttf);}*/
            body {font-family:verdana;
            }
        </style>
    </body>
</html>