<?php
if($_POST)
{
	establish_connections(); //This function establishes connection with the database
	FrgtPassword(); //this function send otp on email id 
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


function FrgtPassword()
{
	session_start();	
	//connection 
	global $con;
	
	//variable
	$email=$_POST['frgtemail'];
	
	
	if(test_availabilty($email))
	{
		$randomSelectOTP = rand(10000,99999);
		$EnterOTP= "UPDATE userinfo SET OTP = '$randomSelectOTP' WHERE Email = '$email' ";
		if (mysqli_query($con, $EnterOTP))
		{	
			//sendOTPmail($email,$randomSelectOTP);
			$_SESSION['SessionEmail']=$email;
			header("location: FrgtEnter.php");	
		}
		else
			echo "Sorry some ERROR";
	
	}
	else
		echo "You have entered wrong email id";
	
	
}


function test_availabilty($email)
{
	global $con;
	$query = "SELECT * FROM userinfo WHERE Email='$email'";
	$query_result = mysqli_query($con,$query);
	return mysqli_fetch_row($query_result)[0];
}


//this function will send otp on user mail id to verify
function sendOTPmail($email,$randomSelectOTP)
{
	$mail = new PHPMailer();
	
	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->Password = "Password";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->SMTPDebug = 1;
	$mail->SMTPSecure = "tls";
	$mail->Username = "janicebing47@gmail.com";
	
	//set from
	$mail->SetFrom("janicebing47@gmail.com");
	
	//set body
	$mail->Body = "Welcome user your OTP is {$randomSelectOTP} check it on our website. go on"; 
	
	//set address
	$mail->addAddress($email);
	
	//mail will send
	$mail->Send();
}



?>


<html>
	<head>
		<title>Forget Password | MyStand</title>
	</head>
	<body>
		<h1 align="center">Forget Password </h1>
		<form action="" method="post">
			<table align="center" border="1">
				<tr>
					<td>Email</td>
					<td><input type="email" name="frgtemail" id="frgtemail"/></td>
				</tr>
				<tr align="center">
					<td colspan="2"><input type="submit" value="Submit"/></td>
				</tr>
			</table>
		</form>
		<h3 align="center">We will send OTP on this Email ID</h3>
	</body>
</html>