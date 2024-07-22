<?php 
  session_start();
  var_dump($_SESSION);
  require 'function.php';

  //login=true
  if (isset($_SESSION['login'])) {
    echo "<script>
          alert('');
        </script>";

        header("Location: index.php");
        exit;
  }

  //login-button
  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");

    //username-check
    if(mysqli_num_rows($result) === 1){
      // password-check
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row['password'])){
        //set-session
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['user_id'];


        header("Location: index.php");
        exit;
      }else{
      echo "<script>
        alert('Wrong Username or Password');
      </script>";
      }
    }else{
      echo "<script>
        alert('Wrong Username or Password');
      </script>";
    }
  }

?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jual.in - Login</title>
    <link rel="stylesheet" href="css/style_login_signin.css?v=<?php echo time(); ?>">

    <!--fontstyle-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="center">
      <h1>Jual.in</h1>

      <form method="post">
        <div class="txt_field">
          <input type="text" id="username" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        
        <button type="submit" name="login">Login</button>
        <div class="signuplogin_link">
          Not registered yet? <a href="signup.php">Signup</a>
        </div>
      </form>
    </div>

  </body>
</html>
