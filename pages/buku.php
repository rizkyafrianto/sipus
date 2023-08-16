<div id="content">
   <div id="label-page">
      <h3>List Buku</h3>
   </div>
   <nav class="navbar navbar-expand bg-body-tertiary mb-3">
      <div class="container-fluid">
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
               <li class="nav-item mx-3">
                  <a href="index.php?p=buku-input" class="btn btn-sm btn-outline-success" aria-current="page"><i class="bi bi-pencil"></i> add</a>
               </li>
            </ul>
            <form action="" class="d-flex mx-3" method="post">
               <input type="text" class="form-control form-control-sm me-2" name="pencarian" autocomplete="off" placeholder="Search...">
               <button class="btn btn-sm btn-outline-success" type="submit" name="search" value="search">Search</button>
            </form>
         </div>
      </div>
   </nav>

   <div class="table-responsive small">
      <table class="table table-striped table-sm">
         <thead>
            <tr>
               <th scope="col">No</th>
               <th scope="col">ID Buku</th>
               <th scope="col">Judul Buku</th>
               <th scope="col">Kategori</th>
               <th scope="col">Penulis</th>
               <th scope="col">Jumlah Salinan</th>
               <th scope="col">Penerbit</th>
               <th scope="col">Status</th>
               <th scope="col">Opsi</th>
            </tr>
         </thead>
         <tbody>

            <?php
            $batas = 10;
            extract($_GET);
            if (empty($hal)) {
               $posisi = 0;
               $hal = 1;
               $nomor = 1;
            } else {
               $posisi = ($hal - 1) * $batas;
               $nomor = $posisi + 1;
            }
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
               $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
               if ($pencarian != "") {
                  $sql = "SELECT * FROM book WHERE book_title LIKE '%$pencarian%'
						OR author LIKE '%$pencarian%'
						OR category LIKE '%$pencarian%'";

                  $query = $sql;
                  $queryJml = $sql;
               } else {
                  $query = "SELECT * FROM book LIMIT $posisi, $batas";
                  $queryJml = "SELECT * FROM book";
                  $no = $posisi * 1;
               }
            } else {
               $query = "SELECT * FROM book LIMIT $posisi, $batas";
               $queryJml = "SELECT * FROM book";
               $no = $posisi * 1;
            }

            //$sql="SELECT * FROM book ORDER BY idanggota DESC";
            $data = mysqli_query($db, $query);
            if (mysqli_num_rows($data) > 0) {
               while ($row = mysqli_fetch_array($data)) {
            ?>
                  <tr>
                     <td><?php echo $nomor; ?></td>
                     <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                     <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                     <td><?php echo htmlspecialchars($row['category']); ?></td>
                     <td><?php echo htmlspecialchars($row['author']); ?></td>
                     <td><?php echo htmlspecialchars($row['book_copies']); ?></td>
                     <td><?php echo htmlspecialchars($row['publisher_name']); ?></td>
                     <td><?php echo $row['is_borrowed'] == 1 ? "Dipinjam" : "Tersedia"; ?></td>
                     <td>
                        <a class="btn btn-sm btn-warning" href="index.php?p=buku-edit&id=<?php echo htmlspecialchars($row['book_id']); ?>"><i class="bi bi-pencil"></i></a>
                        <a class="btn btn-sm btn-danger" href="proses/buku-hapus.php?id=<?php echo htmlspecialchars($row['book_id']); ?>" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')"><i class="bi bi-x-square"></i></a>
                     </td>
                  </tr>
            <?php
                  $nomor++;
               }
            } else {
               echo "<tr><td colspan=12>Data Tidak Ditemukan</td></tr>";
            }
            ?>
         </tbody>
      </table>
   </div>
   <?php
   if (isset($_POST['pencarian'])) {
      if ($_POST['pencarian'] != '') {
         echo "<div style=\"float:left;\">";
         $jml = mysqli_num_rows(mysqli_query($db, $queryJml));
         echo "Data Hasil Pencarian: <b>$jml</b>";
         echo "</div>";
      }
   } else { ?>
      <div>
         <?php
         $jml = mysqli_num_rows(mysqli_query($db, $queryJml));
         echo "Jumlah Data : <b>$jml</b>";
         ?>
      </div>
      <div class="pagination btn btn-sm">
         <?php
         $jml_hal = ceil($jml / $batas);
         for ($i = 1; $i <= $jml_hal; $i++) {
            if ($i != $hal) {
               echo "<a href=\"?p=anggota&hal=$i\">$i</a>";
            } else {
               echo "<a class=\"active\">$i</a>";
            }
         }
         ?>
      </div>
   <?php
   }
   ?>
</div>