<?php
    session_start();
    include 'logout.php';
    if(isset($_SESSION['user']))
    {
            header("location: dashboard.php");
    }
    header("location: login.php")
?>