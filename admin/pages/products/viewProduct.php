<?php
include_once "../../../database/config.php";
include_once "../../../database/dbhelper.php";

$id = $_POST['id']; // Lấy ID sản phẩm từ AJAX

// Lấy thông tin sản phẩm
$viewSql = "
SELECT brands.brand AS brand, products.model AS model,
versions.ram AS ram, versions.rom AS rom, products.colors AS colors,
products.price AS price, products.discount AS discount, categories.name AS category,
products.thumbnail AS image, products.stockQuantity AS stockQuantity,
products.description AS description
FROM products
JOIN brands ON brands.id = products.brandId
JOIN versions ON versions.id = products.versionId
JOIN categories ON categories.id = products.categoryId
WHERE products.id = '$id'";

$product = select($viewSql, true);

// Lấy ảnh mô tả từ bảng galleries
$imagesSql = "SELECT * FROM galleries WHERE productId = '$id'";
$images = select($imagesSql, false);
?>

    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="viewProductLabel">Thông tin chi tiết sản phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Category:</label>
                <p><?php echo $product['category']; ?></p>
            </div>
            <div class="mb-3">
                <label>Brand:</label>
                <p><?php echo $product['brand']; ?></p>
            </div>
            <div class="mb-3">
                <label>Name:</label>
                <p><?php echo $product['model']; ?></p>
            </div>
            <div class="mb-3">
                <label>Version:</label>
                <p><?php echo $product['ram'] . "/" . $product['rom']; ?></p>
            </div>
            <div class="mb-3">
                <label>Color:</label>
                <p>
                    <?php
                    $selectedColors = json_decode($product['colors']);
                    if ($selectedColors) {
                        foreach ($selectedColors as $colorId) {
                            $colorSql = "SELECT * FROM colors WHERE id = '$colorId'";
                            $color = select($colorSql, true);
                            echo $color['color'] . " ";
                        }
                    }
                    ?>
                </p>
            </div>
            <div class="mb-3">
                <label>Price:</label>
                <p><?php echo number_format($product['price'], 0, '.', ',') . " ₫"; ?></p>
            </div>
            <div class="mb-3">
                <label>Discount:</label>
                <p><?php echo $product['discount'] * 100 . "%"; ?></p>
            </div>
            <div class="mb-3">
                <label>Title photo:</label>
                <img src=".<?php echo $product['image']; ?>" alt="Title Photo" style="max-width: 100px;">
            </div>
            <div class="mb-3">
                <label>Description photos:</label>
                <div>
                    <?php foreach ($images as $image) { ?>
                        <img src=".<?php echo $image['thumbnail']; ?>" alt="Description Photo" style="max-width: 100px; margin-right: 10px;">
                    <?php } ?>
                </div>
            </div>
            <div class="mb-3">
                <label>Quantity:</label>
                <p><?php echo $product['stockQuantity']; ?></p>
            </div>
            <div class="mb-3">
                <label>Description:</label>
                <p><?php echo $product['description']; ?></p>
            </div>
        </div>
    </div>
</div>
