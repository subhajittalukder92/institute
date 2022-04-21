<?php 
session_start();
include "include/no-cache.php";
include "include/dbconfig.php";
include "include/check-login.php";
if(isset($_POST['submit']))
{
	$address=mysqli_real_escape_string($conn,strtoupper(trim($_POST['address'])));
	$po		=strtoupper(trim($_POST['po']));
	$ps		=strtoupper(trim($_POST['ps']));
	$pin	=trim($_POST['pin']);
	$district=trim($_POST['district']);
	$sql="INSERT INTO `adress`(`address`, `po`, `pin`, `ps`,`district`) 
		  VALUES ('$address','$po','$pin','$ps','$district')";
	$res=mysqli_query($conn,  $sql);
	if($res)
	{
		echo "<script>alert('Address Saved Successfully. Thank You !')</script>";
	}
	else{
		echo "<script>alert('ERROR : UNABLE TO SAVE!')</script>";
	}
}
?>
<?php include "include/menu.php";
?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Address Entry</h3>
				<form method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
					
					<div class="form-group">
							<label>Address</label>
							<input type="text" class="form-control" name="address" id="address" required>

					</div>
					<div class="form-group">
							<label>P.O</label>
							<input type="text" class="form-control" name="po" id="po" required>

					</div>
					<div class="form-group">
							<label>P.S</label>
							<input type="text" class="form-control" name="ps" id="ps" required>

					</div>
					<div class="form-group">
							<label>PIN</label>
							<input type="text" class="form-control" name="pin" id="pin" required>

					</div>
					<div class="form-group">
							<label>DISTRICT</label>
							<input type="text" class="form-control" name="district" id="district" required>

					</div>
					<div class="form-group">
                        	 <button type="submit" name="submit" id="submit" class="btn btn-info btn-md btn-block" value="null">Submit</button>
                    </div>
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