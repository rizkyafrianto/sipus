<?php
// Include the database connection
include '../koneksi.php';

if (isset($_GET['borrow_id'])) {
   $borrow_id = $_GET['borrow_id'];

   // Start a transaction to ensure data consistency
   mysqli_autocommit($db, false);

   // Query to delete the borrow details associated with the borrow record
   $delete_details_query = mysqli_query($db, "DELETE FROM borrowdetails WHERE borrow_id = '$borrow_id'");

   if ($delete_details_query) {
      // Query to delete the borrow record from the borrow table
      $delete_borrow_query = mysqli_query($db, "DELETE FROM borrow WHERE borrow_id = '$borrow_id'");

      if ($delete_borrow_query) {
         // Commit the transaction
         mysqli_commit($db);

         // Redirect back to the laporan_pengembalian page after successful deletion
         header("location: ../pages/listreturn.php");
         exit;
      } else {
         mysqli_rollback($db); // Rollback the transaction if there's an error
         // Log or handle the error appropriately
         // Redirect to an error page or display an error message
      }
   } else {
      mysqli_rollback($db); // Rollback the transaction if there's an error
      // Log or handle the error appropriately
      // Redirect to an error page or display an error message
   }
}
