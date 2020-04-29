<?php
include('dbconn.php');
session_start();
$oid = $_SESSION['oid'];
$sid = $_SESSION['sid'];
$bill = $_POST['bill'];
$remarks=$_POST['remarks'];
$order=mysqli_fetch_array(mysqli_query($db,"select * from orders where oid=$oid"));
$shop=mysqli_fetch_array(mysqli_query($db,"select * from shop where sid=$sid"));

date_default_timezone_set("Asia/Kolkata");
$time=date("H:i:s");
$time30 = date("H:i:s", strtotime("+30 minutes", strtotime($time)));

if (!$shop['prev_slot']) {
	$slot = date("H:i:s", strtotime("+30 minutes", strtotime($time)));
}
elseif ($shop['prev_slot'] < $time30 ) {
	$slot = $time30;
}
else{
	$slot = date("H:i:s", strtotime("+10 minutes", strtotime($shop['prev_slot'])));
}



if ($slot > $shop['close_time']) {
	$slot = $shop['open_time'];
}


mysqli_query($db,"update shop set prev_slot='$slot' where sid=$sid");
$sql="update orders set remarks='$remarks', slot='$slot', bill='$bill', status='Ready' where oid=$oid";
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