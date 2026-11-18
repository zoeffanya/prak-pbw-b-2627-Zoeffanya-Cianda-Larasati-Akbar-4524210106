<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <h2>Tambah Mahasiswa</h2>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>

    <form action="/mahasiswa/simpan" method="post">
        NIM:
        <input
            type="text"
            name="nim"
            value="<?= esc($input['nim'] ?? ''); ?>"
            required
        >
        <br><br>

        Nama:
        <input
            type="text"
            name="nama"
            value="<?= esc($input['nama'] ?? ''); ?>"
            required
        >
        <br><br>

        Prodi:
        <input
            type="text"
            name="prodi"
            value="<?= esc($input['prodi'] ?? ''); ?>"
            required
        >
        <br><br>

        IPK:
        <input
            type="number"
            step="0.01"
            min="0"
            max="4"
            name="ipk"
            value="<?= esc($input['ipk'] ?? ''); ?>"
            required
        >
        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="/mahasiswa">Kembali</a>
</body>
</html>
