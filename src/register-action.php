<?php
include ("config.php");
include ("firebaseRDB.php");

$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];

$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/user", "Email", "EQUAL", $Email);
$data = json_decode($retrieve, 1);

if(count($data) > 0){
    $_SESSION['wrong'] = "Email đã được sử dụng.";
    header("location: register.php");
}else{
    $insert = $rdb->insert("/user",
    [
        "Email"    => $Email,
        "Username" => $Username,
        "Password" => md5($Password)
    ]);
}

$result = json_decode($insert, 1);
if(isset($result['name'])){
    $_SESSION['success'] = "Đăng ký thành công.";
    header("location: login.php");
}else{
    $_SESSION['wrong'] = "Đăng ký thất bại.";
    header("location: register.php");
}


?>