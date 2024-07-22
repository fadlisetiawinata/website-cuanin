<?php 
  session_start();
  require 'function.php';

  //signup-button
  if(isset($_POST['signup'])){
    if (signup($_POST) > 0) {
      echo "<script>
        alert('Signup Success');
      </script>";
    } else {
      echo mysqli_error($conn);
    }


  }


?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jual.in - Signup</title>
    <link rel="stylesheet" href="css/style_login_signin.css?v=<?php echo time(); ?>">

    <!--fontstyle-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="center">
      <h1>Jual.in</h1>

      <form action="" method="post">
        <div class="txt_field">
          <input type="text" id="username" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="text" id="email" name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password2" name="password2" required>
          <span></span>
          <label>Confirm Password</label>
        </div>
        
        <button type="submit" name="signup">Signup</button>
        <div class="signuplogin_link">
          Already registered? <a href="login.php">Login</a>
        </div>
      </form>
    </div>

  </body>
</html>

