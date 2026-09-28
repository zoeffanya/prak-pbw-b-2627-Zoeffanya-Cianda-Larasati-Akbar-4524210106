<?php
interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    protected float $ipk;
    private string $email; // Modifikasi 1: field baru

    public function __construct(string $nim, string $nama, float $ipk, string $email)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->setIpk($ipk);
        $this->setEmail($email);
    }

    public function setIpk(float $ipk): void
    {
        if ($ipk < 0 || $ipk > 4) {
            throw new InvalidArgumentException('IPK harus 0 sampai 4.');
        }
        $this->ipk = $ipk;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    public function setEmail(string $email): void
    {
        // Modifikasi 1: validasi field baru
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Format email tidak valid.');
        }
        $this->email = $email;
    }

    public function getStatus(): string
    {
        // Modifikasi 2: kondisi baru berdasarkan IPK
        if ($this->ipk >= 3.50) {
            return 'Sangat Memuaskan';
        } elseif ($this->ipk >= 3.00) {
            return 'Memuaskan';
        }
        return 'Perlu Peningkatan';
    }

    public function ringkasan(): string
    {
        return $this->nim . ' - ' . $this->nama
            . ' - IPK: ' . number_format($this->ipk, 2)
            . ' - Email: ' . $this->email
            . ' - Status: ' . $this->getStatus();
    }
}

interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga,
        protected int $stok = 10 // Modifikasi tambahan: field stok
    ) {
        if ($harga < 0 || $stok < 0) {
            throw new InvalidArgumentException('Harga dan stok tidak boleh negatif.');
        }
    }

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getStok(): int
    {
        return $this->stok;
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(
        string $nama,
        float $harga,
        private float $diskon,
        int $stok = 10
    ) {
        parent::__construct($nama, $harga, $stok);

        if ($diskon < 0 || $diskon > 100) {
            throw new InvalidArgumentException('Diskon harus 0 sampai 100 persen.');
        }
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }
}

$mhs = new Mahasiswa(
    '4524210106',
    'Zoeffanya Cianda Larasati Akbar',
    4.00,
    'zoeffanya@example.com'
);

$daftar = [
    new Produk('Keyboard', 250000, 5),
    new ProdukDiskon('Mouse', 150000, 10, 8)
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tugas 2 Praktikum PBW</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f8;
            color: #222;
        }
        .container {
            max-width: 850px;
            margin: auto;
        }
        .card {
            background: white;
            padding: 24px;
            margin-bottom: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }
        h1 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th { background: #eee; }
    </style>
</head>
<body>
<div class="container">
    <h1>Tugas 2 Praktikum PBW</h1>

    <div class="card">
        <h2>Identitas Mahasiswa</h2>
        <p><?= htmlspecialchars($mhs->ringkasan()) ?></p>
    </div>

    <div class="card">
        <h2>Daftar Produk</h2>
        <table>
            <tr>
                <th>Produk</th>
                <th>Harga Akhir</th>
                <th>Stok</th>
            </tr>
            <?php foreach ($daftar as $produk): ?>
                <tr>
                    <td><?= htmlspecialchars($produk->getNama()) ?></td>
                    <td>Rp <?= number_format($produk->hargaAkhir(), 0, ',', '.') ?></td>
                    <td><?= $produk->getStok() ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>
