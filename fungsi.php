<?php
include 'koneksi.php';

function tambah_data($data, $files)
{
	$kode_karakter = $data['kode_karakter'];
	$nama_karakter = $data['nama_karakter'];
	$tipe = $data['tipe'];
	$deskripsi = $data['deskripsi'];

	// simpan nama asli file
	$namaFile = $files['gambar']['name'];
	$tmpFile = $files['gambar']['tmp_name'];

	$dir = "img/";
	$targetFile = $dir . basename($namaFile);

	move_uploaded_file($tmpFile, $targetFile);

	$query = "INSERT INTO tb_karakter_coc 
              (id_karakter, kode_karakter, nama_karakter, tipe, gambar, deskripsi) 
              VALUES (null, '$kode_karakter', '$nama_karakter', '$tipe', '$namaFile', '$deskripsi')";
	$sql = mysqli_query($GLOBALS['conn'], $query);

	return true;
}

function ubah_data($data, $files)
{
	$id_karakter = $data['id_karakter'];
	$kode_karakter = $data['kode_karakter'];
	$nama_karakter = $data['nama_karakter'];
	$tipe = $data['tipe'];
	$deskripsi = $data['deskripsi'];

	$queryShow = "SELECT * FROM tb_karakter_coc WHERE id_karakter = '$id_karakter';";
	$sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
	$result = mysqli_fetch_assoc($sqlShow);

	if ($files['gambar']['name'] == "") {
		$namaFile = $result['gambar'];
	} else {
		// hapus gambar lama
		if (file_exists("img/" . $result['gambar'])) {
			unlink("img/" . $result['gambar']);
		}

		$namaFile = $files['gambar']['name'];
		$tmpFile = $files['gambar']['tmp_name'];
		move_uploaded_file($tmpFile, "img/" . $namaFile);
	}

	$query = "UPDATE tb_karakter_coc 
              SET kode_karakter='$kode_karakter', 
                  nama_karakter='$nama_karakter', 
                  tipe='$tipe', 
                  deskripsi='$deskripsi', 
                  gambar='$namaFile' 
              WHERE id_karakter='$id_karakter';";
	$sql = mysqli_query($GLOBALS['conn'], $query);

	return true;
}

function hapus_data($data)
{
	$id_karakter = $data['hapus'];

	$queryShow = "SELECT * FROM tb_karakter_coc WHERE id_karakter = '$id_karakter';";
	$sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
	$result = mysqli_fetch_assoc($sqlShow);

	if (file_exists("img/" . $result['gambar'])) {
		unlink("img/" . $result['gambar']);
	}

	$query = "DELETE FROM tb_karakter_coc WHERE id_karakter = '$id_karakter';";
	$sql = mysqli_query($GLOBALS['conn'], $query);

	return true;
}
