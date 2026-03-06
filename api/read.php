<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["message" => "Method tidak diizinkan."]);
    exit;
}

include_once '../config/Database.php';
include_once '../models/Stok.php';

$database = new Database();
$db = $database->getConnection();
$stok = new Stok($db);

$stmt = $stok->read();
$num = $stmt->rowCount();

if($num > 0) {
    $stok_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $stok_item = array(
            "id" => $id,
            "nama_barang" => $nama_barang,
            "kategori" => $kategori,
            "jumlah_stok" => $jumlah_stok,
            "harga_satuan" => $harga_satuan
        );
        array_push($stok_arr, $stok_item);
    }
    http_response_code(200);
    echo json_encode($stok_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Data stok tidak ditemukan."));
}
?>