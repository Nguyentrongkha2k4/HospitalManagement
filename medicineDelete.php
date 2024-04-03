<?php
include("config.php");
include("firebaseRDB.php");

$medicineName = $_POST['medicineName'];
$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/medicineManager", "medicineName", "EQUAL", $medicineName);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
$delete = $rdb->delete("/medicineManager", $id);
header("location: medicine.php");
?>
