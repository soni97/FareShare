<?php
session_start();
include("config.php");
$currentuser=$_SESSION['current_user'];
$sql="UPDATE user SET name='',number='',college='',address='',gender='',year='',pwd='',email='' WHERE email='$currentuser'";
$result=mysqli_query($con,$sql);
if(!$result)
{
	echo "<script>alert('Some error occured.');</script>";
}
else
{
	header("location:dashboardfinal.php");
}
?>