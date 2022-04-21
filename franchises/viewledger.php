<?php
session_start();
error_reporting(0);
include('include/no-cache.php');
include('include/menu.php');
include('include/dbconfig.php');
include('include/check-login.php');
function fetchRecords()
{
	include   'include/dbconfig.php';
	$from		= trim($_POST['from']);
	$to			= trim($_POST['to']);
	 
	
	  $sql		="SELECT St_Name,P.*,courses.course_name,pursuing_course.regno,receipts.*,franchises.franchise_name FROM student_info INNER JOIN (SELECT receipt_date,receipt_no,student_id,course_id,franchise_id,id FROM receipts WHERE receipt_date BETWEEN '$from' AND '$to' GROUP BY receipt_no)receipts ON receipts.student_id=student_info.slno INNER JOIN (SELECT `receipt_id`, SUM(CASE WHEN TRIM(`payment_type`) = 'Admission' THEN `payment_amt` ELSE 0 END) AS 'ADMISSION', SUM(CASE WHEN TRIM(`payment_type`) = 'Installment' THEN `payment_amt` ELSE 0 END) AS 'INSTALLMENT', SUM(CASE WHEN TRIM(`payment_type`) = 'Fine' THEN `payment_amt` ELSE 0 END) AS 'FINE', SUM(CASE WHEN TRIM(`payment_type`) = 'Prospectus' THEN `payment_amt` ELSE 0 END) AS 'PROSPECTUS', SUM(CASE WHEN TRIM(`payment_type`) = 'Exam Fees' THEN `payment_amt` ELSE 0 END) AS 'EXAM FEES', SUM(`payment_amt`) AS TOTAL FROM payment GROUP BY `receipt_id`)P ON receipts.id=P.`receipt_id` INNER JOIN courses ON courses.id=receipts.`course_id` INNER JOIN pursuing_course ON pursuing_course.student_id=student_info.slno  INNER JOIN franchises ON franchises.id=receipts.franchise_id ORDER BY receipt_id";






	/* ECHO $sql; */
	$res	   = mysqli_query($conn,  $sql);
	if (mysqli_num_rows($res) > 0) {
		$no        = 0;
		$admission = 0;
		$fine = 0;
		$installment = 0;
		$prospectus = 0;
		$exam = 0;
		$total = 0;

		 

		while ($row = mysqli_fetch_assoc($res)) {
			
			echo '<tr>
				<td style="text-align:center;">' . $row['receipt_no'] . '</td>
				<td style="text-align:center;">' . date('d/m/Y', strtotime($row['receipt_date'])) . '</td>
				<td style="text-align:center;">' . $row['regno'] . '</td>
				<td style="text-align:center;">' . $row['St_Name'] . '</td>
				<td style="text-align:center;">' . $row['course_name'] . '</td>
				<td style="text-align:center;">' . printIt($row['ADMISSION']) . '</td>
				<td style="text-align:center;">' . printIt($row['INSTALLMENT']) . '</td>
				<td style="text-align:center;">' . printIt($row['FINE']) . '</td>
				<td style="text-align:center;">' . printIt($row['PROSPECTUS']) . '</td>
				<td style="text-align:center;">' . printIt($row['EXAM FEES']) . '</td>
				<td style="text-align:center;">' . printIt($row['TOTAL']) . '</td>
				<td style="text-align:center;">' . $row['franchise_name'] . '</td>
			</tr>';
			$admission += $row['ADMISSION'];
			$fine += $row['FINE'];
			$installment += $row['INSTALLMENT'];
			$prospectus += $row['PROSPECTUS'];
			$exam += $row['EXAM FEES'];
			$total += $row['TOTAL'];
		}
		echo '<tr>
				<td style="text-align:center;"></td>
				
				<td style="text-align:center;"></td>
				<td style="text-align:center;"></td>
				<td style="text-align:center;"></td>
				<td style="text-align:center;"><b>TOTAL</b></td>
				<td style="text-align:center;">' . $admission . '</td>
				<td style="text-align:center;">' . $installment . '</td>
				<td style="text-align:center;">' . $fine . '</td>
				<td style="text-align:center;">' . $prospectus . '</td>
				<td style="text-align:center;">' . $exam . '</td>
				<td style="text-align:center;">' . $total . '</td>
				<td style="text-align:center;"></td>
		</tr>';
	}
}


function printIt($info)
{
	if ($info != "0.00") {
		return $info;
	}
}

?>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<h3 class="page-header">Fees Ledger</h3>
			<table class="table table-bordered">
				<thead>
					<th style="text-align:center;font-size:12px;">RECEIPT NO</th>
					<th style="text-align:center;font-size:12px;">DATE </th>

					<th style="text-align:center;font-size:12px;">REGISTRATION NO </th>
					<th style="text-align:center;font-size:12px;">STUDENT NAME </th>
					<th style="text-align:center;font-size:12px;">COURSE NAME </th>
					<th style="text-align:center;font-size:12px;">ADMISSION </th>
					<th style="text-align:center;font-size:12px;">INSTALLMENT </th>
					<th style="text-align:center;font-size:12px;">FINE </th>
					<th style="text-align:center;font-size:12px;">PROSPECTUS </th>
					<th style="text-align:center;font-size:12px;">EXAM FEES </th>
					<th style="text-align:center;font-size:12px;">TOTAL </th>
					<th style="text-align:center;font-size:12px;">COLLECT BY </th>

				</thead>
				<tbody>
					<?php fetchRecords(); ?>
				</tbody>
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
</body>

</html>
<script type="text/javascript">
	$(document).ready(function(e) {
		function calculate() {
			var amount = parseFloat($.trim($('#amount').val())) || 0;
			var fine = parseFloat($.trim($('#fine').val())) || 0;
			$('#total').val((amount + fine));
		}
		$('#amount').on('keyup', function(e) {
			calculate();
		});
		$('#fine').on('keyup', function(e) {
			calculate();
		});
		$('.form_date').datetimepicker({
			language: 'fr',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
		});
		$('#back').on('click', function(e) {
			window.location = "collectform.php";
		});
	});
</script>