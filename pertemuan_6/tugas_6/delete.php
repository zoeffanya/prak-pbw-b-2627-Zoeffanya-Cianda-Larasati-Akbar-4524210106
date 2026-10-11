<?php
include "koneksi.php";

$nim = trim($_GET["nim"] ?? "");

if ($nim === "") {
    header("Location: index.php");
    exit;
}

$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM mahasiswa WHERE nim = ?"
);

mysqli_stmt_bind_param($stmt, "s", $nim);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>
            alert('Data mahasiswa berhasil dihapus.');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data mahasiswa tidak ditemukan.');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Data gagal dihapus.');
        window.location.href = 'index.php';
    </script>";
}

mysqli_stmt_close($stmt);
?>