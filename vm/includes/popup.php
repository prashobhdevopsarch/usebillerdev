<?php $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);?>
<style>
#pay td {padding:5px;}
</style>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Balance Payment</h2>
    </div>
    <div class="modal-body">
    <form action="payhstry.php" method="post">
    <input id="billid" name="billid" type="hidden">
    <input id="payamd" name="payamd" type="hidden">
    <input name="back" value="<?=$page?>" type="hidden">
      <table id="pay" style="width:100%;">
      <tr>
      <td>Balance</td><td><input readonly class="form-control" id="balance" name="balance"></td>
      </tr>
      <tr>
      <td>New Payment</td><td><input class="form-control" onKeyUp="calnewbal()" required id="newpay" name="newpay"></td>
      </tr>
      <tr>
      <td>New Balance</td><td><input readonly class="form-control" id="newbal" name="newbal"></td>
      </tr>
      <tr>
      <td></td><td align="right"><button class="btn btn-success" name="update" type="submit">Update</button></td>
      </tr>
      </table>
      </form>
    </div>
    <div class="modal-footer">
      
    </div>
  </div>

</div>
<script>
function calnewbal()
{
	var bal = document.getElementById("balance").value;
	var newpay = document.getElementById("newpay").value;
	
	var newbal = Number(bal)-Number(newpay);
	
	document.getElementById("newbal").value = newbal;
	
}
</script>