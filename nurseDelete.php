<?php 
include("config.php");
include("firebaseRDB.php");

$ID = $_POST['ID'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/staffManager/nurse", "ID", "EQUAL", $ID);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];

$delete = $rdb->delete("/staffManager/nurse", $id);
$result = json_decode($delete, 1);
if(!isset($result['name'])){
    if($data[$id]['patientNum'] > 0){
    $retrieve = $rdb->retrieve("/vicManager", "nurseID", "EQUAL", $ID);
    $patientList = json_decode($retrieve, 1);
    if(count($patientList) > 0){
        for($i = 0; $i < count($patientList); ++$i){
            $retrieve = $rdb->retrieve("/staffManager/nurse");
            $nurseList = json_decode($retrieve, 1);
            if(!$nurseList){
                $rdb->update("/vicManager", array_keys($patientList)[$i], [
                        "nurseID" => "N/A"
                    ]);
            }else{
                $nurse = $nurseList[array_keys($nurseList)[0]];
                foreach($nurseList as $nur){
                    if($nur['patientNum'] < $nurse['patientNum']){
                        $nurse = $nur;
                    }
                }
                
                if($nurse['patientNum'] < 12){
                    // update patient in nurse 
                    $patientNum = $nurse['patientNum'] + 1;
                    $retrieve = $rdb->retrieve("/staffManager/nurse", "ID", "EQUAL", $nurse['ID']);
                    $data = json_decode($retrieve, 1);
                    $rdb->update("/staffManager/nurse", array_keys($data)[0],[
                        "patientNum" => $patientNum
                    ]);
        
                    // update nurse in patient
                    $rdb->update("/vicManager", array_keys($patientList)[$i],[
                        "nurseID" => $nurse['ID']
                    ]);
                }else{
                    $rdb->update("/vicManager", array_keys($patientList)[$i], [
                        "nurseID" => "N/A"
                    ]);
                }
            }
        }
    }
}
    $_SESSION['success'] = "Xóa y tá thành công.";
}else{
    $_SESSION['wrong'] = "Xóa y tá thất bại.";
}
header("location: doctor.php");
?>