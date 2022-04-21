<?php
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php'); 
include "functions.php";
$success_msg=null;
$error_msg=null;
if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid'])
{
$sname			=strtoupper(trim($_POST['sname']));
$fname			=strtoupper(trim($_POST['fname']));
$mname			=strtoupper(trim($_POST['mname']));
$address		=strtoupper(trim($_POST['address']));
$po				=strtoupper(trim($_POST['po']));
$ps				=strtoupper(trim($_POST['ps']));
$district		=strtoupper(trim($_POST['district']));
$gender			=trim($_POST['gender']);
$querystudent	=trim(isset($_POST['querystudent']) ? $_POST['querystudent'] : "");
$dob			=strtoupper(trim($_POST['dob']));
$nationality	=strtoupper(trim($_POST['nationality']));
$mstatus		=strtoupper(trim($_POST['mstatus']));
$religion		=strtoupper(trim($_POST['religion']));
$caste			=strtoupper(trim($_POST['caste']));
$pin			=strtoupper(trim($_POST['pin']));
$contact		=strtoupper(trim($_POST['contact']));
$contact1		=strtoupper(trim($_POST['mobile1']));
$aadhar			=strtoupper(trim($_POST['aadhar']));
$occupation		=strtoupper(trim($_POST['occupation']));
$foccupation	=strtoupper(trim($_POST['foccupation']));
$session		=strtoupper(trim($_POST['session']));
$qualification	=strtoupper(trim($_POST['qualification']));
$course			=strtoupper(trim($_POST['course']));
$fees			=strtoupper(trim($_POST['fees']));
$date			=strtoupper(trim($_POST['date']));
$paidamt		=strtoupper(trim($_POST['paidamt']));
/* $regno1			=strtoupper(trim($_POST['regno'])); */
$chequeno		=strtoupper(trim($_POST['chequeno']));
$prevcourse		=strtoupper(trim($_POST['prevcourse']));
$previnstitute	=strtoupper(trim($_POST['previnstitute']));

$stid			=findMaxID($session);
	$value = '';
	if(isset($_POST['courseday']))
	{
		
		 foreach($_POST["courseday"] as $row)
		 {
		  $value .= $row . ',';
		 }
		 $value=rtrim($value,',');
	
	}
	
	 if($value!="")
	 {
		$courseday=explode(',' ,$value);
	 }

$payby			=strtoupper(trim($_POST['payby']));
$frommonth		=trim($_POST['frommonth']);
$tomonth		=trim($_POST['tomonth']);
$toyear			=trim($_POST['toyear']);
$sessioncode	=generateSessionCode($session,$frommonth);
$coursecode		=sprintf('%0' . 3 . 's', $course);
$serialno		=findSerialNo($sessioncode,$coursecode);
$regno			=findStudentRegistraionNo($sessioncode,$coursecode);
$particulars	="ADMISSION TO ".findCourseName($course);
$sourcePath 	= $_FILES['fileToUpload']['tmp_name'];
$imagename		= $_FILES['fileToUpload']['name'];
$targetPath 	= "Student_images/" . $_FILES['fileToUpload']['name'];
move_uploaded_file($sourcePath,$targetPath);
$sql    		= "INSERT INTO `student_info`(`Student_Id`, `St_Name`, `Fathers_Name`, `DOB`, `Gender`, `Cust`, `Religion`, 
				 `Mother_Trong`, `Session1`,`session_month`,`session_code`, `Roll`, `DOA`, `Mothers_Name`, `adminslno`, `Vill`, `Post`, `PS`, `Dist`, `Pin`, 
				 `Contact_no`,`contact2`,`mstatus`, `aadhar`, `qualification`, `regno`, `fathers_occupation`,`image_name`,`previous_course`,`previous_inst`)
				  VALUES ('$stid','$sname','$fname','$dob','$gender','$caste','$religion','','$session','$frommonth','$sessioncode','',
				 '$date','$mname','','$address','$po','$ps','$district','$pin','$contact','$contact1','$mstatus','$aadhar',
				 '$qualification','$regno','$foccupation','$imagename','$prevcourse','$previnstitute')" ;

$res			=mysqli_query($conn,  $sql);
$slno			=mysqli_insert_id($conn);
		if($res)
		{
			updateQuesryListStudents($querystudent);
			if($payby=="CASH")
			{
				addIncomeToDayBook($stid,$paidamt,$course,$particulars,$date,$payby);
			}
			else{
				addIncomeToDayBook($stid,$paidamt,$course,$particulars,$date,$payby);
			}
			$pursuing_id = addStudentToPursuingTable($course,$stid,$session,$fees,$date,$sessioncode,$coursecode,$serialno,$courseday);
			addToPaymentRecord($slno,$course,$paidamt,$payby,$chequeno,$date,$stid);
			
			$success_msg = 'Addmission Successfull. Student Unique ID Is : <b>'.$stid.'</b> And Registration Number  : <b>'.$regno.'</b> <a target="_blank" href="printreceipt.php?id='.$slno.'">Click Here</a> To Print The Receipt</div>';
		}
		else{
			
			$error_msg='Error : Unable To Save ! ';
			
		}
	$_SESSION['formid']=md5(rand(0,10000000));	


}
else{
	
	$_SESSION['formid']=md5(rand(0,10000000));
}
function findMaxID($session)
{
	include "include/dbconfig.php" ;
	$studentID=null;
	if($session!="")
	{
		$sql="SELECT MAX(`Student_Id`) AS stid FROM `student_info` WHERE `Session1`='$session'";
		/* echo $sql; */
		$res = mysqli_query($conn,  $sql)	;
		$row = mysqli_fetch_assoc($res);
		if($row['stid'] == null)
		{
			$year		= (string)$session;
			$studentID  = $year."001";
			return $studentID;
		}
		else{
			$studentID	=$row['stid'] +1;
			return $studentID;
		}
	}
}
function getAddress(){
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `adress` group by `id` ORDER BY `address` ";
	$res=mysqli_query($conn,  $sql);
	$option='';
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$option.='<option value="'.$row['address'].'">'.$row['address'].'</option>';
		}
		echo $option;
	}
}
function getCourses()
{
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `courses` ORDER BY `course_name`";
	$res=mysqli_query($conn,  $sql);
	$option='';
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$option.='<option value="'.$row['course_id'].'">'.$row['course_name'].'-'.$row['description'].'</option>';
		}
		echo $option;
	}
}
function addStudentToPursuingTable($course,$studentID,$session,$fees,$date,$sessioncode,$coursecode,$serialno,$courseday)
{
	include "include/dbconfig.php" ;

	$frommonth		= trim($_POST['frommonth']);
	$tomonth		= trim($_POST['tomonth']);
	$toyear			= trim($_POST['toyear']);
	$courseday		= implode(',',$courseday);
	$sql="INSERT INTO `pursuing_course`(`session`,`date`,`student_id`, `course_id`,`course_code`, `session_code`, `serial_no`, `course_fee`, `course_days`
		 ,`starting_year`, `starting_month`, `complete_year`, `complete_month`)
		  VALUES ('$session','$date','$studentID','$course','$coursecode','$sessioncode','$serialno','$fees','$courseday','$session','$frommonth','$toyear','$tomonth')";
	$res=mysqli_query($conn,  $sql);
	$pursuing_id=mysqli_insert_id($conn);
	if($res)
	{
		return  $pursuing_id;
	}
	else{
		return false;
	}
	
}
function updateQuesryListStudents($id)
{
	include "include/dbconfig.php" ;
	$sql="UPDATE `contact_list` SET `status`='1' WHERE `id`='$id'";
	$res=mysqli_query($conn,  $sql);
	if($res)
	{
		return true;
	}
	else{
		return false;
	}
}
function findQuesryListStudents()
{
	include "include/dbconfig.php" ;
	$sql="SELECT * FROM `contact_list` WHERE `status`='0'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$option='<option value="">--Select Query Student--</option>';
		while($row=mysqli_fetch_assoc($res))
		{
			$date=strtotime($row['dob']);
			$date=date('d-m-Y',$date);
			$date=str_replace('-','/',$date);
			$option.='<option value="'.$row['id'].'">'.$row['student_name'].'-'.$row['gurdian'].'(DOB-'.$date.') </option>';
		}
		echo $option;
	}
}
?>

<?php include('include/menu.php');?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
		<div class="row">
				<br/>
		</div>
		<div id="message">
		
				
		<?php if($success_msg!=null)
			  {
				echo '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-check-circle"></i> 
				'.$success_msg.'
				</div>
				
				';
			  }
			  elseif($error_msg!=null)
			  {
				  echo '
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$error_msg.'</div>
				  ';
			  }
		
		?>
		</div>
        <div class="row">
		   <div class="col-sm-12 col-md-12 col-xs-12">
				<h4 class="page-header" style="border-color:black;">New Admission</h4>
			</div>
		</div>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ;?>" id="admissionForm" name="admissionForm" enctype="multipart/form-data" >
	<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-1 col-sm-1 col-xs-12" >Student's Name: <span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12 ">
			  <input type="text" id="sname"  name="sname" class="form-control col-md-7 col-xs-12" required>
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Father's Name<span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="fname"  name="fname" class="form-control col-md-7 col-xs-12"/>
		    </div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="mname">Mother's Name: <span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="mname"  name="mname"  class="form-control col-md-7 col-xs-12" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">Address: <span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12 ">
			  <select id="address"  name="address"  class="form-control col-md-7 col-xs-12">
			  <option value="">--Select--</option>
			  <?php getAddress();?>
			  </select>
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="po">P.O:<span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="po"  name="po"  class="form-control col-md-7 col-xs-12" />
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="ps">P.S: <span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="ps"  name="ps"  class="form-control col-md-7 col-xs-12"/>
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
	<div class="form-group">
                       <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">District: <span class=""></span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12 ">
                          <input type="text" id="district"   name="district" class="form-control col-md-7 col-xs-12">
							
						 
						</div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">PIN<span class=""></span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" id="pin"  name="pin"   class="form-control col-md-7 col-xs-12" />
							
						
                        </div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Gender<span class=""></span>
                        </label>
						<div class="col-md-3 col-sm-3 col-xs-12">
                         <select id="gender"  name="gender"  class="form-control col-md-7 col-xs-12" required>
								<option value="">--Select--</option>
								<option value="MALE">	MALE</option>
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
				<input class="form-control" type="text" name="dob" id="dob" autocomplete="off" required>
				<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Nationality:<span class=""></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <input type="text" id="nationality"  name="nationality" value="INDIAN"  class="form-control col-md-7 col-xs-12"/>
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer_gst">Marital Status: <span class=""></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <select id="mstatus"  name="mstatus"  class="form-control col-md-7 col-xs-12">
				<option value="">--Select--</option>
				<option value="SINGLE">Single</option>
				<option value="Married">Married</option>
		  </select>
		  
		</div>
  </div>
 </div>
<div class="row">
	<div class="form-group">
	   <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">Religion: <span class="required"></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <select id="religion"  name="religion"  class="form-control col-md-7 col-xs-12 ">
				<option value="">--Select--</option>
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
		  <select  id="caste"  name="caste"  class="form-control col-md-7 col-xs-12">
			<option value="">--Select--</option>
			<option value="GENERAL">General</option>
			<option value="SC">SC</option>
			<option value="ST">ST</option>
			<option value="OBC">OBC</option>
		 </select>
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Addhar No:<br/><font size="2" color="red"></font><span class=""></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <input type="text" id="aadhar"  name="aadhar"  class="form-control col-md-7 col-xs-12" autocomplete="off"  />
		</div>
		
     </div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Mobile No: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="contact"  name="contact" class="form-control col-md-7 col-xs-12 required" maxlength="10">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Alternate No:<br/><font size="2" color="red"></font><span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <input type="text" id="mobile1"  name="mobile1"  class="form-control col-md-7 col-xs-12" />
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Applicant's Occupation: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="occupation"  name="occupation"  class="form-control col-md-7 col-xs-12 required">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Father's Occupation:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <select id="foccupation"  name="foccupation"  class="form-control col-md-7 col-xs-12" >
				<option value="">--Select--</option>
				<option value="BUSINESS">BUSINESS</option>
				<option value="FARMER">FARMER</option>
				<option value="TEACHER">TEACHER</option>
				<option value="TAYLOR">TAYLOR</option>
				<option value="SERVICE">SERVICE MAN</option>
			  </select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Session:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<select id="session"  name="session"  class="form-control col-md-7 col-xs-12" required>
					<option value="">--Select--</value>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
					<option value="2028">2028</option>
					<option value="2029">2029</option>
					<option value="2030">2030</option>
					<option value="2031">2031</option>
					<option value="2032">2032</option>
				</select>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Qualification(Last Exam): <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="qualification"  name="qualification"  class="form-control col-md-7 col-xs-12 required">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Course:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<select  id="course"  name="course"  class="form-control col-md-7 col-xs-12" required>
					<option value="">--Select--</option>
					<?php getCourses(); ?>
				</select>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Course Fees: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="fees"  name="fees" required="required" class="form-control col-md-7 col-xs-12 required" required>
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Date: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
				<div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="date" id="date" value="<?php echo date('Y-m-d') ;?>" autocomplete="off" required>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
							
			  </div>
			  			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Amount Paid:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text"  id="paidamt"  name="paidamt"  class="form-control col-md-7 col-xs-12">
			</div>

		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Pay By:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <select  id="payby"  name="payby"  class="form-control col-md-7 col-xs-12" required>
				<option value="">--Select--</option>
				<option value="CASH">CASH  </option>
				<option value="CHEQUE">CHEQUE</option>
				<option value="CARD">  CARD   </option>
			  </select>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Course Day:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<select id="courseday" name="courseday[]" multiple class="form-control" >
					<option value="MON">MONDAY		</option>
					<option value="TUE">TUESDAY		</option>
					<option value="WED">WEDNESDAY	</option>
					<option value="THU">THURSDAY	</option>
					<option value="FRI">FRIDAY		</option>
					<option value="SAT">SATURDAY	</option>
					<option value="SUN">SUNDAY		</option>
				</select>
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Cheque No:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <input  type="text "id="chequeno"  name="chequeno"  class="form-control col-md-7 col-xs-12">
			</div>

		</div>
	</div>
	<p></p>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">From Month:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<select id="frommonth" name="frommonth" class="form-control" required>
					<option value="">--Select--	</option>
					<option value="1">JANUARY		</option>
					<!--<option value="2">FEBRUARY	</option>
					<option value="3">MARCH			</option>-->
					<option value="4">APRIL			</option>
					<!--<option value="5">MAY				</option>
					<option value="6">JUNE			</option>-->
					<option value="7">JULY			</option>
					<!--<option value="8">AUGUST		</option>
					<option value="9">SEPTEMBER	</option>-->
					<option value="10">OCTOBER		</option>
					<!--<option value="11">NOVEMBER	</option>
					<option value="12">DECEMBER	</option>-->
				</select>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress" >To Month-Year :<span class=""></span>
			</label>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<select id="tomonth" name="tomonth" class="form-control" required>
					<option value="">-- Select Month --	</option>
					<option value="1">JANUARY		</option>
					<option value="2">FEBRUARY	</option>
					<option value="3">MARCH			</option>
					<option value="4">APRIL			</option>
					<option value="5">MAY				</option>
					<option value="6">JUNE			</option>
					<option value="7">JULY			</option>
					<option value="8">AUGUST		</option>
					<option value="9">SEPTEMBER	</option>
					<option value="10">OCTOBER		</option>
					<option value="11">NOVEMBER	</option>
					<option value="12">DECEMBER	</option>
				</select>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<select  id="toyear" name="toyear" class="form-control" placeholder="To Year" required>
					<option value="">--Select Year--</value>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
					<option value="2028">2028</option>
					<option value="2029">2029</option>
					<option value="2030">2030</option>
					<option value="2031">2031</option>
					<option value="2032">2032</option>
				</select>

			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Student From Query List:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<select  id="querystudent"  name="querystudent"   class="selectpicker form-control"  data-live-search="true">
					<?php findQuesryListStudents();?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Image:<span class=""></span>
				</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<input type="file"  id="fileToUpload"  name="fileToUpload"  class="form-control">
				</div>
		</div>
		</div>
	
	</div>
	<p></p>

	<div class="row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Previous Course<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text"  id="prevcourse"  name="prevcourse" class="form-control" >

			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Institute Name<span class=""></span>
				</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text"  id="previnstitute"  name="previnstitute"  class="form-control">
				</div>
	</div>
	<p><br/></p>
	<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-offset-4 col-sm-4 col-xs-12">
				<input type="submit"  id="submit"  name="submit"  value="Submit Now" class="form-control btn btn-info col-md-7 col-xs-12"><br/>
				<p><br/></p>
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
var datas=$("#admissionForm").serialize();
				
	
 $('#stid').on('focus',function(e){
	 var session=$('#session').val();
	 
	 $.ajax(
		{
		url:'findmaxId.php',
		type:'post',
		data:{'session':session},
		success:function(data)
		{
			if(data)
			{
				 $('#stid').val(data); 
							
			}
		},
		
		});		
 });
  $('#address').on('change',function(e){
	 var address=$('#address').val();
	 
	 $.ajax(
		{
		url:'findAddress.php',
		type:'post',
		data:{'address':address},
		dataType:"json",
		success:function(data)
		{
			if(data)
			{
				 $('#po').val(data.po); 
				 $('#pin').val(data.pin); 
				 $('#ps').val(data.ps); 
				 $('#district').val(data.dist); 
							
			}
		},
		
		});		
 });
 $('#course').on('change',function(e){
	var courseid=$('#course').val();
	 $.ajax({
		 url:"findCourseFees.php",
		 method:"post",
		 data:{'courseid':courseid},
		 success:function(data)
		 {
			 $('#fees').val(data);
		 }
	 })
 });
 $('#regno').on('focus',function(e){
	  var fromyear = $('#session').val();
	  var frommonth= $('#frommonth').val();
	  var courseid = $('#course').val();
	  if( courseid!="" &&  fromyear!="" )
	  {
		  $.ajax({
				url:"findMaxRegno.php",
				method:"post",
				data:{'fromyear':fromyear,'frommonth':frommonth,'courseid':courseid},
				success:function(data)
				{
					$('#regno').val(data);
				}
			});
	  }
  });
	
function clearForm()
{
	$('input[type="text"]').val('');
	$('select').val('');
	/* $(".fileinput-remove-button").click();	 */
}		    
$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
 $('#courseday').multiselect({
			   nonSelectedText:'Select Day',
			   enableFiltering:true,
			   enableCaseInsensitiveFiltering:true,
			   buttonWidth:'315px',
			   
			   });
$('input[type=file]').fileValidator({
  onInvalid:    function(type, file){ $(this).val(null); },
  type:        'image',
  maxSize:      '1m'
});
$('#date ,#dob').on('keypress',function(e){
		e.preventDefault();
		return false;
});
function keyRestrictionForPin(e)
{
	   var key = e.keyCode || e.which;
	   var str=document.getElementById('pin').value;
	   if(key >=48 && key<=57 && str.length<6)
	   {
		   return true;
	   }
	   else{
		  e.preventDefault();
		  return false;
	   }
}
function keyRestrictionForMobile(e)
{
	   var key = e.keyCode || e.which;
	   var str=document.getElementById('contact').value;
	   if(key >=48 && key<=57 && str.length<10)
	   {
		   return true;
	   }
	   else{
		  e.preventDefault();
		  return false;
	   }
}
function keyRestrictionForSession(e)
{
	   var key = e.keyCode || e.which;
	   var str=document.getElementById('session').value;

	   if(key >=48 && key<=57 &&  str.length< 4 )
	   {
		   return true;
	   }
	   else{
		  e.preventDefault();
		  return false;
	   }
}
function keyRestrictionForToYear(e)
{
	   var key = e.keyCode || e.which;
	   var str=document.getElementById('toyear').value;
	   if(key >=48 && key<=57 && str.length<4)
	   {
		   return true;
	   }
	   else{
		  e.preventDefault();
		  return false;
	   }
}
function keyRestrictionForAadhar(e)
{
	   var key = e.keyCode || e.which;
	   var str=document.getElementById('aadhar').value;
	   if(key >=48 && key<=57 && str.length<12)
	   {
		   return true;
	   }
	   else{
		  e.preventDefault();
		  return false;
	   }
}
$('#pin').on('keypress', function(e){
	keyRestrictionForPin(e);
});
$('')
$('#aadhar').on('keypress', function(e){
	keyRestrictionForAadhar(e);
});
$('#contact').on('keypress', function(e){
	keyRestrictionForMobile(e);
});
$('#session').on('keypress', function(e){
	keyRestrictionForSession(e);
});
$('#toyear').on('keypress', function(e){
	keyRestrictionForToYear(e);
});

$('#admissionForm').on('submit',function(e)
{
	var aadhar=$.trim($('#aadhar').val());
	var contact=$.trim($('#contact').val());
	var pin=$.trim($('#pin').val());
	var session=$.trim($('#session').val());
	var mobile1=$.trim($('#mobile1').val());
	if(aadhar!="" && aadhar.length != 12)
	{
		alert("Aadhar Digit Must Be 12");
		$('#aadhar').focus();
		e.preventDefault();
		return false;
	}
	else if(contact!="" && contact.length != 10)
	{
		alert("Mobile No Digit Must Be 10");
		$('#contact').focus();
		e.preventDefault();
		return false;
	}
	else if(session.length != 4)
	{
		alert("Session Must Be 4 Digit");
		$('#session').focus();
		e.preventDefault();
		return false;
	}
	else if(mobile1 !="" && mobile1.length != 10)
	{
		alert("Mobile No Digit Must Be 10");
		$('#mobile1').focus();
		e.preventDefault();
		return false;
	}
	else if(pin.length != 6)
	{
		alert("PIN CODE Length Must Be 6");
		$('#pin').focus();
		e.preventDefault();
		return false;
	}
	else{
		return true;
	}
	
})
    
   
});     
</script>
