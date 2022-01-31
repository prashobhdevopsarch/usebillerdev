<?php
session_start();
include("includes/config.php");
$key = $_GET['key'];
$search = $conn->query("select * from vm_supplier where user_id='".$_SESSION["admin"]."' AND ( rs_company_name like '".$key."%' OR rs_name like '".$key."%') order by 	rs_company_name asc  limit 10");

while($row = $search->fetch_assoc())
{

?>
<table width="100%" border="0" cellpadding="5"><tbody><tr><td bgcolor="#f9f9f9" onclick="addtocustomer('<?= $row['rs_company_name'] ?>','<?= $row['rs_supplierid'] ?>','<?= $row['rs_name']?>','<?= $row['rs_balance']?>','<?= $row['rs_statecode']?>')"><?= $row['rs_company_name']." - ".$row['rs_name'] ?></td></tr></tbody></table>
<?php
}
?>