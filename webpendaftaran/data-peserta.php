<?php 
session_start();
	include 'koneksi.php';
	if($_SESSION['stat_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}


	if(isset($_POST['login'])){
		// Check akun 
		$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$_POST['user']."' AND password = '".MD5($_POST['pass'])."'");

		if(mysqli_num_rows($cek) > 0){
			$a = mysqli_fetch_object($cek);

			$_SESSION['stat_login'] = true;
			$_SESSION['id_admin'] = $a->id_admin;
			$_SESSION['nama'] = $a->nm_admin;
			echo '<script>window.location="beranda.php"</script>';
		}else{
			echo '<script>alert("Gagal, username atau password salah")</script>';
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Pendaftaran</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>

	<!--  Bagian header -->
	<header>
		<h1><a href="beranda.php">Admin Pendaftaran Siswa</a></h1>
		<ul>
			<li><a href="beranda.php">Beranda</a></li>
			<li><a href="data-peserta.php">Data Peserta</a></li>
			<li><a href="keluar.php">Keluar</a></li>
		</ul>
	</header>

	<!-- Content -->
	<section class="content">
	<h2>Data Peserta</h2>
		<div class="box">
		<a href="cetak-peserta.php" target="_blank" class="btn-cetak">Print</a>
			<table class="table" border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>ID Pendaftaran</th>
						<th>Nama</th>
						<th>Jenis kelamin</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					$list_peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran");
					while($row = mysqli_fetch_array($list_peserta)){
						?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $row['id_pendaftaran'] ?></td>
						<td><?php echo $row['nm_peserta'] ?></td>
						<td><?php echo $row['jk'] ?></td>
						<td>
						<a href="detail-peserta.php?id=<?php echo $row['id_pendaftaran'] ?>">Detail</a> ||
						<a href="hapus-perserta.php?id=<?php echo $row['id_pendaftaran'] ?>" onclick="return confirm('Yakin ?')">Hapus</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>

</body>
</html>