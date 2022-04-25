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
    foreach ($params as $key => $param) {

        // Generate QRCode For Certificate
       

        if (!is_dir('qrcode')) {
            mkdir('qrcode', 0777, true);
        }
        $fileName 		 = md5(uniqid(rand(), true)). $param['id'] . "." . "png";
        $target_dir      = 'qrcode/' . $fileName;
        $qrCodeContent   = getBaseAddress() . "certificate-print.php?id=" . $param['reg_no'];
        QRcode::png($qrCodeContent, $target_dir) ;
        
        // Generate QRCode For Marksheet.
        $markSheetQr 	 = md5(uniqid(rand(), true)). $param['id'] . "." . "png";
        $qrMarkContent   = getBaseAddress() . "marksheet-print.php?id=" .  $param['reg_no'];
        $target_dir      = 'qrcode/' . $markSheetQr;
        QRcode::png($qrMarkContent, $target_dir) ;
       

        // Update Marks Table
        $query = "UPDATE `marks` SET `certificate_status`='issued',`certificate_issue_date`='{$param['certificate_date']}',
                `marksheet_issue_date`='{$param['marksheet_date']}',`qrcode`='{$fileName}',`marksheet_qrcode`='{$markSheetQr}'  WHERE `id`='{$param['id']}'" ;
             
        $ress  = mysqli_query($conn, $query) ;
        
        // Update `pursuing_course` Table Status
        $sql = "UPDATE `pursuing_course` SET `current_status`='COMPLETED' WHERE `pusuing_id`='{$param['admission_id']}'" ;
      //  echo $sql;
        $sqlRess  = mysqli_query($conn, $sql) ;
        if(mysqli_affected_rows($conn) > 0){
            $count++ ;
         
        }
    }
    if($count > 0){
        $result['success'] = true ;
        $result['message'] = "Certificate Has Been Issued Successfully." ;
    }else{
        $result['message'] = "Error : Something Wrong. ".mysqli_error($conn) ;
    }
    echo json_encode($result) ;
}
