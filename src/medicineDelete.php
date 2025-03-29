<?php
include("config.php");
include("firebaseRDB.php");

$medicineName = $_POST['medicineName'];
$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/medicineManager/medicine", "medicineName", "EQUAL", $medicineName);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
$delete = $rdb->delete("/medicineManager/medicine", $id);
$result = json_decode($delete, 1);
if(!isset($result['name'])){
    $_SESSION['success'] = "Xóa thành công.";
}else{
    $_SESSION['wrong'] = "Xóa thất bại.";
}
$retrieve = $rdb->retrieve("/medicineManager/storehouse", "medicineName", "EQUAL", $medicineName);
$data = json_decode($retrieve, 1);
foreach(array_keys($data) as $id){
    $delete = $rdb->delete("/medicineManager/storehouse", $id);
}
header("location: medicine.php");
