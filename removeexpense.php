<?php 
include "include/dbconfig.php";
$output = array('success' => false, 'messages' => array());
 
$Id = $_POST['id'];
 
$sql = "DELETE FROM daybook WHERE id = '$Id'";
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