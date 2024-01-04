<link rel="stylesheet" type="text/css" href="./CSS/editOrder.css">
<?php
    include_once "../../database/dbhelper.php";
    $orderCode = $_POST['orderCode'];
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <p class="font-bold text-base">Chỉnh sửa thông tin đơn hàng số <span class="text-orange-500"><?php echo $orderCode;?></span></p>
            <!-- <h1 class="modal-title fs-5" id="exampleModalLabel"></h1> -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div class="modal-body bg-stone-100 inforUserE">
            <?php
            // include_once "../../../untils/utility.php";
            // include_once "../../../database/config.php";
            
            $sqlOrders="select * from orders where orderCode=$orderCode";
            $result_=select($sqlOrders,true);
            // echo $orderCode;
            if(isset($_POST['editOrderBtn'])){

                $fullName=$_POST['fullName'];
                $phoneNumber=$_POST['phoneNumber'];
                $email=$_POST['email'];
                $htnh=$_POST['htnh'];
                if($htnh==1){
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
                if($htnh==1){
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
                    // $_SESSION['order'][$idUser]=[
                    //     'code' => random_int(100000,999999),
                    //     'idUser' => $idUser,
                    //     'fullName' => $fullName,
                    //     'phoneNumber' => $phoneNumber,
                    //     'email' => $email,
                    //     'htnh' => [
                    //         'status' => $htnh,
                    //         'address' => $address,
                    //     ],
                    //     'note' => $note,
                    //     'cart' => $_SESSION['cart'][$idUser],
                    //     'totalMoney' => totalPrice($_SESSION['cart'][$idUser]),
                    //     'orderDate' => date("Y-m-d H:i:s"),
                    //     'status' => 1,
                    //     'printBill' => [
                    //         'status' => $printBill,
                    //         'information' => [
                    //             'companyName' => $companyName,
                    //             'mst' => $mst,
                    //             'addressCpn' => $addressCpn
                    //         ]
                    //     ],
                    // ];
                    $sqlEditOrder="update orders set deliveryMethod='$htnh', fullName='$fullName', email='$email', phoneNumber='$phoneNumber', address='$address', note='$note' where orderCode='$orderCode'";
                    iud($sqlEditOrder);
                    
                    header("location: ?quanly=orderDetails");
                }
            }
            ?>
            <form action="" method="post" >
                    <!-- <h3 class="font-bold text-lg text-center mb-3">Thông tin đặt hàng</h3> -->
                    <p class="text-xs italic text-center text-inherit mb-2">Bạn cần điền đầy đủ các trường thông tin có dấu *</p>
                    <input type="text" name="fullName" placeholder="Họ và tên *" value="<?php echo $result_['fullName']?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    <input type="phone" name="phoneNumber" placeholder="Số điện thoại *" value="<?php echo $result_['phoneNumber'];?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    <input type="email" name="email" placeholder="Email" value="<?php echo $result_['email']?>" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    <p class="text-sm font-semibold">Hình thức nhận hàng</p>
                    <div class="flex justify-evenly mt-2 htnhIE">
                        <label for="htnh1" class="flex border p-2 rounded cursor-pointer divRE">
                            <input type="radio" name="htnh" value="1" class="htnh" id="htnh1" <?php echo ($result_['deliveryMethod']==1)?"checked":"";?>> <label for="htnh1" class="ml-1 text-sm cursor-pointer" >Nhận hàng tại nhà</label>
                        </label>
                        <label for="htnh2" class="flex border p-2 rounded cursor-pointer divRE">
                            <input type="radio" name="htnh" value="2" class="htnh" id="htnh2" <?php echo ($result_['deliveryMethod']==2)?"checked":"";?>> <label for="htnh2" class="ml-1 text-sm cursor-pointer" >Nhận hàng tại cửa hàng</label>
                        </label>
                    </div>
                    <!-- Div tương ứng với radio có giá trị là 1 -->
                    <div id="div1" class="divToShowE mt-2">
                        <input type="hidden" value="<?php $result_['city'];?>" id="citydb">
                        <input type="hidden" value="<?php $result_['district'];?>" id="districtdb">
                        <select name="tinh" value="" id="city" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 text-sm mb-2">
                            <option selected>Tỉnh/Thành phố *</option>           
                        </select>
                        <select name="huyen" id="district" value="" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 text-sm mb-2">
                            <option  selected>Quận/Huyện *</option>
                        </select>
                        <select id="ward" hidden>
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                        <h2 id="result" hidden></h2>
                        <input type="text"  name="diachi" value="" placeholder="Địa chỉ nhận hàng *" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    </div>
                    <!-- Div tương ứng với radio có giá trị là 2 -->
                    <div id="div2" class="divToShowE mt-2">
                        <p class="text-sm mb-2">Địa chỉ: Số 89 Đường Tam Trinh, Phường Mai Động, Quận Hoàng Mai, Thành Phố Hà Nội, Việt Nam.</p>
                    </div>
                    <textarea name="note" value="<?php echo $result_['note'];?>" placeholder="Ghi chú" id="" cols="57" rows="10" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 text-sm mb-2"></textarea>
                    <div class="flex text-center cursor-pointer">
                        <input type="checkbox" name="ycxhd" id="ycxhd" class="cursor-pointer "><label for="ycxhd" class="text-xs mt-3 ml-1 cursor-pointer">Yêu cầu xuất hoá đơn công ty (Vui lòng điền email để nhận hóa đơn VAT)</label>

                    </div>
                    <div class="mt-3" id="show">
                        <input type="text" name="companyName" placeholder="Tên công ty *" value="" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                        <input type="text" name="mst" placeholder="Mã số thuế *" value="" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                        <input type="text" name="addressCpn" placeholder="Địa chỉ công ty *" value="" class="bg-zinc-200 rounded-2xl p-2 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    </div>
                    <div class="mt-5 text-center">
                        <!-- <p class="text-xs">Quý khách có thể lựa chọn hình thức thanh toán sau khi đặt hàng.</p> -->
                        <button type="submit" name="editOrderBtn" class="xndh font-semibold text-white p-3 rounded mt-2 hover:bg-teal-700">XÁC NHẬN CHỈNH SỬA</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<!-- <script>
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
    // Assume you have retrieved cityId and districtId from the database
// let cityIdFromDatabase = 'Tỉnh Bắc Giang';
// let districtIdFromDatabase = 'Huyện Yên Thế';
// let citydb=document.getElementById('citydb');
// console.log("tỉnh",citydb.value);

// Gọi API để lấy dữ liệu cho Tỉnh/Thành phố
// axios.get(host + "p/?depth=1")
// .then((response) => {
//     renderData(response.data, "city");
    
//     // Thiết lập giá trị của city select từ giá trị cityIdFromDatabase
//     $("#city").val(cityIdFromDatabase);
    
//     // Gọi API để lấy dữ liệu cho Quận/Huyện
//     return axios.get(host + "p/" + cityIdFromDatabase + "?depth=2");
// })
// .then((response) => {
//     renderData(response.data.districts, "district");
    
//     // Thiết lập giá trị của district select từ giá trị districtIdFromDatabase
//     $("#district").val(districtIdFromDatabase);
    
//     // Gọi API để lấy dữ liệu cho Phường/Xã
//     return axios.get(host + "d/" + districtIdFromDatabase + "?depth=2");
// })
// .then((response) => {
//     renderData(response.data.wards, "ward");
    
//     // Hiển thị kết quả
//     printResult();
// })
// .catch((error) => {
//     console.error("Error fetching data: ", error);
// });

</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Lấy tất cả các radio và div
        const radio1 = document.getElementById('htnh1');
        const radio2 = document.getElementById('htnh2');
        const div1 = document.getElementById('div1');
        const div2 = document.getElementById('div2');

        // Thêm sự kiện change cho mỗi radio
        if(radio1.checked==true){
            div1.style.display="block";
            div2.style.display="none";
        }else{
            div1.style.display="none";
            div2.style.display="block";
        }
        if(radio2.checked==true){
            div1.style.display="none";
            div2.style.display="block";
        }else{
            div1.style.display="block";
            div2.style.display="none";
        }
        
        
        // Lấy tất cả các radio và div
        const radios = document.querySelectorAll('input[name="htnh"]');
        const divsToShow = document.querySelectorAll('.divToShowE');

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
                const divToShowE = document.getElementById('div' + selectedValue);
                if (divToShowE) {
                    divToShowE.style.display = 'block';
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
