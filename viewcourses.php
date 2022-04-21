<?php session_start();
include "include/no-cache.php";
include "include/check-login.php";
function fetchRecords()
{
	include   ('include/dbconfig.php');	
	
	$sql		="SELECT * FROM `courses`";
	$res	   = mysqli_query($conn,  $sql);
	$no        = 0;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
			<td style="text-align:center;">'.++$no.'</td>
			<td style="text-align:center;">'.$row['course_id'].'</td>
			<td style="text-align:center;">'.$row['course_name'].'</td>
			<td style="text-align:center;">'.$row['description'].'</td>
			<td style="text-align:center;">'.sprintf('%0' . 3 . 's', $row['course_id']).'</td>
			<td style="text-align:center;">'.$row['duration'].'</td>
			<td style="text-align:center;">'.$row['eligibility'].'</td>
			<td style="text-align:center;">'.$row['course_fee'].'</td>
			<td style="text-align:center;"><button class="btn btn-primary btn-sm btn-edit" data-sid="'.$row['id'].'" >EDIT</button></td>
			<td style="text-align:center;"><button class="btn btn-danger btn-sm btn-del" data-sid="'.$row['id'].'" >DELETE</button></td>
			';
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
							<th style="text-align:center;font-size:12px;">ID			</th>
							<th style="text-align:center;font-size:12px;">COURSE NAME			</th>
							<th style="text-align:center;font-size:12px;">DESCRIPTION	</th>
							<th style="text-align:center;font-size:12px;">COURSE CODE	</th>
							<th style="text-align:center;font-size:12px;">DURATION	</th>
							<th style="text-align:center;font-size:12px;">ELIGIBILITY </th>
							<th style="text-align:center;font-size:12px;">COURSE FEE </th>
							<th style="text-align:center;font-size:12px;" colspan="2">ACTION </th>
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


	$("tbody").on("click", ".btn-del", function () {
    let id = $(this).attr("data-sid");
    // console.log(id);
    mythis = this;
    $.ajax({
      url: "deleteCourse.php",
      method: "POST",
      data: {
		  'id':id
	  },
      success: function (data) {
        // console.log(data);
        if (data) {
          alert("Delete Successfully");
          $(mythis).closest("tr").fadeOut();
        } else{
          alert("Unable to Delete !");
        }
      },
    });
  });


  $("tbody").on("click", ".btn-edit", function () {
    let id = $(this).attr("data-sid");
	window.location="newcourseedit.php?id="+id;
  });


	
	// $('#editable_table').Tabledit({
	// 	url:"action.php",
	// 	 buttons: {
	// 			edit: {
	// 				class : 'btn btn-xs btn-info',
	// 				action : 'edit'
	// 				},
	// 			delete:{
	// 				class : 'btn btn-xs btn-danger',
	// 				action : 'delete'
	// 			}
	// 	 },
	// 	columns:{
	// 		identifier:[1,"course_id"],
	// 		editable:[[2,'course_name'],[3,'description'],[5,'duration'],[6,'course_fee'],[7,'fee_type']]
	// 		},
	// 		restoreButton:false,
	// 		onSuccess:function(data,status,jqXHR)
	// 		{
	// 			if(data.action == "delete")
	// 			{
					
	// 				if(data.result == "success")
	// 				{
	// 					$('#'+ data.course_id).remove();
	// 				}
	// 				else if(data.result == "failed")
	// 				{
						
	// 					alert("ERROR: Unable To Delete.Try Again !")
	// 				}
	// 				else if(data.result == "invalid")
	// 				{
	// 					$('#myModal').modal('show');
	// 				}
					
	// 			}
	// 		}
		
	// });
	
});


function delBTN(id){

}
</script>