<?php
include __DIR__ . "/koneksi.php";
include __DIR__ . "/controllers/MahasiswaController.php";

$controller = new MahasiswaController($koneksi);
$controller->index();
?>