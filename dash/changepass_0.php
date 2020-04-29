<?php
include('dbconn.php');

session_start();
$username=$_SESSION['username'];
$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$confirmpassword=$_POST['confirmpassword'];

if($newpassword==$confirmpassword){
	$password = password_hash($newpassword, PASSWORD_DEFAULT);
	$sql="select * from login_user where username='$username'";
	$query=mysqli_query($db,$sql);
	$check=mysqli_num_rows($query);
	if($check>0)
	{
		$fetch=mysqli_fetch_array($query);
		if(password_verify($newpassword, $fetch['password'])){
			echo "<script>alert('New password is same as old password.');
				location.href='login.php'; 
				</script>";
		}
		else{
			if(password_verify($oldpassword, $fetch['password']))
			{	
				$sql="UPDATE login_user SET password='$password' where username='$username'";
				$query=mysqli_query($db,$sql);
				if($query)
				{
					echo "<script>
						alert('Password changed.');
						location.href='login.php'; 
						 </script>";
				}
				else
				{
					echo "<script>
						alert('error');
						location.href='login.php'; 
						 </script>";
				} 
				
			}
			else
			{
				echo "<script>alert('Incorrect password.');
				location.href='login.php'; 
				</script>";
			}
		}
	}
	else
	{
		echo "Username does'nt exist";
	}

}
else{
	echo "<script>alert('Passwords donot match.');
			location.href='login.php'; 
			</script>";
}


?>