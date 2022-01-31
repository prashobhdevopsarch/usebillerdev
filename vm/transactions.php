<?php
session_start();
include("includes/config.php");

if(isset($_SESSION['admin'])){}else{header("location:index.php");}

//$privilege=explode(",",$_SESSION['privilege']);

//include_once 'member.php';
include_once 'lib.dbconnect.php';
//mysql_select_db($_SESSION['database']);
?>
<!DOCTYPE html>
<html lang="en">
<style>

@media print{
.selectbtn{display:none;}</style>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>US e-Biller</title>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<script type="text/javascript" language="javascript">


//var urlPath="http://utparasolutions.com/clients/gayathri/accounting/";
//var urlPath="http://localhost/project/gayathri/accounting/";

var accountNames = new Array();
function postAction(isShowLedger) {	
	// Change the day Book Format while sending it to the storage.
	$("#dbModalStatus").text('Saving..');
	var dayBookDate   = document.getElementById("dayBookDate").value;
	//var dayBookDateTo = document.getElementById("dayBookDateTo").value;
	var branchid = document.getElementById("barnchid").value;
	if(dayBookDate != "") 	dayBookDate = convertDateFormat(dayBookDate,"dd-mm-yyyy","yyyy-mm-dd");
	//if(dayBookDateTo != "") dayBookDateTo = convertDateFormat(dayBookDateTo,"dd-mm-yyyy","yyyy-mm-dd");

	//alert(dayBookDateTo);
	
	// Do not change the order GET string series dayBookDate should follow dayBookDateTo and not viceversa.	
	var postStr = "dayBookDate=" + encodeURI( dayBookDate ) +
					//"&dayBookDateTo=" + encodeURI( dayBookDateTo ) +
                    "&debit=" + encodeURI( document.getElementById("debit").value ) + 
					"&credit=" + encodeURI( document.getElementById("credit").value ) + 
					"&dayBookContra=Y"+					
					"&dayBookAmount=" + encodeURI( document.getElementById("amount").value ) + 
					"&description=" + encodeURI( document.getElementById("description").value ) + 
					"&isShowLedger=" + encodeURI( isShowLedger )  

	//  http_request.send(parameters);
		
	var url= "postAction.php?"+postStr+'&branchid='+branchid;	                
	$("#dbModalStatus").load(url,function(responseData){
		// whatever you need to do when the ajax call is complete
		var suc = new RegExp("Saved");	
		if (suc.test(responseData))
		{
			$("#daybookDate").val('');
			$("#debit").val('');
			$("#credit").val('');
			$("#amount").val('');
			$("#description").val('');
			$("#dbModalBody").show();
		} 	
	});
}


function postLedger(page){

	var ledgerDate   = document.getElementById("ledgerDate").value;
	var ledgerDateTo = document.getElementById("ledgerDateTo").value;
	var branchid = document.getElementById("barnchid1").value;
	
	if(ledgerDate != "") 	ledgerDate = convertDateFormat(ledgerDate,"dd-mm-yyyy","yyyy-mm-dd");
	if(ledgerDateTo != "") ledgerDateTo = convertDateFormat(ledgerDateTo,"dd-mm-yyyy","yyyy-mm-dd");

	//alert(dayBookDateTo);
	
	// Do not change the order GET string series dayBookDate should follow dayBookDateTo and not viceversa.	
	var postStr = "dayBookDate=" + encodeURI( ledgerDate ) +
					"&dayBookDateTo=" + encodeURI( ledgerDateTo ) +
                    "&debit=" + encodeURI( document.getElementById("ledger").value ) + 					
					"&isShowLedger=" + encodeURI( "showLedger" )  +
					"&page=" + encodeURI(page);
	//  http_request.send(parameters);
		
	var url= "postAction.php?"+postStr+"&branchid="+branchid;
	//alert(url);
		
	$("#displayDaybookEntries").load(url,function(responseData){
		$("#ledgerModal").modal('hide');
	});
}


function postTrialBalance(page){

	var tbDate   = document.getElementById("tbDate").value;
	var tbDateTo = document.getElementById("tbDateTo").value;
	
	if(tbDate != "") 	tbDate = convertDateFormat(tbDate,"dd-mm-yyyy","yyyy-mm-dd");
	if(tbDateTo != "") tbDateTo = convertDateFormat(tbDateTo,"dd-mm-yyyy","yyyy-mm-dd");

	//alert(dayBookDateTo);
	
	// Do not change the order GET string series dayBookDate should follow dayBookDateTo and not viceversa.	
	var postStr = "dayBookDate=" + encodeURI( tbDate ) +
					"&dayBookDateTo=" + encodeURI( tbDateTo ) +
                    "&isShowLedger=" + encodeURI( "showTrialBalance" )  +
					"&page=" + encodeURI(page);
	//  http_request.send(parameters);
		
	var url= "postAction.php?"+postStr;
	//alert(url);
		
	$("#displayDaybookEntries").load(url,function(responseData){
		$("#tbModal").modal('hide');
	});
}


function postBalanceSheet(page){

	var bsDate   = document.getElementById("bsDate").value;
	var bsDateTo = document.getElementById("bsDateTo").value;
	
	if(bsDate != "") 	bsDate = convertDateFormat(bsDate,"dd-mm-yyyy","yyyy-mm-dd");
	if(bsDateTo != "") bsDateTo = convertDateFormat(bsDateTo,"dd-mm-yyyy","yyyy-mm-dd");

	//alert(dayBookDateTo);
	
	// Do not change the order GET string series dayBookDate should follow dayBookDateTo and not viceversa.	
	var postStr = "dayBookDate=" + encodeURI( bsDate ) +
					"&dayBookDateTo=" + encodeURI( bsDateTo ) +
                    "&isShowLedger=" + encodeURI( "showBalanceSheet" )  +
					"&page=" + encodeURI(page);
	//  http_request.send(parameters);
		
	var url= "postAction.php?"+postStr;
	//alert(url);
		
	$("#displayDaybookEntries").load(url,function(responseData){
		$("#bsModal").modal('hide');
	});
}


function postActionGroupName(groupName,showType){
	//alert ("Show Type"+showType);
	// Change the day Book Format while sending it to the storage.
	var dayBookDate   = document.getElementById("dayBookDate").value;
	var dayBookDateTo = document.getElementById("dayBookDateTo").value;
	var branchid = document.getElementById("barnchid").value;
	if(dayBookDate != "") 	dayBookDate = convertDateFormat(dayBookDate,"dd-mm-yyyy","yyyy-mm-dd");
	if(dayBookDateTo != "") dayBookDateTo = convertDateFormat(dayBookDateTo,"dd-mm-yyyy","yyyy-mm-dd");

	var postStr = "dayBookDate=" + encodeURI( dayBookDate ) +
					"&dayBookDateTo=" + encodeURI( dayBookDateTo ) +
					"&debit=" + encodeURI( groupName ) +
                    "&groupName=" + encodeURI( groupName ) + 
					"&isShowLedger=" + showType;
	
	var url= "postAction.php?"+postStr+"&branchid="+branchid;	                
	alert(branchid);
	req.onreadystatechange = receiveUpdatedDayBookPosition;
	req.open("GET", url, true);   
	//req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //req.setRequestHeader("Content-length", postStr.length);
    //req.setRequestHeader("Connection", "close");
	req.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	req.send(null);
	
}

function saveAccounts() {		
	var dayBookDate = document.getElementById('dayBookDate').value;
	//var dayBookDateTo = document.getElementById('dayBookDateTo').value;
	var debit = document.getElementById('debit').value;
	var credit = 	document.getElementById('credit').value;
	//var dayBookContra = document.getElementById('dayBookContra').value;
	var dayBookContra = "Y";
	var dayBookAmount = document.getElementById('amount').value;
	var description = document.getElementById('description').value;
	
	if(!validateDate(dayBookDate)) {
			alertModal("Please Correct the Date format");
			return false;
	}
	
	if(dayBookDate == "" || 
		   debit == "" || 
		   credit == "" ||
		   dayBookContra == "" ||
		   dayBookAmount == "" || 
		   description == "")
	{
			alertModal("Please Submit all the values to save the form");			
			return false;
	}	
	if(debit == credit){
		alertModal("Debit and Credit cannot be same.");
		return false;
	} else {
		postAction("saveDayBook");
		return false;
	}
}

function alertModal(message){
	var msg = message;	
	document.getElementById("modalBody").innerHTML="<div class=\"alert alert-warning\">"+msg+"</div>";
	$("#myModal").modal();
}
function showLedger(page) {
	ledgerDate = document.getElementById("ledgerDate").value;
	ledgerDateTo = document.getElementById("ledgerDateTo").value;
	if(!validateBothDates(ledgerDate,ledgerDateTo)){		 		
		return false;
	}
	//alert("show ledger");
	ledger = document.getElementById("ledger").value;
	if(ledger == "") {
		alertModal("Please Enter Account Name");
		return false;
	} else {		
		postLedger(page);
	}
}
function showLedger1(page) {
	ledgerDate = document.getElementById("ledgerDate").value;
	ledgerDateTo = document.getElementById("ledgerDateTo").value;
	if(!validateBothDates(ledgerDate,ledgerDateTo)){		 		
		return false;
	}
	//alert("show ledger");
	ledger = document.getElementById("ledger").value;
	if(ledger == "") {
		alertModal("Please Enter Account Name");
		return false;
	} else {		
		postLedger(page);
	}
}
function showTrialBalance(page){
	tbDate = document.getElementById("tbDate").value;
	tbDateTo = document.getElementById("tbDateTo").value;	
	if(!validateBothDates(tbDate,tbDateTo)){				
		return false;
	} else {
		postTrialBalance(page);
	}
}
function showBalanceSheet(page){ 
	bsDate = document.getElementById("bsDate").value;
	bsDateTo = document.getElementById("bsDateTo").value;	

	if(!validateBothDates(bsDate,bsDateTo)){
		return false;
	} else {
		postBalanceSheet(page);
		return false;
	}
}
//This function is obsolete.
function validateDate(str){
	// Format Match 
	var reg = /^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/
	if (!(str.match(reg)))
	{
		alert("Not a valid Date format. Please specify in : dd-mm-yyyy (day-month-year) format using hyphen as a delimiter");				
		return false;	
	}
	var date_array = str.split("/");	
	// date_array[0] is the day of variable "str" date
	// date_array[1] is the month of variable "str" date
	// date_array[2] is the year of variable "str" date
	if(date_array[0] == "00" || date_array[1] == "00" || date_array[2] == "0000" ){
		alert("Not a valid Date. Please enter valid Date. 0's are not valid date");
		return false; 
	}

	// initialize the variable is_leap_year to no.
	var is_leap_year = "no";
	if((date_array[2] % 4) == 0) {
		if((date_array[2] % 100) == 0 ) {
			if((date_array[2] % 400) == 0) {
				is_leap_year = "yes";
			} else {
				is_leap_year = "no";
			}
		} else {
			is_leap_year = "yes";
		}
	}

	//alert(is_leap_year);
	// If it is leap year then check the february month.	
	if(date_array[1] == "02") {
		if(is_leap_year == "yes") {
			//alert("Feb month with max of 29 days");	
			reg = /[012][0-9]\-02\-[0-9]{4}/			
		} else {
			//alert("Feb month with max of 28 days");
			reg = /[012][0-8]\-02\-[0-9]{4}/
		}
	} else {
		reg = /(([012][0-9]|30|31)\-(01|03|05|07|08|10|12)\-([0-9]{4}))|(([012][0-9]|30)\-(02|04|06|09|11)\-([0-9]{4}))/
	}

	//alert(reg);
	
	var assign_var;
	assign_var = reg.test(str);	
	if (assign_var) {
	  //alert("Valid Date Format");	
	  return true;
	} else {
	  //alert("Invalid Date Format");
	  return false;
	}
}
// End of validateDate
function populateTodayDate() {
	 var dt = new Date();
	 todayDate = dt.getDate();
	 todayMonth = dt.getMonth()+1;
	 
	 if (todayDate  < 10) todayDate = "0"+todayDate;
	 if (todayMonth < 10) todayMonth = "0"+todayMonth;

	 var date_string = todayDate+"-"+todayMonth+"-"+dt.getFullYear();
	 document.getElementById('dayBookDate').value = date_string;
}
function populateAccountNames() {	
	var url= "ac.php";	
	req.onreadystatechange = populateAcNames;    
	req.open("GET", url, true);   
	req.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	req.send(null);
}
function populateAcNames() { // Follow up PopulateAccountNames()   
	if (req.readyState == 4) {
		if (req.status == 200) {		    
			populateAccNames();		
			document.getElementById('displayDayBookEntries').innerHTML = "";
		} else {
			//alert ('inside ac names');
			alert('Not able to process message'); 
		}
	} else {		
		document.getElementById('displayDayBookEntries').innerHTML = " Loading ... ";
	}
}
function populateAccNames() {	// Follow up PopulateAccountNames()	
	var employees = null;
	//alert(req);
	var employees=req.responseXML.getElementsByTagName("account");
	//alert(employees.length);
	for (loop = 0; loop < employees.length; loop++) {
		
	} 
	req.abort();
}

// library function
function convertDateFormat(dateValue, existingFormat, wantedFormat) {
	var date_array = dateValue.split("-");
	var existingFormat_array = existingFormat.split("-");
	var wantedFormat_array = wantedFormat.split("-");

	var standardDate_array = new Array();
	var convertedDate_array = new Array(3);
	var returnConvertedDateValue;
	
	for(var i = 0; i < existingFormat_array.length ; i++) {
		switch (existingFormat_array[i])
		{
			case "dd": standardDate_array[0] = 	date_array[i];	 break;
			case "mm": standardDate_array[1] = 	date_array[i];	 break;
			case "yyyy": standardDate_array[2] = date_array[i];  break;
		}
	}

	for(var i = 0; i < wantedFormat_array.length ; i++) {
		switch (wantedFormat_array[i])
		{
			case "dd": convertedDate_array[i] = standardDate_array[0];	break;
			case "mm": convertedDate_array[i] = standardDate_array[1];  break;
			case "yyyy": convertedDate_array[i] = standardDate_array[2]; break;
		}	
	}
	returnConvertedDate = convertedDate_array[0]+"-"+convertedDate_array[1]+"-"+convertedDate_array[2];
	return returnConvertedDate
}
var currentFinancialYearEnd = "";
var currentFinancialYearStart = "";
// Determine Current financial Year
function dcfy(){
	var dt = new Date();
	todayDate = dt.getDate();
	todayMonth = dt.getMonth()+1;
	if(todayMonth < 4) {
		currentFinancialYearEnd = dt.getFullYear();
		currentFinancialYearStart = dt.getFullYear()-1;
	} else {
		currentFinancialYearEnd = dt.getFullYear()+1;
		currentFinancialYearStart = dt.getFullYear();
	}
}

function validateBothDates(ledgerDate,ledgerDateTo) {
	var dayBookFromDateEntered = false;
	var dayBookToDateEntered = false;
	var bothDatesEntered = false;
	if(ledgerDate != "") {
		dayBookFromDateEntered = true;
		if(ledgerDate != "" && (!validateDate(ledgerDate))){
			alert("Please correct \"From\" date format");
			return false;
		}
	}
	if(ledgerDateTo != "") {
		dayBookToDateEntered = true;
		if(ledgerDateTo != "" && (!validateDate(ledgerDateTo))){
			alert("Please correct \"To\" date format");
			return false;
		}
	}
	if(dayBookFromDateEntered == false &&  dayBookToDateEntered == false){
		bothDatesEntered = false;
		return true
	} else {
		if(dayBookFromDateEntered == true && dayBookToDateEntered == true) {
			bothDatesEntered = true;	
		} else {
			alert("Please Enter both the dates or do not Enter the Dates");
			return false;
		}
	}
	if(bothDatesEntered == true) {
		//alert('inside both dates');
		 var dt = new Date();
		 todayDate = dt.getDate();
		 todayMonth = dt.getMonth()+1;
		 if(todayMonth < 4) {
			currentFinancialYearEnd = dt.getFullYear();
			currentFinancialYearStart = dt.getFullYear()-1;
		 } else {
			currentFinancialYearEnd = dt.getFullYear()+1;
			currentFinancialYearStart = dt.getFullYear();
		 }
		 if (todayDate  < 10) todayDate = "0"+todayDate;
		 if (todayMonth < 10) todayMonth = "0"+todayMonth;
		 var date_string = todayDate+"-"+todayMonth+"-"+dt.getYear();
		 // document.getElementById('dayBookDate').value = date_string;
		 var dayBookDateArray = ledgerDate.split("-");
		 var dayBookDateToArray = ledgerDateTo.split("-");
		 // date_array[0] is the day of variable "str" date
		 // date_array[1] is the month of variable "str" date
		 // date_array[2] is the year of variable "str" date	
		 var dayBookDateObject = new Date(dayBookDateArray[2],dayBookDateArray[1],dayBookDateArray[0]);
		 var dayBookDateToObject = new Date(dayBookDateToArray[2],dayBookDateToArray[1],dayBookDateToArray[0]);
		 var currentFinancialYearEndObject = new Date(currentFinancialYearEnd,03,31);
		 var currentFinancialYearStartObject = new Date(currentFinancialYearStart,04,01);
		  //alert("From Date Time "+dayBookDateObject.getTime()+" \n To Date Time "+dayBookDateToObject.getTime());
		 dayBookDateTime = dayBookDateObject.getTime();
		 dayBookDateToTime = dayBookDateToObject.getTime();
		 currentFinancialYearStartTime = currentFinancialYearStartObject.getTime();
		 currentFinancialYearEndTime = currentFinancialYearEndObject.getTime();

			//alert("dayBookDateTime : "+dayBookDateTime+" \n dayBookDateToTime : "+dayBookDateToTime+" \n currentFinancialYearStartTime : "+currentFinancialYearStartTime+" \n currentFinancialYearEndTime : "+currentFinancialYearEndTime);
			
		  
		  //if(dayBookDateTime < currentFinancialYearStartTime || dayBookDateTime > currentFinancialYearEndTime ||
		//	    dayBookDateToTime < currentFinancialYearStartTime || dayBookDateToTime > currentFinancialYearEndTime) {
		//			alert("Dates should fall in current financial Year");
		//			return false
		 // }

		  if(dayBookDateObject.getTime() >  dayBookDateToObject.getTime()) {
				alert("From date cannot be greater than To date");
				return false;
		  }
		  return true;
	}
}		

var req = getHTTPObject(); // We create the HTTP Object
var totDisplayCount = 0; // Count of the total no of items displayed in the auto completion div tag
var trackCount = 0; // Track the count for arrow keys
var rollBackColorCount = 0; 
var glbTmr=0; // Timer to hide and show the select box / list box
var NameofSelect;
var completeFieldFocussed;

function recentTransactions(page){	
	//$("#displayDaybookEntries").html("<p>Loading</p>");
	var postStr = "isShowLedger=" + encodeURI("recentTransactions");
		postStr += "&page=" + encodeURI(page);	
	var url= "postAction.php?"+postStr;
	$("#displayDaybookEntries").load(url, function() {
		//alert( "Load was performed." );
	});
}

function printPopup(companyname){
	var displayDayBookEntries = "<html>";
	displayDayBookEntries += "<head>";
	displayDayBookEntries += '<link rel="stylesheet" type="text/css" href="lib.global.css"/>';
	displayDayBookEntries += "</head>";
	displayDayBookEntries += "<body>";
	displayDayBookEntries += "<h1>"+companyname+"</h1>";
	displayDayBookEntries += document.getElementById("displayDayBookEntries").innerHTML;
	displayDayBookEntries += "</body>";
	displayDayBookEntries += "</html>";	
	var popup = window.open();	
	popup.document.writeln(displayDayBookEntries);
}

function defaultDisplay(){
	populateTodayDate();	
}
</script>

<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="css/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/bootstrap-3.3.6-dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="css/jquery.min.js"></script>
<script src="css/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui-1.11.4/jquery-ui.min.css">



<!--  gaythri css -->

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
		<link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

<!-- Latest compiled Bootstrap JavaScript -->
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script>
//Refresh Recent Transactions



function closeDBModal(){
	recentTransactions(1);
}

function daybookModal()
{
	$("#dbModalBody").show();
	$("#dbModalStatus").text('');
	$("#dbModal").modal();	
	//loadAutoComplete();
}

function ledgerModal()
{	
	$("#ledgerModal").modal();
}

function tbModal()
{	
	$("#tbModal").modal();
}

function bsModal()
{
	$("#bsModal").modal();
}

</script>

<style>
.ui-autocomplete { z-index:2147483647; }
</style>

</head>

<body onLoad="javascript:defaultDisplay();dcfy();" class="page-header-fixed">
<div class="overlay"></div>
<main class="page-content content-wrap">
<?php 
include("includes/topheader.php");
include("includes/adminsidebar.php"); ?>
<div class="page-inner">
<div class="page-title">
	  <h3><?=$_SESSION["name"]?></h3>
	  <div class="page-breadcrumb">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
          
          <li class="active">Accounts</li><?php //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';?>
		</ol>
	  </div>
	</div>
<div id="main-wrapper">
	<div class="row">
	  <div class="col-md-12">
		<div class="panel panel-white" style="padding-top: 15px;">
 <!--<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
     </button>
      
       
    </div>    
    <div class="collapse navbar-collapse" id="myNavbar">
     <ul class="nav navbar-nav">
	<li><a href="addAccount.php"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Manage Account Details</a></li>
	<li class="active"><a href="index.php"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Transactions and Statements</a></li>
    <li><a href="../"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;Back</a></li>

	<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log out</a></li>
      </ul>
    </div>
  </div>
</nav>-->

<div class="modal fade" id="dbModal" role="dialog">
<div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Journal Entry</h4>
        </div>
        <div class="modal-body" id="dbModalBody">
          <div id="saveDayBook" class="form-horizontal" role="form">
			  <div class="form-group">
				<label class="control-label col-sm-2" for="daybookDate">Date</label>
				 <div class="col-sm-10">
                 	<input type="hidden" name="barnchid" id="barnchid">	
				   <input type="text" name="dayBookDate" class="form-control input-sm" id="dayBookDate" maxlength="10"></input>
				 </div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="debit">Debit:</label>
				 <div class="col-sm-10">		
				 <input type="text" id="debit" name="debit" class="form-control input-sm" maxlength="50"></input>
				 </div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="credit">Credit:</label>
				 <div class="col-sm-10">		
				 <input type="text" id="credit" name="credit" class="form-control input-sm" maxlength="50"></input>
				 </div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="amount">Amount:</label>
				 <div class="col-sm-10">		
				<input type="text" id="amount" name="amount" class="form-control input-sm" maxlength="15"></input>
				 </div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="description">Description:</label>
				 <div class="col-sm-10">		
				<input type="text" name="description" class="form-control input-sm" id="description" maxlength="100"></input>
				 </div>
			  </div>
			  <button class="btn btn-default" onClick="saveAccounts();return false;">Save</button>
			</div>
        </div>
		<div class="modal-body" id="dbModalStatus">
		</div>
        <div class="modal-footer" >
          <button type="button" class="btn btn-default" data-dismiss="modal" onClick="closeDBModal();">Close</button>
        </div>
      </div>
</div>
</div>

<div class="modal fade" id="ledgerModal" role="dialog">
<div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Ledger</h4>
        </div>
        <div class="modal-body">
			<div class="form-horizontal" role="form">
				  <div class="form-group">
                  <input type="hidden" name="barnchid1" id="barnchid1">
					<label class="control-label col-sm-4" for="daybookDate">From Date</label>
					 <div class="col-sm-8">					 	
						<input type="text" name="ledgerDate" class="form-control input-sm" id="ledgerDate" maxlength="10"></input>						
					 </div>
				   </div>
				  <div class="form-group">
				  	<label class="control-label col-sm-4" for="daybookDateTo">To Date</label>
					 <div class="col-sm-8">		
					   <input type="text" name="ledgerDateTo" class="form-control input-sm" id="ledgerDateTo" maxlength="10"></input>
					 </div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-sm-4" for="ledger">Account Name (Ledger):</label>
					 <div class="col-sm-8">		
					 <input type="text" id="ledger" name="ledger" class="form-control input-sm" maxlength="50"></input>
					 </div>
				  </div>
				  <button class="btn btn-default" onClick="showLedger(1);return false;">Submit</button>
			</div>
		</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
	</div>
</div>
</div>

<div class="modal fade" id="tbModal" role="dialog">
<div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Trial Balance</h4>
        </div>
        <div class="modal-body">
			<div class="form-horizontal" role="form">
				  <div class="form-group">
                  <input type="hidden" name="barnchid2" id="barnchid2">
					<label class="control-label col-sm-4" for="daybookDate">From Date</label>
					 <div class="col-sm-8">		
					   <input type="text" name="tbDate" class="form-control input-sm" id="tbDate" maxlength="10"></input>
					 </div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-sm-4" for="daybookDateTo">To Date</label>
					 <div class="col-sm-8">		
					   <input type="text" name="tbDateTo" class="form-control input-sm" id="tbDateTo" maxlength="10"></input>
					 </div>
				  </div>
				  <button class="btn btn-default" onClick="showTrialBalance(1);return false;">Submit</button>
			</div>
		</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
	</div>
</div>
</div>

<div class="modal fade" id="bsModal" role="dialog">
<div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Balance Sheet</h4>
        </div>
        <div class="modal-body">
			<div class="form-horizontal" role="form">
				  <div class="form-group">
                  <input type="hidden" name="barnchid3" id="barnchid3">
					<label class="control-label col-sm-4" for="daybookDate">From Date</label>
					 <div class="col-sm-8">		
					   <input type="text" name="bsDate" class="form-control input-sm" id="bsDate" maxlength="10"></input>
					 </div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-sm-4" for="daybookDateTo">To Date</label>
					 <div class="col-sm-8">		
					   <input type="text" name="bsDateTo" class="form-control input-sm" id="bsDateTo" maxlength="10"></input>
					 </div>
				  </div>
				  <button class="btn btn-default" onClick="showBalanceSheet(1);return false;">Submit</button>
			</div>
		</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
	</div>
</div>
</div>

<div class="container-fluid">
	<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">			
			<a href="addAccount.php"><button type="button" class="btn btn-default btn-block" style="width: 150px;margin-bottom: 10px;float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Add Account</button></a>			
		</div>
		<div class="col-sm-12 col-md-2 col-lg-2">			
			<button type="button" class="btn btn-default btn-block" onclick="javascript:recentTransactions(1);">Recent Entries</button>					
		</div>
        <div class="col-sm-12 col-md-2 col-lg-2">			
			<!--<button type="button" class="btn btn-default btn-block" onclick="javascript:daybookModal();">Select Brench</button>-->
            <select class="form-control" onChange="selectbranch(this.value)" name="branch">
            <option value="">All Branch</option>
            
            </select>
		</div>
		<div class="col-sm-12 col-md-2 col-lg-2">			
			<button type="button" class="btn btn-default btn-block" onclick="javascript:daybookModal();">Create Journal</button>
		</div>
		<div class="col-sm-12 col-md-2 col-lg-2">			
			<button type="button" class="btn btn-default btn-block" onclick="javascript:ledgerModal();">Ledger</button>
		</div>
		<div class="col-sm-12 col-md-2 col-lg-2">			
			<button type="button" class="btn btn-default btn-block"  onclick="jaivascript:tbModal();">Trial Balance</button>
		</div>
		<div class="col-sm-12 col-md-2 col-lg-2">			
			<button type="button" class="btn btn-default btn-block" onclick="javascript:bsModal();">Balance Sheet</button>				
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		
		<input type="button" value="Print" onclick="printDiv('displayDaybookEntries')" />		
				
			<div id="displayDaybookEntries">

			</div>			
		</div>
	</div>	
</div>
<script type="text/javascript">
function printDiv(divName) {
   // var printContents = document.getElementById(divName).innerHTML;
    // var originalContents = document.body.innerHTML;
    // document.body.innerHTML = printContents;
    // window.print();
    // document.body.innerHTML = originalContents;
	
	
	
	
	//alert("Receipt is ready to print. . .");
    var html="<html>";
    html+=  document.getElementById(divName).innerHTML;
    html+="</html>";
    var printWin = window.open('','','left=0,top=0,width=1000,height=1000,toolbar=0,scrollbars=0,status =0');
    printWin.document.write(html);
    printWin.document.close();
    printWin.focus();
    printWin.print();
    printWin.close();
	//  window.print();
	
	
	
	
	
	
}
</script>
<script>
	
	function printfunction(){
		var query=$("#query").val();
var dayBookDate=$("#ledgerDate").val();
var dayBookDateTo=$("#ledgerDateTo").val();
var debit=$("#ledger").val();
		//printday.php
		//alert(query);
		window.location='printday.php?query='+query;
	}
</script>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog"> 
		  <!-- Modal content-->
		  <div class="modal-content">
		   <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Message</h4>
			</div>
			<div id="modalBody" class="modal-body">
			</div>	 
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
	</div>
</div></div></div></div></div>
c
<?php include("includes/footer.php") ?>
</div>
<script>
$(document).ready(function(){
	recentTransactions(1);
	/*$("#dbModalClose").click(){
		recentTransactions(1);
	}*/
});

// Autopopulate and Calendar controls
var availableTags= new Array();
$(function() {
$( "#dayBookDate" ).datepicker({dateFormat:"dd-mm-yy"});
$( "#ledgerDate" ).datepicker({dateFormat:"dd-mm-yy"});
$( "#ledgerDateTo" ).datepicker({dateFormat:"dd-mm-yy"});
$( "#tbDate" ).datepicker({dateFormat:"dd-mm-yy"});
$( "#tbDateTo" ).datepicker({dateFormat:"dd-mm-yy"});
$( "#bsDate" ).datepicker({dateFormat:"dd-mm-yy"});
$( "#bsDateTo" ).datepicker({dateFormat:"dd-mm-yy"});
});

// Assign handlers immediately after making the request,
// and remember the jqXHR object for this request
var jqxhr = $.ajax({
	url: "ac.php",
	method: "get",
	cache:false,
	local:true
})
.done(function(data) {  
  var accounts = $.parseXML(data);
  accounts = accounts.getElementsByTagName("accountname");  
  for (loop = 0; loop < accounts.length; loop++) { 
	availableTags.push(accounts[loop].childNodes[0].nodeValue);
  }
  $("#debit").autocomplete({
	 source: availableTags
  });
  $("#credit").autocomplete({
	 source: availableTags
  });
  $("#ledger").autocomplete({
	 source: availableTags
  });
})
.fail(function() {
	alert( "error" );
})
.always(function() {
})
</script>
</main>

        
        
        
        
        
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script>
		function selectbranch(brn)
		{
	var xhttp;
  if (brn =="") {
    document.getElementById("barnchid").value = "";
	document.getElementById("barnchid1").value = "";
  document.getElementById("barnchid2").value = "";
  document.getElementById("barnchid3").value = "";
    return;
  }
  document.getElementById("barnchid").value = brn;
  document.getElementById("barnchid1").value = brn;
  document.getElementById("barnchid2").value = brn;
  document.getElementById("barnchid3").value = brn;

		}
		</script>
		<script type="text/javascript">
function printDiv(divName) {
   // var printContents = document.getElementById(divName).innerHTML;
    // var originalContents = document.body.innerHTML;
    // document.body.innerHTML = printContents;
    // window.print();
    // document.body.innerHTML = originalContents;
	
	
	
	
	//alert("Receipt is ready to print. . .");
    var html="<html>";
    html+=  document.getElementById(divName).innerHTML;
    html+="</html>";
    var printWin = window.open('','','left=0,top=0,width=1000,height=1000,toolbar=0,scrollbars=0,status =0');
    printWin.document.write(html);
    printWin.document.close();
    printWin.focus();
    printWin.print();
    printWin.close();
	//  window.print();
	
	
	
	
	
	
}
</script>
      
        
</body>
</html>
