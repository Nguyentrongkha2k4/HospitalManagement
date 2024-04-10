<?php
include("config.php");
include("firebaseRDB.php");

$deviceName = $_POST['deviceName'];
$purpose = $_POST['purpose'];
$uses = $_POST['uses'];
$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/deviceManager/device", "deviceName", "EQUAL", $deviceName);
$data = json_decode($retrieve, 1);

if(count($data) > 0){
    $_SESSION['wrong'] = "Thiết bị đã tồn tại!";
}else{
    if((int)$amount > 0){
        $insert = $rdb->insert("/deviceManager/device",[
            "deviceName" => $deviceName,
            "purpose" => $purpose,
            "uses" => $uses,
            "amount" => 0,
            "maintenance" => ""
        ]);
        $result = json_decode($insert, 1);
        if(isset($result['name'])){
            $_SESSION['success'] = "Thêm thành công!";
        }else{
            $_SESSION['wrong'] = "Thêm thất bại!";
        }
    }else{
        $insert = $rdb->insert("/deviceManager/device",[
            "deviceName" => $deviceName,
            "purpose" => $purpose,
            "uses" => $uses,
            "amount" => 0,
            "maintenance" => ""
        ]);
        $result = json_decode($insert, 1);
        if(isset($result['name'])){
            $_SESSION['success'] = "Thêm thành công!";
        }else{
            $_SESSION['wrong'] = "Thêm thất bại!";
        }
    }
}
header("location: device.php");

?>