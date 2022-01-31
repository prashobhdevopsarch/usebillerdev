<style>

@media print{
.selectbtn{display:none;}</style><?php
/*
Author : Prem Kumar Kannan 
Version : 1
*/
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include_once "member.php";
include_once "lib.dbconnect.php";
include_once "lib.actualGroupHeadConfig.php";

$debug=false;
$echo = "";
$xml_file_name = "ac.php";

if ($debug) { 
	$echo .= $_GET['isShowLedger']; 
}

if($_GET['isShowLedger'] != ""){
	call_user_func($_GET['isShowLedger']); 
}

function recentTransactions(){
	
	global $echo,$debug;
	
	$page = 1;	
	
	if ( isset($_GET['page']) or $_GET['page'] != ""){
		$page = $_GET['page'];
	}
	if($_GET['page']==0){$limit=1000000000;}else{
	$limit=10;}
	
	
	$sql = "SELECT * FROM administrator_daybook ORDER BY refid DESC ";
	$sqlresult = mysql_query($sql);			
	$totalrecords = mysql_num_rows($sqlresult);
	$noofpages = ceil($totalrecords/$limit);
	
	$echo .= "<div class=\"table-responsive\">";
	$echo .= "<table class=\"table table-bordered table-responsive table-hover\">";	
	
	$start = ($page-1) * $limit;
	
	$sql = "SELECT * FROM administrator_daybook ORDER BY refid DESC ";
	$query = $sql." limit ".$start.",".$limit;
	
	$result = mysql_query($query);			
	
	$echo .= "<thead><tr><th>#</th><th>Date</th><th>Debit</th><th>Credit</th><th>Amount</th><th>Description</th></tr></thead>";
	$echo .= "<tbody>";	
	
	if(mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_array($result)) {
		#if($row['dayBookContra'] == "Y") {
			$echo .= "<tr> ";
			$echo .= "<td> $row[refid] </td> ";
			$echo .= "<td> $row[dayBookDate] </td> ";			
			$echo .= "<td> $row[debit] </td> ";
			$echo .= "<td> $row[credit] </td> ";
			$echo .= "<td align=\"right\"> $row[dayBookAmount] </td> ";						
			$echo .= "<td> $row[description] </td> ";
			$echo .= "</tr>";			
		#} 	
		}
	}else{
		$echo .= "<tr>";
		$echo .= "<td colspan='6'>NO RECENT ENTRIES. CREATE JOURNAL.</td>";
		$echo .= "</tr>";
	}
	$echo .= "</tbody>";
	$echo .= "<ul class=\"pagination pull-right\">";
	$lastpage = $noofpages;
	$firstpage = 1;
	
	/* 
	for ($i = 1;$i<=$noofpages;$i++){	
		if ( $page == $i) {
			$echo .= "<li class=\"active\"><a href='javascript:recentTransactions(".$i.")'>".$i."</a></li>";
		} else {
			$echo .= "<li><a href='javascript:recentTransactions(".$i.")'>".$i."</a></li>";
		}		
	}*/
	if ($noofpages > 1){
		if ($page != 1){
			$echo .= "<li><a href='javascript:recentTransactions(1)'><span class=\"glyphicon glyphicon-triangle-left\"></span></a></li>";
			$echo .= "<li><a href='javascript:recentTransactions(".($page-1).")'><span class=\"glyphicon glyphicon-chevron-left\"></span></a></li>";			
		}
		if ($page != $noofpages){
			$echo .= "<li><a href='javascript:recentTransactions(".($page+1).")'><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
			$echo .= "<li><a href='javascript:recentTransactions(".($noofpages).")'><span class=\"glyphicon glyphicon-triangle-right\"></span></a></li>";
		}
	}
	$echo .= "</ul>";
	$echo .= "</table>";
	mysql_free_result($result);
	
}

function saveDayBook() {
	echo '<input type="button" value="SELECT" class="selectbtn" onclick="recentTransactions(0);return false;" />';
	global $echo,$debug;	
	if( $_GET['debit']         != "" && 
		$_GET['credit']        != "" && 
		$_GET['dayBookDate']   != "" && 
		$_GET['dayBookContra'] != "" && 
		$_GET['dayBookAmount'] != "" && 
		$_GET['description']   != "" 
	) {
		$query = "select acc_name from  administrator_account_name where (acc_name = '".trim(strtoupper($_GET['debit']))."')";
		$result = mysql_query($query);		
		if (mysql_num_rows($result) == 0)
		{
			$echo .= "<div class=\"alert alert-warning\"> Debit Account not available.</div>";
			return false;
		}
		
		$query = "select acc_name from  administrator_account_name where (acc_name = '".trim(strtoupper($_GET['credit']))."')";
		$result = mysql_query($query);
		if (mysql_num_rows($result) == 0)
		{
			$echo .= "<div class=\"alert alert-warning\"> Credit Account not available.</div>";
			return false;
		}
		
		/* Debit Column cannot have credit entries */
		$query = "select group_head from  administrator_account_name where (acc_name = '".trim(strtoupper($_GET['debit']))."' and group_head = 'credit')";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0)
		{
			$echo .= "<div class=\"alert alert-warning\"> ".$_GET['debit']." cannot be Debited.</div>";
			return false;
		}

		/* Credit Column cannot have debit entries */
		$query = "select group_head from  administrator_account_name where (acc_name = '".trim(strtoupper($_GET['credit']))."' and group_head = 'debit')";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0)
		{
			$echo .= "<div class=\"alert alert-warning\"> ".$_GET['credit']." cannot be Credited.</div>";
			return false;
		}
		
		/* Cash Balance cannot go negative. */
		$query = "select acc_name from  administrator_account_name where (acc_name='".$_GET['credit']."' and act_group_head='CASH')";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) 
		{
			$query = calculateCashBalance($_GET['credit']);
			$result = mysql_query($query);			
			if(mysql_num_rows($result) != 0)
			{				
				$total_balance = 0;
				$total_debit_balance = 0;
				$total_credit_balance = 0;

				while($row = mysql_fetch_array($result)) {
					$total_debit_balance += $row[debitBalance];
					$total_credit_balance += $row[creditBalance];				
					$total_balance +=  $row[balance];
				}
			
				echo $_GET['credit']." Balance :".$total_balance."<br />";
				$check_balance = $total_balance-$_GET['dayBookAmount'];
				if ($check_balance < 0)
				{
					$echo .= "<div class=\"alert alert-warning\">".$_GET['credit']." Do not have enough balance to credit.</div>";			
					return false;
				}
			} else {
				$echo .= "<div class=\"alert alert-warning\">".$_GET['credit']." Do not have enough balance to credit.</div>";
				return false;
			}
		}
		
		$sql = "INSERT INTO administrator_daybook(dayBookDate,debit,credit,dayBookContra,dayBookAmount,description) VALUES('".$_GET['dayBookDate']."','".trim(strtoupper($_GET['debit']))."','".trim(strtoupper($_GET['credit']))."','".$_GET['dayBookContra']."',".trim($_GET['dayBookAmount']).",'".trim($_GET['description'])."')";		
		if ($debug) $echo .= $sql;
		$insertion_successfull = mysql_query($sql);
		
		if($insertion_successfull) 
		{
			$sql_last="select LAST_INSERT_ID() as lastInsertId";
			$sql_last_result = mysql_query($sql_last);
			while($row = mysql_fetch_array($sql_last_result)) {
				$lastInsertId = $row[lastInsertId];
			}
			$echo .= "<div class=\"alert alert-success\">Transaction Saved into ID : <strong>".$lastInsertId."</strong></div>";
		}		
	} else {			
		$echo .= "<div class=\"alert alert-warning\">Failed to Save the transaction. Try again.</div>";
	}
}

function showLedger() {
	echo '<input type="button" value="SELECT" class="selectbtn" onclick="showLedger1(0);return false;" />';
	global $echo,$debug;
	$select_query = "SELECT refid,dayBookDate,debit,credit,dayBookContra,dayBookAmount,description,status,backup FROM administrator_daybook WHERE ";
	$key = array_keys($_GET);	
	
	for ($i =0; $i < count($key); $i++) {
		if($_GET[$key[$i]] != "") {
			if ($key[i] == "dayBookAmount") {
				/* $form_query .= " AND $key[$i] = ".$_GET[dayBookAmount];  */
			} else if ($key[$i] == "isShowLedger" || $key[$i] == "dayBookContra" ) {		
			} else if ($key[$i] == "dayBookDate"){
				$form_query .= " AND (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";
				$op_till_date_query .=  " AND (dayBookDate < '".$_GET[dayBookDate]."') ";				
			} else if ($key[$i] == "dayBookDateTo"){			
			} else if ($key[$i] == "debit") {				
				$form_query .= " AND (debit='".trim(strtoupper($_GET[debit]))."' OR credit = '".trim(strtoupper($_GET[debit]))."')";				
				$op_till_date_query .=  " AND (debit='".trim(strtoupper($_GET[debit]))."' OR credit = '".trim(strtoupper($_GET[debit]))."')";				
			} else {
				/* $form_query .= " AND $key[$i]='".$_GET[$key[$i]]."'"; */
			}
		}
	}

	$form_query = substr($form_query, 5 , strlen($form_query)); 
	$op_till_date_query =  substr($op_till_date_query, 5 , strlen($op_till_date_query));
	$op_till_date_query = $select_query.$op_till_date_query;
	
	$select_query .= $form_query." ORDER BY dayBookDate ASC";	
	$op_till_date_query = $op_till_date_query." ORDER BY dayBookDate ASC";	
	
	
	$open_balance_this_page = $select_query;
	
	/* This section is to calculate the closing balance */
	$cnt_result = mysql_query($select_query);		
	if($_GET['page']==0){$per_page=1000000000;}else{
	$per_page = 10;}
	if($_GET['page'])
	{	
		$page = $_GET['page'];
		$cur_page = $page;
		$page -= 1;
		$start = $page * $per_page;		
	}	
	if ($start == ""){
		$start = 0;
	}
	
	$open_balance_this_page = $select_query." LIMIT 0,".$start;
	/*echo $open_balance_this_page;*/
	$select_query .= " LIMIT ".$start.",".$per_page;
		
	if ($debug) $echo .= "<br>".$select_query;

	/* To avoid OR while appending with the select query  */
	$result = mysql_query($select_query);	
	echo '<input type="hidden" id="query" value="'.$select_query.'">';
	$echo .= "<h3>". $_GET[debit]."</h3>";
	
	/* Pagination */
	$no_of_paginations = ceil(mysql_num_rows($cnt_result)/$per_page);
	$echo .= "<ul class=\"pagination pull-right no-margin\">";
	/*for ($i=1;$i<=($no_of_paginations);$i++)
	{
		$echo .= "<li ";
		if ($page == ($i-1)) {
			$echo .= "class=\"active\"";
		}
		$echo .= "><a href=\"javascript: showLedger(".$i.")\">".$i."</a></li>";	
	}
	*/
	
	if ($noofpages > 1){
		if ($page != 1){
			$echo .= "<li><a href='javascript:showLedger(1)'><span class=\"glyphicon glyphicon-triangle-left\"></span></a></li>";
			$echo .= "<li><a href='javascript:showLedger(".($page-1).")'><span class=\"glyphicon glyphicon-chevron-left\"></span></a></li>";			
		}
		if ($page != $noofpages){
			$echo .= "<li><a href='javascript:showLedger(".($page+1).")'><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
			$echo .= "<li><a href='javascript:showLedger(".($noofpages).")'><span class=\"glyphicon glyphicon-triangle-right\"></span></a></li>";
		}
	}
	$echo .= "</ul>";
	
	$echo .= "<div class=\"table-responsive\">";
	$echo .= "<table class=\"table table-bordered table-responsive table-hover\">";			
	$echo .= "<tr><th align=\"right\">Date</th><th align=\"right\">Account Name</th><th align=\"right\">Debit</th><th align=\"right\">Credit</th><th align=\"right\">Balance</th><th align=\"right\">Description</th></tr>";

	/* Opening Balance Work out */
	$opening_balance_query = "select opening_balance,opening_balance_type,group_head from  administrator_account_name where acc_name='".$_GET['debit']."'";
	$opening_balance_result = mysql_query($opening_balance_query);
	if (mysql_num_rows($opening_balance_result) > 0){
		while ($row = mysql_fetch_array($opening_balance_result)) {
			if ($row[1] == "debit"){
				$debit_total = $row[0];				
			} else if ($row[1] == "credit"){
				/*$echo .= "<tr><td></td><td align=\"right\">Open / Previous Balance</td><td></td><td align=\"right\">".$row[0]."</td><td align=\"right\">".$row[0]."</td><td>&nbsp;</td></tr>"; */
				$credit_total = $row[0];
			}
			/*$opening_balance = $row[0];*/
		}	
	}

	if (isset($_GET['dayBookDate']) && ($_GET['dayBookDate'] != "") )
	{
		$op_till_date_result=mysql_query($op_till_date_query);
		if(mysql_num_rows($op_till_date_result) != 0){
			while ($row = mysql_fetch_array($op_till_date_result)) {
				if($row[debit] == $_GET[debit]) {			
					$debit_total += $row[dayBookAmount];
					$balance = $debit_total - $credit_total;			
				} else if(($row[credit] == $_GET[debit]) && ($row[dayBookContra] == "Y")) {			
					$credit_total += $row[dayBookAmount];
					$balance = $debit_total - $credit_total;			
				}
			}
		}
	}
	
	$open_balance_this_page_result=mysql_query($open_balance_this_page);
	if(mysql_num_rows($open_balance_this_page_result) != 0){
		while ($row = mysql_fetch_array($open_balance_this_page_result)) {
			if($row[debit] == $_GET[debit]) {			
				$debit_total += $row[dayBookAmount];
				$balance = $debit_total - $credit_total;			
			} else if(($row[credit] == $_GET[debit]) && ($row[dayBookContra] == "Y")) {			
				$credit_total += $row[dayBookAmount];
				$balance = $debit_total - $credit_total;			
			}
		}
	}
	
	$echo .= "<tr><td>&nbsp;</td><td align=\"right\">Opening / Previous Bal</td><td align=\"right\">".$debit_total."</td><td align=\"right\">".$credit_total."</td><td align=\"right\">".$balance."</td><td>&nbsp;</td></tr>";
	
	/* Account */
	if(mysql_num_rows($result) != 0)
	while ($row = mysql_fetch_array($result)) {
		if($row[debit] == $_GET[debit]) {			
			$echo .= "<tr>";
			$echo .= "<td align=\"right\"> $row[dayBookDate] </td>";
			/*$echo .= "<td> $row[debit] </td> "; */
			$echo .= "<td align=\"right\"> $row[credit] </td> ";
			/*$echo .= "<td> $row[dayBookContra] </td> "; */
			$echo .= "<td align=\"right\"> $row[dayBookAmount] </td> ";
			$echo .= "<td align=\"right\">  </td> ";			
			$debit_total += $row[dayBookAmount];
			$balance = $debit_total - $credit_total;
			$echo .= "<td align=right> $balance	 </td> ";
			$echo .= "<td> $row[description] </td> ";
			$echo .= "</tr>";
			
		} else if(($row[credit] == $_GET[debit]) && ($row[dayBookContra] == "Y")) {
			$echo .= "<tr> ";
			$echo .= "<td align=\"right\"> $row[dayBookDate] </td>";
			$echo .= "<td align=\"right\"> $row[debit] </td>";
			/*$echo .= "<td> $row[credit] </td> ";
			/$echo .= "<td> $row[dayBookContra] </td> "; */
			$echo .= "<td align=\"right\">  </td> ";
			$echo .= "<td align=\"right\"> $row[dayBookAmount] </td> ";			
			$credit_total += $row[dayBookAmount];
			$balance = $debit_total - $credit_total;
			$echo .= "<td align=right> $balance	 </td> ";
			$echo .= "<td> $row[description] </td> ";
			$echo .= "</tr>";
		}
	}
	
	/* Calculate Ledger Balance */
	
	$echo .= "<tr><td>&nbsp;</td><td align=\"right\">Total</td><td align=\"right\">".$debit_total."</td><td align=\"right\">".$credit_total."</td><td align=\"right\">".$balance."</td><td>&nbsp;</td></tr>";
	$echo .= "</table>";
	$echo .= "</div>";
}

function calculateCashBalance($cash){
	$query = "SELECT name, sum(debitBalance) as debit, sum(creditBalance) as credit, sum(debitBalance)-sum(creditBalance) as balance from ( SELECT name, sum( a ) as debitBalance , sum( b ) as creditBalance, sum(a)-sum(b) as balance FROM ( SELECT debit AS name, sum( daybookamount ) AS a, 0 AS b, 0 AS c FROM administrator_daybook GROUP BY debit UNION SELECT credit AS name, 0 AS a, sum( daybookamount ) AS b, 0 AS c FROM administrator_daybook GROUP BY credit ) AS TT1 GROUP BY TT1.name union SELECT name, a as debitBalance, b as creditBalance, sum(a)- sum(b) as balance from ( SELECT acc_name as name, opening_balance as a, 0 as b, 0 as balance from  administrator_account_name where opening_balance_type='debit' union SELECT acc_name as name, 0 as a, opening_balance as b, 0 as balance from  administrator_account_name where opening_balance_type='credit' ) as TT2 group by TT2.name ) as TT3 where TT3.name='".$cash."' group by TT3.name";
	return $query;
}

function showTrialBalance() {
	
	global $echo,$debug;	
	$query = "SELECT name, sum(debitBalance) as debit, sum(creditBalance) as credit, sum(debitBalance)-sum(creditBalance) as balance from ";
	$query .= " (";
	$query .= "  SELECT name, sum( a ) as debitBalance , sum( b ) as creditBalance, sum(a)-sum(b) as balance FROM ";
	$query .= "  (";
	$query .= "   SELECT debit AS name, sum( daybookamount ) AS a, 0 AS b, 0 AS c FROM administrator_daybook ";
   	if($_GET[dayBookDate] != "") {
		$query .= " WHERE (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
	}
	$query .= " GROUP BY debit ";
	$query .= " UNION ";
	$query .= " SELECT credit AS name, 0 AS a, sum( daybookamount ) AS b, 0 AS c FROM administrator_daybook ";
	if($_GET[dayBookDate] != "") {
		$query .= " WHERE (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
	}
	$query .= "   GROUP BY credit ";
	$query .= "  ) AS TT1 GROUP BY TT1.name ";
    $query .= "  union";
	$query .= " SELECT name, a as debitBalance, b as creditBalance, sum(a)- sum(b) as balance from ";
	$query .= " (";
	$query .= " SELECT acc_name as name, opening_balance as a, 0 as b, 0 as balance from  administrator_account_name where opening_balance_type='debit' ";
	$query .= " union";
	$query .= " SELECT acc_name as name, 0 as a, opening_balance as b, 0 as balance from  administrator_account_name where opening_balance_type='credit'";
	$query .= " ) as TT2 group by TT2.name";
 	$query .= " ) as TT3 group by TT3.name ";

	$total_debit_balance = "";
	$total_credit_balance = "";
	$total_balance = "";
		
	$echo .= "<h4>Trial Balance : ".$_GET['dayBookDate']." to ".$_GET['dayBookDateTo']."</h4>";	
	$echo .= "<div class=\"table-responsive\">";
	$echo .= "<table class=\"table table-bordered table-responsive table-hover\">";	
	$echo .= "<tr><td>Account Name</td><td>Debit</td><td>Credit<td>Balance</td></tr>";
	if ($debug) echo $query; 	 
	
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result)) {
			$echo .= "<tr><td>".$row[0]."</td>";
			$echo .= "<td align=\"right\">".$row[1]."</td>";
			$echo .= "<td align=\"right\">".$row[2]."</td>";
			$echo .= "<td align=\"right\">".$row[3]."</td></tr>";
			$total_debit_balance += $row[1];
			$total_credit_balance += abs($row[2]);
			$total_balance += $row[3];
		} 
	}
	$echo .= "<tr><td align=\"right\">Total</td><td align=\"right\">".$total_debit_balance."</td><td align=\"right\">".$total_credit_balance."</td><td align=\"right\">".$total_balance."</td></tr>";
	$echo .= "</table>";	
	$echo .= "</div>";
}

function showBalanceSheet() {    
	
	global $echo,$debug,$xml_file_name;
	$tb_balance = "";
	
	/* Trading Account Work Out */	
	$echo .= "<br />";
	$echo .= "<h4>Trading Account : ".$_GET['dayBookDate']." to ".$_GET['dayBookDateTo']."</h4>";
	$echo .= "<div class=\"table-responsive\">";
	$echo .= "<table class=\"table table-bordered table-responsive table-hover\">";	
	$echo .= "<thead>";
	$echo .= "<tr><th>Trading Account</th><th>Debit</th><th>Credit</th></tr>";
	$echo .= "</thead>";
	$echo .= "<tbody>";
	$query = " select sum(opening_balance) AS opening_stock from administrator_account_name where act_group_head='STOCK' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result)) {
			$echo .= "<tr><td>Opening Stock</td><td>".$row[opening_stock]."</td><td></td></tr>";
			$tb_balance = $tb_balance + $row[opening_stock];
		}
		
	}
	$query = " select an.act_group_head as actgrouphead,sum(db.daybookamount) as debit, 0 as credit from administrator_daybook as db inner join  administrator_account_name as an on db.debit=an.acc_name where an.acc_head='tr' ";
   	if($_GET[dayBookDate] != "") {
		$query .= " and (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
	}	
	$query .= "	group by an.act_group_head";
	$query .= " union ";
	$query .= " select an.act_group_head as actgrouphead,0 as debit, sum(db.daybookamount) as credit from administrator_daybook as db inner join  administrator_account_name as an on db.credit=an.acc_name where an.acc_head='tr' ";
   	if($_GET[dayBookDate] != "") {
		$query .= " and (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
	}	
	$query .= " group by an.act_group_head";
	
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result)) {
			$echo .= "<tr><td>".$row[actgrouphead]."</td>";
			$echo .= "<td align=\"right\">".$row[debit]."</td>";
			$echo .= "<td align=\"right\">".$row[credit]."</td>";
			$tb_balance += $row[debit] - $row[credit];
		} 
	}

	$query = " select sum(closing_balance) AS closing_stock from administrator_account_name where act_group_head='STOCK' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result)) {
			$echo .= "<tr><td>Closing Stock</td><td></td><td>".$row[closing_stock]."</td></tr>";
			$tb_balance = $tb_balance - $row[closing_stock];
			$closing_stock = $row[closing_stock];
		}
	}
		
	if ($tb_balance <= 0) {
		$tb_profit = $tb_balance;
		$echo .= "<tr><td>Trading Profit</td>";
		$echo .= "<td align=\"right\">".abs($tb_profit)."</td>";
		$echo .= "<td align=\"right\">&nbsp;</td>";
		$echo .= "</tr>";
	} else {
		$tb_loss = $tb_balance;		
		$echo .= "<tr><td>Trading Loss</td>";
		$echo .= "<td align=\"right\">&nbsp;</td>";
		$echo .= "<td align=\"right\">".$tb_loss."</td>";
		$echo .= "</tr>";
	}
	$echo .= "</tbody>";
	$echo .= "</table>";	
	$echo .= "</div>";
	
	$pl_balance = "";

	$echo .= "<h4>Profit &amp; Loss for the period from ".$_GET['dayBookDate']." to ".$_GET['dayBookDateTo']."</h4>";	
	$echo .= "<div class=\"table-responsive\">";
	$echo .= "<table class=\"table table-bordered table-responsive table-hover\">";	
	$echo .= "<thead>";	
	$echo .= "<tr><th>Profit & Loss</th><th>Debit</th><th>Credit</th></tr>";
	$echo .= "</thead>";
	$echo .= "<tbody>";
	$query = " select an.act_group_head as actgrouphead,sum(db.daybookamount) as debit, 0 as credit from administrator_daybook as db inner join  administrator_account_name as an on db.debit=an.acc_name where an.acc_head='pl' ";
   	if($_GET[dayBookDate] != "") {
		$query .= " and (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
	}

	$query .= " group by an.act_group_head";
	$query .= " union ";
	$query .= " select an.act_group_head as actgrouphead,0 as debit, sum(db.daybookamount) as credit from administrator_daybook as db inner join  administrator_account_name as an on db.credit=an.acc_name where an.acc_head='pl' ";
   	if($_GET[dayBookDate] != "") {
		$query .= " and (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
	}

	$query .= " group by an.act_group_head";

	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result)) {
			$echo .= "<tr><td><a href=\"javascript:postActionGroupName('".$row[actgrouphead]."','showGroup')\">".$row[actgrouphead]."</a></td>";
			$echo .= "<td align=\"right\">".$row[debit]."</td>";
			$echo .= "<td align=\"right\">".$row[credit]."</td>";
			$pl_balance += $row[debit] - $row[credit];
		} 
	}
	
	$pl_balance = $pl_balance + $tb_profit + $tb_loss;
	if ($pl_balance <= 0) {
		$pl_profit = $pl_balance;
		$echo .= "<tr><td>Net Profit</td>";
		$echo .= "<td align=\"right\">".abs($pl_profit)."</td>";
		$echo .= "<td align=\"right\">&nbsp;</td>";
		$echo .= "</tr>";
	} else {
		$pl_loss = $pl_balance;		
		$echo .= "<tr><td>Net Loss</td>";
		$echo .= "<td align=\"right\">&nbsp;</td>";
		$echo .= "<td align=\"right\">".$pl_loss."</td>";
		$echo .= "</tr>";
	}
	$echo .= "</tbody>";
	$echo .= "</table>";	
	$echo .= "</div>";
	
	$query = "select actgrouphead, sum(debit) as debit, sum(credit) as credit, sum(debit-credit) as balance from";
            $query .=  " (";
			$query .=  "   select actgrouphead, sum(a) as debit, sum(b) as credit , sum(a-b) as balance from ";
			$query .=  "   (";
			$query .=  "    select an.act_group_head as actgrouphead,sum(db.daybookamount) as a, 0 as b, 0 as c from administrator_daybook as db inner join  administrator_account_name as an on db.debit=an.acc_name where an.acc_head='bs' ";
			if($_GET[dayBookDate] != "") {
				$query .= " and (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
			}	
			  $query .= " group by an.act_group_head";
			  $query .= "   union";
			  $query .= "	select an.act_group_head as actgrouphead,0 as a, sum(db.daybookamount) as b, 0 as c from administrator_daybook as db inner join  administrator_account_name as an on db.credit=an.acc_name where an.acc_head='bs' ";
			if($_GET[dayBookDate] != "") {
				$query .= " and (dayBookDate between '".$_GET[dayBookDate]."' and '".$_GET[dayBookDateTo]."') ";			
			}
			$query .=  " group by an.act_group_head";
			$query .=  "	  ) ";
			$query .=  "	  as TT1 group by TT1.actgrouphead";
			$query .=  "	  union";
			$query .=  "	  select actgrouphead, sum(debit) as debit, sum(credit) as credit, sum(debit-credit) as balance from ";
			$query .=  "	  (";
			$query .=  "	    select act_group_head as actgrouphead, sum(opening_balance) as debit, 0 as credit, 0 as balance from  administrator_account_name where opening_balance_type='debit'";
			$query .=  " group by act_group_head";
			$query .=  " union";
			$query .=  " select act_group_head as actgrouphead, 0 as debit, sum(opening_balance) as credit, 0 as balance from  administrator_account_name where opening_balance_type='credit' ";
			$query .=  " group by act_group_head";
			$query .=  "	  )";
			$query .=  "    as TT2 group by TT2.actgrouphead";
			$query .=  "	)";
			$query .=  "	as TT3 where TT3.actgrouphead <> 'STOCK' group by TT3.actgrouphead"; // Avoid showing Stock
	$result = mysql_query ($query);
	
	$echo .= "<h4>Balance Sheet : ".$_GET['dayBookDate']." to ".$_GET['dayBookDateTo']."</h4>";	
	$echo .= "<div class=\"table-responsive\">";
	$echo .= "<table class=\"table table-bordered table-responsive table-hover\">";	
	$echo .= "<thead>";	
	$echo .= "<tr><th>Balance Sheet</th><th>Liability</th><th>Asset</th></tr>";
	$echo .= "</thead>";
	$echo .= "<tbody>";
	
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result)) {
			if ($row[3] < 0){
				$echo .= "<tr><td><a href=\"javascript:postActionGroupName('".$row[0]."','showGroup')\">".$row[0]."</td><td align=\"right\">".abs($row[3])."</td><td align=\"right\"></td></tr>";				
				$liability_balance += abs($row[3]);
			} else {
				$echo .= "<tr><td><a href=\"javascript:postActionGroupName('".$row[0]."','showGroup')\">".$row[0]."</td><td align=\"right\"></td><td align=\"right\">".$row[3]."</td></tr>";				
				$asset_balance += abs($row[3]);
			}
		}
	}
	$asset_balance += $closing_stock;
	$echo .= "<tr><td>STOCK</td><td align=\"right\"></td><td align=\"right\">".$closing_stock."</td></tr>";
	$liability_balance += abs($pl_profit);
	$asset_balance += $pl_loss;
	$echo .= "<tr><td>Net Profit / Net Loss</td><td align=\"right\">".abs($pl_profit)."</td><td align=\"right\">".$pl_loss."</td></tr>";
	$echo .= "<tr><td>Total</td><td align=\"right\">".$liability_balance."</td><td align=\"right\">".$asset_balance."</td></tr>";
	$echo .= "</tbody>";
	$echo .= "</table>";
	$echo .= "</div>";
}

echo $echo;
?>