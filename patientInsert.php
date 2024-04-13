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
    $_SESSION['wrong'] = "Bệnh nhân đã tồn tại.";
}else{
    $insert = $rdb->insert("/vicManager",
    [
        "CCCD" => $patientCCCD,
        "patientName" => $patientName,
        "dateofborn" => date('j-m-Y', strtotime($patientBDate)),
        "address"=> $patientAddress,
        "recipient-name" => $patientKhoa,
        "doctorID"=> "N/A", //// => $patientDoctor
        "nurseID" => "N/A",
        "result" => "",
        "history" => ""
    ]);
    $result = json_decode($insert, 1);
    if(isset($result['name'])){

        $retrieve = $rdb->retrieve("/staffManager/doctor", "khoa", "EQUAL", $patientKhoa);
        $data = json_decode($retrieve, 1);
        if(count($data) > 0){
            // find a min patientNum of doctor
            $doctor = $data[array_keys($data)[0]];
            foreach($data as $doc){
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
    
                // update doctor in patient
                $retrieve = $rdb->retrieve("/vicManager", "CCCD", "EQUAL", $patientCCCD);
                $data = json_decode($retrieve, 1);
                $rdb->update("/vicManager", array_keys($data)[0],[
                    "doctorID" => $doctor['ID']
                ]);
            }
        }

        $retrieve = $rdb->retrieve("/staffManager/nurse");
        $data = json_decode($retrieve, 1);
        if($data != ""){
            // find a min patientNum of nurse
            $nurse = $data[array_keys($data)[0]];
            foreach($data as $nurse2){
                if($nurse2['patientNum'] < $nurse['patientNum']){
                    $nurse = $nurse2;
                }
            }

            // update patient in nurse
            if($nurse['patientNum'] < 12){
                $patientNum = $nurse['patientNum'] + 1;
                $retrieve = $rdb->retrieve("/staffManager/nurse", "ID", "EQUAL", $nurse['ID']);
                $data = json_decode($retrieve, 1);
                $rdb->update("/staffManager/nurse", array_keys($data)[0],[
                    "patientNum" => $patientNum
                ]);
    
                // update doctor in patient
                $retrieve = $rdb->retrieve("/vicManager", "CCCD", "EQUAL", $patientCCCD);
                $data = json_decode($retrieve, 1);
                $rdb->update("/vicManager", array_keys($data)[0],[
                    "nurseID" => $nurse['ID']
                ]);
            } 
        }

        $_SESSION['success'] = "Thêm thành công.";
    }else{
        $_SESSION['wrong'] = "Thêm thất bại.";
    }
}
header("location: patient.php");

?>