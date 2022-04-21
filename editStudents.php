<?php 
session_start();
include('include/check-login.php');
error_reporting(0);

if($_SESSION['login_type'] != "Administrator")
{
	
	echo '<script>alert("You Dont Have Permission To Access This Page. Thanks For Trying !!");window.location.assign("studentsinfo.php");</script>';
}
if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid']== $_SESSION['formid'])
{
	saveRecords();
	
	$_SESSION['formid']=md5(rand(0,999999));
}
else{
	$_SESSION['formid']=md5(rand(0,999999));
}
function saveRecords()
{
include "include/dbconfig.php";
$St_Name	     = mysqli_real_escape_string($conn,strtoupper(trim($_POST["St_Name"])));
$Fathers_Name	 =strtoupper(trim($_POST["Fathers_Name"]));
$Mothers_Name	 =strtoupper(trim($_POST["Mothers_Name"]));
$Vill	 		 =strtoupper(trim($_POST["Vill"]));
$caste	 		 =strtoupper(trim($_POST["Cust"]));
$dob	 		 =strtoupper(trim($_POST["dob"]));
$Post	 		 =strtoupper(trim($_POST["Post"]));
$PS	 			 =strtoupper(trim($_POST["PS"]));
$Dist			 =strtoupper(trim($_POST["Dist"]));
$Pin			 =strtoupper(trim($_POST["Pin"]));
$Contact_no	 	 =strtoupper(trim($_POST["Contact_no"]));
$contact2		 =strtoupper(trim($_POST["contact2"]));
$mstatus		 =strtoupper(trim($_POST["mstatus"]));
$aadhar	 		 =trim($_POST["aadhar"]);
$qualification	 =strtoupper(trim($_POST["qualification"]));
$Student_Occupation	 =strtoupper(trim($_POST["Student_Occupation"]));
$fathers_occupation	 =strtoupper(trim($_POST["fathers_occupation"]));
$mstatus	     	 =strtoupper(trim($_POST["mstatus"]));
$id					 =trim($_POST["Student_Id"]);
$sql		="UPDATE `student_info` SET `St_Name`='$St_Name',`Fathers_Name`='$Fathers_Name',
			`DOB`='$dob',`Cust`='$caste',
			`Mothers_Name`='$Mothers_Name',
			`Vill`='$Vill',`Post`='$Post',`PS`='$PS',`Dist`='$Dist',`Pin`='$Pin',`Contact_no`='$Contact_no',
			`contact2`='$contact2',`mstatus`='$mstatus',`aadhar`='$aadhar',`qualification`='$qualification',
			 `fathers_occupation`='$fathers_occupation',`Student_Occupation`='$Student_Occupation'
			 WHERE `Student_Id`='$id'";
			/*  echo $sql; */
$res		=mysqli_query($conn,  $sql);
if($res)
{
	
		echo"<script>
			
			alert('Update Successful.');
			</script>
			 ";
	
}
else{
	echo"<script>
			
			alert('Sorry ! There Is A Problem.');
			</script>";
}

}
function decryptIt( $var )
{
    $cryptKey  = 'qJcB0rGtjk89Q2r54G03efyCp';
    $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $var ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}
function fetchRecords()
{
	include "include/dbconfig.php" ;
	$id		=trim(decryptIt($_GET['id']));
	
	$sql	="SELECT student_info.*,pursuing_course.*,courses.*
			FROM `student_info`
			INNER JOIN pursuing_course 
			ON student_info.Student_Id=pursuing_course.student_id
			INNER JOIN courses
			ON courses.course_id=pursuing_course.course_id
			WHERE pursuing_course.student_id='$id'";
	$res	=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$no=0;
		while($row=mysqli_fetch_assoc($res))
		{
			echo '
				<tr>
					<td style="text-align:center">Student ID</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Student_Id'].'" name="Student_Id" id="Student_Id" readonly></td>
				</tr>
				<tr>
					<td style="text-align:center">Registration Number</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['regno'].'" name="regno" id="regno" readonly></td>
				</tr>
				<tr>
				
					<td style="text-align:center">Course Name</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['course_name'].'" name="course_name" id="course_name"></td>
				</tr>
				<tr>
					<td style="text-align:center">Student Name</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['St_Name'].'" name="St_Name" id="St_Name"></td>
				</tr>
				<tr>	
		
					<td style="text-align:center">Father Name</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Fathers_Name'].'" name="Fathers_Name" id="Fathers_Name"></td>
				</tr>	
				<tr>	
					<td style="text-align:center">Mother Name</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Mothers_Name'].'" name="Mothers_Name" id="Mothers_Name"></td>
				</tr>
				<tr>	
					<td style="text-align:center">DOB (YYYY-MM-DD) </td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['DOB'].'" name="dob" id="dob"></td>
				</tr>	
				<tr>	
					<td style="text-align:center">Caste </td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Cust'].'" name="Cust" id="Cust"></td>
				</tr>	
				<tr>
					<td style="text-align:center">Village</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Vill'].'" name="Vill" id="Vill"></td>
				</tr>	
				<tr>
					<td style="text-align:center">POST</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Post'].'" name="Post" id="Post"></td>
				</tr>	
				<tr>
					<td style="text-align:center">Police Station</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['PS'].'" name="PS" id="PS"></td>
				</tr>	
				<tr>
					<td style="text-align:center">District</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Dist'].'" name="Dist" id="Dist"></td>
				</tr>	
				<tr>
					<td style="text-align:center">PIN</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Pin'].'" name="Pin" id="Pin"</td>
				</tr>	
				<tr>
					<td style="text-align:center">Contact No</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Contact_no'].'" name="Contact_no" id="Contact_no"</td>
				</tr>	
				<tr>
					<td style="text-align:center">Alternative No</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['contact2'].'" name="contact2" id="contact2"</td>
				</tr>	
				<tr>
					<td style="text-align:center">Maritial Status</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['mstatus'].'" name="mstatus" id="mstatus"</td>
				</tr>	
				<tr>
					<td style="text-align:center">Aadhar No</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['aadhar'].'" name="aadhar" id="aadhar"</td>
				</tr>	
				<tr>
					<td style="text-align:center">Student Qualification</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['qualification'].'" name="qualification" id="qualification"</td>
				</tr>	
				<tr>
					<td style="text-align:center">Student Occupation</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['Student_Occupation'].'" name="Student_Occupation" id="Student_Occupation"</td>
				</tr>	
				<tr>
					<td style="text-align:center">Father occupation</td>
					<td style="text-align:center"><input type="text" class="form-control" value="'.$row['fathers_occupation'].'" name="fathers_occupation" id="fathers_occupation"</td>
				</tr>
				
			';
		}
	}
}

?>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
		 <h3 class="page-header">EDIT INFORMATION</h3>
		 
		 <div class="col-md-12 col-sm-12 column" style="overflow-x:auto;">
	        <h4> <a href="studentsinfo.php"><i class="fa fa-long-arrow-left"></i> BACK</a></h4>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
			<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
					<table id="example" class="table table-striped"  >
						<thead>
							<th style="text-align:center;font-size:12px;">Attribute			</th>
							<th style="text-align:center;font-size:12px;">Value		</th>
														
						</thead>
						<tbody>
							<?php fetchRecords(); ?>
							
						</tbody>
					</table>
			
				<label>&nbsp;</label>
				<button type="submit" name="submit" id="submit" class="form-control btn btn-info"><font size="4px"><i class="fa fa-save"> </i> </font>Save  </button>
				
			</form>
					
		  		<!-- /col-md-6 -->
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
	 	<!-- /row -->
      </div>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
      </div>
			</div>
		</div>
		 <div class="clearfix"></div>
	</div>
</div>
</div>
<style>

</style>
<?php include('include/footer.php'); ?>
</body>
</html>
<script type="text/javascript">



$(document).ready(function() {
	


		
	});
	
	
</script>