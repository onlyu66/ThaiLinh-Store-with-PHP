<?php
include_once "../database/config.php";
$mayBeLikeProductsSql = "SELECT * FROM products WHERE categoryId IN (1,2) ORDER BY createAt DESC LIMIT 10";
$mayBeLikeProductQuery = mysqli_query($conn, $mayBeLikeProductsSql);

$products = [];
while ($row = mysqli_fetch_array($mayBeLikeProductQuery)) {
    $products[] = [
        'id' => $row['id'],
        'model' => $row['model'],
        'thumbnail' => $row['thumbnail'],
        'price' => number_format($row['price'] * (1 - $row['discount'])),
        'originalPrice' => number_format($row['price']),
        'discount' => $row['discount'] * 100, // Tính tỷ lệ giảm giá %
    ];
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($products);
?>
