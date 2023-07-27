<?php
if (isset($_POST['submit'])) {
   $idanggota = $_POST['idanggota'];
   $duedate = $_POST['duedate'];
   $listbookid = $_POST['selector'];
   $book_id = $_POST['book_id'];

   // Include the database connection
   include '../koneksi.php';

   // Start a transaction to ensure data consistency
   mysqli_autocommit($db, false);

   // Query to set the status of books to 1 (borrowed)
   $book_ids = implode(',', $listbookid);
   $update_query = mysqli_query($db, "UPDATE book SET is_borrowed = 1 WHERE book_id IN ($book_ids)");

   if ($update_query) {
      // Query to insert borrow data into the borrow table
      $insert_borrow_query = mysqli_query($db, "INSERT INTO borrow (idanggota, date_borrow, due_date, status, book_id)
                                                VALUES ('$idanggota', NOW(), '$duedate', 1, '$book_id')");

      if ($insert_borrow_query) {
         // Get the newly inserted borrow_id
         $borrow_id = mysqli_insert_id($db);

         // Insert borrowdetails for each book_id
         foreach ($listbookid as $bookid) {
            $dml2 = "INSERT INTO borrowdetails (book_id, borrow_id) VALUES ('$bookid', '$borrow_id')";
            $qry2 = mysqli_query($db, $dml2);

            // Handle errors if necessary
            if (!$qry2) {
               mysqli_rollback($db); // Rollback the transaction if there's an error
               // Log or handle the error appropriately
               // Redirect to an error page or display an error message
            }
         }

         // Commit the transaction
         mysqli_commit($db);

         // Redirect to the listborrow page
         header("location:../index.php?p=listborrow");
         exit;
      } else {
         mysqli_rollback($db); // Rollback the transaction if there's an error
         // Log or handle the error appropriately
         // Redirect to an error page or display an error message
      }
   } else {
      // Log or handle the error appropriately
      // Redirect to an error page or display an error message
   }
}
