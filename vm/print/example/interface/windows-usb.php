<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/../../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    //$connector = null;
    $connector = new WindowsPrintConnector("myprinter");
    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
	session_start();
    include("../../../includes/config.php");
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
	$row=$slct->fetch_assoc();
	$billitems=$conn->query("SELECT * FROM vm_billitems WHERE bi_billid='$billid'");
	$row8= $billitems->fetch_assoc();
	$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
    $row3 = $profl->fetch_assoc();
    $bill = $conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
    $row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();
	
	 
	//$printer -> setFont(Printer:::FONT_A);
	
	
	$totalchar = 66;
	
	
	
	if($row["be_customername"]!=0)
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$_GET['csid']."'");
	$rowcus=$slctcust->fetch_assoc();

  
  $printer -> text("To:".$rowcus["cs_customername"]);
  $printer -> text("\n");
  $printer -> text($rowcus['cs_customerphone']);
  $printer -> text("\n");
   }else{
  
  $printer -> text("To:".$row["be_customername"]);
  $printer -> text("\n");
  $printer -> text($row["be_customermobile"]);
  $printer -> text("\n");
  
   }
	
  $printer -> text("\n");
  $printer -> text("Date:".date('d-m-Y', strtotime($row["be_billdate"])));
  $printer -> text("\n");
  $printer -> text("Invoice No:".$row4["be_billnumber"]);
  $printer -> text("\n");
	
	

	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
	$printer -> text("\n");
	
	
	$printer -> text("Sl No. Product          HSN        GST%  RATE    QTY  TOTAL    DISC ");
	$printer -> text("\n");
   for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
    $printer -> text("\n");
	
	
  
$k=1;
  $slctitm=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
  
  $discamt=0;
$gtot=0;
while($rowitm=$slctitm->fetch_assoc())
{

    $slnolength = strlen($k);
	$totallenghts = 7;
    $balancelengths= $totallenghts-$slnolength;




	$printer -> text($k);

	for($i=0;$i<=$balancelengths;$i++)
    {
       
          $printer -> text(" ");
    
    
    }


	$productlength = strlen($rowitm["pr_productname"]);
	$totallenghtp = 17;
    $balancelengthp= $totallenghtp-$productlength;

    $printer -> text($rowitm["pr_productname"]);
    for($i=0;$i<=$balancelengthp;$i++)
    {
       
          $printer -> text(" ");
    
    }
	
	$hsnlength = strlen($rowitm["pr_hsn"]);
	$totallenghthsn = 11;
    $balancelengthhsn= $totallenghthsn-$hsnlength;

    $printer -> text($rowitm["pr_hsn"]);
    for($i=0;$i<=$balancelengthhsn;$i++)
    {
       
          $printer -> text(" ");
    
    }
	
	$tax=$rowitm["bi_cgst"]+$rowitm["bi_sgst"];
	
	$gstlength = strlen($tax);
	$totallenghtgst = 6;
    $balancelengthgst= $totallenghtgst-$gstlength;

    $printer -> text($tax);
    for($i=0;$i<=$totallenghtgst;$i++)
    {
       
          $printer -> text(" ");
    
    }
	
	

    

    $pricelength = strlen($rowitm["bi_price"]);
	$totallenghtpr = 8;
    $balancelengthpr= $totallenghtpr-$pricelength;


    $printer -> text($rowitm["bi_price"]);

for($i=0;$i<=$balancelengthpr;$i++)
    {
       
          $printer -> text(" ");
    
    }
	
	
	$quantitylength = strlen($rowitm["bi_quantity"]);
	$totallenghtq = 5;
    $balancelengthq= $totallenghtq-$quantitylength;


    $printer -> text($rowitm["bi_quantity"]);

for($i=0;$i<=$balancelengthq;$i++)
    {
       
          $printer -> text(" ");
    
    }


$btot=$rowitm["bi_quantity"]*$rowitm["bi_price"];


    $totallength = strlen($btot);
	$totallenghtt = 9;
    $balancelengtht= $totallenghtt-$totallength;


    $printer -> text($btot);

for($i=0;$i<=$balancelengtht;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
	
	$disco=$btot*($rowitm["bi_discount"]/100);


    $discolength = strlen($disco);
	$totallenghtd = 5;
    $balancelengthd= $totallenghtd-$discolength;


    $printer -> text($disco);

for($i=0;$i<=$balancelengtht;$i++)
    {
       
          $printer -> text(" ");
          
    }


	$printer -> text("\n");

$discamt=$discamt+$disco;
$gtot=$gtot+$btot;

$k++;}
for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
$total=$gtot-$discamt;	
$gst=(($total*$tax)/100)/2;

$printer -> text("\n");
$printer -> text("CGST:".$gst."SGST:".$gst);

$printer -> text("\n");
$printer -> text("Grand Total:".$gtot);
	
$printer -> text("\n");
$printer -> text("Discount :".$discamt);
	
$printer -> text("\n");



$printer -> text("Net Amount :".$total);
$printer -> text("\n");

$amd=convert_number_to_words($total);
$printer -> text("Grand Total In Words :".$amd);

for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }


$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");


$printer -> text("TAX INVOICE");
$printer -> text("\n");
	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
    $printer -> text("\n");
	
	
	$printer -> text($row3['sp_shopname']);
	$printer -> text("\n");
	$printer -> text($row3['sp_shopaddress']);
	
	$printer -> text("\n");
	
	$printer -> text($row3['sp_phone']);
	
	$printer -> text("\n");
	
	$printer -> text("GST IN:".$row3['sp_tin']);
	
	$printer -> text("\n");
	
	
	
	
	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
 
	
    
    




    
    
    /* Close printer */
    $printer -> close();
	
	
	
	
	if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
	header("Location: ../../../dashboard.php");
	}
} catch (Exception $e) {
    if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
	header("Location: ../../../dashboard.php");
	}
}