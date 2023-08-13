<?php
require_once "../koneksi.php";

if (isset($_GET['book_id'])) {
   $book_id = $_GET['book_id'];

   // Start a transaction to ensure data consistency
   mysqli_autocommit($db, false);

   // Query to set the status of the borrow record to 0 (returned)
   $update_borrow_query = mysqli_query($db, "UPDATE borrow SET status = 0, date_return = NOW() WHERE book_id = '$book_id'");

   if ($update_borrow_query) {
      // Get the book IDs associated with the borrow record
      $book_ids_query = mysqli_query($db, "SELECT book_id FROM borrow WHERE book_id = '$book_id'");

      if ($book_ids_query) {
         // Update the status of each book to 0 (available)
         while ($row = mysqli_fetch_assoc($book_ids_query)) {
            $book_id = $row['book_id'];
            $update_book_query = mysqli_query($db, "UPDATE book SET is_borrowed = 0 WHERE book_id = '$book_id'");

            // Handle errors if necessary
            if (!$update_book_query) {
               mysqli_rollback($db);
               echo "data gagal dikembalikan";
            }
         }

         // Commit the transaction
         mysqli_commit($db);

         // Redirect back to the listborrow page after successful return
         echo "<script>alert('Buku berhasil dikembalikan');</script>";
         echo "<meta http-equiv='refresh' content='0;url=../index.php?p=listreturn'>";
         exit;
      }
   }
}
