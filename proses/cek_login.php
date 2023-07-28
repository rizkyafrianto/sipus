<?php
session_start();

include "../koneksi.php";

// set login logic
if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db, "SELECT * FROM admins WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password 
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            // set session
            $_SESSION["auth"] = true;
            // Menyimpan nama admin ke dalam session
            $_SESSION['auth'] = $row['nm_admin'];

            echo "<script>alert('Anda berhasil Log In');</script>";
            echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
            exit;
        } else {
            echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
            echo "<script>alert('Anda Gagal Log In');</script>";
        }
    }

    $error = true;
}
