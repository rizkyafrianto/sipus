<?php
include '../koneksi.php';

// validation idanggota
$idanggota = $_POST['idanggota'];

// Query untuk mencari ID anggota yang sudah terdaftar
$query = "SELECT * FROM tbanggota WHERE idanggota = '$idanggota'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
	echo "<script>alert('id sudah ada');</script>";
	echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota-input'>";
	exit;
} else {
	// Lanjutkan proses simpan data atau tindakan lain jika ID anggota belum ada

	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$alamat = $_POST['alamat'];
	$status = "Tidak Meminjam";
	$file_foto = "";

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
			// Apabila file berhasil di upload
			move_uploaded_file($lokasi_file, "$folder");
		} else
			$file_foto = "-";

		$sql =
			"INSERT INTO tbanggota
			VALUES('$idanggota','$nama', '$email','$jenis_kelamin','$alamat','$status','$file_foto')";
		$query = mysqli_query($db, $sql);

		echo "<script>alert('data barhasil ditambahkan');</script>";
		echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota'>";

		// header("location:../index.php?p=anggota");
	}
}
