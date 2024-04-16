<?php 
include("config.php");
include("firebaseRDB.php");

$ID = $_POST['ID'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/staffManager/doctor", "ID", "EQUAL", $ID);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];

$delete = $rdb->delete("/staffManager/doctor", $id);
$result = json_decode($delete, 1);
if(!isset($result['name'])){
    if($data[$id]['patientNum'] > 0){
    $retrieve = $rdb->retrieve("/vicManager", "doctorID", "EQUAL", $ID);
    $patientList = json_decode($retrieve, 1);
    if(count($patientList) > 0){
        for($i = 0; $i < count($patientList); ++$i){
            $retrieve = $rdb->retrieve("/staffManager/doctor", "khoa", "EQUAL", $patientList[array_keys($patientList)[0]]['recipient-name']);
            $doctorList = json_decode($retrieve, 1);
            if(count($doctorList) < 1){
                $rdb->update("/vicManager", array_keys($patientList)[$i], [
                        "doctorID" => "N/A",
                        "date" => ""
                    ]);
            }else{
                $doctor = $doctorList[array_keys($doctorList)[0]];
                foreach($doctorList as $doc){
                    if($doc['patientNum'] < $doctor['patientNum']){
                        $doctor = $doc;
                    }
                }
                
                if($doctor['patientNum'] < 12){
                    // update patient in doctor 
                    $patientNum = $doctor['patientNum'] + 1;
                    $retrieve = $rdb->retrieve("/staffManager/doctor", "ID", "EQUAL", $doctor['ID']);
                    $data = json_decode($retrieve, 1);
                    $rdb->update("/staffManager/doctor", array_keys($data)[0],[
                        "patientNum" => $patientNum
                    ]);

                    $doctorkey = array_keys($data)[0];
                    $retrieve = $rdb->retrieve("/staffManager/doctor/".$doctorkey."/schedule");
                    $schedule = json_decode($retrieve, 1);
                    $day = array_keys($schedule)[0];
                    for($j = 1; $j < 6; ++$j){
                        if($schedule[array_keys($schedule)[$j]] < $schedule[$day]){
                            $day = array_keys($schedule)[$j];
                        }
                    }
                    $amountinday = $schedule[$day] + 1;
                    $rdb->update("/staffManager/doctor/".$doctorkey,"schedule", [
                        $day => $amountinday
                    ]);
                    // update doctor in patient
                    $rdb->update("/vicManager", array_keys($patientList)[$i],[
                        "doctorID" => $doctor['ID'],
                        "date" => $day
                    ]);
                }else{
                    $rdb->update("/vicManager", array_keys($patientList)[$i], [
                        "doctorID" => "N/A",
                        "date" => ""
                    ]);
                }
            }
        }
    }
}
    $_SESSION['success'] = "Xóa bác sĩ thành công.";
}else{
    $_SESSION['wrong'] = "Xóa bác sĩ thất bại.";
}
header("location: doctor.php");
