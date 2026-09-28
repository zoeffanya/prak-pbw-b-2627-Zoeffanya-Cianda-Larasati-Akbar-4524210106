<?php
$hasil = null;
$pesan = '';

$a = '';
$b = '';
$operator = '+';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $a = $_POST['a'] ?? '';
    $b = $_POST['b'] ?? '';
    $operator = $_POST['operator'] ?? '+';

    // MODIFIKASI 1: validasi input kalkulator
    if ($a === '' || $b === '') {
        $pesan = 'Kedua angka wajib diisi.';
    } elseif (!is_numeric($a) || !is_numeric($b)) {
        $pesan = 'Input harus berupa angka.';
    } else {
        $a = (float) $a;
        $b = (float) $b;

        switch ($operator) {
            case '+': $hasil = $a + $b; break;
            case '-': $hasil = $a - $b; break;
            case '*': $hasil = $a * $b; break;
            case '/':
                if ($b == 0) {
                    $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
                } else {
                    $hasil = $a / $b;
                }
                break;
            default: $pesan = 'Operator tidak valid.';
        }
    }
}

$mahasiswa = [
    'nim' => '4524210106',
    'nama' => 'Zoeffanya Cianda Larasati Akbar',
    'prodi' => 'Teknik Informatika',
    'semester' => 5,
    'ipk' => 4.00,
    'email' => 'zoeffanyaa@gmail.com' // MODIFIKASI 2: field baru
];

function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

// MODIFIKASI 2: kondisi baru berdasarkan semester
function statusSemester(int $semester): string
{
    if ($semester >= 1 && $semester <= 6) {
        return 'Mahasiswa Aktif';
    }
    return 'Perlu Cek Status Akademik';
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tugas 1 Praktikum PBW</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f6f8; color: #222; }
        .container { max-width: 850px; margin: auto; }
        .card { background: white; padding: 24px; margin-bottom: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        h1 { text-align: center; }
        h2 { margin-top: 0; }
        input, select, button { padding: 9px; margin: 4px; }
        button { cursor: pointer; }
        .hasil, .error { margin-top: 15px; font-weight: bold; }
        table { border-collapse: collapse; width: 100%; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        td:first-child { font-weight: bold; width: 180px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Tugas 1 Praktikum PBW</h1>

    <div class="card">
        <h2>1. Kalkulator Sederhana</h2>
        <form method="post">
            <input type="number" step="any" name="a" value="<?= htmlspecialchars((string)$a) ?>" placeholder="Angka pertama" required>
            <select name="operator">
                <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+</option>
                <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>-</option>
                <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>×</option>
                <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>÷</option>
            </select>
            <input type="number" step="any" name="b" value="<?= htmlspecialchars((string)$b) ?>" placeholder="Angka kedua" required>
            <button type="submit">Hitung</button>
        </form>
        <?php if ($pesan): ?>
            <p class="error"><?= htmlspecialchars($pesan) ?></p>
        <?php elseif ($hasil !== null): ?>
            <p class="hasil">Hasil: <?= htmlspecialchars((string)$hasil) ?></p>
        <?php endif; ?>
    </div>

    <div class="card">
        <h2>2. Biodata Mahasiswa</h2>
        <table>
            <?php foreach ($mahasiswa as $kunci => $nilai): ?>
                <tr>
                    <td><?= ucfirst($kunci) ?></td>
                    <td><?= htmlspecialchars((string)$nilai) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><strong>Predikat IPK:</strong> <?= statusKelulusan($mahasiswa['ipk']) ?></p>
        <p><strong>Status Semester:</strong> <?= statusSemester($mahasiswa['semester']) ?></p>
    </div>
</div>
</body>
</html>
