<?php
session_start();
include "include/dbconfig.php";
include "functions.php";
$id = isset($_GET['studentid']) ? $_GET['studentid'] : "";
$franchise = json_decode(getFranchises($_GET['franchise']), true);
$franchise = $franchise['records'][0];
if ($id != "") {
	$sql   = "SELECT student_info.*,pursuing_course.*,pursuing_course.regno as reg_no , courses.*  FROM `student_info`
			INNER JOIN 	pursuing_course
			ON pursuing_course.student_id=student_info.slno
			INNER JOIN courses
			ON pursuing_course.course_id=courses.id
			WHERE student_info.slno='$id'";
	/* echo $sql; */
	$res = mysqli_query($conn,  $sql);
	$row = mysqli_fetch_assoc($res);
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
	echo $result . "Rupees  " . $points . " Only";
}
?>
<?php include('include/menu.php'); ?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2 col-md-2 col-xs-2">
				<div class="img">
					<img src="images/<?php echo $franchise['logo']; ?>" height="150" width="280"></img>
				</div>
			</div>
			<div class="col-sm-10 col-md-10 col-xs-10" style="text-align:center;padding-left:0px;padding-right:0px;">
				<font size="6" face="revel" align="center"><?php echo $franchise['franchise_name']; ?><br /></font>
				<!-- <font size="5"><b>Computer Education</font><br>
				<font size="3"><b><?php echo $affiliation; ?> (Reg. No. <?php echo $registration; ?>)<br> AN
						ISO <?php echo $iso.'-'.$code; ?> Certified Institute.<sup></sup></b></font><br> -->
				<font size="4"><?php echo  $franchise['address']; ?> </font> <br />
				<font size="4">Mobile : <?php echo $franchise['contact']; ?></font>
			</div>

			<div class="col-sm-12 col-md-12 col-xs-12" style="padding-top:2%;text-align:center;">
				<font size="5"><b> ADMISSION FORM </b></font>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 18px;padding-top:5%;">
				<B>Form No : </b><?php echo $row['slno']; ?>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-6" style="text-align: right;font-size: 18px;padding-top:5%;">
				<b>Reg. No : </b><?php echo $row['reg_no']; ?>
			</div>
			<div class="col-sm-12 col-md-12 col-xs-12" style="margin-top:5%; padding-left:0px;">
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Student's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						:&nbsp;&nbsp;&nbsp;&nbsp; </b> <?php echo "\t " . $row['St_Name']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						:&nbsp;&nbsp;&nbsp;&nbsp; </b> <?php echo "\t " . $row['Fathers_Name']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Mother's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp; </b> <?php echo "\t " . $row['Mothers_Name']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp; </b><?php echo "\t " . $row['Vill'] . "," . $row['Post'] . "," . $row['PS'] . ", " . $row['Dist'] . ", " . $row['Pin']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;"><b>DOB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp; </b> <?php echo "\t" . date("d-m-Y", strtotime($row['DOB'])); ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>SEX&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp; </b> <?php echo $row['Gender']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Nationality&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </b> <?php echo "\t INDIAN"; ?>
				</div>
				<!-- <div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Marital Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </b> <?php //echo "\t" . $row['mstatus']; 
																																																										?>
					&nbsp;
				</div> -->
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Religion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						:&nbsp;&nbsp; </b>&nbsp;<?php echo $row['Religion']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Caste Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; </b><?php echo $row['Cust']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Mobile No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; </b>&nbsp;<?php echo $row['Contact_no']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Alternative No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						:&nbsp;&nbsp; </b>&nbsp;<?php echo $row['contact2']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Aadhar No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </b>&nbsp;<?php echo $row['aadhar']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Course Apply For&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </b>&nbsp;<?php echo $row['course_name']; ?>
				</div>
				<!-- <div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Applicant Occupation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						:&nbsp;&nbsp; </b>&nbsp;<?php //echo $row['Student_Occupation']; 
												?>
				</div> -->
				<!-- <div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Father's Occupation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </b>&nbsp;<?php //echo $row['fathers_occupation']; 
																																													?>
				</div> -->
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Qualification&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </b>&nbsp;<?php echo $row['qualification']; ?>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
					<b>Session&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; </b>&nbsp;<?php echo $row['Session1']; ?>
				</div>
			</div>

			<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-top:10px;">
				&nbsp;<p>&nbsp;</p>
				<p>
					<label>Declaration :</label><br />
					<b> I do here by declare that all information stated in this application form are true to the best of my knowledge.I shall always abide by the rules and regulation of the <?php echo $franchise['franchise_name']; ?>.</b>

			</div>

			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>


			<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 18px;text-align:left;margin-top:15%;">
				<b>Signature of the Applicant</b><br />
				<b>Date : </b><?php echo (date('d-m-Y', strtotime($row['DOA']))); ?>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 18px;padding-top:10px;text-align:right;margin-top:15%;">
				<div style="text-align:right;">
					<b>Center-In-Charge</b><br />
					<b>Checked by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>
				</div>
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