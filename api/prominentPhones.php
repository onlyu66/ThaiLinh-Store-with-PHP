<?php
include_once "../database/config.php";
$prominentPhonesSql = "select products.id as id, products.model as model, products.price as price,
                products.thumbnail as thumbnail, products.discount as discount from products left join categories on products.categoryId = categories.id where name like 'phone' order by createAt desc limit 20";
$prominentPhonesQuery = mysqli_query($conn, $prominentPhonesSql);

$products = [];
while ($row = mysqli_fetch_array($prominentPhonesQuery)) {
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
