<html>
<title></title>
<head> 
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
<style>
body{color:#000000;}
table {
    border-collapse: collapse;
}
table td
{
height:15px;
}
.table-curved-head {
border-collapse: separate;
    border: solid #000000 1px;
border-bottom:0px;
    border-radius: 15px 15px 0px 0px;
}
.table-curved-foot {
border-collapse: separate;
    border: solid #000000 1px;
border-top:0px;
    border-radius: 0px 0px 15px 15px;
    
}
/*.table-body th, .table-body td{
borderolid #000000 1px;
}*/
.table-body th{
background: #000000;
color: white;
}
/*@page { size: 2480px 1754px; margin: 0px;}*/
 /* change the margins as you want them to be. */
/*#footer{bottom:0;position:absolute; padding-right:5px;}*/
@media print{ 
.btn {display:none;}
.printButtonClass{display:none;}
@page {
    /*size: 595px 421px;*/
    margin: 10px 5px 5px 5px; }  
    
table{font-size:20px;color:#000000;
}
.table-body{
bottom: 500px;	
}
.table-body th{
background: #000000;
color: white;}
/*#footer{bottom:5px;position: absolute; padding-right:5px;}
body {
    position: relative;
}
@page:last {
    @bottom-center {
        content: "…";
    }*/
body {font-family:Verdana, Geneva, sans-serif;}
}

}
</style>
</head>
<body onLoad="window.print()">
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="expense.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php 
session_start();
include("includes/config.php");

if(isset($_GET['trid']))
{
	$trid=$_GET['trid'];
	$slct=$conn->query("SELECT * FROM us_transaction WHERE tr_id='$trid'");
	$row1 = $slct->fetch_assoc();
}
$profl = $conn->query("SELECT * FROM us_shopprofile");
$row3 = $profl->fetch_assoc()
?>

<table style="text-align:left;" width=100% border="1">
  
	<tr height="100px">
  	
    <th style="text-align:center; font-size:24px; border-left:hidden; border-right:hidden; border-top:hidden;" colspan="2">CASH VOUCHER</th>
    
    <tr><td style="text-align:left; border-left:hidden; border-right:hidden">Dated As:&nbsp;<?=$row1["tr_date"]?></td>
    
    </table>
    <table border="0">
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    </table>
    <table >
<tr><td style="text-align:left">Mode Of Pay:&nbsp; <?=$row1["tr_name"]?></td></tr>
    <tr><td style="text-align:left"> To:&nbsp; <?=$row1["tr_particulars"]?></td></tr>
    <tr><td style="text-align:left">Note:&nbsp; <?=$row1["tr_transactiontype"]?></td></tr>
  <tr><td></td></tr>
  <tr><td >Amount of Voucher:&nbsp;<?=$row1["tr_transactionamount"]?> Rs.</td>
  

    
    
</table>




<script>

</script>
</body>
</html>
