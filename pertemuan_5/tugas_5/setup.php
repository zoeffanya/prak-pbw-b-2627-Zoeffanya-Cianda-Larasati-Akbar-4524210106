<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";

$koneksi = mysqli_connect($host, $user, $pass);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS perpustakaan";

if (mysqli_query($koneksi, $sql)) {
    echo "Database perpustakaan berhasil dibuat.<br>";
} else {
    die("Gagal membuat database: " . mysqli_error($koneksi));
}

mysqli_select_db($koneksi, "perpustakaan");

$sqlTabel = "CREATE TABLE IF NOT EXISTS buku (
    kode_buku VARCHAR(20) PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    tahun_terbit INT NOT NULL,
    stok INT NOT NULL
)";

if (mysqli_query($koneksi, $sqlTabel)) {
    echo "Tabel buku berhasil dibuat.";
} else {
    echo "Gagal membuat tabel: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
