<?php 
include("config.php");
include("firebaseRDB.php");

unset($_SESSION['user']);
header("location: login.php");
?>