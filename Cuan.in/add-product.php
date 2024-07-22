<?php 
	session_start();
	require 'function.php';

	//active-user-session
	$user_id = $_SESSION['user_id'];

	//add-button-clicked
	if(isset($_POST['add'])){
		//add-success
		if (tambahproduk($_POST) > 0){
			echo "
				<script>
					alert('Product added');
					document.location.href = 'add-product.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Product failed to add');
					document.location.href = 'add-product.php';
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
	<link rel="stylesheet" type="text/css" href="css/style_add_edit_product.css">

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
		<h3>Add My Product</h3>
	</div>	
	<!--header-end-->



	<!--add-product-->
	<div class="form-container">
		<form method="post" class="form" enctype="multipart/form-data">
			<input type="hidden" id="id_penjual" name="id_penjual" value="<?= $user_id ?>">

			<div class="inputfield">
	        	<label>Product Name</label>
	        	<input type="text" class="input" id="nama" name="nama" required>
	       	</div>
			<div class="inputfield">
	          	<label>Category</label>
	          	<div class="custom_select">
            		<select id="kategori" name="kategori" required>
		              	<option value="" selected disabled hidden>Select</option>
		              	<option value="arts">Arts</option>
		              	<option value="groceries">Groceries</option>
		              	<option value="tools">Tools</option>
		              	<option value="fashions">Fashions</option>
		              	<option value="books">Books</option>
	            	</select>
          		</div>
       		</div>
       		<div class="inputfield">
	        	<label>Set Price</label>
	        	<input type="text" class="input" id="harga" name="harga" required pattern="[0-9]+">
	       	</div>
	       	<div class="inputfield">
	        	<label>Upload Picture</label>
	        	<input type="file" class="input" id="gambar" name="gambar" required accept=".jpg, .jpeg, .png">
	       	</div>
	       	<button type="submit" name="add">Add Product</button>
		</form>
	</div>
	<!--add-product-end-->

</body>
</html>