<?php
include_once "../database/config.php";
$prominentSpeakersHeadphonesSql = "select products.id as id, products.model as model, products.price as price,
                    products.thumbnail as thumbnail, products.discount as discount from products join categories on products.categoryId=categories.id where name in ('headphone','speaker') order by products.id desc limit 10";
$prominentSpeakersHeadphonesQuery = mysqli_query($conn, $prominentSpeakersHeadphonesSql);

$products = [];
while ($row = mysqli_fetch_array($prominentSpeakersHeadphonesQuery)) {
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
