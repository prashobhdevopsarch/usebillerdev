<?php
function minusbalance($conn,$paid,$usid,$cusid)
{
	$slct=$conn->query("SELECT * FROM us_billentry WHERE be_balance>0 AND be_customerid='$cusid' AND user_id='$usid' ORDER BY be_billid ASC LIMIT 1");
	$row=$slct->fetch_assoc();
	$balance=$row["be_balance"];
	$id=$row["be_billid"];
	switch($balance)
	{
		case($balance==$paid):	$update=$conn->query("UPDATE us_billentry SET be_balance='0' WHERE be_billid='$id'");
							if($update){$suc='success';}else{$suc="failed";}echo "1";
							break;
		case($balance>$paid):	$balance=$balance-$paid;
							$update=$conn->query("UPDATE us_billentry SET be_balance='$balance' WHERE be_billid='$id'");
							if($update){$suc='success';}else{$suc="failed";}echo "2";
							break;
		case($balance<$paid):	$paid=$paid-$balance;
							$update=$conn->query("UPDATE us_billentry SET be_balance='0' WHERE be_billid='$id'");
							if($update){$suc=minusbalance($conn,$paid,$usid,$cusid);}else{$suc="failed";}echo "2";
							break;	
	}
	
	

	return $suc;
	
}
function minusbalancepur($conn,$paid,$usid,$cusid)
{
	$slct=$conn->query("SELECT * FROM us_purentry WHERE pe_balance>0 AND pe_supplierid='$cusid' AND user_id='$usid' ORDER BY pe_billid ASC LIMIT 1");
	$row=$slct->fetch_assoc();
	$balance=$row["pe_balance"];
	$id=$row["pe_billid"];
	switch($balance)
	{
		case($balance==$paid):	$update=$conn->query("UPDATE us_purentry SET pe_balance='0' WHERE pe_billid='$id'");
							if($update){$suc='success';}else{$suc="failed";}echo "1";
							break;
		case($balance>$paid):	$balance=$balance-$paid;
							$update=$conn->query("UPDATE us_purentry SET pe_balance='$balance' WHERE pe_billid='$id'");
							if($update){$suc='success';}else{$suc="failed";}echo "2";
							break;
		case($balance<$paid):	$paid=$paid-$balance;
							$update=$conn->query("UPDATE us_purentry SET pe_balance='0' WHERE pe_billid='$id'");
							if($update){$suc=minusbalance($conn,$paid,$usid,$cusid);}else{$suc="failed";}echo "2";
							break;	
	}
	
	

	return $suc;
	
}
function updatestock($conn,$billid,$csid,$usrid)
{
	$succ='succ';
	$slct=$conn->query("SELECT * FROM us_billitems WHERE bi_billid='$billid' AND bi_isactive='0' AND user_id='$usrid'");
	while($row=$slct->fetch_assoc())
	{
		$itmid=$row["bi_productid"];
		$qty=$row["bi_quantity"];
		$billitmid=$row["bi_billitemid"];
		$slctprdct=$conn->query("SELECT * FROM us_products WHERE pr_productid='$itmid' AND pr_isactive='0' AND user_id='$usrid'");
		$rowprdct=$slctprdct->fetch_assoc();
		$stock=$rowprdct["pr_stock"]+$qty;
		$update=$conn->query("UPDATE us_products SET pr_stock='$stock' WHERE pr_productid='$itmid'");
		$update1=$conn->query("UPDATE us_billitems SET bi_isactive='1' WHERE bi_billitemid='$billitmid'");
		if(!$update)
		{
			$succ="fail";	
			return $succ;
		}
		
	}
	return $succ;
}
function updatestockp($conn,$billid,$csid,$usrid)
{
	$succ='succ';
	$slct=$conn->query("SELECT * FROM us_puritems WHERE pi_billid='$billid' AND pi_isactive='0' AND user_id='$usrid'");
	while($row=$slct->fetch_assoc())
	{
		$itmid=$row["pi_productid"];
		$qty=$row["pi_quantity"];
		$billitmid=$row["pi_billitemid"];
		$slctprdct=$conn->query("SELECT * FROM us_products WHERE pr_productid='$itmid' AND pr_isactive='0' AND user_id='$usrid'");
		$rowprdct=$slctprdct->fetch_assoc();
		$stock=$rowprdct["pr_stock"]-$qty;
		$update=$conn->query("UPDATE us_products SET pr_stock='$stock' WHERE pr_productid='$itmid'");
		$update1=$conn->query("UPDATE us_puritems SET pi_isactive='1' WHERE pi_billitemid='$billitmid'");
		if(!$update)
		{
			$succ="fail";	
			return $succ;
		}
		
	}return $succ;
}
function updatestock_r($conn,$billid,$csid,$usrid)
{
	$succ='succ';
	$slct=$conn->query("SELECT * FROM us_salreturnitem WHERE sri_billid='$billid' AND sri_isactive='0' AND user_id='$usrid'");
	while($row=$slct->fetch_assoc())
	{
		$itmid=$row["sri_productid"];
		$qty=$row["sri_quantity"];
		$billitmid=$row["sri_billitemid"];
		$slctprdct=$conn->query("SELECT * FROM us_products WHERE pr_productid='$itmid' AND pr_isactive='0' AND user_id='$usrid'");
		$rowprdct=$slctprdct->fetch_assoc();
		$stock=$rowprdct["pr_stock"]-$qty;
		$update=$conn->query("UPDATE us_products SET pr_stock='$stock' WHERE pr_productid='$itmid'");
		$update1=$conn->query("UPDATE us_salreturnitem SET sri_isactive='1' WHERE sri_billitemid='$billitmid'");
		if(!$update)
		{
			$succ="fail";	
			return $succ;
		}
		
	}return $succ;
}
function updatestockp_r($conn,$billid,$csid,$usrid)
{
	$succ='succ';
	$slct=$conn->query("SELECT * FROM us_purreturnitem WHERE pri_billid='$billid' AND pri_isactive='0' AND user_id='$usrid'");
	while($row=$slct->fetch_assoc())
	{
		$itmid=$row["pri_productid"];
		$qty=$row["pri_quantity"];
		$billitmid=$row["pri_billitemid"];
		$slctprdct=$conn->query("SELECT * FROM us_products WHERE pr_productid='$itmid' AND pr_isactive='0' AND user_id='$usrid'");
		$rowprdct=$slctprdct->fetch_assoc();
		$stock=$rowprdct["pr_stock"]+$qty;
		$update=$conn->query("UPDATE us_products SET pr_stock='$stock' WHERE pr_productid='$itmid'");
		$update1=$conn->query("UPDATE us_purreturnitem SET pri_isactive='1' WHERE pri_billitemid='$billitmid'");
		if(!$update)
		{
			$succ="fail";	
			return $succ;
		}
		
	}
	return $succ;
}

function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
function findopnbal($conn,$fdate,$user_id)
{
	$slct=$conn->query("SELECT SUM(tr_transactionamount) AS totalincome FROM us_transaction WHERE tr_isactive='0' AND DATE(tr_date)<'$fdate' 
	AND tr_transactiontype='income' AND user_id='$user_id'");
	$row=$slct->fetch_assoc();
	$ttlincome=$row["totalincome"];
	
	$slct=$conn->query("SELECT SUM(tr_transactionamount) AS totalexp FROM us_transaction WHERE tr_isactive='0' AND DATE(tr_date)<'$fdate' 
	AND tr_transactiontype='expense' AND user_id='$user_id'");
	$row1=$slct->fetch_assoc();
	$ttlexpn=$row1["totalexp"];
	
	$opbal=$ttlincome-$ttlexpn;
	return $opbal;
}

function pagecount($num,$shw)
{
	$num=$num/$shw;
	$whole = floor($num);
	$fraction = $num - $whole;
	if($fraction>0)
	{
		$whole=$whole+1;
	}
	return $whole;
}
function round_up($value, $places=0) {
  if ($places < 0) { $places = 0; }
  $mult = pow(10, $places);
  return ceil($value * $mult) / $mult;
}

?>