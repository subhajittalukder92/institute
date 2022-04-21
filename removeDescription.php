<?php 
include "include/dbconfig.php";
$output = array('success' => false, 'messages' => array());
 
$memberId = $_POST['member_id'];
 
$sql = "DELETE FROM `exam_rule` WHERE `slno`='$memberId'";
$query = mysqli_query($conn,  $sql);
if($query === TRUE) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Removed';
} else {
    $output['success'] = false;
    $output['messages'] = 'Error while removing the member information';
}
 
 
echo json_encode($output);

?>