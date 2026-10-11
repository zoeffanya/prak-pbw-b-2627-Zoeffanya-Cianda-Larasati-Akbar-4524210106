<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f7;
            margin: 30px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #243b53;
        }

        label {
            display: block;
            margin-top: 12px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            background: #243b53;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Data Buku Perpustakaan</h2>

        <form action="simpan.php" method="POST">
            <label>Kode Buku</label>
            <input type="text" name="kode_buku" required>

            <label>Judul Buku</label>
            <input type="text" name="judul" required>

            <label>Penulis</label>
            <input type="text" name="penulis" required>

            <label>Kategori</label>
            <input type="text" name="kategori" required>

            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit"
                   min="1000" max="2100" required>

            <label>Stok Buku</label>
            <input type="number" name="stok" min="0" required>

            <button type="submit">Simpan Buku</button>
        </form>

        <p>
            <a href="data.php">Lihat Data Buku</a>
        </p>
    </div>
</body>
</html>
