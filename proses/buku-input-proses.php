<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
   // Ambil data dari form
   $book_id = $_POST['book_id'];
   $book_title = $_POST['book_title'];
   $category = $_POST['category'];
   $author = $_POST['author'];
   $book_copies = $_POST['book_copies'];
   $publisher_name = $_POST['publisher_name'];

   // Query untuk insert data ke table book
   $sql = "INSERT INTO book (book_id, book_title, category, author, book_copies, publisher_name)
            VALUES ('$book_id', '$book_title', '$category', '$author', '$book_copies', '$publisher_name')";

   // Jalankan query
   $result = mysqli_query($db, $sql);

   if ($result) {
      echo "<script>alert('data barhasil ditambahkan');</script>";
      echo "<meta http-equiv='refresh' content='0;url=../index.php?p=buku'>";
      exit;
   }
}
