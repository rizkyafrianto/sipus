<?php

include 'config.php';

// start function registration
function registrasi($data)
{
   global $db;

   $nama = strtolower(stripslashes($data["nama"]));
   $username = strtolower(stripslashes($data["username"]));
   $password = mysqli_real_escape_string($db, $data["password"]);
   $password2 = mysqli_real_escape_string($db, $data["password2"]);


   // cek username sudah ada atau belum
   $result = mysqli_query($db, "SELECT username FROM admins WHERE username = '$username' ");

   if (mysqli_fetch_assoc($result)) {
      echo "<script>
                alert('username yang dipilih sudah terdaftar!');
                </script>";
      return false;
   }

   // cek konfirmasi password
   if ($password !== $password2) {
      echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
      return false;
   }


   // enkripsi password
   $password = password_hash($password, PASSWORD_DEFAULT);

   // tanbahkan user baru ke database
   mysqli_query($db, "INSERT INTO admins VALUES('', '$nama', '$username', '$password') ");

   return mysqli_affected_rows($db);
}
