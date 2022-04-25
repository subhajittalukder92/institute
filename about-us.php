<?php
session_start();
include('include/dbconfig.php');
include('include/menu.php'); 
?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<h3 class="page-header">Edit About Us Content</h3>
<?php
//select query
$sql = "SELECT * FROM web_about";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);
// update query
if (isset($_POST['update'])) {
    $content=mysqli_real_escape_string($conn,$_POST['content']);
 
$sql = "UPDATE web_about SET content='$content'";

    if (mysqli_query($conn, $sql)) {
      echo "<br>
    <div class='container' style='width:98%; margin:auto;'>
      <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <b><i class='fa fa-check'></i> Data Updated Successfully!</b>.
      </div>
    </div>";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
		<form class="form-horizontal" method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
			<div class="form-group">
				<textarea class="form-control" id="description" name="content"><?php echo $rows['content'];?></textarea>
			</div>
			<div class="form-group">
				<button type="submit" name="update" class="btn btn-primary btn-block">Submit</button>
			</div>
		</form>
	</div>
</div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
	$(document).ready(function() {
		CKEDITOR.replace('description');
		var table = $('#example').DataTable({
			lengthChange: false,
			buttons: ['copy', 'excel', 'pdf', 'colvis']
		});
	});
</script>