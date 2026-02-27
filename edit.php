<?php
require 'connection.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM stok_barang WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['jumlah_stok'];
    $harga = $_POST['harga_satuan'];

    $sql = "UPDATE stok_barang SET nama_barang=?, kategori=?, jumlah_stok=?, harga_satuan=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nama, $kategori, $stok, $harga, $id])) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="mb-4 text-warning">Edit Stok Barang</h4>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <select class="form-select" name="kategori" required>
                        <option value="Buah Segar" <?= $data['kategori'] == 'Buah Segar' ? 'selected' : ''; ?>>Buah Segar</option>
                        <option value="Bahan Tambahan" <?= $data['kategori'] == 'Bahan Tambahan' ? 'selected' : ''; ?>>Bahan Tambahan</option>
                        <option value="Kemasan" <?= $data['kategori'] == 'Kemasan' ? 'selected' : ''; ?>>Kemasan</option>
                        <option value="Lainnya" <?= $data['kategori'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlah_stok" value="<?= $data['jumlah_stok']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga Satuan (Rp)</label>
                        <input type="number" class="form-control" name="harga_satuan" value="<?= $data['harga_satuan']; ?>" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning px-4 text-dark">Update Data</button>
                    <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>