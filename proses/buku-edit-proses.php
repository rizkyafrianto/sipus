<?php
require_once '../config.php';

// start transaction
mysqli_autocommit($db, false);

$book_id = $_POST['book_id'];
$book_title = $_POST['book_title'];
$category = $_POST['category'];
$author = $_POST['author'];
$book_copies = $_POST['book_copies'];
$publisher_name = $_POST['publisher_name'];

if (isset($_POST['simpan'])) {
   $stmt = $db->prepare("UPDATE book SET book_title=?, category=?, author=?, book_copies=?, publisher_name=? WHERE book_id=?");
   $stmt->bind_param("ssssss", $book_title, $category, $author, $book_copies, $publisher_name, $book_id);

   if ($stmt->execute()) {

      // commit transaction
      mysqli_commit($db);

      echo "<script>alert('Data buku berhasil diupdate');</script>";
      echo "<meta http-equiv='refresh' content='0;url=../index.php?p=buku'>";
   } else {
      echo "<script>alert('Terjadi kesalahan dalam mengupdate data buku');</script>";
   }

   $stmt->close();
}
