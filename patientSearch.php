<?php
include("config.php");
include("firebaseRDB.php");

$patientCCCD = (isset($_POST['CCCD'])) ? $_POST['CCCD'] : "";
$patientName = (isset($_POST['patientName'])) ? strtolower($_POST['patientName']) : "";
$patientBDate = (isset($_POST['dateofborn'])) ? $_POST['dateofborn'] : "";
$patientKhoa = (isset($_POST["recipient-name"])) ? $_POST["recipient-name"] : "";

if( $patientCCCD == "" && $patientName == "" && $patientBDate == ""  && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION['patientList'] = $data;
    header("location: patient.php");
}
else if( $patientCCCD != "" && $patientName == "" && $patientBDate == ""  && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    if(count($data) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    $_SESSION["patientList"] = $data;
    header("location: patient.php");
}
else if( $patientCCCD == "" && $patientName != "" && $patientBDate == "" && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["patientName"]),$patientName)) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: patient.php");
}
else if( $patientCCCD == "" && $patientName == "" && $patientBDate != "" && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val)
    {
        if ($val["dateofborn"] != $patientBDate) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}
else if( $patientCCCD == "" && $patientName == "" && $patientBDate == "" && $patientKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val)
    {
        if ($val["recipient-name"] != $patientKhoa) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

/////// CCCD HANDLING
else if( $patientCCCD != "" && $patientName != "" && $patientBDate == ""  && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if (!str_contains(strtolower($val["patientName"]),$patientName)) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

else if( $patientCCCD != "" && $patientName == "" && $patientBDate != ""  && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if ($val["dateofborn"] != $patientBDate) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

else if( $patientCCCD != "" && $patientName == "" && $patientBDate == ""  && $patientKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if ($val["recipient-name"] != $patientKhoa) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

else if( $patientCCCD != "" && $patientName != "" && $patientBDate != ""  && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if (!str_contains(strtolower($val["patientName"]),$patientName) || $val["dateofborn"] != $patientBDate) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

else if( $patientCCCD != "" && $patientName == "" && $patientBDate != ""  && $patientKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if ($val["recipient-name"] != $patientKhoa || $val["dateofborn"] != $patientBDate) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

else if( $patientCCCD != "" && $patientName != "" && $patientBDate == ""  && $patientKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if (!str_contains(strtolower($val["patientName"]),$patientName) || $val["recipient-name"] != $patientKhoa) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

else if( $patientCCCD != "" && $patientName != "" && $patientBDate != ""  && $patientKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager","CCCD","EQUAL",$patientCCCD);
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if (!str_contains(strtolower($val["patientName"]),$patientName) || $val["dateofborn"] != $patientBDate || $val["recipient-name"] != $patientKhoa ) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

///////// NAME HANDLING
else if( $patientCCCD == "" && $patientName != "" && $patientBDate != "" && $patientKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["patientName"]),$patientName) || $val["dateofborn"] != $patientBDate) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: patient.php");
}

else if( $patientCCCD == "" && $patientName != "" && $patientBDate == "" && $patientKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["patientName"]),$patientName) || $val["recipient-name"] != $patientKhoa) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: patient.php");
}

else if( $patientCCCD == "" && $patientName != "" && $patientBDate != "" && $patientKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["patientName"]),$patientName) || $val["dateofborn"] != $patientBDate || $val["recipient-name"] != $patientKhoa) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: patient.php");
}

////////// BDATE HANDLING
else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/vicManager");
    $data = json_decode($retrieve,1);
    $_SESSION["patientList"] = $data;
    foreach ($_SESSION["patientList"] as $key => $val){
        if ($val["dateofborn"] != $patientBDate || $val["recipient-name"] != $patientKhoa ) {
            unset($_SESSION["patientList"][$key]);
        }
    }
    if($_SESSION["patientList"] and count($_SESSION["patientList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: patient.php");
}

?>