<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Tambah Mahasiswa</title>
</head>

<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <form
        action="store.php"
        method="POST"
        class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md flex flex-col"
    >
        <h1 class="text-2xl font-bold mb-5">Tambah Mahasiswa</h1>

        <label for="nim" class="mb-1 font-semibold">NIM</label>
        <input
            type="text"
            id="nim"
            name="nim"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="nama" class="mb-1 font-semibold">Nama</label>
        <input
            type="text"
            id="nama"
            name="nama"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="email" class="mb-1 font-semibold">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="prodi" class="mb-1 font-semibold">Program Studi</label>
        <input
            type="text"
            id="prodi"
            name="prodi"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="angkatan" class="mb-1 font-semibold">Angkatan</label>
        <input
            type="number"
            id="angkatan"
            name="angkatan"
            min="2000"
            max="2100"
            required
            class="mb-4 p-2 border border-gray-300 rounded-lg"
        >

        <label for="ipk" class="mb-1 font-semibold">IPK</label>
        <input
            type="number"
            id="ipk"
            name="ipk"
            min="0"
            max="4"
            step="0.01"
            required
            class="mb-6 p-2 border border-gray-300 rounded-lg"
        >

        <button
            type="submit"
            class="bg-blue-600 text-white font-bold py-2 rounded-lg"
        >
            Simpan
        </button>

        <a href="index.php" class="text-center text-blue-600 mt-4">
            Kembali ke Data Mahasiswa
        </a>
    </form>
</body>
</html>