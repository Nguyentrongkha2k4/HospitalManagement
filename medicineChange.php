<?php
include("config.php");
include("firebaseRDB.php");

$choice = $_POST['choice'];
$medicineName = $_POST['medicineName'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/medicineManager", "medicineName", "EQUAL", $medicineName);
$data = json_decode($retrieve, 1);
$id = array_keys($data)[0];
$path = "/medicineManager/". " " .$id."/kho";
if($choice == 1){
    $insert = $rdb->insert($path,
    [
        "inputdate" => $date,
        "amount" => $amount
    ]
    );
    $amount = $amount + $data[$id]['amount'];
    $rdb->update("/medicineManager", $id, 
        [
            "amount" => $amount
        ]);
}else{
    $amount = $data[$id]['amount'] - $amount;
    if($amount < 0){
        $_SESSION['wrong'] = "Số lượng không hợp lệ!";
        header("location: medicine.php");
    }
    $rdb->update("/medicineManager", $id, 
    [
        "amount" => $amount
    ]);
}
header("location: medicine.php");
?>