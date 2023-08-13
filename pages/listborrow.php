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
        include "koneksi.php";
        $dml = "SELECT a.nama, a.email, b.borrow_id, b.date_borrow, b.due_date, c.book_title
        FROM tbanggota AS a
        INNER JOIN borrow AS b ON b.idanggota = a.idanggota 
        INNER JOIN book AS c ON c.book_id = b.book_id 
        WHERE b.status = 1";
        $qry = mysqli_query($db, $dml);
        $no = 1;

        while ($row = mysqli_fetch_array($qry)) {
            $id = $row['borrow_id'];
        ?>
            <tr>
                <td>
                    <center><?php echo $no . "."; ?></center>
                </td>
                <td>
                    <center><?php echo strip_tags($row['nama']); ?></center>
                </td>
                <td><?php echo strip_tags($row['email']); ?></td>
                <td><?php echo strip_tags($row['book_title']); ?></td>
                <td><?php echo $row['date_borrow']; ?></td>
                <td><?php echo $row['due_date']; ?></td>
                <td>
                    <div class="tombol-action-container">
                        <a href="index.php?p=editborrow&id=<?php echo $id; ?>" class="btn btn-sm btn-secondary">View Details</a>
                    </div>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </table>
</div>