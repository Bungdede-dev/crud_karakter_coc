<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_karakter_coc';

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$conn) {
	die("Koneksi gagal: " . mysqli_connect_error());
}

// Memilih database (opsional, karena sudah dipilih di atas)
mysqli_select_db($conn, $db);
