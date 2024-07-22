<?php
	session_start();
	require 'function.php';


	//active-user-session
	if (isset($_SESSION['login'])) {
      	$user_id = $_SESSION['user_id'];
	}

	//login=false
	if (!isset($_SESSION['login'])) {
		echo "
			<script>
				alert('Login First');
				document.location.href = 'index.php';
			</script>
		";
	}

	//fetch-sql
	$key = query("SELECT * FROM wishlist WHERE buyer_id = '$user_id' ORDER BY wishlist_id DESC");

	//remove-button
	if(isset($_POST['remove'])){
		//remove-success
		if (removewishlist($_POST) > 0){
			echo "
				<script>
					alert('Removed from Wishlist');
					document.location.href = 'wishlist.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Cannot Remove from Wishlist');
					document.location.href = 'wishlist.php';
				</script>
			";
		}
	}


?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jual.in</title>
	<link rel="stylesheet" type="text/css" href="css/style_cart_wishlist.css?v=<?php echo time(); ?>">

	<!--fontawesome-->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!--fontstyle-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 

</head>
<body>
	<!--cart-banner-->
	<section id="cart-banner">
		<div class="cart-banner-text">
			<h1>My Wishlist</h1>
		<div>
	</section>
	<!--cart-banner-end-->



	<!--display-product-->
	<section id="display-product">
		
		<!--product-box-container-->
		<div class="product-container" id="productContainer">
			<!--product------->
			<?php foreach ($key as $keys) : ?>
				<?php 
				$id_produk = $keys['product_id'];
				$prdk = query("SELECT * FROM produk WHERE id_produk = $id_produk")[0];
				?>
				<!--box------->
				<div class="product-box">
					<img src="img/<?= $prdk['gambar']; ?>">
					<strong><?= $prdk['nama']; ?></strong>
					<span class="quantity">1 pcs</span>
					<span class="seller">By <?= sellername($prdk); ?></span>
					<span class="price">Rp <?= number_format($prdk['harga']); ?></span>

					<!--cart-btn---->
					<form method="post">
						<input type="hidden" id="id_produk" name="id_produk" value="<?= $prdk['id_produk']; ?>">

						<button class="remove-btn" type="submit" name="remove"><i class="fad fa-undo-alt"></i> Remove</button>
					</form>					
				</div>
			<?php endforeach ?>
		</div>
	</section>
	<!--display-product-end-->


</body>
</html>