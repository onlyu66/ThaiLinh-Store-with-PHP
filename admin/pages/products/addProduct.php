<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="styles/addProduct.css">
    <style>
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }
        .success-message {
            color: #16a34a;
            background-color: #dcfce7;
            border: 1px solid #bbf7d0;
            padding: 0.75rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }
        .error-alert {
            color: #dc2626;
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            padding: 0.75rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }
        .form-field {
            margin-bottom: 1rem;
        }
        .form-field label {
            display: block;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }
        .form-field input, 
        .form-field select, 
        .form-field textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
        }
        .form-field.error input,
        .form-field.error select,
        .form-field.error textarea {
            border-color: #dc2626;
        }
        .color-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        .color-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
    </style>
</head>
<body>

<?php
    // Hiển thị thông báo lỗi hoặc thành công
    if (isset($_SESSION['success'])) {
        echo '<div class="success-message">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    
    if (isset($_SESSION['errors'])) {
        if (isset($_SESSION['errors']['general'])) {
            echo '<div class="error-alert">' . $_SESSION['errors']['general'] . '</div>';
        }
    }
?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="font-bold text-base">Thêm sản phẩm</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="modal-body bg-stone-100">
                <form action="pages/products/handleProduct.php" method="post" class="formProduct" enctype="multipart/form-data">
                    
                    <!-- Category Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['category']) ? 'error' : ''; ?>">
                        <label>Category:</label>
                        <?php
                            $sqlC = "select * from categories";
                            $resultC = select($sqlC, false);
                        ?>
                        <select name="category" class="w-4/5 h-10 border border-solid border-black rounded-md">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                                foreach ($resultC as $key => $value) {
                                    $selected = (isset($_SESSION['old_data']['category']) && $_SESSION['old_data']['category'] == $value['id']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['category'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['category']; ?></span>
                        <?php endif; ?>
                
                    <!-- Brand Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['brand']) ? 'error' : ''; ?>">
                        <label>Brand:</label>
                        <?php
                            $sql = "select * from brands";
                            $result = select($sql, false);
                        ?>
                        <select name="brand" class="w-4/5 h-10 border border-solid border-black rounded-md">
                            <option value="">-- Chọn thương hiệu --</option>
                            <?php
                                foreach ($result as $key => $value) {
                                    $selected = (isset($_SESSION['old_data']['brand']) && $_SESSION['old_data']['brand'] == $value['id']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['brand']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['brand'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['brand']; ?></span>
                        <?php endif; ?>

                    <!-- Name Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['model']) ? 'error' : ''; ?>">
                        <label>Name:</label>
                        <input
                            type="text"
                            name="model"
                            value="<?php echo isset($_SESSION['old_data']['model']) ? htmlspecialchars($_SESSION['old_data']['model']) : ''; ?>"
                            placeholder="Nhập tên sản phẩm"
                        />
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['model'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['model']; ?></span>
                        <?php endif; ?>
                    
                    <!-- Version Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['version']) ? 'error' : ''; ?>">
                        <label>Version:</label>
                        <?php
                            $sqlV = "select * from versions";
                            $resultV = select($sqlV, false);
                        ?>
                        <select name="version" class="w-4/5 h-10 border border-solid border-black rounded-md">
                            <option value="">-- Chọn phiên bản --</option>
                            <?php
                                foreach ($resultV as $value) {
                                    $selected = (isset($_SESSION['old_data']['version']) && $_SESSION['old_data']['version'] == $value['id']) ? 'selected' : '';
                            ?>
                                <option class="cursor-pointer" value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['ram']."/".$value['rom']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                       
                    </div>
                    <?php if (isset($_SESSION['errors']['version'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['version']; ?></span>
                        <?php endif; ?>
                    
                    <!-- Color Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['color']) ? 'error' : ''; ?>">
                        <label class="flex-initial w-1/5">Color:</label>
                        <div class="color-grid">
                            <?php
                                $color = "select * from colors";
                                $colorIds = select($color, false);
                                $selectedColors = isset($_SESSION['old_data']['color']) ? $_SESSION['old_data']['color'] : array();
                                
                                foreach ($colorIds as $key => $colorId) {
                                    $colorClass = $colorId['colorCode'];
                                    $checked = in_array($colorId['id'], $selectedColors) ? 'checked' : '';
                            ?>
                                <div class="color-item">
                                    <input type="checkbox" name="color[]" value="<?php echo $colorId['id']; ?>" id="color_<?php echo $colorId['id']; ?>" class="cursor-pointer" <?php echo $checked; ?>/>
                                    <label class="cursor-pointer" for="color_<?php echo $colorId['id']; ?>">
                                        <i class="fa-solid fa-circle <?php echo $colorClass; ?> shadow-sm text-xl"></i>
                                    </label>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['color'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['color']; ?></span>
                        <?php endif; ?>
                    
                    <!-- Price Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['price']) ? 'error' : ''; ?>">
                        <label>Price:</label>
                        <input
                            type="number"
                            name="price"
                            value="<?php echo isset($_SESSION['old_data']['price']) ? $_SESSION['old_data']['price'] : ''; ?>"
                            placeholder="Nhập giá sản phẩm"
                            min="0"
                            step="1000"
                        />
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['price'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['price']; ?></span>
                        <?php endif; ?>
                    
                    <!-- Discount Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['discount']) ? 'error' : ''; ?>">
                        <label>Discount (%):</label>
                        <input
                            type="text"
                            name="discount"
                            value="<?php echo isset($_SESSION['old_data']['discount']) ? $_SESSION['old_data']['discount'] : ''; ?>"
                            placeholder="Nhập % giảm giá (0-100)"
                        />
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['discount'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['discount']; ?></span>
                        <?php endif; ?>
                    
                    <!-- Title Photo Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['image']) ? 'error' : ''; ?>">
                        <label>Title photo:</label>
                        <input
                            type="file"
                            name="image"
                            id="uploadImage"
                            onchange="previewImage()"
                            accept=".jpg,.jpeg,.png,.gif,.webp"
                        />
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['image'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['image']; ?></span>
                        <?php endif; ?>

                    <div class="mt-2" id="img"></div>

                    <!-- Description Photos Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['images']) ? 'error' : ''; ?>">
                        <label>Description photos:</label>
                        <input
                            type="file"
                            name="images[]"
                            id="uploadImages"
                            multiple
                            onchange="previewImages()"
                            accept=".jpg,.jpeg,.png,.gif,.webp"
                        />
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['images'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['images']; ?></span>
                        <?php endif; ?>

                    <div class="flex mt-2 flex-wrap" id="imgs"></div>

                    <!-- Quantity Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['stockQuantity']) ? 'error' : ''; ?>">
                        <label>Quantity:</label>
                        <input
                            type="number"
                            name="stockQuantity"
                            value="<?php echo isset($_SESSION['old_data']['stockQuantity']) ? $_SESSION['old_data']['stockQuantity'] : ''; ?>"
                            placeholder="Nhập số lượng"
                            min="0"
                        />
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['stockQuantity'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['stockQuantity']; ?></span>
                        <?php endif; ?>
                    
                    <!-- Description Field -->
                    <div class="form-field <?php echo isset($_SESSION['errors']['description']) ? 'error' : ''; ?>">
                        <label>Description:</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4" 
                            placeholder="Nhập mô tả sản phẩm (tối thiểu 10 ký tự)"
                        ><?php echo isset($_SESSION['old_data']['description']) ? htmlspecialchars($_SESSION['old_data']['description']) : ''; ?></textarea>
                        
                    </div>
                    <?php if (isset($_SESSION['errors']['description'])): ?>
                            <span class="error-message"><?php echo $_SESSION['errors']['description']; ?></span>
                        <?php endif; ?>
                    
                    <button type="submit" name="addProduct" class="border py-2 px-3 rounded mt-3 shadow-sm bg-zinc-100 hover:bg-zinc-50 font-semibold">
                        Add Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImages() {
        var previewContainers = document.getElementById('imgs');
        previewContainers.innerHTML = '';
        
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

    function previewImage() {
        var previewContainer = document.getElementById('img');
        previewContainer.innerHTML = '';

        var fileInput = document.getElementById('uploadImage');
        var file = fileInput.files[0];

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

    // Xóa thông báo lỗi và dữ liệu cũ sau khi hiển thị
    <?php 
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }
        if (isset($_SESSION['old_data'])) {
            unset($_SESSION['old_data']);
        }
    ?>
</script>

</body>
</html>