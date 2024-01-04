<?php
    if(isset($_POST['comfirmEmailBtn'])){
        // Hàm tạo mã xác nhận ngẫu nhiên
        function generateConfirmationCode() {
            return random_int(1000,9999);
        }

        // Hàm gửi email xác nhận
        function sendConfirmationEmail($email, $confirmationCode) {
            $subject = 'Xác nhận địa chỉ email';
            $message = 'Mã xác nhận của bạn là: ' . $confirmationCode;
            mail($email, $subject, $message);
        }
        // Bước 1: Tạo mã xác nhận
        $confirmationCode = generateConfirmationCode();

        // Bước 2: Gửi Email Xác Nhận
        $email = 'ngoclinhthai8@gmail.com'; // Địa chỉ email của người dùng
        sendConfirmationEmail($email, $confirmationCode);

        // Bước 3: Lưu mã xác nhận vào session (hoặc cơ sở dữ liệu)
        $_SESSION['confirmation_code'] = $confirmationCode;
        echo $_SESSION['confirmation_code'];
        echo 'Một email xác nhận đã được gửi đến ' . $email;

        
    }
?>