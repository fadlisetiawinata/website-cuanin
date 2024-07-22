<?php 
	session_start();
	require 'function.php';

	$user_id = $_SESSION['user_id'];

	//fetch-sql
	$produk = query("SELECT * FROM riwayat_order WHERE buyer_id = '$user_id' ORDER BY order_id DESC");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jual.in</title>
	<link rel="stylesheet" type="text/css" href="css/style_my-product_history.css?v=<?php echo time(); ?>">

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
		<h3>Order History</h3>
	</div>	
	<!--header-end-->



	<!--my-product-->
	<div class="product-container">
		<table>
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Seller</th>
					<th>Price</th>
					<th>Purchased on</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($produk as $prdk): ?>
				<tr>
					<td class="product-name">
						<img src="img/<?= $prdk['picture']; ?>">
						<span><?= $prdk['name']; ?></span>
					</td>
					<td><?= sellernameEN($prdk); ?></td>
					<td>Rp <?= number_format($prdk['price']); ?></td>
					<td>
						<span><?= $prdk['date']; ?></span><br>
						<span><?= $prdk['hour']; ?></span>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<!--my-product-end-->

</body>
</html>