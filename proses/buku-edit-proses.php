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
   extract($_POST);
   $nama_file   = $_FILES['book_cover']['name'];
   if (!empty($nama_file)) {
      // Baca lokasi file sementar dan nama file dari form (fupload)
      $lokasi_file = $_FILES['book_cover']['tmp_name'];
      $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
      $file_foto = $book_id . "." . $tipe_file;
      // Tentukan folder untuk menyimpan file
      $folder = "../images/$file_foto";
      @unlink("$folder");
      // Apabila file berhasil di upload
      move_uploaded_file($lokasi_file, "$folder");
   } else
      $file_foto = $foto_awal;

   $stmt = $db->prepare("UPDATE book SET book_title=?, category=?, author=?, book_copies=?, publisher_name=?, book_cover=? WHERE book_id=?");
   $stmt->bind_param("sssssss", $book_title, $category, $author, $book_copies, $publisher_name, $file_foto, $book_id);

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
