<?php
include("includes/config.php");
$backupFile = "backup" . date("Y-m-d-H-i-s") . '.sql';
$command = "d:\\xampp\mysql\bin\mysqldump -uusebiller_user -p*usebiller123# usebiller_db > d:\\backup\\$backupFile";//server

$command = "D:\\xampp\mysql\bin\mysqldump -uusebiller_usern -p*usebiller1234# billing_db > D:\\backup\\$backupFile";//localhost db

$i=system($command);

header("location:".$_GET['back']."?id=success");

?>