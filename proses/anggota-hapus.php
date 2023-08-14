<?php
require_once '../config.php';

// start transaction
mysqli_autocommit($db, false);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$idanggota = intval($_GET['id']);

	// Prepare statement for query
	$stmt = $db->prepare("DELETE FROM tbanggota WHERE idanggota = ?");
	$stmt->bind_param('i', $idanggota);

	// Execute the statement
	$stmt->execute();

	// commit transaction
	mysqli_commit($db);

	// close db
	$stmt->close();

	// Redirect back to the listborrow page after successful return
	echo "<script>alert('anggota berhasil dihapus');</script>";
	echo "<meta http-equiv='refresh' content='0;url=../index.php?p=anggota'>";
}
