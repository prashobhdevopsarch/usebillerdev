<?php
session_start();
include_once "member.php";

include_once "lib.actualGroupHeadConfig.php";

include("includes/config.php");

if(isset($_SESSION['admin'])){}else{header("location:index.php");}

//mysql_select_db($_COOKIE['username']);

$modAccountname = "";
$modActualGroupHead = "";
$modOtherdetails = "";
$modOpeningBalance = "";
$modOpeningBalanceType = "";
$modClosingBalance = "";
$modClosingBalanceType = "";
$message = "";
$whereCondition = "";
$disableActualGroupHead = false;
$displayOpeningBalance = true;
$displayClosingBalance = true;

if ( isset($_GET['operation']) && ($_GET['id'] != '') ) 
{
	if ($_GET['operation'] == "modify") { 
		editAccounts($_GET['id']); 
	} else if ($_GET['operation'] == "delete") {
		deleteAccount($_GET['id']);
	} else if ($_GET['search'] == "search") {
		searchAccounts();
	}	
} else if (isset($_POST['modifysaveid']) &&  ($_POST['modifysaveid'] != '')){
	modifySaveAccounts();
}  else if ($_POST && (!isset($_GET['operation'])) ) {
		addAccounts();			 
}

function deleteAccount($id) {
	global $message;		
	$query = "select debit, credit from administrator_daybook where (credit=(select acc_name from administrator_account_name where refid=".$id.") or debit=(select acc_name from administrator_account_name where refid=".$id."))";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		$message = "<div class=\"alert alert-warning\">Transactions made with this account, So Account Name Cannot be deleted</div>";
		return false;
	}
	if (mysql_query ("LOCK TABLES administrator_account_name WRITE")) {
		$query = "DELETE FROM administrator_account_name WHERE refid=".$id;
		if (mysql_query($query))
		{ 
			$message = "<div class=\"alert alert-success\">Deleted the record</div>";
		} else { 
			$message = "<div class=\"alert alert-warning\">Record not deleted</div>"; 
		}  
		mysql_query ("UNLOCK TABLES");
	}
}

function modifySaveAccounts() {	
	global $message;
	if ($_POST['accountname'] == "") { $message = "<div class=\"alert alert-warning\">Account Name cannot be empty</div>"; return false;}
	if (checkAccountAlreadyExists($_POST['modifysaveid'])){
		$result = updateDbAccountById ($_POST['modifysaveid']);
		if ($result){			
			//echo "Account Name : ".retrieveAccountNameById($_POST['modifysaveid']);
			$debitUpdateQuery = "update administrator_daybook set credit='".trim(strtoupper($_POST['accountname']))."' where credit='".retrieveAccountNameById($_POST['modifysaveid'])."'"; 
			$creditUpdateQuery = "update administrator_daybook set debit='".trim(strtoupper($_POST['accountname']))."' where debit='".retrieveAccountNameById($_POST['modifysaveid'])."'"; 
			$updateCreditResultSet = mysql_query($debitUpdateQuery);
			$updateDebitResultSet = mysql_query($creditUpdateQuery);
			if ($updateDebitResultSet && $updateCreditResultSet){
				$message =   "<div class=\"alert alert-success\">Account Name &quot;".$_POST['accountname']."&quot; successfully updated.</div>";
				return true;
			}
		} else {
			$message = "<div class=\"alert alert-warning\">Failed to Update accounts</div>";
		}
	} 
}

function editAccounts($id)
{
	global $xml_file_name, $fileNameWithPath;
	global $modAccountname,$modActualGroupHead,$modOtherdetails,$modOpeningBalance, $modOpeningBalanceType, $modClosingBalance, $modClosingBalanceType;
	global $disableActualGroupHead,$displayOpeningBalance;
	global $listOfActualGroupHead;
	
	$query = "select debit, credit from administrator_daybook where (credit=(select acc_name from administrator_account_name where refid=".$id.") or debit=(select acc_name from administrator_account_name where refid=".$id."))";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		$disableActualGroupHead = true;
	}
	$result = retrieveAccountById($id);
	if (mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			$modAccountname = trim(strtoupper($row[0]));
			$modActualGroupHead = trim(strtoupper($row[1]));			
			$modOtherdetails= trim($row[2]);
			$modOpeningBalance = trim($row[3]);			
			$modOpeningBalanceType = trim($row[4]);		
			$modClosingBalance = trim($row[5]);			
			$modClosingBalanceType = trim($row[6]);		
			
			if ($listOfActualGroupHead[$modActualGroupHead][0] != "bs") {
				$displayOpeningBalance = false;
			}
		}
	}	
}

// Inserts Account Name, Account Head, Group Head and Other Details into Database.
function insertDbAccount(){
	global $message;
	global $listOfActualGroupHead;	
	$act_group_head = $_POST['actualgrouphead'];
	
	$query = "insert into administrator_account_name(acc_name, act_group_head, other_details, acc_head, group_head";
	if ($_POST['openingbalance'] != "") {
		$query .= ",opening_balance,opening_balance_type";
	}
	if ($_POST['actualgrouphead'] == "STOCK" && $_POST['closingbalance'] != "") {
		$query .= ",closing_balance,closing_balance_type";
	}
	$query .= ") ";
	$query .= "values ('".trim(strtoupper($_POST['accountname']))."','";
	$query .= trim(strtoupper($_POST['actualgrouphead']))."','";
	$query .= trim(strtoupper($_POST['otherdetails']))."','";
	$query .= $listOfActualGroupHead[$act_group_head][0]."','";
	$query .= $listOfActualGroupHead[$act_group_head][1]."";
	if ($_POST['openingbalance'] != "") {
		$query .= "',".trim($_POST['openingbalance']).",'";
		$query .= trim($_POST['openingbalancetype']);
	}
	if ($_POST['actualgrouphead'] == "STOCK" && $_POST['closingbalance'] != "") {
		$query .= "',".trim($_POST['closingbalance']).",'";
		$query .= trim($_POST['closingbalancetype']);
	}
	$query .= "')";
	
	if (mysql_query($query)){
		$message = "<div class=\"alert alert-success\">Account Name &quot;".$_POST['accountname']."&quot; Successfully Created</div>";
		return true;
	} else {
		$message =  "<div class=\"alert alert-warning\">Failed to Create Account Name &quot;".$_POST['accountname']."&quot;</div>";
		return false;
	} 
}

function checkAccountAlreadyExists($id = "") {	
	global $message;
	$query = "select acc_name from administrator_account_name where acc_name = '".trim(strtoupper($_POST['accountname']))."'";
	if ($id != "") { $query .= " and refid <> ".$id; } 
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0){
		$message = "<div class=\"alert alert-warning\">Account Name already Exists</div>";
		return false;			
	} else {
		return true;
	}
}

function updateDbAccountById($id)
{
	global $listOfActualGroupHead;
	$query = "update administrator_account_name set acc_name='".addslashes(trim(strtoupper($_POST['accountname'])))."', ";
	if ($_POST['actualgrouphead'] != "") { 
		$act_group_head = $_POST['actualgrouphead'];		
		$query .= " act_group_head='".trim(strtoupper($_POST['actualgrouphead']))."', ";
		$query .= " acc_head='".$listOfActualGroupHead[$act_group_head][0]."', ";
		$query .= " group_head='".$listOfActualGroupHead[$act_group_head][1]."', ";			
	}
	
	if ($_POST['openingbalance'] != "" && isset($_POST['openingbalancetype'])) {
		$query .= " opening_balance=".$_POST['openingbalance'].",";
		$query .= " opening_balance_type='".$_POST['openingbalancetype']."',";
	}
	
	if (($_POST['closingbalance'] != "") && ($_POST['actualgrouphead'] == "STOCK")) {
		$query .= " closing_balance=".$_POST['closingbalance'].",";
		$query .= " closing_balance_type='debit',";
	}
	$query .= "other_details='".addslashes(trim($_POST['otherdetails']))."' where refid=".$id;
	//echo $query;
	return mysql_query($query);
}

function retrieveAccountById($id) {
	$query = "select acc_name, act_group_head, other_details,opening_balance,opening_balance_type,closing_balance,closing_balance_type from administrator_account_name where refid=".$id;
	return mysql_query($query);	
}

function retrieveAccountNameById($id) {
	$query = "select acc_name from administrator_account_name where refid=".$id;
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		return trim(strtoupper($row[0]));			
	}	
}

function retrieveAllAccounts() {
	global $whereCondition; // will be set search function.	
	global $message; 
	// how many rows to show per page
	$rowsPerPage = 20;
	// by default we show first page
	$pageNum = 1;
	// if $_GET['page'] defined, use it as page number
	if(isset($_GET['page']) && $_GET['page'] != "")
	{
		$pageNum = $_GET['page'];
	}
	// counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;	

	$query = "select refid,acc_name, act_group_head, opening_balance,opening_balance_type, closing_balance,other_details from administrator_account_name";
	if ($whereCondition != "") { // will be set by search function 
		$query .= $whereCondition;
	}
	$query .= " order by refid ASC";
	$query .= " LIMIT ".$offset.",".$rowsPerPage;

	//echo $query;
	$result = mysql_query($query);	
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		echo "<div class=\"table-responsive\">";
		echo "<table class=\"table table-bordered table-responsive table-hover\">";		
		echo "<thead>";
		echo "<tr>";
		echo "<th>#</th>";
		echo "<th>Account Name</th>";
		echo "<th>Group Head</th>";
		echo "<th>Opening Balance</th>";										
		echo "<th>Opening Balance Type</th>";										
		echo "<th>Closing Balance</th>";									
		echo "<th>Other Details</th>";										
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
	
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr>";
			echo "<td>".stripslashes($row[0])."</td>";
			echo "<td>".stripslashes($row[1])."</td>";
			echo "<td>".stripslashes($row[2])."</td>";
			echo "<td class=\"text-right\">".stripslashes($row[3])."</td>";
			echo "<td>".stripslashes($row[4])."</td>";
			echo "<td class=\"text-right\">".stripslashes($row[5])."</td>";
			echo "<td>".stripslashes($row[6])."</td>";
			echo "<td><a href=\"addAccount.php?operation=modify&id=".$row[0]."&page=".$_GET['page']."\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"><span></a></td>";
			echo "<td><a href=\"addAccount.php?operation=delete&id=".$row[0]."&page=".$_GET['page']."\" title=\"Delete\" \"><span class=\"glyphicon glyphicon-remove\" title=\"Delete\"><span></a></td>";			
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		
		
	} else {
		echo "<div class=\"alert alert-warning\">No Records Found</div>";
	}
	// how many rows we have in database
	$query   = "SELECT COUNT(refid) AS numrows FROM administrator_account_name";
	if ($whereCondition != ""){
		$query .= $whereCondition;
	}	
	$result  = mysql_query($query) or die('Error, query failed');
	$row     = mysql_fetch_array($result, MYSQL_ASSOC);
	$numrows = $row['numrows'];
	// how many pages we have when using paging?
	$maxPage = ceil($numrows/$rowsPerPage);
	// print the link to access each page
	$self = $_SERVER['PHP_SELF'];
	$nav  = '';
	
	$nav .= "<ul class=\"pagination\">";
	$nav .= "<li><a href=\"#\">Page</a></li>";
	
	for ($page = 1; $page <= $maxPage; $page++) {
		if ($page == $pageNum){			
			$nav .= "<li class=\"active\"><a href=\"#\">$page</a></li>"; // no need to create a link to current page
		} else {			
			$nav .= "<li><a href=\"$self?page=$page\">$page</a></li>";
		}
	}
	$nav .= "</ul>";
	echo $nav;
}

function addAccounts()
{
	global 	$modAccountname, $modActualGroupHead, $modOtherdetails, $modOpeningBalance, $modOpeningBalanceType; 
	global $message;
	$modAccountname  = addslashes(trim(strtoupper($_POST['accountname'])));
	$modActualGroupHead  = addslashes($_POST['actualgrouphead']);	
	$modOtherdetails = addslashes(trim($_POST['otherdetails']));	
	$modOpeningBalance = addslashes(trim($_POST['modOpeningBalance']));
	$modOpeningBalanceType = addslashes(trim($_POST['modOpeningBalanceType']));
	$modOpeningBalance = addslashes(trim($_POST['modClosingBalance']));
	$modOpeningBalanceType = addslashes(trim($_POST['modClosingBalanceType']));	
	
	if ($_POST['accountname'] == "") {
		$message =  "<div class=\"alert alert-warning\">Account Name cannot be empty</div>";
		return false;
	} else if ($_POST['actualgrouphead'] == "") {
		$message =  "<div class=\"alert alert-warning\">Group Head cannot be empty</div>";
		return false;
	} 
	
	if ($_POST['actualgrouphead'] == "") {
	
	}
	
	if (checkAccountAlreadyExists()) {
		if (insertDbAccount()){
			$modAccountname = ""; $modActualGroupHead = ""; $modOtherdetails = ""; 
			$modOpeningBalance = ""; $modOpeningBalanceType = ""; $modClosingBalance = ""; $modClosingBalanceType = "";
		}
	}
	/*
	$account_already_exists = false;	
	global $xml_file_name, $fileNameWithPath;	
	
	if (file_exists($xml_file_name)) {
		$xml = simplexml_load_file($xml_file_name);
	}

	foreach ( $xml->xpath('//account') as $account ) {			
		$accountname = strtolower((string) $account->accountname); 
		$id = ((integer) $account->id);
		if ( trim($accountname) == trim(strtolower($_POST['accountname'])) )	{
			echo "Account Name already Exists<br />";
			$account_already_exists = true;
		}
	}
	
	if ($account_already_exists == false) 
	{
		//echo "Inside the False Condition"; 
		$writeContent = "<account> \n";
		$id = $id +1;
		$writeContent .= "<id>".$id."</id> \n";
		$writeContent .= "<accountname>".$_POST['accountname']."</accountname> \n";
		$writeContent .= "<accounthead>".$_POST['accounthead']."</accounthead> \n";
		$writeContent .= "<grouphead>".$_POST['grouphead']."</grouphead> \n";
		$writeContent .= "<firstname></firstname> \n";
		$writeContent .= "<lastname></lastname> \n";
		$writeContent .= "<address></address>\n";
		$writeContent .= "<phoneno></phoneno> \n";
		$writeContent .= "<mobileno></mobileno> \n";
		$writeContent .= "</account> \n";

		$fd = fopen ($fileNameWithPath, "r"); 
		while (!feof ($fd)) {
			$buffer = fgets($fd, 4096);
			$lines[] = $buffer;
		}
		fclose ($fd);

		$fd = fopen ($fileNameWithPath,"w");
		foreach ($lines as $value) {
			if (trim($value) == "</accounts>") {
				fwrite($fd,$writeContent);
			}
			$value = trim($value)."\n";
			fwrite($fd,$value); 
		}
		fclose ($fd);
	}
	*/
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html>
    
<head>
        
        <!-- Title -->
        <title>US e-Biller</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="gayathri" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="utparasolutions" />
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
        	
        <!-- Theme Styles -->
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

<!-- jQuery library -->
<script src="css/jquery.min.js"></script>
<script src="css/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui-1.11.4/jquery-ui.min.css">

<!-- Latest compiled Bootstrap JavaScript -->
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

</head>
<body class="page-header-fixed">

<script>
function searchAccounts() {	
	var searchText = document.getElementById('search').value;
    searchText = encodeURI(searchText);	
	$("#panelBody").load("postAccount.php?search="+searchText);	
}
</script>
<div class="overlay"></div>
        
        
        
        <!-- Search Form -->
        <main class="page-content content-wrap">
 <?php include("includes/topheader.php");
include("includes/adminsidebar.php"); ?>?>

<div class="page-inner">
                <div class="page-title">
                    <h3>Transactions</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="home.php">Accounts</a></li>
                            
                            <li class="active">Add Account</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                	<div class="row">
                    	<div class="panel panel-white">
		  					<div class="panel-heading clearfix">
								<h4 class="panel-title">Trading Sector</h4>
							</div>
                            <div class="panel-body" style="margin-top:15px;">
                            
<div class="card-box" style="min-height:300px;">





  <div class="container-fluid">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
        </button>

     
   
      <!--<a class="navbar-brand" href="#"><?php 
		$headerTitle = $companyname;
		if ($headerTitle != "")
		{
			echo $headerTitle;
		}
		?>		
      </a>-->

    </div>    
    
  </div>


<script>

function createAccounts(){
	$("#createModal").modal();	
}

<?php 
if ($message == ""){ 
	}else{
?>
$(document).ready(function(){   
    $("#myModal").modal();
});

<?php } ?>

<?php


if ($_GET['operation'] == "modify"){
	$saveTag = "Modify Account";
?>
$(document).ready(function(){
	$("#createModal").modal();
});	
<?php
	} else {
		$saveTag = "Create Account";
	}
?>
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
       <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Message</h4>
        </div>
        <div class="modal-body">
          <p>	<?php echo $message; ?></p>
        </div>
 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>
</div>


<!-- Create Modal -->
<div class="modal fade" id="createModal" role="dialog">
<div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
	  
       <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><?php echo $saveTag; ?></h4>
       </div>
       <div class="modal-body">
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<form method="post" action="addAccount.php?page=<?php echo $_GET['page']; ?>" name="search">
					<input type="hidden" id="searchby" name="searchby"></input>	
					<div class="form-group">				
						<label for="accountname">Account Name</label>
						<input type="text" maxlength="30" class="form-control input-sm" name="accountname" id="accountname" value="<?php echo $modAccountname; ?>" maxlength="50"></input>
						<!-- <a href="javascript:he('searchby','accountname');document.search.submit();" ><img src="search_16x16.gif" alt="Search by Account Name" title="Search by Account Name"></a> -->
					</div>
					<?php
					$listOfActualGroupHeadKeys = array_keys($listOfActualGroupHead);							
					echo "<script language=\"javascript\">";
					echo "actualGroupHeadArrayKeys = new Array();";
					echo "actualGroupHeadArray = new Array();";
					echo "actualGroupHeadTypeArray = new Array();";
					for ($i = 0 ; $i < count($listOfActualGroupHeadKeys); $i++) {			
						echo "	actualGroupHeadArrayKeys.push('".$listOfActualGroupHeadKeys[$i]."');";
						echo "  actualGroupHeadArray.push('".$listOfActualGroupHead[$listOfActualGroupHeadKeys[$i]][0]."');";
						echo "  actualGroupHeadTypeArray.push('".$listOfActualGroupHead[$listOfActualGroupHeadKeys[$i]][1]."');";
					}
					echo "</script>\n";							
					?>
					<script language="javascript">
					function displayOpeningBalance()
					{				
						var actualgrouphead = document.getElementById("actualgrouphead").value;					
						//alert (actualgrouphead);
						
						
						/* The opening balance under for this accounts 
						 under this actual group head can only be debited.  */
						if (actualgrouphead == "STOCK" || actualgrouphead == "CASH" || actualgrouphead == "INVESTMENTS" || actualgrouphead == "FIXED ASSETS" || actualgrouphead == "OTHER ASSETS")
						{
							document.getElementById("opbcredit").className="hideRow";
						} else {
							document.getElementById("opbcredit").className="";
						}
						
						/* The opening balance under for this accounts 
						 under this actual group head can only be credited.  */					 
						if (actualgrouphead == "CAPITAL" || actualgrouphead == "RESERVES" || actualgrouphead == "TERM LOAN"	|| actualgrouphead == "DEFERRED LIABILITY")
						{
							document.getElementById("opbdebit").className="hideRow";
						} else {
							document.getElementById("opbdebit").className="";
						}
						
						
						if (actualgrouphead != ""){
							for (var i =0; i < actualGroupHeadArrayKeys.length; i++){
								if (actualGroupHeadArrayKeys[i] == actualgrouphead) {
									if  (actualGroupHeadArray[i] == "bs"){
										//alert ('inside true condition');
										document.getElementById('openingbalancetr').className="form-group";									
										//alert (actualGroupHeadTypeArray[i]);
										if (actualGroupHeadTypeArray[i] == "asset") {
										//document.getElementById('openingbalancetype')[0].SelectedValue="debit";
										} else {
										//document.getElementById('openingbalancetype')[1].SelectedValue="credit";
										}
										return true;
									} 
								}
							} 
							document.getElementById('openingbalancetr').className="hideRow";
							//return false;
						} 
						
						
					}
					
					function displayClosingBalance()
					{
						var actualgrouphead = document.getElementById("actualgrouphead").value;							
						if (actualgrouphead == "STOCK"){
							document.getElementById('closingbalancetr').className="form-group";
						} else {
							document.getElementById('closingbalancetr').className="hideRow";									
						}
					}
					
					</script>
					<style>
						.hideRow {display:none;}					
					</style>
					<?php if ($disableActualGroupHead == false) { ?>
					<div class="form-group">
						<label for="actualgrouphead">Group Head</label>
						<select name="actualgrouphead" class="form-control input-sm" id="actualgrouphead" onselect="javascript:displayOpeningBalance();displayClosingBalance();" onchange="javascript:displayOpeningBalance();displayClosingBalance();">
						<option></option>
							<?php						
								for ($i = 0; $i < count($listOfActualGroupHeadKeys); $i++) 
								{
									echo "<option"; 
									if ($modActualGroupHead == $listOfActualGroupHeadKeys[$i])
									{
										echo " selected=\"selected\""; 
									} 
									echo " value=\"".$listOfActualGroupHeadKeys[$i]."\">".$listOfActualGroupHeadKeys[$i]."</option>";
								}
							?>
						</select>
						<!-- <a href="javascript:he('searchby','actualgrouphead');document.search.submit();" ><img src="search_16x16.gif" /></a> -->
					</div>				
					<?php } ?>

					<?php 				
					if ($displayOpeningBalance == true) {
					?>
					<div class="form-group" id="openingbalancetr" name="openingbalancetr">
						<label for="openingbalance">Opening Balance</label>
						<select name="openingbalancetype" id="openingbalancetype">
								<option id="opbdebit" value="debit" <?php if ($modOpeningBalanceType == "debit"){ echo "selected=selected"; } ?>>debit</option>
								<option id="opbcredit" value="credit" <?php if ($modOpeningBalanceType == "credit"){ echo "selected=selected"; } ?>>credit</option>
						</select>						
						<input type="text" class="form-control input-sm" maxlength="15" name="openingbalance" id="openingbalance" value="<?php echo $modOpeningBalance; ?>"></input>
					</div>
					<?php } ?>

					<div class="form-group" id="closingbalancetr" name="closingbalancetr">
						<label for="closingbalance">Closing Balance (applies only to Stock)</label>
						<input type="text" class="form-control input-sm"  maxlength="15" name="closingbalance" id="closingbalance" value="<?php echo $modClosingBalance; ?>"></input>						
					</div>

					<div class="form-group">
						<label for="otherdetails">Other Details</label>
						<textarea name="otherdetails" class="form-control input-sm" id="otherdetails" maxlength="500"><?php echo $modOtherdetails; ?></textarea>
						<!-- <a href="javascript:he('searchby','otherdetails');document.search.submit();" ><img src="search_16x16.gif"></a> -->
					</div>
					<button class="btn btn-default" type="submit" name="submit" value="save">Save</button>
				</div>			
			</div>
			<?php 
			if (isset($_GET['operation']) && ($_GET['operation'] == "modify"))
			{ 
				echo "<input type=\"hidden\" name=\"modifysaveid\" value=\"".$_GET['id']."\">"; 
			}
			?>
			</form>
        </div>
 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>
</div>


<!-- Body -->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6 col-lg-6">
			<button type="button" class="btn btn-primary" onclick="javascript:createAccounts();"><span class="glyphicon glyphicon-plus"></span>&nbsp;Create Accounts</button>
		</div>
		<div class="col-sm-6 col-lg-6 text-right">
		<form class="form-inline" role="form">
			<div class="form-group">
				<input type="text" class="form-control" id="search" placeholder="Search" />			
				<button type="button" class="btn btn-primary" onclick="javascript:searchAccounts();"><span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>
			</div>
		</form>
		</div>		
	</div>
	<br />
	<div class="row">
		 <div class="col-sm-12 col-lg-12">
		<!--	<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">						
						Account Names or Ledger records list.&nbsp;	
					</div>
				</div> -->
				<div id="panelBody">	
							
						<?php
						if ($_GET['new'] == "yes"){
							echo "<div class=\"alert alert-info\">Modify Account Names suitable to the needs of your enterprise. Account names cannot be deleted once the accounting entry or transactions are made.</div>";
						}						
							retrieveAllAccounts();
						?>
					</div>
				</div>
		<!--	</div> -->
		</div>
	</div>
					</div>
                    
                    


</div>
                	</div>
                    
                    
                    
                    
                    
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
                <?php include("includes/footer.php"); ?> 
            </div>
	<!-- Page Inner -->
	</main><!-- Page Content -->
        
        <div class="cd-overlay"></div>


<script>
            var resizefunc = [];
        </script>

       <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="assets/plugins/toastr/toastr.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script src="includes/custom.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>

</body>
</html>	