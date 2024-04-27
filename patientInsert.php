<?php
include("config.php");
include("firebaseRDB.php");

$patientCCCD = $_POST['CCCD'];
$gender = $_POST['gender'];
$patientName = $_POST['patientName'];
$patientBDate = $_POST['dateofborn'];
$patientAddress = $_POST['address'];
$patientKhoa = $_POST['recipient-name'];
$patientImage = $_POST['image'];
$patientDoctor = null;
// $patientImage = $_POST['image_url'];

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
        "gender" => $gender,
        "dateofborn" => date('j-m-Y', strtotime($patientBDate)),
        "address"=> $patientAddress,
        "recipient-name" => $patientKhoa,
        "image_url" => $patientImage,
        "doctorID"=> "N/A", //// => $patientDoctor
        "nurseID" => "N/A",
        "result" => "",
        "history" => "",
        "date" => "",
        // "image" => $patientImage
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
                $doctorkey = array_keys($data)[0];
                $retrieve = $rdb->retrieve("/staffManager/doctor/".$doctorkey."/schedule");
                $schedule = json_decode($retrieve, 1);
                $day = array_keys($schedule)[0];
                for($i = 1; $i < 6; ++$i){
                    if($schedule[array_keys($schedule)[$i]] < $schedule[$day]){
                        $day = array_keys($schedule)[$i];
                    }
                }
                $amountinday = $schedule[$day] + 1;
                $rdb->update("/staffManager/doctor/".$doctorkey,"schedule", [
                    $day => $amountinday
                ]);
                // update doctor in patient
                $retrieve = $rdb->retrieve("/vicManager", "CCCD", "EQUAL", $patientCCCD);
                $data = json_decode($retrieve, 1);
                $rdb->update("/vicManager", array_keys($data)[0],[
                    "doctorID" => $doctor['ID'],
                    "date" => $day
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
                // $nursekey = array_keys($data)[0];
                // $retrieve = $rdb->retrieve("/staffManager/nurse/".$nursekey."/schedule");
                // $schedule = json_decode($retrieve, 1);
                // $day = array_keys($schedule)[0];
                //     for($i = 1; $i < 6; ++$i){
                //         if($schedule[array_keys($schedule)[$i]] < $schedule[$day]){
                //             $day = array_keys($schedule)[$i];
                //         }
                //     }
                
                // $amountinday = $schedule[$day] + 1;
                // echo $amountinday;
                // $rdb->update("/staffManager/nurse/".$nursekey,"schedule", [
                //     $day => $amountinday
                // ]);
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