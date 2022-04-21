<?php 
session_start();
include('include/check-login.php');
error_reporting(0);
function findDueRecord()
{
	include "include/dbconfig.php" ;
	$studentid=trim($_POST['studentid']);
	$courseid =trim($_POST['coursename']) ;
	/* 
	TIPS: FOR ADD SESSION CODE IN QUERY USE SESSION CODE IN INNER MOST QUERY
	*/
	if($courseid=="ALL" && $studentid=="ALL")
	{

	$sql= "
		SELECT courses.course_name,courses.description,p4.* FROM courses
		INNER JOIN 
		 (SELECT St_Name,regno,p1.*
				FROM student_info
				INNER JOIN 
				(	SELECT student_id,course_id,SUM(payment_amt) AS paidamt,course_fee,complete_month,complete_year
					FROM
					(SELECT `pursuing_course`.*,payment.payment_amt 
					FROM pursuing_course
					LEFT JOIN payment
					ON pursuing_course.student_id=payment.student_id
					WHERE pursuing_course.current_status='PURSUING')p2 
					GROUP BY p2.student_id,p2.course_id
				)p1
				ON student_info.Student_Id=p1.student_id)p4
				on p4.course_id=courses.course_id
			";
	}
	elseif($courseid =="ALL" && $studentid != "ALL")
	{
		$sql= "SELECT courses.course_name,courses.description,p4.* FROM courses
		  INNER JOIN 
		 (SELECT St_Name,regno,p1.*
				FROM student_info
				INNER JOIN 
				(	SELECT student_id,course_id,SUM(payment_amt) AS paidamt,course_fee,complete_month,complete_year
					FROM
					(SELECT `pursuing_course`.*,payment.payment_amt 
					FROM pursuing_course
					LEFT JOIN payment
					ON pursuing_course.student_id=payment.student_id
					WHERE pursuing_course.current_status='PURSUING')p2 
					GROUP BY p2.student_id,p2.course_id
				)p1
				ON student_info.Student_Id=p1.student_id)p4
				ON p4.course_id=courses.course_id
				WHERE p4.student_id='$studentid'
			";
	}
	elseif($courseid !="ALL" && $studentid=="ALL")
	{
		$sql= "SELECT courses.course_name,courses.description,p4.* FROM courses
		  INNER JOIN 
		 (SELECT St_Name,regno,p1.*
				FROM student_info
				INNER JOIN 
				(	SELECT student_id,course_id,SUM(payment_amt) AS paidamt,course_fee,complete_month,complete_year
					FROM
					(SELECT `pursuing_course`.*,payment.payment_amt 
					FROM pursuing_course
					LEFT JOIN payment
					ON pursuing_course.student_id=payment.student_id
					WHERE pursuing_course.current_status='PURSUING')p2 
					GROUP BY p2.student_id,p2.course_id
				)p1
				ON student_info.Student_Id=p1.student_id)p4
				ON p4.course_id=courses.course_id
				WHERE p4.course_id='$courseid'
			";
	}
	elseif($courseid !="ALL" && $studentid !="ALL")
	{
		$sql= "SELECT courses.course_name,courses.description,p4.* FROM courses
		  INNER JOIN 
		 (SELECT St_Name,regno,p1.*
				FROM student_info
				INNER JOIN 
				(	SELECT student_id,course_id,SUM(payment_amt) AS paidamt,course_fee,complete_month,complete_year
					FROM
					(SELECT `pursuing_course`.*,payment.payment_amt 
					FROM pursuing_course
					LEFT JOIN payment
					ON pursuing_course.student_id=payment.student_id
					WHERE pursuing_course.current_status='PURSUING')p2 
					GROUP BY p2.student_id,p2.course_id
				)p1
				ON student_info.Student_Id=p1.student_id)p4
				ON p4.course_id=courses.course_id
				WHERE p4.course_id='$courseid' AND p4.student_id='$studentid'
			";
	}
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	$no=0;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '
		<tr>
			<td style="text-align:center">'.++$no.'</td>
			<td style="text-align:center">'.$row['St_Name'].'</td>
			<td style="text-align:center">'.$row['regno'].'</td>
			<td style="text-align:center">'.$row['course_name'].'</td>
			<td style="text-align:center">'.printMonth($row['complete_month'],$row['complete_year']).'</td>
			<td style="text-align:center">'.$row['course_fee'].'</td>
			<td style="text-align:center">'.$row['paidamt'].'</td>
			<td style="text-align:center">'.($row['course_fee'] - $row['paidamt']).'</td>
		</tr>
		';
	}
}
function printMonth($completemonth,$completeyear)
{
		$month=array(1=>'JANUARY',
				2=>'FEBRUARY',
				3=>'MARCH',
				4=>'APRIL',
				5=>'MAY',
				6=>'JUNE',
				7=>'JULY',
				8=>'AUGUST',
				9=>'SEPTEMBER',
				10=>'OCTOBER',
				11=>'NOVEMBER',
				12=>'DECEMBER'
				) ;
	$monthname=$month[$completemonth];	
	return ($monthname."-".$completeyear);
}
?>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Due Amount</h3>
			
					<table id="example" class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME 	</th>
							<th style="text-align:center;font-size:12px;">REGISTRATION NO</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME 	</th>
							<th style="text-align:center;font-size:12px;">COMPLETION MONTH</th>
							<th style="text-align:center;font-size:12px;">COURSE FEE 	 </th>
							<th style="text-align:center;font-size:12px;">TOTAL PAYMENT	 </th>
							<th style="text-align:center;font-size:12px;">DUE AMOUNT      </th>
						</thead>
						<tbody>
							<?php findDueRecord(); ?>
							
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
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis','print' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
		

		
		} );
</script>