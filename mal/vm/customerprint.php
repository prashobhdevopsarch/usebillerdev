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
$profl = $conn->query("SELECT * FROM vm_shopprofile");
$row3 = $profl->fetch_assoc();
?>
<table style="text-align:left;" width="100%" border="0">
  <tr>
    <th><h2><?= $row3['sp_shopname'] ?></h2></th>
    <td align="right"><?= $row3['sp_shopaddress'] ?><br/> Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?><br/> Email:<?= $row3['sp_email'] ?></td>
  </tr>
  
</table>
<?php
$fil = $_GET['limit'];
if($_GET['limit']!='')
{$bil = $conn->query("SELECT * FROM vm_customer WHERE cs_isactive='0' LIMIT ".$fil."");}
else{$bil = $conn->query("SELECT * FROM vm_customer WHERE cs_isactive='0'");}
	echo "<h4>CUSTOMER DETAILS</h4>";


?>

<table id="example" class="display table" style="width: 100%; cellspacing: 0; border-collapse:collapse;" cellpadding="5" border="1">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Customer Name</th>
                                                   <th>Phone</th>
                                                   <th>Address</th>
                                                   <th width="100px">Balance</th>
                                                   
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   
											   $totalamnt = 0;
											   
											  
												   $k = 1;
												   while($row = $bil->fetch_assoc())
												   {
											   ?>
                                              
                                               <tr style="font-size:14px;">
                                                   <th scope="row">
												   <?= $k ?>
                                                   </th>
                                                   <td align="center"><?= $row['cs_customername'] ?></td>
                                                   <td align="center">
                                                   <?= $row['cs_customerphone'] ?>
                                                   </td>
                                                   <td>
                                                   	<?=
													$row['cs_address']
													?>
                                                   </td>
                                                   <td align="center">
                                                       <?php
													   echo $row['cs_balance'];
													   $totalamnt = $totalamnt + $row['cs_balance'];
													   ?>
                                                   </td>
                                                   
                                               </tr>
                                               
                                               <?php
											   $k++;
												   }
											   
											   ?>
                                           </tbody>
                                        </table>
                                        <table class="table" style="width:100%" cellpadding="5">
                                            <tr>
                                            <td align="right"><strong>Total Amount:</strong></td>
                                            <td width="100" align="center">
                                            	<strong><?= $totalamnt ?></strong>
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
	header('Location:index.php');
}
?>