                <?php
                include "koneksi.php";
                $dml = "SELECT * FROM tbanggota ORDER BY nama ASC";
                $qry = mysqli_query($db, $dml);
                ?>
                <div id="label-page">
                    <h3>Transaksi Peminjaman</h3>
                </div>
                <div id="content">
                    <div class="container">
                        <form method="post" action="proses/borrow_save.php" enctype="multipart/form-data">
                            <table id="tabel-input">
                                <tr>
                                    <td class="label-formulir">Anggota: </td>
                                    <td class="isian-formulir">
                                        <select name="idanggota" class="isian-formulir-select isian-formulir-border" required>
                                            <?php
                                            while ($row = mysqli_fetch_array($qry)) {
                                                $id = $row['idanggota'];
                                                echo "<option value='$id'>" . $row['nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label-formulir">Jatuh Tempo: </td>
                                    <td class="isian-formulir">
                                        <input type="date" name="duedate" required>
                                    </td>
                                </tr>
                            </table>
                            <table id="tabel-tampil">
                                <tr>
                                    <th id="label-tampil-no">No.</th>
                                    <th>Book Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Books Copies</th>
                                    <th>Publisher</th>
                                    <th>Select</th>
                                </tr>
                                <?php
                                $dml = "SELECT * FROM book ORDER BY book_title ASC";
                                $qry = mysqli_query($db, $dml);
                                $no = 1;

                                while ($row = mysqli_fetch_array($qry)) {
                                    $id = $row['book_id'];
                                ?>
                                    <tr>
                                        <td>
                                            <center><?php echo $no . "."; ?><center>
                                        </td>
                                        <!-- mengirim id book untuk eksekusi is_borrowed -->
                                        <input type="hidden" name="book_id" value="<?php echo $row["book_id"]; ?>">
                                        <td>
                                            <center><?php echo $row['book_title'] ?></center>
                                        </td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td><?php echo $row['author']; ?></td>
                                        <td><?php echo $row['book_copies']; ?></td>
                                        <td><?php echo $row['publisher_name']; ?></td>
                                        <td>
                                            <center><input type="checkbox" name="selector[]" value="<?php echo $id; ?>"></center>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </table>
                            <div class="control-group my-2">
                                <div class="controls">
                                    <button class="btn  btn-sm btn-secondary" name="submit" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>