<?php
session_start();
include("includes/config.php");
$key = $_GET['key'];
$search = $conn->query("select * from vm_customer where user_id='".$_SESSION["admin"]."' AND cs_customername like '".$key."%' order by 	cs_customername asc  limit 10");

while($row = $search->fetch_assoc())
{

?>
<table width="100%" border="0" cellpadding="5"><tbody><tr><td bgcolor="#f9f9f9" onclick="addtocustomer('<?= $row['cs_customername'] ?>','<?= $row['cs_customerid']?>','<?= $row['cs_tin_number']?>','<?= $row['cs_balance']?>','<?= $row['cs_statecode']?>')"><?= $row['cs_customername'] ?></td></tr></tbody></table>
<?php
}
?>