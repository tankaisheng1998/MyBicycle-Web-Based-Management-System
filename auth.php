<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
    if(!isset($_SESSION["username1"])){
header("Location: login.php");
exit(); }
?>