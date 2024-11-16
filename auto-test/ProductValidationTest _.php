<?php
/*namespace ThaiLinhStore;
use PHPUnit\Framework\TestCase;
use mysqli;

class ProductValidationTest extends TestCase 
{
    private $conn;

    protected function setUp(): void 
    {
        // Kết nối database test
        $this->conn = new mysqli('localhost', 'root', '', 'thailinhstore_test');
        
        if ($this->conn->connect_error) {
            throw new \Exception("Database connection failed: " . $this->conn->connect_error);
        }
    }

    // 1. Kiểm Tra Các Trường Bắt Buộc
    public function testEmptyRequiredFields() 
    {
        $productData = [
            'brand' => '',
            'model' => '',
            'version' => '',
            'price' => '',
            'stockQuantity' => '',
            'category' => ''
        ];

        $errors = $this->validateProductFields($productData);

        // Kiểm tra số lượng lỗi
        $this->assertCount(6, $errors, 'Phải có 6 lỗi cho các trường bắt buộc');

        // Kiểm tra từng trường lỗi
        $expectedErrorFields = ['brand', 'model', 'version', 'price', 'stockQuantity', 'category'];
        foreach ($expectedErrorFields as $field) {
            $this->assertArrayHasKey($field, $errors, "Thiếu lỗi cho trường $field");
        }
    }

    public function testIndividualEmptyFields() 
    {
        $testCases = [
            ['brand' => ''],
            ['model' => ''],
            ['version' => '']
        ];

        foreach ($testCases as $testCase) {
            $productData = $this->getValidProductData();
            $productData = array_merge($productData, $testCase);

            $errors = $this->validateProductFields($productData);

            $this->assertNotEmpty($errors, 'Phải có lỗi khi để trống trường');
            $this->assertCount(1, $errors, 'Chỉ có 1 lỗi được báo');
        }
    }

    // 2. Kiểm Tra Giá Sản Phẩm
    public function testPriceValidation() 
    {
        $testCases = [
            ['price' => -100, 'expectedValid' => false],
            ['price' => 0, 'expectedValid' => false],
            ['price' => 100, 'expectedValid' => true]
        ];

        foreach ($testCases as $case) {
            $productData = $this->getValidProductData();
            $productData['price'] = $case['price'];

            $errors = $this->validateProductFields($productData);

            if (!$case['expectedValid']) {
                $this->assertArrayHasKey('price', $errors, "Giá {$case['price']} phải báo lỗi");
            } else {
                $this->assertArrayNotHasKey('price', $errors, "Giá {$case['price']} không được báo lỗi");
            }
        }
    }

    // 3. Kiểm Tra Số Lượng Tồn Kho
    public function testStockQuantityValidation() 
    {
        $testCases = [
            ['stockQuantity' => -5, 'expectedValid' => false],
            ['stockQuantity' => 0, 'expectedValid' => true],
            ['stockQuantity' => 10, 'expectedValid' => true]
        ];

        foreach ($testCases as $case) {
            $productData = $this->getValidProductData();
            $productData['stockQuantity'] = $case['stockQuantity'];

            $errors = $this->validateProductFields($productData);

            if (!$case['expectedValid']) {
                $this->assertArrayHasKey('stockQuantity', $errors, "Số lượng {$case['stockQuantity']} phải báo lỗi");
            } else {
                $this->assertArrayNotHasKey('stockQuantity', $errors, "Số lượng {$case['stockQuantity']} không được báo lỗi");
            }
        }
    }

    // 4. Kiểm Tra Upload Ảnh Thumbnail
    public function testThumbnailUpload() 
    {
        $testCases = [
            ['file' => null, 'expectedValid' => false],
            ['file' => $this->createMockImageFile('valid.jpg', 'image/jpeg', 1024 * 1024), 'expectedValid' => true],
            ['file' => $this->createMockImageFile('large.jpg', 'image/jpeg', 6 * 1024 * 1024), 'expectedValid' => false],
            ['file' => $this->createMockImageFile('invalid.txt', 'text/plain', 1024), 'expectedValid' => false]
        ];

        foreach ($testCases as $case) {
            $productData = $this->getValidProductData();
            $productData['image'] = $case['file'];

            $errors = $this->validateImageUpload($productData);

            if (!$case['expectedValid']) {
                $this->assertNotEmpty($errors, 'Ảnh không hợp lệ phải báo lỗi');
            } else {
                $this->assertEmpty($errors, 'Ảnh hợp lệ không được báo lỗi');
            }
        }
    }

    // 5. Kiểm Tra Ảnh Gallery
    public function testGalleryImagesUpload() 
    {
        $testCases = [
            ['files' => [], 'expectedValid' => false],
            ['files' => [$this->createMockImageFile('img1.jpg', 'image/jpeg', 1024 * 1024)], 'expectedValid' => true],
            ['files' => array_fill(0, 6, $this->createMockImageFile('img.jpg', 'image/jpeg', 1024 * 1024)), 'expectedValid' => true],
            ['files' => array_fill(0, 7, $this->createMockImageFile('img.jpg', 'image/jpeg', 1024 * 1024)), 'expectedValid' => false]
        ];

        foreach ($testCases as $case) {
            $productData = $this->getValidProductData();
            $productData['images'] = $case['files'];

            $errors = $this->validateGalleryUpload($productData);

            if (!$case['expectedValid']) {
                $this->assertNotEmpty($errors, 'Ảnh gallery không hợp lệ phải báo lỗi');
            } else {
                $this->assertEmpty($errors, 'Ảnh gallery hợp lệ không được báo lỗi');
            }
        }
    }

    // 6. Kiểm Tra Màu Sắc
    public function testColorSelection() 
    {
        $testCases = [
            ['colors' => [], 'expectedValid' => false],
            ['colors' => ['red'], 'expectedValid' => true],
            ['colors' => array_fill(0, 6, 'color'), 'expectedValid' => true],
            ['colors' => array_fill(0, 7, 'color'), 'expectedValid' => false]
        ];

        foreach ($testCases as $case) {
            $productData = $this->getValidProductData();
            $productData['color'] = $case['colors'];

            $errors = $this->validateColorSelection($productData);

            if (!$case['expectedValid']) {
                $this->assertNotEmpty($errors, 'Lựa chọn màu không hợp lệ phải báo lỗi');
            } else {
                $this->assertEmpty($errors, 'Lựa chọn màu hợp lệ không được báo lỗi');
            }
        }
    }

    // 7. Kiểm Tra Quy Trình Hoàn Chỉnh
    public function testCompleteProductAddProcess() 
    {
        $productData = $this->getValidProductData();
        $productData['image'] = $this->createMockImageFile('thumbnail.jpg', 'image/jpeg', 1024 * 1024);
        $productData['images'] = [
            $this->createMockImageFile('gallery1.jpg', 'image/jpeg', 1024 * 1024),
            $this->createMockImageFile('gallery2.jpg', 'image/jpeg', 1024 * 1024)
        ];

        // Validate
        $fieldErrors = $this->validateProductFields($productData);
        $imageErrors = $this->validateImageUpload($productData);
        $galleryErrors = $this->validateGalleryUpload($productData);
        $colorErrors = $this->validateColorSelection($productData);

        // Kiểm tra không có lỗi
        $this->assertEmpty($fieldErrors, 'Không được có lỗi ở các trường');
        $this->assertEmpty($imageErrors, 'Không được có lỗi ở ảnh thumbnail');
        $this->assertEmpty($galleryErrors, 'Không được có lỗi ở ảnh gallery');
        $this->assertEmpty($colorErrors, 'Không được có lỗi ở màu sắc');

        // Thử thêm sản phẩm
        $result = $this->addProduct($productData);
        $this->assertTrue($result, 'Thêm sản phẩm thất bại');
    }

    // Các phương thức hỗ trợ validation
    private function validateProductFields(array $data): array 
    {
        $errors = [];

        $requiredFields = ['brand', 'model', 'version', 'price', 'stockQuantity', 'category'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst($field) . ' là bắt buộc';
            }
        }

        // Validate giá
        if (!empty($data['price']) && ($data['price'] <= 0)) {
            $errors['price'] = 'Giá phải là số dương';
        }

        // Validate số lượng
        if (!empty($data['stockQuantity']) && ($data['stockQuantity'] < 0)) {
            $errors['stockQuantity'] = 'Số lượng không được âm';
        }

        return $errors;
    }

    private function validateImageUpload(array $data): array 
    {
        $errors = [];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (empty($data['image'])) {
            $errors['image'] = 'Ảnh thumbnail là bắt buộc';
        } else {
            $file = $data['image'];
            if (!in_array($file['type'], $allowedTypes)) {
                $errors['image'] = 'Định dạng ảnh không hợp lệ';
            }
            if ($file['size'] > $maxFileSize) {
                $errors['image'] = 'Kích thước ảnh quá lớn';
            }
        }

        return $errors;
    }

    private function validateGalleryUpload(array $data): array 
    {
        $errors = [];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $maxFiles = 5;

        if (empty($data['images'])) {
            $errors['images'] = 'Ảnh gallery là bắt buộc';
        } else {
            if (count($data['images']) > $maxFiles) {
                $errors['images'] = "Tối đa $maxFiles ảnh được phép";
            }

            foreach ($data['images'] as $file) {
                if (!in_array($file['type'], $allowedTypes)) {
                    $errors['images'] = 'Định dạng ảnh không hợp lệ';
                    break;
                }
                if ($file['size'] > $maxFileSize) {
                    $errors['images'] = 'Kích thước ảnh quá lớn';
                    break;
                }
            }
        }

        return $errors;
    }

    private function validateColorSelection(array $data): array 
    {
        $errors = [];
        $maxColors = 6;

        if (empty($data['color'])) {
            $errors['color'] = 'Phải chọn ít nhất 1 màu';
        } elseif (count($data['color']) > $maxColors) {
            $errors['color'] = "Tối đa $maxColors màu được phép";
        }

        return $errors;
    }

    // Phương thức hỗ trợ thêm sản phẩm (mock)
    private function addProduct(array $data): bool 
    {
        // Logic thêm sản phẩm thực tế
        return true;
    }

    // Tạo dữ liệu sản phẩm mặc định hợp lệ
    private function getValidProductData(): array 
    {
        return [
            'brand' => 'Test Brand',
            'model' => 'Test Model',
            'version' => '1.0',
            'price' => 100,
            'stockQuantity' => 10,
            'category' => 1,
            'color' => ['red']
        ];
    }

    // Tạo file ảnh mock
    private function createMockImageFile(string $name, string $type, int $size): array 
    {
        return [
            'name' => $name,
            'type' => $type,
            'tmp_name' => tempnam(sys_get_temp_dir(), 'test_'),
            'error' => 0,
            'size' => $size
        ];
    }

    protected function tearDown(): void 
    {
        $this->conn->close();
    }
}*/