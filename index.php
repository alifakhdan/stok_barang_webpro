<?php
require 'connection.php';
$stmt = $pdo->query("SELECT * FROM stok_barang ORDER BY id DESC");
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="mb-4 text-primary">Manajemen Stok Barang</h3>
            
            <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Stok Baru</a>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Sisa Stok</th>
                            <th>Harga Satuan (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($barang as $row): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($row['kategori']); ?></span></td>
                            <td class="text-center fw-bold <?= $row['jumlah_stok'] < 10 ? 'text-danger' : 'text-success' ?>">
                                <?= htmlspecialchars($row['jumlah_stok']); ?>
                            </td>
                            <td class="text-end"><?= number_format($row['harga_satuan'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>