<?php
session_start();
include "check-login.php";
include "../include/dbconfig.php";
$success_msg=null;
if($_POST)
{
 foreach($_POST['optradio'] as $option_num => $option_val)
 {
	$q_id = $_POST['qid'][$option_num] ;
	$ans=$_POST['optradio'.$option_num][$option_num];
	
	 $sql="INSERT INTO `answer_record`(`student_id`, `regno`, `exam_id`, `q_id`, `answr`)
	 VALUES ('$_SESSION[Student_Id]','$_SESSION[user]','$_SESSION[examid]','$q_id','$option_val')";
	 $res = mysqli_query($conn,  $sql);
//	echo $sql."<br/>";
   // echo $option_val."  ".$_POST["qid"][$option_num]."<br/>";
 }
}
if($res)
{
	$success_msg="Successfully Submitted.";
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Niharika Software</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body style="padding-top:20%;">


  <h2 align="center" class="text-success"><i class="fa fa-check-circle"></i> Successfully Submitted.</h2>

</div>

</body>
</html>
