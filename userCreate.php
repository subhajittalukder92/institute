<?php 
 include "include/dbconfig.php" ;
 $validator = array('success' => false, 'messages' => array());
 if($_POST)
 {
	 $userName    = trim($_POST['userName']);
	 $userId 	  = trim($_POST['userId']);
	 $password 	  = trim($_POST['pass']);
	 $type 	  	  = trim($_POST['type']);
	 if(checkDuplicate($userId))
	 {
		 $sql="INSERT INTO `user_info`(`name`, `user_name`, `password`, `type`)
		 VALUES ('$userName','$userId','$password','$type')" ;
		/*  echo $sql; */
		 $res=mysqli_query($conn,  $sql);

		if($res)
		{
			$validator['success'] = true;
			$validator['messages'] = "Successfully Added";
		}
		else{
			$validator['success'] = false;
			$validator['messages'] = "Error while adding the member information";
		}
	 }
	 else{
			$validator['success'] = false;
			$validator['messages'] = "This User Id IS Already Exist";
		}
	
	echo json_encode($validator);

	
 }
 function checkDuplicate($userId)
 {
	 include "include/dbconfig.php";
	 $sql="SELECT * FROM `user_info` WHERE `user_name`='$userId'";
	 $res=mysqli_query($conn,  $sql) ;
	 if(mysqli_num_rows($res) > 0)
	 {
		 return false;
	 }
	 else{
		 return true;
	 }
 }
?>