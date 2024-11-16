<?php
// Kiểm tra Xdebug
if (extension_loaded('xdebug')) {
    echo "Xdebug is installed!\n";
    print_r(xdebug_info());
} else {
    echo "Xdebug is NOT installed.\n";
}

// Thông tin PHP
phpinfo(INFO_MODULES);