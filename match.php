<!DOCTYPE HTML>
<?php
session_start();
//include("config.php");
if($_POST)
{
	echo $_POST['select'];
	$_SESSION['selected']=$_POST['select'];
	header("location:display.php");
}
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FareShare</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />


  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->


  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<div class="page-inner">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">

			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="dashboardfinal.php">FareShare</a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="features.php">Features</a></li>
						
						<li class="has-dropdown">
							<a href="#">Connect</a>
							<ul class="dropdown gtco-social-icons pull right">
							
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
								
							
						</li>
						
						<li><a href="contact.php">Contact</a></li>
						<li class="has-dropdown">
						   <a href="#">My Account</a>
						    <ul class="dropdown gtco-social-icons pull right">
							   <li> <a href="details_profile.php"><i class="icon-user" style="color:black" ></i>Profile  </a></li>
							   <li> <a href="logout.php "><i class="fa fa-sign-out" ></i> Signout </a> </li>
						
					</ul></li>
						
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover" role="banner" style="background-image: url(images/W3LmKx.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
		<div class="container" style="margin-top:200px;">
		<legend style="color:white"> Search Results</legend>
			<!-- Main component for a primary marketing message or call to action -->
			<div class="row">
				 <?php
				
				 include("config.php");
				 $currentuser=$_SESSION['current_user'];
				 $sql="SELECT pickup,destination,date,time,gender FROM query WHERE email='$currentuser'";
				 $result=mysqli_query($con,$sql);
				 $row=mysqli_fetch_assoc($result);
				 $time=$row['time'];
				 $time1=explode(":",$time);
				 $pickup=$row['pickup'];
				 $destination=$row['destination'];
				 $date=$row['date'];
				 $gender=$row['gender'];
					
				 if($row['gender']==1)
				 {
					 $sql1="SELECT u.name,u.email,u.college,u.gender,q.time,q.date,q.pickup, q.destination from user u, query q where u.email=q.email and q.email!='$currentuser' and q.date='$date' and q.pickup='$pickup' and q.destination='$destination'";
					 $result1=mysqli_query($con,$sql1);
					 if(!$result1)
					 {
						 echo "<script>alert('Some error occured.');</script>";
					 }
				 }
				 else
				 {
					$sql1="SELECT u.name,u.email,u.college,u.gender,q.time,q.date,q.pickup, q.destination from user u, query q where u.email=q.email and q.email!='$currentuser' and q.date='$date' and q.pickup='$pickup' and q.destination='$destination' and u.gender='$gender'";
					$result1=mysqli_query($con,$sql1);
					if(!$result1)
					{
						echo "<script>alert('Some error occured.');</script>";
					}
				 }
				 
				 $i=0;
			while ($row1=mysqli_fetch_array($result1))
			{
			
				$time2=$row1['time'];

				$time3=explode(":",$time2);
			
						if($time3[0]!=$time1[0])
							{
									continue;
							}
				
        ?>
		
		

        <form method="post"  >
             Name
            <input type="text" name="name" value="<?php echo $row1 ['name']; ?> " style="margin :10px; " width="100px"disabled >
             &nbsp Time
            <input type="text" name="time" value="<?php echo $row1 ['time']; ?> "   width="100px"disabled > 
			 
			&nbsp
			&nbsp
			&nbspEmail Id 
			 <input type="text" name="email" value="<?php echo $row1 ['email']; ?> " style="margin :10px; " disabled> 
			
			College
			<input type="text" name="clg" value="<?php echo $row1 ['college']; ?> "  width="100px" disabled>
            <br> Gender
            <input type="text" name="gender" value="<?php echo $row1 ['gender']; ?>"  width="100px"style="margin :10px; " disabled> 
			Date
			&nbsp
			&nbsp
			&nbsp
			&nbsp
			&nbsp
			<input type="text" name="date" value="<?php echo $row1['date']?>"    width="100px"disabled> 
			
		
			&nbsp
			&nbsp
			&nbspPickup
			<input type="text" name="pickup" value="<?php echo $row1['pickup']?>"   style="margin:10px; width:100px;"  disabled>
			Destination
			<input type="text" name="destination" value="<?php echo $row1['destination']?>"   style="margin:10px; width:100px;"  disabled>
			<br>Select This Buddy <input type="radio" name="select"  value="<?php echo $row1['email']; ?>" > </input>
<hr>			<br>
        <?php
		$i++;
        }
        ?>

		<input type="submit" name="submit" value="submit" maxlength="5" class="btn btn-success">             					
        </form>

		</div>
		</div>
			
			</div>

		</div>

	</header>
	
	


	
	
		

	

	

	

					

				

				

				

			
	</div>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

