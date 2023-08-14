<?php
// get id do sanitation
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
   $idanggota = intval($_GET['id']);

   // Prepare statement for query
   $data = $db->prepare("SELECT * FROM tbanggota WHERE idanggota=?");
   $data->bind_param('i', $idanggota);
   $data->execute();

   // Get result set
   $result = $data->get_result();

   // Fetch the row from the result set
   $row = $result->fetch_assoc();
}

// checked foto?
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
               <img class="mb-2" style='border:1px solid black;' src="images/<?php echo $foto; ?>" width=70px height=75px>
               <input type="file" name="foto" class="isian-formulir isian-formulir-border">
               <input type="hidden" name="foto_awal" value="<?php echo htmlspecialchars($row['foto']); ?>">
            </td>
         </tr>
         <tr>
            <td class="label-formulir">ID Anggota</td>
            <td class="isian-formulir"><input type="text" name="idanggota" value="<?php echo htmlspecialchars($row['idanggota']); ?>" readonly="readonly" class="isian-formulir isian-formulir-border warna-formulir-disabled"></td>
         </tr>
         <tr>
            <td class="label-formulir">Nama</td>
            <td class="isian-formulir"><input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" class="isian-formulir isian-formulir-border" required></td>
         </tr>
         <tr>
            <td class="label-formulir">Email</td>
            <td class="isian-formulir"><input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="isian-formulir isian-formulir-border" required></td>
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