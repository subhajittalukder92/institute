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
	$session=trim($_POST['session']);
	$course=trim($_POST['course']);
	$month=trim($_POST['month']);
	if($month !="")
	{
	$sql="SELECT student_info.*,pursuing_course.*,courses.*
		FROM `student_info`
		INNER JOIN pursuing_course 
		ON student_info.Student_Id=pursuing_course.student_id
		INNER JOIN courses
		ON courses.course_id=pursuing_course.course_id
		WHERE pursuing_course.course_id='$course' AND pursuing_course.starting_month='$month' 
		AND pursuing_course.session_code='$session'";
	}
	else{
		$sql="SELECT student_info.*,pursuing_course.*,courses.*,payment.*
		FROM `student_info`
		INNER JOIN pursuing_course 
		ON student_info.Student_Id=pursuing_course.student_id
		INNER JOIN courses
		ON courses.course_id=pursuing_course.course_id
		WHERE pursuing_course.course_id='$course'
		AND pursuing_course.session_code='$session'";
	}
		/* echo $sql; */
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
					<td style="text-align:center">'.$row['DOA'].'</td>
					<td style="text-align:center">'.$row['course_name'].'</td>
					<td style="text-align:center">'.$row['St_Name'].'</td>
					<td style="text-align:center">'.date('d-m-Y',strtotime($row['DOB'])).'</td>
					<td style="text-align:center">'.$row['Fathers_Name'].'</td>
					<td style="text-align:center">'.$row['Mothers_Name'].'</td>
					<td style="text-align:center">'.$row['Vill'].'</td>
					<td style="text-align:center">'.$row['Post'].'</td>
					<td style="text-align:center">'.$row['PS'].'</td>
					<td style="text-align:center">'.$row['Dist'].'</td>
					<td style="text-align:center">'.$row['Pin'].'</td>
					<td style="text-align:center">'.$row['Contact_no'].'</td>
					<td style="text-align:center">'.$row['contact2'].'</td>
					<td style="text-align:center">'.$row['mstatus'].'</td>
					<td style="text-align:center">'.$row['aadhar'].'</td>
					<td style="text-align:center">'.$row['qualification'].'</td>
					<td style="text-align:center">'.$row['Student_Occupation'].'</td>
					<td style="text-align:center">'.$row['fathers_occupation'].'</td>
									
				</tr>
			
			';
		}
	}
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
							<th style="text-align:center;font-size:12px;">DOA</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME 	</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME 	</th>
							<th style="text-align:center;font-size:12px;">DOB 	</th>
							<th style="text-align:center;font-size:12px;">FATHER'S NAME 	</th>
							<th style="text-align:center;font-size:12px;">MOTHER'S NAME 	</th>
							<th style="text-align:center;font-size:12px;">VILL	</th>
							<th style="text-align:center;font-size:12px;">POST	</th>
							<th style="text-align:center;font-size:12px;">PS	</th>
							<th style="text-align:center;font-size:12px;">DIST	</th>
							<th style="text-align:center;font-size:12px;">PIN	</th>
							<th style="text-align:center;font-size:12px;">CONTACT-1	</th>
							<th style="text-align:center;font-size:12px;">CONTACT-2	</th>
							<th style="text-align:center;font-size:12px;">MARITIAL STATUS	</th>
							<th style="text-align:center;font-size:12px;">AADHAR NO	</th>
							<th style="text-align:center;font-size:12px;">QUALIFICATION	</th>
							<th style="text-align:center;font-size:12px;">APLICANT OCCUPATION	</th>
							<th style="text-align:center;font-size:12px;">FATHER'S OCCUPATION	</th>
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
	
    var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'print' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
		
/* 	$('#example').Tabledit({
		url:"action.php",
		 buttons: {
				edit: {
					class : 'btn btn-xs btn-info',
					action : 'edit'
					}
		 },
		columns:{
			identifier:[1,"Student_Id"],
			editable:[[4,'St_Name'],[5,'Fathers_Name'],[6,'Mothers_Name'],[7,'Vill'],[8,'Post'],[9,'PS'],[10,'Dist'],[11,'Pin'],[12,'Contact_no'],[13,'contact2'],[14,'mstatus'],[15,'aadhar'],[16,'qualification'],[17,'Student_Occupation'],[18,'fathers_occupation']]
			},
			restoreButton:false,
			deleteButton:false,
			onSuccess:function(data,status,jqXHR)
			{
				if(data.action == "delete")
				{
					
					if(data.result == "success")
					{
						$('#'+ data.course_id).remove();
					}
					else if(data.result == "failed")
					{
						
						alert("ERROR: Unable To Delete.Try Again !")
					}
					else if(data.result == "invalid")
					{
						$('#myModal').modal('show');
					}
					
				}
			}
		
	}); */
		
	});
		
</script>