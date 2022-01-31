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
@media print{
.printButtonClass{display:none;}
}
</style></head>
<body onLoad="window.print()">
<?php 
include("includes/config.php");
if(isset($_GET["payid"]))
{
	$paymentid=$_GET["payid"];

$profl = $conn->query("SELECT * FROM us_shopprofile");
	$row1 = $profl->fetch_assoc();

//$cust=$conn->query("SELECT * FROM us_customer");
	//$rowcat=$cust->fetch_assoc();
//$pay=$conn->query("SELECT *FROM us_payment WHERE pa_paymentid='$paymentid'");
	//$row2=$pay->fetch_assoc();
	$mode=$conn->query("SELECT * FROM us_payment WHERE pa_paymentid='$paymentid'");	
$row=$mode->fetch_assoc();
if($row['pa_mode']=='1')
{
$customer=$conn->query("SELECT * FROM  us_payment LEFT JOIN us_customer ON cs_customerid=pa_customerid WHERE pa_paymentid='$paymentid'");
}
else{
	$customer=$conn->query("SELECT * FROM  us_payment LEFT JOIN us_supplier ON rs_supplierid=pa_customerid WHERE pa_paymentid='$paymentid'");
}	
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
    <th>Sl NO.</th>
    <td><?=$row["pa_paymentid"]?></td>
  </tr>
</table>

<table style="text-align:left;" width="100%" border="0">
<col width="30%">
<col width="40%">
<col width="30%">
  <tr>
    <td><?= $row1['sp_shopname'] ?><br><?= $row1['sp_shopaddress'] ?><br/> Ph: <?= $row1['sp_phone'] ?>, Mob: <?= $row1['sp_mobile'] ?><br/> Email:<?= $row1['sp_email'] ?></td>
    <td>&nbsp;</td>
    <td><?php if($row['pa_mode']=='1'){?><?=$row['cs_customername']?><br><?=$row['cs_address']?><br/> Ph: <?= $row['cs_customerphone'] ?><?php }else{?><?=$row['rs_company_name']?><br><?=$row['rs_name']?><br><?=$row['rs_address']?><br/> Ph: <?= $row['rs_phone'] ?><?php }?></td>
  </tr>
  
  <tr>
    <th>GSTIN : <?=$row1['sp_tin']?></th>
    <td>&nbsp;</td>
    <th>GSTIN : <?php if($row['pa_mode']=='1'){?><?=$row['cs_tin_number']?><?php }else{?><?=$row['rs_tinnum']?><?php }?></th>
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