<?php
	session_start();

	//login=false
	if (!isset($_SESSION['login'])) {
      	header("Location: login.php");
      	exit;
	}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jual.in</title>
	<link rel="stylesheet" type="text/css" href="css/style_profile.css?v=<?php echo time(); ?>">

	<!--fontawesome-->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!--fontstyle-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<!--header-->
	<div class="header">
		<h3>My Profile</h3>
	</div>	
	<!--header-end-->



	<!--profile-->
	<div class="profile-box">
		<div class="profile">
			<div class="profile-pic">
				<i class="far fa-user"></i>
			</div>	

			<ul class="description">
				<li><h3 id="username"><?= strtoupper($_SESSION['username']); ?> </h3></li>
				<li><p id="email"><?= $_SESSION['email']; ?></p></li>
				<li><p>Buyer</p></li>
			</ul>
		</div>

		<a href="edit-profile.php" class="edit"><i class="fad fa-pen"></i></a>
	</div>
	<!--profile-end-->



	<!--profile-menu-->
	<div class="profile-menu">
		<h4>Menu</h4>
		<ul class="menu">
			<li><a href="order-history.php">
				<span><i class="fad fa-receipt"></i>Orders History</span>
				<i class="far fa-angle-right"></i>
			</a></li>
			<li><a href="notifications.php">
				<span><i class="fad fa-bell"></i></i>Notifications</span>
				<i class="far fa-angle-right"></i>
			</a></li>
			<li><a href="coupons.php">
				<span><i class="fad fa-percent"></i></i>Coupons</span>
				<i class="far fa-angle-right"></i>
			</a></li>
			<li><a href="password-setting.php">
				<span class="left"><i class="fad fa-cog"></i></i>Password Setting</span>
				<i class="far fa-angle-right"></i>
			</a></li>
			<li><a href="logout.php">
				<span class="left"><i class="fad fa-sign-out-alt"></i>Log out</span>
				<i class="far fa-angle-right"></i>
			</a></li>
			<li><a href="seller-page.php">
				<span class="extraLeft"><i class="fad fa-store"></i>Store</span>
				<i class="far fa-angle-right"></i>
			</a></li>
		</ul>
	</div>
	<!--profile-menu-end-->




	<!--script-for-user-information-->


</body>
</html>