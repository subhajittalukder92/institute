<?php 
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php');
if(isset($_POST['submit']))
{
	$date		= trim($_POST['date']);
	$bankamount	= trim($_POST['cash']);
	$cashamount	= -($bankamount);
	$particular = "DEPOSITED TO BANK";
	$todayBtn	= "BANK";
	$type		= "EXPENSE";
	$user		=strtoupper($_SESSION['userid']);
	$sql		= "INSERT INTO `daybook`(`user_id`, `date`, `particulars`, `cash`, `bank`, `to`, `type`)
				   VALUES('$user','$date','$particular','$cashamount','$bankamount','BANK','$type')";
	$res		=mysqli_query($conn,  $sql);
	if($res)
	{
		echo "
				<script>alert('Successfully Saved');</script>
			";
	}
	else{
		echo "
				<script>alert('ERROR: Unable To Submit');</script>
			";
	}
}
?>
<?php include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Deposit Cash</h3>
				<form method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Cash Amount<span class="required"></span></label>
						<input type="text"  id="cash" name="cash" class="form-control"   required>
					</div>
					<div class="form-group">
						<label>Date</label>
						 <div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="date" id="date" value="" required>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>

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
<script type="text/javascript">
$(document).ready(function(e){
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
});
</script>

 