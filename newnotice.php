<?php 
session_start();
include('include/dbconfig.php');
if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid'])
{
	extract($_POST);
	$sourcePath 	= $_FILES['content']['tmp_name'];
	$imagename		= $_FILES['content']['name'];
	$targetPath 	= "Notice/" . $_FILES['content']['name'];
	move_uploaded_file($sourcePath,$targetPath);
	$sql="INSERT INTO `notice`(`date`, `notice`, `content`) VALUES ('$date','$description','$imagename')";
	$res= mysqli_query($conn,  $sql);
	if($res)
	{
		echo '<script>alert("Successfully Save.")</script>' ;
	}	
	else
	{
		echo '<script>alert("ERROR : Process Failed.")</script>' ;
	}	
$_SESSION['formid']=md5(rand(0,10000000));	


}
else{
	
	$_SESSION['formid']=md5(rand(0,10000000));
}
include('include/menu.php');?>
  <!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
			   <div class="col-sm-6 col-md-6 col-xs-12 col-md-offset-3 col-sm-offset-3 ">
                        <h3 class="page-header">Add New Notice</h3>
				<form class="form-horizontal" method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
				<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
				<div id="add-course-messages"></div>
				<div class="form-group">
						<label for="fname" class="col-sm-4 control-label">Date: </label>
					   	<div class="col-sm-8">
					      <input type="date" required class="form-control" id="date" name="date" placeholder="Course Name" />
					    </div>
					</div>
			  		<div class="form-group">
						<label for="fname" class="col-sm-4 control-label">Description : </label>
					   	<div class="col-sm-8">
					      <input type="text" required class="form-control" id="description" name="description" placeholder="Notice Head Description" />
					    </div>
					</div>
					
					<div class="form-group">
					    <label for="lname" class="col-sm-4 control-label">Content: </label>
					    <div class="col-sm-8">
					      <input type="file" class="form-control" id="content" name="content" />
					    </div>
					</div>
					
					
				 <div class="form-group">
                        	 <button type="submit" name="submit" id="submit" class="btn btn-primary btn-md btn-block">Submit</button>
                 </div>
		  		<!-- /col-md-6 -->

			 
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
		    
	
	 	<!-- /row -->
      </div>
   
      </form>
                     
            </div>
			
			<!-- add teacher -->
<div class="modal fade" tabindex="-1" role="dialog" id="addCourse">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Add Course</h4>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
			</div>
		<!-- /.container-fluid -->
		</div>
	<!-- /#page-wrapper -->

	</div>
	
    <!-- /#wrapper -->
<?php include('include/footer.php'); ?>
 
</body>
</html>
   <script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
	
	CourseTable = $("#manageCourseTable").DataTable({});
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );

function clearForm()
{
	$('input[type="text"]').val('');
	$('select').val('');
	
}
});
    </script>