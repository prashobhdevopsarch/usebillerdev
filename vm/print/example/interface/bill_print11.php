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
	
	
	$totalchar = 95;

	$mode = Printer::MODE_DOUBLE_WIDTH;
	
	
	
	$printer ->selectPrintMode($mode);
	$printer -> text("KALPANA AUTOMOBILES");
	
	
	$printer -> text("\n");
	$printer ->selectPrintMode();
	
	
	$mode1 = Printer::FONT_C;
	
	
	
	$printer ->setFont($mode1);
	
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
	
	if($row["be_customerid"]!=0)
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row["be_customerid"]."'");
	$rowcus=$slctcust->fetch_assoc();

  $cuslength = strlen($rowcus["cs_customername"]);
	$totallenghthcus = 26;
    $balancelengthcus= $totallenghthcus-$cuslength;

    $printer -> text("To:".$rowcus["cs_customername"]);
    for($i=1;$i<=$balancelengthcus;$i++)
    {
      
          $printer -> text(" ");
    
    }
	$printer -> text("                           Date:".date('d-m-Y', strtotime($row["be_billdate"])));
	
 
  $printer -> text("\n");
  $printer -> text("ADDRESS:".$row5["cs_address"]);
  $printer -> text("\n");
  $printer -> text("GSTIN:".$row5["cs_tin_number"]);
  $printer -> text("\n");
 if($row4["be_statecode"]==''){$sts="32";$stcode_c='KL';}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])

		{

			case 'AN':$sts= "35";break;

			case 'AP':$sts= "28";break;

			case 'AD':$sts= "37";break;

			case 'AR':$sts= "12";break;

			case 'AS':$sts= "18";break;

			case 'BH':$sts= "10";break;

			case 'CH':$sts= "04";break;

			case 'CT':$sts= "22";break;

			case 'DN':$sts= "26";break;

			case 'DD':$sts= "25";break;

			case 'DL':$sts= "07";break;

			case 'GA':$sts= "30";break;

			case 'GJ':$sts= "24";break;

			case 'HR':$sts= "06";break;

			case 'HP':$sts= "02";break;

			case 'JK':$sts= "01";break;

			case 'JH':$sts= "20";break;

			case 'KA':$sts= "29";break;

			case 'KL':$sts= "32";break;

			case 'LD':$sts= "31";break;

			case 'MP':$sts= "23";break;

			case 'MH':$sts= "27";break;

			case 'MN':$sts= "14";break;

			case 'ME':$sts= "17";break;

			case 'MI':$sts= "15";break;

			case 'NL':$sts= "13";break;

			case 'OR':$sts= "21";break;

			case 'PY':$sts= "34";break;

			case 'PB':$sts= "03";break;

			case 'RJ':$sts= "06";break;

			case 'SK':$sts= "11";break;

			case 'TN':$sts= "33";break;

			case 'TS':$sts= "36";break;

			case 'TR':$sts= "16";break;

			case 'UP':$sts= "09";break;

			case 'UT':$sts= "05";break;

			case 'WB':$sts= "19";break;

			

		}}
  $printer -> text("State Code:".$sts); $printer -> text("\n");
  //$printer -> text($rowcus['cs_customerphone']);
   $phnelength = strlen($rowcus['cs_customerphone']);
	$totallenghthphne = 26;
    $balancelengthphne= $totallenghthphne-$phnelength;

    $printer -> text($rowcus['cs_customerphone']);
    for($i=1;$i<=$balancelengthphne;$i++)
    {
      
          $printer -> text(" ");
    
    }
	if($row4["be_md"]==1){ $bilno = 'A '.$row4["be_billnumber"]; } else { $bilno=$row4["be_billnumber"]; }
	$printer -> text("                              Invoice No:".$bilno);
	
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
	$printer -> text("                          Date:".date('d-m-Y', strtotime($row["be_billdate"])));
  $printer -> text("\n");
  $printer -> text("ADDRESS:".$row5["cs_address"]);
  $printer -> text("\n");
  $printer -> text("GSTIN:".$row5["cs_tin_number"]);
  $printer -> text("\n");
  
  if($row4["be_statecode"]==''){$sts="32";$stcode_c='KL';}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])

		{

			case 'AN':$sts= "35";break;

			case 'AP':$sts= "28";break;

			case 'AD':$sts= "37";break;

			case 'AR':$sts= "12";break;

			case 'AS':$sts= "18";break;

			case 'BH':$sts= "10";break;

			case 'CH':$sts= "04";break;

			case 'CT':$sts= "22";break;

			case 'DN':$sts= "26";break;

			case 'DD':$sts= "25";break;

			case 'DL':$sts= "07";break;

			case 'GA':$sts= "30";break;

			case 'GJ':$sts= "24";break;

			case 'HR':$sts= "06";break;

			case 'HP':$sts= "02";break;

			case 'JK':$sts= "01";break;

			case 'JH':$sts= "20";break;

			case 'KA':$sts= "29";break;

			case 'KL':$sts= "32";break;

			case 'LD':$sts= "31";break;

			case 'MP':$sts= "23";break;

			case 'MH':$sts= "27";break;

			case 'MN':$sts= "14";break;

			case 'ME':$sts= "17";break;

			case 'MI':$sts= "15";break;

			case 'NL':$sts= "13";break;

			case 'OR':$sts= "21";break;

			case 'PY':$sts= "34";break;

			case 'PB':$sts= "03";break;

			case 'RJ':$sts= "06";break;

			case 'SK':$sts= "11";break;

			case 'TN':$sts= "33";break;

			case 'TS':$sts= "36";break;

			case 'TR':$sts= "16";break;

			case 'UP':$sts= "09";break;

			case 'UT':$sts= "05";break;

			case 'WB':$sts= "19";break;

			

		}}
  $printer -> text("State Code:".$sts);
  $printer -> text("\n");
  
   $phnelength = strlen($row["be_customermobile"]);
	$totallenghthphne = 26;
    $balancelengthphne= $totallenghthphne-$phnelength;

    $printer -> text($row["be_customermobile"]);
    for($i=1;$i<=$balancelengthphne;$i++)
    {
      
          $printer -> text(" ");
    
    }
	if($row4["be_md"]==1){ $bilno = 'A '.$row4["be_billnumber"]; } else { $bilno=$row4["be_billnumber"]; }
	$printer -> text("                              Invoice No:".$bilno);
  $printer -> text("\n");
  
   }
	
  
  
  $printer -> text("\n");
                         
  
	
	

	for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
	$printer -> text("\n");
	if($sts==32)
		
	
	{$printer -> text("#  PRODUCT           HSN   RATE    QTY       NET     TAX       CGST       SGST            TOTAL");
	$printer -> text("\n");
	$printer -> text("                                            AMT     VALUE   Rate   Amt   Rate     Amt        ");
	}
	else
	{
	$printer -> text("#  PRODUCT           HSN   RATE    QTY       NET     TAX           IGST           TOTAL");
	$printer -> text("\n");
	$printer -> text("                                            AMT     VALUE      Rate     Amt        ");
		
	$printer -> text("\n");
	}
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
	$totallenghts = 3;
    $balancelengths= $totallenghts-$slnolength;




	$printer -> text($k);

	for($i=1;$i<=$balancelengths;$i++)
    {
       
          $printer -> text(" ");
    
    
    }

$tp = 17;
        $s = 0;


        while (strlen(substr($rowitm["pr_productname"], $s)) > $tp) {

            $name = substr($rowitm["pr_productname"], $s, $tp);

            $printer->text($name);


            $printer->text("\n");

            for ($i = 1; $i <= 3; $i++) {

                $printer->text(" ");
            }
            $s = $s + $tp;
        }




        if (strlen(substr($rowitm["pr_productname"], $s)) <= $tp) {
            $name2 = substr($rowitm["pr_productname"], $s);
            $productlength = strlen($name2);

            $balancelengthp = $tp - $productlength;
            $printer->text($name2);
            for ($i = 1; $i <= $balancelengthp; $i++) {

                $printer->text(" ");
            }
        }
	$tp = 8;
        $s = 0;


        while (strlen(substr($rowitm["pr_hsn"], $s)) > $tp) {

            $name = substr($rowitm["pr_hsn"], $s, $tp);

            $printer->text($name);


            $printer->text("\n");

            for ($i = 1; $i <= 20; $i++) {

                $printer->text(" ");
            }
            $s = $s + $tp;
        }




        if (strlen(substr($rowitm["pr_hsn"], $s)) <= $tp) {
            $name2 = substr($rowitm["pr_hsn"], $s);
            $productlength = strlen($name2);

            $balancelengthp = $tp - $productlength;
            $printer->text($name2);
            for ($i = 1; $i <= $balancelengthp; $i++) {

                $printer->text(" ");
            }
        }
    $pricelength = strlen(number_format($rowitm["bi_price"],2,".",""));
	$totallenghtpr = 8;
    $balancelengthpr= $totallenghtpr-$pricelength;


    

for($i=1;$i<=$balancelengthpr;$i++)
    {
       
          $printer -> text(" ");
    
    }
	$printer -> text(number_format($rowitm["bi_price"],2,".",""));
	
	$quantitylength = strlen($rowitm["bi_quantity"]);
	$totallenghtq = 5;
    $balancelengthq= $totallenghtq-$quantitylength;


    

for($i=1;$i<=$balancelengthq;$i++)
    {
       
          $printer -> text(" ");
    
    }
    $printer -> text($rowitm["bi_quantity"]);
	
	
	$net=$rowitm["bi_quantity"]*$rowitm["bi_price"];


    $netlength = strlen(number_format($net,2,".",""));
	$totallenghtn = 9;
    $balancelengthn= $totallenghtn-$netlength;

for($i=1;$i<=$balancelengthn;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text(number_format($net,2,".",""));
	
	
	$taxamnt=number_format($rowitm["bi_taxamount"],2,".","");


    $taxamntlength = strlen($taxamnt);
	$totallenghttx = 10;
    $balancelengthtx= $totallenghttx-$taxamntlength;

for($i=1;$i<=$balancelengthtx;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
    $printer -> text($taxamnt);
	
	$printer -> text(" ");
	$cgst=$rowitm["bi_cgst"];


    $cgstlength = strlen($cgst);
	$totallenghtcg = 3;
    $balancelengthcg= $totallenghtcg-$cgstlength;

for($i=1;$i<=$balancelengthcg;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
	if($sts==32)
	{
    $printer -> text($cgst);
	}
	else
	{
		$printer -> text(" ");
	}
	
	$cgstamnt=number_format($rowitm["bi_cgst_amt"],2,".","");


    $cgstamntlength = strlen($cgstamnt);
	$totallenghtcga = 9;
    $balancelengthcga= $totallenghtcga-$cgstamntlength;

for($i=1;$i<=$balancelengthcga;$i++)
    {
       
          $printer -> text(" ");
          
    }
	//
	if($sts==32)
	{
    $printer -> text($cgstamnt);
	}
	else
	{
		
	$printer -> text(" ");
	}
	
	$sgst=$rowitm["bi_sgst"];


    $sgstlength = strlen($sgst);
	$totallenghtsg = 3;
    $balancelengthsg= $totallenghtsg-$sgstlength;

for($i=1;$i<=$balancelengthsg;$i++)
    {
       
          $printer -> text(" ");
          
    }
	if($sts==32)
	{
    $printer -> text($sgst);
	}
	
	$sgstamnt=number_format($rowitm["bi_sgst_amt"],2,".","");


    $sgstamntlength = strlen($sgstamnt);
	$totallenghtsga = 9;
    $balancelengthsga= $totallenghtcga-$sgstamntlength;

for($i=1;$i<=$balancelengthsga;$i++)
    {
       
          $printer -> text(" ");
          
    }
	
	if($sts==32)
	{
		
    $printer -> text($sgstamnt);
	}
	
		
	//igst
	
	
	$igst=$rowitm["bi_igst"];


    $igstlength = strlen($igst);
	$totallenghtig = 3;
    $balancelengthig= $totallenghtig-$igstlength;

for($i=1;$i<=$balancelengthig;$i++)
   {
       
        $printer -> text(" ");
          
    }
	if($sts!=32)
	{
	
    $printer -> text($igst);
	
	}
	
		
	$igstamnt=number_format($rowitm["bi_igst_amt"],2,".","");


   $igstamntlength = strlen($igstamnt);
   $totallenghtiga = 9;
   $balancelengthiga= $totallenghtcga-$sgstamntlength;

for($i=1;$i<=$balancelengthiga;$i++)
    {
       
          $printer -> text(" ");
          
    }
	if($sts!=32)
	{
	
    $printer -> text($igstamnt);
	
	}
	
	
	
	$totlength = strlen(number_format($rowitm["bi_total"],2,".",""));
	$totallenghttot = 10;
    $balancelengthtot= $totallenghttot-$totlength;


    

for($i=1;$i<=$balancelengthtot;$i++)
    {
       
          $printer -> text(" ");
    
    }
	$printer -> text(number_format($rowitm["bi_total"],2,".",""));


	$printer -> text("\n");


$k++;


}

	
$printer -> text("\n");
for($i=0;$i<=$totalchar;$i++)
    {
       
          $printer -> text("-");
    
    
    }
$total=$row4["be_gtotal"];
$gst=$gst+($rowitm["bi_cgst_amt"]);
//$printer -> text(" CGST:");	 $printer -> text("   SGST:".$gst);
$printer -> text("\n");

$printer ->selectPrintMode($mode);

$printer -> text("     Grand Total :".round($row4["be_gtotal"]));


$printer ->selectPrintMode();


	
	
	
	$printer ->setFont($mode1);
	
$printer -> text("\n");
$amd=convert_number_to_words($row4["be_gtotal"]);
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
$printer -> text("\n");
	
	
    /* Close printer */
    $printer -> close();
	
	
	
	
	if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
	header("Location: ../../../bill_print.php?billid=".$_GET["billid"]);
	}
	
	
} catch (Exception $e) {
    if($_GET["back"]=="billinghistory"){
	
	header("Location: ../../../billinghistory.php");
	}
	else{
	header("Location: ../../../dashboard.php");
	}
}