
<?php

class ProdukModel {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function getAllProduk() {
        $query = "SELECT * FROM produk ORDER BY id DESC";
        return mysqli_query($this->koneksi, $query);
    }

    public function getProdukById($id) {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT * FROM produk WHERE id = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);
        $produk = mysqli_fetch_assoc($hasil);

        mysqli_stmt_close($stmt);

        return $produk;
    }

    public function tambahProduk($nama, $kategori, $harga, $stok) {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO produk (nama_produk, kategori, harga, stok)
             VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssdi",
            $nama,
            $kategori,
            $harga,
            $stok
        );

        $berhasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $berhasil;
    }

    public function updateProduk($id, $nama, $kategori, $harga, $stok) {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE produk
             SET nama_produk = ?, kategori = ?, harga = ?, stok = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssdii",
            $nama,
            $kategori,
            $harga,
            $stok,
            $id
        );

        $berhasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $berhasil;
    }

    public function hapusProduk($id) {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "DELETE FROM produk WHERE id = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);

        $berhasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $berhasil;
    }
}
?>
