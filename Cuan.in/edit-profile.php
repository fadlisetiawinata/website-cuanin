<?php 
	session_start();
	require 'function.php';

	//query
	$user = $_SESSION['username'];
	$akun = query("SELECT * FROM akun WHERE username = '$user'")[0];

	//edit-button-clicked
	if(isset($_POST['save'])){
		//edit-success
		if (ubah($_POST) > 0){
			echo "
				<script>
					alert('data edited');
					document.location.href = 'profile.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('data failed to edit');
					document.location.href = 'profile.php';
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
	<link rel="stylesheet" type="text/css" href="css/style_edit_profile.css?v=<?php echo time(); ?>">

	<!--fontawesome-->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!--fontstyle-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form action="" method="post">
	<!--header-->
	<div class="header">
		<h3>Edit Profile</h3>
		<button type="submit" name="save">Save</button>
	</div>	
	<!--header-end-->



	<!--profile-edit-->
	<div class="profile-box">
		<form action="" method="post">
			<input type="hidden" name="user_id" value="<?= $akun["user_id"] ?>">
			<table class="edit-data">
				<tr>
					<th><i class="fad fa-address-card"></i></th>
					<th><div class="txt_field">
						<input type="text" name="username" id="username" required value="<?= $akun["username"] ?>">
						<span></span>
					</div></th>
				</tr>
			</table>
		
	</div>
	<!--profile-edit-end-->
	</form>

</body>
</html>