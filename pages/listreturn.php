<div id="label-page">
   <h3>List Pengembalian Buku</h3>
</div>
<div id="content">
   <table id="tabel-tampil">
      <tr>
         <th id="label-tampil-no">No.</th>
         <th>Nama</th>
         <th>Email</th>
         <th>Buku</th>
         <th>Tanggal Pinjam</th>
         <th>Jatuh Tempo</th>
         <th>Tanggal Kembali</th>
         <th>Action</th>
      </tr>
      <?php
      include "koneksi.php";

      // Query untuk mendapatkan data buku yang sudah dikembalikan
      $query = "SELECT a.idanggota, a.nama, a.email, b.borrow_id, b.date_borrow, b.due_date, b.date_return, c.book_id, c.book_title
                FROM tbanggota AS a
                INNER JOIN borrow AS b ON b.idanggota = a.idanggota
                INNER JOIN book AS c ON b.book_id = c.book_id
                WHERE b.status = 0";

      $result = mysqli_query($db, $query);
      $no = 1;
      while ($row = mysqli_fetch_array($result)) {
      ?>
         <tr>
            <td>
               <center><?php echo $no . "."; ?></center>
            </td>
            <td>
               <center><?php echo $row['nama']; ?></center>
            </td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['book_title']; ?></td>
            <td><?php echo $row['date_borrow']; ?></td>
            <td><?php echo $row['due_date']; ?></td>
            <td><?php echo $row['date_return']; ?></td>
            <td>
               <a href="proses/hapus_transaksi.php?borrow_id=<?php echo $row['borrow_id']; ?>">Hapus Transaksi</a>
            </td>
         </tr>
      <?php
         $no++;
      }
      ?>
   </table>
</div>