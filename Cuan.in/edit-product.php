<?php 
	session_start();
	require 'function.php';

	//get-data-from-URL
	$id = $_GET['id'];

	//fetch-sql
	$produk = query("SELECT * FROM produk WHERE id_produk = $id")[0];

	//define-category-for-seect
	$category = array(
	    'arts' => 'Arts',
	    'groceries' => 'Groceries',
	    'tools' => 'Tools',
	    'fashions' => 'Fashions',
	    'books' => 'Books',
    );

	//edit-button-clicked
	if(isset($_POST['edit'])){
		//edit-success
		if (editproduk($_POST) > 0){
			echo "
				<script>
					alert('Product edited');
					document.location.href = 'my-product.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Product failed to edit');
					document.location.href = 'my-product.php';
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
	<link rel="stylesheet" type="text/css" href="css/style_add_edit_product.css?v=<?php echo time(); ?>">

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
		<h3>Edit My Product</h3>
	</div>	
	<!--header-end-->



	<!--edit-product-->
	<div class="form-container">
		<form method="post" class="form" enctype="multipart/form-data">
			<input type="hidden" id="id_produk" name="id_produk" value="<?= $produk['id_produk']; ?>">
			<input type="hidden" id="id_penjual" name="id_penjual" value="<?= $produk['id_penjual']; ?>">
			<input type="hidden" id="gambarLama" name="gambarLama" value="<?= $produk['gambar']; ?>">

			<div class="inputfield">
	        	<label>Product Name</label>
	        	<input type="text" class="input" id="nama" name="nama" required value="<?= $produk['nama']; ?>">
	       	</div>
			<div class="inputfield">
	          	<label>Category</label>
	          	<div class="custom_select">
            		<select id="kategori" name="kategori" required>
		              	<?php foreach( $category as $var => $ctgr ): ?>
						<option value="<?php echo $var ?>"<?php if( $var == $produk['kategori'] ): ?> selected="selected"<?php endif; ?>><?php echo $ctgr ?></option>
						<?php endforeach; ?>
	            	</select>
          		</div>
       		</div>
       		<div class="inputfield">
	        	<label>Set Price</label>
	        	<input type="text" class="input" id="harga" name="harga" required value="<?= $produk['harga']; ?>" pattern="[0-9]+">
	       	</div>
	       	<div class="inputfield">
	        	<label>Upload Picture</label>
	        	<img src="img/<?= $produk['gambar']; ?>">
	        	<input type="file" class="input" id="gambar" name="gambar" accept=".jpg, .jpeg, .png">
	       	</div>
	       	<button type="submit" name="edit">Edit Product</button>
		</form>
	</div>
	<!--edit-product-end-->

</body>
</html>