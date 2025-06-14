<?php
namespace ThaiLinhStore\AddProductTesting;

class ProductValidator 
{
    // Các hằng số validation
    private const REQUIRED_FIELDS = [
        'brand', 'model', 'version',
        'price', 'stockQuantity', 'category'
    ];
    
    private const MAX_PRICE = 1_000_000;
    private const MIN_PRICE = 0;
    private const MAX_STOCK = 10_000;
    private const MAX_COLORS = 6;
    private const MAX_GALLERY_IMAGES = 5;

    /**
     * Validate các trường bắt buộc
     *
     * @param array $data Dữ liệu đầu vào
     * @return array Mảng các lỗi
     */
    public function validateRequiredFields(array $data): array 
    {
        $errors = [];

        foreach (self::REQUIRED_FIELDS as $field) {
            // Loại bỏ các ký tự đặc biệt và khoảng trắng
            $value = $data[$field] ?? '';
            $cleanValue = strip_tags(trim($value));

            if (empty($cleanValue)) {
                $errors[$field] = sprintf('%s là bắt buộc', ucfirst($field));
            }
        }

        return $errors;
    }

    /**
     * Validate giá sản phẩm
     *
     * @param mixed $price Giá sản phẩm
     * @return string|null Thông báo lỗi nếu có
     */
    public function validatePrice($price): ?string 
    {
        // Loại bỏ các ký tự không phải số
        $price = filter_var(
            $price, 
            FILTER_SANITIZE_NUMBER_FLOAT, 
            FILTER_FLAG_ALLOW_FRACTION
        );

        if (!is_numeric($price)) {
            return "Giá phải là số";
        }

        $price = floatval($price);

        return match(true) {
            $price <= self::MIN_PRICE => "Giá phải là số dương",
            $price > self::MAX_PRICE => "Giá vượt quá giới hạn cho phép",
            default => null
        };
    }

    /**
     * Validate số lượng tồn kho
     *
     * @param mixed $quantity Số lượng
     * @return string|null Thông báo lỗi nếu có
     */
    public function validateStockQuantity($quantity): ?string 
    {
        // Loại bỏ các ký tự không phải số
        $quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

        if (!is_numeric($quantity)) {
            return "Số lượng phải là số";
        }

        $quantity = intval($quantity);

        return match(true) {
            $quantity < 0 => "Số lượng không được âm",
            $quantity > self::MAX_STOCK => "Số lượng vượt quá giới hạn",
            default => null
        };
    }

    /**
     * Validate màu sắc
     *
     * @param array $colors Mảng màu
     * @return string|null Thông báo lỗi nếu có
     */
    public function validateColors(array $colors): ?string 
    {
        return match(true) {
            empty($colors) => "Phải chọn ít nhất một màu",
            count($colors) > self::MAX_COLORS => 
                "Tối đa " . self::MAX_COLORS . " màu được phép",
            default => null
        };
    }

    /**
     * Validate ảnh thumbnail
     *
     * @param array $file Thông tin file ảnh
     * @return string|null Thông báo lỗi nếu có
     */
    public function validateThumbnail($file): ?string 
    {
        // Kiểm tra file upload
        if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return "Ảnh thumbnail là bắt buộc";
        }

        $allowedTypes = [
            'image/jpeg', 
            'image/png', 
            'image/gif', 
            'image/webp'
        ];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        // Kiểm tra loại file
        if (!in_array($file['type'], $allowedTypes)) {
            return "Định dạng ảnh không hợp lệ";
        }

        // Kiểm tra kích thước file
        if ($file['size'] > $maxFileSize) {
            return "Kích thước ảnh vượt quá 5MB";
        }

        // Kiểm tra file có phải là ảnh thực sự không
        $imageInfo = @getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            return "File không phải là ảnh hợp lệ";
        }

        return null;
    }

    /**
     * Validate ảnh gallery
     *
     * @param array $files Mảng các file ảnh
     * @return string|null Thông báo lỗi nếu có
     */
    public function validateGalleryImages(array $files): ?string 
    {
        $allowedTypes = [
            'image/jpeg', 
            'image/png', 
            'image/gif', 
            'image/webp'
        ];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        // Kiểm tra gallery rỗng
        if (empty($files[0]['name'])) {
            return "Ảnh gallery là bắt buộc";
        }

        // Kiểm tra số lượng ảnh
        if (count($files) > self::MAX_GALLERY_IMAGES) {
            return "Tối đa " . self::MAX_GALLERY_IMAGES . " ảnh gallery được phép";
        }

        // Kiểm tra từng ảnh
        foreach ($files as $file) {
            // Kiểm tra lỗi upload
            if ($file['error'] !== UPLOAD_ERR_OK) {
                return "Lỗi upload ảnh";
            }

            // Kiểm tra loại file
            if (!in_array($file['type'], $allowedTypes)) {
                return "Định dạng ảnh gallery không hợp lệ";
            }

            // Kiểm tra kích thước file
            if ($file['size'] > $maxFileSize) {
                return "Kích thước ảnh gallery vượt quá 5MB";
            }

            // Kiểm tra file có phải là ảnh thực sự không
            $imageInfo = @getimagesize($file['tmp_name']);
            if ($imageInfo === false) {
                return "File gallery không phải là ảnh hợp lệ";
            }
        }

        return null;
    }

    /**
     * Validate toàn bộ sản phẩm
     *
     * @param array $data Dữ liệu sản phẩm
     * @param array $thumbnailFile File thumbnail
     * @param array $galleryFiles Mảng file gallery
     * @return array Mảng các lỗi
     */
    public function validateProduct(
        array $data, 
        array $thumbnailFile, 
        array $galleryFiles
    ): array {
        $errors = [];

        // Validate các trường bắt buộc
        $requiredFieldErrors = $this->validateRequiredFields($data);
        $errors = array_merge($errors, $requiredFieldErrors);

        // Validate giá
        $priceError = $this->validatePrice($data['price'] ?? null);
        if ($priceError) {
            $errors['price'] = $priceError;
        }

        // Validate số lượng tồn kho
        $stockError = $this->validateStockQuantity($data['stockQuantity'] ?? null);
        if ($stockError) {
            $errors['stockQuantity'] = $stockError;
        }

        // Validate màu sắc
        $colorError = $this->validateColors($data['color'] ?? []);
        if ($colorError) {
            $errors['color'] = $colorError;
        }

        // Validate thumbnail
        $thumbnailError = $this->validateThumbnail($thumbnailFile);
        if ($thumbnailError) {
            $errors['image'] = $thumbnailError;
        }

        // Validate gallery images
        $galleryError = $this->validateGalleryImages($galleryFiles);
        if ($galleryError) {
            $errors['images'] = $galleryError;
        }

        return $errors;
    }

    /**
     * Validate nhánh sản phẩm
     *
     * @param array $branches Mảng các nhánh
     * @return string|null Thông báo lỗi nếu có
     */
    public function validateBranches(array $branches): ?string 
    {
        // Loại bỏ các nhánh trùng lặp và không hợp lệ
        $cleanBranches = array_filter(
            array_unique(
                array_map(function($branch) {
                    return strip_tags(trim($branch['name'] ?? ''));
                }, $branches)
            )
        );

        // Kiểm tra số lượng nhánh
        $maxBranches = 6; // Số nhánh tối đa

        return match(true) {
            empty($cleanBranches) => "Phải chọn ít nhất một nhánh",
            count($cleanBranches) > $maxBranches => 
                "Tối đa $maxBranches nhánh được phép",
            default => null
        };
    }

    /**
     * Validate toàn bộ sản phẩm bao gồm nhánh
     *
     * @param array $data Dữ liệu sản phẩm
     * @param array $thumbnailFile File thumbnail
     * @param array $galleryFiles Mảng file gallery
     * @param array $branches Mảng các nhánh
     * @return array Mảng các lỗi
     */
    public function validateProductWithBranches(
        array $data, 
        array $thumbnailFile, 
        array $galleryFiles,
        array $branches = []
    ): array {
        // Validate sản phẩm cơ bản
        $errors = $this->validateProduct($data, $thumbnailFile, $galleryFiles);

        // Validate nhánh nếu có
        if (!empty($branches)) {
            $branchValidationError = $this->validateBranches($branches);
            if ($branchValidationError) {
                $errors['branches'] = $branchValidationError;
            }

            // Validate chi tiết từng nhánh
            $branchDetailErrors = $this->validateBranchDetails($branches);
            if (!empty($branchDetailErrors)) {
                $errors = array_merge($errors, $branchDetailErrors);
            }
        }

        return $errors;
    }

    /**
     * Validate thông tin chi tiết các nhánh
     *
     * @param array $branches Mảng các nhánh
     * @return array Mảng các lỗi
     */
    public function validateBranchDetails(array $branches): array 
    {
        $branchErrors = [];

        foreach ($branches as $index => $branch) {
            // Validate tên nhánh
            if (empty(trim($branch['name'] ?? ''))) {
                $branchErrors["branch_{$index}_name"] = "Tên nhánh là bắt buộc";
            }

            // Validate mã nhánh (nếu cần)
            if (empty(trim($branch['code'] ?? ''))) {
                $branchErrors["branch_{$index}_code"] = "Mã nhánh là bắt buộc";
            }
        }

        return $branchErrors;
    }
}