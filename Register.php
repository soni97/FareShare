<?php

if($_POST)
{
	session_start();	
	establish_connections(); //This function establishes connection with the database
	newuser();               //This function adds the new user
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


function newuser()
{
	//Connection preparation
	global $con;
	
	
	//Variable declaration
	$name = $_POST['username'];
	$email = $_POST['useremail'];
	$dob=$_POST['userdob'];
	$password = $_POST['userpass']; 
	$gender =$_POST['usergender'];
	$phone = $_POST['userphone'];
	
	
	//Output data
	$query = "INSERT INTO userinfo(Email, Name, Password, Gender, DOB, Phone) VALUES('$email', '$name', '$password','$gender', '$dob', '$phone')"; 
	
	//Functionality
	if(test_availabilty($email) && mysqli_query($con, $query)) 
	{
		$randomSelectOTP = rand(1000,9999);
		$EnterOTP= "UPDATE userinfo SET OTP = '$randomSelectOTP' WHERE Email = '$email' ";
		if (mysqli_query($con, $EnterOTP))
		{	
			//sendOTPmail($email,$randomSelectOTP);
			$_SESSION['SessionEmail']=$email;
			$_SESSION['SessionName']=$name;
			header("location: CheckOTP.php");	
		}
		else
			echo "Sorry some ERROR";
	}
	else
	{
		echo "no";
	}
}


//this function check email in database if its their then say no to new account
function test_availabilty($email)
{
	global $con;
	$query = "SELECT * FROM userinfo WHERE Email='$email'";
	$query_result = mysqli_query($con,$query);
	return !mysqli_fetch_row($query_result)[0];
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
		<title>Sign Up | My Stand</title>
		<style>
			
		</style>
	</head>
	<body>
		<h1 align="center">Register</h1>
		<form action="" method="post">
			<table align="center" border="12">
				<tr>
					<td>Name</td>
					<td><input type="text" maxlength="255" id="UserName" name="username"/></td>
				</tr>
				<tr>
					<td>Email ID</td>
					<td><input type="text" maxlength="255" id="UserEmail" name="useremail"/></td>
				</tr>
				<tr>
					<td>Date Of Birth</td>
					<td><input type="date" id="UserDOB" name="userdob"/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" maxlength="16" id="UserPassword" name="userpass"/></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td><input type="radio" value="male" name="usergender" checked/>Male
					<input type="radio" value="female" name="usergender" />Female</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td><input type="number"  name="userphone"/></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" value="Register"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>