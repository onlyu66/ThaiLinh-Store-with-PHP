<?php
require_once('vendor/autoload.php'); // Load the WebDriver library

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

$host = 'http://localhost:4444/wd/hub'; // URL for the Selenium server

// Set up Edge WebDriver
$driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());

try {
    // Open the frontend page
    $driver->get("http://localhost/your-frontend-url");

    // Enter data into the form
    $driver->findElement(WebDriverBy::id("brand"))->sendKeys("Samsung");
    $driver->findElement(WebDriverBy::id("model"))->sendKeys("Galaxy S23");
    $driver->findElement(WebDriverBy::id("price"))->sendKeys("999");
    $driver->findElement(WebDriverBy::id("stockQuantity"))->sendKeys("50");

    // Submit the form
    $driver->findElement(WebDriverBy::id("submit-btn"))->click();

    // Check the response
    $response = $driver->findElement(WebDriverBy::id("response"))->getText();
    echo "Test Result: $response";

} finally {
    // Quit the driver
    $driver->quit();
}
?>
