<?php
include_once "../../../database/dbhelper.php"; // Kết nối cơ sở dữ liệu và các tiện ích khác

header('Content-Type: application/json');

$sort = isset($_POST["sort"]) ? $_POST["sort"] : "id";

// Sắp xếp dữ liệu theo yêu cầu
if ($sort == "model") {
    $productsSql = "SELECT * FROM products ORDER BY model";
} elseif ($sort == "price") {
    $productsSql = "SELECT * FROM products ORDER BY price";
} elseif ($sort == "stockQuantity") {
    $productsSql = "SELECT * FROM products ORDER BY stockQuantity DESC";
} else {
    $productsSql = "SELECT * FROM products ORDER BY id DESC";
}

// Thực thi truy vấn
$products = select($productsSql, false);

echo json_encode($products); // Trả về danh sách sản phẩm dưới dạng JSON
