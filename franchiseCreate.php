<?php 
 include "include/dbconfig.php" ;
 $validator = array('success' => false, 'messages' => array());
 if($_POST)
 {
	 $userName    = trim($_POST['userName']);
	 $name    	  = trim($_POST['franchiseName']);
	 $contact 	  = trim($_POST['contact']);
	 $address 	  = trim($_POST['address']);
	 $code 	  	  = trim($_POST['franchiseCode']);
	 $password 	  = trim($_POST['password']);
	
	 if(checkDuplicate($userName))
	 {
		 $query  = "INSERT INTO `franchises`(`franchise_name`, `code`, `address`, `contact`) VALUES ('$name', '$code', '$address', '$contact')";
		 $result = mysqli_query($conn, $query);
		 $memberId = mysqli_insert_id($conn);
		
		 $sql="INSERT INTO `user_info`(`role_id`,`member_id`, `user_name`, `password`)
		 VALUES ('2', '$memberId', '$userName','$password')" ;
		
		 $res=mysqli_query($conn, $sql);

		if($res)
		{
			$validator['success'] = true;
			$validator['messages'] = "Successfully added";
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