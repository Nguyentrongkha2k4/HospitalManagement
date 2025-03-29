<?php
include("config.php");
include("firebaseRDB.php");

$nurseName = (isset($_POST['nurseName'])) ? strtolower($_POST['nurseName']) : "";
$nurseID = (isset($_POST["ID"])) ? $_POST["ID"] : "";

if( $nurseID == "" && $nurseName == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/nurse");
    $data = json_decode($retrieve,1);
    $_SESSION['nurseList'] = $data;
    if($data and count($data) == 0){
        $_SESSION["undefind2"] = "Undefind";
    }
    header("location: nurse.php");
}
else if( $nurseID == "" && $nurseName != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/nurse");
    $data = json_decode($retrieve,1);
    $_SESSION["nurseList"] = $data;
    foreach ($_SESSION["nurseList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["nurseName"]),$nurseName)) {
            unset($_SESSION["nurseList"][$key]);
        }
    }
    if(count($_SESSION['nurseList']) == 0){
        $_SESSION["undefind2"] = "Undefind";
    }
    header("location: nurse.php");
}
else if( $nurseID != "" && $nurseName == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/nurse","ID","EQUAL",$nurseID);
    $data = json_decode($retrieve,1);
    $_SESSION["nurseList"] = $data;
    if(count($_SESSION["nurseList"]) == 0){
        $_SESSION["undefind2"] = "Undefind";
    }
    header("location: nurse.php");
}
else {
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/nurse","ID","EQUAL",$nurseID);
    $data = json_decode($retrieve,1);
    $_SESSION["nurseList"] = $data;
    foreach ($_SESSION["nurseList"] as $key => $val){
        if (!str_contains(strtolower($val["nurseName"]),$nurseName)) {
            unset($_SESSION["nurseList"][$key]);
        }
    }
    if(count($_SESSION["nurseList"]) == 0){
        $_SESSION["undefind2"] = "Undefind";
    }
    header("location: nurse.php");
}

