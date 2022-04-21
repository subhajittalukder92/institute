<?php 
session_start();
include('include/check-login.php');
error_reporting(0);
// function encryptIt( $var )
// {
//     $cryptKey  = 'qJcB0rGtjk89Q2r54G03efyCp';
//     $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $var, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
//     return( $qEncoded );
// }
function fetchRecords()
{
	include "include/dbconfig.php" ;
	
	$franchise=$_SESSION['franchise_id'];
	
	
	$sql="SELECT  `receipts`.`student_id`,  `receipts`.`course_id`, SUM(`receipts`.`payment_amt`) AS `payment`,
		 `student_info`.`St_Name`,`courses`.`course_name`,`pursuing_course`.`regno`,`pursuing_course`.`course_fee`
		  FROM `receipts`
		  LEFT JOIN `student_info` ON `student_info`.`slno` =  `receipts`.`student_id`
		  LEFT JOIN `courses` ON `courses`.`id` =  `receipts`.`course_id`
		  LEFT JOIN `pursuing_course` ON `pursuing_course`.`student_id` =  `receipts`.`student_id`
		  AND `pursuing_course`.`course_id` =  `receipts`.`course_id`
		  WHERE  `receipts`.`franchise_id` = '$franchise' AND 
		  `receipts`.`student_id` IN (
			  SELECT `student_id` FROM `pursuing_course`
		      WHERE `franchise_id` = '$franchise' AND `current_status`='PURSUING')
			  GROUP BY `student_id`,`course_id` 
	    ";
		/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{$no=0;
		while($row = mysqli_fetch_assoc($res))
		{
			echo '
				<tr>
					<td style="text-align:center">'.++$no.'</td>
					<td style="text-align:center">'.$row['St_Name'].'</td>
					<td style="text-align:center">'.$row['regno'].'</td>
					<td style="text-align:center">'.$row['course_name'].'</td>
					<td style="text-align:center">'.$row['course_fee'].'</td>
					<td style="text-align:center">'.$row['payment'].'</td>
					<td style="text-align:center">'.($row['course_fee'] - $row['payment']).'</td>
				</tr>
			
			';
		}
	}
}
function dueCheck($value)
{
	include "dbconfig.php";
	if($value == NULL)
	{
		return "<font color='red'>Due</font>";
	}
	else{
		return $value ;
	}
}
function printDate($value)
{
	if($value != NULL)
	{
		return date('d/m/Y',strtotime($value));
	}
	
}
?>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row ">
		 <h3 class="page-header">Due Report</h3>
		 
		 <div class="col-md-12 col-sm-12 column" style="overflow-x:auto;">
	         
			
					<table id="example" class="table table-sm table-condenssed">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME 	</th>
							<th style="text-align:center;font-size:12px;">REGISTRATION NO</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME 	</th>
							<th style="text-align:center;font-size:12px;">COURSE FEE	</th>
							<th style="text-align:center;font-size:12px;">PAID AMOUNT	</th>
							<th style="text-align:center;font-size:12px;">DUE AMOUNT	</th>
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