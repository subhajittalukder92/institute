<?php
session_start();
//error_reporting(0);
include('include/menu.php');
include('include/check-login.php');
include('include/dbconfig.php');
if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid'])
{
	$password=trim($_POST['cnfpassword']);
	$userid=$_SESSION['userid'];
	$success_msg=null;
	$error_msg=null;
	
	$sql="UPDATE `user_info` SET `password`='$password' WHERE `user_name`='$userid'";
	if(mysqli_query($conn,  $sql))
	{
		$success_msg=" Your Password Has Been Changed Successfully !";
	}
	else{
		$error_msg=" Error Occured While Changing Password";
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
	        <h3 class="page-header">Privacy Setting</h3>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
			<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<label>New Password</label>
					<input type="password" name="password" id="password" class="form-control" required><br/>

				</div>
				
				<div class="col-md-4 col-sm-4col-xs-12">
					<label>Confirm Password</label>
					<input type="password" name="cnfpassword" id="cnfpassword" class="form-control" required>
					</div>
				<div class="col-md-4 col-sm-4col-xs-12">
					<label>&nbsp;</label>
						<input type="submit" name="submit" value="Save Now" id="submit" class="form-control btn btn-info">
				</div>

				<p>&nbsp;</p>
			
						<br/>
						
		</form>
		
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

	 $('form').on('submit',function(e)
	 {
		if($('#password').val()!= $('#cnfpassword').val())
		{
			alert("WARNING : New Password And Confirm Password Doesn't Match");
			e.preventDefault();
			return false;
		}
		else{
			return true;
		}
				
		 	
	});
		 

});
</script>