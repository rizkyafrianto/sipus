<?php
require_once "../koneksi.php";

if (isset($_GET['book_id'])) {
   $book_id = $_GET['book_id'];

   // Start a transaction to ensure data consistency
   mysqli_autocommit($db, false);

   // Use prepared statements to avoid SQL injection
   $update_borrow_query = mysqli_prepare($db, "UPDATE borrow SET status = 0, date_return = NOW() WHERE book_id = ?");
   mysqli_stmt_bind_param($update_borrow_query, "s", $book_id);
   $update_borrow_result = mysqli_stmt_execute($update_borrow_query);

   if ($update_borrow_result) {
      // Get the book IDs associated with the borrow record
      $book_ids_query = mysqli_prepare($db, "SELECT book_id FROM borrow WHERE book_id = ?");
      mysqli_stmt_bind_param($book_ids_query, "s", $book_id);
      mysqli_stmt_execute($book_ids_query);
      $book_ids_result = mysqli_stmt_get_result($book_ids_query);

      if ($book_ids_result) {
         // Update the status of each book to 0 (available)
         while ($row = mysqli_fetch_assoc($book_ids_result)) {
            $book_id = $row['book_id'];

            $update_book_query = mysqli_prepare($db, "UPDATE book SET is_borrowed = 0 WHERE book_id = ?");
            mysqli_stmt_bind_param($update_book_query, "s", $book_id);
            $update_book_result = mysqli_stmt_execute($update_book_query);

            // Handle errors if necessary
            if (!$update_book_result) {
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
