<?php
session_start();
establish_connections(); //This function establishes connection with the database
$email = $_SESSION['SessionEmail'];
global $email;

if($_POST)
{
	UpdateUserInfo();	
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

function UpdateUserInfo()
{
	//variable
	global $con;

	$name = $_POST['UserName']; 
	$gender = $_POST['UserGender'];
	$password = $_POST['UserPassword'];
	$phone = $_POST['UserPhone'];
	$dob = $_POST['UserDOB'];
	
	//query
	$UpdateQuery = "UPDATE userinfo SET Name='$name', Gender='$gender', password='$password', Phone='$phone', DOB='$dob'  WHERE Email='$email'";
	$UpdateResult = mysqli_query($con, $UpdateQuery);
	
	if($UpdateResult)
			echo "<script>alert('We have update your profile if change your name then from  next login we will change it');window.location.href='Newsfeed.php';</script>";
}

function FetchUserInfo()
{
	//connection
	global $con;
	
	//variable
	global $email;
	
	//query
	$fetchinfoquery = "SELECT Name, Gender, Password, Phone, DOB FROM userinfo WHERE email= '$email'";
	$result = mysqli_query($con, $fetchinfoquery);
	
	$row = mysqli_fetch_row($result);

	return $row;
}

?>
<html>
	<head>
		<title>Edit Profile | MyStand</title>
	</head>
	
	
	<body>
		<div style="position:fixed; width:100%; align:left; top:0px; left:0px; overflow-x:hidden;">
			<table width="100%" border="1" bgcolor="#0F7DC2">
				<tr>
					<td style="width:30%"></td>
					<td style="width:20%">	
											<a href="Profile.php"><img src="Images/profile.jpg" title="Edit Profile" width="40px" height="40px"></a>
											<a href="Newsfeed.php"><img src="Images/newsfeed.jpeg" title="NewsFeed" width="40px" height="40px"></a>
											<a href="SelectInterested.php"><img src="Images/topic.png" title="Select Topic" width="40px" height="40px"></a>
											<a href="logout.php"><img src="Images/logout.png"  title="Logout :'(" width="40px" height="40px"></a>
					</td>
					<td style="width:50%"></td>
				</tr>
			</table>
		</div>
		
	
	<br>
	<br>
	<br>
	

    <form action="" method="post">
	<?php
		$info = FetchUserInfo();
		?>
		<table align="center" border="1">
			<tr>
				<td>Name</td>
				<td><input type="text" name="UserName" <?php echo "value='$info[0]'"; ?>></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><input type="radio" value="male" name="UserGender" <?php if($info[1]=='male') echo "checked" ?>>Male
					<input type="radio" value="female" name="UserGender" <?php if($info[1]=='female') echo "checked" ?> >Female
				</td>
            </tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="UserPassword" <?php echo "value='$info[2]'"; ?> ></td>
            </tr>
			<tr>
				<td>Phone</td>
				<td><input type="text" name="UserPhone" <?php echo "value='$info[3]'"; ?> ></td>
            </tr>
			<tr>
				<td>DOB</td>
				<td><input type="date" name="UserDOB" <?php echo "value='$info[4]'"; ?> ></td>
            </tr>
			<tr>
				<td align="center" colspan="2">
				<input type="submit" name="submit" value="Update">
				</td>
			</tr>
		</table>
	</form>

    </body>
</html>