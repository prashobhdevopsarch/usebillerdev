<?php
session_start();
include_once "member.php";
include_once "lib.dbconnect.php";
include_once "lib.actualGroupHeadConfig.php";
$searchText = $_GET['search'];
searchAccounts($searchText);

function searchAccounts($searchText) {			
$rowsPerPage = 10;	
$pageNum = 1;	
if(isset($_GET['page']) && $_GET['page'] != "")	{		
	$pageNum = $_GET['page'];	
}	
$offset = ($pageNum - 1) * $rowsPerPage;		
$query = "select refid,acc_name, act_group_head, opening_balance,opening_balance_type, closing_balance,other_details from administrator_account_name";
	if ($searchText == "") {			
	} else {		
		/* $searchText = urldecode($searchText);*/		
		$wherequery = " WHERE acc_name like '%".$searchText."%' OR ";		
		$wherequery .= " act_group_head like '%".$searchText."%' OR ";		
		$wherequery .= " opening_balance like '%".$searchText."%' OR ";		
		$wherequery .= " opening_balance_type like '%".$searchText."%' OR ";		
		$wherequery .= " closing_balance like '%".$searchText."%' OR ";		
		$wherequery .= " other_details like '%".$searchText."%'";	
	}		
	$wherequery .= " ORDER BY refid ASC";	
	/*$wherequery .= " LIMIT ".$offset.",".$rowsPerPage;*/
	/* echo $query.$wherequery;		*/
	$result = mysql_query($query.$wherequery);	
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
			echo "<td><a href=\"addAccount.php?operation=modify&id=".$row[0]."&page=".$_GET['page']."\ title=\"Edit\"><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"><span></a></td>";
			echo "<td><a href=\"addAccount.php?operation=delete&id=".$row[0]."&page=".$_GET['page']." title=\"Delete\" \"><span class=\"glyphicon glyphicon-remove\" title=\"Delete\"><span></a></td>";			
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	} else {
		echo "<div class=\"alert alert-warning\">No Records Found</div>";
	}
	$query   = "SELECT COUNT(refid) AS numrows FROM administrator_account_name ";
	$query .= $wherequery;
	
	$result  = mysql_query($query) or die('Error, query failed');
	$row     = mysql_fetch_array($result, MYSQL_ASSOC);
	$numrows = $row['numrows'];

	$maxPage = ceil($numrows/$rowsPerPage);

	//$self = $_SERVER['PHP_SELF'];
	
	$nav  = '';
	
	
	/*if ($maxPage != 1){
		$nav .= "<ul class=\"pagination\">";
		$nav .= "<li><a href=\"#\">Page</a></li>";
		for ($page = 1; $page <= $maxPage; $page++) {
			if ($page == $pageNum){			
				$nav .= "<li class=\"active\"><a href=\"#\">$page</a></li>"; 
			} else {			
				$nav .= "<li><a href=\"addAccount.php?operation=search&search=".$searchText."&page=".$page."\">".$page."</a></li>";
			}
		}
		$nav .= "</ul>";
		echo $nav;
	}*/
	
}

header('Content-Type: text/html; charset=utf-8');