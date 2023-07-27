<?php
$book_id = $_GET['id'];
$q = mysqli_query($db, "SELECT * FROM book WHERE book_id='$book_id'");
$row = mysqli_fetch_array($q);
?>
<div id="label-page">
   <h3>Edit Buku</h3>
</div>
<div id="content">
   <form action="proses/buku-edit-proses.php" method="post" enctype="multipart/form-data">
      <table id="tabel-input">
         <tr>
            <td class="label-formulir">ID Buku</td>
            <td class="isian-formulir"><input type="text" name="book_id" class="isian-formulir isian-formulir-border" value="<?php echo $row['book_id']; ?>" readonly></td>
         </tr>
         <tr>
            <td class="label-formulir">Judul Buku</td>
            <td class="isian-formulir"><input type="text" name="book_title" class="isian-formulir isian-formulir-border" value="<?php echo $row['book_title']; ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Kategori</td>
            <td class="isian-formulir"><input type="text" name="category" class="isian-formulir isian-formulir-border" value="<?php echo $row['category']; ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Penulis</td>
            <td class="isian-formulir"><input type="text" name="author" class="isian-formulir isian-formulir-border" value="<?php echo $row['author']; ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Book Copies</td>
            <td class="isian-formulir"><input type="text" name="book_copies" class="isian-formulir isian-formulir-border" value="<?php echo $row['book_copies']; ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Publisher</td>
            <td class="isian-formulir"><input type="text" name="publisher_name" class="isian-formulir isian-formulir-border" value="<?php echo $row['publisher_name']; ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir"></td>
            <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-secondary"></td>
         </tr>
      </table>
   </form>
</div>