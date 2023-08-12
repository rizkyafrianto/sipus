<?php
session_start();

include "../koneksi.php";

// set login logic
if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Persiapkan prepared statement untuk mengambil data berdasarkan username
    $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // cek username
    if ($result->num_rows === 1) {

        // Ambil data hasil query
        $row = $result->fetch_assoc();

        // cek password
        if (password_verify($password, $row["password"])) {

            // set session
            $_SESSION["auth"] = true;
            // Menyimpan nama admin ke dalam session
            $_SESSION['auth'] = $row['nm_admin'];

            echo "<script>alert('Login Success');</script>";
            echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
            exit;
        } else {
            echo "<script>alert('Invalid Login');</script>";
            echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
        }
    } else {
        echo "<script>alert('Invalid Login');</script>";
        echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
    }

    $stmt->close();
}
