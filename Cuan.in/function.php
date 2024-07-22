<?php
	$conn = mysqli_connect("localhost","root","","cuanin");



	//---SIGNUP---
	function signup($data){
		global $conn;

		$username = trim(strtolower(stripslashes($data["username"])));
		$email = trim(strtolower(stripslashes($data["email"])));
		$password = trim(mysqli_real_escape_string($conn, $data["password"]));
		$password2 = trim(mysqli_real_escape_string($conn, $data["password2"]));


		//username and email checker
		$usernameresult = mysqli_query($conn, "SELECT username FROM akun WHERE username = '$username'");

		if(mysqli_fetch_assoc($usernameresult)){
			echo "<script>
	        	alert('Username already taken');
	      	</script>";
	      	return false;
		}

		$emailresult = mysqli_query($conn, "SELECT email FROM akun WHERE email = '$email'");

		if(mysqli_fetch_assoc($emailresult)){
			echo "<script>
	        	alert('Email already registered');
	      	</script>";
	      	return false;
		}


		//password confirmation
		if($password !== $password2){
			echo "<script>
	        	alert('Wrong password confirmation');
	      	</script>";
	      	return false;
		}
		

		//password encryption
		$password = password_hash($password, PASSWORD_DEFAULT);


		//import to database
		mysqli_query($conn, "INSERT INTO akun VALUES('', '$username', '$email', '$password')");
		return mysqli_affected_rows($conn);
	}



	//---FUNCTION-QUERY---
	function query($query){
		global $conn;
		$result = mysqli_query($conn, $query);
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		return $rows;
	}



	//---FUNCTION-EDIT-USER-DATA---
	function ubah($data){
		global $conn;

		$user_id = $data["user_id"];
		$username = trim(strtolower(stripslashes(htmlspecialchars($data["username"]))));

		//username checker
		$usernameresult = mysqli_query($conn, "SELECT username FROM akun WHERE username = '$username'");

		if(mysqli_fetch_assoc($usernameresult)){
			echo "<script>
	        	alert('Username already taken');
	      	</script>";
	      	return false;
		}

		$query = "UPDATE akun SET
					username = '$username'
				 WHERE user_id = $user_id";

		mysqli_query($conn, $query);

		$_SESSION['username'] = $data["username"];
		return mysqli_affected_rows($conn);
	}



	//---FUNCTION-CHANGE-USER-PASSWORD---
	function changepass($data){
		global $conn;

		$user_id = $data["user_id"];
		$password = $data["password"];
		$newpass = $data["newpass"];
		$confirmpass = $data["confirmpass"];

		$result = mysqli_query($conn, "SELECT * FROM akun WHERE user_id = '$user_id'");

	    //uid-check
	    if(mysqli_num_rows($result) === 1){
	    	// password-check
		    $row = mysqli_fetch_assoc($result);
		    if(password_verify($password, $row['password'])){	        
		        //password confirmation
				if($newpass !== $confirmpass){
					echo "<script>
		        		alert('Wrong password confirmation');
		      		</script>";
		      		return false;
				}
				//password encryption
				$newpass = password_hash($newpass, PASSWORD_DEFAULT);

				//update-password
				$query = "UPDATE akun SET
					password = '$newpass'
				 WHERE user_id = $user_id";

				mysqli_query($conn, $query);
				return mysqli_affected_rows($conn);
	    	}else{
	    		echo "<script>
        			alert('Wrong Password');
      			</script>";
	      		return false;
	    	}
	    }
	}



	//---FUNCTION-ADD-PRODUCT---
	function tambahproduk($data){
		global $conn;

		$id_penjual = $data["id_penjual"];
		$kategori = trim(strtolower(htmlspecialchars($data["kategori"])));
		$nama = trim(htmlspecialchars($data["nama"]));
		$harga = trim(strtolower(htmlspecialchars($data["harga"])));

		//upload gambar
		$gambar = upload();
		if (!$gambar){
			return false;
		}

		//insert to databases
		$query = "INSERT INTO produk
					VALUES
				  ('', '$id_penjual', '$kategori', '$nama', '$harga', '$gambar')
				  ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	//--FUNCTION-UPLOAD--
	function upload(){
		//take data
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error =  $_FILES['gambar']['error'];
		$tmpName =  $_FILES['gambar']['tmp_name'];

		//check if the image is not uploaded
		if($error === 4){
			echo "<script>
					alert('Select the image first !')
				  </script>";
			return false;
		}
		//images only
		$validExstension = ['jpg', 'jpeg', 'png'];
		$gambarExtension = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
		if (!in_array($gambarExtension, $validExstension)){
			echo "<script>
					alert('Only jpg, jpeg, png are allowed')
				  </script>";
			return false;
		}
		//4MB only
		if ($ukuranFile > 4194304){
			echo "<script>
					alert('Max image size is 4MB')
				  </script>";
			return false;
		}


		//generate uid for image
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $gambarExtension;

		//move file to specifed directory
		move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

		return $namaFileBaru;
	}



	//---FUNCTION-EDIT-PRODUCT---
	function editproduk($data){
		global $conn;

		$id_produk = $data["id_produk"];
		$id_penjual = $data["id_penjual"];
		$gambarLama = $data["gambarLama"];
		$kategori = trim(strtolower(htmlspecialchars($data["kategori"])));
		$nama = trim(htmlspecialchars($data["nama"]));
		$harga = trim(strtolower(htmlspecialchars($data["harga"])));

		//gambar
		if ($_FILES['gambar']['error'] === 4){
			$gambar = $gambarLama;
		}else{
			$gambar = upload();
		}
		

		//update databases
		$query = "UPDATE produk SET
					id_penjual = '$id_penjual',
					kategori = '$kategori',
					nama = '$nama',
					harga = '$harga',
					gambar = '$gambar'
				  WHERE	id_produk = '$id_produk'
				  ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}




	//---FUNCTION-DELETE-PRODUCT---
	function delete($id){
		global $conn;

		mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");

		return mysqli_affected_rows($conn);
	}
	function deletecart($id){
		global $conn;

		mysqli_query($conn, "DELETE FROM cart WHERE product_id = $id");

		return mysqli_affected_rows($conn);
	}
	function deletewishlist($id){
		global $conn;

		mysqli_query($conn, "DELETE FROM wishlist WHERE product_id = $id");

		return mysqli_affected_rows($conn);
	}



	//---FUNCTION-SHOW-SELLER-NAME---
	function sellername($prdk){
		$uid = $prdk['id_penjual'];
		$seller = query("SELECT username FROM akun WHERE user_id = $uid")[0];
		return strtoupper($seller['username']);
	}

	function sellernameEN($prdk){
		$uid = $prdk['seller_id'];
		$seller = query("SELECT username FROM akun WHERE user_id = $uid")[0];
		return strtoupper($seller['username']);
	}

	function buyername($prdk){
		$uid = $prdk['buyer_id'];
		$buyer = query("SELECT username FROM akun WHERE user_id = $uid")[0];
		return strtoupper($buyer['username']);
	}



	//---FUNCTION-MOVE-PRODUCT-TO-CART---
	function movetocart($data){
		global $conn;

		$product_id = $data["product_id"];
		$seller_id = $data["seller_id"];
		$buyer_id = $data["buyer_id"];
		$name = $data["name"];
		$category = $data["category"];
		$price = $data["price"];
		$picture = $data["picture"];

		//insert to databases
		$query = "INSERT INTO cart 
					VALUES ('', '$product_id', '$seller_id', '$buyer_id', '$name', '$category', '$price', '$picture')
				  ";

		//delete from database
		if (mysqli_affected_rows($conn) > 0) {
			delete($product_id);
			deletewishlist($product_id);
		}

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



	//---FUNCTION-MOVE-PRODUCT-TO-STORE---
	function removecart($data){
		global $conn;

		$id_produk = $data["id_produk"];
		$id_penjual = $data["id_penjual"];
		$kategori = $data["kategori"];
		$nama = $data["nama"];
		$harga = $data["harga"];
		$gambar = $data["gambar"];

		//insert to databases
		$query = "INSERT INTO produk 
					VALUES ('$id_produk', '$id_penjual', '$kategori', '$nama', '$harga', '$gambar')
				  ";

		//delete from database
		if (mysqli_affected_rows($conn) > 0) {
			deletecart($id_produk);
			deletewishlist($id_produk);
		}

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



	//---FUNCTION-ADD-WISHLIST---
	function addwishlist($data){
		global $conn;

		$product_id = $data["product_id"];
		$buyer_id = $data["buyer_id"];

		$wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE buyer_id = $buyer_id and product_id = $product_id");

		if(mysqli_num_rows($wishlist) === 1){
			echo "<script>
				alert('Already in Wishlist');
				document.location.href = '';
			</script>";
			die;
		}

		$query = "INSERT INTO wishlist 
					VALUES ('', '$product_id', '$buyer_id')
				  ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



	//---FUNCTION-REMOVE-WISHLIST---
	function removewishlist($data){
		global $conn;

		$id_produk = $data["id_produk"];
		deletewishlist($id_produk);
		return mysqli_affected_rows($conn);
	}



	//---FUNCTION-COUNT-PRODUCT-IN-CART---
	function icart(){
		$user_id = null;
		if (isset($_SESSION['login'])) {
    	  	$user_id = $_SESSION['user_id'];
		}
		$cart = query("SELECT * FROM cart WHERE buyer_id = '$user_id' ORDER BY cart_id DESC");
		$n = 0;
		foreach ($cart as $i){
			$n++;
		}
		return $n;
	}



	//---FUNCTION-COUNT-PRODUCT-IN-WISHLIST---
	function iwishlist(){
		$user_id = null;
		if (isset($_SESSION['login'])) {
    	  	$user_id = $_SESSION['user_id'];
		}
		$wishlist = query("SELECT * FROM wishlist WHERE buyer_id = '$user_id' ORDER BY wishlist_id DESC");
		$n = 0;
		foreach ($wishlist as $i){
			$n++;
		}
		return $n;
	}



	//---FUNCTION-CHECK-OWN-PRODUCT---
	function ownproduct($data){
		global $conn;

		//set variable
		$user_id = null;
		if (isset($_SESSION['login'])) {
    	  	$user_id = $_SESSION['user_id'];
		}
		$seller_id = $data["seller_id"];

		//condition
		if ($seller_id == $user_id){
			return 1;
		}else{
			return 0;
		}
	}





?>