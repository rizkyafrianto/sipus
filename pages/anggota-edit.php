<?php
$idanggota = $_GET['id'];
$data = mysqli_query($db, "SELECT * FROM tbanggota WHERE idanggota='$idanggota'");
$row = mysqli_fetch_array($data);
if (empty($row['foto']) or ($row['foto'] == '-'))
   $foto = "admin-no-photo.jpg";
else
   $foto = $row['foto'];
?>
<div id="label-page">
   <h3>Edit Data Anggota</h3>
</div>
<div id="content">
   <form action="proses/anggota-edit-proses.php" method="post" enctype="multipart/form-data">
      <table id="tabel-input">
         <tr>
            <td class="label-formulir">FOTO</td>
            <td class="isian-formulir">
               <img src="images/<?php echo $foto; ?>" width=70px height=75px>
               <input type="file" name="foto" class="isian-formulir isian-formulir-border">
               <input type="hidden" name="foto_awal" value="<?php echo $row['foto']; ?>">
            </td>
         </tr>
         <tr>
            <td class="label-formulir">ID Anggota</td>
            <td class="isian-formulir"><input type="text" name="idanggota" value="<?php echo $row['idanggota']; ?>" readonly="readonly" class="isian-formulir isian-formulir-border warna-formulir-disabled"></td>
         </tr>
         <tr>
            <td class="label-formulir">Nama</td>
            <td class="isian-formulir"><input type="text" name="nama" value="<?php echo $row['nama']; ?>" class="isian-formulir isian-formulir-border" required></td>
         </tr>
         <tr>
            <td class="label-formulir">Email</td>
            <td class="isian-formulir"><input type="email" name="email" value="<?php echo $row['email']; ?>" class="isian-formulir isian-formulir-border" required></td>
         </tr>
         <tr>
            <td class='label-formulir'>Jenis Kelamin</td>
            <td class='isian-formulir'>
               <?php
               $jenis_kelamin = $row['jeniskelamin'];
               $is_pria = $jenis_kelamin === "Pria";
               $is_wanita = $jenis_kelamin === "Wanita";

               echo "<input type='radio' name='jenis_kelamin' value='Pria' " . ($is_pria ? "checked" : "") . ">Pria<br>";
               echo "<input type='radio' name='jenis_kelamin' value='Wanita' " . ($is_wanita ? "checked" : "") . ">Wanita";
               ?>
            </td>
         </tr>
         <tr>
            <td class="label-formulir">Alamat</td>
            <td class="isian-formulir"><textarea rows="2" cols="40" name="alamat" class="isian-formulir isian-formulir-border" required><?php echo $row['alamat']; ?></textarea></td>
         </tr>
         <tr>
            <td class="label-formulir"></td>
            <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-secondary"></td>
         </tr>
      </table>
   </form>
</div>