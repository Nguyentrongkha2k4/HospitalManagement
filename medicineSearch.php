<?php
include("config.php");
include("firebaseRDB.php");

$medicineName = $_POST['medicineName'];
if($medicineName == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/medicineManager");
    $data = json_decode($retrieve, 1);
    $_SESSION['medicineList'] = $data;
    header("location: medicine.php");
}else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/medicineManager", "medicineName", "EQUAL", $medicineName);
    $data = json_decode($retrieve, 1);
    if(count($data) == 0){
        $_SESSION['undefind'] = "undefind";
    }
    $_SESSION['medicineList'] = $data;
    header("location: medicine.php");
}

?>