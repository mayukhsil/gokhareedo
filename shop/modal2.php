<?php
	session_start();
	include 'dbconn.php';
	$cid = $_GET["cid"];
	$sid = $_GET["sid"];
	$_SESSION['sid'] = $sid;
	$sql="insert into orders(sid,cid) values('$sid','$cid')"; 
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
		$order=mysqli_fetch_array(mysqli_query($db,"select * from orders where sid='$sid' and cid='$cid'"));
		$oid = $order['oid'];
		$_SESSION['oid'] = $oid;
		
	}
?>


