<?php
include('dbconn.php');
session_start();
$oid = $_SESSION['oid'];
$sid = $_SESSION['sid'];
$bill = $_POST['bill'];
$remarks=$_POST['remarks'];
$order=mysqli_fetch_array(mysqli_query($db,"select * from orders where oid=$oid"));
$cid=$order['cid'];
$shop=mysqli_fetch_array(mysqli_query($db,"select * from shop where sid=$sid"));
$cust=mysqli_fetch_array(mysqli_query($db,"select * from customer where cid=$cid"));
$phone=$cust['cphone'];
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

	$field = array(
	    "sender_id" => "FSTSMS",
	    "language" => "english",
	    "route" => "qt",
	    "numbers" => "$phone",
	    "message" => "26462",
	    "variables" => "{#BB#}|{#AA#}",
    	"variables_values" => "$slot | $bill"
	);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_SSL_VERIFYHOST => 0,
	  CURLOPT_SSL_VERIFYPEER => 0,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($field),
	  CURLOPT_HTTPHEADER => array(
	    "authorization: JQNthPXxGZSY0dn8mesvUrIzcBR9kguLfAWCD2p3qb17yVMoj4HkwM8FszZ5iGohAec10fWvEmlyKLgX",
	    "cache-control: no-cache",
	    "accept: */*",
	    "content-type: application/json"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);



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