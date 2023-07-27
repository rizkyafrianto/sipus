<?php
include '../koneksi.php';

$idanggota = $_POST['idanggota'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];

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

	mysqli_query(
		$db,
		"UPDATE tbanggota
		SET nama='$nama', email='$email',  jeniskelamin='$jenis_kelamin',alamat='$alamat',foto='$file_foto'
		WHERE idanggota='$idanggota'"
	);
	echo "<script>alert('data anggota barhasil diupdate');</script>";
	echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota'>";
}
