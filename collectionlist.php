<?php 
session_start();
error_reporting(0);
include "include/dbconfig.php";
include "include/check-login.php";
$totalCollection=0;
function findAdmissionReord()
{
	include "include/dbconfig.php" ;
	global $totalCollection;
	$from=trim($_POST['date1']);
	$to=trim($_POST['date2']);
	$course=trim($_POST['coursename']);
	if($course=="ALL")
	{
		$sql="SELECT payment.*, courses.* FROM `payment`
			INNER JOIN courses
			ON courses.course_id=payment.course_id
			WHERE payment.date
			BETWEEN '$from' AND '$to' 
			" ;
		
	}
	else{
			$sql="SELECT payment.*, courses.* FROM `payment`
			INNER JOIN courses
			ON courses.course_id=payment.course_id
			WHERE payment.date
			BETWEEN '$from' AND '$to' AND payment.course_id='$course'
			
			" ;
	}
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	$no=0;
	$sum=0;
	while($row=mysqli_fetch_assoc($res))
	{
		$date=strtotime($row['date']);
		$date=date('d-m-Y',$date);
		$date=str_replace('-','/',$date);
		echo '<tr>
				<td style="text-align:center">'.++$no.					'</td>
				<td style="text-align:center">'.$date.					'</td>
				<td style="text-align:center">'.$row['course_name'].	'</td>
				<td style="text-align:center">'.$row['payment_type'].	'</td>
				<td style="text-align:center">'.($row['payment_amt']+$row['fine_charge']).	'</td>
				<td style="text-align:center">'.$row['payby'].			'</td>
				<td style="text-align:center">'.$row['cheque_no'].		'</td>
			</tr>
	   
	   ';
	  $totalCollection= $totalCollection + $row['payment_amt'] + $row['fine_charge'];
	      
	}
	
}

		 
?>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Course Wise Admission Record</h3>
			
					<table id="example" class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">DATE			</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME 	</th>
							<th style="text-align:center;font-size:12px;">PAYMENT TYPE 	</th>
							<th style="text-align:center;font-size:12px;">AMOUNT</th>
							<th style="text-align:center;font-size:12px;">PAY BY</th>
							<th style="text-align:center;font-size:12px;">CHEQUE NO</th>
						</thead>
						<tbody>
							<?php findAdmissionReord(); ?>
							
						</tbody>
					</table>
						<table class="table table-bordered">
						<tr>
						<td>
						<?php echo "<b>Total Collection : </b>".$totalCollection." <i class='fa fa-inr'></i>" ;?>
						</td>
						</tr>
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
$(document).ready(function() {
	
    var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis','print' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
		

		
		} );
</script>