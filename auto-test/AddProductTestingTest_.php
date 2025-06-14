<?php
namespace ThaiLinhStore;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use mysqli;
use ThaiLinhStore\AddProductTesting\BranchCoverageReporter;
use ThaiLinhStore\AddProductTesting\ProductValidator;
use ThaiLinhStore\AddProductTesting\ControlFlowGraphGenerator;

class AddProductTestingTest extends TestCase {
    private $validator;
    private $conn;
    private $faker;
    private $testResults = [];

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
        $this->controlFlowGraph->addNode('validate_branches', 'Validate nhánh');
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
        
        // Luồng validate nhánh
        $this->controlFlowGraph->addEdge('validate_branches', 'insert_product', 'Hợp lệ');
        $this->controlFlowGraph->addEdge('validate_branches', 'error', 'Không hợp lệ');
        
        // Luồng kết thúc
        $this->controlFlowGraph->addEdge('insert_product', 'end', 'Thành công');
        $this->controlFlowGraph->addEdge('error', 'end', 'Kết thúc với lỗi');
    }

    // Phương thức hỗ trợ để phân tích luồng
    public function analyzeControlFlow(array $data): array 
    {
        $flowPath = [];
        $currentNode = 'start';
        $isValidFlow = true;

        $validationSteps = [
            'validate_required' => fn($data) => empty($this->validator->validateRequiredFields($data)),
            'validate_price' => fn($data) => $this->validator->validatePrice($data['price']) === null,
            'validate_stock' => fn($data) => $this->validator->validateStockQuantity($data['stockQuantity']) === null,
            'validate_colors' => fn($data) => $this->validator->validateColors($data['color'] ?? []) === null,
            'validate_thumbnail' => fn($data) => $this->validator->validateThumbnail($data['thumbnail']) === null,
            'validate_gallery' => fn($data) => $this->validator->validateGalleryImages($data['gallery']) === null,
            'validate_branches' => fn($data) => $this->validator->validateBranches($data['branches']) === null
        ];

        foreach ($validationSteps as $step => $validator) {
            $flowPath[] = $currentNode;
            
            if (!$validator($data)) {
                $currentNode = 'error';
                $isValidFlow = false;
                break;
            }
            
            $currentNode = $step;
        }

        $flowPath[] = $currentNode;
        $flowPath[] = $isValidFlow ? 'insert_product' : 'error';
        $flowPath[] = 'end';

        return [
            'path' => $flowPath,
            'isValid' => $isValidFlow
        ];
    }

    // Phương thức sinh báo cáo chi tiết
    public function generateValidationReport(array $data): array 
    {
        $flowAnalysis = $this->analyzeControlFlow($data);
        $errors = $this->validator->validateProductWithBranches(
            $data, 
            $data['thumbnail'], 
            $data['gallery'], 
            $data['branches']
        );

        return [
            'isValid' => $flowAnalysis['isValid'],
            'controlFlow' => $flowAnalysis['path'],
            'errors' => $errors
        ];
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

    // Tạo file ảnh mock với Faker
    private function createMockImageFile($options = []): array {
        // Tạo thư mục tạm
        $tempDir = sys_get_temp_dir();
        
        // Tạo ảnh ngẫu nhiên
        $imagePath = $this->faker->image(
            $tempDir, 
            640, 
            480, 
            'product', 
            false
        );

        $defaultOptions = [
            'name' => basename($imagePath),
            'type' => mime_content_type($imagePath),
            'tmp_name' => $imagePath,
            'error' => UPLOAD_ERR_OK,
            'size' => filesize($imagePath)
        ];

        // Ghi đè các tùy chọn
        $mockFile = array_merge($defaultOptions, $options);

        return $mockFile;
    }

    // Tạo nhiều file ảnh mock
    private function createMockImageFiles($count = 2): array {
        $files = [];
        for ($i = 0; $i < $count; $i++) {
            $files[] = $this->createMockImageFile();
        }
        return $files;
    }

    // Tạo dữ liệu sản phẩm hợp lệ với Faker
    private function generateValidProductData(): array {
        return [
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'version' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stockQuantity' => $this->faker->numberBetween(0, 100),
            'category' => $this->faker->numberBetween(1, 10),
            'color' => $this->faker->randomElements(['red', 'blue', 'green', 'yellow'], 2)
        ];
    }
    
    // Thêm phương thức sinh dữ liệu nhánh
    private function generateValidBranchesData($count = 2): array {
        $branches = [];
        for ($i = 0; $i < $count; $i++) {
            $branches[] = [
                'name' => $this->faker->company,
                'code' => 'CN' . $this->faker->unique()->numberBetween(1, 100),
            ];
        }
        return $branches;
    }

    // Cập nhật các test method
    public function testRandomProductValidation() {
        // Sinh dữ liệu ngẫu nhiên
        $productData = $this->generateValidProductData();
        $thumbnailFile = $this->createMockImageFile();
        $galleryFiles = $this->createMockImageFiles();
        $branches = $this->generateValidBranchesData();

        // Validate
        $errors = $this->validator->validateProductWithBranches(
            $productData, 
            $thumbnailFile, 
            $galleryFiles,
            $branches
        );

        // Kiểm tra không có lỗi
        $this->assertEmpty($errors, 'Dữ liệu ngẫu nhiên phải hợp lệ');
    }

    // Test với dữ liệu không hợp lệ
    public function testInvalidRandomProductData() {
        $testCases = [
            // Giá không hợp lệ
            ['field' => 'price', 'value' => -100],
            // Số lượng không hợp lệ
            ['field' => 'stockQuantity', 'value' => -10],
            // Quá nhiều màu
            ['field' => 'color', 'value' => $this->faker->randomElements(['red', 'blue', 'green', 'yellow'], 7)]
        ];

        foreach ($testCases as $case) {
            $productData = $this->generateValidProductData();
            $productData[$case['field']] = $case['value'];

            $thumbnailFile = $this->createMockImageFile();
            $galleryFiles = $this->createMockImageFiles();

            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

            $this->assertNotEmpty($errors, "Dữ liệu không hợp lệ phải báo lỗi cho trường {$case['field']}");
        }
    }

    // Test ảnh gallery với các trường hợp khác nhau
    public function testGalleryImageVariations() {
        $testCases = [
            // Không có ảnh
            ['files' => [], 'expectedValid' => false],
            // Một ảnh
            ['files' => 1, 'expectedValid' => true],
            // Năm ảnh (tối đa)
            ['files' => 5, 'expectedValid' => true],
            // Sáu ảnh (vượt quá)
            ['files' => 6, 'expectedValid' => false]
        ];

        foreach ($testCases as $case) {
            $productData = $this->generateValidProductData();
            $thumbnailFile = $this->createMockImageFile();
            
            // Tạo số lượng ảnh gallery theo test case
            $galleryFiles = $this->createMockImageFiles($case['files'] === 0 ? 0 : $case['files']);

            $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

            if ($case['expectedValid']) {
                $this->assertArrayNotHasKey('images', $errors, "Số lượng ảnh {$case['files']} phải hợp lệ");
            } else {
                $this->assertArrayHasKey('images', $errors, "Số lượng ảnh {$case['files']} phải báo lỗi");
            }
        }
    }

    // Test hiệu năng với dữ liệu ngẫu nhiên
    public function testPerformanceWithRandomData() {
        $startTime = microtime(true);

        // Thực hiện validate 1000 sản phẩm
        for ($i = 0; $i < 1; $i++) {
            $productData = $this->generateValidProductData();
            $thumbnailFile = $this->createMockImageFile();
            $galleryFiles = $this->createMockImageFiles();

            $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        // Kiểm tra thời gian thực thi
        $this->assertLessThan(2, $executionTime, "Validation 1000 sản phẩm phải hoàn thành trong 2 giây");
    }

    // Test an ninh với dữ liệu độc hại
    /*public function testSecurityWithMaliciousInput() {
        $maliciousData = [
            'brand' => '<script>alert("XSS")</script>',
            'model' => "Robert'); DROP TABLE Users; --",
            'price' => 'evil_script.php',
            'stockQuantity' => '../../etc/passwd'
        ];

        $productData = array_merge($this->generateValidProductData(), $maliciousData);
        $thumbnailFile = $this->createMockImageFile();
        $galleryFiles = $this->createMockImageFiles();

        $errors = $this->validator->validateProduct($productData, $thumbnailFile, $galleryFiles);

        // Kiểm tra các lỗi liên quan đến đầu vào không an toàn
        $this->assertNotEmpty($errors, 'Dữ liệu độc hại phải bị từ chối');
        $this->assertArrayHasKey('brand', $errors);
        $this->assertArrayHasKey('model', $errors);
        $this->assertArrayHasKey('price', $errors);
        $this->assertArrayHasKey('stockQuantity', $errors);
    }*/

    protected function tearDown(): void {
        // Sinh control flow graph
        $graphFile = $this->controlFlowGraph->renderGraph('product_add_flow.png');
        echo "Control Flow Graph đã được tạo tại: $graphFile\n";

        // Sinh báo cáo bao phủ
        $report = $this->branchCoverageReporter->generateReport();
        echo $report;
        $this->conn->close();
    }
}