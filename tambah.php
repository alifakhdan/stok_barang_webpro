<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['jumlah_stok'];
    $harga = $_POST['harga_satuan'];

    // Menggunakan Prepared Statement untuk keamanan [cite: 93]
    $sql = "INSERT INTO stok_barang (nama_barang, kategori, jumlah_stok, harga_satuan) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nama, $kategori, $stok, $harga])) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Stok Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="mb-4 text-primary">Tambah Stok Baru</h4>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" placeholder="Contoh: Alpukat Mentega" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <select class="form-select" name="kategori" required>
                        <option value="">Pilih Kategori...</option>
                        <option value="Buah Segar">Buah Segar</option>
                        <option value="Bahan Tambahan">Bahan Tambahan</option>
                        <option value="Kemasan">Kemasan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlah_stok" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga Satuan (Rp)</label>
                        <input type="number" class="form-control" name="harga_satuan" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                    <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>