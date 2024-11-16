<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table tr .pm{
            padding-left: 200px !important;
        }
        #sp{
            border: 1px solid #f3f3f3;
            width: 100%;
        }
        #sp th{
            background-color: #208f89;
            color: white;
            padding: 10px;
            border: 1px solid #f3f3f3;
            text-align: center;
        }
        #sp tr{
            border: 1px solid #f3f3f3;

        }
        #sp td{
            border: 1px solid #f3f3f3;

        }
        form button{
        
        }
    </style>
</head>
<body>
    <div class="return hover:font-semibold cursor-pointer mt-3">
        <a href="<?php echo $currentURL;?>">
            <img src="./assets/images/icons/return.png" width="35px" alt="">
            <span>Quay lại</span>
        </a>
    </div>
    <?php
        if(isset($_POST['checkOrder'])){
            $orderCode=$_POST['orderCode'];
        }else{
            $orderCode=getGet('orderCode');
        }
        
        $sql="select 
        orderdetails.orderCode as orderCode, orderdetails.price as price , 
        products.model as name, products.colors as color, orderdetails.num as quantity,
        orderdetails.totalMoney as totalPrice, versions.ram as ram, versions.rom as rom
        from products 
        join orderdetails on products.id=orderdetails.productId
        join versions on products.versionId=versions.id
        where orderdetails.orderCode = '$orderCode'";
        // $query=mysqli_query($conn, $sql);
        // $result=mysqli_fetch_array($query);
        $result=select($sql,false);

        // echo "<pre>";
        // var_dump($orderCode);
        // var_dump($results);
        $sql_="select
        orders.fullName as fullName, orders.phoneNumber as phoneNumber, 
        orders.email as email, orders.address as address, 
        orders.note as note, orders.orderDate as orderDate,
        status.name as status, orders.deliveryMethod as deliveryMethod, orders.city as city,
        orders.district as district, orders.status as statusId
        from orders 
        join status on orders.status=status.id
        where orders.orderCode = '$orderCode'";
        // $query=mysqli_query($conn, $sql_);
        // $result_=mysqli_fetch_array($query);
        $result_=select($sql_,true);
        if($result_ !=null){

    ?>
        <div class="text-center my-3 ">
            <img src="./assets/images/icons/shopping-bag.png" alt="" class="mx-auto my-0" >
            <p class="mx-auto my-0 font-bold">THÔNG TIN ĐƠN HÀNG SỐ <span class="text-orange-400"><?php echo $orderCode;?></span></p>
        </div>
        <div class="bg-white shadow-sm rounded p-2 mt-2">
            <p class="font-bold text-base">1. Thông tin người đặt hàng</p>
            <table>
                <tr class="text-sm">
                    <td class="pl-3">Họ tên:</td>
                    <td class="pl-12"><?php echo $result_['fullName'];?></td>
                    <td class="pl-16 pm">Điện thoại:</td>
                    <td class="pl-12"><?php echo $result_['phoneNumber'];?></td>
                    <td class="pl-16 pm">Email:</td>
                    <td class="pl-12"><?php echo $result_['email'];?></td>
                </tr>
                <tr class="text-sm">
                    <td class="pl-3">Địa chỉ:</td>
                    <td class="pl-12" colspan="4"><?php echo $result_['address'];?></td>
                </tr>
                <tr class="text-sm">
                    <td class="pl-3">Ghi chú:</td>
                    <td class="pl-12" colspan="4"><?php echo $result_['note'];?></td>
                </tr>
                <tr class="text-sm">
                    <td class="pl-3">Mốc thời gian:</td>
                    <td class="pl-12" colspan="2"><?php echo $result_['orderDate'];?></td>
                    <td class="pl-3">Trạng thái:</td>
                    <td class="pl-12 font-bold" colspan="2"><?php echo $result_['status'];?></td>
                </tr>
            </table>
    <?php
    ?>
        </div>
    <?php    
        // echo "<pre>";
        // var_dump($result_);
        // echo "</pre>";
        // // header("location: ?quanly=checkOrder");
    ?>
        <div class="bg-white shadow-sm rounded p-2 mt-2">
            <p class="font-bold text-base mb-2">2. Danh sách sản phẩm đặt hàng</p>
                <table id="sp" border="1" class="text-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Phiên bản</th>
                            <th>Màu sắc</th>
                            <th>SL</th>
                            <th>Giá tiền</th>
                            <th>Tổng(SL*G)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach ($result as $value) {
                                $i++;
                        ?>
                                <tr>
                                    <td class="text-center" rowspan="8"><?php echo $i?></td>
                                    <td class="pl-2 py-1 font-bold"><?php echo $value['name']?></td>
                                    <td class="text-center"><?php echo $value['ram']."/".$value['rom'];?></td>
                                    <td class="text-center"><?php echo "Đen"?></td>
                                    <td class="text-center"><?php echo ($value['quantity']);?></td>
                                    <td class="text-center"><?php echo number_format($value['price']);?> ₫</td>
                                    <td class="text-center"><?php echo number_format($value['price']*$value['quantity']);?> ₫</td>
                                </tr>
                                <tr >
                                    <td class="pl-2 py-1 text-gray-400 italic" colspan="6">VNPAY - Giảm thêm tới 200.000đ khi thanh toán qua VNPAY.</td>
                                </tr>
                                <tr >
                                    <td class="pl-2 py-1 text-gray-400 italic" colspan="6">Home PayLater - Trả góp qua Home PayLater giảm tới 1.000.000đ</td>
                                </tr>
                                <tr >
                                    <td class="pl-2 py-1 text-gray-400 italic" colspan="6"> VPBank - Mở thẻ VPBank, Ưu đãi tới 250.000đ.</td>
                                </tr>
                                <tr >
                                    <td class="pl-2 py-1 text-gray-400 italic" colspan="6"> ZaloPay - Ưu đãi tới 300.000đ khi thanh toán qua ZaloPay.</td>
                                </tr>
                                <tr >
                                    <td class="pl-2 py-1 text-gray-400 italic" colspan="6"> VIB - Nhận Voucher 250.000đ khi mở thẻ tín dụng VIB thành công.</td>
                                </tr>
                                <tr >
                                    <td class="pl-2 py-1 text-gray-400 italic" colspan="6">  Kredivo - Ưu đãi tới 200.000đ khi mua trước trả sau qua Kredivo.</td>
                                </tr>
                                <tr >
                                    <td class="pl-2 py-1 text-gray-400 italic" colspan="6">  Shinhan Finance - Ưu đãi trả góp 0% qua Shinhan Finance.</td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    <footer>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                            <td class="float-right">Tổng tiền</td>
                            <td class="pl-3 font-semibold"><?php echo number_format(totalPrice($result));?> ₫</td>
                        </tr>
                        <tr class="border-none">
                            <td colspan="5">&nbsp;</td>
                            <td class="float-right">Giảm giá</td>
                            <td class="pl-3">-00 ₫</td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                            <td class="float-right">Tổng tiền thanh toán</td>
                            <td class="pl-3 text-red-600 font-semibold"><?php echo number_format(totalPrice($result));?> ₫</td>
                        </tr>
                    </footer>
                </table>
            <?php
                if(isset($_POST['delOrder'])){
                    $sql="delete from orders where orderCode='$orderCode'";
                    iud($sql);
                    $sql_="delete from orderdetails where orderCode='$orderCode";
                    iud($sql_);
                    header("location: ?quanly=home");
                }
            ?>
            <form action="" method="post">
                <input type="hidden" id="orderCode" value="<?php echo $orderCode;?>">
                <?php if($result_['statusId']==1){?>
                <button type="submit" name="delOrder" class="border p-2 rounded bg-red-600 text-white hover:bg-red-700" <?php echo ($result_['statusId']==1)?"":"disabled"; ?>>Huỷ đơn hàng</button>
                <button class="border p-2 rounded bg-teal-600 text-white hover:bg-teal-700" id="editO" <?php echo ($result_['statusId']==1)?"":"disabled"; ?>>Sửa đơn hàng</button>
                <?php 
                    }else{
                ?>
                <div class="text-center" hidden>
                 <p class="font-semibold">Đơn hàng của bạn đã được xác nhận!</p>
                </div>
                <?php
                    }
                ?>
            </form>
            <div class="modal fade" id="editOrder" tabindex="-1" aria-labelledby="editOrderLabel" aria-hidden="true">
            </div>
        </div>
        <?php
            }else{
        ?>
            <div class="text-center mt-9" style="min-height: 435px;">
                <p class="mx-auto my-0 font-semibold text-base">Không tồn tại đơn hàng số <span class="text-orange-400"><?php echo $orderCode;?></span> !</p>
                <img src="./assets/images/fail/no-item.png" alt="" class="mx-auto my-0 mt-5">
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
            const div2 = document.getElementById('div2');
            
            if (div2) {
                div2.style.display = 'block';
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
    <script>
        $('#editO').click(function(){
        // Lấy giá trị của phần tử có lớp '.id'
        let orderCode = $('#orderCode').val();

        // Gửi yêu cầu AJAX để lấy dữ liệu từ editProduct.php
        $.post('./pages/order/editOrder.php', {orderCode: orderCode}, function(data){
            // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
            // alert(orderCode);
            $('#editOrder').html(data);

        });
        // window.location.href = '?quanly=editOrder';
        return false;
    });
    </script>
</body>
</html>