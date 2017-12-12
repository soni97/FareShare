<?php
if($_POST)
{
	session_start();	
	establish_connections(); //This function establishes connection with the database
	logincheck(); //This function will check user email and password and add session
	global $con;
}	


function establish_connections()
{
	global $con;
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'mystanddata'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
}


function logincheck()
{
	//variable
	$email = $_POST['useremail'];
	$password = $_POST['userpass']; 
	
	//connection
	global $con;
	
	//Login fetching part
	$check = 0;
	$query = "SELECT * FROM userinfo WHERE Password='$password' AND Email='$email'";
	$result = mysqli_query($con,$query);
	
	if($result)
	{ 
		while($row=mysqli_fetch_row($result))
		{
			if($email==$row[1]&& $password==$row[3])
			{
				$id=$row[0];
				$name=$row[2]; 
				$blockStatus=$row[9];
				$check=1;
			}
		}
	}
			
	if($check==0)
	{
		echo "Invalid Details";
	}
	else
	{
		if($blockStatus==11)
		{	
			$_SESSION['SessionUserID']=$id;
			$_SESSION['SessionEmail']=$email;
			$_SESSION['SessionName']=$name;
			header("location:CheckOTP.php");
		}
		else if($blockStatus==00)
		{
			$_SESSION['SessionUserID']=$id;
			$_SESSION['SessionEmail']=$email;
			$_SESSION['SessionName']=$name;
			header("location:Newsfeed.php");
		}
		else if($blockStatus==1)
		{
			echo "You are block on this website for some days ask admin";
		}
	}
}

?>


<html>
	<head>
		<title>Sign In |My stand</title>
	<style>
	
	</style>
	</head>
	<body>
		<h1 align="center">Login</h1>
		<form action="" method="post">
			<table align="center" border="1">
				<tr>
					<td>User Name</td>
					<td><input type="text" maxlength="255" Id="UserName" name="useremail"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="text" maxlength="16" id="Password" name="userpass"></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" value="Login"></td>
				</tr>
			</table>
		</form>
		<a href="ForgetPassword.php">
		<h4 align="center">Forget Password?</h4>
		</a>
		<a href="Register.php">
		<h4 align="center">Don't have account sign up</h4>
		</a>
	</body>
</html>


