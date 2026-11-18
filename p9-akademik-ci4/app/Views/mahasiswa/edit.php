<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h2>Edit Mahasiswa</h2>

    <form action="/mahasiswa/update/<?= $mahasiswa['id']; ?>" method="post">
        NIM:
        <input type="text" name="nim" value="<?= esc($mahasiswa['nim']); ?>" required>
        <br><br>

        Nama:
        <input type="text" name="nama" value="<?= esc($mahasiswa['nama']); ?>" required>
        <br><br>

        Prodi:
        <input type="text" name="prodi" value="<?= esc($mahasiswa['prodi']); ?>" required>
        <br><br>

        IPK:
        <input type="number" step="0.01" name="ipk" value="<?= esc($mahasiswa['ipk']); ?>" required>
        <br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="/mahasiswa">Kembali</a>
</body>
</html>