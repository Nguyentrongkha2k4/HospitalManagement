<?php 
include ("config.php");
include ("firebaseRDB.php");

$id = $_POST['id'];
$CCCD = $_POST['CCCD'];
$dateofborn = date('j-m-Y', strtotime($_POST['dateofborn']));
$address = $_POST['address'];
$result = $_POST['result'];
$history = $_POST['history'];
$image = $_POST['image'];

$rdb = new firebaseRDB($databaseURL);
if ($image != "") {
    $update = $rdb->update("/vicManager", $id,[
        "datofborn" => $dateofborn,
        "address" => $address,
        "result" => $result,
        "history" => $history,       
        "image_url" => $image
    ]);
}
else{
    $update = $rdb->update("/vicManager", $id,[
        "datofborn" => $dateofborn,
        "address" => $address,
        "result" => $result,
        "history" => $history
    ]);
}
$result = json_decode($update, 1);
if(!isset($result['name'])){
    $_SESSION['success'] = "Lưu thành công.";
}else{
    $_SESSION['wrong'] = "Lưu thất bại.";
}
header("location: patient.php");