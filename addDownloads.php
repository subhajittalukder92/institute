<?php 
 include "include/dbconfig.php" ;
 $validator = array('success' => false, 'messages' => array());
 if($_POST)
 {
	$title = trim($_POST['title']);
	 
    $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    $file = md5(uniqid(rand(), true)) . "." . $extension; 
    $path = 'downloads/' . $file;
    move_uploaded_file( $_FILES['file'] ['tmp_name'], $path);
	 
	 $sql="INSERT INTO download(title,file)VALUES ('$title','$file')" ;
	 $res=mysqli_query($conn,  $sql);

	if($res)
	{
		$validator['success'] = true;
        $validator['messages'] = "Successfully Added";
	}
	else{
		$validator['success'] = false;
        $validator['messages'] = "Error while adding download content";
	}
	
	echo json_encode($validator);

 }
?>