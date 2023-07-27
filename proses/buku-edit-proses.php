<?php
include '../koneksi.php';

$book_id = $_POST['book_id'];
$book_title = $_POST['book_title'];
$category = $_POST['category'];
$author = $_POST['author'];
$book_copies = $_POST['book_copies'];
$publisher_name = $_POST['publisher_name'];

if (isset($_POST['simpan'])) {

   mysqli_query(
      $db,
      "UPDATE book
		SET book_title='$book_title', category='$category',  author='$author',book_copies='$book_copies',  publisher_name='$publisher_name' WHERE book_id='$book_id'"
   );
   echo "<script>alert('data buku barhasil diupdate');</script>";
   echo "<meta http-equiv='refresh' content='0;url=../index.php?p=buku'>";
}
