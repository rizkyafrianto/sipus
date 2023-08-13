<?php
if (isset($_POST['submit'])) {
   $idanggota = $_POST['idanggota'];
   $duedate = $_POST['duedate'];
   $listbookid = $_POST['selector'];

   // Include the database connection
   require_once '../koneksi.php';

   // Start a transaction to ensure data consistency
   mysqli_autocommit($db, false);

   // Query to set the status of books to 1 (borrowed)
   $book_ids = implode(',', $listbookid);
   $update_query = mysqli_query($db, "UPDATE book SET is_borrowed = 1 WHERE book_id IN ($book_ids)");

   if ($update_query) {
      foreach ($listbookid as $bookid) {
         // Query to insert borrow data into the borrow table
         $insert_borrow_query = mysqli_prepare($db, "INSERT INTO borrow (idanggota, date_borrow, due_date, status, book_id)
                                                   VALUES (?, NOW(), ?, 1, ?)");
         mysqli_stmt_bind_param($insert_borrow_query, "sss", $idanggota, $duedate, $bookid);
         $insert_borrow_result = mysqli_stmt_execute($insert_borrow_query);

         if ($insert_borrow_result) {
            // Query to get borrow_id from borrow table
            $get_borrow_id_query = mysqli_query($db, "SELECT borrow_id FROM borrow WHERE book_id = '$bookid'");
            $borrow_id_row = mysqli_fetch_assoc($get_borrow_id_query);
            $borrow_id = $borrow_id_row['borrow_id'];

            $dml2 = "INSERT INTO borrowdetails (book_id, borrow_id) VALUES ('$bookid', '$borrow_id')";
            $qry2 = mysqli_query($db, $dml2);

            // Handle errors if necessary
            if (!$qry2) {
               mysqli_rollback($db);
            }
         } else {
            mysqli_rollback($db);
         }
      }

      // Commit the transaction
      mysqli_commit($db);

      // Redirect to the listborrow page
      echo "<script>alert('Buku berhasil dipinjam');</script>";
      echo "<meta http-equiv='refresh' content='0;url=../index.php?p=listborrow'>";
      exit;
   } else {
   }
}
