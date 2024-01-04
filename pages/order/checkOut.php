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
    <?php
        // echo "<pre>";
        // var_dump($_SESSION['order'][$idUser]);
        // echo "</pre>";

        $idUser=getSession('id');
        $order=$_SESSION['order'][$idUser];
        $fullName=$order['fullName'];
        $email=$order['email'];
        $phoneNumber=$order['phoneNumber'];
        $address=$order['htnh']['address'];
        $note=$order['note'];
        $orderDate=$order['orderDate'];
        $status=$order['status'];
        $totalMoney=$order['totalMoney'];
        $orderCode=$order['code'];
        $deliveryMethod=$order['htnh']['status'];
        

        if(isset($_POST['confirmBtn'])){
            $sqlOrder="INSERT INTO orders(orderCode, deliveryMethod, idUser, fullName, email, phoneNumber, address, note, orderDate, status, totalMoney) VALUES ('$orderCode','$deliveryMethod','$idUser','$fullName','$email','$phoneNumber','$address','$note','$orderDate','$status','$totalMoney')";
            mysqli_query($conn, $sqlOrder);
            $orderDetails= $order['cart'];
            foreach ($orderDetails as $value){
                $productId=$value['id'];
                $price=$value['price'];
                $num=$value['quantity'];
                $totalPrice=$price*$num;
                $sqlOrderDetails="INSERT INTO orderdetails(orderCode,status, productId, price, num, totalMoney) VALUES ('$orderCode', '$status', '$productId','$price','$num','$totalPrice')";
                mysqli_query($conn, $sqlOrderDetails);
            }
            unset($_SESSION['order'][$idUser]);
            unset($_SESSION['cart'][$idUser]);
            $_SESSION['orderCode']=$orderCode;
            header("location: ?quanly=home");
        }
    ?>
    <div class="return hover:font-semibold cursor-pointer mt-3">
        <a href="<?php echo $currentURL;?>">
            <img src="./assets/images/icons/return.png" width="35px" alt="">
            <span>Quay lại</span>
        </a>
    </div>
    <form action="" method="post">
        <div class="text-center my-3 ">
            <img src="./assets/images/icons/shopping-bag.png" alt="" class="mx-auto my-0" >
            <p class="mb-3 font-bold">Vui lòng kiểm tra lại thông tin đặt hàng dưới đây</p>
        </div>
        <div class="bg-white shadow-sm rounded p-2 mt-2">
            <p class="font-bold text-base">1. Thông tin người đặt hàng</p>
            <table>
                <tr class="text-sm">
                    <td class="pl-3">Họ tên:</td>
                    <td class="pl-12"><?php echo $order['fullName'];?></td>
                    <td class="pl-16 pm">Điện thoại:</td>
                    <td class="pl-12"><?php echo $order['phoneNumber'];?></td>
                    <td class="pl-16 pm">Email:</td>
                    <td class="pl-12"><?php echo $order['email'];?></td>
                </tr>
                <tr class="text-sm">
                    <td class="pl-3">Địa chỉ:</td>
                    <td class="pl-12" colspan="4"><?php echo $order['htnh']['address'];?></td>
                </tr>
                <tr class="text-sm">
                    <td class="pl-3">Ghi chú:</td>
                    <td class="pl-12" colspan="4"><?php echo $order['note'];?></td>
                </tr>
                <tr class="text-sm">
                    <td class="pl-3">Mốc thời gian:</td>
                    <td class="pl-12" colspan="4"><?php echo $order['orderDate'];?></td>
                </tr>
            </table>
            <?php
                if($order['printBill']['status']==1){
            ?>
                    <p class="font-bold text-sm pl-2">Yêu cầu xuất hoá đơn cho công ty</p>
                    <table>
                        <tr class="text-sm">
                            <td class="pl-3">Tên công ty:</td>
                            <td class="pl-11"><?php echo $order['printBill']['information']['companyName'];?></td>
                        </tr>
                        <tr class="text-sm">
                            <td class="pl-3">Địa chỉ công ty:</td>
                            <td class="pl-11"><?php echo $order['printBill']['information']['addressCpn'];?></td>
                        </tr class="text-sm">
                        <tr class="text-sm">
                            <td class="pl-3">Mã số thuế:</td>
                            <td class="pl-11"><?php echo $order['printBill']['information']['mst'];?></td>
                        </tr>
                    </table>
            <?php
                }
            ?>
        </div>
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
                        foreach ($order['cart'] as $value) {
                            $i++;
                    ?>
                            <tr>
                                <td class="text-center" rowspan="8"><?php echo $i?></td>
                                <td class="pl-2 py-1 font-bold"><?php echo $value['model']?></td>
                                <td class="text-center"><?php echo $value['version']?></td>
                                <td class="text-center"><?php echo $value['color']?></td>
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
                        <td class="pl-3 font-semibold"><?php echo number_format(totalPrice($order['cart']));?> ₫</td>
                    </tr>
                    <tr class="border-none">
                        <td colspan="5">&nbsp;</td>
                        <td class="float-right">Giảm giá</td>
                        <td class="pl-3">-00 ₫</td>
                    </tr>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td class="float-right">Tổng tiền thanh toán</td>
                        <td class="pl-3 text-red-600 font-semibold"><?php echo number_format(totalPrice($order['cart']));?> ₫</td>
                    </tr>
                </footer>
            </table>

        </div>
        <div class="text-center">
            <button type="submit" name="confirmBtn" class="border rounded py-3 px-6 mt-3 mb-1 text-lg font-semibold bg-teal-600 text-white hover:bg-teal-700">XÁC NHẬN ĐẶT HÀNG</button>
        </div>
    </form>
</body>
</html>