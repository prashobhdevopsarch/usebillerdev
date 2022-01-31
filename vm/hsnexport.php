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
<style>
@media print{
.printButtonClass{display:none;}
.table td{font-size:10px;}
.table th{font-size:10px;}

}
</style>
<title>Stock Report</title>
</head>
<body onLoad="window.print()">
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="hsnreport.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>

<body style="font-family:Arial, Helvetica, sans-serif;">
<?php
$profl = $conn->query("SELECT * FROM us_shopprofile");
$row3 = $profl->fetch_assoc();
?>
<table style="text-align:left;" width="100%" border="0">
  <tr>
    <th style="font-size:12px;"><?= $row3['sp_shopname'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <u>HSN REPORT</u></th>
    <td align="right" style="font-size:10px;"><?= $row3['sp_shopaddress'] ?><br/> Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?><br/> Email:<?= $row3['sp_email'] ?></td>
  </tr>
  
</table>
<?php

$bil = $conn->query("SELECT * FROM us_products a left join us_catogory b on b.ca_categoryid = a.pr_type WHERE a.pr_isactive='0' AND a.user_id='".$_SESSION["admin"]."' ORDER BY a.pr_productid ASC");
	echo "";


?>

<table id="example" class="display table" style="width: 100%; cellspacing:0; border-collapse:collapse;" cellpadding="5" border="1">
                                           <thead>
                                               <tr>
                                                   <th>No.</th>
                                                   <th>HSN </th>
                                                   <th> Code</th>
												   <th>Product Name</th>
												     
                                                    
                                                  <th>Tax %</th>
												   <th>UQC</th>
                                                   <th>MRP</th>
												   <th>PR Price</th>
                                                  <th>Sale Price</th>
												   <!-- <th>Retail Price</th>
												   <th>Order</th>
												   <th>MRP</th>-->
                                                   <th>KFC</th>
                                                   <th>stock</th>
                                                   <th>Amount</th>
                                                   
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   
											  // $totalamnt = 0;
											   
											  $total=0;
												   $k = 1;
												   while($row = $bil->fetch_assoc())
												   {
											   ?>
                                              
                                               <tr style="font-size:13px;">
                                                   <th scope="row">
												   <?= $k ?>
                                                   </th>
                                                   <td>
                                                   	<?=
													$row['pr_hsn']
													?>
                                                   </td>
                                                   <td align="center"><?= $row['pr_productcode'] ?></td>
                                                   <td align="left">
                                                   <?= $row['pr_productname'] ?>
                                                   </td>
												  
                                                    
                                                   <td align="right">
                                                   	<?=
													$row['ca_categoryname']
													?>
                                                   </td>
												   <td>	<?=
													$row['pr_unit']
													?></td>
                                                  
                                                   <td align="right">
                                                       <?php
													   echo $row['pr_purchaseprice'];
													   
													   ?>
                                                  
												   <td align="right">
                                                       <?php
													   echo $row['pr_saleprice'];
													   
													   ?>
                                                   </td>
											
                                                   <td align="right">
                                                       <?php
													   echo $row['pr_wholesale'];
													   
													   ?>
                                                   
												     </td>
                                                   <td align="right">
                                                       <?php
													   echo $row['pr_cess'];
													   
													   ?>
                                                   </td>
												   <td align="center">
                                                       <?php
													   
														 echo $row['pr_stock'];
													   
													  
													   
													   ?>
                                                   </td>
                                                   
												   <td align="right"><?php $ttl=$row['pr_purchaseprice']*$row['pr_stock'];echo $ttl; $total=$total+$ttl; ?></td>
                                                   
                                                   
                                               </tr>
											   
                                               
                                               <?php
											   $k++;
												   }
											   
											   ?>
											  <tr>
										  <td colspan="11" align="right"><b> Total</b></td>
									   	   <td colspan="" align="right"><b><?php 
										   if(isset($_GET["search"]))
							{
							$key=$_GET["search"];
							$sum = $conn->query("SELECT SUM(pr_purchaseprice*pr_stock) AS pr_count FROM us_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0' AND ( pr_productcode LIKE '$key%' OR pr_productname LIKE '$key%' OR pr_hsn LIKE '$key%')");
							}else
							{
							$sum = $conn->query("SELECT SUM(pr_purchaseprice*pr_stock) AS pr_count FROM us_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0'");
							}$row_sum=$sum->fetch_assoc();echo round_up($row_sum["pr_count"],2);
										    ?></b></td>
										  </tr>
                                           </tbody>
                                        </table>
                                       <!-- <table class="table" style="width:100%" cellpadding="5">
                                            <tr>
                                            <td align="right"><strong>Total Amount:</strong></td>
                                            <td width="100" align="center">
                                            	<strong><?= $totalamnt ?></strong>
                                            </td>
                                            </tr>
                                            
                                        </table>-->
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