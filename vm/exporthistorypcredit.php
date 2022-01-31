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
$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
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
	$bil = $conn->query("SELECT * FROM  us_purentry WHERE pe_isactive='0' and pe_balance>'0' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY pe_billid DESC");
	echo "<h4>ALL BILL DETAILS</h4>";
}
else{
	$filarr = explode('$', $fil);
	$fromdate = $filarr[0];
	$todate = $filarr[1];
	
	$bil = $conn->query("SELECT * FROM us_purentry WHERE DATE(pe_billdate)>='$fromdate' AND DATE(pe_billdate) <= '$todate' AND pe_isactive='0' and pe_balance>'0' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY pe_billid DESC");
	echo "<h4>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h4>";
}
?>

<table id="example" class="display table" style="width: 100%; cellspacing: 0; border-collapse:collapse;" cellpadding="5" border="1">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Bill No</th>
                                                   <th>Bill Date</th>
                                                   <th>Items</th>
                                                   <th>GST</th>
                                                   <th width="100px"> Amount</th>
                                                   <th>Discount</th>
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
                                                   <td align="center"><?= $row['pe_billnumber'] ?></td>
                                                   <td align="center">
                                                   <?= date('d-M-Y H:i', strtotime($row['pe_billdate'])) ?>
                                                   </td>
                                                   <td>
                                                   	<?php
													$billid = $row['pe_billid'];
													$itms = $conn->query("SELECT * FROM us_puritems a LEFT JOIN us_products b ON b.pr_productid=a.pi_productid WHERE a.pi_billid='$billid'");
													$n=1;
													while($row2 = $itms->fetch_assoc())
													{
														echo $n . ". " .$row2['pr_productname'] . ", <b>Unit Price:</b>" . $row2['pi_price'] . ", <b>Qty:</b>" . $row2['pi_quantity'] . ", <b>Total:</b>" . $row2['pi_total'] . "<br/>";
														$n++;
													}
													?>
                                                   </td>
                                                   <td><?php $gst = $conn->query("SELECT SUM(pi_vatamount) as gst FROM us_puritems  WHERE pi_billid='$billid'");
                                                  
                                                   while($rowgst = $gst->fetch_assoc())
                                               {
                                                   $totgst = $rowgst['gst'];

                                                   echo $totgst;
                                   } ?></td>
                                              
                                                   <td align="right">
                                                       <?php
													   echo $row['pe_total'];
													   $totalamnt = $totalamnt + $row['pe_total'];
													   ?>
                                                   </td>
                                                   <td align="right"><?php
													   echo $row['pe_discount'];
													   $totaldis = $totaldis + $row['pe_discount'];
													   ?></td>
                                                   
                                               </tr>
                                               
                                               <?php
											   $k++;
												   }
											   }
											   ?>
                                           </tbody>
                                        </table>
                                        <table class="table" style="width:100%" cellpadding="5">
                                            <tr>
                                            <td align="right"><strong>Total Amount:</strong></td>
                                            <td width="100" align="right">
                                            	<strong><?= $totalamnt ?></strong>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td align="right"><strong>Total Discount:</strong></td>
                                            <td width="100" align="right">
                                            	<strong><?= $totaldis ?></strong>
                                            </td>
                                            </tr>
                                            
                                        </table>
                                        <script>
										window.print();
										</script>
</body>
</html>
<?php
}
else{
	header('Location:cashpurchase.php');
}
?>