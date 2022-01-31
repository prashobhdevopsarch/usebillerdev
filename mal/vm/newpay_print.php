<html>
<title></title>
<head> 
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
<style>
table {
    border-collapse: collapse;
}
table td
{
	height:15px;
}
</style></head>
<body onLoad="window.print()">
<?php 
include("includes/config.php");
if(isset($_GET["payid"]))
{
	$paymentid=$_GET["payid"];

$profl = $conn->query("SELECT * FROM vm_shopprofile");
	$row1 = $profl->fetch_assoc();

//$cust=$conn->query("SELECT * FROM vm_customer");
	//$rowcat=$cust->fetch_assoc();
//$pay=$conn->query("SELECT *FROM vm_payment WHERE pa_paymentid='$paymentid'");
	//$row2=$pay->fetch_assoc();

$customer=$conn->query("SELECT * FROM  vm_payment LEFT JOIN vm_customer ON cs_customerid=pa_customerid WHERE pa_paymentid='$paymentid'");	
$row=$customer->fetch_assoc();
	
}
if(isset($_GET["back"])){$back=$_GET["back"];}else{$back='view.php?csid='.$row["pa_customerid"];}
?>
<a href="<?=$back?>"><button class="printButtonClass">back</button></a>


<table style="float:right;text-align:left;" width="200" border="0">
  <tr>
    <th>Date</th>
    <td><?=date('d-m-Y H:i', strtotime($row["pa_updatedon"]))?></td>
  </tr>
  <tr>
    <th>Bill NO.</th>
    <td><?=$row["pa_billid"]?></td>
  </tr>
</table>

<table style="text-align:left;" width="100%" border="0">
<col width="30%">
<col width="40%">
<col width="30%">
  <tr>
    <th><?= $row1['sp_shopname'] ?></th>
    <td>&nbsp;</td>
    <td><?=$row['cs_customername']?></td>
  </tr>
  <tr>
    <td><?= $row1['sp_shopaddress'] ?><br/> Ph: <?= $row1['sp_phone'] ?>, Mob: <?= $row1['sp_mobile'] ?><br/> Email:<?= $row1['sp_email'] ?></td>
    <td>&nbsp;</td>
    <td><?=$row['cs_customerphone']?></td>
  </tr>
  <tr>
    <th></th>
    <td>&nbsp;</td>
    <td>TIN num: <?=$row['cs_tin_number']?></td>
  </tr>
</table>





<table class="table table-condensed" border="1" width="100%">

 <tr>
 <td colspan="6" align="right">BALANCE</td>
 <td align="center"><?=$row["pa_balance"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="6" align="right">RECEIVED</td>
 <td align="center"><?=$row["pa_newpayment"]?></td>
</tr>
 <tr>
 
 <td colspan="6" align="right">CURRENT BALANCE</td>
 <td align="center"><?=$row["pa_newbalance"]?></td>
</tr>

 
</table>

<br>

<table width="100%">
<tr>
<td bgcolor="#999999" align="center"><?= $row1['sp_shopname'] ?>, <?=$row1['sp_shopaddress'] ?>, Ph:<?=$row1['sp_phone'] ?>, Mob:<?= $row1['sp_mobile'] ?>, EMAIL:<?= $row1['sp_email'] ?></td>
</tr>
</table>

<script>

</script>
</body>
</html>