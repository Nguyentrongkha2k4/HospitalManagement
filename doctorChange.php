<?php 
include ("config.php");
include ("firebaseRDB.php");

$id = $_POST['id'];
$dateofborn = date('j-m-Y', strtotime($_POST['dateofborn']));
$address = $_POST['address'];
$position = $_POST['position'];
$degree = $_POST['degree'];

$rdb = new firebaseRDB($databaseURL);
$update = $rdb->update("/staffManager/doctor", $id,[
    "datofborn" => $dateofborn,
    "address" => $address,
    "position" => $position,
    "degree" => $degree
]);
$result = json_decode($update, 1);
if(!isset($result['name'])){
    $_SESSION['success'] = "Lưu thành công.";
}else{
    $_SESSION['wrong'] = "Lưu thất bại.";
}
header("location: doctor.php");

