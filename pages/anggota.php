<div id="label-page">
   <h3>List Data Anggota</h3>
</div>
<div id="content">
   <nav class="navbar navbar-expand bg-body-tertiary mb-3">
      <div class="container-fluid">
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
               <li class="nav-item mx-3">
                  <a href="index.php?p=anggota-input" class="btn btn-sm btn-outline-success" aria-current="page"><i class="bi bi-pencil"></i> add</a>
               </li>
               <li class="nav-item mx-3">
                  <a target="_blank" href="pages/cetak.php" class="btn btn-tertiary">
                     <i class="bi bi-printer"> Print</i>
                  </a>
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
               <th scope="col">ID</th>
               <th scope="col">Nama</th>
               <th scope="col">Email</th>
               <th scope="col">Foto</th>
               <th scope="col">Jenis Kelamin</th>
               <th scope="col">Alamat</th>
               <th scope="col">Opsi</th>
            </tr>
         </thead>

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
         // request data searching
         if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
            if ($pencarian != "") {
               $sql = "SELECT * FROM tbanggota WHERE nama LIKE '%$pencarian%'
						OR idanggota LIKE '%$pencarian%'
						OR jeniskelamin LIKE '%$pencarian%'
						OR alamat LIKE '%$pencarian%'";

               $query = $sql;
               $queryJml = $sql;
            } else {
               $query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
               $queryJml = "SELECT * FROM tbanggota";
               $no = $posisi * 1;
            }
         } else {
            $query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
            $queryJml = "SELECT * FROM tbanggota";
            $no = $posisi * 1;
         }

         //$sql="SELECT * FROM tbanggota ORDER BY idanggota DESC";
         $data = mysqli_query($db, $query);
         if (mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_array($data)) {
               if (empty($row['foto']) or ($row['foto'] == '-'))
                  $foto = "admin-no-photo.jpg";
               else
                  $foto = $row['foto'];
         ?>
               <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo htmlspecialchars($row['idanggota']); ?></td>
                  <td><?php echo htmlspecialchars($row['nama']); ?></td>
                  <td><?php echo htmlspecialchars($row['email']); ?></td>
                  <td><img class="img rounded-circle" src="images/<?php echo $foto; ?>" width=40px height=40px></td>
                  <td><?php echo htmlspecialchars($row['jeniskelamin']); ?></td>
                  <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                  <td>
                     <a target="_blank" class="btn btn-sm btn-success" href="pages/cetak_kartu.php?id=<?php echo $row['idanggota']; ?>"><i class="bi bi-printer"></i></a>
                     <a class="btn btn-sm btn-warning" href="index.php?p=anggota-edit&id=<?php echo $row['idanggota']; ?>"><i class="bi bi-pencil"></i></a>
                     <a class="btn btn-sm btn-danger" href="proses/anggota-hapus.php?id=<?php echo $row['idanggota']; ?>" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')"><i class="bi bi-x-square"></i></a>
                  </td>
               </tr>
         <?php $nomor++;
            }
         } else {
            echo "<tr><td colspan=12>Data Tidak Ditemukan</td></tr>";
         } ?>
      </table>
   </div>
   <?php
   // give output result searching
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