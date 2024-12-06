<?php
include_once "../database/config.php";
$iPhoneBatteryReplacementAndRepairSql = "SELECT products.id as id, products.model as model, products.price as price,
            products.thumbnail as thumbnail, products.discount as discount
            FROM products
            JOIN categories ON products.categoryId = categories.id
            JOIN brands ON products.brandId = brands.id
            WHERE categories.name IN ('pin', 'monitor') AND brands.brand LIKE 'Apple'
            ORDER BY products.createAt DESC
            LIMIT 15";
$iPhoneBatteryReplacementAndRepairQuery = mysqli_query($conn, $iPhoneBatteryReplacementAndRepairSql);

$products = [];
while ($row = mysqli_fetch_array($iPhoneBatteryReplacementAndRepairQuery)) {
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
