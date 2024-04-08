<?php
include("config.php");
include("firebaseRDB.php");

$choice = $_POST['choice'];
$medicineName = $_POST['medicineName'];
$amount = $_POST['amount'];
$date = $_POST['date'];

if($amount <= 0){
    $_SESSION['wrong'] = "Số lượng không hợp lệ!";
}else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/medicineManager", "medicineName", "EQUAL", $medicineName);
    $data = json_decode($retrieve, 1);
    $id = array_keys($data)[0];
    $path = "/medicineManager/".$id."/kho";
    
    if($choice == "Nhập"){
        $insert = $rdb->insert($path,
        [
            "date" => $date,
            "amount" => $amount,
            "act" => $choice,
            "hsd" => date('Y-m-j', strtotime('+2 year', strtotime($date)))
        ]
        );
        $amount = $amount + $data[$id]['amount'];
        $rdb->update("/medicineManager", $id, 
            [
                "amount" => $amount
            ]);
    }else{
        $amount = $data[$id]['amount'] - $amount;
        if((int)$amount < 0){
            $_SESSION['wrong'] = "Số lượng không hợp lệ!";
        }else{
            $insert = $rdb->insert($path,
            [
                "date" => $date,
                "amount" => $amount,
                "act" => $choice,
                "hsd" => date('Y-m-j', strtotime('+2 year', strtotime($date)))
            ]
            );
            $rdb->update("/medicineManager", $id, 
            [
                "amount" => $amount
            ]);
        }
    }
}

header("location: medicine.php");
?>