<?php
// Include the database connection
require_once '../config.php';

if (isset($_GET['borrow_id'])) {
   $borrow_id = $_GET['borrow_id'];

   // Start a transaction to ensure data consistency
   mysqli_autocommit($db, false);

   // Use prepared statements to avoid SQL injection
   $delete_details_query = mysqli_prepare($db, "DELETE FROM borrowdetails WHERE borrow_id = ?");
   mysqli_stmt_bind_param($delete_details_query, "s", $borrow_id);
   $delete_details_result = mysqli_stmt_execute($delete_details_query);

   if ($delete_details_result) {
      // Query to delete the borrow record from the borrow table
      $delete_borrow_query = mysqli_prepare($db, "DELETE FROM borrow WHERE borrow_id = ?");
      mysqli_stmt_bind_param($delete_borrow_query, "s", $borrow_id);
      $delete_borrow_result = mysqli_stmt_execute($delete_borrow_query);

      if ($delete_borrow_result) {
         // Commit the transaction
         mysqli_commit($db);

         echo "<script>alert('Laporan transaksi berhasil dihapus');</script>";
         echo "<meta http-equiv='refresh' content='0;url=../index.php?p=listreturn'>";
         exit;
      } else {
         mysqli_rollback($db);
      }
   } else {
      mysqli_rollback($db);
   }
}
