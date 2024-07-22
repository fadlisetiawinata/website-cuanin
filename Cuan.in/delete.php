<?php
	require 'function.php';
	
	//get-data-from-URL
	$id = $_GET['id'];

	//alert
	if (delete($id) > 0) {
      echo "<script>
        alert('Product Deleted');
        document.location.href = 'my-product.php';
      </script>";
    } else {
      echo "<script>
        alert('Product Failed to Delete');
        document.location.href = 'my-product.php';
      </script>";
    }

?>