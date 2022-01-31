<?php
session_start();
include("includes/config.php");
$key = $_POST['key'];
$number = $_POST['number'];

$search = $conn->query("select * from vm_products where user_id='".$_SESSION["admin"]."' AND pr_productname like '".$key."%' order by pr_productname asc  limit 13");
$pr = $conn->query("SELECT * FROM vm_shopprofile");
$row2 = $pr->fetch_assoc();
while($row = $search->fetch_assoc())
{
	$type = $row['pr_type'];
	  
     $sql1="SELECT * FROM vm_catogory WHERE ca_categoryid='$type'" ;
      $sql= $conn->query("$sql1");
                                        
	$rowcat=$sql->fetch_assoc();
	$vt = $rowcat['ca_vat'];
?>
<table width="100%" border="0" cellpadding="5"><tbody><tr><td bgcolor="#f9f9f9" onclick="addtoproduct('<?= $row['pr_productid'] ?>', '<?= $row['pr_productcode'] ?>', '<?= $row['pr_productname'] ?>', '<?= $row['pr_purchaseprice'] ?>', '<?= $row['pr_saleprice'] ?>', '<?= $row['pr_stock'] ?>', '<?= $number ?>',  '<?= $vt ?>','<?=$row['pr_unit']?>')"><?php echo $row['pr_productcode'] . " : " . $row['pr_productname'] ?>, Stock: <?= $row['pr_stock'] ?></td></tr></tbody></table>
<?php
}
?>