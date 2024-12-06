<?php
include_once 'untils/functions.php';

define('JMETER_PATH', 'D:/KTPM/backend_test_project/apache-jmeter-5.6.3/bin/jmeter');
define('JMETER_TEST_PLAN_10000', 'tests/jmeter/backend_test_plan_10000.jmx');
define('JMETER_RESULT_10000', 'results/backend_test_result_10000.jtl');
define('REPORT_OUTPUT_DIR_10000', 'results/html_report_10000');
define('PDF_OUTPUT_PATH_10000', 'results/jmeter_report_10000.pdf');
define('JMETER_TEST_PLAN_1000', 'tests/jmeter/backend_test_plan_1000.jmx');
define('JMETER_RESULT_1000', 'results/backend_test_result_1000.jtl');
define('REPORT_OUTPUT_DIR_1000', 'results/html_report_1000');
define('PDF_OUTPUT_PATH_1000', 'results/jmeter_report_1000.pdf');
define('JMETER_TEST_PLAN_100', 'tests/jmeter/backend_test_plan_100.jmx');
define('JMETER_RESULT_100', 'results/backend_test_result_100.jtl');
define('REPORT_OUTPUT_DIR_100', 'results/html_report_100');
define('PDF_OUTPUT_PATH_100', 'results/jmeter_report_100.pdf');
define('JMETER_TEST_PLAN_10', 'tests/jmeter/backend_test_plan_10.jmx');
define('JMETER_RESULT_10', 'results/backend_test_result_10.jtl');
define('REPORT_OUTPUT_DIR_10', 'results/html_report_10');
define('PDF_OUTPUT_PATH_10', 'results/jmeter_report_10.pdf');
define('PDF_PERFORMANCE_COMPARISON_REPORT_PATH', 'D:/KTPM/backend_test_project/results/Performance_Comparison_Report.pdf');

define('SELENIUM_RESULT', 'D:/KTPM/backend_test_project/results/selenium_test_report.pdf');
define('TEST_CASES', 'assets/Test_Cases_Expanded.xlsx');

exportToExcel('localhost', 'root', '', 'thailinhstore_test', 'colors', 'colorsTable.xlsx');
exportToExcel('localhost', 'root', '', 'thailinhstore_test', 'brands', 'brandsTable.xlsx');
exportToExcel('localhost', 'root', '', 'thailinhstore_test', 'categories', 'categoriesTable.xlsx');
exportToExcel('localhost', 'root', '', 'thailinhstore_test', 'versions', 'versionsTable.xlsx');

runSeleniumTest();

runJMeterTest(JMETER_PATH, JMETER_TEST_PLAN_10, JMETER_RESULT_10, REPORT_OUTPUT_DIR_10);
convertHtmlToPdf(REPORT_OUTPUT_DIR_10, PDF_OUTPUT_PATH_10);
runJMeterTest(JMETER_PATH, JMETER_TEST_PLAN_100, JMETER_RESULT_100, REPORT_OUTPUT_DIR_100);
convertHtmlToPdf(REPORT_OUTPUT_DIR_100, PDF_OUTPUT_PATH_100);
runJMeterTest(JMETER_PATH, JMETER_TEST_PLAN_1000, JMETER_RESULT_1000, REPORT_OUTPUT_DIR_1000);
convertHtmlToPdf(REPORT_OUTPUT_DIR_1000, PDF_OUTPUT_PATH_1000);
runJMeterTest(JMETER_PATH, JMETER_TEST_PLAN_10000, JMETER_RESULT_10000, REPORT_OUTPUT_DIR_10000);
convertHtmlToPdf(REPORT_OUTPUT_DIR_10000, PDF_OUTPUT_PATH_10000);

$jtlFiles = [
    '10' => 'D:/KTPM/backend_test_project/'.JMETER_RESULT_10,
    '100' => 'D:/KTPM/backend_test_project/'.JMETER_RESULT_100,
    '1000' => 'D:/KTPM/backend_test_project/'.JMETER_RESULT_1000,
    '10000' => 'D:/KTPM/backend_test_project/'.JMETER_RESULT_10000,
];

$results = [];
foreach ($jtlFiles as $threads => $file) {
    $data = parseJTL($file);
    $results[$threads] = calculateStats($data);
}

generatePDFReport($results);
?>
