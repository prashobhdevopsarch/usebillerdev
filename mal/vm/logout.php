<?php
session_start();
$backupFile = "biller" . date("Y-m-d-H-i-s") . '.sql';
$command = "C:\\xampp\mysql\bin\mysqldump -uusebiller_user -p*usebiller123# usebiller_db > c:\\backup\\$backupFile";//server

$command = "C:\\xampp\mysql\bin\mysqldump -uusebiller_usern -p*usebiller1234# billing_db > c:\\backup\\$backupFile";//localhost db

$i=system($command);

header("location:".$_GET['back']."?id=success");
unset($_SESSION['admin']);
unset($_SESSION['name']);
unset($_SESSION['admin']);
unset($_SESSION['name']);
header("Location:../index.php");
?>