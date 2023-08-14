<?php
require_once '../koneksi.php';

// start transaction
mysqli_autocommit($db, false);

// Validation idanggota
$idanggota = isset($_POST['idanggota']) ? mysqli_real_escape_string($db, $_POST['idanggota']) : '';

// Query to find if ID anggota is already registered
$query = "SELECT * FROM tbanggota WHERE idanggota = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $idanggota);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
	echo "<script>alert('id sudah ada');</script>";
	echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota-input'>";
	exit;
} else {

	// Sanitize inputs
	$nama = isset($_POST['nama']) ? mysqli_real_escape_string($db, $_POST['nama']) : '';
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : '';
	$jenis_kelamin = isset($_POST['jenis_kelamin']) ? mysqli_real_escape_string($db, $_POST['jenis_kelamin']) : '';
	$alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($db, $_POST['alamat']) : '';
	$file_foto = "";

	if (isset($_POST['simpan'])) {
		extract($_POST);
		$nama_file = $_FILES['foto']['name'];
		if (!empty($nama_file)) {
			// Read temporary file location and name from form (fupload)
			$lokasi_file = $_FILES['foto']['tmp_name'];
			$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
			$file_foto = $idanggota . "." . $tipe_file;

			// Specify folder to store the file
			$folder = "../images/$file_foto";
			// Move the uploaded file if successful
			move_uploaded_file($lokasi_file, "$folder");
		} else
			$file_foto = "-";

		// Insert data using prepared statement
		$insert_query = "INSERT INTO tbanggota (idanggota, nama, email, jeniskelamin, alamat, foto) VALUES (?, ?, ?, ?, ?, ?)";
		$insert_stmt = $db->prepare($insert_query);
		$insert_stmt->bind_param("ssssss", $idanggota, $nama, $email, $jenis_kelamin, $alamat, $file_foto);
		if ($insert_stmt->execute()) {

			// commit transaction
			mysqli_commit($db);

			echo "<script>alert('data berhasil ditambahkan');</script>";
			echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota'>";
		} else {
			echo "Error: " . $insert_stmt->error;
		}
		$insert_stmt->close();
	}
}
