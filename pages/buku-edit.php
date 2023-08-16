<?php
// Get id and checked is numeric?
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

   // Sanitize id using prepared statement
   $book_id = intval($_GET['id']);  // Convert to integer

   // Prepare statement for querying data
   $stmt = $db->prepare("SELECT * FROM book WHERE book_id = ?");
   $stmt->bind_param('i', $book_id);

   // Execute the statement
   if ($stmt->execute()) {
      $result = $stmt->get_result();

      // Check if data is found
      if ($result->num_rows === 1) {
         $row = $result->fetch_assoc();
         // Now you can use the data
      } else {
         echo "data not found";
      }
   }
}
?>
<div id="label-page">
   <h3>Edit Buku</h3>
</div>
<div id="content">
   <form action="proses/buku-edit-proses.php" method="post" enctype="multipart/form-data">
      <table id="tabel-input">
         <tr>
            <td class="label-formulir">Book Cover</td>
            <td class="isian-formulir">
               <img class="mb-2" style='border:1px solid black;' src="images/<?php echo $row['book_cover']; ?>" width=70px height=75px>
               <input type="file" name="book_cover" class="isian-formulir isian-formulir-border">
               <input type="hidden" name="foto_awal" value="<?php echo htmlspecialchars($row['book_cover']); ?>">
            </td>
         </tr>
         <tr>
            <td class="label-formulir">ID Buku</td>
            <td class="isian-formulir"><input type="text" name="book_id" class="isian-formulir isian-formulir-border" value="<?php echo htmlspecialchars($row['book_id']); ?>" readonly></td>
         </tr>
         <tr>
            <td class="label-formulir">Judul Buku</td>
            <td class="isian-formulir"><input type="text" name="book_title" class="isian-formulir isian-formulir-border" required value="<?php echo htmlspecialchars($row['book_title']); ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Kategori</td>
            <td class="isian-formulir"><input type="text" name="category" class="isian-formulir isian-formulir-border" required value="<?php echo htmlspecialchars($row['category']); ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Penulis</td>
            <td class="isian-formulir"><input type="text" name="author" class="isian-formulir isian-formulir-border" required value="<?php echo htmlspecialchars($row['author']); ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Book Copies</td>
            <td class="isian-formulir"><input type="text" name="book_copies" class="isian-formulir isian-formulir-border" required value="<?php echo htmlspecialchars($row['book_copies']); ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir">Publisher</td>
            <td class="isian-formulir"><input type="text" name="publisher_name" class="isian-formulir isian-formulir-border" required value="<?php echo htmlspecialchars($row['publisher_name']); ?>"></td>
         </tr>
         <tr>
            <td class="label-formulir"></td>
            <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-secondary"></td>
         </tr>
      </table>
   </form>
</div>