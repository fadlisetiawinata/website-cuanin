<?php
	session_start();

	//login=false
	if (!isset($_SESSION['login'])) {
      	header("Location: login.php");
      	exit;
	}

	//username
	$username = strtoupper($_SESSION['username']);
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jual.in</title>
	<link rel="stylesheet" type="text/css" href="css/style_seller-page.css?v=<?php echo time(); ?>">

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
		<h3><i class="fad fa-store"></i> <?= $username; ?>'S STORE</h3>
	</div>	
	<!--header-end-->



	<!--menu-->
	<div class="container">
		<a href="my-product.php" class="menu-box">
			<i class="far fa-inventory"></i>
			<span>My Products</span>
		</a>
		<a href="add-product.php" class="menu-box">
			<i class="far fa-plus-square"></i>
			<span>Add Product</span>
		</a>
		<a href="sales-history.php" class="menu-box">
			<i class="fad fa-receipt"></i>
			<span>Sales History</span>
		</a>
	</div>
	<!--menu-end-->
</body>
</html>