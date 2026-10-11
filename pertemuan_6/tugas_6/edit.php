<?php
include "koneksi.php";

function e($nilai) {
    return htmlspecialchars((string) $nilai, ENT_QUOTES, "UTF-8");
}

$nim = trim($_GET["nim"] ?? "");

if ($nim === "") {
    header("Location: index.php");
    exit;
}

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT * FROM mahasiswa WHERE nim = ?"
);

mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>
        alert('Data mahasiswa tidak ditemukan.');
        window.location.href = 'index.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Edit Mahasiswa</title>
</head>

<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <form
        action="update.php"
        method="POST"
        class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md flex flex-col"
    >
        <h1 class="text-2xl font-bold mb-5">Edit Mahasiswa</h1>

        <input
            type="hidden"
            name="nim_lama"
            value="<?= e($data["nim"]) ?>"
        >

        <label for="nim" class="mb-1 font-semibold">NIM</label>
        <input
            type="text"
            id="nim"
            name="nim"
            value="<?= e($data["nim"]) ?>"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="nama" class="mb-1 font-semibold">Nama</label>
        <input
            type="text"
            id="nama"
            name="nama"
            value="<?= e($data["nama"]) ?>"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="email" class="mb-1 font-semibold">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= e($data["email"]) ?>"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="prodi" class="mb-1 font-semibold">Program Studi</label>
        <input
            type="text"
            id="prodi"
            name="prodi"
            value="<?= e($data["prodi"]) ?>"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="angkatan" class="mb-1 font-semibold">Angkatan</label>
        <input
            type="number"
            id="angkatan"
            name="angkatan"
            min="2000"
            max="2100"
            value="<?= e($data["angkatan"]) ?>"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="ipk" class="mb-1 font-semibold">IPK</label>
        <input
            type="number"
            id="ipk"
            name="ipk"
            min="0"
            max="4"
            step="0.01"
            value="<?= e($data["ipk"]) ?>"
            required
            class="mb-6 p-2 border border-gray-300 rounded-lg"
        >

        <button
            type="submit"
            class="bg-blue-600 text-white font-bold py-2 rounded-lg"
        >
            Simpan Perubahan
        </button>

        <a href="index.php" class="text-center text-blue-600 mt-4">
            Batal
        </a>
    </form>
</body>
</html>