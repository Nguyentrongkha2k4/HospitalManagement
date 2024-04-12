<?php 
include("config.php");
include("firebaseRDB.php");
$obj = $_POST['obj'];

if($obj == "doctor"){
    $ID = $_POST['ID'];
    $doctorName = $_POST['doctorName'];
    $CCCD = $_POST['CCCD'];
    $dateofborn = $_POST['dateofborn'];
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
                "position" => $position
            ]);
            
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $_SESSION['success'] = "Thêm thành công!";
            }else{
                $_SESSION['wrong'] = "Thêm thất bại!";
            }
        }
    }
}else if($obj == "nurse"){
    $ID = $_POST['ID'];
    $nurseName = $_POST['nurseName'];
    $CCCD = $_POST['CCCD'];
    $dateofborn = $_POST['dateofborn'];
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
            ]);
            
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $_SESSION['success'] = "Thêm thành công!";
            }else{
                $_SESSION['wrong'] = "Thêm thất bại!";
            }
        }
    }
}else if($obj == "support"){
    $ID = $_POST['ID'];
    $supportName = $_POST['supportName'];
    $CCCD = $_POST['CCCD'];
    $dateofborn = $_POST['dateofborn'];
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
                "position" => $position
            ]);
            
            $result = json_decode($insert, 1);
            if(isset($result['name'])){
                $_SESSION['success'] = "Thêm thành công!";
            }else{
                $_SESSION['wrong'] = "Thêm thất bại!";
            }
        }
    }
}

header("location: doctor.php");

?>