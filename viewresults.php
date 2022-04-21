<?php 
session_start();
include('include/check-login.php');
error_reporting(0);
function encryptIt( $var )
{
    $cryptKey  = 'qJcB0rGtjk89Q2r54G03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $var, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}
function fetchRecords()
{
	include "include/dbconfig.php" ;
	$examid=$_GET['examname'];
	$course=$_GET['course'];
	$sql="SELECT student_info.*,pursuing_course.*,courses.*
		FROM `student_info`
		INNER JOIN pursuing_course 
		ON student_info.Student_Id=pursuing_course.student_id
		INNER JOIN courses
		ON courses.course_id=pursuing_course.course_id
		INNER JOIN answer_record
		ON answer_record.student_id=pursuing_course.student_id
		WHERE pursuing_course.course_id='$course' AND answer_record.exam_id='$examid'
		GROUP BY answer_record.student_id
		";
	
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{$no=0;
		while($row=mysqli_fetch_assoc($res))
		{
			
			echo '
				<tr>
					<td style="text-align:center">'.++$no.'</td>
					<td style="text-align:center">'.$row['Student_Id'].'</td>
					<td style="text-align:center">'.$row['regno'].'</td>
					<td style="text-align:center">'.$row['St_Name'].'</td>
					<td style="text-align:center">'.getResult($row['Student_Id'],$examid).'</td>
					<td style="text-align:center"><a target="_blank" href="viewdetail.php?stid='.$row['Student_Id'].'&examid='.$examid.'&regno='.$row['regno'].'">View Detail</a></td>
				</tr>
			
			';
		}
	}
}
function typeCheck()
{
	if($_SESSION['login_type'] != "Administrator")
	{
		return " disabled";
	}
}
function getResult($studentid,$examid)
{
	include "dbconfig.php";
	$sql="SELECT COUNT(*) AS rightans FROM question_info
		LEFT JOIN answer_record
		ON question_info.id=answer_record.q_id
		WHERE question_info.exam_id='$examid' AND answer_record.student_id='$studentid'
		AND question_info.answer=answer_record.answr";
	$res=mysqli_query($conn,  $sql);
	$row=mysqli_fetch_assoc($res);
	return (2 * $row['rightans']) ;
	
}

?>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row ">
		 <h3 class="page-header">STUDENT INFORMATION</h3>
		 
		 <div class="col-md-12 col-sm-12 column" style="overflow-x:auto;">
	         
			
					<table id="example" class="table table-sm table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">STUDENT ID		</th>
							<th style="text-align:center;font-size:12px;">REGISTRATION NO</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME 	</th>
							<th style="text-align:center;font-size:12px;">MARKS 	</th>
							<th style="text-align:center;font-size:12px;"> VIEW	</th>
						</thead>
						<tbody>
							<?php fetchRecords(); ?>
							
						</tbody>
					</table>
					
		  		<!-- /col-md-6 -->
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
	 	<!-- /row -->
      </div>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
      </div>
			</div>
		</div>
		 <div class="clearfix"></div>
	</div>
</div>
</div>
<style>

</style>
<?php include('include/footer.php'); ?>
</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
 $('#example').DataTable( {
        dom: 'Bfrtip',
		paging:false,
        buttons: [
		 'print',
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
			{
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4 ]
                }
            },
            'colvis'
        ]
    } );
 
		

	});
		
</script>