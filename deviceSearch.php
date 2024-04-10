<?php
include("config.php");
include("firebaseRDB.php");

$deviceName = (isset($_POST['deviceName'])) ? strtolower($_POST['deviceName']) : "";
$devicePurpose = (isset($_POST["devicePurpose"])) ? $_POST["devicePurpose"] : "";

if( $devicePurpose == "" && $deviceName == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/deviceManager/device");
    $data = json_decode($retrieve,1);
    $_SESSION['deviceList'] = $data;
    header("location: device.php");
}
else if( $devicePurpose == "" && $deviceName != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/deviceManager/device");
    $data = json_decode($retrieve,1);
    $_SESSION["deviceList"] = $data;
    foreach ($_SESSION["deviceList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["deviceName"]),$deviceName)) {
            unset($_SESSION["deviceList"][$key]);
        }
    }
    if(count($_SESSION['deviceList']) == 0){
        $_SESSION["undefind"] = "undefind1";
    }
    header("location: device.php");
}
else if( $devicePurpose != "" && $deviceName == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/deviceManager/device");
    $data = json_decode($retrieve,1);
    $_SESSION["deviceList"] = $data;
    foreach ($_SESSION["deviceList"] as $key => $val)
    {
        if ($val['purpose'] != $devicePurpose) {
            unset($_SESSION["deviceList"][$key]);
        }
    }
    if(count($_SESSION["deviceList"]) == 0){
        $_SESSION["undefind"] = "undefind2";
    }

    header("location: device.php");
}
else {
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/deviceManager");
    $data = json_decode($retrieve,1);
    $_SESSION["deviceList"] = $data;
    foreach ($_SESSION["deviceList"] as $key => $val){
        if (!str_contains(strtolower($val["deviceName"]),$deviceName) || $val['purpose'] != $devicePurpose) {
            unset($_SESSION["deviceList"][$key]);
        }
    }
    if(count($_SESSION["deviceList"]) == 0){
        $_SESSION["undefind"] = "undefind3";
    }
    header("location: device.php");
}

?>