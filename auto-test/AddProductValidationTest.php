<?php
namespace ThaiLinhStore;

use mysqli;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use ThaiLinhStore\AddProductTesting\BranchCoverageReporter;
use ThaiLinhStore\AddProductTesting\ProductValidator;
use ThaiLinhStore\AddProductTesting\ControlFlowGraphGenerator;

class AddProductValidationTest extends TestCase 
{
    private $conn;
    private $validator;
    private $faker;
    private $controlFlowGraph;
    private $branchCoverageReporter;

    protected function setUp(): void {
        // Khởi tạo control flow graph
        $this->controlFlowGraph = new ControlFlowGraphGenerator();
        $this->setupControlFlowGraph();

        // Khởi tạo branch coverage reporter
        $this->branchCoverageReporter = new BranchCoverageReporter();
        $this->setupBranchCoverage();
        $this->validator = new ProductValidator();
        $this->faker = Factory::create();

        // Kết nối database test
        $this->conn = new mysqli('localhost', 'root', '', 'thailinhstore_test');
        
        if ($this->conn->connect_error) {
            throw new \Exception("Database connection failed: " . $this->conn->connect_error);
        }
    }

    private function setupControlFlowGraph() {
        // Định nghĩa các node
        $this->controlFlowGraph->addNode('start', 'Bắt đầu');
        $this->controlFlowGraph->addNode('validate_required', 'Validate trường bắt buộc');
        $this->controlFlowGraph->addNode('validate_price', 'Validate giá');
        $this->controlFlowGraph->addNode('validate_stock', 'Validate số lượng');
        $this->controlFlowGraph->addNode('validate_thumbnail', 'Validate thumbnail');
        $this->controlFlowGraph->addNode('validate_gallery', 'Validate gallery');
        $this->controlFlowGraph->addNode('validate_colors', 'Validate màu');
        $this->controlFlowGraph->addNode('insert_product', 'Thêm sản phẩm');
        $this->controlFlowGraph->addNode('end', 'Kết thúc');
        $this->controlFlowGraph->addNode('error', 'Xử lý lỗi');

        // Định nghĩa các cạnh chi tiết
        $this->controlFlowGraph->addEdge('start', 'validate_required');
        
        // Luồng validate trường bắt buộc
        $this->controlFlowGraph->addEdge('validate_required', 'validate_price', 'Hợp lệ');
        $this->controlFlowGraph->addEdge('validate_required', 'error', 'Không hợp lệ');
        
        // Luồng validate giá
        $this->controlFlowGraph->addEdge('validate_price', 'validate_stock', 'Hợp lệ');
        $this->controlFlowGraph->addEdge('validate_price', 'error', 'Không hợp lệ');
        
        // Luồng validate số lượng
        $this->controlFlowGraph->addEdge('validate_stock', 'validate_colors', 'Hợp lệ');
        $this->controlFlowGraph->addEdge('validate_stock', 'error', 'Không hợp lệ');
        
        // Luồng validate màu
        $this->controlFlowGraph->addEdge('validate_colors', 'validate_thumbnail', 'Hợp lệ');
        $this->controlFlowGraph->addEdge('validate_colors', 'error', 'Không hợp lệ');
        
        // Luồng validate thumbnail
        $this->controlFlowGraph->addEdge('validate_thumbnail', 'validate_gallery', 'Hợp lệ');
        $this->controlFlowGraph->addEdge('validate_thumbnail', 'error', 'Không hợp lệ');
        
        // Luồng validate gallery
        $this->controlFlowGraph->addEdge('validate_gallery', 'validate_branches', 'Hợp lệ');
        $this->controlFlowGraph->addEdge('validate_gallery', 'error', 'Không hợp lệ');
        
        // Luồng kết thúc
        $this->controlFlowGraph->addEdge('insert_product', 'end', 'Thành công');
        $this->controlFlowGraph->addEdge('error', 'end', 'Kết thúc với lỗi');
    }

    private function setupBranchCoverage() {
        // Đăng ký các nhánh cần kiểm tra
        $branches = [
            'validate_required_success',
            'validate_required_fail',
            'validate_price_success',
            'validate_price_fail',
            'validate_stock_success',
            'validate_stock_fail',
            'validate_thumbnail_success',
            'validate_thumbnail_fail',
            'validate_gallery_success',
            'validate_gallery_fail',
            'validate_colors_success',
            'validate_colors_fail'
        ];

        foreach ($branches as $branch) {
            $this->branchCoverageReporter->addTotalBranch($branch);
        }
    }

    // 1. Kiểm Tra Các Trường Bắt Buộc
    public function testEmptyRequiredFields() 
    {
        // Dữ liệu để trống tất cả các trường
        $productData = [
            'brand' => '',
            'model' => '',
            'version' => '',
            'price' => '',
            'stockQuantity' => '',
            'category' => ''
        ];

        $thumbnailFile = $this->createEmptyImageFile();
        $galleryFiles = [];

        // Validate
        $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

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
            // Tạo dữ liệu hợp lệ
            $productData = $this->createValidProductData();
            
            // Ghi đè trường cần test
            $productData = array_merge($productData, $testCase);

            $thumbnailFile = $this->createValidImageFile();
            $galleryFiles = $this->createValidGalleryFiles();

            // Validate
            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

            // Kiểm tra có lỗi
            $this->assertNotEmpty($errors, 'Phải có lỗi khi để trống trường');
            $this->assertCount(1, $errors, 'Chỉ có 1 lỗi được báo');
        }
    }

    // 2. Kiểm Tra Giá Sản Phẩm
    public function testPriceValidation() 
    {
        $testCases = [
            ['price' => -100, 'expectedValid' => false, 'expectedErrorMessage' => 'Giá phải là số dương'],
            ['price' => 0, 'expectedValid' => false, 'expectedErrorMessage' => 'Giá phải là số dương'],
            ['price' => 100, 'expectedValid' => true, 'expectedErrorMessage' => null]
        ];

        foreach ($testCases as $case) {
            $productData = $this->createValidProductData();
            $productData['price'] = $case['price'];

            $thumbnailFile = $this->createValidImageFile();
            $galleryFiles = $this->createValidGalleryFiles();

            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

            if (!$case['expectedValid']) {
                $this->assertArrayHasKey('price', $errors, "Giá {$case['price']} phải báo lỗi");
                $this->assertEquals(
                    $case['expectedErrorMessage'], 
                    $errors['price'], 
                    "Thông báo lỗi không đúng"
                );
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
            $productData = $this->createValidProductData();
            $productData['stockQuantity'] = $case['stockQuantity'];

            $thumbnailFile = $this->createValidImageFile();
            $galleryFiles = $this->createValidGalleryFiles();

            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

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
            ['file' => $this->createEmptyImageFile(), 'expectedValid' => false],
            ['file' => $this->createInvalidImageFile(), 'expectedValid' => false],
            ['file' => $this->createOversizedImageFile(), 'expectedValid' => false],
            ['file' => $this->createValidImageFile(), 'expectedValid' => true]
        ];

        foreach ($testCases as $case) {
            $productData = $this->createValidProductData();
            $thumbnailFile = $case['file'];
            $galleryFiles = $this->createValidGalleryFiles();

            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

            if (!$case['expectedValid']) {
                $this->assertArrayHasKey('image', $errors, 'Ảnh không hợp lệ phải báo lỗi');
            } else {
                $this->assertArrayNotHasKey('image', $errors, 'Ảnh hợp lệ không được báo lỗi');
            }
        }
    }

    // 5. Kiểm Tra Ảnh Gallery
    public function testGalleryImagesUpload() 
    {
        $testCases = [
            ['files' => [], 'expectedValid' => false],
            ['files' => [$this->createValidImageFile()], 'expectedValid' => true],
            ['files' => $this->createValidGalleryFiles(6), 'expectedValid' => true],
            ['files' => $this->createValidGalleryFiles(7), 'expectedValid' => false]
        ];

        foreach ($testCases as $case) {
            $productData = $this->createValidProductData();
            $thumbnailFile = $this->createValidImageFile();
            $galleryFiles = $case['files'];

            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

            if (!$case['expectedValid']) {
                $this->assertArrayHasKey('images', $errors, 'Ảnh gallery không hợp lệ phải báo lỗi');
            } else {
                $this->assertArrayNotHasKey('images', $errors, 'Ảnh gallery hợp lệ không được báo lỗi');
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
            $productData = $this->createValidProductData();
            $productData['color'] = $case['colors'];

            $thumbnailFile = $this->createValidImageFile();
            $galleryFiles = $this->createValidGalleryFiles();

            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

            if (!$case['expectedValid']) {
                $this->assertArrayHasKey('color', $errors, 'Lựa chọn màu không hợp lệ phải báo lỗi');
            } else {
                $this->assertArrayNotHasKey('color', $errors, 'Lựa chọn màu hợp lệ không được báo lỗi');
            }
        }
    }

    // 7. Kiểm Tra Quy Trình Hoàn Chỉnh
    public function testCompleteProductAddProcess() 
    {
        $productData = $this->createValidProductData();
        $thumbnailFile = $this->createValidImageFile();
        $galleryFiles = $this->createValidGalleryFiles();

        // Validate
        $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

        // Kiểm tra không có lỗi
        $this->assertEmpty($errors, 'Dữ liệu hợp lệ không được báo lỗi');
    }

    // Các phương thức hỗ trợ tạo dữ liệu
    private function createValidProductData(): array 
    {
        return [
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'version' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stockQuantity' => $this->faker->numberBetween(1, 100),
            'category' => $this->faker->numberBetween(1, 10),
            'color' => $this->faker->randomElements(['red', 'blue', 'green', 'yellow'], 2)
        ];
    }

    // Các phương thức hỗ trợ tạo file ảnh
    private function createValidImageFile(): array 
    {
        return $this->createMockImageFile([
            'type' => 'image/jpeg',
            'size' => 1024 * 1024 // 1MB
        ]);
    }

    private function createEmptyImageFile(): array 
    {
        return [
            'name' => '',
            'type' => '',
            'tmp_name' => '',
            'error' => UPLOAD_ERR_NO_FILE,
            'size' => 0
        ];
    }

    private function createInvalidImageFile(): array 
    {
        return $this->createMockImageFile([
            'type' => 'text/plain'
        ]);
    }

    private function createOversizedImageFile(): array 
    {
        return $this->createMockImageFile([
            'type' => 'image/jpeg',
            'size' => 6 * 1024 * 1024 // 6MB
        ]);
    }

    private function createValidGalleryFiles(int $count = 2): array 
    {
        $files = [];
        for ($i = 0; $i < $count; $i++) {
            $files[] = $this->createValidImageFile();
        }
        return $files;
    }

    private function createMockImageFile(array $overrides = []): array 
    {
        $defaultFile = [
            'name' => 'test_image.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => tempnam(sys_get_temp_dir(), 'test_'),
            'error' => UPLOAD_ERR_OK,
            'size' => 1024 * 1024 // 1MB
        ];

        return array_merge($defaultFile, $overrides);
    }

    protected function tearDown(): void {
         // Sinh control flow graph
    $graphFile = $this->controlFlowGraph->renderGraph('product_add_flow.png');
    
    // Sinh báo cáo bao phủ
    $branchCoverageReport = $this->branchCoverageReporter->generateReport();
    
    // Sinh báo cáo chi tiết
    $detailedReport = $this->generateDetailedTestReport(
        $graphFile, 
        $branchCoverageReport
    );
    
    // Lưu báo cáo
    $this->saveTestReport($detailedReport);
    
    // Đóng kết nối
    $this->conn->close();
    }
     /**
 * Sinh báo cáo chi tiết của test
 */
private function generateDetailedTestReport(
    string $controlFlowGraphFile, 
    string $branchCoverageReport
): string {
    $reportContent = "Test Execution Report\n";
    $reportContent .= "====================\n\n";
    
    // Thông tin thời gian
    $reportContent .= "Timestamp: " . date('Y-m-d H:i:s') . "\n";
    $reportContent .= "Test Class: " . get_class($this) . "\n\n";
    
    // Thêm Control Flow Graph
    $reportContent .= "Control Flow Graph\n";
    $reportContent .= "------------------\n";
    $reportContent .= "File: $controlFlowGraphFile\n\n";
    
    // Thêm Branch Coverage Report
    $reportContent .= "Branch Coverage Report\n";
    $reportContent .= "---------------------\n";
    $reportContent .= $branchCoverageReport . "\n";
    
    // Các thông tin bổ sung có thể được thêm vào đây
    $reportContent .= "Additional Metrics\n";
    $reportContent .= "------------------\n";
    $reportContent .= $this->collectAdditionalMetrics();
    
    return $reportContent;
}

/**
 * Lưu báo cáo test
 */
private function saveTestReport(string $reportContent): void 
{
    // Tạo thư mục báo cáo nếu chưa tồn tại
    $reportDir = __DIR__ . '/../../reports/test_reports';
    if (!file_exists($reportDir)) {
        mkdir($reportDir, 0777, true);
    }
    
    // Tạo tên file duy nhất
    $reportFile = $reportDir . '/test_report_' . date('Y-m-d_H-i-s') . '.txt';
    
    // Lưu báo cáo
    file_put_contents($reportFile, $reportContent);
    
    // In đường dẫn báo cáo
    echo "Báo cáo test đã được lưu tại: $reportFile\n";
}

/**
 * Thu thập các số liệu bổ sung
 */
private function collectAdditionalMetrics(): string 
{
    $metrics = "";
    
    // Thời gian thực thi
    $metrics .= "Execution Time: " . (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) . " giây\n";
    
    // Bộ nhớ sử dụng
    $metrics .= "Memory Peak Usage: " . memory_get_peak_usage(true) / 1024 / 1024 . " MB\n";
    
    return $metrics;
}
}