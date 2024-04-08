<?php 
include("config.php");
include("firebaseRDB.php");

$patientName = $_POST['patientName'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/vicManager", "patientName", "EQUAL", $patientName);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];

$delete = $rdb->delete("/vicManager", $id);
header("location: patient.php");

?>