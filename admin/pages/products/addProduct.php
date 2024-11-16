<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" enctype="multipart/form-data">
                    <div id="errorMessage" class="alert alert-danger d-none"></div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <?php
                            $categories = select("SELECT * FROM categories", false);
                            foreach ($categories as $category) {
                                echo "<option value='{$category['id']}'>{$category['name']}</option>";
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
                                echo "<option value='{$brand['id']}'>{$brand['brand']}</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="brandError"></div>
                    </div>

                    <!-- Model Name -->
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="model" class="form-control">
                        <div class="invalid-feedback" id="modelError"></div>
                    </div>

                    <!-- Version -->
                    <div class="mb-3">
                        <label class="form-label">Version</label>
                        <select name="version" class="form-select">
                            <?php
                            $versions = select("SELECT * FROM versions", false);
                            foreach ($versions as $version) {
                                echo "<option value='{$version['id']}'>{$version['ram']}/{$version['rom']}</option>";
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
                            $colors = select("SELECT * FROM colors", false);
                            foreach ($colors as $color) {
                                echo "
                                <div class='form-check'>
                                    <input type='checkbox' name='color[]' value='{$color['id']}' class='form-check-input'>
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
                        <input type="number" name="price" class="form-control">
                        <div class="invalid-feedback" id="priceError"></div>
                    </div>

                    <!-- Discount -->
                    <div class="mb-3">
                        <label class="form-label">Discount (%)</label>
                        <input type="number" name="discount" class="form-control" min="0" max="100">
                        <div class="invalid-feedback" id="discountError"></div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-3">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <div class="invalid-feedback" id="imageError"></div>
                        <div id="thumbnailPreview" class="mt-2"></div>
                    </div>

                    <!-- Gallery Images -->
                    <div class="mb-3">
                        <label class="form-label">Gallery Images</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                        <div class="invalid-feedback" id="imagesError"></div>
                        <div id="galleryPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stockQuantity" class="form-control" min="0">
                        <div class="invalid-feedback" id="stockQuantityError"></div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                        <div class="invalid-feedback" id="descriptionError"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview thumbnail
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const preview = document.getElementById('thumbnailPreview');
        preview.innerHTML = '';
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px">`;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Preview gallery images
    document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
        const preview = document.getElementById('galleryPreview');
        preview.innerHTML = '';
        
        if (this.files) {
            [...this.files].forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML += `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 100px">`;
                }
                reader.readAsDataURL(file);
            });
        }
    });

    // Handle form submission
    document.getElementById('addProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset error messages
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerHTML = '');
        document.getElementById('errorMessage').classList.add('d-none');

        const formData = new FormData(this);
        formData.append('addProduct', '1');

        fetch('pages/products/handleProduct.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product added successfully!');
                location.reload();
            } else {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, value]) => {
                        const errorElement = document.getElementById(key + 'Error');
                        if (errorElement) {
                            if (key === 'color') {
                                // Xử lý hiển thị lỗi cho Colors
                                errorElement.innerHTML = value;
                                //errorElement.classList.remove('d-none');
                            } else {
                                errorElement.innerHTML = value;
                                const inputElement = errorElement.parentElement.querySelector('input, select');
                                if (inputElement) {
                                    inputElement.classList.add('is-invalid');
                                }
                            }
                        }
                    });
                }
                if (data.message) {
                    const errorMessage = document.getElementById('errorMessage');
                    errorMessage.innerHTML = data.message;
                    errorMessage.classList.remove('d-none');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your request.');
        });
    });
</script>