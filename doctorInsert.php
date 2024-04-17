<?php 
include("config.php");
include("firebaseRDB.php");
$obj = $_POST['obj'];
$image_url = $_POST['image'];
$numbers = array(
    0 => "Sáng thứ hai",
    1 => "Chiều thứ hai",
    2 => "Sáng thứ ba",
    3 => "Chiều thứ ba",
    4 => "Sáng thứ tư",
    5 =>  "Chiều thứ tư",
    6 => "Sáng thứ năm", 
    7 => "Chiều thứ năm",
    8 => "Sáng thứ sáu", 
    9 => "Chiều thứ sáu",
    10 => "Sáng thứ bảy", 
    11 => "Chiều thứ bảy",
    12 => "Sáng chủ nhật", 
    13 => "Chiều chủ nhật"
);
shuffle($numbers);
$schedule = array_slice($numbers, 0, 6);
if($obj == "doctor"){
    $ID = "BS".$_POST['ID'];
    $doctorName = $_POST['doctorName'];
    $CCCD = $_POST['CCCD'];
    $dateofborn = date('j-m-Y', strtotime($_POST['dateofborn']));
    $address = $_POST['address'];
    $degree = $_POST['degree'];
    $khoa = $_POST['khoa'];
    $position = $_POST['position'];
    
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor", "ID", "EQUAL", $ID);
    $data = json_decode($retrieve, 1);
    
    if(count($data) > 0){
        $_SESSION['wrong'] = "ID đã tồn tại!";
    }else{
        $retrieve = $rdb->retrieve("/staffManager/doctor", "CCCD", "EQUAL", $CCCD);
        $data = json_decode($retrieve, 1);
    
        if(count($data) > 0){
            $_SESSION['wrong'] = "CCCD đã tồn tại!";
        }else{
            $insert = $rdb->insert("/staffManager/doctor", [
                "ID" => $ID,
                "doctorName" => $doctorName,
                "CCCD" => $CCCD,
                "dateofborn" => $dateofborn,
                "address" => $address,
                "degree" => $degree,
                "khoa" => $khoa,
                "position" => $position,
                "patientNum" => 0,
                "schedule" => [
                    $schedule[0] => 0,
                    $schedule[1] => 0,
                    $schedule[2] => 0,
                    $schedule[3] => 0,
                    $schedule[4] => 0,
                    $schedule[5] => 0,
                ],
                "image_url" => $image_url
            ]);
            
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $retrieve = $rdb->retrieve("/staffManager/doctor", "ID", "EQUAL", $ID);
                $data = json_decode($retrieve, 1);
                $id = array_keys($data)[0];
                $doctor = $data[$id];
                $count = 0;
                $retrieve = $rdb->retrieve("/vicManager", "doctorID", "EQUAL", "N/A");
                $data = json_decode($retrieve, 1);
                if(count($data) > 0){
                    for($i = 0; $i < count($data); ++$i){
                        if(($data[array_keys($data)[$i]]['recipient-name'] == $khoa and $count < 12)){
                            $count++;
                            $doctorkey = $id;
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
                            $rdb->update("/vicManager", array_keys($data)[$i], [
                                "doctorID" => $doctor['ID'],
                                "date" => $day
                            ]);
                        }
                    }
                    $rdb->update("/staffManager/doctor", $id, [
                        "patientNum" => $count
                    ]);
                }

                $_SESSION['success'] = "Thêm bác sĩ thành công!";
            }else{
                $_SESSION['wrong'] = "Thêm bác sĩ thất bại!";
            }
        }
    }
    header("location: doctor.php");
}else if($obj == "nurse"){
    $ID = "YT".$_POST['ID'];
    $nurseName = $_POST['nurseName'];
    $CCCD = $_POST['CCCD'];
    $dateofborn = date('j-m-Y', strtotime($_POST['dateofborn']));
    $address = $_POST['address'];
    $degree = $_POST['degree'];
    
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/nurse", "ID", "EQUAL", $ID);
    $data = json_decode($retrieve, 1);
    
    if(count($data) > 0){
        $_SESSION['wrong'] = "ID đã tồn tại!";
    }else{
        $retrieve = $rdb->retrieve("/staffManager/nurse", "CCCD", "EQUAL", $CCCD);
        $data = json_decode($retrieve, 1);
    
        if(count($data) > 0){
            $_SESSION['wrong'] = "CCCD đã tồn tại!";
        }else{
            $insert = $rdb->insert("/staffManager/nurse", [
                "ID" => $ID,
                "nurseName" => $nurseName,
                "CCCD" => $CCCD,
                "dateofborn" => $dateofborn,
                "address" => $address,
                "degree" => $degree,
                "patientNum" => 0,
                "schedule" => [
                    $schedule[0] => 0,
                    $schedule[1] => 0,
                    $schedule[2] => 0,
                    $schedule[3] => 0,
                    $schedule[4] => 0,
                    $schedule[5] => 0,
                ],
                "image_url" => $image_url
            ]);
            
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $retrieve = $rdb->retrieve("/staffManager/nurse", "ID", "EQUAL", $ID);
                $data = json_decode($retrieve, 1);
                $id = array_keys($data)[0];
                $nurse = $data[$id];
                $count = 0;
                $retrieve = $rdb->retrieve("/vicManager", "nurseID", "EQUAL", "N/A");
                $data = json_decode($retrieve, 1);
                if(count($data) > 0){
                    for($i = 0; $i < count($data); ++$i){
                        if($count < 12){
                            $count++;
                            $rdb->update("/vicManager", array_keys($data)[$i], [
                                "nurseID" => $nurse['ID']
                            ]);
                        }
                    }
                    $rdb->update("/staffManager/nurse", $id, [
                        "patientNum" => $count
                    ]);
                }

                $_SESSION['success'] = "Thêm y tá thành công!";
            }else{
                $_SESSION['wrong'] = "Thêm y tá thất bại!";
            }
        }
    }
    header("location: nurse.php");
}else if($obj == "support"){
    $ID = "SP".$_POST['ID'];
    $supportName = $_POST['supportName'];
    $CCCD = $_POST['CCCD'];
    $dateofborn = date('j-m-Y', strtotime($_POST['dateofborn']));
    $address = $_POST['address'];
    $degree = $_POST['degree'];
    $position = $_POST['position'];
    
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support", "ID", "EQUAL", $ID);
    $data = json_decode($retrieve, 1);
    
    if(count($data) > 0){
        $_SESSION['wrong'] = "ID đã tồn tại!";
    }else{
        $retrieve = $rdb->retrieve("/staffManager/support", "CCCD", "EQUAL", $CCCD);
        $data = json_decode($retrieve, 1);
    
        if(count($data) > 0){
            $_SESSION['wrong'] = "CCCD đã tồn tại!";
        }else{
            $insert = $rdb->insert("/staffManager/support", [
                "ID" => $ID,
                "supportName" => $supportName,
                "CCCD" => $CCCD,
                "dateofborn" => $dateofborn,
                "address" => $address,
                "degree" => $degree,
                "position" => $position,
                "schedule" => $schedule,
                "image_url" =>$image_url
            ]);
            
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $_SESSION['success'] = "Thêm nhân viên hỗ trợ thành công.";
            }else{
                $_SESSION['wrong'] = "Thêm nhân viên hỗ trợ thất bại.";
            }
        }
    }
    header("location: support.php");
}


