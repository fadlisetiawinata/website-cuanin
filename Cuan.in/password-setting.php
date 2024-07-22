<?php 
	session_start();
	require 'function.php';

	//active-user-session
	$user_id = $_SESSION['user_id'];

	//save-button-clicked
	if(isset($_POST['save'])){
		//save-success
		if (changepass($_POST) > 0){
			echo "
				<script>
					alert('Password Changed');
					document.location.href = 'profile.php';
				</script>
			";
		}else{
			echo "
				<script>
					alert('Password Failed to Change');
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
	<link rel="stylesheet" type="text/css" href="css/style_password-setting.css?v=<?php echo time(); ?>">

	<!--fontawesome-->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!--fontstyle-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post">
		<!--header-->
		<div class="header">
			<h3>Password Setting</h3>
			<button type="submit" name="save">Save</button>
		</div>	
		<!--header-end-->



		<!--password-setting-->
		<div class="form">
				<input type="hidden" id="user_id" name="user_id" value="<?= $user_id ?>">

				<div class="inputfield">
		        	<label>Password</label>
		        	<input type="password" class="input" id="password" name="password" required>
		       	</div>
	       		<div class="inputfield">
		        	<label>New Password</label>
		        	<input type="password" class="input" id="newpass" name="newpass" required>
		       	</div>
		       	<div class="inputfield">
		        	<label>Confirm Password</label>
		        	<input type="password" class="input" id="confirmpass" name="confirmpass" required>
		       	</div>
		       	
		</div>
		<!--password-setting-end-->
	</form>

</body>
</html>