<?php
include('dbconn.php');
// include('../mailer.php');

extract($_POST);
//cname, cphone, cemail, username, password1, password2

$pass = password_hash($password1, PASSWORD_DEFAULT);

$sql="select username from login_user where username='$username'";
$query=mysqli_query($db,$sql);
$count=mysqli_num_rows($query);
if($count>0)
{
	echo"<script>
		alert('username already exist');
		location.href='register.php'; 
					</script>";	
}
else
{
	if (strcmp($password1,$password2)) {
		echo"<script>
		alert('Passwords donot match.');
		location.href='register.php'; 
					</script>";	
	}
	else{
		$sql="insert into login_user(username,password,name,utype,phone) values(
		'$username','$pass','$cname','customer','$cphone')"; 
		$query=mysqli_query($db,$sql); 
				
		$sql="select uid from login_user where username='$username'";
		$query=mysqli_query($db,$sql); 
		$fetch=mysqli_fetch_array($query);
		$uid=$fetch[0];
		
		$sql="insert into customer(cid,cname,cphone,cemail) values(
		'$uid','$cname','$cphone','$cemail')"; 
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
			echo"<script>alert('Registration successful!  Continue to login.'); 
				location.href='login.php';
					</script>";	
		}
		else {
			echo"<script>alert ('error');
				</script>";
		}
	}
}

	?>
	
