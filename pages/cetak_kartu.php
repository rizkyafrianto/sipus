<?php
include "../koneksi.php";

$idanggota = $_GET['id'];
$q_tampil_anggota = mysqli_query($db, "SELECT * FROM tbanggota WHERE idanggota='$idanggota'");
$r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota);
if (empty($r_tampil_anggota['foto']) or ($r_tampil_anggota['foto'] == '-'))
	$foto = "admin-no-photo.jpg";
else
	$foto = $r_tampil_anggota['foto'];
?>
<style>
	.card-container {
		width: 300px;
		height: 180px;
		background-color: #f1f1f1;
		border: 1px solid #ccc;
		padding: 10px;
		margin: 10px;
		box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
	}

	.card-header {
		font-size: 18px;
		font-weight: bold;
		margin-bottom: 5px;
	}

	.card-details {
		font-size: 14px;
	}
</style>
<div id="content">

	<div class="card-container">
		<div class="card-header">Kartu Perpustakaan</div>
		<img src="../images/<?php echo $foto; ?>" width=70px height=75px style="margin-bottom: 5px;">
		<div class="card-details">
			Nama: <?php echo $r_tampil_anggota['nama']; ?><br>
			ID Anggota: <?php echo $r_tampil_anggota['idanggota']; ?><br>
			Jenis kelamin: <?php echo $r_tampil_anggota['jeniskelamin']; ?><br>
			Semester: <?php echo $r_tampil_anggota['alamat']; ?><br>
		</div>
	</div>

</div>

<script>
	window.print();
</script>