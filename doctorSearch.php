<?php
include("config.php");
include("firebaseRDB.php");

$doctorID = (isset($_POST['ID'])) ? $_POST['ID'] : "";
$doctorName = (isset($_POST['doctorName'])) ? strtolower($_POST['doctorName']) : "";
$doctorPosition = (isset($_POST['position'])) ? $_POST['position'] : "";
$doctorKhoa = (isset($_POST["khoa"])) ? $_POST["khoa"] : "";

if( $doctorID == "" && $doctorName == "" && $doctorPosition == ""  && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION['doctorList'] = $data;
    if($data and count($data) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}
else if( $doctorID != "" && $doctorName == "" && $doctorPosition == ""  && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    if(count($data) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    $_SESSION["doctorList"] = $data;
    header("location: doctor.php");
}
else if( $doctorID == "" && $doctorName != "" && $doctorPosition == "" && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["doctorName"]),$doctorName)) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: doctor.php");
}
else if( $doctorID == "" && $doctorName == "" && $doctorPosition != "" && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val)
    {
        if ($val["position"] != $doctorPosition) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}
else if( $doctorID == "" && $doctorName == "" && $doctorPosition == "" && $doctorKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val)
    {
        if ($val["khoa"] != $doctorKhoa) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

/////// ID HANDLING
else if( $doctorID != "" && $doctorName != "" && $doctorPosition == ""  && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if (!str_contains(strtolower($val["doctorName"]),$doctorName)) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

else if( $doctorID != "" && $doctorName == "" && $doctorPosition != ""  && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if ($val["position"] != $doctorPosition) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

else if( $doctorID != "" && $doctorName == "" && $doctorPosition == ""  && $doctorKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if ($val["khoa"] != $doctorKhoa) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

else if( $doctorID != "" && $doctorName != "" && $doctorPosition != ""  && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if (!str_contains(strtolower($val["doctorName"]),$doctorName) || $val["position"] != $doctorPosition) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

else if( $doctorID != "" && $doctorName == "" && $doctorPosition != ""  && $doctorKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if ($val["khoa"] != $doctorKhoa || $val["position"] != $doctorPosition) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

else if( $doctorID != "" && $doctorName != "" && $doctorPosition == ""  && $doctorKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if (!str_contains(strtolower($val["doctorName"]),$doctorName) || $val["khoa"] != $doctorKhoa) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

else if( $doctorID != "" && $doctorName != "" && $doctorPosition != ""  && $doctorKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor","ID","EQUAL",$doctorID);
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if (!str_contains(strtolower($val["doctorName"]),$doctorName) || $val["position"] != $doctorPosition || $val["khoa"] != $doctorKhoa ) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

///////// NAME HANDLING
else if( $doctorID == "" && $doctorName != "" && $doctorPosition != "" && $doctorKhoa == ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["doctorName"]),$doctorName) || $val["position"] != $doctorPosition) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: doctor.php");
}

else if( $doctorID == "" && $doctorName != "" && $doctorPosition == "" && $doctorKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["doctorName"]),$doctorName) || $val["khoa"] != $doctorKhoa) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: doctor.php");
}

else if( $doctorID == "" && $doctorName != "" && $doctorPosition != "" && $doctorKhoa != ""){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["doctorName"]),$doctorName) || $val["position"] != $doctorPosition || $val["khoa"] != $doctorKhoa) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }

    header("location: doctor.php");
}

////////// Position HANDLING
else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/doctor");
    $data = json_decode($retrieve,1);
    $_SESSION["doctorList"] = $data;
    foreach ($_SESSION["doctorList"] as $key => $val){
        if ($val["position"] != $doctorPosition || $val["khoa"] != $doctorKhoa ) {
            unset($_SESSION["doctorList"][$key]);
        }
    }
    if(count($_SESSION["doctorList"]) == 0){
        $_SESSION["undefind"] = "Undefind";
    }
    header("location: doctor.php");
}

?>