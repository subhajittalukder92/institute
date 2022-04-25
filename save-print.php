<?php
session_start();
include "functions.php";
include 'include/dbconfig.php';
include 'include/settings.php';
include 'include/check-login.php';
include "phpqrcode/qrlib.php" ;

if($_POST){
    extract($_POST); $count = 0;
    $result = ["success"=> false, "message" => ""];
    $params = json_decode($params, true);
    $printedAt = date('Y-m-d H:i:s');
    foreach ($params as $key => $param) {

        // Generate QRCode For Certificate
        $query = "UPDATE `marks` SET `printed_at`='$printedAt'  WHERE `id`='{$param['id']}'" ;
        $ress  = mysqli_query($conn, $query) ;
       
        if(mysqli_affected_rows($conn) > 0){
            $count++ ;
         
        }
    }
    if($count > 0){
        $result['success'] = true ;
        $result['message'] = "Printed Records Saved Successfully." ;
    }else{
        $result['success'] = true ;
        $result['message'] = "No Records Updated. " ;
    }
    echo json_encode($result) ;
}
