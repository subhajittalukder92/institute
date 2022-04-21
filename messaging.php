 <?php
 include('include/dbconfig.php');
session_start();
//error_reporting(0);
include('include/menu.php');

if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid'])
{
	$success_msg=null;
	$error_msg	=null;
	if(isset($_POST['mobile']))
	{
		
		 foreach($_POST["mobile"] as $row)
		 {
		  $value .= $row . ',';
		 }
		 $value=rtrim($value,',');
	
	}
	$text=trim(strip_tags($_POST['editor1']));

	
	/*  Authorisation details. */
	$username = "ritam9153@gmail.com";
$hash = "e67ee3a5d8a8425e4aa7b36dfb02f2a2d04c601c0e8628afb1c2347351272481";

	/*  Config variables. Consult http://api.textlocal.in/docs for more info. */
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "TXTLCL"; // This is who the message appears to be from.
	$numbers = $value; // A single number or a comma-seperated list of numbers
	$message = $text;
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);
	if($result)
	{
			$success_msg=" Your Messsage Has Been Sent Successfully !";
	}
	else{
			$error_msg=" Unable To Send Your Messsage !";
	}
	
	$_SESSION['formid']=md5(rand(0,10000000));	
}
else{
	$_SESSION['formid']=md5(rand(0,10000000));
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
?>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<p>&nbsp;</p>
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
	        <h3 class="page-header">Messaging</h3>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
			<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
				<div class="col-md-4 col-sm-4col-xs-12">
					<label>Select Course</label>
					<select name="course" id="course" class="form-control">
						<option value="">--Select--</option>
						<?php getCourses();?>
					</select>
				</div>

				<div class="col-md-4 col-sm-4col-xs-12">
					
				</div>
				<div class="col-md-4 col-sm-4col-xs-12">
					<label>Select Students</label>
					<select name="mobile[]" id="mobile" multiple title="No Value" class="form-control">
						
					</select>
				</div>
				<p>&nbsp;</p>
			<div class="col-md-12 col-sm-12">
				<div class="box box-info">
				<!-- /.box-header -->
				<div class="box-body pad">
					   <label for="exampleFormControlTextarea1">Messsage (500 Chars)</label>
						<textarea id="editor1" name="editor1" class="form-control" rows="10" cols="80">
							
						</textarea>
						<br/>
						<input type="submit" name="submit" value="Send Now" id="submit" class="form-control btn btn-info">
		</form>
				</div>
				</div>
			</div>
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
$(document).ready(function(e){
	
	$('#mobile').multiselect
	 ({
		   allSelectedText: 'All',
		   nonSelectedText:'Select Student',
		   enableFiltering:true,
		   enableCaseInsensitiveFiltering:true,
		   buttonWidth:'311px',
		   includeSelectAllOption: true
		   
	 });
	 $('#course').on('change',function(e){
		 var courseid = $(this).val();
		/*  alert(courseid); */
						$.ajax({
							url:"findCourseStudents.php",
							method:"post",
							data:{'courseid':courseid},
							success:function(data)
							{

								$('#mobile').html(data);
								$('#mobile').multiselect('rebuild');
								
							}	
							
						});
		 
	 });
});
</script>