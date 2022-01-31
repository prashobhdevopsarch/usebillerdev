<?php
ob_start();
error_reporting(E_ERROR | E_PARSE);
include_once 'create-database.php';
if (isset($_POST['submit'])) 
{
	$domain = $_POST['dbdomain'];
	if ($domain == ""){
		$domain = "localhost";
	}
	
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	
	/*
	echo "Domain ::: ".$domain;
	echo "DBUSER ::: ".$dbuser;
	echo "DBPASS ::: ".$dbpass;
	*/
	
	$link = mysql_connect($domain,$dbuser,$dbpass);
	
	if ($link) {
		//echo "Able to connect to the database";
		create_database($domain,$dbuser,$dbpass,$link);
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Setup Database</title>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">

<!-- bootstrap -->
<link rel="stylesheet" href="css/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/bootstrap-3.3.6-dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="css/jquery.min.js"></script>
<script src="css/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui-1.11.4/jquery-ui.min.css">

<!-- Latest compiled Bootstrap JavaScript -->
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

<style>
.ui-autocomplete { z-index:2147483647; }
</style>


<script>
function validateEntries() 
{
	var dbname = document.getElementById("dbname").value;
	var dbpass = document.getElementById("dbpass").value;
	var dbdomain = document.getElementById("dbdomain").value;
	
	if (dbdomain == ""){
		dbdomain = 'localhost';
	}
	if (dbname == ""){
		alert("Enter the mysql username");		
		dbname.focus();
		return false;
	}
	
	/*if (dbpass == ""){
		alert("Enter the mysql password");
		dbpass.focus();
		return false;
	}*/
	
} 
</script>
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
	  <a class="navbar-brand" href="#"><img src="daybook.png" alt="Daybook Accounts" class="img-responsive" /></a>
	</div>
   </div>
</nav>
<div class="container-fluid">
  <div class="row">
	<div class="col-sm-12 col-md-9 col-lg-6">		
		<div class="panel panel-default">
			<div class="panel-heading">Enter the Database Credentials</div>	
			<div class="panel-body"> 
				<p>The entered credentials should be able to create a database. </p>
				<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<div class="form-group">
					<label for="dbdomain">Domain</label>
					<input type="text" placeholder="localhost" class="form-control input-sm" name="dbdomain" id="dbdomain" maxlength="30" value="" />
				</div>
				<div class="form-group">
					<label for="dbuser">Username</label>
					<input type="text" class="form-control input-sm" name="dbuser" id="dbuser" maxlength="30" value="" />
				</div>
				<div class="form-group">
					<label for="dbpass">Password</label>
					<input type="text" class="form-control input-sm" name="dbpass" id="dbpass" maxlength="30" value="" />
				</div>
				<button class="btn btn-default" type="submit" name="submit" onclick="javascript:return validateEntries()">submit</button>
				</form>
			</div>
		</div>						
	</div>
  </div>
  <div class="row">
	<div class="page-footer">
		<?php include_once 'footer.php' ?>
	</div>
  </div>
</div>
</body>
</html>