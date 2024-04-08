<?php
include("config.php");
include("firebaseRDB.php");

$patientCCCD = $_POST['CCCD'];
$patientName = $_POST['patientName'];
$patientBDate = $_POST['dateofborn'];
$patientAddress = $_POST['address'];
$patientKhoa = $_POST['recipient-name'];
$patientDoctor = null;

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/vicManager", "CCCD", "EQUAL", $patientCCCD);
$data = json_decode($retrieve, 1);
if(count($data) > 0){
    $_SESSION['wrong'] = "Bệnh nhân đã tồn tại!";
    header("location: patient.php");
}else{
    $insert = $rdb->insert("/vicManager",
    [
        "CCCD" => $patientCCCD,
        "patientName" => $patientName,
        "dateofborn" => $patientBDate,
        "address"=> $patientAddress,
        "recipient-name" => $patientKhoa,
        "doctor"=> "N/A" //// => $patientDoctor
    ]);
    $result = json_decode($insert, 1);
    if(isset($result['name'])){
        $_SESSION['success'] = "Thêm thành công!";
        header("location: patient.php");
    }else{
        $_SESSION['wrong'] = "Thêm thất bại!";
        header("location: patient.php");
    }
}

?>