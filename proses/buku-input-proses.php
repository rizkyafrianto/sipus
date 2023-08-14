<?php
require_once '../koneksi.php';

if (isset($_POST['simpan'])) {
   // commit transaction, for concistency data
   mysqli_autocommit($db, false);

   // Ambil data dari form
   $book_id = $_POST['book_id'];
   $book_title = $_POST['book_title'];
   $category = $_POST['category'];
   $author = $_POST['author'];
   $book_copies = $_POST['book_copies'];
   $publisher_name = $_POST['publisher_name'];

   // prepared statement
   $stmt = $db->prepare("INSERT INTO book (book_id, book_title, category, author, book_copies, publisher_name) VALUES (?, ?, ?, ?, ?, ?)");

   // Bind parameters
   $stmt->bind_param("ssssis", $book_id, $book_title, $category, $author, $book_copies, $publisher_name);

   // Eksekusi query
   if ($stmt->execute()) {

      // commit transaction
      mysqli_commit($db);

      echo "<script>alert('data barhasil ditambahkan');</script>";
      echo "<meta http-equiv='refresh' content='0;url=../index.php?p=buku'>";
   } else {
      echo "Error: " . $stmt->error;
   }

   // Tutup statement dan koneksi
   $stmt->close();
   $db->close();
}
