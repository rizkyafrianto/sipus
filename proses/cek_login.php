<?php
session_start();
$_SESSION['auth'] = NULL;

include "../koneksi.php";

if (isset($_POST['login'])) {
    $user = isset($_POST['user']) ? $_POST['user'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";

    $qry = mysqli_query($db, "SELECT * FROM admins WHERE username = '$user' AND password = '$pass'");
    $sesi = mysqli_num_rows($qry);

    if ($sesi == 1) {

        $data_admin    = mysqli_fetch_array($qry);
        $_SESSION['id_admin'] = $data_admin['id_admin'];
        $_SESSION['auth'] = $data_admin['nm_admin'];

        echo "<script>alert('Anda berhasil Log In');</script>";
        echo "<meta http-equiv='refresh' content='0; url=../index.php?user=" . $_SESSION['auth'] . "'>";
    } else {
        echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
        echo "<script>alert('Anda Gagal Log In');</script>";
    }
} else {
    include "login.php";
}
