<?php
require_once '../koneksi.php';

// start stransaction
mysqli_autocommit($db, false);

// prevent sql inject
$idanggota = isset($_POST['idanggota']) ? mysqli_real_escape_string($db, $_POST['idanggota']) : '';
$nama = isset($_POST['nama']) ? mysqli_real_escape_string($db, $_POST['nama']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? mysqli_real_escape_string($db, $_POST['jenis_kelamin']) : '';
$alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($db, $_POST['alamat']) : '';


if (isset($_POST['simpan'])) {

	extract($_POST);
	$nama_file   = $_FILES['foto']['name'];
	if (!empty($nama_file)) {
		// Baca lokasi file sementar dan nama file dari form (fupload)
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
		$file_foto = $idanggota . "." . $tipe_file;
		// Tentukan folder untuk menyimpan file
		$folder = "../images/$file_foto";
		@unlink("$folder");
		// Apabila file berhasil di upload
		move_uploaded_file($lokasi_file, "$folder");
	} else
		$file_foto = $foto_awal;

	// using prepare statement
	$stmt = $db->prepare("UPDATE tbanggota SET nama=?, email=?, jeniskelamin=?, alamat=?, foto=? WHERE idanggota=?");
	$stmt->bind_param("ssssss", $nama, $email, $jenis_kelamin, $alamat, $file_foto, $idanggota);
	$stmt->execute();

	// commit transaction
	mysqli_commit($db);

	// close db
	$stmt->close();

	echo "<script>alert('data anggota barhasil diupdate');</script>";
	echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota'>";
}
