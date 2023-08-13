<?php
require_once "koneksi.php";

// Ambil parameter id dari GET
$idx = isset($_GET['id']) ? $_GET['id'] : "";

// Query untuk mengambil data peminjaman
$select_borrow_query = "SELECT borrow.*, tbanggota.nama, book.book_title, book.category, book.author, book.book_copies, book.publisher_name
                        FROM borrow
                        INNER JOIN tbanggota ON borrow.idanggota = tbanggota.idanggota
                        INNER JOIN book ON borrow.book_id = book.book_id
                        WHERE borrow_id = ?";

$stmt = mysqli_prepare($db, $select_borrow_query);
mysqli_stmt_bind_param($stmt, "i", $idx);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_array($result);

?>
<div id="label-page">
    <h3>Transaksi Peminjaman</h3>
</div>
<div id="content">
    <div class="container">
        <form method="post" action="action/borrow_save.php" enctype="multipart/form-data">
            <table id="tabel-input">
                <tr>
                    <td class="label-formulir">Peminjam: </td>
                    <td class="isian-formulir">
                        <input type="hidden" name="memberid" value="<?php echo $row['idanggota']; ?>">
                        <input type="text" value="<?php echo htmlspecialchars($row['nama']); ?>" class="isian-formulir-select isian-formulir-border" required readonly>
                    </td>
                </tr>
                <tr>
                    <td class="label-formulir">Jatuh Tempo: </td>
                    <td class="isian-formulir">
                        <input type="date" value="<?php echo $row['due_date']; ?>" name="duedate" required readonly>
                    </td>
                </tr>
            </table>
            <table id="tabel-tampil" class="my-2">
                <tr>
                    <th id="label-tampil-no">No.</th>
                    <th>Book Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Books Copies</th>
                    <th>Publisher</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
                <?php
                $select_books_query = "SELECT * FROM borrow
                                      INNER JOIN book ON borrow.book_id = book.book_id
                                      WHERE borrow_id = ?";
                $stmt = mysqli_prepare($db, $select_books_query);
                mysqli_stmt_bind_param($stmt, "i", $idx);
                mysqli_stmt_execute($stmt);
                $books_result = mysqli_stmt_get_result($stmt);

                $no = 1;

                while ($book_row = mysqli_fetch_array($books_result)) {
                    $book_id = $book_row['book_id'];
                ?>
                    <tr>
                        <td>
                            <center><?php echo $no . "."; ?><center>
                        </td>
                        <td>
                            <center><?php echo htmlspecialchars($book_row['book_title']); ?></center>
                        </td>
                        <td><?php echo htmlspecialchars($book_row['category']); ?></td>
                        <td><?php echo htmlspecialchars($book_row['author']); ?></td>
                        <td><?php echo htmlspecialchars($book_row['book_copies']); ?></td>
                        <td><?php echo htmlspecialchars($book_row['publisher_name']); ?></td>
                        <td><?php echo $book_row['is_borrowed'] == 1 ? "Dipinjam" : "Dikembalikan"; ?></td>
                        <td>
                            <center>
                                <a href="proses/book_borrow_back.php?book_id=<?php echo $book_row['book_id']; ?>" class="tombol">Kembalikan</a>
                            </center>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </table>

            <a href="index.php?p=listborrow" class="my-2 btn btn-sm btn-warning">Back</a>
        </form>
    </div>
</div>