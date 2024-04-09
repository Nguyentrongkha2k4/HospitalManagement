<?php 
include ("config.php");
include ("firebaseRDB.php");

$id = $_POST['id'];
$dateofborn = date('j-m-Y', strtotime($_POST['dateofborn']));
$address = $_POST['address'];
$recipientName = $_POST['recipient-name'];
$doctor = $_POST['doctor'];
$result = $_POST['result'];
$history = $_POST['history'];

$rdb = new firebaseRDB($databaseURL);
$update = $rdb->update("/vicManager", $id,[
    "datofborn" => $dateofborn,
    "address" => $address,
    "recipient-name" => $recipientName,
    "doctor" => $doctor,
    "result" => $result,
    "history" => $history
]);
$result = json_decode($update, 1);
if(isset($result['name'])){
    $_SESSION['success'] = "Lưu thành công!";
}else{
    $_SESSION['wrong'] = "Lưu thất bại!";
}
header("location: patientInfo.php");
?>