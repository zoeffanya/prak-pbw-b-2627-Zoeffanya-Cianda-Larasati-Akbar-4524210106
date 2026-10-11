<?php
include "koneksi.php";

function kembali($pesan) {
    echo "<script>";
    echo "alert(" . json_encode($pesan) . ");";
    echo "window.history.back();";
    echo "</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$nimLama = trim($_POST["nim_lama"] ?? "");
$nim = trim($_POST["nim"] ?? "");
$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$prodi = trim($_POST["prodi"] ?? "");
$angkatan = trim($_POST["angkatan"] ?? "");
$ipkInput = trim($_POST["ipk"] ?? "");

if (
    $nimLama === "" || $nim === "" || $nama === "" ||
    $email === "" || $prodi === "" ||
    $angkatan === "" || $ipkInput === ""
) {
    kembali("Semua kolom wajib diisi.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    kembali("Format email tidak valid.");
}

if (
    !is_numeric($angkatan) ||
    (int) $angkatan < 2000 ||
    (int) $angkatan > 2100
) {
    kembali("Angkatan harus berada antara 2000 dan 2100.");
}

if (
    !is_numeric($ipkInput) ||
    (float) $ipkInput < 0 ||
    (float) $ipkInput > 4
) {
    kembali("IPK harus berada antara 0.00 dan 4.00.");
}

$ipk = (float) $ipkInput;

$stmt = mysqli_prepare(
    $koneksi,
    "UPDATE mahasiswa
     SET nim = ?, nama = ?, email = ?, prodi = ?, angkatan = ?, ipk = ?
     WHERE nim = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "sssssds",
    $nim,
    $nama,
    $email,
    $prodi,
    $angkatan,
    $ipk,
    $nimLama
);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
        alert('Data mahasiswa berhasil diperbarui.');
        window.location.href = 'index.php';
    </script>";
} else {
    if (mysqli_stmt_errno($stmt) == 1062) {
        kembali("NIM tersebut sudah digunakan mahasiswa lain.");
    }

    kembali("Data gagal diperbarui. Periksa kembali data.");
}

mysqli_stmt_close($stmt);
?>