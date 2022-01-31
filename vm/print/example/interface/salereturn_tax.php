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
	$slct=$conn->query("SELECT * FROM vm_salreturnentry WHERE sre_billid='$billid'");
	$row=$slct->fetch_assoc();
	$billitems=$conn->query("SELECT * FROM vm_salreturnitem WHERE sri_billid='$billid'");
	$row8= $billitems->fetch_assoc();
	$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
    $row3 = $profl->fetch_assoc();
    $bill = $conn->query("SELECT * FROM vm_salreturnentry WHERE sre_billid='$billid'");
    $row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row4["sre_supplierid"]."'");
		$row5=$cust->fetch_assoc();
	
	 
	//$printer -> setFont(Printer:::FONT_A);
	
	
	$totalchar = 78;
	$mode = Printer::MODE_DOUBLE_WIDTH;
	
	
	
	$printer ->selectPrintMode($mode);
	$printer -> text("FAJAR TRADING");
	
	
	$printer -> text("\n");
	$printer ->selectPrintMode();
	
	$printer -> text("".$row3['sp_shopaddress']);
	$printer -> text("\n");
	
	
	
       
	$printer -> text("".$row3['sp_phone']);
	
	
	$printer -> text("\n");
	
	$printer -> text("GSTIN:".$row3['sp_tin']);
	
	$printer -> text("\n");
	
	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
$printer -> text("\n");
	
	$printer -> text("                                 TAX INVOICE                   ");
	
	
$printer -> text("\n");


	
	$printer -> text("                                 SALE RETURN                   ");
	
	
$printer -> text("\n");
	
	if($row["sre_supplierid"]!=0)
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row["sre_supplierid"]."'");
	$rowcus=$slctcust->fetch_assoc();

  $cuslength = strlen($rowcus["cs_customername"]);
	$totallenghthcus = 26;
    $balancelengthcus= $totallenghthcus-$cuslength;

    $printer -> text("To:".$rowcus["cs_customername"]);
    for($i=1;$i<=$balancelengthcus;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("                           Date:".date('d-m-Y', strtotime($row["sre_billdate"])));
	
 
  $printer -> text("\n");
  $printer -> text($rowcus['cs_customerphone']);
   $phnelength = strlen($rowcus['cs_customerphone']);
	$totallenghthphne = 26;
    $balancelengthphne= $totallenghthphne-$phnelength;

    $printer -> text($rowcus['cs_customerphone']);
    for($i=1;$i<=$balancelengthphne;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("                          Invoice No:".$row4["sre_billnumber"]);
	
  $printer -> text("\n");
   }else{
  
  
   $cuslength = strlen($row["sre_customername"]);
	$totallenghthcus = 26;
    $balancelengthcus= $totallenghthcus-$cuslength;

    $printer -> text("To:".$row["sre_customername"]);
    for($i=1;$i<=$balancelengthcus;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("                          Date:".date('d-m-Y', strtotime($row["sre_billdate"])));
  $printer -> text("\n");
  
  
   $phnelength = strlen($row["sre_customermobile"]);
	$totallenghthphne = 26;
    $balancelengthphne= $totallenghthphne-$phnelength;

    $printer -> text($row["sre_customermobile"]);
    for($i=1;$i<=$balancelengthphne;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("                             Invoice No:".$row4["sre_billnumber"]);
  $printer -> text("\n");
  
   }
	
  
  
  $printer -> text("\n");
                         
  
	
	

	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
	$printer -> text("\n");
	
	
	$printer -> text("#  PRODUCT              HSN   RATE QTY   NET     TAX     CGST     SGST     TOTAL");
	$printer -> text("\n");
	$printer -> text("                                         AMT    VALUE Rate Amt  Rate Amt        ");
	$printer -> text("\n");
   for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
    $printer -> text("\n");
	
	
  
$k=1;
  $slctitm=$conn->query("SELECT * FROM vm_salreturnitem a LEFT JOIN vm_products b ON b.pr_productid=a.sri_productid WHERE a.sri_billid='$billid'");
  
  $discamt=0;
$gtot=0;
while($rowitm=$slctitm->fetch_assoc())
{
	
if(strlen($rowitm["pr_productname"])>19)
{
    $slnolength = strlen($k);
	$totallenghts = 3;
    $balancelengths= $totallenghts-$slnolength;




	$printer -> text($k);

	for($i=1;$i<=$balancelengths;$i++)
    {
       
          $printer -> text(" ");
    
    
    }


	
	$name = substr($rowitm["pr_productname"],0,19);

    $printer -> text($name);
	
	
	$printer -> text("\n");
    
	for($i=1;$i<=3;$i++)
    {
       
          $printer -> text(" ");
    
    
    }
	$name2 = substr($rowitm["pr_productname"],19);
	
	$productlength = strlen(substr($rowitm["pr_productname"],19));
	$totallenghtp = 19;
    $balancelengthp= $totallenghtp-$productlength;
	
	$printer -> text($name2);
	for($i=1;$i<=$balancelengthp;$i++)
    {
       
          $printer -> text(" ");
    
    
    }
	
	$hsnlength = strlen($rowitm["pr_hsn"]);
	$totallenghthsn = 5;
    $balancelengthhsn= $totallenghthsn-$hsnlength;

    
    for($i=1;$i<=$balancelengthhsn;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text($rowitm["pr_hsn"]);
    
//number_format($rowitm["sri_price"],2,".","");


    $pricelength = strlen(number_format($rowitm["sri_price"],2,".",""));
	$totallenghtpr = 7;
    $balancelengthpr= $totallenghtpr-$pricelength;


    

for($i=1;$i<=$balancelengthpr;$i++)
    {
       
          $printer -> text(" ");
    
    }
	$printer -> text(number_format($rowitm["sri_price"],2,".",""));
	
	$quantitylength = strlen($rowitm["sri_quantity"]);
	$totallenghtq = 4;
    $balancelengthq= $totallenghtq-$quantitylength;


    

for($i=1;$i<=$balancelengthq;$i++)
    {
       
          $printer -> text(" ");
    
    }
    $printer -> text($rowitm["sri_quantity"]);
	
	
	
	$net=$rowitm["sri_quantity"]*$rowitm["sri_price"];


    $netlength = strlen(number_format($net,2,".",""));
	$totallenghtn = 8;
    $balancelengthn= $totallenghtn-$netlength;

for($i=1;$i<=$balancelengthn;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text(number_format($net,2,".",""));
	
	
	$taxamnt=number_format($rowitm["sri_netamnt"],2,".","");


    $taxamntlength = strlen($taxamnt);
	$totallenghttx = 8;
    $balancelengthtx= $totallenghttx-$taxamntlength;

for($i=1;$i<=$balancelengthtx;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($taxamnt);
	
	
	$cgst=$rowitm["sri_cgst"];


    $cgstlength = strlen($cgst);
	$totallenghtcg = 2;
    $balancelengthcg= $totallenghtcg-$cgstlength;

for($i=1;$i<=$balancelengthcg;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($cgst);
	
	
	$cgstamnt=number_format($rowitm["sri_cgstamt"],2,".","");


    $cgstamntlength = strlen($cgstamnt);
	$totallenghtcga = 7;
    $balancelengthcga= $totallenghtcga-$cgstamntlength;

for($i=1;$i<=$balancelengthcga;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($cgstamnt);
	
	
	$sgst=$rowitm["sri_sgst"];


    $sgstlength = strlen($sgst);
	$totallenghtsg = 2;
    $balancelengthsg= $totallenghtsg-$sgstlength;

for($i=1;$i<=$balancelengthsg;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($sgst);
	
	
	$sgstamnt=number_format($rowitm["sri_sgstamt"],2,".","");


    $sgstamntlength = strlen($sgstamnt);
	$totallenghtsga = 7;
    $balancelengthsga= $totallenghtcga-$sgstamntlength;

for($i=1;$i<=$balancelengthsga;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($sgstamnt);
	
	
	$totlength = strlen(number_format($rowitm["sri_total"],2,".",""));
	$totallenghttot = 8;
    $balancelengthtot= $totallenghttot-$totlength;


    

for($i=1;$i<=$balancelengthtot;$i++)
    {
       
          $printer -> text(" ");
    
    }
	$printer -> text(number_format($rowitm["sri_total"],2,".",""));


	$printer -> text("\n");


$k++;
}
else 
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
	$totallenghtp = 19;
    $balancelengthp= $totallenghtp-$productlength;

    $printer -> text($rowitm["pr_productname"]);
    for($i=1;$i<=$balancelengthp;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$hsnlength = strlen($rowitm["pr_hsn"]);
	$totallenghthsn = 5;
    $balancelengthhsn= $totallenghthsn-$hsnlength;

    
    for($i=1;$i<=$balancelengthhsn;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text($rowitm["pr_hsn"]);
    
//number_format($rowitm["sri_price"],2,".","");


    $pricelength = strlen(number_format($rowitm["sri_price"],2,".",""));
	$totallenghtpr = 7;
    $balancelengthpr= $totallenghtpr-$pricelength;


    

for($i=1;$i<=$balancelengthpr;$i++)
    {
       
          $printer -> text(" ");
    
    }
	$printer -> text(number_format($rowitm["sri_price"],2,".",""));
	
	$quantitylength = strlen($rowitm["sri_quantity"]);
	$totallenghtq = 4;
    $balancelengthq= $totallenghtq-$quantitylength;


    

for($i=1;$i<=$balancelengthq;$i++)
    {
       
          $printer -> text(" ");
    
    }
    $printer -> text($rowitm["sri_quantity"]);
	
	
	
	$net=$rowitm["sri_quantity"]*$rowitm["sri_price"];


    $netlength = strlen(number_format($net,2,".",""));
	$totallenghtn = 8;
    $balancelengthn= $totallenghtn-$netlength;

for($i=1;$i<=$balancelengthn;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text(number_format($net,2,".",""));
	
	
	$taxamnt=number_format($rowitm["sri_netamnt"],2,".","");


    $taxamntlength = strlen($taxamnt);
	$totallenghttx = 8;
    $balancelengthtx= $totallenghttx-$taxamntlength;

for($i=1;$i<=$balancelengthtx;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($taxamnt);
	
	
	$cgst=$rowitm["sri_cgst"];


    $cgstlength = strlen($cgst);
	$totallenghtcg = 2;
    $balancelengthcg= $totallenghtcg-$cgstlength;

for($i=1;$i<=$balancelengthcg;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($cgst);
	
	
	$cgstamnt=number_format($rowitm["sri_cgstamt"],2,".","");


    $cgstamntlength = strlen($cgstamnt);
	$totallenghtcga = 7;
    $balancelengthcga= $totallenghtcga-$cgstamntlength;

for($i=1;$i<=$balancelengthcga;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($cgstamnt);
	
	
	$sgst=$rowitm["sri_sgst"];


    $sgstlength = strlen($sgst);
	$totallenghtsg = 2;
    $balancelengthsg= $totallenghtsg-$sgstlength;

for($i=1;$i<=$balancelengthsg;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($sgst);
	
	
	$sgstamnt=number_format($rowitm["sri_sgstamt"],2,".","");


    $sgstamntlength = strlen($sgstamnt);
	$totallenghtsga = 7;
    $balancelengthsga= $totallenghtcga-$sgstamntlength;

for($i=1;$i<=$balancelengthsga;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($sgstamnt);
	
	
	$totlength = strlen(number_format($rowitm["sri_total"],2,".",""));
	$totallenghttot = 8;
    $balancelengthtot= $totallenghttot-$totlength;


    

for($i=1;$i<=$balancelengthtot;$i++)
    {
       
          $printer -> text(" ");
    
    }
	$printer -> text(number_format($rowitm["sri_total"],2,".",""));


	$printer -> text("\n");

$k++;	
	
	
}

}

	
$printer -> text("\n");
for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
$total=$row4["sre_gtotal"];
//$gst=$gst+($rowitm["sri_cgstamt"]);
//$printer -> text(" CGST:");	 $printer -> text("   SGST:".$gst);
$printer -> text("\n");
$mode = Printer::MODE_DOUBLE_WIDTH;
$printer ->selectPrintMode($mode);

$printer -> text("     Grand Total :".round($row4["sre_gtotal"]));


$printer ->selectPrintMode();
$printer -> text("\n");
$amd=convert_number_to_words($row4["sre_gtotal"]);
$printer -> text("Grand Total In Words :");
$printer -> text(" ");
$printer -> text($amd);
$printer -> text("\n");
for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }

$printer -> text("\n");
$printer -> text("                          Declaration ");
$printer -> text("\n");
$printer -> text("Certified that all the particulars shown in the above tax invoice are true and   correct.");
$printer -> text("\n");
$printer -> text("                                                            Authorised Signatory");
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
	
 
	
    
    




    
    
    /* Close printer */
    $printer -> close();
	
	
	if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
	header("Location: ../../../salesreturn_print.php?billid=".$_GET["billid"]);
	}
	

} catch (Exception $e) {
    if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
	header("Location: ../../../dashboard.php");
	}
}