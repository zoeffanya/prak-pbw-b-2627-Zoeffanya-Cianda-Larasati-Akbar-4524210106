<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>

    <a href="/mahasiswa/tambah">Tambah Mahasiswa</a>
    <br><br>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>IPK</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($mahasiswa as $mhs): ?>
        <tr>
            <td><?= esc($mhs['id']); ?></td>
            <td><?= esc($mhs['nim']); ?></td>
            <td><?= esc($mhs['nama']); ?></td>
            <td><?= esc($mhs['prodi']); ?></td>
            <td><?= esc($mhs['ipk']); ?></td>
            <td>
                <a href="/mahasiswa/edit/<?= esc($mhs['id']); ?>">Edit</a>

                <form action="/mahasiswa/hapus/<?= esc($mhs['id']); ?>"
                      method="post"
                      style="display:inline;"
                      onsubmit="return confirm('Yakin ingin menghapus data ini?');">

                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
