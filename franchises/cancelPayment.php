<?php 
session_start();
error_reporting(0);
include('include/no-cache.php');
include('include/dbconfig.php');
include('include/check-login.php');
if(isset($_POST['submit']))
{
extract($_POST);
	
	$sql1= "DELETE FROM `payment` WHERE `receipt_id`='$recpt_no'";
	$sql2= "DELETE FROM `daybook` WHERE `receipt_id`='$recpt_no'";
	$sql3= "DELETE FROM `note_info` WHERE `receipt_id`='$recpt_no'";
	$sql4= "DELETE FROM `receipts` WHERE `id`='$recpt_no'";
	$res1 = mysqli_query($conn,  $sql1);
	
	if($res1)
	{
		$res2=mysqli_query($conn,  $sql2);
		if($res2)
		{
			$res3=mysqli_query($conn,  $sql3);
			if($res3)
			{
					$res4=mysqli_query($conn,$sql4);
					echo '<script>alert("Cancel Complete !") </script>';
			}
			else{
				echo '<script>alert("ERROR-3 : OPERATION FAILED !") </script>';
			}
		}
		else{
				echo '<script>alert("ERROR-2 : OPERATION FAILED !") </script>';
			}
	}
	else{
		echo '<script>alert("ERROR-1 : OPERATION FAILED !") </script>';
	}
}
function  getReceipts()
{
	include('include/dbconfig.php'); 
	$option='';
	$sql="SELECT * FROM `receipts` WHERE franchise_id='{$_SESSION['franchise_id']}' GROUP BY `id`";
	$res=mysqli_query($conn,  $sql)        ;
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option value="'.$row['id'].'">'.$row['receipt_no'].'</option>';
	}
	echo $option;
}
?>
<?php include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Cancel Payment</h3>
				<form method="POST" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Receipt No<span class="required"></span></label>
						<select name="recpt_no"  id="recpt_no" class="selectpicker form-control"  data-live-search="true" required>
							<option value="">--Select--</option>
							<?php getReceipts();?>
						</select>
					</div>
					<div class="form-group">
                        	 <button type="submit" name="submit" id="submit" class="btn btn-info btn-md btn-block" value="null">Cancel Now</button>
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
<script type="text/javascript">
$(document).ready(function(e){
	$('#studentid').on('change',function(e)
	{
		var studentid = $(this).val();
		$.ajax({
			url:"../loadCourse.php",
			method:"post",
			data:{'studentid':studentid},
			success:function(data)
			{
				$('#pursuingcourse').html(data);
			}
			
		});
	
	});
	$('form').on('submit',function(e){
		var ress = confirm("Are You Sure To Delete This Receipt No ??");
		if(ress)
		{
			return true;
		}
		else{
			e.preventDefault();
			return false;
		}
	});
});
</script>

 