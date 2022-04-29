<?php 
include "include/dbconfig.php";

$output = array('success' => false, 'messages' => array());
 
$id = $_POST['id'];
 
$sql = "DELETE FROM download WHERE id = '$id'";

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