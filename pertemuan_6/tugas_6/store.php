
<?php
include 'koneksi.php';

// Memastikan form dikirim menggunakan method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create.php');
    exit;
}

// Mengambil data dari form
$nim      = trim($_POST['nim'] ?? '');
$nama     = trim($_POST['nama'] ?? '');
$email    = trim($_POST['email'] ?? '');
$prodi    = trim($_POST['prodi'] ?? '');
$angkatan = trim($_POST['angkatan'] ?? '');
$ipk      = trim($_POST['ipk'] ?? '');

// Validasi data wajib
if (
    $nim === '' ||
    $nama === '' ||
    $email === '' ||
    $prodi === '' ||
    $angkatan === '' ||
    $ipk === ''
) {
    die('Semua kolom wajib diisi. Silakan kembali dan lengkapi form.');
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Format email tidak valid. Silakan kembali dan periksa email.');
}

// Validasi IPK
if (!is_numeric($ipk) || $ipk < 0 || $ipk > 4) {
    die('IPK harus berupa angka antara 0.00 sampai 4.00.');
}

// Menyiapkan query INSERT
$sql = "INSERT INTO mahasiswa
        (nim, nama, email, prodi, angkatan, ipk)
        VALUES (?, ?, ?, ?, ?, ?)";

// Gunakan variabel koneksi dari koneksi.php, yaitu $koneksi
$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
    die('Gagal menyiapkan query: ' . mysqli_error($koneksi));
}

// Mengikat parameter ke query
mysqli_stmt_bind_param(
    $stmt,
    "sssssd",
    $nim,
    $nama,
    $email,
    $prodi,
    $angkatan,
    $ipk
);

// Menjalankan query
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);

    header('Location: index.php');
    exit;
}

// Menampilkan pesan jika penyimpanan gagal
$errorCode = mysqli_stmt_errno($stmt);

if ($errorCode == 1062) {
    $pesan = 'NIM sudah terdaftar. Gunakan NIM yang berbeda.';
} else {
    $pesan = 'Data gagal disimpan: ' . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);

echo htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8');
?>
