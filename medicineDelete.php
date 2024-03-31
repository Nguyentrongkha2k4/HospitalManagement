<?php
include("config.php");
include("firebaseRDB.php");

$medicineName = $_POST['medicineName'];
$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/medicineManager", "medicineName", "EQUAL", $medicineName);
$data = json_decode($retrieve, 1);
$delete = $rdb->delete("/medicineManager", $data['name']);
header("location: medicine.php");
?>
