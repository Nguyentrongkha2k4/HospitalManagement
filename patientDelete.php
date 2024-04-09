<?php 
include("config.php");
include("firebaseRDB.php");

$CCCD = $_POST['CCCD'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/vicManager", "CCCD", "EQUAL", $CCCD);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
echo $retrieve;
$delete = $rdb->delete("/vicManager", $id);
$result = json_decode($delete, 1);

if(!isset($result['name'])){
    $_SESSION['success'] = "Xóa thành công!";
}else{
    $_SESSION['wrong'] = "Xóa thất bại!";
}
header("location: patient.php");

?>