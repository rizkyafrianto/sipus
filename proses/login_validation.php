<?php
session_start();

include "../koneksi.php";

// set login logic
if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $escaped_user = mysqli_real_escape_string($db, $username);
    $escaped_pass = mysqli_real_escape_string($db, $password);

    $result = mysqli_query($db, "SELECT * FROM admins WHERE username = '$escaped_user'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password 
        $row = mysqli_fetch_assoc($result);
        if (password_verify($escaped_pass, $row["password"])) {

            // set session
            $_SESSION["auth"] = true;
            // Menyimpan nama admin ke dalam session
            $_SESSION['auth'] = $row['nm_admin'];

            echo "<script>alert('Login Success');</script>";
            echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
            exit;
        } else {
            echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
            echo "<script>alert('Invalid Login');</script>";
        }
    } else {
        echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
        echo "<script>alert('Invalid Login');</script>";
    }

    $error = true;
}
