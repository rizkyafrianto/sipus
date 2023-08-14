<?php
require 'config.php';
require 'functions.php';


if (isset($_POST["register"])) {

   if (registrasi($_POST) > 0) {
      echo "<script>
                alert('Berhasil registrasi!');
            </script>";
   } else {
      echo mysqli_error($db);
   }
}


session_start();

// session login header to index
if (isset($_SESSION["auth"])) {
   header("Location: index.php");
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrasi Form</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div class="container">
      <div>
         <div>
            <h2>registration</h2>
         </div>
         <form class="login-form" action="" method="post">
            <!-- input username -->
            <input type="text" name="nama" id="nama" placeholder="nama">
            <input type="text" name="username" id="username" placeholder="username">
            <!-- input password -->
            <input type="password" name="password" id="password" placeholder="password">
            <!-- input cpassword -->
            <input type="password" name="password2" id="password22" placeholder="confirm password">
            <!-- button submit -->
            <button class="submit-button" type="submit" name="register">Register!</button>
            <!-- link to login form -->
            <a class="help-text" href="login.php">Already have acount?</a>
         </form>
      </div>
   </div>


</body>

</html>