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
