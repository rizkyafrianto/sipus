<?php
include '../koneksi.php';

// validation idanggota
$idanggota = isset($_POST['idanggota']) ? mysqli_real_escape_string($db, $_POST['idanggota']) : '';

// Query untuk mencari ID anggota yang sudah terdaftar
$query = "SELECT * FROM tbanggota WHERE idanggota = '$idanggota'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
	echo "<script>alert('id sudah ada');</script>";
	echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota-input'>";
	exit;
} else {

	// prevent sql inject
	$nama = isset($_POST['nama']) ? mysqli_real_escape_string($db, $_POST['nama']) : '';
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : '';
	$jenis_kelamin = isset($_POST['jenis_kelamin']) ? mysqli_real_escape_string($db, $_POST['jenis_kelamin']) : '';
	$alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($db, $_POST['alamat']) : '';
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

		$stmt = $db->prepare("INSERT INTO tbanggota (idanggota, nama, email, jeniskelamin, alamat, foto) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssss", $idanggota, $nama, $email, $jenis_kelamin, $alamat, $file_foto);
		$stmt->execute();
		$stmt->close();

		echo "<script>alert('data barhasil ditambahkan');</script>";
		echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota'>";
	}
}
