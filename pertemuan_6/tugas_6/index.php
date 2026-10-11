<?php
include "koneksi.php";

$cari = trim($_GET["cari"] ?? "");

if ($cari !== "") {
    $stmt = mysqli_prepare(
        $koneksi,
        "SELECT * FROM mahasiswa
         WHERE nim LIKE ? OR nama LIKE ?
         ORDER BY nim ASC"
    );

    $kataKunci = "%" . $cari . "%";
    mysqli_stmt_bind_param($stmt, "ss", $kataKunci, $kataKunci);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
} else {
    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM mahasiswa ORDER BY nim ASC"
    );
}

if (!$query) {
    die("Gagal mengambil data mahasiswa.");
}

function e($nilai) {
    return htmlspecialchars((string) $nilai, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Data Mahasiswa</title>
</head>

<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md">

        <h1 class="text-2xl font-bold mb-2">Data Mahasiswa</h1>
        <p class="text-gray-500 mb-6">
            Sistem pengelolaan data mahasiswa.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-between mb-5">
            <form action="index.php" method="GET" class="flex gap-2">
                <input
                    type="text"
                    name="cari"
                    value="<?= e($cari) ?>"
                    placeholder="Cari NIM atau nama..."
                    class="border border-gray-300 rounded-lg p-2"
                >

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg"
                >
                    Cari
                </button>

                <?php if ($cari !== ""): ?>
                    <a
                        href="index.php"
                        class="bg-gray-200 px-4 py-2 rounded-lg"
                    >
                        Reset
                    </a>
                <?php endif; ?>
            </form>

            <a
                href="create.php"
                class="bg-green-600 text-white px-4 py-2 rounded-lg text-center"
            >
                + Tambah Mahasiswa
            </a>
        </div>

        <?php if ($cari !== ""): ?>
            <p class="mb-4 text-sm text-gray-600">
                Hasil pencarian untuk:
                <strong><?= e($cari) ?></strong>
            </p>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3">NIM</th>
                        <th class="border p-3">Nama</th>
                        <th class="border p-3">Email</th>
                        <th class="border p-3">Prodi</th>
                        <th class="border p-3">Angkatan</th>
                        <th class="border p-3">IPK</th>
                        <th class="border p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($data = mysqli_fetch_assoc($query)): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="border p-3"><?= e($data["nim"]) ?></td>
                                <td class="border p-3"><?= e($data["nama"]) ?></td>
                                <td class="border p-3"><?= e($data["email"]) ?></td>
                                <td class="border p-3"><?= e($data["prodi"]) ?></td>
                                <td class="border p-3"><?= e($data["angkatan"]) ?></td>
                                <td class="border p-3"><?= e($data["ipk"]) ?></td>

                                <td class="border p-3 whitespace-nowrap">
                                    <a
                                        href="edit.php?nim=<?= urlencode($data["nim"]) ?>"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    <span class="mx-1">|</span>

                                    <a
                                        href="delete.php?nim=<?= urlencode($data["nim"]) ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="text-red-600 hover:underline"
                                    >
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="border p-5 text-center text-gray-500">
                                Data mahasiswa tidak ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>