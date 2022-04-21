<?php 
session_start();
include('include/no-cache.php');
include('include/dbconfig.php');
include('include/check-login.php');
if($_POST){
    extract($_POST);
    $result    = array('success'=>false, 'records'=>[]);
    $franchise = mysqli_real_escape_string($conn, $franchiseId);
    $sql       = "SELECT `id`,`receipt_no`,`franchise_id`,`receipt_date` FROM `receipts` WHERE `franchise_id`='$franchise'";
    $res       = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $result['success'] = true ;
        while($row = mysqli_fetch_assoc($res)){
          
            $result['records'][] = $row ;
        }
    }

    echo json_encode($result);
}

?>