<?php
include("includes/config.php");
$backupFile = "Backup" . date("Y-m-d-H-i-s") . '.sql';
$command = "C:\\xampp\mysql\bin\mysqldump -uusebiller_user -p*usebiller123# Victory > C:\\backup\\$backupFile";//server

$command = "C:\\xampp\mysql\bin\mysqldump -uusebiller_user -p*usebiller123#  Victory > C:\\backup\\$backupFile";//localhost db
$command1 = "C:\\xampp\mysql\bin\mysqldump -uusebiller_user -p*usebiller123# Victory > H:\\backup\\$backupFile";//localhost db
$command2 = "C:\\xampp\mysql\bin\mysqldump -uusebiller_user -p*usebiller123# Victory > I:\\backup\\$backupFile";//localhost db
$command3 = "C:\\xampp\mysql\bin\mysqldump -uusebiller_user -p*usebiller123# Victory > D:\\backup\\$backupFile";//localhost db

$i=system($command);
$j=system($command1);
$k=system($command2);
$l=system($command3);

header("location:".$_GET['back']."?id=success");

?>