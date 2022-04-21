<?php 
session_start();
error_reporting(0);
include "include/dbconfig.php";
include "include/check-login.php";

function findAdmissionReord()
{
	include "include/dbconfig.php" ;
	
	$session   = trim($_POST['session']);
	$course    = trim($_POST['coursename']);
	$franchise = trim($_POST['franchise']);
	if($course=="ALL")
	{
		$sql="SELECT COUNT(*) as NO_OF_ADMISSION,date,session, `courses`.*,pursuing_course.`session_code`,session.description FROM `pursuing_course`
			LEFT JOIN `courses`
			ON `courses`.`id` = `pursuing_course`.`course_id`
			LEFT JOIN `session`
			ON `session`.`slno` = `pursuing_course`.`session_id`
			WHERE `pursuing_course`.`session_id` = '$session' 
			AND `pursuing_course`.`franchise_id` = '$franchise'
			GROUP BY `pursuing_course`.`course_id` 
			" ;
		
	}
	else{
			$sql = "SELECT COUNT(*) as NO_OF_ADMISSION,date,session, courses.*,pursuing_course.session_code, `session`.`description` FROM `pursuing_course`
				LEFT JOIN courses
				ON `courses`.`id` = `pursuing_course`.`course_id`
				LEFT JOIN `session`
				ON `session`.`slno` = `pursuing_course`.`session_id`
				WHERE `pursuing_course`.`session_id` = '$session' AND 
				`pursuing_course`.`course_id` = '$course' AND `pursuing_course`.`franchise_id` = '$franchise'
				GROUP BY `pursuing_course`.`course_id` 
			" ;
	}
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	$no=0;
	while($row=mysqli_fetch_assoc($res))
	{
		$date=strtotime($row['date']);
		$date=date('d-m-Y',$date);
		$date=str_replace('-','/',$date);
		echo '<tr>
			<td style="text-align:center">'.++$no.					'</td>
			<td style="text-align:center">'.$row['session_code']."-".$row['description'].		'</td>
			<td style="text-align:center">'.$date.					'</td>
			<td style="text-align:center">'.$row['course_name'].	'</td>
			<td style="text-align:center">'.$row['NO_OF_ADMISSION'].'</td>
			</tr>
	    	';
	}
	
}

		
?>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Session Wise Admission Record</h3>
					<table id="example" class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">Session Code		</th>
							<th style="text-align:center;font-size:12px;">DATE			</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME 	</th>
							<th style="text-align:center;font-size:12px;">NO OF ADMISSION</th>
						</thead>
						<tbody>
							<?php findAdmissionReord();?>
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
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis','print' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} 
);
</script>