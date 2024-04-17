<?php 
include("config.php");
include("firebaseRDB.php");

$CCCD = $_POST['CCCD'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/staffManager/support", "CCCD", "EQUAL", $CCCD);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];

$delete = $rdb->delete("/staffManager/support", $id);
$result = json_decode($delete, 1);
if(!isset($result['name'])){
    $_SESSION['success'] = "Xóa nhân viên hỗ trợ thành công.";
}else{
    $_SESSION['wrong'] = "Xóa nhân viên hỗ trợ thất bại.";
}
header("location: support.php");
?>