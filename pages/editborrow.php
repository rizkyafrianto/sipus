                <?php
                include "koneksi.php";
                $dml = "SELECT * FROM tbanggota ORDER BY nama ASC";
                $qry = mysqli_query($db, $dml);

                $idx = isset($_GET['id']) ? $_GET['id'] : "";
                $dml = "SELECT * FROM borrow INNER JOIN tbanggota ON borrow.idanggota = tbanggota.idanggota 
			WHERE borrow_id = '$idx'";
                $query = mysqli_query($db, $dml);
                $row = mysqli_fetch_array($query);
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
                                        <select name="memberid" class="isian-formulir-select isian-formulir-border" required readonly>
                                            <?php echo "<option value='" . $row['idanggota'] . "'>" . $row['nama'] . "</option>"; ?>
                                        </select>
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
                                $dml = "SELECT * FROM borrow 
											INNER JOIN book ON borrow.book_id = book.book_id where borrow_id='$idx'";
                                $qry = mysqli_query($db, $dml);
                                $no = 1;

                                while ($row = mysqli_fetch_array($qry)) {
                                    $id = $row['borrow_id'];
                                ?>
                                    <tr>
                                        <td>
                                            <center><?php echo $no . "."; ?><center>
                                        </td>
                                        <td>
                                            <center><?php echo $row['book_title'] ?></center>
                                        </td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td><?php echo $row['author']; ?></td>
                                        <td><?php echo $row['book_copies']; ?></td>
                                        <td><?php echo $row['publisher_name']; ?></td>
                                        <td><?php echo $row['is_borrowed'] == 1 ? "Dipinjam" : "Dikembalikan"; ?></td>
                                        <td>
                                            <center>
                                                <a href="proses/book_borrow_back.php?book_id=<?php echo $row['book_id']; ?>" class="tombol">Kembalikan</a>
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