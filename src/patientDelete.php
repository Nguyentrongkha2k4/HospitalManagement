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
$date = $data[$id]['date'];
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
            $doctorkey = array_keys($data)[0];
            $retrieve = $rdb->retrieve("/staffManager/doctor/".$doctorkey."/schedule");
            $schedule = json_decode($retrieve, 1);
            $amountinday = $schedule[$date] - 1;
            $rdb->update("/staffManager/doctor/".$doctorkey,"schedule", [
                $date => $amountinday
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
    $_SESSION['success'] = "Xóa bệnh nhân thành công.";
}else{
    $_SESSION['wrong'] = "Xóa bệnh nhân thất bại.";
}
header("location: patient.php");

?>