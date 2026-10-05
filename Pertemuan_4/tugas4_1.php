<?php

require_once 'koneksi.php';

mysqli_select_db($koneksi, 'akademik');

$sqlInsert = "INSERT IGNORE INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2026001', 'Andi Pratama', 'andi@kampus.ac.id', 'Teknik Informatika', 2026, 3.75),
('2026002', 'Siti Rahma', 'siti@kampus.ac.id', 'Sistem Informasi', 2026, 3.82),
('2026003', 'Budi Santoso', 'budi@kampus.ac.id', 'Teknik Informatika', 2026, 3.20)";

if (mysqli_query($koneksi, $sqlInsert)) {
    echo "[INSERT] Data mahasiswa berhasil dimasukan ke tabel.\n\n";
} else {
    echo "[ERROR] Gagal memasukan data: " . mysqli_error($koneksi) . "\n\n";
}

$sqlSelect = "SELECT nim, nama, prodi, ipk
              FROM mahasiswa
              WHERE ipk >= 3.50
              ORDER BY ipk DESC, nama ASC
              LIMIT 10";

$RESULT = mysqli_query($koneksi, $sqlSelect);

echo "- - - Hasil Query SELECT - - -\n";

if (mysqli_num_rows($RESULT) > 0) {

    while ($row = mysqli_fetch_assoc($RESULT)) {

        // MODIFIKASI 1: Menentukan status IPK
        if ($row['ipk'] >= 3.75) {
            $statusIpk = "Sangat Baik";
        } elseif ($row['ipk'] >= 3.50) {
            $statusIpk = "Baik";
        } else {
            $statusIpk = "Cukup";
        }

        echo "NIM: " . $row['nim'] . "\n";
        echo "Nama: " . $row['nama'] . "\n";
        echo "Prodi: " . $row['prodi'] . "\n";
        echo "IPK: " . $row['ipk'] . "\n";
        echo "Status IPK: " . $statusIpk . "\n";
        echo "-------------------------\n";
    }

} else {
    echo "Tidak ada data mahasiswa dengan kriteria tersebut.\n";
}

// MODIFIKASI 2: Menghitung jumlah mahasiswa yang memenuhi kriteria
$sqlCount = "SELECT COUNT(*) AS jumlah
             FROM mahasiswa
             WHERE ipk >= 3.50";

$resultCount = mysqli_query($koneksi, $sqlCount);

if ($resultCount) {
    $dataCount = mysqli_fetch_assoc($resultCount);

    echo "\nJumlah mahasiswa dengan IPK >= 3.50: "
        . $dataCount['jumlah'] . "\n";
} else {
    echo "Gagal menghitung jumlah mahasiswa: "
        . mysqli_error($koneksi) . "\n";
}

mysqli_close($koneksi);

?>