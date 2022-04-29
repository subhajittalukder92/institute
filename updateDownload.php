<?php 
session_start();
include "include/dbconfig.php";
if($_POST)
{
	$validator= array('success' => false, 'messages' => array());
	$title    = trim($_POST['title']);
	$id       = trim($_POST['id']);

$sql = "SELECT * FROM `download` WHERE `id` ='$id'";
$res = mysqli_query($conn,  $sql);
$row = mysqli_fetch_assoc($res);

  if(!empty($_FILES["file"]["name"]))
  {
      $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
      $file = md5(uniqid(rand(), true)) . "." . $extension; 
      $target_dir = 'downloads/' . $file;

      $slider_file=$file;
      if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_dir)) {
          if($row['file'] != ''){
              unlink("downloads/".$row['file']);
          }
      }
      $sql      = "UPDATE `download` SET `title`='$title',`file`='$file'  WHERE `id`='$id'";

  }else{
  	$sql      = "UPDATE `download` SET `title`='$title'  WHERE `id`='$id'";


  }

	
	$result		  = mysqli_query($conn,  $sql);
	if($result)
	{
		$validator['success']= true;
		$validator['messages']= "Successfully Updated";
	}
	else{
		$validator['success']= false;
		$validator['messages']= "Update Failed !";
	}
	echo json_encode($validator);
}	

?>