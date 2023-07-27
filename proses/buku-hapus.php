<?php
include '../koneksi.php';
$book_id = $_GET['id'];

// Cek apakah buku sedang dipinjam
$sql_check_borrowed = "SELECT is_borrowed FROM book WHERE book_id = '$book_id'";
$result = mysqli_query($db, $sql_check_borrowed);
$row = mysqli_fetch_assoc($result);

// Jika buku sedang dipinjam, berikan pesan kesalahan
if ($row['is_borrowed'] == 1) {
   echo "<script>alert('Buku sedang dipinjam, tidak dapat dihapus');</script>";
   echo "<meta http-equiv='refresh' content='0;url=../index.php?p=buku'>";
} else {

   mysqli_query(
      $db,
      "DELETE FROM book
	WHERE book_id='$book_id'"
   );

   header("location:../index.php?p=buku");
}
