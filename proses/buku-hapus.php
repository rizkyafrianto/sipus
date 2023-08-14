<?php
require_once '../koneksi.php';

mysqli_autocommit($db, false);

// Validate and sanitize input ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
   $book_id = intval($_GET['id']);
   
   // Check if the book is borrowed
   $stmt_check = $db->prepare("SELECT is_borrowed FROM book WHERE book_id = ?");
   $stmt_check->bind_param('i', $book_id);
   $stmt_check->execute();

   $result_check = $stmt_check->get_result();
   $row_check = $result_check->fetch_assoc();

   // If the book is borrowed, show an error message
   if ($row_check['is_borrowed'] == 1) {
      echo "<script>alert('Buku sedang dipinjam, tidak dapat dihapus');</script>";
      echo "<meta http-equiv='refresh' content='0;url=../index.php?p=buku'>";
   } else {
      // Delete the book using prepared statement
      $stmt_delete = $db->prepare("DELETE FROM book WHERE book_id = ?");
      $stmt_delete->bind_param('i', $book_id);
      $stmt_delete->execute();

      mysqli_commit($db);
      header("location:../index.php?p=buku");
   }
} else {
   // Handle invalid ID or non-numeric ID
   echo "Invalid or missing book ID.";
}
