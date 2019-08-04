<?php
session_start();
// require user to be signed in to access page
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>