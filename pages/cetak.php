<?php
include "../koneksi.php";

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="../style.css">

<style>
	* {
		font-family: 'Times New Roman', Times, serif;
	}
</style>

</div>
<div id="content">
	<div class="table-responsive small mx-2">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">ID Anggota</th>
					<th scope="col">Nama</th>
					<th scope="col">Email</th>
					<th scope="col">Foto</th>
					<th scope="col">Jenis Kelamin</th>
					<th scope="col">Alamat</th>
				</tr>
			</thead>

			<?php
			$nomor = 1;
			$query = "SELECT * FROM tbanggota ORDER BY idanggota ASC";
			$q_tampil_anggota = mysqli_query($db, $query);
			if (mysqli_num_rows($q_tampil_anggota) > 0) {
				while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {
					if (empty($r_tampil_anggota['foto']) or ($r_tampil_anggota['foto'] == '-'))
						$foto = "admin-no-photo.jpg";
					else
						$foto = $r_tampil_anggota['foto'];
			?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $r_tampil_anggota['idanggota']; ?></td>
						<td><?php echo $r_tampil_anggota['nama']; ?></td>
						<td><?php echo $r_tampil_anggota['email']; ?></td>
						<td class="mx-2"><img class="img rounded-circle" src="../images/<?php echo $foto; ?>" width=40px height=40px></td>
						<td><?php echo $r_tampil_anggota['jeniskelamin']; ?></td>
						<td><?php echo $r_tampil_anggota['alamat']; ?></td>
					</tr>
			<?php $nomor++;
				}
			} else {
				echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
			} ?>
		</table>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

	<script>
		window.print();
	</script>
</div>