<?php
include ("config.php");
include ("firebaseRDB.php");

$deviceName = $_POST['deviceName'];
$choice = $_POST['choice'];
$code = $_POST['code'];
$date = $_POST['date'];
$active = $_POST['active'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/deviceManager/device", "deviceName", "EQUAL", $deviceName);
$data = json_decode($retrieve, 1);
if(count($data) > 0){
    $id = array_keys($data)[0];
    $amount = $data[$id]['amount'];
    $retrieve = $rdb->retrieve("/deviceManager/maintenance", "code", "EQUAL", $code);
    $data = json_decode($retrieve, 1);

    if(count($data) > 0){
        $_SESSION['wrong'] = "Mã máy đã tồn tại!";
    }else{
        $insert = $rdb->insert("/deviceManager/maintenance",[
            "deviceName" => $deviceName,
            "code" => $code,
            "inputdate" => date('j-m-Y', strtotime($date)),
            "maintenance" => date('j-m-Y', strtotime('+1 month', strtotime($date))),
            "active" => $active
        ]);

        $result = json_decode($insert, 1);
        if(isset($result['name'])){
            $amount = $amount + 1;
            $rdb->update("/deviceManager/device", $id, [
                "amount" => $amount
            ]);
            $_SESSION['success'] = "Thêm thiết bị thành công.";
        }else{
            $_SESSION['wrong'] = "Thêm thiết bị thất bại!";
        }
    }
}else{
    $_SESSION['wrong'] = "Lỗi hệ thống!";
}
header("location: device.php");

