
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #fff1f7;
            color: #493444;
        }
        .container {
            max-width: 560px;
            margin: auto;
            padding: 26px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px #e8c6d8;
        }
        h1 { color: #8870c9; }
        label { display: block; margin-top: 16px; font-weight: bold; }
        input {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            border: 1px solid #e7bfd3;
            border-radius: 8px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 15px;
            border: none;
            border-radius: 8px;
            background: #8870c9;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        .back { background: #8b7890; }
        .error { color: #c62848; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Produk</h1>
    <p>Ubah data produk, lalu simpan perubahan.</p>

    <?php if ($error !== ""): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST"
          action="index.php?action=edit&id=<?= (int) $produk["id"] ?>">

        <label>Nama Produk</label>
        <input type="text" name="nama_produk" maxlength="100"
               value="<?= htmlspecialchars(
                   $_POST["nama_produk"] ?? $produk["nama_produk"]
               ) ?>" required>

        <label>Kategori</label>
        <input type="text" name="kategori" maxlength="50"
               value="<?= htmlspecialchars(
                   $_POST["kategori"] ?? $produk["kategori"]
               ) ?>" required>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" min="0" step="0.01"
               value="<?= htmlspecialchars(
                   $_POST["harga"] ?? $produk["harga"]
               ) ?>" required>

        <label>Stok</label>
        <input type="number" name="stok" min="0" step="1"
               value="<?= htmlspecialchars(
                   $_POST["stok"] ?? $produk["stok"]
               ) ?>" required>

        <button class="button" type="submit">Simpan Perubahan</button>
        <a class="button back" href="index.php">Batal</a>
    </form>
</div>
</body>
</html>
