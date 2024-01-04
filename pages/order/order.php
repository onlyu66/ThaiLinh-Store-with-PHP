<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <link rel="stylesheet" type="text/css" href="./CSS/order.css">
</head>
<body>
    <?php
        if (isset($_SERVER['HTTP_REFERER'])) {
            // Lấy địa chỉ URL của trang trước đó
            $currentURL = $_SERVER['HTTP_REFERER'];
        } else {
            $currentURL = "";
        }
    ?>
    <div class="return hover:font-semibold cursor-pointer mt-3">
        <a href="<?php echo $currentURL;?>">
            <img src="./assets/images/icons/return.png" width="35px" alt="">
            <span>Quay lại</span>
        </a>
    </div>
    
    <?php
        if(isset($_SESSION['cart'][$idUser])){
            if(count($_SESSION['cart'][$idUser])>0){

    ?>
    <div class="orderContainer mt-2 relative">
    <?php
            $error=getSession('errorOrder');
            if(isset($_SESSION['errorOrder'])){
    ?>
            <div id="error" class="alert alert-danger p-0 fixed top-8 right-0 max-w-base m-0 z-50 <?php echo (count($error)>0)?'':'invisible';?>" role="alert">
                <div class="mx-0 my-auto p-2 ">
                    <?php
                        if(count($error)>0){
                    ?>
                        <p class="font-semibold ml-2">Bạn cần kiểm tra lại thông tin</p>
                        <?php
                            foreach($error as $value){
                                if(isset($value)){
                        ?>
                                    <p class="text-sm ml-1"><?php echo $value;?></p>
                        <?php
                                }
                            }
                        ?>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <?php
            }
        ?>
        <div class="itemOrder">
            <div class="text-center my-3 ">
                <img src="./assets/images/icons/shopping-bag.png" alt="" class="mx-auto my-0" >
                <p class="mx-auto my-0 font-bold">Giỏ hàng</p>
            </div>
            <ul class="">
                
                <?php
                        $idUser=getSession('id');
                        if(isset($_SESSION['cart'])){
                        $totalPrice=0;
                        foreach($_SESSION['cart'][$idUser] as $itemOrder){
                            $totalPrice+=$itemOrder['price']*$itemOrder['quantity'];
                ?>
                            <li class="flex relative bg-white shadow-sm rounded py-2 mb-2">
                                <a href="./pages/cart/workWithCart.php?action=xoa&id=<?php echo $itemOrder['id']; ?>" class="absolute top-2 right-2 cursor-pointer">
                                    <img src="./assets/images/icons/trash.png" alt="" >
                                </a>
                                
                                <div class="w-1/3 text-center mt-4">
                                    <img src="./assets/images/uploads/<?php echo $itemOrder['image']?>" width="150px" alt="" class="mx-auto my-0">
                                    <p class="font-semibold mt-2 leading-tight"><?php echo $itemOrder['model'];?></p>
                                    <p class="text-red-600 font-semibold"><?php echo number_format($itemOrder['price']);?> ₫</p>
                                    <div class="mt-2">
                                        <span class="border px-1 rounded hover:font-bold cursor-pointer"><a href="./pages/cart/workWithCart.php?action=giam&id=<?php echo $itemOrder['id']; ?>">-</a></span>
                                        <span class="text-sm my-auto mx-0"><?php echo $itemOrder['quantity'];?></span>
                                        <span class="border px-1 rounded hover:font-bold cursor-pointer"><a href="./pages/cart/workWithCart.php?action=tang&id=<?php echo $itemOrder['id']; ?>">+</a></span>
                                    </div>
                                </div>
                                <div class="pl-2 mt-4 mb-2">
                                    <ul class="mt-1">
                                        <li class="flex border p-2 rounded mt-2">
                                            <img src="./assets/images/icons/radio.png" width="15px" alt="">
                                            <p class="text-sm pl-1">VNPAY - Giảm thêm tới 200.000đ khi thanh toán qua VNPAY.</p>
                                        </li>
                                        <li class="flex border p-2 rounded mt-2">
                                            <img src="./assets/images/icons/radio.png" width="15px" alt="">
                                            <p class="text-sm pl-1">Home PayLater - Trả góp qua Home PayLater giảm tới 1.000.000đ</p>
                                        </li>
                                        <li class="flex border p-2 rounded mt-2">
                                            <img src="./assets/images/icons/radio.png" width="15px" alt="">
                                            <p class="text-sm pl-1"> VPBank - Mở thẻ VPBank, Ưu đãi tới 250.000đ.</p>
                                        </li>
                                        <li class="flex border p-2 rounded mt-2">
                                            <img src="./assets/images/icons/radio.png" width="15px" alt="">
                                            <p class="text-sm pl-1"> ZaloPay - Ưu đãi tới 300.000đ khi thanh toán qua ZaloPay.</p>
                                        </li>
                                        <li class="flex border p-2 rounded mt-2">
                                            <img src="./assets/images/icons/radio.png" width="15px" alt="">
                                            <p class="text-sm pl-1"> VIB - Nhận Voucher 250.000đ khi mở thẻ tín dụng VIB thành công.</p>
                                        </li>
                                        <li class="flex border p-2 rounded mt-2">
                                            <img src="./assets/images/icons/radio.png" width="15px" alt="">
                                            <p class="text-sm pl-1">  Kredivo - Ưu đãi tới 200.000đ khi mua trước trả sau qua Kredivo.</p>
                                        </li>
                                        <li class="flex border p-2 rounded mt-2">
                                            <img src="./assets/images/icons/radio.png" width="15px" alt="">
                                            <p class="text-sm pl-1">  Shinhan Finance - Ưu đãi trả góp 0% qua Shinhan Finance.</p>
                                        </li>
                                        
                                    </ul>
                                    <div>
                                        <p class="font-semibold pl-2 text-sm mt-2">Chọn màu:</p>
                                        <div class="flex mt-2">
                                            <p class="border rounded py-1 px-2 cursor-pointer font-semibold border-2 border-black mr-2 text-sm">Đen</p>
                                            <p class="border rounded py-1 px-2 cursor-pointer hover:border-2 border-teal-600 mr-2 text-sm">Xanh dương</p>
                                            <p class="border rounded py-1 px-2 cursor-pointer hover:border-2 border-teal-600 mr-2 text-sm">Xanh lá</p>
                                            <p class="border rounded py-1 px-2 cursor-pointer hover:border-2 border-teal-600 mr-2 text-sm">Đỏ</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                <?php
                        }
                    }
                    function docSoThanhChu($so) {
                        $docSo = new NumberFormatter("vi", NumberFormatter::SPELLOUT);
                        return $docSo->format($so);
                    }
                    function mb_ucfirst($str) {
                        return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1);
                    }
                ?>
                
                <li class="bg-white shadow-sm rounded p-2 mb-2 text-sm font-semibold">
                    <p>Tổng giá trị: <?php echo number_format($totalPrice);?> ₫</p>
                    <p>Giảm giá: -00 ₫</p>
                    <p>Tổng thanh toán: <span class="text-red-600"><?php echo number_format($totalPrice);?> ₫</span></p>
                    <p class="font-normal"><?php echo mb_ucfirst(docSoThanhChu($totalPrice));?> Việt Nam đồng.</p>
                </li>
            </ul>
        </div>
        <?php
            
            if(isset($_SESSION['id'])){
                $sql="select * from users where id=$idUser";
                $user=select($sql,true);
            }
            if(isset($_POST['orderBtn'])){
                $fullName=$_POST['fullName'];
                $phoneNumber=$_POST['phoneNumber'];
                $email=$_POST['email'];
                $htnh=$_POST['htnh'];
                if($htnh==2){
                    $tinh=$_POST['tinh'];
                    $huyen=$_POST['huyen'];
                    $diachi=$_POST['diachi'];
                    $address=$diachi.", ".$huyen.", ".$tinh.".";
                }else{
                    $address="Số 89 Đường Tam Trinh, Phường Mai Động, Quận Hoàng Mai, Thành Phố Hà Nội.";
                }
                $note=$_POST['note'];
                $ycxhd=(isset($_POST['ycxhd']))?$_POST['ycxhd']:"off";
                if($ycxhd=="on"){
                    $companyName=$_POST['companyName'];
                    $mst=$_POST['mst'];
                    $addressCpn=$_POST['addressCpn'];
                    $printBill=1;
                    if(empty($companyName)){
                        $error['companyName']="Bạn cần nhập Tên công ty *";
                    }
                    if(empty($mst)){
                        $error['mst']="Bạn cần nhập Mã số thuế *";
                    }
                    if(empty($addressCpn)){
                        $error['addressCpn']="Bạn cần nhập Địa chỉ công ty *";
                    }
                }else{
                    $companyName="";
                    $mst="";
                    $addressCpn="";
                    $printBill=0;
                }
                // echo $ycxhd;
                $error=array();
                if(empty($fullName)){
                    $error['fullname']="Bạn cần nhập Họ và tên *";
                }
                if(empty($phoneNumber)){
                    $error['phoneNumber']="Bạn cần nhập Số điện thoại *";
                }
                if($htnh==2){
                    if(empty($tinh)){
                        $error['tinh']="Bạn cần nhập Tỉnh/Thành phố *";
                    }
                    if(empty($huyen)){
                        $error['huyen']="Bạn cần nhập Quận/Huyện *";
                    }
                    if(empty($diachi)){
                        $error['diachi']="Bạn cần nhập Địa chỉ nhận hàng *";
                    }
                }else{
                    // echo $address;
                }
                // include_once "../cart/cart_function.php";

                $_SESSION['errorOrder']=$error;
                if(empty($error)){
                    $_SESSION['order'][$idUser]=[
                        'code' => random_int(100000,999999),
                        'idUser' => $idUser,
                        'fullName' => $fullName,
                        'phoneNumber' => $phoneNumber,
                        'email' => $email,
                        'htnh' => [
                            'status' => $htnh,
                            'address' => $address,
                        ],
                        'note' => $note,
                        'cart' => $_SESSION['cart'][$idUser],
                        'totalMoney' => totalPrice($_SESSION['cart'][$idUser]),
                        'orderDate' => date("Y-m-d H:i:s"),
                        'status' => 1,
                        'printBill' => [
                            'status' => $printBill,
                            'information' => [
                                'companyName' => $companyName,
                                'mst' => $mst,
                                'addressCpn' => $addressCpn
                            ]
                        ],
                    ];
                    if(isset($_SESSION['id'])){
                        $sqlUpdate="update users set fullName='$fullName', phoneNumber='$phoneNumber' 
                        where id=$idUser";
                        iud($sqlUpdate);
                    }
                    header('location: ?quanly=checkOut');
                }
            }
        
            
        ?>
        <div class="inforUser ">
            <form action="" method="post" class="mt-9 pt-8">
                <h3 class="font-bold text-lg text-center mb-3">Thông tin đặt hàng</h3>
                <p class="text-xs italic text-center text-inherit mb-2">Bạn cần điền đầy đủ các trường thông tin có dấu *</p>
                <input type="text" name="fullName" placeholder="Họ và tên *" value="<?php 
                    if(isset($_SESSION['id'])){
                        $fullName=$user['fullName'];
                        echo (isset($fullName))?$fullName:"";
                    }else{
                        echo (isset($fullName))?$fullName:"";
                    }
                ?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                <input type="phone" name="phoneNumber" placeholder="Số điện thoại *" value="<?php 
                
                    if(isset($_SESSION['id'])){
                        $phoneNumber=$user['phoneNumber'];
                        echo (isset($phoneNumber))?$phoneNumber:"";
                    }else{
                        echo (isset($phoneNumber))?$phoneNumber:"";
                    }
                ?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                <input type="email" name="email" placeholder="Email" value="<?php
                 if(isset($_SESSION['id'])){
                    $email=$user['email'];
                    echo (isset($email))?$email:"";
                }else{
                    echo (isset($email))?$email:"";
                }
                ?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                <p class="text-sm font-semibold">Hình thức nhận hàng</p>
                <div class="flex justify-evenly mt-2 htnhI">
                    <label for="htnh2" class="flex border p-2 rounded cursor-pointer divR">
                        <input type="radio" name="htnh" value="2" class="htnh" id="htnh2" > <label for="htnh2" class="ml-1 text-sm cursor-pointer">Nhận hàng tại nhà</label>
                    </label>
                    <label for="htnh1" class="flex border p-2 rounded cursor-pointer divR">
                        <input type="radio" name="htnh" value="1" class="htnh" id="htnh1" checked> <label for="htnh1" class="ml-1 text-sm cursor-pointer">Nhận hàng tại cửa hàng</label>
                    </label>
                </div>
                <!-- Div tương ứng với radio có giá trị là 1 -->
                <div id="div2" class="divToShow mt-2">
                    <select name="tinh" value="<?php echo (isset($tinh))?$tinh:"";?>" id="city" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 text-sm mb-2">
                        <option  selected>Tỉnh/Thành phố *</option>           
                    </select>
                    <select name="huyen" id="district" value="<?php echo (isset($huyen))?$huyen:"";?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 text-sm mb-2">
                        <option  selected>Quận/Huyện *</option>
                    </select>
                    <select id="ward" hidden>
                        <option value="" selected>Chọn phường xã</option>
                    </select>
                    <h2 id="result" hidden></h2>
                    <input type="text"  name="diachi" value="<?php echo (isset($diachi))?$diachi:"";?>" placeholder="Địa chỉ nhận hàng *" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                </div>
                <!-- Div tương ứng với radio có giá trị là 2 -->
                <div id="div1" class="divToShow mt-2">
                    <p class="text-sm mb-2">Địa chỉ: Số 89 Đường Tam Trinh, Phường Mai Động, Quận Hoàng Mai, Thành Phố Hà Nội, Việt Nam.</p>
                </div>
                <textarea name="note" value="<?php echo (isset($note))?$note:"";?>" placeholder="Ghi chú" id="" cols="57" rows="10" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 text-sm mb-2"></textarea>
                <div class="flex text-center cursor-pointer">
                    <input type="checkbox" name="ycxhd" id="ycxhd" class="cursor-pointer "><label for="ycxhd" class="text-xs mt-3 ml-1 cursor-pointer">Yêu cầu xuất hoá đơn công ty (Vui lòng điền email để nhận hóa đơn VAT)</label>

                </div>
                <div class="mt-3" id="show">
                    <input type="text" name="companyName" placeholder="Tên công ty *" value="<?php echo (isset($companyName))?$companyName:"";?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    <input type="text" name="mst" placeholder="Mã số thuế *" value="<?php echo (isset($mst))?$mst:"";?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    <input type="text" name="addressCpn" placeholder="Địa chỉ công ty *" value="<?php echo (isset($addressCpn))?$addressCpn:"";?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                </div>
                <div class="mt-5 text-center">
                    <p class="text-xs">Quý khách có thể lựa chọn hình thức thanh toán sau khi đặt hàng.</p>
                    <button name="orderBtn" class="xndh font-semibold text-white p-3 rounded mt-2 hover:bg-teal-700">XÁC NHẬN VÀ ĐẶT HÀNG</button>
                </div>
            </form>
            <div class="goiY rounded mt-3.5">
                <div class="goiYDiv inline-block rounded-tl-lg">
                GỢI Ý DÀNH CHO BẠN
                </div>
                <ul class="p-0 pt-2 m-0 ">
                    <div class="goiy">
                        <?php 
                            $gYSql="select products.id as id, products.model as model, products.price as price,
                            products.thumbnail as thumbnail,products.discount as discount from products join categories on products.categoryId=categories.id where name like 'phone' order by createAt desc limit 10";
                            $gYQuery= mysqli_query($conn, $gYSql);
                            while($rowPa=mysqli_fetch_array($gYQuery)){
                        ?>
                        <li class="itemGy list-none p-2 border rounded shadow-md relative hover:shadow pb-3">
                        <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowPa['id'];?>">
                            <img src="<?php echo $rowPa['thumbnail']; ?>" alt="This is a image" />
                            <p class="text-sm"><?php echo $rowPa['model']; ?></p>
                            <p class="text-sm mt-1"><?php echo number_format($rowPa['price']*(1-$rowPa['discount'])); ?> ₫</p>
                            <span class="text-sm line-through" <?php echo ($rowPa['discount']>0)?"":"hidden"?>><?php echo number_format($rowPa['price']);?> ₫</span>
                            <span class="text-xs font-semibold" <?php echo ($rowPa['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowPa['discount']*100?>%</span>
                            <div class=" absolute opacity-75 divHiddenGy">
                                <a href="pages/cart/workWithCart.php?id=<?php echo $rowPa['id'];?>">
                                    <p class="text-sm">Thêm giỏ hàng</p>
                                </a>
                            </div>
                        </a>
                        </li>
                        <?php
                            }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <?php
            }else{
    ?>
                <div class="text-center my-3 ">
                    <img src="./assets/images/icons/shopping-bag.png" alt="" class="mx-auto my-0" >
                    <p class="mb-3 font-bold">Giỏ hàng</p>
                    <img src="./assets/images/fail/no-item.png" alt="" class="mx-auto my-0">
                    <p class="font-semibold mt-2">Hiện chưa có sản phẩm nào trong giỏ hàng!</p>
                </div>
    <?php
            }
        
    ?>
    <?php
        }else{
            ?>
                <div class="text-center my-3 ">
                    <img src="./assets/images/icons/shopping-bag.png" alt="" class="mx-auto my-0" >
                    <p class="mb-3 font-bold">Giỏ hàng</p>
                    <img src="./assets/images/fail/no-item.png" alt="" class="mx-auto my-0">
                    <p class="font-semibold mt-2">Hiện chưa có sản phẩm nào trong giỏ hàng!</p>
                </div>
    <?php
            }
        
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data, "city");
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district");
                });
        }
        var callApiWard = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, "ward");
                });
        }

        var renderData = (array, select) => {
            let row = ' <option disable value="">Chọn</option>';
            array.forEach(element => {
                row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`;
            });
            document.querySelector("#" + select).innerHTML = row;
        }

        $("#city").change(() => {
            callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
            printResult();
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
            printResult();
        });
        $("#ward").change(() => {
            printResult();
        })

        var printResult = () => {
            if ($("#district").find(':selected').data('id') != "" && $("#city").find(':selected').data('id') != "" &&
                $("#ward").find(':selected').data('id') != "") {
                let result = $("#city option:selected").text() +
                    " | " + $("#district option:selected").text() + " | " +
                    $("#ward option:selected").text();
                $("#result").text(result)
            }

        }
	</script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const div1 = document.getElementById('div1');
            
            if (div1) {
                div1.style.display = 'block';
            }
            // Lấy tất cả các radio và div
            const radios = document.querySelectorAll('input[name="htnh"]');
            const divsToShow = document.querySelectorAll('.divToShow');

            // Thêm sự kiện change cho mỗi radio
            radios.forEach(function (radio) {
                
                radio.addEventListener('change', function () {
                    // Ẩn tất cả các div trước khi hiển thị div tương ứng
                    divsToShow.forEach(function (div) {
                        div.style.display = 'none';
                    });

                    // Lấy giá trị của radio được chọn
                    const selectedValue = this.value;

                    // Hiển thị div tương ứng với giá trị của radio
                    const divToShow = document.getElementById('div' + selectedValue);
                    if (divToShow) {
                        divToShow.style.display = 'block';
                    }
                });
            });


            // Lấy tham chiếu đến checkbox và div
            const myCheckbox = document.getElementById('ycxhd');
            const myDiv = document.getElementById('show');

            // Thêm sự kiện change cho checkbox
            myCheckbox.addEventListener('change', function () {
                // Kiểm tra trạng thái của checkbox và hiển thị/ẩn div tương ứng
                if (myCheckbox.checked) {
                    myDiv.style.display = 'block';
                } else {
                    myDiv.style.display = 'none';
                }
            });
        });  
    </script>
</body>
</html>