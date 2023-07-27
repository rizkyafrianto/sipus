<?php
include '../koneksi.php';
$idanggota = $_GET['id'];

mysqli_query(
	$db,
	"DELETE FROM tbanggota
	WHERE idanggota='$idanggota'"
);

header("location:../index.php?p=anggota");
