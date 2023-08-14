<div id="label-page">
    <h3>List Data Peminjaman</h3>
</div>
<div id="content">
    <p id="tombol-tambah-container">
        <a href="index.php?p=addborrow" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Tambah Peminjaman</a>
    </p>
    <table id="tabel-tampil">
        <tr>
            <th id="label-tampil-no">No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
            <th id="label-opsi">Action</th>
        </tr>
        <?php
        require_once "config.php";
        $dml = "SELECT a.nama, a.email, b.borrow_id, b.date_borrow, b.due_date, c.book_title
        FROM tbanggota AS a
        INNER JOIN borrow AS b ON b.idanggota = a.idanggota 
        INNER JOIN book AS c ON c.book_id = b.book_id 
        WHERE b.status = 1";
        $stmt = mysqli_prepare($db, $dml);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['borrow_id'];
        ?>
            <tr>
                <td>
                    <center><?php echo $no . "."; ?></center>
                </td>
                <td>
                    <center><?php echo htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?></center>
                </td>
                <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['book_title'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['date_borrow'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['due_date'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <div class="tombol-action-container">
                        <a href="index.php?p=editborrow&id=<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-sm btn-secondary">View Details</a>
                    </div>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </table>
</div>