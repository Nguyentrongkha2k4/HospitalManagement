<?php
include("config.php");
include("firebaseRDB.php");

$deviceName = $_POST['deviceName'];
$purpose = $_POST['purpose'];
$uses = $_POST['uses'];
$inputdate = $_POST['inputdate'];
$amount = $_POST['amount'];
if($amount < 0){
    $_SESSION['wrong'] = "Số lượng không hợp lệ!";
}else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/deviceManager", "deviceName", "EQUAL", $deviceName);
    $data = json_decode($retrieve, 1);
    
    if(count($data) > 0){
        $_SESSION['wrong'] = "Thiết bị đã tồn tại!";
    }else{
        if((int)$amount > 0){
            $insert = $rdb->insert("/deviceManager",[
                "deviceName" => $deviceName,
                "purpose" => $purpose,
                "uses" => $uses,
                "amount" => $amount,
                "info" => [
                    "inputdate" => $inputdate,
                    "amount" => $amount
                ]
            ]);
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $_SESSION['success'] = "Thêm thành công!";
            }else{
                $_SESSION['wrong'] = "Thêm thất bại!";
            }
        }else{
            $insert = $rdb->insert("/deviceManager",[
                "deviceName" => $deviceName,
                "purpose" => $purpose,
                "uses" => $uses,
                "amount" => $amount
            ]);
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $_SESSION['success'] = "Thêm thành công!";
            }else{
                $_SESSION['wrong'] = "Thêm thất bại!";
            }
        }
    }
}
header("location: device.php");

?>