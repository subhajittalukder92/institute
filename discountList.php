<?php
session_start();
error_reporting(0);
include('include/menu.php');
include('include/dbconfig.php');
function fetchRecords()
{
	include   ('include/dbconfig.php');	
	$from		=trim($_POST['from']);
	$to			=trim($_POST['to']);
	$sql		="SELECT `pursuing_course`.*,courses.course_fee AS fee,courses.course_name,student_info.St_Name ,
					student_info.regno
					FROM  pursuing_course
					INNER JOIN courses
					ON pursuing_course.course_id=courses.course_id
					INNER JOIN student_info
					ON pursuing_course.student_id=student_info.Student_Id
					WHERE pursuing_course.current_status='PURSUING'
				";
	$res	   = mysqli_query($conn,  $sql);
	$no        = 0;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
				<td style="text-align:center;">'.++$no.'</td>
				<td style="text-align:center;">'.$row['date'].'</td>
				<td style="text-align:center;">'.$row['St_Name'].'</td>
				<td style="text-align:center;">'.$row['regno'].'</td>
				<td style="text-align:center;">'.$row['course_name'].'</td>
				<td style="text-align:center;">'.$row['fee'].'</td>
				<td style="text-align:center;">'.$row['course_fee'].'</td>
				<td style="text-align:center;">'.($row['fee']-$row['course_fee']).'</td>
			</tr>';
	}
}

?>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">DISCOUNT LIST</h3>
					<table ID="example" class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">DATE			</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME 	</th>
							<th style="text-align:center;font-size:12px;">REGISTRATION NO</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME 	</th>
							<th style="text-align:center;font-size:12px;">ACTUAL FEE	</th>
							<th style="text-align:center;font-size:12px;">FINAL FEE 	</th>
							<th style="text-align:center;font-size:12px;">DISCOUNT		</th>
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
	 var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis','print' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );

});
</script>