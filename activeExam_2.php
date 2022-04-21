<?php 
session_start();
include('include/check-login.php');
include('include/dbconfig.php');
error_reporting(0);
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$examid=trim($_POST['exam']);
	mysqli_query($conn,  "UPDATE `examinfo` SET `status`=''");
	$res=mysqli_query($conn,  "UPDATE `examinfo` SET `status`='ACTIVE' WHERE `id`='$examid' ");
	echo "<script>alert('Exam Setting Changed')</script>";
	
}
function encryptIt( $var )
{
    $cryptKey  = 'qJcB0rGtjk89Q2r54G03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $var, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}
function getExamName()
{
	include "include/dbconfig.php";
	
	$sql="SELECT * FROM `examinfo`";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	$option='';
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option '.checkStatus($row['status']).'value="'.$row['id'].'">'.$row['exam_name'].'</option>';
	}
	echo $option;
}
function checkStatus($status)
{
	$var="selected='selected'";
	if($status == "ACTIVE")
	{
		return $var;
	}
}

?>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row ">
		 <h3 class="page-header">ACTIVE EXAM</h3>
		 
		 <div class="col-md-6 col-sm-6 column" style="overflow-x:auto;">
	         <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			 <div class="form-group">
					<select name="exam" id="exam" class="form-control">
						<option value="">--Select--</option>
							<?php getExamName();?>
					</select>
			</div>
			<div class="form-group">
			
					<input type="submit" name="submit" class="btn btn-prmary" value=" Save ">
			</div>
			</FORM>
					
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