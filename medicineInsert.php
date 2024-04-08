<?php
include("config.php");
include("firebaseRDB.php");

$medicineName = $_POST['medicineName'];
$uses = $_POST['uses'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/medicineManager", "medicineName", "EQUAL", $medicineName);
$data = json_decode($retrieve, 1);
if(count($data) > 0){
    $_SESSION['wrong'] = "Thuốc đã tồn tại!";
    header("location: medicine.php");
}else{
    $insert = $rdb->insert("/medicineManager",
    [
        "medicineName" => $medicineName,
        "uses" => $uses,
        "amount" => 0,
    ]);
    $result = json_decode($insert, 1);
    if(isset($result['name'])){
        $_SESSION['success'] = "Thêm thành công!";
        header("location: medicine.php");
    }else{
        $_SESSION['wrong'] = "Thêm thất bại!";
        header("location: medicine.php");
    }
}

?>