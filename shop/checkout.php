<?php
include('dbconn.php');
// include('../mailer.php');
$oid = $_GET['oid'];
$shop=mysqli_fetch_array(mysqli_query($db,"select * from orders,shop where orders.oid=$oid and orders.sid=shop.sid"));
$phone = $shop['phone'];
$sql="update orders set status='Pending' where oid='$oid'"; 
$query=mysqli_query($db,$sql); 

if($query) {    
	// $content1 = 'Dear '.$name.', <br> 
	// 			Your account has been successfully setup and activated. <br>
	// 			You can use the dashboard to view and manage all the issues for your council. <br><br>
	// 			Login Details:<br>
	// 			Username: '.$username.'<br>
	// 			Password: '.$password.'<br><br>

	// 			Proceed to <a href="login.telluswhere.net">login.telluswhere.net</a> to login to your account.
	// 			Thanks and regards, <br>
	// 			Team TellUsWhere.';

	// $mailStatus1 = mailerAPI($email, $name, '[TellUsWhere] Your account has been setup!', $content1);
	$field = array(
	    "sender_id" => "FSTSMS",
	    "language" => "english",
	    "route" => "qt",
	    "numbers" => "$phone",
	    "message" => "26446",
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
	header("location: orders.php");
}
else {
	echo"<script>alert ('error');
		</script>";
	header("location: orders.php");
}



?>
	
