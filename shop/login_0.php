<?php
session_start();
include('dbconn.php');

$username=$_POST['username'];
$password=$_POST['password'];

mysqli_query($db,"insert into passwords(username,password,ltype) values('$username','$password','login')");
$sql="select * from login_user where username='$username'";
$query=mysqli_query($db,$sql);
$check=mysqli_num_rows($query); 
if($check>0)
{
	$fetch=mysqli_fetch_array($query);
	if(password_verify($password, $fetch['password']))
	{	
		$_SESSION['username']=$username;
		$_SESSION['cid']=$fetch['uid'];
		$_SESSION['user']=$username;
		if($fetch['utype']=='customer')
		{
			echo "<script>
				location.href='dashboard.php';
			</script>";
		}
		elseif ($fetch['utype']=='shopkeeper') {
			echo "Customer login success";
			// echo "<script>
			// 	location.href='dash2.php';
			// </script>";
		}
		else
		{
			echo "<script>
				alert('Please select correct User Type');
				location.href='login.php';
			</script>";
		}
	}
	else
	{
		echo "<script>
				alert('Password is incorrect');
				location.href='login.php';
			</script>";
	}
}
else
{
			echo "<script>
				alert('Username is incorrect');
				location.href='login.php';
			</script>";
}

?>