<link rel="stylesheet" href="styles/addProduct.css">

<?php
    // include_once "../../../database/config.php";
    // include_once "../../../database/dbhelper.php";
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="font-bold text-base">Thêm sản phẩm</p>
                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel"></h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="modal-body bg-stone-100">
                <form action = "pages/products/handleProduct.php" method="post" class="formProduct" enctype="multipart/form-data">
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
                                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                
                    <div>
                        <label>Brand: </label>
                        <!-- <input
                        type="text"
                        name="brand"
                        /> -->
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
                                <option value="<?php echo $value['id'];?>"><?php echo $value['brand'];?></option>
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
                                <option class="cursor-pointer" value="<?php echo $value['id'];?>"><?php echo $value['ram']."/".$value['rom'];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="flex ">
                        <label class="flex-initial w-1/5">Color: </label>
                        <div class="flex flex-initial w-4/5 flex-wrap ">
                            <?php
                                
                                $color="select * from colors";
                                $colorIds = select($color,false);
                                
                                foreach ($colorIds as $key => $colorId) {
                                    $colorClass = $colorId['colorCode'];
                            ?>
                                    <div class="my-0">
                                    <input type="checkbox" name="color[]" value="<?php echo $colorId['id']; ?>" id="color_<?php echo $colorId['id']; ?>" class="cursor-pointer flex-initial w-1/3"/>
                                    <label class="ml-1 cursor-pointer flex-initial w-2/3" for="color_<?php echo $colorId['id']; ?>">
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
                        />
                    </div>
                    <div>
                        <label>Discount: </label>
                        <input
                        type="text"
                        name="discount"
                        />
                    </div>
                    
                    <div>
                        <label>Title photo:</label>
                        <input
                        type="file"
                        name="image"
                        id="uploadImage"
                        onchange="previewImage()"
                        />
                    </div>

                    <div class="mt-2" id="img">
                    </div>

                    <div>
                        <label>Description photos:</label>
                        <input
                        type="file"
                        name="images[]"
                        id="uploadImages"
                        multiple
                        onchange="previewImages()"
                        />
                    </div>

                    <div class="flex mt-2 flex-wrap" id="imgs">
                    </div>

                    <div>
                        <label>Quantity:</label>
                        <input
                        type="number"
                        name="stockQuantity"
                        />
                    </div>
                    <div>
                        <label>Description:</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <button type="submit" name="addProduct" class="border py-2 px-3 rounded mt-3 shadow-sm bg-zinc-100 hover:bg-zinc-50 font-semibold">
                        Add Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // function previewImage() {
    //     var previewContainer = document.getElementById('img');
    //     previewContainer.innerHTML = ''; // Xóa các hình ảnh hiện tại
        
    //     var files = document.getElementById('uploadImage').files;


    //     for (var i = 0; i < files.length; i++) {
    //         var reader = new FileReader();

    //         reader.onload = function (e) {
    //             var img = document.createElement('img');
    //             img.src = e.target.result;
    //             img.style.maxWidth = '25%';
    //             img.style.maxHeight = '100px';
    //             previewContainer.appendChild(img);
    //         };

    //         reader.readAsDataURL(files[i]);
    //     }
    // }
    function previewImages() {
        var previewContainers = document.getElementById('imgs');
        previewContainers.innerHTML = ''; // Xóa các hình ảnh hiện tại
        
        var files = document.getElementById('uploadImages').files;


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
</script>
<script>
    function previewImage() {
        var previewContainer = document.getElementById('img');
        previewContainer.innerHTML = ''; // Xóa hình ảnh hiện tại

        var fileInput = document.getElementById('uploadImage');
        var file = fileInput.files[0]; // Chỉ lấy tệp đầu tiên

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '25%';
                img.style.maxHeight = '100px';
                img.classList.add("p-1", "rounded-xl", "shadow-sm");
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }

</script>

