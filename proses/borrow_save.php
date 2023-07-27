<?php
if (isset($_POST['submit'])) {
   $idanggota = $_POST['idanggota'];
   $duedate = $_POST['duedate'];
   $listbookid = $_POST['selector'];

   $idx = isset($_POST['id']) ? $_POST['id'] : "";

   include '../koneksi.php';

   //query jika insert data ke database
   $dml = "INSERT INTO borrow(idanggota, date_borrow, due_date)
            VALUES('$idanggota',NOW(),'$duedate')";
   $qry = mysqli_query($db, $dml);

   $qry = mysqli_query($db, "select * from borrow order by borrow_id DESC");
   $row = mysqli_fetch_array($qry);
   $borrow_id = $row['borrow_id'];


   //echo $dml;exit;

   $N = count($listbookid);
   for ($i = 0; $i < $N; $i++) {
      $dml2 = "INSERT INTO borrowdetails(book_id, borrow_id, borrowdetail_id)
            VALUES('$listbookid[$i]','$borrow_id','')";
      //echo $dml2; exit;
      $qry = mysqli_query($db, $dml2);
   }

   header("location:../index.php?p=listborrow");
}
