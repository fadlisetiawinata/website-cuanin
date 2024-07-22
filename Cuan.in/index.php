<?php
	session_start();
	require 'function.php';


	//active-user-session
	$user_id = null;
	if (isset($_SESSION['login'])) {
      	$user_id = $_SESSION['user_id'];
	}

	//reset-order-filter-for-product-page
	$_SESSION['orderFilter'] = 'id_produk DESC';
	
	//search-button
  	if(isset($_POST['search'])){
  		$keyword = $_POST['keyword'];
  		header("Location: search.php?s=$keyword");
        exit;
  	}

  	//fetch-sql
	$produk = query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6");

	//cart-button
	if(isset($_POST['cart'])){
		//login=false
		if (!isset($_SESSION['login'])) {
			echo "
				<script>
					alert('Login First');
					document.location.href = 'index.php';
				</script>
			";
			die;
		}

		//cannot-buy-your-own-product
		if (ownproduct($_POST) > 0){
			echo "
				<script>
					alert('You Cannot Buy Your Own Product');
					document.location.href = 'index.php';
				</script>
			";
			die;
		}

		//move-success
		if (movetocart($_POST) > 0){
			echo "
				<script>
					alert('Added to Cart');
					document.location.href = 'index.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Cannot Add to Cart');
					document.location.href = 'index.php';
				</script>
			";
		}
	}

	//wishlist-button
	if(isset($_POST['wishlist'])){
		//login=false
		if (!isset($_SESSION['login'])) {
			echo "
				<script>
					alert('Login First');
					document.location.href = 'index.php';
				</script>
			";
			die;
		}

		//cannot-buy-your-own-product
		if (ownproduct($_POST) > 0){
			echo "
				<script>
					alert('You Cannot Add Your Own Product');
					document.location.href = 'index.php';
				</script>
			";
			die;
		}

		//add-success
		if (addwishlist($_POST) > 0){
			echo "
				<script>
					alert('Added to Wishlist');
					document.location.href = 'index.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Cannot Add to Wishlist');
					document.location.href = 'index.php';
				</script>
			";
		}
	}
	
	//cart-item-counter
	$icart = icart();

	//wishlist-item-counter
	$iwishlist = iwishlist();

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cuan.in</title>
	<link rel="stylesheet" type="text/css" href="css/style_dashboard.css?v=<?php echo time(); ?>">

	<!--fontawesome-->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!--fontstyle-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 

</head>
<body>
	<!--navbar-->
	<nav class="navigation">
		<a href="#footer" class="logo">Cuan.in</a>

		<ul class="menu">
			<li><a href="#top">Home</a></li>
			<li><a href="#category">Categories</a></li>
			<li><a href="#popular-product">Product</a></li>
		</ul>

		<div class="right-nav">
			<a href="wishlist.php" class="favorite">
				<i class="far fa-heart"></i>
				<span class="favorite-span"><?= $iwishlist; ?></span>
			</a>
			<a href="cart.php" class="cart">
				<i class="fad fa-shopping-cart"></i>
				<span class="cart-span"><?= $icart; ?></span>
			</a>
		</div>

		<a href="profile.php" id="account" class="account">
			<i class="far fa-user"></i>
		</a>
	</nav>
	<!--navbar-end-->



	<!--searchbar-->
	<section id="search-banner">
		<div class="search-banner-text">
			<h1>Find products here</h1>
			<form action="" class="search-box" method="post">
				<i class="far fa-search"></i>
				<input type="text" class="search-input" id="keyword" name="keyword" placeholder="Search" required="true" autocomplete="off">
				<button type="submit" class="search-btn" name="search">Search</button>
			</form>
		</div>
	</section>
	<!--searchbar-end-->



	<!--category-->
	<section id="category">
		<div class="category-heading">
			<h3>Category</h3>
			<span>All</span>
		</div>

		<!--container-->
		<div class="category-container">
			<a href="product.php?category=arts" class="category-box">
				<i class="far fa-palette"></i>
				<span>Arts</span>
			</a>
			<a href="product.php?category=groceries" class="category-box">
				<i class="far fa-shopping-basket"></i>
				<span>Groceries</span>
			</a>
			<a href="product.php?category=tools" class="category-box">
				<i class="far fa-toolbox"></i>
				<span>Tools</span>
			</a>
			<a href="product.php?category=fashions" class="category-box">
				<i class="far fa-tshirt"></i>
				<span>Fashions</span>
			</a>
			<a href="product.php?category=books" class="category-box">
				<i class="far fa-books"></i>
				<span>Books</span>
			</a>
		</div>
		<!--container-end-->
	</section>
	<!--category-end-->



	<!--product-->
	<section id="popular-product">
		
		<!--heading------------>
		<div class="product-heading">
			<h3>Product</h3>
			<a href="product.php?category=all">All</a>
		</div>

		<!--product-box-container-->
		<div class="product-container" id="productContainer">
			<!--product------->
			
			<?php foreach ($produk as $prdk) : ?>
				<!--box------->
				<div class="product-box">
					<img src="img/<?= $prdk['gambar']; ?>">
					<strong><?= $prdk['nama']; ?></strong>
					<span class="quantity">1 pcs</span>
					<span class="seller">By <?= sellername($prdk); ?></span>
					<span class="price">Rp <?= number_format($prdk['harga']); ?></span>

					<!--cart-btn---->
					<form method="post">
						<input type="hidden" id="product_id" name="product_id" value="<?= $prdk['id_produk']; ?>">
						<input type="hidden" id="seller_id" name="seller_id" value="<?= $prdk['id_penjual']; ?>">
						<input type="hidden" id="buyer_id" name="buyer_id" value="<?= $user_id; ?>">
						<input type="hidden" id="name" name="name" value="<?= $prdk['nama']; ?>">
						<input type="hidden" id="category" name="category" value="<?= $prdk['kategori']; ?>">
						<input type="hidden" id="price" name="price" value="<?= $prdk['harga']; ?>">
						<input type="hidden" id="picture" name="picture" value="<?= $prdk['gambar']; ?>">

						<button class="cart-btn" type="submit" name="cart"><i class="fad fa-shopping-bag"></i> Add To Cart</button>

						<button class="like-btn" type="submit" name="wishlist"><i class="far fa-heart"></i></button>
					</form>
				</div>
			<?php endforeach ?>
		</div>
	</section>
	<!--product-end-->




	<!--footer-->
	<footer id="footer">
		<div class="footer-container">
			
			<!--logo-container---->
			<div class="footer-logo">
				<a href="#">Cuan.in</a>

				<!--social------>
				<div class="social">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
					<a href="#"><i class="fab fa-youtube"></i></a>
				</div>

			</div>

			<!--links----------->
			<div class="footer-links">
				<strong>Product</strong>
				<ul>
					<li><a href="#popular-product">Product List</a></li>
				</ul>
			</div>

			<!--links----------->
			<div class="footer-links">
				<strong>Category</strong>
				<ul>
					<li><a href="product.php?category=arts">Arts</a></li>
					<li><a href="product.php?category=groceries">Groceries</a></li>
					<li><a href="product.php?category=tools">Tools</a></li>
					<li><a href="product.php?category=fashion">Fashion</a></li>
					<li><a href="product.php?category=books">Books</a></li>
				</ul>
			</div>

			<!--links----------->
			<div class="footer-links">
				<strong>Contact</strong>
				<ul>
					<li><a href="#">Phone : 9112001</a></li>
					<li><a href="#">Email : Antistress@cuanin.com</a></li>
				</ul>
			</div>

		</div>
	</footer>
	<!--footer-end-->
	




</body>
</html>