<table class="table table-bordered"style="width:100%;">
<tr>
	<td><b>SL</b></td>
	<td><b>Bill Date</b></td>
	<td><b>Paid Amount</b></td>
	<td><b>Balance</b></td>
	<td><b>Action</b></td>
	<hr></hr>
	
<tr/>

<?php 
include("includes/config.php");
if(isset($_GET['mode']))
{
	$k=1;
	$mode=$_GET["mode"];
	$csid=$_GET["csid"];
	$slctpayhis=$conn->query("SELECT * FROM  us_payment WHERE pa_mode='$mode' AND pa_customerid='$csid' ORDER BY pa_paymentid DESC");
	
	while($rowpayhis=$slctpayhis->fetch_assoc())
	{?>

    <tr>
		<td><?=$k?></td>
        <td><?=$rowpayhis['pa_updatedon']?></td>
        <td><?=$rowpayhis["pa_newpayment"]?></td>
        <td><?=$rowpayhis["pa_newbalance"]?></td>
		<td style="width: 75px;"><a href="newpay_print.php?payid=<?= $rowpayhis['pa_paymentid'] ?>"><i class="fa fa-print" aria-hidden="true"></i> print</a></td>
	</tr>	
	<?php $k++;}
}
?>
</table>