<?php 
session_start();
include "include/menu.php";
include "include/check-login.php";
function fetchIncomeReport()
{
	include "include/dbconfig.php";
	$date1=trim($_POST['date1']);
	$date2=trim($_POST['date2']);
	$sql="SELECT * FROM `daybook` WHERE  `date`  BETWEEN '$date1' AND '$date2' ";
	$res=mysqli_query($conn,  $sql);
	while($row=mysqli_fetch_assoc($res))
	{
		echo '
		<tr>
			<td style="text-align:center">'.checkAndPrintForIncome($row['date'],$row['type']).'</td>
			<td style="text-align:center">'.checkAndPrintForIncome($row['particulars'],$row['type']).'</td>
			<td style="text-align:center">'.printAmountForCashIncome($row['cash'],$row['to'],$row['type']).'</td>
			<td style="text-align:center">'.printAmountForBankIncome($row['bank'],$row['to'],$row['type']).'</td>
			
			<td style="text-align:center">'.checkAndPrintForExpense($row['date'],$row['type']).'</td>
			<td style="text-align:center">'.checkAndPrintForExpense($row['particulars'],$row['type']).'</td>
			<td style="text-align:center">'.printAmountForCashExpense(abs($row['cash']),$row['to'],$row['type']).'</td>
			<td style="text-align:center">'.printAmountForBankExpense(abs($row['bank']),$row['to'],$row['type']).'</td>
		</tr>
		
		';
	}
}
function checkAndPrintForExpense($content,$type)
{
	if($type=="EXPENSE")
	{
		return $content;
	}
	else{
		return "";
	}
}
function checkAndPrintForIncome($content,$type)
{
	if($type=="INCOME")
	{
		return $content;
	}
	else{
		return "";
	}
}

function printAmountForCashExpense($amount,$to,$type)
{
	$value=null;
	if($to=="CASH" && $type=="EXPENSE")
	{
		$value=$amount;
	}
	else{
		$value=null;
	}
	return $value;
}
function printAmountForBankExpense($amount,$to,$type)
{
	$value=null;
	if($to=="BANK" && $type=="EXPENSE")
	{
		$value=$amount;
	}
	else{
		$value=null;
	}
	return $value;
}
function printAmountForCashIncome($amount,$to,$type)
{
	$value=null;
	if($to=="CASH" && $type=="INCOME")
	{
		$value=$amount;
	}
	else{
		$value=null;
	}
	return $value;
}
function printAmountForBankIncome($amount,$to,$type)
{
	$value=null;
	if($to== "BANK" && $type == "INCOME")
	{
		$value=$amount;
	}
	else{
		$value=null;
	}
	return $value;
}
?>
<div id="page-wrapper">

	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Daybook Report</h3>
<table class="table table-bordered table-rowless">
  <thead>
    <th width="50%" colspan="4" style="text-align:center;"><b>INCOME</b></th>
    <th width="50%" colspan="4" style="text-align:center;"><b>EXPENSE</b></th>
  </thead>
  <thead>
    <th width="9%" align="center"><b>DATE</b></th>
    <th width="21%" align="center"><b>PARTICULARS</b></th>
    <th width="10%" align="center"><b>CASH</b></th>
    <th width="10%" align="center"><b>BANK</b></th>
    <th width="9%" align="center"><b>DATE</b></th>
    <th width="19%" align="center"><b>PARTICULARS</b></th>
    <th width="11%" align="center"><b>CASH</b></th>
    <th width="11%" align="center"><b>BANK</b></th>
  </thead>
 
  <?php fetchIncomeReport();
		
  
  ?>
</table>


		
		  		<!-- /col-md-6 -->
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
	 	<!-- /row -->
      </div>
			</div>
		</div>
	</div>
</div>
</div>
<?php include('include/footer.php'); ?>
<style>
	.table-rowless td {border: none !important; border-right: solid 1px #ccc !important;}
</style>
</body>
</html>