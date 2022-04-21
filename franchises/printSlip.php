<?php
session_start();
include('include/no-cache.php');
include "include/dbconfig.php";
include "../instituteinfo.php";
include('include/check-login.php');

$id = isset($_GET['id']) ? $_GET['id'] : "";
if ($id != "") {
	$sql   = "SELECT student_info.*,payment.* , courses.*  FROM `student_info`
			INNER JOIN 	payment
			ON student_info.slno=payment.admission_slno
			INNER JOIN courses
			ON payment.course_id=courses.course_id
			WHERE student_info.slno='$id'";
	$res = mysqli_query($conn,  $sql);
	$row = mysqli_fetch_assoc($res);
}
function slipType()
{
	include "include/dbconfig.php";
	$remarks = getSlipRemarks();
	if ($remarks < 2) {
		$remarks = (int)$remarks + 1;
		$sqll = "UPDATE `payment` SET `remarks`='$remarks' WHERE `receipt_no`='$_GET[id]'";
		/* echo $sqll; */
		$res = mysqli_query($conn,  $sqll);
	}
	$remarks = getSlipRemarks();
	if ($remarks >= 2) {
		echo " (DUPLICATE)";
	}
}
function getSlipRemarks()
{
	include "include/dbconfig.php";
	$sql = "SELECT * FROM `payment` WHERE `receipt_no`='$_GET[id])'";
	$res = mysqli_query($conn,  $sql);
	if (mysqli_num_rows($res) > 0) {
		$row = mysqli_fetch_assoc($res);
		return $row['remarks'];
	}
}
function getFeesRecord()
{
	include "include/dbconfig.php";

	$id = htmlspecialchars($_GET['id']);
	$sql1 = "SELECT * FROM receipts WHERE receipt_no='{$id}' group by receipt_no";
	$res1 = mysqli_query($conn, $sql1);
	$row1 = mysqli_fetch_assoc($res1);

	$sql = "SELECT  *,payment.payment_amt as paymentamt,pursuing_course.regno as registration,receipts.* FROM `payment` INNER JOIN receipts ON receipts.id=payment.receipt_id INNER JOIN `student_info` ON student_info.slno=receipts.student_id INNER JOIN courses ON courses.id = receipts.course_id INNER JOIN pursuing_course ON pursuing_course.student_id=student_info.slno WHERE payment.`receipt_id`='{$row1['id']}'";
	/* echo $sql; */
	$res = mysqli_query($conn,  $sql);
	$ress = mysqli_query($conn,  $sql);
	$no = 1;
	$total = 0;
	$info = mysqli_fetch_assoc($ress);

	echo '<tr>
					<td colspan="2"><b>Student Name : </b>' . $info['St_Name'] . '</td>
					<td ><b>Reg No: </b>' . $info['registration'] . '</td>
				</tr>
				<tr>
					<td colspan="2"><b>Course : </b>' . $info['course_name'] . '</td>
					<td width="20%"><b>Payment Date: </b>' . date('d/m/Y', strtotime($info['date'])) . '</td>
				</tr>
				<tr>
					<td width="8%"><b>Sl No</b></td>
					<td ><b>Description</b></td>
					<td style="text-align:center;"><b>Amount Paid</b></td>
				</tr>';
	/* $row=mysqli_fetch_assoc($res);
				print_r($row); */
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<tr>
			<td>' . $no++ . '</td>
			<td>' . $row['payment_type'] . '</td>
			<td style="text-align:center;">' . $row['paymentamt'] . '</td>
		</tr>';
		$total += $row['paymentamt'];
	}

	echo '<tr>
		<td colspan="2"><b> Amount In words : </b>' . getIndianCurrency($total) . '</td>
		<td style="text-align:center;"> ' . $total . '</td>
	</tr>';
}
function getIndianCurrency($amount)
{
	$number = $amount;
	$no = round($number);
	$point = round($number - $no, 2) * 100;
	$hundred = null;
	$digits_1 = strlen($no);
	$i = 0;
	$str = array();
	$words = array(
		'0' => '', '1' => 'One', '2' => 'Two',
		'3'  => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
		'7'  => 'Seven', '8' => 'Eight', '9' => 'Nine',
		'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
		'13' => 'Thirteen', '14' => 'Fourteen',
		'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
		'18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
		'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
		'60' => 'Sixty', '70' => 'Seventy',
		'80' => 'Eighty', '90' => 'Ninety'
	);
	$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	while ($i < $digits_1) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += ($divider == 10) ? 1 : 2;
		if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str[] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
		} else $str[] = null;
	}
	$str = array_reverse($str);
	$result = implode('', $str);
	$points = ($point) ?
		"." . $words[$point / 10] . " " .
		$words[$point = $point % 10] : '';
	return $result . "Rupees  " . $points . " Only";
}
?>
<?php include('include/menu.php'); ?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2 col-md-2 col-xs-2">
				<div class="img">
					<img src="../images/logo.png" height="150" width="280"></img>
				</div>
			</div>
			<div class="col-sm-10 col-md-10 col-xs-10" style="text-align:center;padding-left:0px;padding-right:0px;">
				<font size="6" face="revel" align="center"><?php echo $instituteName; ?><br /></font>
				<font size="5"><b>Computer Education</b></font><br>
				<font size="3"><b><?php echo $description; ?> <sup></sup></b></font><br>
				<font size="4"><?php echo $address; ?> </font> <br />
				<font size="4">Ph : <?php echo $contact; ?> </font> <br />
				<font size="4"><b>MONEY RECEIPT <?PHP slipType(); ?></b></font><br />
				<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 16px;text-align:left;">
					<B>Bill No : <?php echo $_GET['id']; ?></B>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 16px;">

				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-xs-12" style="padding-top:2%;text-align:center;">

			</div>
			<table class="table table-bordered table-condensed">

				<?php getFeesRecord(); ?>
			</table>
			<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 18px;padding-top:5%;padding-left:0px;">

				<div style="padding:0px;font-size: 16px;text-align:left">Received By<br /><small></small></div>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 18px;padding-top:5%;">

				<div style="padding-left:16%;font-size: 16px;text-align:right">Collector's Signature With Seal<br /><small></small></div>
			</div>



		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="js/file-validator.js" type="text/javascript" charset="utf-8"></script>
<script src="js/app.js"></script>

<!-- Syntax Highlighting Support -->
<script src="highlighting/sh_main.min.js" type="text/javascript" charset="utf-8"></script>
<script src="highlighting/sh_javascript_dom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="highlighting/sh_html.min.js" type="text/javascript" charset="utf-8"></script>
<!-- End -->
<script type="text/javascript" src="docs/js/bootstrap-3.3.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>
<!-- DataTables JavaScript -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
<!-- Datepick -->
<script type="text/javascript" src="datepick_api/bootstrap_date/js/bootstrap.min_date.js"></script>
<script type="text/javascript" src="datepick_api/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick_api/js/locales/bootstrap-datetimepicker.en.js" charset="UTF-8"></script>
<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js">
</script>
<!--MultiSelect -->
<script type="text/javascript" src="docs/js/prettify.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
<!-- CK Editor -->
<script src="ckeditor/ckeditor.js"></script>
<!--End-->
<script src="dist/js/sb-admin-2.js"></script>
<!-- Tables Edit-->
<script src="jquery-tabledit/jquery.tabledit.min.js"></script>



</body>

</html>