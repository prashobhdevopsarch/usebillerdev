<table class="table table-bordered"style="width:100%;">
<tr>
	<td><b>Bill No</b></td>
	<td><b>Bill Date</b></td>
	<td><b>Paid Amount</b></td>
	<td><b>Balance</b></td>
	<td><b>Action</b></td>
	<hr></hr>
	
<tr/>

<?php 
include("includes/config.php");
if(isset($_GET['billid']))
{
	$k=1;
	$billid=$_GET["billid"];
	$csid=$_GET["csid"];
	$slctpayhis=$conn->query("SELECT * FROM  vm_payment WHERE pa_billid='$billid' AND pa_customerid='$csid'");
	
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