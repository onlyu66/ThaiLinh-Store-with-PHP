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
                    <p class="font-bold text-base">Chỉnh sửa thông tin sản phẩm</p>
                    <!-- <h1 class="modal-title fs-5" id="exampleModalLabel"></h1> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="modal-body bg-stone-100">
                <form action = "pages/products/handleProduct.php?id=<?php echo $_POST['id']; ?>" method="post" class="formProduct" enctype="multipart/form-data">
                        <?php
                            include_once "../../../untils/utility.php";
                            include_once "../../../database/config.php";
                            include_once "../../../database/dbhelper.php";
                            $id = $_POST['id'];
                            // echo $id;
                            $editSql="SELECT * FROM products WHERE id='$id'";
                            $queryEdit=mysqli_query($conn, $editSql);

                            $imagesSql="select * from galleries where productId='$id'";
                            $images=select($imagesSql,false);
                            // $imagesJSON=json_encode($images);
                            // echo $imagesJSON;
                            $rowE = mysqli_fetch_assoc($queryEdit);
                        ?>
                        <input type="hidden" name="imgValue" value="<?php echo $rowE['thumbnail'];?>">
                        <div>
                            <label>Category:</label>
                            <?php
                                // $sql="select * from products inner join brands on products.brandId=brands.id
                                // union select * from products inner join categories on products.categoriesId=categories.id";
                                $sqlC="select * from categories";
                                $resultC=select($sqlC,false);
                            ?>
                            
                            <select name="category" class="w-4/5 h-10 border border-solid border-black rounded-md">
                                <?php
                                
                                    foreach ($resultC as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id'];?>" <?php echo ($rowE['categoryId']==$value['id'])?"selected":""?>><?php echo $value['name'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div>
                            <label>Brand: </label>
                            <?php
                                // $sql="select * from products inner join brands on products.brandId=brands.id
                                // union select * from products inner join categories on products.categoriesId=categories.id";
                                $sql="select * from brands";
                                $result=select($sql,false);
                            ?>
                            
                            <select name="brand" class="w-4/5 h-10 border border-solid border-black rounded-md">
                                <?php
                                    foreach ($result as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id'];?>" <?php echo ($rowE['brandId']==$value['id'])?"selected":""?>><?php echo $value['brand'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label>Name: </label>
                            <input
                            type="text"
                            name="model"
                            value="<?php echo $rowE['model']; ?>"
                            />
                        </div>

                        <div>
                            <label>Version: </label>
                            <?php
                                // $sql="select * from products inner join brands on products.brandId=brands.id
                                // union select * from products inner join categories on products.categoriesId=categories.id";
                                $sqlV="select * from versions";
                                $resultV=select($sqlV,false);
                            ?>
                            
                            <select name="version" class="w-4/5 h-10 border border-solid border-black rounded-md">
                                <?php
                                    foreach ($resultV as $value) {
                                ?>
                                    <option class="cursor-pointer" value="<?php echo $value['id'];?>" <?php echo ($rowE['versionId']==$value['id'])?"selected":""?>><?php echo $value['ram']."/".$value['rom'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="flex ">
                            <label class="flex-initial w-1/5">Color: </label>
                            <div class="flex flex-initial w-4/5 flex-wrap">
                            <?php
                                
                                if(isset($rowE['colors'])){
                                    $selectedColors=json_decode($rowE['colors']);
                                }else{
                                    $selectedColors=[];
                                }
                                $color="select * from colors";
                                $colorIds = select($color,false);
                                
                                foreach ($colorIds as $key => $colorId) {
                                    $checked = in_array($colorId['id'], $selectedColors) ? 'checked' : '';

                                    $colorClass = $colorId['colorCode'];
                            ?>
                                    <div class="leading-none my-0">
                                    <input type="checkbox" name="color[]" value="<?php echo $colorId['id']; ?>" id="ecolor_<?php echo $colorId['id']; ?>" class="cursor-pointer flex-initial w-1/3" <?php echo $checked; ?>/>
                                    <label class="ml-1 cursor-pointer flex-initial w-2/3" for="ecolor_<?php echo $colorId['id']; ?>">
                                        <i class="fa-solid fa-circle pr-2 <?php echo $colorClass; ?> shadow-sm text-xl"></i>
                                    </label>
                                    </div>
                            <?php
                                }
                            ?>
                            </div>
                        </div>

                        <div>
                            <label>Price: </label>
                            <input
                            type="number"
                            name="price"
                            value="<?php echo $rowE['price']; ?>"
                            />
                        </div>

                        <div>
                            <label>Discount: </label>
                            <input
                            type="text"
                            name="discount"
                            value="<?php echo ($rowE['discount']*100)."%"; ?>"
                            />
                        </div>
                        
                        <div>
                            <label>Title photo:</label>
                            <input
                            type="file"
                            name="image"
                            id="imageInput"
                            />
                        </div>

                        <div class="mt-2">
                            <img src=".<?php echo $rowE['thumbnail'];?>" class="p-1 rounded-xl shadow-sm" style="max-width: 25%; max-height: 100px" id="previewImage" alt="" onclick="document.getElementById('uploadImage').click();">
                        </div>

                        <div>
                            <label>Description photos:</label>
                            <input
                            type="file"
                            name="images[]"
                            id="imagesInput"
                            multiple
                            />
                        </div>

                        <div class="mt-2 flex-wrap" id="imagesDiv">
                            <?php
                            // if(isset($images['thumbnail'])){
                            //     $arr=$images['thumbnail'];
                            // }else{
                            //     $arr=[];
                            // }
                                // echo "<pre>";
                                // var_dump($images);
                                // echo "</pre>";
                                // die();
                                foreach($images as $image){
                            ?>
                                <img src=".<?php echo $image['thumbnail'];?>" class="p-1 rounded-xl shadow-sm" style="max-width: 25%; max-height: 100px" class="previewImages" alt="" onclick="document.getElementById('uploadImages').click();">
                            <?php
                                // $_SESSION['imgs'][]=$image['thumbnail'];
                                }
                                // echo "<pre>";
                                // var_dump($_SESSION['imgs']);
                            ?>
                            
                        </div>
                        <!-- <div>
                            <label>Image:</label>
                            <input
                            type="file"
                            name="image"
                            id="editImage"
                            accept="image/*"
                            />
                        </div>
                        <div class="mt-2" >
                        </div> -->

                        <div>
                            <label>Quantity:</label>
                            <input
                            type="number"
                            name="stockQuantity"
                            value="<?php echo $rowE['stockQuantity']; ?>"
                            />
                        </div>
                        <div>
                            <label>Description:</label>
                            <textarea id="description" name="description"><?php echo $rowE['description']; ?></textarea>
                        </div>
                        
                        <br />
                        <button type="submit" name="editProduct" class="border py-2 px-3 rounded mt-3 shadow-sm bg-zinc-100 hover:bg-zinc-50 font-semibold">
                        Update Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <script>
        document.getElementById('imageInput').addEventListener('change', function() {
            // Kiểm tra xem người dùng đã chọn file chưa
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Hiển thị hình ảnh được chọn
                    document.getElementById('previewImage').src = e.target.result;
                };

                // Đọc hình ảnh được chọn
                reader.readAsDataURL(this.files[0]);
            }
        });

        document.getElementById('imagesInput').addEventListener('change', function() {
            // Kiểm tra xem người dùng đã chọn file chưa
            if (this.files && this.files[0]) {
                var previewContainers = document.getElementById('imagesDiv');
                previewContainers.innerHTML = ''; // Xóa các hình ảnh hiện tại
                var files = document.getElementById('imagesInput').files;
                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '25%';
                        img.style.maxHeight = '100px';
                        img.classList.add("p-1", "rounded-xl", "shadow-sm");
                        previewContainers.appendChild(img);
                    };

                    reader.readAsDataURL(files[i]);
                }
            }
        });
    </script>
<!-- <script>
    function previewImage() {
    var previewContainer = document.getElementById('img_');
    previewContainer.innerHTML = ''; // Xóa hình ảnh hiện tại

    var fileInput = document.getElementById('uploadImage');
    var file = fileInput.files[0]; // Chỉ lấy tệp đầu tiên

    if (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '100%';
            img.style.maxHeight = '100px';
            previewContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
    }
}

</script> -->
<!-- <script>
    function previewImages() {
        var previewContainer = document.getElementById('img');
        previewContainer.innerHTML = ''; // Xóa các hình ảnh hiện tại
       
        var files = document.getElementById('uploadImage').files;


        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '25%';
                img.style.maxHeight = '100px';
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(files[i]);
        }
    }
</script> -->
</body>
</html>