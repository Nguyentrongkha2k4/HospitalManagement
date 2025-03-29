<?php
include("config.php");
include("firebaseRDB.php");

$deviceName = $_POST['deviceName'];
$code = $_POST['code'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/deviceManager/maintenance", "code", "EQUAL", $code);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
$delete = $rdb->delete("/deviceManager/maintenance", $id);
$result = json_decode($delete, 1);
$retrieve = $rdb->retrieve("/deviceManager/device", "deviceName", "EQUAL", $deviceName);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
$amount = $data[$id]['amount'] - 1;
$rdb->update("/deviceManager/device", $id, [
    "amount" => $amount
]);
if(!isset($result['name'])){
    $_SESSION['success'] = "Xóa thiết bị thành công.";
}else{
    $_SESSION['wrong'] = "Xóa thiết bị thất bại.";
}

header("location: device.php");