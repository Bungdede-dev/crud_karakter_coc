<?php
include 'koneksi.php';

$id_karakter = '';
$kode_karakter = '';
$nama_karakter = '';
$tipe = '';
$deskripsi = '';
$gambar = '';

if (isset($_GET['ubah'])) {
	$id_karakter = $_GET['ubah'];

	$query = "SELECT * FROM tb_karakter_coc WHERE id_karakter = '$id_karakter';";
	$sql = mysqli_query($conn, $query);
	$result = mysqli_fetch_assoc($sql);

	$kode_karakter = $result['kode_karakter'];
	$nama_karakter = $result['nama_karakter'];
	$tipe = $result['tipe'];
	$deskripsi = $result['deskripsi'];
	$gambar = $result['gambar'];
} else {
	// generate kode otomatis
	$query = mysqli_query($conn, "SELECT MAX(kode_karakter) as kode FROM tb_karakter_coc");
	$data = mysqli_fetch_assoc($query);
	$lastCode = $data['kode']; // contoh C016
	$num = (int) substr($lastCode, 1);
	$kode_karakter = "C" . str_pad($num + 1, 3, "0", STR_PAD_LEFT);
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

	<title>CRUD Karakter COC</title>
</head>

<body>
	<nav class="navbar navbar-light bg-light mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				CRUD - Karakter COC
			</a>
		</div>
	</nav>
	<div class="container">
		<form method="POST" action="proses.php" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo $id_karakter; ?>" name="id_karakter">

			<div class="mb-3 row">
				<label for="kode_karakter" class="col-sm-2 col-form-label">
					Kode Karakter
				</label>
				<div class="col-sm-10">
					<input readonly type="text" name="kode_karakter" class="form-control" id="kode_karakter" value="<?php echo $kode_karakter; ?>">
				</div>
			</div>

			<div class="mb-3 row">
				<label for="nama_karakter" class="col-sm-2 col-form-label">
					Nama Karakter
				</label>
				<div class="col-sm-10">
					<input required type="text" name="nama_karakter" class="form-control" id="nama_karakter" placeholder="Ex: Barbarian" value="<?php echo $nama_karakter; ?>">
				</div>
			</div>

			<div class="mb-3 row">
				<label for="tipe" class="col-sm-2 col-form-label">
					Tipe Karakter
				</label>
				<div class="col-sm-10">
					<select required id="tipe" name="tipe" class="form-select">
						<option <?php if ($tipe == 'Hero') echo "selected"; ?> value="Hero">Hero</option>
						<option <?php if ($tipe == 'Troop') echo "selected"; ?> value="Troop">Troop</option>
						<option <?php if ($tipe == 'Spell') echo "selected"; ?> value="Spell">Spell</option>
						<option <?php if ($tipe == 'Defense') echo "selected"; ?> value="Defense">Defense</option>
					</select>
				</div>
			</div>

			<div class="mb-3 row">
				<label for="gambar" class="col-sm-2 col-form-label">
					Foto Karakter
				</label>
				<div class="col-sm-10">
					<input <?php if (!isset($_GET['ubah'])) echo "required"; ?>
						class="form-control" type="file" name="gambar" id="gambar" accept="image/*">
					<?php if ($gambar != '') { ?>
						<small>File sekarang: <?php echo $gambar; ?></small>
					<?php } ?>
				</div>
			</div>

			<div class="mb-3 row">
				<label for="deskripsi" class="col-sm-2 col-form-label">
					Deskripsi
				</label>
				<div class="col-sm-10">
					<textarea required class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo $deskripsi; ?></textarea>
				</div>
			</div>

			<div class="mb-3 row mt-4">
				<div class="col">
					<?php if (isset($_GET['ubah'])) { ?>
						<button type="submit" name="aksi" value="edit" class="btn btn-primary">
							<i class="fa fa-floppy-o" aria-hidden="true"></i>
							Simpan Perubahan
						</button>
					<?php } else { ?>
						<button type="submit" name="aksi" value="add" class="btn btn-primary">
							<i class="fa fa-floppy-o" aria-hidden="true"></i>
							Tambahkan
						</button>
					<?php } ?>
					<a href="index.php" type="button" class="btn btn-danger">
						<i class="fa fa-reply" aria-hidden="true"></i>
						Batal
					</a>
				</div>
			</div>
		</form>
	</div>
	<div class="position-absolute bottom-0 start-50 translate-middle-x">
		<div class="d-flex p-2 bd-highlight bg-dark text-white">
			CRUD Clash of Clans
		</div>
	</div>
</body>

</html>