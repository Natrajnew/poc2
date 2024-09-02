<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body class="body">
  <div class="lcontainer">
    <div class="title">Login Form</div>
    <div class="content">
      <form method="POST" name="find_user" action="login_controller.php">
        <div class="user-ldetails">
          <div class="input-box">
            <span class="details">Email:</span>
            <input type="text" id="email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" id="password" name="password"
                   pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$" 
                   title="Password must contain at least one number, 
                           one alphabet, one symbol, and be at 
                           least 8 characters long" required />
          </div>
        </div>
        
        <div class="button">
          <input type="submit" name="user_login" value="Login">
        </div>
        <p><a href="forgotPass.php"> Forgot Password? </a></p>
        <p><a href="index.php"> Register Now </a></p>
      </form>
    </div>
  </div>

</body>
</html>