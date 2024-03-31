<?php 
include ("config.php");
include ("firebaseRDB.php");

$ID = $_POST['ID'];
if($ID = ""){
    $rdb = new firebaseRDB();
}else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve('/doctor', '', 'AQUAL', $ID); 
}

?>