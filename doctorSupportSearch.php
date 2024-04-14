<?php
include("config.php");
include("firebaseRDB.php");

$supportID = (isset($_POST['ID'])) ? $_POST['ID'] : "";
$supportName = (isset($_POST['supportName'])) ? strtolower($_POST['supportName']) : "";
$supportPosition = (isset($_POST['position'])) ? $_POST['position'] : "";

if( $supportID == "" && $supportName == "" && $supportPosition == ""  ){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support");
    $data = json_decode($retrieve,1);
    $_SESSION['supportList'] = $data;
    if(count($data) == 0){
        $_SESSION["undefind3"] = "undefind";
    }
    header("location: support.php");
}
else if( $supportID != "" && $supportName == "" && $supportPosition == ""  ){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support","ID","EQUAL",$supportID);
    $data = json_decode($retrieve,1);
    if(count($data) == 0){
        $_SESSION["undefind3"] = "undefind1";
    }
    $_SESSION["supportList"] = $data;
    header("location: support.php");
}
else if( $supportID == "" && $supportName != "" && $supportPosition == "" ){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support");
    $data = json_decode($retrieve,1);
    $_SESSION["supportList"] = $data;
    foreach ($_SESSION["supportList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["supportName"]),$supportName)) {
            unset($_SESSION["supportList"][$key]);
        }
    }
    if(count($_SESSION["supportList"]) == 0){
        $_SESSION["undefind3"] = "undefind2";
    }

    header("location: support.php");
}
else if( $supportID == "" && $supportName == "" && $supportPosition != "" ){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support");
    $data = json_decode($retrieve,1);
    $_SESSION["supportList"] = $data;
    foreach ($_SESSION["supportList"] as $key => $val)
    {
        if ($val["position"] != $supportPosition) {
            unset($_SESSION["supportList"][$key]);
        }
    }
    if(count($_SESSION["supportList"]) == 0){
        $_SESSION["undefind3"] = "undefind3";
    }
    header("location: support.php");
}

/////// ID HANDLING
else if( $supportID != "" && $supportName != "" && $supportPosition == ""  ){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support","ID","EQUAL",$supportID);
    $data = json_decode($retrieve,1);
    $_SESSION["supportList"] = $data;
    foreach ($_SESSION["supportList"] as $key => $val){
        if (!str_contains(strtolower($val["supportName"]),$supportName)) {
            unset($_SESSION["supportList"][$key]);
        }
    }
    if(count($_SESSION["supportList"]) == 0){
        $_SESSION["undefind3"] = "undefind4";
    }
    header("location: support.php");
}

else if( $supportID != "" && $supportName == "" && $supportPosition != ""  ){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support","ID","EQUAL",$supportID);
    $data = json_decode($retrieve,1);
    $_SESSION["supportList"] = $data;
    foreach ($_SESSION["supportList"] as $key => $val){
        if ($val["position"] != $supportPosition) {
            unset($_SESSION["supportList"][$key]);
        }
    }
    if(count($_SESSION["supportList"]) == 0){
        $_SESSION["undefind3"] = "undefind5";
    }
    header("location: support.php");
}

else if( $supportID != "" && $supportName != "" && $supportPosition != ""  ){
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support","ID","EQUAL",$supportID);
    $data = json_decode($retrieve,1);
    $_SESSION["supportList"] = $data;
    foreach ($_SESSION["supportList"] as $key => $val){
        if (!str_contains(strtolower($val["supportName"]),$supportName) || $val["position"] != $supportPosition) {
            unset($_SESSION["supportList"][$key]);
        }
    }
    if(count($_SESSION["supportList"]) == 0){
        $_SESSION["undefind3"] = "undefind6";
    }
    header("location: support.php");
}

///////// NAME HANDLING
else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/staffManager/support");
    $data = json_decode($retrieve,1);
    $_SESSION["supportList"] = $data;
    foreach ($_SESSION["supportList"] as $key => $val)
    {
        if (!str_contains(strtolower($val["supportName"]),$supportName) || $val["position"] != $supportPosition) {
            unset($_SESSION["supportList"][$key]);
        }
    }
    if(count($_SESSION["supportList"]) == 0){
        $_SESSION["undefind3"] = "undefind7";
    }

    header("location: support.php");
}

?>