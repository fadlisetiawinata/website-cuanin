<?php 
	session_start();
	require 'function.php';

	$user_id = $_SESSION['user_id'];

	//fetch-sql
	$produk = query("SELECT * FROM produk WHERE id_penjual = '$user_id'");

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
		<h3>My Products</h3>
	</div>	
	<!--header-end-->



	<!--my-product-->
	<div class="product-container">
		<table>
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Category</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($produk as $prdk): ?>
				<tr>
					<td class="product-name">
						<img src="img/<?= $prdk['gambar']; ?>">
						<span><?= $prdk['nama']; ?></span>
					</td>
					<td><?= strtoupper($prdk['kategori']); ?></td>
					<td>Rp <?= number_format($prdk['harga']); ?></td>
					<td>
						<a href="edit-product.php?id=<?= $prdk['id_produk']; ?>" class="edit">Edit</a><br>
						<a href="delete.php?id=<?= $prdk['id_produk']; ?>" onclick="return confirm('Are you sure?');" class="delete">Delete</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<!--my-product-end-->

</body>
</html>