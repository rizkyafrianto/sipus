<?php
require 'koneksi.php';

session_start();

// login session header to index
if (isset($_SESSION["auth"])) {
   header("Location: index.php");
   exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style_login.css">
   <title>Login</title>
</head>

<body>
   <div class="container">
      <div>
         <div>
            <div class="error-massage">
               <!-- membuat pesan error -->
               <?php if (isset($error)) : ?>
                  <P> username / password salah
                  <p>
                  <?php endif; ?>
            </div>
            <h2>
               Login
            </h2>
         </div>
         <form class="login-form" method="post" action="proses/login_validation.php">
            <!-- input username -->
            <input type="text" name="username" id="username" placeholder="Username">
            <!-- input password -->
            <input type="password" name="password" id="password" placeholder="Password">
            <!-- button submit -->
            <button class="submit-button" type="submit" name="login">sign in</button>
         </form>
      </div>
   </div>

</body>

</html>