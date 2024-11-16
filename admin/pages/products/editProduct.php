<?php
include_once "../../../database/config.php";     // Kết nối database
include_once "../../../database/dbhelper.php";   // Các hàm trợ giúp database
// Lấy ID sản phẩm từ AJAX
$id = $_POST['id'];

// Lấy thông tin sản phẩm
$editSql = "SELECT * FROM products WHERE id='$id'";
$queryEdit = select($editSql, true);

$imagesSql = "SELECT * FROM galleries WHERE productId='$id'";
$images = select($imagesSql, false);

$sqlC = "SELECT * FROM categories";
$resultC = select($sqlC, false);

$sqlB = "SELECT * FROM brands";
$resultB = select($sqlB, false);

$sqlV = "SELECT * FROM versions";
$resultV = select($sqlV, false);

$sqlColor = "SELECT * FROM colors";
$colorIds = select($sqlColor, false);
?>
<!-- Edit Product Modal -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" enctype="multipart/form-data">
                    <div id="errorMessage" class="alert alert-danger d-none"></div>
                    
                    <!-- Hidden input for product ID -->
                    <input type="hidden" name="id" value="<?php echo $queryEdit['id']; ?>">
                    <input type="hidden" name="currentThumbnail" value="<?php echo $queryEdit['thumbnail']; ?>">

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <?php
                            $categories = select("SELECT * FROM categories", false);
                            foreach ($categories as $category) {
                                $selected = ($queryEdit['categoryId'] == $category['id']) ? 'selected' : '';
                                echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="categoryError"></div>
                    </div>

                    <!-- Brand -->
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <select name="brand" class="form-select">
                            <?php
                            $brands = select("SELECT * FROM brands", false);
                            foreach ($brands as $brand) {
                                $selected = ($queryEdit['brandId'] == $brand['id']) ? 'selected' : '';
                                echo "<option value='{$brand['id']}' $selected>{$brand['brand']}</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="brandError"></div>
                    </div>

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="model" class="form-control" value="<?php echo $queryEdit['model']; ?>">
                        <div class="invalid-feedback" id="modelError"></div>
                    </div>

                    <!-- Version -->
                    <div class="mb-3">
                        <label class="form-label">Version</label>
                        <select name="version" class="form-select">
                            <?php
                            $versions = select("SELECT * FROM versions", false);
                            foreach ($versions as $version) {
                                $selected = ($queryEdit['versionId'] == $version['id']) ? 'selected' : '';
                                echo "<option value='{$version['id']}' $selected>{$version['ram']}/{$version['rom']}</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="versionError"></div>
                    </div>

                    <!-- Colors -->
                    <div class="mb-3">
                        <label class="form-label">Colors</label>
                        <div class="d-flex flex-wrap gap-3">
                            <?php
                            $selectedColors = json_decode($queryEdit['colors']) ?: [];
                            $colors = select("SELECT * FROM colors", false);
                            foreach ($colors as $color) {
                                $checked = in_array($color['id'], $selectedColors) ? 'checked' : '';
                                echo "
                                <div class='form-check'>
                                    <input type='checkbox' name='color[]' value='{$color['id']}' 
                                           class='form-check-input' $checked>
                                    <label class='form-check-label'>{$color['color']}</label>
                                </div>";
                            }
                            ?>
                        </div>
                        <div class="invalid-feedback" id="colorError"></div>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" 
                               value="<?php echo $queryEdit['price']; ?>">
                        <div class="invalid-feedback" id="priceError"></div>
                    </div>

                    <!-- Discount -->
                    <div class="mb-3">
                        <label class="form-label">Discount (%)</label>
                        <input type="number" name="discount" class="form-control" 
                               min="0" max="100" 
                               value="<?php echo $queryEdit['discount'] * 100; ?>">
                        <div class="invalid-feedback" id="discountError"></div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-3">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <div class="invalid-feedback" id="imageError"></div>
                        <div id="thumbnailPreview" class="mt-2">
                            <img src=".<?php echo $queryEdit['thumbnail']; ?>" 
                                 class="img-thumbnail" style="max-height: 200px">
                        </div>
                    </div>

                    <!-- Gallery Images -->
                    <div class="mb-3">
                        <label class="form-label">Gallery Images</label>
                        <input type="file" name="images[]" class="form-control" 
                               accept="image/*" multiple>
                        <div class="invalid-feedback" id="imagesError"></div>
                        <div id="galleryPreview" class="mt-2 d-flex flex-wrap gap-2">
                            <?php foreach ($images as $image) { ?>
                                <img src=".<?php echo $image['thumbnail']; ?>" 
                                     class="img-thumbnail" style="max-height: 100px; margin-right: 5px;">
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stockQuantity" class="form-control" 
                               min="0" value="<?php echo $queryEdit['stockQuantity']; ?>">
                        <div class="invalid-feedback" id="stockQuantityError"></div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" 
                                  rows="3"><?php echo $queryEdit['description']; ?></textarea>
                        <div class="invalid-feedback" id="descriptionError"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>


<script>
    // Preview thumbnail
    document.querySelector('#editProductForm input[name="image"]').addEventListener('change', function(e) {
        const preview = document.getElementById('thumbnailPreview');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px">`;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Preview gallery images
    document.querySelector('#editProductForm input[name="images[]"]').addEventListener('change', function(e) {
        const preview = document.getElementById('galleryPreview');
        preview.innerHTML = '';
        
        if (this.files) {
            [...this.files].forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML += `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 100px; margin-right: 5px">`;
                }
                reader.readAsDataURL(file);
            });
        }
    });

    // Handle form submission
    document.getElementById('editProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset error messages
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerHTML = '');
        document.getElementById('errorMessage').classList.add('d-none');

        const formData = new FormData(this);
        formData.append('editProduct', '1');

        fetch('pages/products/handleProduct.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Thông báo và reload trang
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Product updated successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            } else {
                // Xử lý lỗi
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, value]) => {
                        const errorElement = document.getElementById(key + 'Error');
                        if (errorElement) {
                            if (key === 'color') {
                                // Xử lý hiển thị lỗi cho Colors
                                errorElement.innerHTML = value;
                            } else {
                                errorElement.innerHTML = value;
                                const inputElement = errorElement.parentElement.querySelector('input, select, textarea');
                                if (inputElement) {
                                    inputElement.classList.add('is-invalid');
                                }
                            }
                        }
                    });
                }
                
                // Hiển thị lỗi chung
                if (data.message) {
                    const errorMessage = document.getElementById('errorMessage');
                    errorMessage.innerHTML = data.message;
                    errorMessage.classList.remove('d-none');
                    
                    // Sweet Alert cho lỗi
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing your request.'
            });
        });
    });
</script>

<!-- Thêm Sweet Alert vào head của trang -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>