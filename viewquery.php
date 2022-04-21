<?php
session_start();
error_reporting(0);
include('include/menu.php');
include('include/dbconfig.php');

function fetchRecords()
{
	include   ('include/dbconfig.php');	
	$sql		=	"SELECT courses.*, contact_list.* FROM `contact_list`
					INNER JOIN courses
					ON contact_list.query_course=courses.course_id
					ORDER BY contact_list.`status`
				";
				
	$res	   = mysqli_query($conn,  $sql);
	$no        = 0;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
			<td style="text-align:center;">'.++$no.'</td>
			<td style="text-align:center;">'.$row['student_name'].'</td>
			<td style="text-align:center;">'.$row['dob'].'</td>
			<td style="text-align:center;">'.$row['gurdian'].'</td>
			<td style="text-align:center;">'.$row['course_name'].'</td>
			<td style="text-align:center;">'.$row['contact1'].'</td>
			<td style="text-align:center;">'.$row['contact2'].'</td>
			<td style="text-align:center;">'.$row['previous_course'].'</td>
			<td style="text-align:center;">'.printStatus($row['status']).'</td>
		
			</tr>';
	}
}
function printStatus($status)
{
	if($status == 1)
	{
		return "PURSUING";
	}
	else{
		return "WAITING...";
	}
}

 
 ?>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Query Students</h3>
					<table class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME 	</th>
							<th style="text-align:center;font-size:12px;">DOB 	</th>
							<th style="text-align:center;font-size:12px;">GURDIAN 	</th>
							<th style="text-align:center;font-size:12px;">INTERESTED IN COURSE 	</th>
							<th style="text-align:center;font-size:12px;">CONTACT-1		</th>
							<th style="text-align:center;font-size:12px;">CONTACT-2		</th>
							<th style="text-align:center;font-size:12px;">PREVIOUS COURSE		</th>
							<th style="text-align:center;font-size:12px;">STATUS		</th>
						</thead>
						<tbody>
							<?php fetchRecords();?>
						</tbody>
					</table>

		
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
	function calculate()
	{
		var amount=parseFloat($.trim($('#amount').val())) || 0;
		var fine  =parseFloat($.trim($('#fine').val())) || 0;
		$('#total').val((amount + fine));
	}
	$('#amount').on('keyup',function(e){
		calculate();
	});
	$('#fine').on('keyup',function(e)
	{
		calculate();
	});
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
	$('#back').on('click',function(e)
	{
		window.location="collectform.php";
	});
});
</script>