<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(["message" => "Method tidak diizinkan."]);
    exit;
}

include_once '../config/Database.php';
include_once '../models/Stok.php';

$database = new Database();
$db = $database->getConnection();
$stok = new Stok($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id)) {
    $stok->id = $data->id;
    if($stok->delete()) {
        http_response_code(200);
        echo json_encode(array("message" => "Barang berhasil dihapus dari stok."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Gagal menghapus barang."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "ID Barang wajib diisi."));
}
?>