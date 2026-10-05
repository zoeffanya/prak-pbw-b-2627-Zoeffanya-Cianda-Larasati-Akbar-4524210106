<?php

require_once 'koneksi.php';

// Memilih database
mysqli_select_db($koneksi, 'akademik');

// ==========================================
// 1. UPDATE: Mengubah data IPK
// ==========================================
echo "=== 1. PROSES UPDATE DATA ===\n";

$sqlUpdate = "UPDATE mahasiswa SET ipk = 3.40 WHERE nim = '2025003'";

if (mysqli_query($koneksi, $sqlUpdate)) {
    echo "Data IPK mahasiswa dengan NIM 2025003 berhasil diubah menjadi 3.40.\n";

    // MODIFIKASI 1: Menampilkan status berdasarkan IPK
    $sqlCekIpk = "SELECT ipk FROM mahasiswa WHERE nim = '2025003'";
    $resultCekIpk = mysqli_query($koneksi, $sqlCekIpk);

    if ($resultCekIpk && mysqli_num_rows($resultCekIpk) > 0) {
        $dataIpk = mysqli_fetch_assoc($resultCekIpk);

        if ($dataIpk['ipk'] >= 3.50) {
            echo "Status IPK: Baik.\n\n";
        } else {
            echo "Status IPK: Perlu ditingkatkan.\n\n";
        }
    }

} else {
    echo "Gagal UPDATE: " . mysqli_error($koneksi) . "\n\n";
}


// 2. SELECT & GROUP BY: Rekap jumlah mahasiswa per prodi
$sqlRekap = "SELECT prodi, COUNT(*) AS jumlah_mahasiswa
             FROM mahasiswa
             GROUP BY prodi
             ORDER BY jumlah_mahasiswa DESC";

$resultRekap = mysqli_query($koneksi, $sqlRekap);

echo "=== 2. REKAP MAHASISWA PER PRODI ===\n";

if (mysqli_num_rows($resultRekap) > 0) {

    $totalMahasiswa = 0;

    while ($row = mysqli_fetch_assoc($resultRekap)) {
        echo "Prodi: " . $row['prodi'] . "\n";
        echo "Jumlah: " . $row['jumlah_mahasiswa'] . "\n";
        echo "-------------------------\n";

        // MODIFIKASI 2: Menghitung total mahasiswa
        $totalMahasiswa += $row['jumlah_mahasiswa'];
    }

    echo "Total seluruh mahasiswa: " . $totalMahasiswa . "\n\n";

} else {
    echo "Tidak ada data rekap prodi.\n";
}


// 3. SELECT: Verifikasi sebelum penghapusan
$sqlVerifikasi = "SELECT * FROM mahasiswa WHERE nim = '2025003'";

$resultVerifikasi = mysqli_query($koneksi, $sqlVerifikasi);

echo "=== 3. VERIFIKASI DATA SEBELUM DELETE ===\n";

if (mysqli_num_rows($resultVerifikasi) > 0) {
    $row = mysqli_fetch_assoc($resultVerifikasi);

    echo "Data ditemukan:\n";
    echo "NIM  : " . $row['nim'] . "\n";
    echo "Nama : " . $row['nama'] . "\n";
    echo "Prodi: " . $row['prodi'] . "\n";
    echo "IPK  : " . $row['ipk'] . "\n";
} else {
    echo "Data mahasiswa tidak ditemukan.\n";
}


// 4. DELETE: Menghapus data
$sqlDelete = "DELETE FROM mahasiswa WHERE nim = '2025003'";

if (mysqli_query($koneksi, $sqlDelete)) {
    echo "Data mahasiswa dengan NIM 2025003 berhasil dihapus dari tabel.\n";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi) . "\n";
}

mysqli_close($koneksi);

?>