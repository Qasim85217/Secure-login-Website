<?php
    session_start();
    if (isset($_SESSION["login"]) || $_SESSION["login"] == true) {
        session_unset();
        session_destroy();
        header("location: login.php");
        exit;
    }
    else{
        header("location: login.php");
    }
?>