<?php
	session_start();
	require('include/dbconfig.php');
	
	$userid   = mysqli_real_escape_string($conn,$_POST["userid"]);
	$password = mysqli_real_escape_string($conn,$_POST["password"]);
	$_SESSION['timestamp'] = time();
	// Admin Login
	$q="select * from user_info where BINARY user_name='$userid' and BINARY password='$password' AND `role_id`='1'";
	$query = mysqli_query($conn,  $q);
	$row=mysqli_fetch_assoc($query);
	if(mysqli_num_rows($query)>0){
		$_SESSION['userid'] = $userid;
		$_SESSION['franchise_id'] = $row['member_id'];
		$_SESSION['password'] = $password;
		$_SESSION['id'] = session_id(); 
		$_SESSION['login_type'] = $row['type'];
		/* echo $q; */
		echo '<script>window.location.assign("home.php");</script>';
		
	}
	else{
		echo '<script>alert("User id or Password is wrong.");window.location.assign("index.php");</script>';
	}
?>