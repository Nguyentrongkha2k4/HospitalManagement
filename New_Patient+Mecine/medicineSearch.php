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
    $retrieve = $rdb->retrieve("/medicineManager");
    $data = json_decode($retrieve, 1);
    $_SESSION['medicineList'] = $data;
    foreach ($_SESSION["medicineList"] as $key => $val){
        if (!str_contains(strtolower($val["medicineName"]),$medicineName)) {
            unset($_SESSION["medicineList"][$key]);
        }
    }
    if(count($_SESSION['medicineList']) == 0){
        $_SESSION['undefind'] = "undefind";
    }
    header("location: medicine.php");
}

?>