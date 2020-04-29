<?php
include('dbconn.php');
session_start();
$oid = $_SESSION['oid'];

$sql="update orders set status='Completed' where oid=$oid";
$query=mysqli_query($db,$sql);
if($query){
	header("location: dashboard.php");
}
	
else
{
	echo"<script>
		alert('Error');
		location.href='dashboard.php'; 
					</script>";	
}

?>