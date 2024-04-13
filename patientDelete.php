<?php 
include("config.php");
include("firebaseRDB.php");

$CCCD = $_POST['CCCD'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/vicManager", "CCCD", "EQUAL", $CCCD);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
$doctorID = $data[$id]['doctorID'];
$nurseID = $data[$id]['nurseID'];
$delete = $rdb->delete("/vicManager", $id);
$result = json_decode($delete, 1);

if(!isset($result['name'])){
    if($doctorID != "N/A"){
        $retrieve = $rdb->retrieve("/staffManager/doctor", "ID", "EQUAL", $doctorID);
        $data = json_decode($retrieve, 1);
        if($data != ""){
            $patientNum = $data[array_keys($data)[0]]['patientNum'] - 1;
            $rdb->update("/staffManager/doctor", array_keys($data)[0], [
                "patientNum" => $patientNum
            ]);
        }
    }
    if($nurseID != "N/A"){
        $retrieve = $rdb->retrieve("/staffManager/nurse", "ID", "EQUAL", $nurseID);
        $data = json_decode($retrieve, 1);
        if($data != ""){
            $patientNum = $data[array_keys($data)[0]]['patientNum'] - 1;
            $rdb->update("/staffManager/nurse", array_keys($data)[0], [
                "patientNum" => $patientNum
            ]);
        }
    }
    $_SESSION['success'] = "Xóa thành công!";
}else{
    $_SESSION['wrong'] = "Xóa thất bại!";
}
header("location: patient.php");

?>