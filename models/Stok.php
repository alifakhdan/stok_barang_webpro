<?php
class Stok {
    private $conn;
    private $table_name = "stok_barang";

    // Properti sesuai dengan kolom di tabel Anda
    public $id;
    public $nama_barang;
    public $kategori;
    public $jumlah_stok;
    public $harga_satuan;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Mengambil semua data (READ)
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Menambah data (CREATE)
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nama_barang, kategori, jumlah_stok, harga_satuan) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute([$this->nama_barang, $this->kategori, $this->jumlah_stok, $this->harga_satuan])) {
            return true;
        }
        return false;
    }

    // Mengubah data (UPDATE)
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_barang=?, kategori=?, jumlah_stok=?, harga_satuan=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute([$this->nama_barang, $this->kategori, $this->jumlah_stok, $this->harga_satuan, $this->id])) {
            return true;
        }
        return false;
    }

    // Menghapus data (DELETE)
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute([$this->id])) {
            return true;
        }
        return false;
    }
}
?>