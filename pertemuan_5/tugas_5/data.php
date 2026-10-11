<?php
include "koneksi.php";

$cari = trim($_GET["cari"] ?? "");

if ($cari !== "") {
    $sql = "SELECT * FROM buku
            WHERE judul LIKE ? OR kategori LIKE ?
            ORDER BY judul ASC";

    $stmt = mysqli_prepare($koneksi, $sql);
    $kata = "%" . $cari . "%";

    mysqli_stmt_bind_param($stmt, "ss", $kata, $kata);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);
} else {
    $sql = "SELECT * FROM buku ORDER BY judul ASC";
    $hasil = mysqli_query($koneksi, $sql);
    $stmt = null;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f2f4f7;
        }

        h2 {
            color: #243b53;
        }

        .pencarian {
            margin: 20px 0;
        }

        input, button {
            padding: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #243b53;
            color: white;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }
    </style>
</head>
<body>
    <h2>Data Buku Perpustakaan</h2>

    <?php if (($_GET["pesan"] ?? "") === "sukses"): ?>
        <p>Data buku berhasil disimpan.</p>
    <?php endif; ?>

    <form class="pencarian" method="GET" action="data.php">
        <input
            type="text"
            name="cari"
            placeholder="Cari judul atau kategori..."
            value="<?= htmlspecialchars($cari) ?>"
        >
        <button type="submit">Cari</button>
        <a href="data.php">Reset</a>
    </form>

    <p><a href="form.php">+ Tambah Buku</a></p>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($hasil && mysqli_num_rows($hasil) > 0): ?>
                <?php while ($buku = mysqli_fetch_assoc($hasil)): ?>
                    <tr>
                        <td><?= htmlspecialchars($buku["kode_buku"]) ?></td>
                        <td><?= htmlspecialchars($buku["judul"]) ?></td>
                        <td><?= htmlspecialchars($buku["penulis"]) ?></td>
                        <td><?= htmlspecialchars($buku["kategori"]) ?></td>
                        <td><?= htmlspecialchars((string)$buku["tahun_terbit"]) ?></td>
                        <td><?= htmlspecialchars((string)$buku["stok"]) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Data buku tidak ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    if (isset($stmt) && $stmt !== null) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($koneksi);
    ?>
</body>
</html>
