<?php
   function countdownToThreeDays($startDateTime) {
    // Chuyển đổi ngày bắt đầu thành đối tượng DateTime
    $startDateTimeObj = new DateTime($startDateTime);

    // Tăng thời gian bắt đầu thêm 3 ngày
    $endDateTimeObj = clone $startDateTimeObj;
    $endDateTimeObj->add(new DateInterval('P3D'));

    // Lấy thời điểm hiện tại
    $currentDateTimeObj = new DateTime('now');

    // Tính khoảng thời gian giữa hai ngày
    $interval = $currentDateTimeObj->diff($endDateTimeObj);

    // Trả về kết quả dưới dạng chuỗi
    return $interval->format('%a ngày, %h giờ, %i phút, %s giây');
}
?>