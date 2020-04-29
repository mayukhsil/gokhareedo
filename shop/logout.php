<?php
include('dbconn.php');
session_start();
if(isset($_SESSION['user']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
header("location: login.php");
?>