<?php

if($_POST)
{
	session_start();
	establish_connections(); //This function establishes connection with the database
	otpcheck();//This function check user otp and verify email
	global $con;
}


function establish_connections()
{
	global $con;
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'mystanddata'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error()); 
}


function otpcheck()
{
	//connection prepration
	global $con;
	
	
	//Session variable
	$name=$_SESSION['SessionName'];
	$email=$_SESSION['SessionEmail'];
	
	
	//normal variable
	$UserEnterOTP=$_POST['userotp'];
	$newblock='00';
	
	//fetching variable
	$OTPQuery = "SELECT OTP FROM userinfo WHERE Email='$email'";
	$SystemOTP = mysqli_fetch_row(mysqli_query($con,$OTPQuery))[0];
	
	if($UserEnterOTP==$SystemOTP)
	{
		$BlockQuery="UPDATE userinfo SET BlockStatus='$newblock' WHERE Email='$email'";
		if(mysqli_query($con,$BlockQuery))
		{
			header("location: SelectInterested.php");
		}
		else 
		{
			echo "SORRY we can't cahnge your block status";
		}
	}
	else
	{
		echo "wrong password";
	}
	
}
?>


<html>
	<head>
		<title>Enter OTP | My Stand</title>
	</head>
	<body>
<p align="center">We sent an email on your mail account</p>
<form action="" method="post">
<table align="center" border="1">
<tr>
<td>OTP</td>
<td><input type="number" max="9999" min="1000" name="userotp" id="userotp"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Check"></td>
</tr>
</table>
</form>
</body>
</html>