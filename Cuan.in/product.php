<?php 
	session_start();
	require 'function.php';


	//active-user-session
	if (isset($_SESSION['login'])) {
      	$user_id = $_SESSION['user_id'];
	}

	//filter-function
	if(isset($_POST['cheapest'])){
		$_SESSION['orderFilter'] = 'harga ASC';
		header("product.php");
	}
	if(isset($_POST['expensive'])){
		$_SESSION['orderFilter'] = 'harga DESC';
		header("product.php");
	}
	if(isset($_POST['newest'])){
		$_SESSION['orderFilter'] = 'id_produk DESC';
		header("product.php");
	}
	if(isset($_POST['oldest'])){
		$_SESSION['orderFilter'] = 'id_produk ASC';
		header("product.php");
	}


	//get-data-from-URL
	$categories = $_GET['category'];

	//order-filter
	$orderFilter = $_SESSION['orderFilter'];

	//fetch-sql
	if ($categories == "all") {
		$produk = query("SELECT * FROM produk ORDER BY $orderFilter");
	} else {
	$produk = query("SELECT * FROM produk WHERE kategori = '$categories' ORDER BY $orderFilter");
	}

	//result-number-of-products
	$n = 0;
	foreach ($produk as $i){
		$n++;
	}
	$filter = '';
	if ($n>0){
		$filter = 'filter';
	}


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
					document.location.href = 'product.php?category=$categories';
				</script>
			";
			die;
		}

		//move-success
		if (movetocart($_POST) > 0){
			echo "
				<script>
					alert('Added to Cart');
					document.location.href = 'product.php?category=$categories';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Cannot Add to Cart');
					document.location.href = 'product.php?category=$categories';
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
					document.location.href = 'product.php?category=$categories';
				</script>
			";
			die;
		}

		//cannot-buy-your-own-product
		if (ownproduct($_POST) > 0){
			echo "
				<script>
					alert('You Cannot Add Your Own Product');
					document.location.href = 'product.php?category=$categories';
				</script>
			";
			die;
		}

		//add-success
		if (addwishlist($_POST) > 0){
			echo "
				<script>
					alert('Added to Wishlist');
					document.location.href = 'product.php?category=$categories';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Cannot Add to Wishlist');
					document.location.href = 'product.php?category=$categories';
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
	<title>Jual.in</title>
	<link rel="stylesheet" type="text/css" href="css/style_product.css?v=<?php echo time(); ?>">

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
		<a href="#footer" class="logo">Jual.in</a>

		<ul class="menu">
			<li><a href="index.php">Home</a></li>
			<li><span></span></li>
			<li><span></span></li>
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



	<!--display-->
	<div class="categories-heading">
		<h2 class="categories">Showing Result of <?= ucfirst($categories); ?></h2>
	</div>



	<!--display-product-->
	<section id="display-product">
		
		<!--heading------------>
		<div class="product-heading">
			<h3><?= $n; ?> Product Found</h3>
			<div class="nav-item filter">
				<?= ucfirst($filter); ?><i class="far fa-<?= $filter; ?>"></i>

				<!--dropdown-menu-->
                    <div id="drop-down">
                    	<form method="post">
                        <button name="cheapest" class="clinks">Cheapest</button>
                        <button name="expensive" class="clinks">Most Expensive</button>
                        <button name="newest" class="clinks">Newest</button>
                        <button name="oldest" class="clinks">Oldest</button>
                    	</form>
                    </div>
			</div>
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
	<!--display-product-end-->

	<!--display-end-->


</body>
</html>