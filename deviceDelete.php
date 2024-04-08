<?php
include("config.php");
include("firebaseRDB.php");

$deviceName = $_POST['deviceName'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/deviceManager", "deviceName", "EQUAL", $deviceName);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
$delete = $rdb->delete("/deviceManager", $id);
$result = json_decode($delete, 1);

if(!isset($result['name'])){
    $_SESSION['success'] = "Xóa thành công!";
}else{
    $_SESSION['wrong'] = "Xóa thất bại!";
}

header("location: device.php");
?>