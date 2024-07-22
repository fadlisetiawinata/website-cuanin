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
	$produk = query("SELECT * FROM cart WHERE buyer_id = '$user_id' ORDER BY cart_id DESC");

	//remove-button
	if(isset($_POST['remove'])){
		//remove-success
		if (removecart($_POST) > 0){
			echo "
				<script>
					alert('Removed from Cart');
					document.location.href = 'cart.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Cannot Remove from Cart');
					document.location.href = 'cart.php';
				</script>
			";
		}
	}

	//total-price
	$totalprice = 0;

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
			<h1>My Cart</h1>
		<div>
	</section>
	<!--cart-banner-end-->



	<!--display-product-->
	<section id="display-product">
		
		<!--product-box-container-->
		<div class="product-container" id="productContainer">
			<!--product------->
			<?php foreach ($produk as $prdk) : ?>
				<!--box------->
				<div class="product-box">
					<img src="img/<?= $prdk['picture']; ?>">
					<strong><?= $prdk['name']; ?></strong>
					<span class="quantity">1 pcs</span>
					<span class="seller">By <?= sellernameEN($prdk); ?></span>
					<span class="price">Rp <?= number_format($prdk['price']); ?></span>

					<!--cart-btn---->
					<form method="post">
						<input type="hidden" id="id_produk" name="id_produk" value="<?= $prdk['product_id']; ?>">
						<input type="hidden" id="id_penjual" name="id_penjual" value="<?= $prdk['seller_id']; ?>">
						<input type="hidden" id="buyer_id" name="buyer_id" value="<?= $user_id; ?>">
						<input type="hidden" id="nama" name="nama" value="<?= $prdk['name']; ?>">
						<input type="hidden" id="kategori" name="kategori" value="<?= $prdk['category']; ?>">
						<input type="hidden" id="harga" name="harga" value="<?= $prdk['price']; ?>">
						<input type="hidden" id="gambar" name="gambar" value="<?= $prdk['picture']; ?>">

						<button class="remove-btn" type="submit" name="remove"><i class="fad fa-undo-alt"></i> Remove</button>
					</form>					
				</div>
				<?php $totalprice = $totalprice + $prdk['price']; ?>
			<?php endforeach ?>
			<?php $_SESSION['totalprice'] = $totalprice; ?>	
		</div>
	</section>
	<!--display-product-end-->



	<!--bottom-box-->
	<div class="bottom-box">
		<div class="total-price">
			<h3>Total</h3>
			<span>Rp <?= number_format($totalprice); ?></span>
		</div>
		<?php if($produk == !null){echo '<a href="checkout.php">Checkout</a>';} ?>
	</div>	
	<!--bottom-box-end-->


</body>
</html>