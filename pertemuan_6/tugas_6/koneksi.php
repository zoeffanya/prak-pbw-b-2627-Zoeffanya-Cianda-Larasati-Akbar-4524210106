
<?php
$koneksi = mysqli_connect(
    "127.0.0.1",
    "root",
    "",
    "akademik"
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
