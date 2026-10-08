<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'akademik1';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi ke server MySQL berhasil!\n";
?>


