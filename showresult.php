<?php 
session_start();
include "include/no-cache.php";
include "include/check-login.php";
function fetchRecords()
{
	include   ('include/dbconfig.php');	
	$session	= trim($_POST['session']);
	$time		= trim($_POST['time']);
	$courseid	= trim($_POST['course']);
	$sql		= "SELECT  `pursuing_course`.*,student_info.*,courses.*
					FROM `pursuing_course`
					LEFT JOIN courses
					ON `pursuing_course`.`course_id`=courses.id
					LEFT JOIN student_info
					ON `pursuing_course`.student_id=student_info.slno
					WHERE `pursuing_course`.`course_id`='$courseid' AND pursuing_course.`session_id`='$session'
					AND `pursuing_course`.`time`='$time' AND `pursuing_course`.`time`='$time' AND `pursuing_course`.`current_status`='PURSUING'
				";
	$res	    = mysqli_query($conn, $sql);
	$no         = 0;
	/* echo $sql; */
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
				<td style="text-align:center;">'.++$no.'</td>
				<td style="text-align:center;">'.$row['course_name'].'</td>
				<td style="text-align:center;">'.$row['St_Name'].'</td>
				<td style="text-align:center;">'.$row['regno'].'</td>
				<td style="text-align:center;">'.$row['DOA'].'</td>
				<td style="text-align:center;">'.$row['course_fee'].'</td>
				<td style="text-align:center;">'.$row['Contact_no'].'</td>
			</tr>';
	}
}

?>
<?php include "include/menu.php";?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Course Details</h3>
					<table id="editable_table" class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO			</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME			</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME	</th>
							<th style="text-align:center;font-size:12px;">REGISTRATION NO	</th>
							<th style="text-align:center;font-size:12px;">DOA	</th>
							<th style="text-align:center;font-size:12px;">COURSE FEE </th>
							<th style="text-align:center;font-size:12px;">CONTACT NO</th>
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
	  <!-- Modal-->
	   <div class="modal fade" id="myModal" role="dialog" style="margin-top:15%;">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-warning"></i> Warning </h4>
        </div>
        <div class="modal-body">
          <font color="red">This Course Is Already In Use, Can Not Be Deleted</font>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
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
	
	
	
});
</script>