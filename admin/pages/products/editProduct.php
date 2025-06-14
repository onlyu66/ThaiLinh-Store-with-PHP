<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel="stylesheet" href="./styles/addProduct.css">
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
        .image-preview {
            max-width: 25%;
            max-height: 100px;
            padding: 0.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin: 0.25rem;
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

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <p class="font-bold text-base">Chỉnh sửa thông tin sản phẩm</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div class="modal-body bg-stone-100">
            <form action="pages/products/handleProduct.php?id=<?php echo $_POST['id']; ?>" method="post" class="formProduct" enctype="multipart/form-data">
                <?php
                    include_once "../../../untils/utility.php";
                    include_once "../../../database/config.php";
                    include_once "../../../database/dbhelper.php";
                    $id = $_POST['id'];
                    $editSql = "SELECT * FROM products WHERE id='$id'";
                    $queryEdit = mysqli_query($conn, $editSql);

                    $imagesSql = "select * from galleries where productId='$id'";
                    $images = select($imagesSql, false);
                    $rowE = mysqli_fetch_assoc($queryEdit);
                ?>
                
                <input type="hidden" name="imgValue" value="<?php echo $rowE['thumbnail']; ?>">
                
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
                                $selected = ($rowE['categoryId'] == $value['id']) ? 'selected' : '';
                                // Nếu có lỗi validation, ưu tiên giá trị từ session
                                if (isset($_SESSION['old_data']['category']) && $_SESSION['old_data']['category'] == $value['id']) {
                                    $selected = 'selected';
                                }
                        ?>
                            <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <?php if (isset($_SESSION['errors']['category'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['category']; ?></span>
                    <?php endif; ?>
                </div>
                
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
                                $selected = ($rowE['brandId'] == $value['id']) ? 'selected' : '';
                                // Nếu có lỗi validation, ưu tiên giá trị từ session
                                if (isset($_SESSION['old_data']['brand']) && $_SESSION['old_data']['brand'] == $value['id']) {
                                    $selected = 'selected';
                                }
                        ?>
                            <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['brand']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <?php if (isset($_SESSION['errors']['brand'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['brand']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Name Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['model']) ? 'error' : ''; ?>">
                    <label>Name:</label>
                    <input
                        type="text"
                        name="model"
                        value="<?php echo isset($_SESSION['old_data']['model']) ? htmlspecialchars($_SESSION['old_data']['model']) : htmlspecialchars($rowE['model']); ?>"
                        placeholder="Nhập tên sản phẩm"
                    />
                    <?php if (isset($_SESSION['errors']['model'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['model']; ?></span>
                    <?php endif; ?>
                </div>

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
                                $selected = ($rowE['versionId'] == $value['id']) ? 'selected' : '';
                                // Nếu có lỗi validation, ưu tiên giá trị từ session
                                if (isset($_SESSION['old_data']['version']) && $_SESSION['old_data']['version'] == $value['id']) {
                                    $selected = 'selected';
                                }
                        ?>
                            <option class="cursor-pointer" value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['ram']."/".$value['rom']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <?php if (isset($_SESSION['errors']['version'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['version']; ?></span>
                    <?php endif; ?>
                </div>
                
                <!-- Color Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['color']) ? 'error' : ''; ?>">
                    <label class="flex-initial w-1/5">Color:</label>
                    <div class="color-grid">
                        <?php
                            // Xử lý màu đã chọn
                            $selectedColors = array();
                            if (isset($_SESSION['old_data']['color'])) {
                                // Nếu có lỗi validation, lấy từ session
                                $selectedColors = $_SESSION['old_data']['color'];
                            } elseif (isset($rowE['colors'])) {
                                // Nếu không có lỗi, lấy từ database
                                $selectedColors = json_decode($rowE['colors']);
                            }
                            
                            $color = "select * from colors";
                            $colorIds = select($color, false);
                            
                            foreach ($colorIds as $key => $colorId) {
                                $checked = in_array($colorId['id'], $selectedColors) ? 'checked' : '';
                                $colorClass = $colorId['colorCode'];
                        ?>
                            <div class="color-item">
                                <input type="checkbox" name="color[]" value="<?php echo $colorId['id']; ?>" id="ecolor_<?php echo $colorId['id']; ?>" class="cursor-pointer" <?php echo $checked; ?>/>
                                <label class="cursor-pointer" for="ecolor_<?php echo $colorId['id']; ?>">
                                    <i class="fa-solid fa-circle <?php echo $colorClass; ?> shadow-sm text-xl"></i>
                                </label>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                    <?php if (isset($_SESSION['errors']['color'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['color']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Price Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['price']) ? 'error' : ''; ?>">
                    <label>Price:</label>
                    <input
                        type="number"
                        name="price"
                        value="<?php echo isset($_SESSION['old_data']['price']) ? $_SESSION['old_data']['price'] : $rowE['price']; ?>"
                        placeholder="Nhập giá sản phẩm"
                        min="0"
                        step="1000"
                    />
                    <?php if (isset($_SESSION['errors']['price'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['price']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Discount Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['discount']) ? 'error' : ''; ?>">
                    <label>Discount (%):</label>
                    <input
                        type="text"
                        name="discount"
                        value="<?php echo isset($_SESSION['old_data']['discount']) ? $_SESSION['old_data']['discount'] : ($rowE['discount']*100).'%'; ?>"
                        placeholder="Nhập % giảm giá (0-100)"
                    />
                    <?php if (isset($_SESSION['errors']['discount'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['discount']; ?></span>
                    <?php endif; ?>
                </div>
                
                <!-- Title Photo Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['image']) ? 'error' : ''; ?>">
                    <label>Title photo:</label>
                    <input
                        type="file"
                        name="image"
                        id="imageInput"
                        accept=".jpg,.jpeg,.png,.gif,.webp"
                    />
                    <?php if (isset($_SESSION['errors']['image'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['image']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-2">
                    <img src=".<?php echo $rowE['thumbnail']; ?>" class="image-preview" id="previewImage" alt="Current thumbnail" onclick="document.getElementById('imageInput').click();">
                </div>

                <!-- Description Photos Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['images']) ? 'error' : ''; ?>">
                    <label>Description photos:</label>
                    <input
                        type="file"
                        name="images[]"
                        id="imagesInput"
                        multiple
                        accept=".jpg,.jpeg,.png,.gif,.webp"
                    />
                    <?php if (isset($_SESSION['errors']['images'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['images']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-2 flex-wrap" id="imagesDiv">
                    <?php
                        foreach($images as $image) {
                    ?>
                        <img src=".<?php echo $image['thumbnail']; ?>" class="image-preview" alt="Gallery image">
                    <?php
                        }
                    ?>
                </div>

                <!-- Quantity Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['stockQuantity']) ? 'error' : ''; ?>">
                    <label>Quantity:</label>
                    <input
                        type="number"
                        name="stockQuantity"
                        value="<?php echo isset($_SESSION['old_data']['stockQuantity']) ? $_SESSION['old_data']['stockQuantity'] : $rowE['stockQuantity']; ?>"
                        placeholder="Nhập số lượng"
                        min="0"
                    />
                    <?php if (isset($_SESSION['errors']['stockQuantity'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['stockQuantity']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Description Field -->
                <div class="form-field <?php echo isset($_SESSION['errors']['description']) ? 'error' : ''; ?>">
                    <label>Description:</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4" 
                        placeholder="Nhập mô tả sản phẩm (tối thiểu 10 ký tự)"
                    ><?php echo isset($_SESSION['old_data']['description']) ? htmlspecialchars($_SESSION['old_data']['description']) : htmlspecialchars($rowE['description']); ?></textarea>
                    <?php if (isset($_SESSION['errors']['description'])): ?>
                        <span class="error-message"><?php echo $_SESSION['errors']['description']; ?></span>
                    <?php endif; ?>
                </div>
                
                <button type="submit" name="editProduct" class="border py-2 px-3 rounded mt-3 shadow-sm bg-zinc-100 hover:bg-zinc-50 font-semibold">
                    Update Product
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('previewImage').src = e.target.result;
            };

            reader.readAsDataURL(this.files[0]);
        }
    });

    document.getElementById('imagesInput').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var previewContainers = document.getElementById('imagesDiv');
            previewContainers.innerHTML = '';
            var files = document.getElementById('imagesInput').files;
            
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'image-preview';
                    previewContainers.appendChild(img);
                };

                reader.readAsDataURL(files[i]);
            }
        }
    });

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