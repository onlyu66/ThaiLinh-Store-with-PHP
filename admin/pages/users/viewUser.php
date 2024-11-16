<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/addProduct.css">
</head>
<body>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="font-bold text-base">Thông tin chi tiết người dùng</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="modal-body bg-stone-100">
                    <?php    
                        include_once "../../../untils/utility.php";
                        include_once "../../../database/config.php";
                        include_once "../../../database/dbhelper.php";
                        function calculateTimeDifference($startDateTime) {
                            // Chuyển đổi ngày bắt đầu thành timestamp
                            $startTimestamp = strtotime($startDateTime);
          
                            // Lấy thời điểm hiện tại dưới dạng timestamp
                            $currentTimestamp = time();
          
                            // Tính khoảng thời gian giữa hai timestamp
                            $timeDifferenceInSeconds = $currentTimestamp - $startTimestamp;
          
                            // Chuyển đổi khoảng thời gian thành ngày và giờ
                            $days = floor($timeDifferenceInSeconds / (60 * 60 * 24));
                            $hours = floor(($timeDifferenceInSeconds % (60 * 60 * 24)) / (60 * 60));
                            $minutes = floor(($timeDifferenceInSeconds % (60 * 60)) / 60);

          
                            // Trả về kết quả dưới dạng chuỗi
                            if($days<1 && $hours>1){
                             return "$hours giờ, $minutes phút";
                            }else if($hours<1){
                             return "$minutes phút";
                            }else{
                             return "$days ngày, $hours giờ, $minutes phút";
                            }
                        }
                        $id = $_POST['id'];
                        $viewSql = "
                        SELECT 
                        users.id as id, users.username as username, users.age as age, users.phoneNumber,
                        role.role as role, statusUser.name as status, users.active as active, 
                        users.status as statusId, users.avatar as avatar, users.email as email,
                        users.sex as sex, users.fullName as fullName, users.address as address, 
                        users.createAt as createAt, users.logOutAt as logOutAt
                        FROM users 
                        join statusUser on users.status=statusUser.id
                        join role on users.roleId=role.id
                        WHERE users.id='$id'";
                        $user=select($viewSql,true);
                    ?>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">User Id: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['id']?></p>
                    </div>

                    <div class="mb-1">
                        <p class="font-semibold">Avatar: </p>
                        <img src=".<?php echo $user['avatar']?>" class="p-1 rounded-xl shadow-sm ml-2" width="100px"></img>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Username: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['username']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Email: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['email']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Phone number: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['phoneNumber']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Fullname: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['fullName']?></p>
                    </div>
                    
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Age: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['age']?></p>
                    </div>
                    
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Sex: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['sex'];?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Address: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['address']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Role: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['role']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Sign up at: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo $user['createAt']?></p>
                    </div>

                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/3">Not working: </p>
                        <p class="ml-2 flex-initial w-2/3"><?php echo ($user['statusId']==2)?calculateTimeDifference($user['logOutAt']):""?></p>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>