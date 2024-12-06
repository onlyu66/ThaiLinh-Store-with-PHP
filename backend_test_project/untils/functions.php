<?php
require 'vendor/autoload.php';
include_once 'D:\KTPM\backend_test_project\vendor\tecnickcom\tcpdf\tcpdf.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

/**
 * Hàm xuất dữ liệu từ bảng MySQL ra file Excel
 *
 * @param string $hostname - Tên máy chủ cơ sở dữ liệu
 * @param string $username - Tên người dùng MySQL
 * @param string $password - Mật khẩu MySQL
 * @param string $dbname - Tên cơ sở dữ liệu
 * @param string $tableName - Tên bảng trong cơ sở dữ liệu
 * @param string $outputFileName - Tên file Excel xuất ra
 */
function exportToExcel($hostname, $username, $password, $dbname, $tableName, $outputFileName) {
    // Kết nối đến cơ sở dữ liệu MySQL
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ bảng
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Nếu có dữ liệu
    if ($result->num_rows > 0) {
        // Tạo đối tượng Spreadsheet
        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Thiết lập tiêu đề cột
        $columns = $result->fetch_fields();
        $col = 1;
        foreach ($columns as $column) {
            // Chuyển số cột thành ký tự tương ứng (A, B, C, ...)
            $columnLetter = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->setCellValue($columnLetter . '1', $column->name);
            $col++;
        }

        // Duyệt qua các dòng dữ liệu và điền vào bảng Excel
        $rowNumber = 2; // Dòng 2 bắt đầu chứa dữ liệu
        while ($row = $result->fetch_assoc()) {
            $col = 1;
            foreach ($row as $cell) {
                // Cập nhật giá trị ô với setCellValue() theo tọa độ (A2, B2, C2, ...)
                $columnLetter = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
                $sheet->setCellValue($columnLetter . $rowNumber, $cell);
                $col++;
            }
            $rowNumber++;
        }

        // Set header để trình duyệt tự động tải file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $outputFileName . '"');
        header('Cache-Control: max-age=0');

        // Xuất file Excel
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('assets/' . $outputFileName);  // Sửa đường dẫn nơi tệp sẽ được lưu
    } else {
        echo "No data found";
    }

    // Đóng kết nối
    $conn->close();
}

function readExcelData($filePath, $range = null) {
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = [];

    // Kiểm tra nếu chỉ định phạm vi dữ liệu
    if ($range) {
        // Lấy dữ liệu trong phạm vi được chỉ định
        $rangeData = $sheet->rangeToArray($range, null, true, true, true); 
        foreach ($rangeData as $rowIndex => $row) {
            if ($rowIndex == 1) continue;
            $data[] = array_values($row);
        }
    } else {
        // Lấy toàn bộ dữ liệu nếu không chỉ định phạm vi
        foreach ($sheet->getRowIterator() as $rowIndex => $row) {
            if ($rowIndex == 1) continue; // Bỏ qua dòng tiêu đề
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $columnIndex = Coordinate::columnIndexFromString($cell->getColumn());
                $rowData[$columnIndex] = $cell->getFormattedValue();
            }
            $data[] = $rowData;
        }
    }

    return $data;
}

/**
 * Xuất báo cáo kết quả Selenium ra PDF
 * 
 * @param string $filePath Đường dẫn lưu file PDF
 * @param array $testResults Kết quả kiểm tra từ Selenium
 */
function exportToPDF($filePath, $testResults) {
    // Khởi tạo đối tượng TCPDF
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Selenium Automation');
    $pdf->SetTitle('Selenium Test Report');
    $pdf->SetSubject('Test Report');
    $pdf->SetKeywords('Selenium, PDF, Test Report');

    // Thiết lập thông tin trang
    $pdf->setHeaderData('', 0, 'Selenium Test Report', 'Generated on: ' . date('Y-m-d H:i:s'));
    $pdf->setFooterData('');
    $pdf->setFooterMargin(10);
    $pdf->setMargins(15, 27, 15);
    $pdf->SetAutoPageBreak(TRUE, 25);

    // Thêm trang
    $pdf->AddPage();

    // Thiết lập font chữ
    $pdf->SetFont('dejavusans', '', 12);

    // Thêm nội dung vào PDF
    $html = '<h1>Selenium Test Report</h1>';
    $html .= '<p><strong>Test Date:</strong> ' . date('Y-m-d H:i:s') . '</p>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>Test Case</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>';
    foreach ($testResults as $test) {
        $html .= '<tr>
            <td>' . htmlspecialchars($test['test_case']) . '</td>
            <td>' . htmlspecialchars($test['status']) . '</td>
            <td>' . $test['details'] . '</td>
        </tr>';
    }
    $html .= '</tbody></table>';

    // Ghi nội dung vào PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Lưu tệp PDF
    $pdf->Output($filePath, 'F');
    echo "PDF report saved to: $filePath\n";
}


/**
 * Hàm thực hiện đăng nhập
 */
function performLogin($driver) {
    try {
        $driver->findElement(WebDriverBy::name('userName'))->sendKeys('admin');
        $driver->findElement(WebDriverBy::name('password'))->sendKeys('admin123');
        $driver->findElement(WebDriverBy::name('loginBtn'))->click();
        echo "Login successful...\n";
    } catch (\Exception $e) {
        throw new Exception("Lỗi khi đăng nhập: " . $e->getMessage());
    }
}

/**
 * Hàm thêm sản phẩm
 */
function addProduct($driver, $row, &$testResults) {
    try {
        // Điền dữ liệu
        $driver->findElement(WebDriverBy::name('category'))->sendKeys($row[1]);
        $driver->findElement(WebDriverBy::name('brand'))->sendKeys($row[2]);
        $driver->findElement(WebDriverBy::name('model'))->sendKeys($row[3]);
        $driver->findElement(WebDriverBy::name('version'))->sendKeys($row[4]);

        // Checkbox màu sắc
        if (!empty(trim($row[5]))) {
            foreach (explode(',', $row[5]) as $color) {
                $driver->findElement(WebDriverBy::xpath("//input[@name='color[]'][@value='" . trim($color) . "']"))->click();
            }
        }
        if (!empty(trim($row[6]))) {
            $driver->findElement(WebDriverBy::name('price'))->sendKeys($row[6]);
        }
        if (!empty(trim($row[7]))) {
            $driver->findElement(WebDriverBy::name('discount'))->sendKeys($row[7]);
        }
        if (!empty(trim($row[8]))) {
            $driver->findElement(WebDriverBy::name('image'))->sendKeys($row[8]);
        }
        if (!empty(trim($row[9]))) {
            foreach (explode(',', $row[9]) as $image) {
                $driver->findElement(WebDriverBy::name('images[]'))->sendKeys(trim($image));
            }
        }
        if (!empty(trim($row[10]))) {
            $driver->findElement(WebDriverBy::name('stockQuantity'))->sendKeys($row[10]);
        }
        if (!empty(trim($row[11]))) {
            $driver->findElement(WebDriverBy::name('description'))->sendKeys($row[11]);
        }

        // Submit form
        $driver->findElement(WebDriverBy::name('submitBtn'))->click();

        // Kiểm tra lỗi từ backend
        handleBackendErrors($driver, $row, $testResults);

        echo "Product added: " . $row[3] . "\n";

    } catch (\Exception $e) {
        echo "Lỗi khi thêm sản phẩm: " . $e->getMessage() . "\n";

        // Ghi nhận kết quả thất bại nếu xảy ra ngoại lệ
        $testResults[] = [
            'test_case' => $row[0],
            'status' => 'Failure',
            'details' => $e->getMessage()
        ];
    }
}


/**
 * Hàm xử lý lỗi từ backend
 */
function handleBackendErrors($driver, $row, &$testResults) {
    $errorFields = [
        "categoryError", "brandError", "modelError", "versionError", 
        "colorError", "priceError",  
        "imageError", "imagesError", "stockQuantityError"
    ];

    $errorDetails = []; // Mảng chứa tất cả lỗi

    foreach ($errorFields as $field) {
        try {
            $errorText = $driver->findElement(WebDriverBy::id($field))->getText();
            if (!empty($errorText)) {
                echo "Phản hồi từ backend ($field): $errorText\n";

                // Thêm lỗi vào mảng
                $errorDetails[] = "<strong>&bull;</strong> $field: $errorText";
            }
        } catch (\Exception $e) {
            // Không có lỗi từ trường này
        }
    }

    // Nếu có lỗi, thêm vào kết quả kiểm thử
    if (!empty($errorDetails)) {
        $testResults[] = [
            'test_case' => $row[0],
            'status' => 'Failure',
            'details' => implode('<br>', $errorDetails)
        ];
        $driver->findElement(WebDriverBy::className('btn-close'))->click();
        $driver->findElement(WebDriverBy::id('addProductBtn'))->click();
    }else{
        $testResults[] = [
            'test_case' => $row[0],
            'status' => 'Success',
            'details' => '<strong>&bull;</strong> Product added successfully.'
        ];
        $driver->findElement(WebDriverBy::id('addProductBtn'))->click();
    }
}


function runSeleniumTest() {
    $host = 'http://localhost:4444/wd/hub'; // Địa chỉ Selenium Server
    $capabilities = DesiredCapabilities::chrome();
    $testResults = []; // Lưu trữ tất cả kết quả kiểm thử

    try {
        // Khởi tạo trình điều khiển
        $driver = RemoteWebDriver::create($host, $capabilities);
        echo "Selenium WebDriver started...\n";

        // Truy cập trang admin
        $driver->get("http://localhost/ThaiLinhStore/admin/?action=products");

        // Đăng nhập
        performLogin($driver);

        // Truy cập trang sản phẩm
        $driver->findElement(WebDriverBy::id('productPageLink'))->click();
        echo "Navigated to product page...\n";

        // Đọc dữ liệu từ file Excel
        $data = readExcelData(TEST_CASES, 'A1:L17');

        $driver->findElement(WebDriverBy::id('addProductBtn'))->click();

        // Thêm sản phẩm
        foreach ($data as $row) {
            addProduct($driver, $row, $testResults);
        }

        // Xuất kết quả kiểm thử ra file PDF duy nhất
        exportToPDF(SELENIUM_RESULT, $testResults);

        echo "Selenium Test: Thành công. Kết quả lưu trong file PDF.\n";
        sleep(5);

    } catch (\Exception $e) {
        echo "Lỗi Selenium: " . $e->getMessage() . "\n";
    } finally {
        if (isset($driver)) {
            $driver->quit();
        }
    }
}


function runJMeterTest($jmeterPath, $jmeterTestPlan, $jmeterResult, $reportOutputDir) {
    $command = "$jmeterPath -n -t $jmeterTestPlan -l $jmeterResult -e -o $reportOutputDir";
    exec($command, $output, $returnVar);
    if ($returnVar === 0) {
        echo "JMeter Test: Thành công. Kết quả tại $jmeterResult\n";
        
        // Kiểm tra tệp kết quả
        if (file_exists($jmeterResult)) {
            echo "Kết quả kiểm thử được lưu thành công.\n";
            echo "Báo cáo HTML được tạo tại: $reportOutputDir\n";
        } else {
            echo "Cảnh báo: Tệp kết quả không tồn tại.\n";
        }
    } else {
        echo "JMeter Test: Thất bại. Vui lòng kiểm tra cấu hình.\n";
    }
}

use Dompdf\Dompdf;
use Dompdf\Options;

function convertHtmlToPdf($htmlReportDir, $pdfOutputPath) {
    // Đường dẫn file HTML chính
    $htmlFilePath = $htmlReportDir . "/index.html";

    if (!file_exists($htmlFilePath)) {
        echo "Không tìm thấy file HTML tại $htmlFilePath\n";
        return;
    }

    // Đọc nội dung HTML
    $htmlContent = file_get_contents($htmlFilePath);

    // Cấu hình Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Tải nội dung HTML vào Dompdf
    $dompdf->loadHtml($htmlContent);

    // Kết xuất PDF
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Lưu PDF
    file_put_contents($pdfOutputPath, $dompdf->output());
    echo "Báo cáo PDF được tạo thành công tại: $pdfOutputPath\n";
}

function parseJTL($file) {
    $data = [];
    
    // Check if the file exists
    if (!file_exists($file)) {
        throw new Exception("File not found: $file");
    }

    // Open the file for reading
    if (($handle = fopen($file, "r")) !== false) {
        $headers = fgetcsv($handle); // Read the first line as headers
        
        // Ensure required columns are present
        if (!in_array('elapsed', $headers) || !in_array('success', $headers)) {
            throw new Exception("Missing required columns in the JTL file.");
        }

        // Map header names to indexes
        $headerMap = array_flip($headers);
        
        // Process each row
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = [
                'time' => (float) $row[$headerMap['elapsed']],
                'success' => $row[$headerMap['success']] === 'true',
            ];
        }

        fclose($handle);
    } else {
        throw new Exception("Unable to open file: $file");
    }

    return $data;
}


function calculateStats($data) {
    if (empty($data)) {
        return [
            'average' => 0,
            'min' => 0,
            'max' => 0,
            'error_rate' => 1, // Assume 100% error rate for empty data
        ];
    }

    $times = array_column($data, 'time');
    $successCount = count(array_filter($data, fn($item) => $item['success']));
    $totalCount = count($data);

    return [
        'average' => array_sum($times) / count($times),
        'min' => min($times),
        'max' => max($times),
        'error_rate' => 1 - ($successCount / $totalCount),
    ];
}

function generatePDFReport($results) {
    if (empty($results)) {
        throw new Exception("No results to generate the PDF report.");
    }

    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'B', 14);

    // Title
    $pdf->Cell(0, 10, 'JMeter Performance Report Comparison', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('helvetica', '', 10);

    foreach ($results as $threads => $stats) {
        $pdf->Cell(0, 10, "Threads: $threads", 0, 1);
        $pdf->Cell(0, 10, "Average Response Time: " . round($stats['average'], 2) . " ms", 0, 1);
        $pdf->Cell(0, 10, "Min Response Time: " . round($stats['min'], 2) . " ms", 0, 1);
        $pdf->Cell(0, 10, "Max Response Time: " . round($stats['max'], 2) . " ms", 0, 1);
        $pdf->Cell(0, 10, "Error Rate: " . round($stats['error_rate'] * 100, 2) . " %", 0, 1);
        $pdf->Ln(10);
    }

    // Output to file
    $filePath = PDF_PERFORMANCE_COMPARISON_REPORT_PATH;
    $pdf->Output($filePath, 'F');
    echo "PDF report generated successfully: $filePath\n";
}

?>
