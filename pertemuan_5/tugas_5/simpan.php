<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form.php");
    exit;
}

$kode_buku = trim($_POST["kode_buku"] ?? "");
$judul = trim($_POST["judul"] ?? "");
$penulis = trim($_POST["penulis"] ?? "");
$kategori = trim($_POST["kategori"] ?? "");
$tahun_terbit = filter_var(
    $_POST["tahun_terbit"] ?? "",
    FILTER_VALIDATE_INT
);
$stok = filter_var(
    $_POST["stok"] ?? "",
    FILTER_VALIDATE_INT
);

if (
    $kode_buku === "" ||
    $judul === "" ||
    $penulis === "" ||
    $kategori === "" ||
    $tahun_terbit === false ||
    $tahun_terbit < 1000 ||
    $tahun_terbit > 2100 ||
    $stok === false ||
    $stok < 0
) {
    die("Data tidak valid. Silakan kembali dan periksa formulir.");
}

$sql = "INSERT INTO buku
        (kode_buku, judul, penulis, kategori, tahun_terbit, stok)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssssii",
    $kode_buku,
    $judul,
    $penulis,
    $kategori,
    $tahun_terbit,
    $stok
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: data.php?pesan=sukses");
    exit;
} else {
    if (mysqli_stmt_errno($stmt) == 1062) {
        echo "Gagal: kode buku sudah digunakan.";
    } else {
        echo "Gagal menyimpan data: " . htmlspecialchars(
            mysqli_stmt_error($stmt)
        );
    }
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
