<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Billing History</title>
</head>

<body style="font-family:Arial, Helvetica, sans-serif;">
<?php
$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."' ");
$row3 = $profl->fetch_assoc();
?>
<table style="text-align:left;" width="100%" border="0">
  <tr>
    <th><h2><?= $row3['sp_shopname'] ?></h2></th>
    <td align="right"><?= $row3['sp_shopaddress'] ?><br/> Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?><br/> Email:<?= $row3['sp_email'] ?></td>
  </tr>
  
</table>
<?php
$fil = $_GET['fil'];
if($fil == 'all')
{
	$bil = $conn->query("SELECT * FROM us_ser WHERE user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND se_isactive='0' AND se_mod='1' ORDER BY se_billid DESC");
	echo "<h4>ALL SERVICE BILL DETAILS</h4>";
}
else{
	$filarr = explode('$', $fil);
	$fromdate = $filarr[0];
	$todate = $filarr[1];
	
	$bil = $conn->query("SELECT * FROM us_ser WHERE DATE(se_billdate)>='$fromdate' AND DATE(se_billdate) <= '$todate' AND se_isactive='0' AND se_mod='1' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY se_billid DESC");
	echo "<h4>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h4>";
}
?>

<table id="example" class="display table" style="width: 100%; cellspacing: 0; border-collapse:collapse;" cellpadding="5" border="1">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Bill No</th>
                                                   <th>Bill Date</th>
                                                   <th>Items, complaint & cost</th>
                                                  
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   $totaldis=0;
											   $totalamnt = 0;
											   $today = date('Y-m-d');
											   if(mysqli_num_rows($bil)>0)
											   {
												   $k = 1;
												   while($row = $bil->fetch_assoc())
												   {
											   ?>
                                              
                                               <tr style="font-size:14px;">
                                                   <th scope="row">
												   <?= $k ?>
                                                   </th>
                                                   <td align="center"><?= $row['se_billnumber'] ?></td>
                                                   <td align="center">
                                                   <?= date('d-M-Y H:i', strtotime($row['se_billdate'])) ?>
                                                   </td>
                                                   <td>
                                                   	<?php
													$billid = $row['se_billid'];
													$itms = $conn->query("SELECT * FROM us_seritem a LEFT JOIN us_products b ON b.pr_productid=a.se_productid WHERE a.se_billid='$billid'");
													$n=1;
													while($row2 = $itms->fetch_assoc())
													{
														echo $n . ". " .$row2['se_item'] . ", <b>Unit Price:</b>" . $row2['se_price1'] . ", <b>complaint:</b>"  . $row2['se_com'] . 
														$n++;
													}
													?>
                                                   
                                                   
                                               </tr>
                                               
                                               <?php
											   $k++;
												   }
											   }
											   ?>
                                           </tbody>
                                        </table>
                                       
                                        <script>
										window.print();
										</script>
</body>
</html>
<?php
}
else{
	header('Location:index.php');
}
?>