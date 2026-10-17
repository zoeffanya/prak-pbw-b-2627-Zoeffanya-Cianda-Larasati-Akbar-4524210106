
<?php

require_once __DIR__ . "/../models/ProdukModel.php";

class ProdukController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new ProdukModel($koneksi);
    }

    public function index() {
        $dataProduk = $this->model->getAllProduk();
        include __DIR__ . "/../views/produk/index.php";
    }

    public function create() {
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nama = trim($_POST["nama_produk"] ?? "");
            $kategori = trim($_POST["kategori"] ?? "");
            $harga = $_POST["harga"] ?? "";
            $stok = $_POST["stok"] ?? "";

            if (
                $nama === "" ||
                $kategori === "" ||
                !is_numeric($harga) ||
                $harga < 0 ||
                filter_var($stok, FILTER_VALIDATE_INT) === false ||
                $stok < 0
            ) {
                $error = "Periksa kembali data yang kamu masukkan.";
            } else {
                $berhasil = $this->model->tambahProduk(
                    $nama,
                    $kategori,
                    (float) $harga,
                    (int) $stok
                );

                if ($berhasil) {
                    header("Location: index.php");
                    exit;
                }

                $error = "Produk gagal ditambahkan.";
            }
        }

        include __DIR__ . "/../views/produk/create.php";
    }

    public function edit() {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $produk = $id ? $this->model->getProdukById($id) : null;

        if (!$produk) {
            http_response_code(404);
            exit("Produk tidak ditemukan.");
        }

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nama = trim($_POST["nama_produk"] ?? "");
            $kategori = trim($_POST["kategori"] ?? "");
            $harga = $_POST["harga"] ?? "";
            $stok = $_POST["stok"] ?? "";

            if (
                $nama === "" ||
                $kategori === "" ||
                !is_numeric($harga) ||
                $harga < 0 ||
                filter_var($stok, FILTER_VALIDATE_INT) === false ||
                $stok < 0
            ) {
                $error = "Periksa kembali data yang kamu masukkan.";
            } else {
                $berhasil = $this->model->updateProduk(
                    $id,
                    $nama,
                    $kategori,
                    (float) $harga,
                    (int) $stok
                );

                if ($berhasil) {
                    header("Location: index.php");
                    exit;
                }

                $error = "Produk gagal diperbarui.";
            }
        }

        include __DIR__ . "/../views/produk/edit.php";
    }

    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php");
            exit;
        }

        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

        if ($id) {
            $this->model->hapusProduk($id);
        }

        header("Location: index.php");
        exit;
    }
}
?>
