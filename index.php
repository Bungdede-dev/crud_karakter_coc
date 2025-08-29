<?php
include 'koneksi.php';

$query = "SELECT * FROM tb_karakter_coc;";
$sql = mysqli_query($conn, $query);
$no = 0;

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

	<!-- JQuery + Datatables -->
	<link rel="stylesheet" type="text/css" href="datatables/datatables.css" />
	<script type="text/javascript" src="datatables/datatables.js"></script>

	<!-- DataTables Buttons -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
	<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

	<title>CRUD Karakter CoC</title>

	<style>
		body {
			background: url('img/background_coc.jpg') no-repeat center center fixed;
			background-size: cover;
			font-family: Arial, sans-serif;
			transition: background 0.3s, color 0.3s;
		}

		.container {
			background: rgba(255, 255, 255, 0.85);
			padding: 25px;
			border-radius: 15px;
			margin-top: 20px;
		}

		nav.navbar {
			background: rgba(0, 0, 0, 0.7) !important;
		}

		nav.navbar .navbar-brand {
			color: white !important;
			font-weight: bold;
		}

		h1,
		p,
		.blockquote-footer {
			color: #000;
		}

		table {
			background: white;
		}

		footer {
			margin-top: 40px;
			background: rgba(0, 0, 0, 0.8);
			padding: 15px;
		}

		footer a {
			color: white !important;
		}

		/* Scroll to top button */
		#scrollTopBtn {
			position: fixed;
			bottom: 20px;
			right: 20px;
			display: none;
			background: #28a745;
			color: white;
			border: none;
			padding: 10px 15px;
			border-radius: 50%;
			font-size: 18px;
			cursor: pointer;
		}

		/* Dark mode */
		body.dark {
			background: #121212 !important;
			color: #f1f1f1;
		}

		body.dark .container {
			background: rgba(40, 40, 40, 0.9);
			color: #f1f1f1;
		}

		body.dark table {
			background: #1f1f1f;
			color: #fff;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#dt').DataTable({
				dom: 'Bfrtip',
				buttons: [{
						extend: 'excelHtml5',
						text: '<i class="fa fa-file-excel-o"></i> Export Excel',
						className: 'btn btn-success btn-sm'
					},
					{
						extend: 'pdfHtml5',
						text: '<i class="fa fa-file-pdf-o"></i> Export PDF',
						className: 'btn btn-danger btn-sm'
					}
				]
			});
		});
	</script>
</head>

<body>
	<nav class="navbar navbar-light">
		<div class="container-fluid d-flex justify-content-between">
			<a class="navbar-brand" href="#">PROJECT BY KING DEDE</a>
			<div class="d-flex align-items-center text-white">
				<!-- Jam -->
				<span id="clock" class="me-3"></span>
				<!-- Tanggal -->
				<span><?php echo date("l, d F Y"); ?></span>
				<!-- Dark mode toggle -->
				<button onclick="toggleDarkMode()" class="btn btn-sm btn-warning ms-3">
					<i class="fa fa-adjust"></i> Mode
				</button>
			</div>
		</div>
	</nav>

	<!-- Judul -->
	<div class="container">
		<h1 class="mt-4">Data Karakter CoC</h1>
		<figure>
			<blockquote class="blockquote">
				<p>Berisi data karakter Clash of Clans yang tersimpan di database.</p>
			</blockquote>
			<figcaption class="blockquote-footer">
				CRUD <cite title="Source Title">Create Read Update Delete</cite>
			</figcaption>
		</figure>
		<a href="kelola.php" type="button" class="btn btn-primary mb-3">
			<i class="fa fa-plus"></i>
			Tambah Karakter
		</a>
		<?php
		if (isset($_SESSION['hasil'])) :
			$split = explode(",", $_SESSION['hasil']);
		?>
			<div class="alert alert-<?php echo $split[1]; ?> alert-dismissible fade show" role="alert">
				<strong><?php echo $split[0]; ?></strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
			session_destroy();
		endif;
		?>
		<div class="table-responsive">
			<table id="dt" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							<center>No.</center>
						</th>
						<th>Kode Karakter</th>
						<th>Nama Karakter</th>
						<th>Tipe</th>
						<th>Gambar</th>
						<th>Deskripsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($result = mysqli_fetch_assoc($sql)) { ?>
						<tr>
							<td>
								<center><?php echo ++$no; ?>.</center>
							</td>
							<td><?php echo $result['kode_karakter']; ?></td>
							<td><?php echo $result['nama_karakter']; ?></td>
							<td><?php echo $result['tipe']; ?></td>
							<td><img src="img/<?php echo $result['gambar']; ?>" style="width: 100px;"></td>
							<td><?php echo $result['deskripsi']; ?></td>
							<td>
								<a href="kelola.php?ubah=<?php echo $result['id_karakter']; ?>" class="btn btn-success btn-sm">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="proses.php?hapus=<?php echo $result['id_karakter']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('Apakah anda yakin ingin menghapus karakter ini?')">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<!-- Total Data -->
		<?php
		$count = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_karakter_coc");
		$total = mysqli_fetch_assoc($count);
		?>
		<p><b>Total Karakter:</b> <?php echo $total['total']; ?></p>
	</div>

	<!-- Scroll to top button -->
	<button id="scrollTopBtn" onclick="window.scrollTo({top:0, behavior:'smooth'});">↑</button>

	<footer class="text-center">
		<ul class="nav justify-content-center">
			<li class="nav-item"><a class="nav-link active" href="#">Active</a></li>
			<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
			<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
			<li class="nav-item"><a class="nav-link disabled">Disabled</a></li>
		</ul>
	</footer>

	<!-- Script Jam -->
	<script>
		function updateClock() {
			const now = new Date();
			let h = String(now.getHours()).padStart(2, '0');
			let m = String(now.getMinutes()).padStart(2, '0');
			let s = String(now.getSeconds()).padStart(2, '0');
			document.getElementById("clock").innerText = h + ":" + m + ":" + s;
		}
		setInterval(updateClock, 1000);
		updateClock();

		// Scroll button
		window.onscroll = function() {
			let btn = document.getElementById("scrollTopBtn");
			if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
				btn.style.display = "block";
			} else {
				btn.style.display = "none";
			}
		};

		// Dark mode
		function toggleDarkMode() {
			document.body.classList.toggle("dark");
		}
	</script>
</body>

</html>