
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan MVC - Daftar Produk</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #fff1f7;
            color: #493444;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px #e8c6d8;
        }
        h1 { color: #b8427d; margin-top: 0; }
        .button {
            display: inline-block;
            background: #d95797;
            color: white;
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .edit { background: #8870c9; }
        .delete { background: #d94f68; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #f0dce7;
            text-align: left;
        }
        th { background: #f9d7e8; color: #773c5c; }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; }
        .empty { text-align: center; padding: 25px; }
        @media (max-width: 700px) {
            .container { overflow-x: auto; }
            table { min-width: 650px; }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>♡ Manajemen Produk</h1>
    <p>Kelola data produk penjualan melalui sistem MVC.</p>

    <a class="button" href="index.php?action=create">+ Tambah Produk</a>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;

        if (mysqli_num_rows($dataProduk) > 0):
            while ($produk = mysqli_fetch_assoc($dataProduk)):
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($produk["nama_produk"]) ?></td>
                <td><?= htmlspecialchars($produk["kategori"]) ?></td>
                <td>Rp <?= number_format($produk["harga"], 0, ",", ".") ?></td>
                <td><?= (int) $produk["stok"] ?></td>
                <td>
                    <div class="actions">
                        <a class="button edit"
                           href="index.php?action=edit&id=<?= (int) $produk["id"] ?>">
                           Edit
                        </a>

                        <form method="POST" action="index.php?action=delete"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            <input type="hidden" name="id"
                                   value="<?= (int) $produk["id"] ?>">
                            <button class="button delete" type="submit">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr>
                <td colspan="6" class="empty">Belum ada data produk.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
