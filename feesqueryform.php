<?php 
session_start();
include('include/check-login.php');
error_reporting(0);

function  getFranchise()
{
	include('include/dbconfig.php');
	$option = '';
	$sql = "SELECT * FROM `franchises`";
	$res = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$option .= '<option value="' . $row['id'] . '">' . $row['franchise_name'] . '</option>';
	}
	echo $option;
}
function getSession()
{
	include "include/dbconfig.php" ;
	$sql="SELECT * FROM `session`";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			echo '<option value="'.$row['session_code'].'">'.$row['session_code']."-".$row['description'].'</option>';
		}
	}
}
include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Fees Due Report </h3>
				<form method="post" id="createTeacherForm" action="feesquery.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Franchise Name<span class="required"></span></label>
						<select name="franchise" id="franchise" class="selectpicker form-control" data-live-search="true" required>
							<option value="">Select Franchise</option>
							<?php getFranchise(); ?>
						</select>
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