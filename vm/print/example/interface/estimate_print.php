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
    $connector = new WindowsPrintConnector("myprinter1");
    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
	session_start();
    include("../../../includes/config.php");
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");
	$row=$slct->fetch_assoc();
	$billitems=$conn->query("SELECT * FROM us_billitems WHERE bi_billid='$billid'");
	$row8= $billitems->fetch_assoc();
	$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
    $row3 = $profl->fetch_assoc();
    $bill = $conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");
    $row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();
	
	 
	//$printer -> setFont(Printer:::FONT_A);
	
	
	$totalchar = 78;
	
	//$printer -> text("\n");
	
	//$printer -> text("                                   ESTIMATE                    ");
	
  $printer -> text("                                   ESTIMATE                    ");
	
	
	$printer -> text("\n");
	
	//$printer -> text($row3['sp_shopaddress']);
	
	//$printer -> text("\n");
	
	//$printer -> text($row3['sp_phone']);
	
	//$printer -> text("\n");
	
	
	
	//$printer -> text("\n");
	
	
	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
	
$printer -> text("\n");
	
	if($row["be_customerid"]!=0)
{
	$slctcust=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row["be_customerid"]."'");
	$rowcus=$slctcust->fetch_assoc();

  $cuslength = strlen($rowcus["cs_customername"]);
	$totallenghthcus = 50;
    $balancelengthcus= $totallenghthcus-$cuslength;

    $printer -> text("To:".$rowcus["cs_customername"]);
    for($i=1;$i<=$balancelengthcus;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("Date:".date('d-m-Y', strtotime($row["be_billdate"])));
	
 
  $printer -> text("\n");
  $printer -> text($rowcus['cs_customerphone']);
   $phnelength = strlen($rowcus['cs_customerphone']);
	$totallenghthphne = 50;
    $balancelengthphne= $totallenghthphne-$phnelength;

    $printer -> text($rowcus['cs_customerphone']);
    for($i=1;$i<=$balancelengthphne;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("            No:".$row4["be_billnumber"]);
	
  $printer -> text("\n");
   }else{
  
  
   $cuslength = strlen($row["be_customername"]);
	$totallenghthcus = 26;
    $balancelengthcus= $totallenghthcus-$cuslength;

    $printer -> text("To:".$row["be_customername"]);
    for($i=1;$i<=$balancelengthcus;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("Date:".date('d-m-Y', strtotime($row["be_billdate"])));
  $printer -> text("\n");
  
  
   $phnelength = strlen($row["be_customermobile"]);
	$totallenghthphne = 26;
    $balancelengthphne= $totallenghthphne-$phnelength;

    $printer -> text($row["be_customermobile"]);
    for($i=1;$i<=$balancelengthphne;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("           No:".$row4["be_billnumber"]);
  $printer -> text("\n");
  
   }
	
  
  
  $printer -> text("\n");
                         
  
	
	

	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
	$printer -> text("\n");
	
	
	$printer -> text("#  PRODUCT                                      QTY      RATE   UNIT      TOTAL");
	$printer -> text("\n");
   for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
    $printer -> text("\n");
	
	
  
$k=1;
  $slctitm=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
  
  $discamt=0;
$gtot=0;
while($rowitm=$slctitm->fetch_assoc())
{

    $slnolength = strlen($k);
	$totallenghts = 3;
    $balancelengths= $totallenghts-$slnolength;




	$printer -> text($k);

	for($i=1;$i<=$balancelengths;$i++)
    {
       
          $printer -> text(" ");
    
    
    }


	$productlength = strlen($rowitm["pr_productname"]);
	$totallenghtp = 42;
    $balancelengthp= $totallenghtp-$productlength;

    $printer -> text($rowitm["pr_productname"]);
    for($i=1;$i<=$balancelengthp;$i++)
    {
      
          $printer -> text(" ");
    
    }
	
	
	$quantitylength = strlen($rowitm["bi_quantity"]);
	$totallenghtq = 5;
    $balancelengthq= $totallenghtq-$quantitylength;


    

for($i=1;$i<=$balancelengthq;$i++)
    {
       
          $printer -> text(" ");
    
    }
    $printer -> text($rowitm["bi_quantity"]);



    

    $pricelength = strlen(number_format($rowitm["bi_price"],2,".",""));
	$totallenghtpr = 10;
    $balancelengthpr= $totallenghtpr-$pricelength;


    

for($i=1;$i<=$balancelengthpr;$i++)
    {
       
          $printer -> text(" ");
    
    }
	$printer -> text(number_format($rowitm["bi_price"],2,".",""));


$tax=$rowitm["pr_unit"];
	
	$gstlength = strlen($tax);
	$totallenghtgst = 7;
    $balancelengthgst= $totallenghtgst-$gstlength;

    
    for($i=1;$i<=$balancelengthgst;$i++)
    {
       
          $printer -> text(" ");
    
    }
	
	$printer -> text($tax);

	
	

$btot=$rowitm["bi_quantity"]*$rowitm["bi_price"];


    $totallength = strlen(number_format($btot,2,".",""));
	$totallenghtt = 11;
    $balancelengtht= $totallenghtt-$totallength;

for($i=1;$i<=$balancelengtht;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text(number_format($btot,2,".",""));






	$printer -> text("\n");


$gtot=$gtot+$btot;
$pr=$pr+$rowitm["bi_price"];
$qt=$qt+$rowitm["bi_quantity"];
$tot=$tot+$btot;

$k++;}
/*for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }*/
	$printer -> text("\n");
	
	/*$printer -> text("   Sub Total                                           ");
	
	
	$quanlength = strlen(number_format($qt,2));
	$totallenghthquan = 6;
    $balancelengthquan= $totallenghthquan-$quanlength;

for($i=1;$i<=$balancelengthquan;$i++)
    {
       
          $printer -> text(" ");
          
    }

    $printer -> text(number_format($qt,2));
	$printer -> text(number_format($tot,2));
	
	$totlength = strlen(number_format($tot,2));
	$totallenghthtot = 9;
    $balancelengthtot= $totallenghthtot-$totlength;

for($i=1;$i<=$balancelengthtot;$i++)
    {
       
          $printer -> text(" ");
          
    }

   
	
	
	$printer -> text("\n");*/
	
	
	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
$total=$gtot-$discamt;	
$gst=(($total*$tax)/100)/2;

$printer -> text("\n");
//$printer -> text("CGST:".$gst);	
	
//$printer -> text("             Total Amount :");
 
 $netlength = strlen(number_format($gtot,2));
	$totallenghthnet = 8;
    $balancelengthnet= $totallenghthnet-$netlength;

for($i=1;$i<=$balancelengthnet;$i++)
    {
       
          $printer -> text(" ");
          
    }

    //$printer -> text(number_format($gtot,2));
	
	
	
$printer -> text("\n");
 //$printer -> text("SGST:".$gst);
//$printer -> text("             Discount   :");

$disclength = strlen(number_format($discamt,2));
	$totallenghthdisc = 8;
    $balancelengthdisc= $totallenghthdisc-$disclength;

	$totall=$row4["be_gtotal"]+$row4["be_oldbal"];
	
$printer -> text("Old Balance: ".$row4["be_oldbal"]);
$printer -> text("\n");
$printer -> text("Paid  Amount: ".$row4["be_paidamount"]);
$printer -> text("\n");
//$printer -> text("Balance Amount: ".$row4["be_balance"]);

for($i=1;$i<=$balancelengthdisc;$i++)
    {
       
          $printer -> text(" ");
          
    }

    //$printer -> text(number_format($row["be_discount"],2));
	


$mode = Printer::MODE_DOUBLE_WIDTH;
$printer ->selectPrintMode($mode);
$printer -> text("                  Grand Total :".round($totall,2));


$printer ->selectPrintMode();
$printer -> text("\n");
$amd=convert_number_to_words(round($totall));
$printer -> text("Grand Total In Words :");
$printer -> text("\n");
$printer -> text($amd);
$printer -> text("\n");
for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }

$printer -> text("\n");
$printer -> text("                          THANK YOU... VISIT AGAIN... ");
$printer -> text("\n");
for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }


$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");
$printer -> text("\n");

	//$mode = Printer::MODE_DOUBLE_WIDTH;
	
	
	
	//$printer ->selectPrintMode($mode);
	
 
	
    
    




    
    
    /* Close printer */
    $printer -> close();
	
	
	
	
	if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
		
		$bill_id=$_GET['billid'];
		$back=$_GET['back'];
	  $customer=$row4["be_customerid"];
	header("Location: ../../../bill_print_cus1.php?back=$back&billid=$bill_id&csid=".$customer);
	}
	
	
} catch (Exception $e) {
    if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
	header("Location: ../../../dashboard.php");
	}
}