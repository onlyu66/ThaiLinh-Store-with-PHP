<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/addProduct.css">
</head>
<body>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="font-bold text-base">Thông tin chi tiết sản phẩm</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="modal-body bg-stone-100">
                    <?php    
                        include_once "../../../untils/utility.php";
                        include_once "../../../database/config.php";
                        include_once "../../../database/dbhelper.php";
                        $id = $_POST['id'];
                        $viewSql = "
                        SELECT brands.brand as brand, products.model as model,
                        versions.ram as ram, versions.rom as rom,
                        products.colors as colors, products.price as price,
                        products.discount as discount, categories.name as category,
                        products.thumbnail as image,
                        products.stockQuantity as stockQuantity,
                        products.description as description
                        FROM products
                        JOIN brands ON brands.id = products.brandId
                        JOIN versions ON versions.id = products.versionId
                        JOIN categories ON categories.id = products.categoryId
                        WHERE products.id='$id'";
                        $product=select($viewSql,true);

                        $imagesSql="select * from galleries where productId='$id'";
                        $images=select($imagesSql,false);
                       
                    ?>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Category: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $product['category']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Brand: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $product['brand']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Name: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $product['model']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Version: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $product['ram'],"/".$product['rom'];?></p>
                    </div>
                    
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Corlor: </p>
                        <div class="flex flex-initial w-1/4">
                            <?php
                                
                                if(isset($product['colors'])){
                                    $selectedColors=json_decode($product['colors']);
                                }else{
                                    $selectedColors=[];
                                }
                                $color="select * from colors";
                                $colorIds = select($color,false);
                                
                                foreach ($colorIds as $key => $colorId) {
                                    $checked = in_array($colorId['id'], $selectedColors) ? '' : 'hidden';

                                    $colorClass = $colorId['colorCode'];
                            ?>
                                    <i class="fa-solid fa-circle pr-2 <?php echo $colorClass; ?> shadow-sm text-xl" <?php echo $checked;?>></i>
                            <?php
                                }
                            ?>
                        </div>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Price: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo number_format($product['price']);?> ₫</p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Discount: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $product['discount']*100?>%</p>
                    </div>

                    <div class="mb-1">
                        <p class="font-semibold">Title photo: </p>
                        <img src=".<?php echo $product['image']?>" class="p-1 rounded-xl shadow-sm ml-2" width="100px"></img>
                    </div>

                    <div class="mb-2">
                        <p class="font-semibold">Description photos:: </p>
                        <div  class="flex ml-2 flex-wrap">
                            <?php
                                foreach($images as $image){
                            ?>
                                <img src=".<?php echo $image['thumbnail'];?>" class="p-1 rounded-xl shadow-sm" style="max-width: 25%; max-height: 100px" class="previewImages" alt="" onclick="document.getElementById('uploadImages').click();">
                            <?php
                                }
                            ?>
                        </div>
                    </div>

                    <div  class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Quantity: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $product['stockQuantity']?></p>
                    </div>

                    <div  class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Description: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $product['description']?></p>
                    </div>

                </div>
            </div>
        </div>
</body>
</html>