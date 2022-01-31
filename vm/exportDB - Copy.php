<?php

// Database Connection
$uname="user_vm";
$pass="vmuser123#";
$host="localhost";
$database = "vasthramalika";

$uname = "vmuser";
$pass = "vmuser123";
$database = "vasthramalika1";

	

$connection=mysql_connect($host,$uname,$pass); 

echo mysql_error();

//or die("Database Connection Failed");
$selectdb=mysql_select_db($database) or die("Database could not be selected");	
$result=mysql_select_db($database)
or die("database cannot be selected <br>");

	
// Fetch Record from Database

$output			= "";
$table 			= $_GET["tablename"]; // Enter Your Table Name
$sql 			= mysql_query("select * from $table");
$columns_total 	= mysql_num_fields($sql);

// Get The Field Name

for ($i = 0; $i < $columns_total; $i++) {
	//$heading	=	mysql_field_name($sql, $i);
	//$heading	=	mysql_field_name($sql, $i);
	//$output		.= '"'.$heading.'",';
}


// Get Records from the table

while ($row = mysql_fetch_array($sql)) {
for ($i = 0; $i < $columns_total; $i++) {
$output .='"'.$row["$i"].'"';
if($i < $columns_total-1)
{
	$output .=',';
}
}
$output .="\n";
}

// Download the file

$filename =  $_GET["filename"].date('d-m-Y H:i:s').".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;



exit;

?>
