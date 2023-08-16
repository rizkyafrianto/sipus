<?php
require_once '../config.php';

// commit transaction, for concistency data
mysqli_autocommit($db, false);

// Ambil data dari form
$book_id = $_POST['book_id'];
$book_title = $_POST['book_title'];
$category = $_POST['category'];
$author = $_POST['author'];
$book_copies = $_POST['book_copies'];
$publisher_name = $_POST['publisher_name'];
$file_foto = "";

if (isset($_POST['simpan'])) {
   extract($_POST);
   $nama_file = $_FILES['book_cover']['name'];
   if (!empty($nama_file)) {
      // Read temporary file location and name from form (fupload)
      $lokasi_file = $_FILES['book_cover']['tmp_name'];
      $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
      $file_foto = $book_id . "." . $tipe_file;

      // Specify folder to store the file
      $folder = "../images/$file_foto";
      // Move the uploaded file if successful
      move_uploaded_file($lokasi_file, "$folder");
   } else
      $file_foto = "-";

   // prepared statement
   $stmt = $db->prepare("INSERT INTO book (book_id, book_title, category, author, book_copies, publisher_name, book_cover) VALUES (?, ?, ?, ?, ?, ?, ?)");

   // Bind parameters
   $stmt->bind_param("ssssiss", $book_id, $book_title, $category, $author, $book_copies, $publisher_name, $file_foto);

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
