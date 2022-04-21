<?php 
session_start();

?>
<?php include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Day Book</h3>
				<form method="post" id="createTeacherForm" action="daybookreport.php" enctype="multipart/form-data">
					
					<div class="form-group">
						<label> From Date</label>
						 <div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="date1" id="date1" value="" required autocomplete="off">
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>

					</div>
					<div class="form-group">
						<label> To Date</label>
						 <div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="date2" id="date2" value="" required autocomplete="off">
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
