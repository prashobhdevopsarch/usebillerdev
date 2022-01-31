<?php $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);?>
<style>
#pay td {padding:5px;}
</style>

<div id="payhstry" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="cls_hstry" class="close">&times;</span>
      <h2>Balance Payment</h2>
    </div>
    <div class="modal-body">
    
      <table class="table" style="width:100%;">
      <thead>
      <th>#</th>
      <th>Date</th>
      <th>Payment</th>
      <th>New Balance</th>
      <th></th>
      </thead>
      <tbody id="payhstry_cntnt">
      </tbody>
      
      </table>
      
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