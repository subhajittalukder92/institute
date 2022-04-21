<?php
session_start();
//error_reporting(0);
include('include/menu.php');
include('include/dbconfig.php');
if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid'])
{
	$success_msg=null;
	$error_msg	=null;
	if(isset($_POST['mobile']))
	{
		 $value = $_POST['mobile'] ;
	
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
function getNumbers()
{
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `contact_list` ORDER BY `member_name`";
	$res=mysqli_query($conn,  $sql);
	$option='';
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$option.='<option value="'.$row['contact'].'">'.$row['member_name'].' ( '.$row['contact'].' )</option>';
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
				<div class="col-md-4 col-sm-4 col-xs-12">
					<label>Mobile Number</label>
					<input type="text" class="form-control" name="mobile" id="mobile" maxlength="10">
				</div>

				<div class="col-md-4 col-sm-4col-xs-12">
					
				</div>
				<div class="col-md-4 col-sm-4col-xs-12">
					
				</div>
				<p>&nbsp;</p>
			<div class="col-md-12 col-sm-12">
				<div class="box box-info">
				<!-- /.box-header -->
				<div class="box-body pad">
					 <label>Message (500 Charecters)</label>
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
	


});
</script>