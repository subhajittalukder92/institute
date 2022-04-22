<?php
session_start();
include('include/no-cache.php');
include('include/dbconfig.php');
include('include/check-login.php');
include "functions.php";
$success_msg = null;
$error_msg = null;
$course = array();
$std_row=[];

function getStudentData()
{
	include('include/dbconfig.php');
	$std_id = isset($_GET['id']) ? $_GET['id'] : "";
	$sql = "SELECT * FROM student_info WHERE slno='$std_id'";
	$res = mysqli_query($conn, $sql);
	if (mysqli_num_rows($res) > 0) {
		$std_row = mysqli_fetch_assoc($res);
		return $std_row;
	}
}



if (isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid']) {
	$sname			= strtoupper(trim($_POST['sname']));
	$fname			= strtoupper(trim($_POST['fname']));
	$mname			= strtoupper(trim($_POST['mname']));
	$address		= strtoupper(trim($_POST['address']));
	$po				= strtoupper(trim($_POST['po']));
	$ps				= strtoupper(trim($_POST['ps']));
	$district		= strtoupper(trim($_POST['district']));
	$gender			= trim($_POST['gender']);
	$querystudent	= trim(isset($_POST['querystudent']) ? $_POST['querystudent'] : "");
	$dob			= strtoupper(trim($_POST['dob']));
	$nationality	= strtoupper(trim($_POST['nationality']));
	//$mstatus		= strtoupper(trim($_POST['mstatus']));
	$religion		= strtoupper(trim($_POST['religion']));
	$caste			= strtoupper(trim($_POST['caste']));
	$pin			= strtoupper(trim($_POST['pin']));
	$contact		= strtoupper(trim($_POST['contact']));
	$contact1		= strtoupper(trim($_POST['mobile1']));
	$aadhar			= strtoupper(trim($_POST['aadhar']));
	//$occupation		= strtoupper(trim($_POST['occupation']));
	//$foccupation	= strtoupper(trim($_POST['foccupation']));
	$session		= strtoupper(trim($_POST['yoa']));
	$qualification	= strtoupper(trim($_POST['qualification']));
	$course			= strtoupper(trim($_POST['course']));
	$fees			= strtoupper(trim($_POST['fees']));
	$date			= strtoupper(trim($_POST['date']));
	//$paidamt		= strtoupper(trim($_POST['paidamt']));
	/* $regno1			=strtoupper(trim($_POST['regno'])); */
	//$chequeno		= strtoupper(trim($_POST['chequeno']));
	$prevcourse		= strtoupper(trim($_POST['prevcourse']));
	//$previnstitute	= strtoupper(trim($_POST['previnstitute']));
	$note =   strtoupper(trim($_POST['note']));
	$refname		= strtoupper(trim($_POST['refname']));
	//$refaddress		= strtoupper(trim($_POST['refaddress']));
	//$refcontact		= strtoupper(trim($_POST['refcontact']));
	$time			= strtoupper(trim($_POST['time']));
	$admissionType	= strtoupper(trim($_POST['admissionType']));

	$stid			= trim(mysqli_real_escape_string($conn, $_POST['std_id']));
	$value = '';
	$courseday = array();
	

	if (isset($_POST['courseday'])) {

		foreach ($_POST["courseday"] as $row) {
			$value .= $row . ',';
		}
		$value = rtrim($value, ',');
	}

	if ($value != "") {
		$courseday = explode(',', $value);
	}

	//$payby			= strtoupper(trim($_POST['payby']));
	/* $frommonth		=trim($_POST['frommonth']);
$tomonth		=trim($_POST['tomonth']);
$toyear			=trim($_POST['toyear']); */
	$sessioncode	= trim($_POST['sessionCode']);
	$coursecode		= $course;
	//$serialno		= findSerialNo($sessioncode, $coursecode);
	$regno			= $_POST['registrationNo'];
	$particulars	= "ADMISSION TO " . findCourseName($course);
	$sourcePath 	= $_FILES['fileToUpload']['tmp_name'];
	$imagename		= $_FILES['fileToUpload']['name'];
	$targetPath 	= "Student_images/" . $_FILES['fileToUpload']['name'];
	move_uploaded_file($sourcePath, $targetPath);
	//update----
	 $sql    		= "UPDATE `student_info` SET `St_Name`='$sname',`Fathers_Name`='$fname',`DOB`='$dob',`Gender`='$gender',`Cust`='$caste',`Religion`='$religion',`DOA`='$date',`Mothers_Name`='$mname',`Vill`='$address',`Post`='$po',`PS`='$ps',`Dist`='$district',`Pin`='$pin',`Contact_no`='$contact',`contact2`='$contact1',`aadhar`='$aadhar',`qualification`='$qualification',`image_name`='$imagename',`previous_course`='$prevcourse',`ref_name`='$refname',`admission_type`='$admissionType',`note`='$note' WHERE slno='$stid'";


	$res			= mysqli_query($conn,  $sql);
	
	if ($res) {

		$courseday		= implode(',', $courseday);
		$course_day=json_encode($courseday);
		
		$sql3="UPDATE `pursuing_course` SET `course_days`='{$course_day}',`time`='$time' WHERE student_id='$stid'";
		mysqli_query($conn,$sql3);



		$success_msg = 'Addmission Successfull. Student Unique ID Is : <b>' . $stid . '</b> And Registration Number  : <b>' . $regno . '</b> </div>';
		header("Location:studentmanagement.php");
	} else {

		$error_msg = 'Error : Unable To Save ! ';
	}
	$_SESSION['formid'] = md5(rand(0, 10000000));
} else {

	$_SESSION['formid'] = md5(rand(0, 10000000));
}

function findMaxID($session)
{
	include "include/dbconfig.php";
	$studentID = null;
	if ($session != "") {
		$sql = "SELECT MAX(`Student_Id`) AS stid FROM `student_info` WHERE `Session1`='$session'";
		/* echo $sql; */
		$res = mysqli_query($conn,  $sql);
		$row = mysqli_fetch_assoc($res);
		if ($row['stid'] == null) {
			$year		= (string)$session;
			$studentID  = $year . "001";
			return $studentID;
		} else {
			$studentID	= $row['stid'] + 1;
			return $studentID;
		}
	}
}
function getAddress()
{
	include('include/dbconfig.php');
	$sql = "SELECT * FROM `adress` group by `id` ORDER BY `address` ";
	$res = mysqli_query($conn,  $sql);
	$option = '';
	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$option .= '<option value="' . $row['address'] . '">' . $row['address'] . '</option>';
		}
		echo $option;
	}
}
function getCourses()
{
	include('include/dbconfig.php');
	$sql = "SELECT * FROM `courses` ORDER BY `course_name`";
	$res = mysqli_query($conn,  $sql);
	$option = '';
	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$option .= '<option value="' . $row['id'] . '">' . $row['course_name'] . '-' . $row['description'] . '</option>';
		}
		echo $option;
	}
}

function updateQuesryListStudents($id)
{
	include "include/dbconfig.php";
	$sql = "UPDATE `contact_list` SET `status`='1' WHERE `id`='$id'";
	$res = mysqli_query($conn,  $sql);
	if ($res) {
		return true;
	} else {
		return false;
	}
}
function getSession()
{
	include "include/dbconfig.php";
	$sql = "SELECT * FROM `session` WHERE `status`='ACTIVE'";
	$res = mysqli_query($conn,  $sql);
	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			echo '<option value="' . $row['session_code'] . '">' . $row['session_code'] . "-" . $row['description'] . '</option>';
		}
	}
}
function findQuesryListStudents()
{
	include "include/dbconfig.php";
	$sql = "SELECT * FROM `contact_list` WHERE `status`='0'";
	$res = mysqli_query($conn,  $sql);
	if (mysqli_num_rows($res) > 0) {
		$option = '<option value="">--Select Query Student--</option>';
		while ($row = mysqli_fetch_assoc($res)) {
			$date = strtotime($row['dob']);
			$date = date('d-m-Y', $date);
			$date = str_replace('-', '/', $date);
			$option .= '<option value="' . $row['id'] . '">' . $row['student_name'] . '-' . $row['gurdian'] . '(DOB-' . $date . ') </option>';
		}
		echo $option;
	}
}
?>

<?php include('include/menu.php'); ?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<br />
		</div>
		<div id="message">


			<?php if ($success_msg != null) {
				echo '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-check-circle"></i> 
				' . $success_msg . '
				</div>
				
				';
			} elseif ($error_msg != null) {
				echo '
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $error_msg . '</div>
				  ';
			}

			?>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<h4 class="page-header" style="border-color:black;">Edit Admission</h4>
			</div>
		</div>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="admissionForm" name="admissionForm" enctype="multipart/form-data">
			<?php $std_row = getStudentData(); ?>
			<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']); ?>">
			<input type="hidden" name="id" id="id" value="<?php echo $std_row['slno']; ?>">
			<div class="row">
				<div class="form-group">
					<input type="hidden" name="std_id" id="std_id" value="<?php echo $std_row['slno']; ?>">
					<label class="control-label col-md-1 col-sm-1 col-xs-12">Student's Name: <span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12 ">
						<input type="text" id="sname" name="sname" class="form-control col-md-7 col-xs-12" required style="border-color:red" value="<?php echo $std_row['St_Name']; ?>">
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Father's Name<span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="fname" name="fname" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['Fathers_Name']; ?>" />
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="mname">Mother's Name: <span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="mname" name="mname" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['Mothers_Name']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">Address: <span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12 ">
						<input type="text" id="address" name="address" class="form-control col-md-7 col-xs-12" required style="border-color:red" value="<?php echo $std_row['Vill']; ?>">
						
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="po">P.O:<span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="po" name="po" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['Post']; ?>" />
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="ps">P.S: <span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="ps" name="ps" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['PS']; ?>" />
					</div>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">District: <span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12 ">
						<input type="text" id="district" name="district" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['Dist']; ?>">
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">PIN<span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="pin" name="pin" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['Pin']; ?>" />


					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Gender<span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<select id="gender" name="gender" class="form-control col-md-7 col-xs-12" required style="border-color:red">
							<?php echo '<option selected value="' . $std_row['Gender'] . '">' . $std_row['Gender'] . '</option>'; ?>
							<option value="MALE"> MALE</option>
							<option value="FEMALE">FEMALE</option>
						</select>
					</DIV>

				</div>
			</div>
			<P></P>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">DOB: <span class="required"></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12 required">
						<div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
							<input class="form-control" type="text" name="dob" id="dob" autocomplete="off" required style="border-color:red" value="<?php echo $std_row['DOB']; ?>">
							<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Nationality:<span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="nationality" name="nationality" value="INDIAN" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['DOB']; ?>" />
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">Religion: <span class="required"></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<select id="religion" name="religion" class="form-control col-md-7 col-xs-12 ">
							<?php echo '<option selected value="' . $std_row['Religion'] . '">' . $std_row['Religion'] . '</option>'; ?>
							<option value="CHIRSTIAN">CHIRSTIAN</option>
							<option value="ISLAM">ISLAM</option>
							<option value="HINDUISM">HINDUISM</option>
							<option value="SIKH">SIKH</option>
							<option value="OTHERS">OTHERS</option>
						</select>
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer_gst">Caste: <span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<select id="caste" name="caste" class="form-control col-md-7 col-xs-12">
							<?php echo '<option selected value="' . $std_row['Cust'] . '">' . $std_row['Cust'] . '</option>'; ?>
							<option value="GENERAL">General</option>
							<option value="SC">SC</option>
							<option value="ST">ST</option>
							<option value="OBC">OBC</option>
						</select>
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Addhar No:<br />
						<font size="2" color="red"></font><span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="aadhar" name="aadhar" class="form-control col-md-7 col-xs-12" autocomplete="off" value="<?php echo $std_row['aadhar']; ?>" />
					</div>

				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">Mobile No: <span class="required"></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12 required">
						<input type="text" id="contact" name="contact" class="form-control col-md-7 col-xs-12 required" maxlength="10" value="<?php echo $std_row['Contact_no']; ?>">
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Alternate No:<br />
						<font size="2" color="red"></font><span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input type="text" id="mobile1" name="mobile1" class="form-control col-md-7 col-xs-12" value="<?php echo $std_row['contact2']; ?>" />
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Direct Diploma<br />
						<font size="2" color="red"></font><span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<select name="admissionType" id="admissionType" class="form-control">
							<?php

							if ($std_row['admission_type'] == "DIRECT DIPLOMA") {

								echo '<option selected value="' . $std_row['admission_type'] . '">YES</option>';
							} else {
								echo '<option selected value="' . $std_row['admission_type'] . '">NO</option>';
							}

							?>
							<option value="DIRECT DIPLOMA">YES</option>
							<option value="">NO</option>
						</select>
					</div>
				</div>
			</div>
			<p></p>
			<div class="row">

			</div>
			<p></p>

			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Session:<span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<select id="sessionCode" name="sessionCode" class="form-control col-md-7 col-xs-12" required readonly 		style="border-color:red">
							<?php
							$sql = "SELECT * FROM `session` WHERE session_code={$std_row['session_code']} AND `status`='ACTIVE'";
							$res = mysqli_query($conn,  $sql);
							if (mysqli_num_rows($res) > 0) {
								$row = mysqli_fetch_assoc($res);

								echo '
								<option selected value="' . $row['session_code'] . '">' . $row['session_code'] . "-" . $row['description'] . '</option>';
							}
							?>
							
						</select>

						
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Course:<span class=""></span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<select id="course" name="course" class="form-control col-md-7 col-xs-12" required style="border-color:red" readonly >
							<?php

							$sqll = "SELECT * FROM pursuing_course WHERE student_id={$std_row['slno']}";
							$ress = mysqli_query($conn,  $sqll);
							$roww = mysqli_fetch_assoc($ress);

							$sqll2 = "SELECT * FROM `courses` WHERE id={$roww['course_id']}  ORDER BY `course_name`";
							$res22 = mysqli_query($conn,  $sqll2);

							if (mysqli_num_rows($res22) > 0) {
								$row22 = mysqli_fetch_assoc($res22);

								echo '<option selected value="' . $row22['id'] . '">' . $row22['course_name'] . "-" . $row22['description'] . '</option>';
							}

							?>
							 
						</select>
					</div>
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Registration No<span class=""></span>
					</label>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<input type="text" class="form-control" name="registrationNo" id="registrationNo" readonly value="<?php
																															$sql = "SELECT * FROM pursuing_course WHERE student_id='{$std_row['slno']}'";
																															$res = mysqli_query($conn, $sql);
																															$row = mysqli_fetch_assoc($res);
																															echo $row['regno'];

																															?>">
					</div>
					<DIV CLASS="clearfix"></div>
				</div>

			</div>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Qualification(Last Exam): <span class="required"></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12 required">
						<input type="text" id="qualification" name="qualification" class="form-control col-md-7 col-xs-12 required" value="<?php echo $std_row['qualification']; ?>">
					</div>
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Course Fees: <span class="required"></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12 required">
						<input type="text" id="fees" readonly name="fees" required="required" class="form-control col-md-7 col-xs-12 required" required style="border-color:red" value="<?php
																																												$sql = "SELECT * FROM pursuing_course WHERE student_id='{$std_row['slno']}'";
																																												$res = mysqli_query($conn, $sql);
																																												$row = mysqli_fetch_assoc($res);
																																												echo $row['course_fee'];

																																												?>">
					</div>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Addmission Date <span class="required"></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12 required">
						<div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
							<input class="form-control" type="text" name="date" id="date" value="<?php echo $std_row['DOA']; ?>" autocomplete="off" required style="border-color:red">
							<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Year of Addmission <span class="required"></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12 required">
						<input type="text" id="yoa" name="yoa" required="required" class="form-control col-md-7 col-xs-12 required" readonly value="<?php echo $std_row['Session1']; ?>">
					</div>

				</div>

			</div>


			<p></p>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Course Time:<span class=""></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<select id="time" name="time" class="form-control">
							<?php

							$sql = "SELECT * FROM pursuing_course WHERE student_id='{$std_row['slno']}'";
							$res = mysqli_query($conn, $sql);
							if (mysqli_num_rows($res) > 0) {
								$row = mysqli_fetch_assoc($res);

								echo '<option selected value="' . $row['time'] . '">' . $row['time'] . '</option>';
							}
							?>
							<option value="06.00 AM">06.00 AM</option>
							<option value="07.00 AM">07.00 AM</option>
							<option value="08.00 AM">08.00 AM</option>
							<option value="10.00 AM">10.00 AM</option>
							<option value="11.00 AM">11.00 AM</option>
							<option value="12.00 PM">12.00 PM</option>
							<option value="01.00 PM">01.00 PM</option>
							<option value="02.00 PM">02.00 PM</option>
							<option value="03.00 PM">03.00 PM</option>
							<option value="04.00 PM">04.00 PM</option>
							<option value="05.00 PM">05.00 PM</option>
							<option value="06.00 PM">06.00 PM</option>
							<option value="07.00 PM">07.00 PM</option>
							<option value="08.00 PM">08.00 PM</option>
						</select>
					</div>
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Course Day:<span class=""></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<select id="courseday" name="courseday[]" multiple class="form-control selectpicker">
							<?php

							$sql = "SELECT * FROM pursuing_course WHERE student_id='{$std_row['slno']}'";
							$res = mysqli_query($conn, $sql);

							if (mysqli_num_rows($res) > 0) {
								$row = mysqli_fetch_assoc($res);
								$arr = (json_decode($row['course_days'], true));
								$courseDays = explode(',', $arr);

							?>
								<option <?php echo in_array("MON", $courseDays) ? 'selected' : ""; ?> value="MON">MONDAY </option>
								<option <?php echo in_array("TUE", $courseDays) ? 'selected' : ""; ?> value="TUE">TUESDAY </option>
								<option <?php echo in_array("WED", $courseDays) ? 'selected' : ""; ?> value="WED">WEDNESDAY </option>
								<option <?php echo in_array("THU", $courseDays) ? 'selected' : ""; ?> value="THU">THURSDAY </option>
								<option <?php echo in_array("FRI", $courseDays) ? 'selected' : ""; ?> value="FRI">FRIDAY </option>
								<option <?php echo in_array("SAT", $courseDays) ? 'selected' : ""; ?> value="SAT">SATURDAY </option>
								<option <?php echo in_array("SUN", $courseDays) ? 'selected' : ""; ?> value="SUN">SUNDAY </option>

							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<p></p>

			<!--
 -->

			<div class="row">
				<div class="form-group">

					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Image:<span class=""></span>
						</label>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<input type="file" id="fileToUpload" name="fileToUpload" class="form-control">
						</div>
						<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Previous Course<span class=""></span>
						</label>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<input type="text" id="prevcourse" name="prevcourse" class="form-control" value="<?php echo $std_row['previous_course']; ?>">

						</div>
					</div>
				</div>

			</div>
			<p></p>

			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Note<span class=""></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<input type="text" id="note" name="note" class="form-control" value="<?php echo $std_row['note']; ?>">
					</div>
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Referer Name<span class=""></span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<input type="text" id="refname" name="refname" class="form-control" value="<?php echo $std_row['ref_name']; ?>">

					</div>
				</div>
			</div>
			<p>&nbsp;</p>

			<p><br /></p>


			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-offset-4 col-sm-4 col-xs-12">
					<input type="submit" id="submit" name="submit" value="Update" class="form-control btn btn-info col-md-7 col-xs-12"><br />
					<p><br /></p>
				</div>
			</div>





		</form>
		<!-- /.col-lg-12 -->


		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include('include/footer.php'); ?>
</body>

</html>
<script>
	$(document).ready(function() {
		var datas = $("#admissionForm").serialize();

		$('#sessionCode , #course').on('change', function() {
			if ($('#sessionCode').val() != "" && $('#course').val() != "") {
				$.ajax({
					url: "../getRegistrationNo.php",
					method: "post",
					data: {
						'sessionCode': $('#sessionCode').val(),
						'course': $('#course').val()
					},
					success: function(data) {
						$('#registrationNo').val(data);
					}
				});
			}
		});
		$('#stid').on('focus', function(e) {
			var session = $('#session').val();

			$.ajax({
				url: '../findmaxId.php',
				type: 'post',
				data: {
					'session': session
				},
				success: function(data) {
					if (data) {
						$('#stid').val(data);

					}
				},

			});
		});
		/* $('#address').on('change', function(e) {
			var address = $('#address').val();

			$.ajax({
				url: '../findAddress.php',
				type: 'post',
				data: {
					'address': address
				},
				dataType: "json",
				success: function(data) {
					if (data) {
						$('#po').val(data.po);
						$('#pin').val(data.pin);
						$('#ps').val(data.ps);
						$('#district').val(data.dist);

					}
				},

			});
		}); */
		$('#course').on('change', function(e) {
			var id = $('#course').val();
			$.ajax({
				url: "../findCourseFees.php",
				method: "post",
				data: {
					'id': id
				},
				success: function(data) {
					$('#fees').val(data);
				}
			})
		});
		$('#regno').on('focus', function(e) {
			var fromyear = $('#session').val();
			var frommonth = $('#frommonth').val();
			var courseid = $('#course').val();
			if (courseid != "" && fromyear != "") {
				$.ajax({
					url: "../findMaxRegno.php",
					method: "post",
					data: {
						'fromyear': fromyear,
						'frommonth': frommonth,
						'courseid': courseid
					},
					success: function(data) {
						$('#regno').val(data);
					}
				});
			}
		});

		function clearForm() {
			$('input[type="text"]').val('');
			$('select').val('');
			/* $(".fileinput-remove-button").click();	 */
		}
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

		$('input[type=file]').fileValidator({
			onInvalid: function(type, file) {
				$(this).val(null);
			},
			type: 'image',
			maxSize: '1m'
		});
		$('#date ,#dob').on('keypress', function(e) {
			e.preventDefault();
			return false;
		});

		function keyRestrictionForPin(e) {
			var key = e.keyCode || e.which;
			var str = document.getElementById('pin').value;
			if (key >= 48 && key <= 57 && str.length < 6) {
				return true;
			} else {
				e.preventDefault();
				return false;
			}
		}

		function keyRestrictionForMobile(e) {
			var key = e.keyCode || e.which;
			var str = document.getElementById('contact').value;
			if (key >= 48 && key <= 57 && str.length < 10) {
				return true;
			} else {
				e.preventDefault();
				return false;
			}
		}

		function keyRestrictionForSession(e) {
			var key = e.keyCode || e.which;
			var str = document.getElementById('session').value;

			if (key >= 48 && key <= 57 && str.length < 4) {
				return true;
			} else {
				e.preventDefault();
				return false;
			}
		}

		function keyRestrictionForToYear(e) {
			var key = e.keyCode || e.which;
			var str = document.getElementById('toyear').value;
			if (key >= 48 && key <= 57 && str.length < 4) {
				return true;
			} else {
				e.preventDefault();
				return false;
			}
		}

		function keyRestrictionForAadhar(e) {
			var key = e.keyCode || e.which;
			var str = document.getElementById('aadhar').value;
			if (key >= 48 && key <= 57 && str.length < 12) {
				return true;
			} else {
				e.preventDefault();
				return false;
			}
		}
		$('#pin').on('keypress', function(e) {
			keyRestrictionForPin(e);
		});
		$('')
		$('#aadhar').on('keypress', function(e) {
			keyRestrictionForAadhar(e);
		});
		$('#contact').on('keypress', function(e) {
			keyRestrictionForMobile(e);
		});
		$('#session').on('keypress', function(e) {
			keyRestrictionForSession(e);
		});
		$('#toyear').on('keypress', function(e) {
			keyRestrictionForToYear(e);
		});

		$('#admissionForm').on('submit', function(e) {
			var aadhar = $.trim($('#aadhar').val());
			var contact = $.trim($('#contact').val());
			var pin = $.trim($('#pin').val());
			var session = $.trim($('#session').val());
			var mobile1 = $.trim($('#mobile1').val());
			if (aadhar != "" && aadhar.length != 12) {
				alert("Aadhar Digit Must Be 12");
				$('#aadhar').focus();
				e.preventDefault();
				return false;
			} else if (contact != "" && contact.length != 10) {
				alert("Mobile No Digit Must Be 10");
				$('#contact').focus();
				e.preventDefault();
				return false;
			} else if (mobile1 != "" && mobile1.length != 10) {
				alert("Mobile No Digit Must Be 10");
				$('#mobile1').focus();
				e.preventDefault();
				return false;
			} else if (pin.length != 6) {
				alert("PIN CODE Length Must Be 6");
				$('#pin').focus();
				e.preventDefault();
				return false;
			} else {
				return true;
			}

		})


	});
</script>