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
            background-color: black;
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="font-bold text-base">Thông tin đơn hàng</p>
                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel"></h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="modal-body bg-stone-100">
                <?php
                    include_once "../../../database/config.php";
                    include_once "../../../database/dbhelper.php";
                    include_once "../../../pages/cart/cart_function.php";

                    if(isset($_POST['id'])){
                        $orderCode=$_POST['id'];
                        // echo $orderCode;
                        $sql="
                        SELECT orders.orderCode as orderCode, orders.status as status, 
                        orders.totalMoney as totalMoney, deliverymethod.name as deliveryMethod,
                        orders.orderDate as orderDate, status.name as status, orders.id as id,
                        orders.idUser as idUser, orders.fullName as fullName, orders.email as email,
                        orders.phoneNumber as phoneNumber,orders.address as address,
                        orders.note as note
                        FROM orders 
                        join status on orders.status=status.id 
                        join deliveryMethod on orders.deliveryMethod=deliverymethod.id
                        where orderCode='$orderCode'";
                        $order=select($sql,true);
                        // echo "<pre>";
                        // var_dump($order);
                        $sql_="select 
                        orderdetails.orderCode as orderCode, orderdetails.price as price , 
                        products.model as name, products.colors as color, orderdetails.num as quantity,
                        orderdetails.totalMoney as totalPrice, versions.ram as ram, versions.rom as rom
                        from products 
                        join orderdetails on products.id=orderdetails.productId
                        join versions on products.versionId=versions.id
                        where orderdetails.orderCode = '$orderCode'";
                        // $query=mysqli_query($conn, $sql);
                        // $result=mysqli_fetch_array($query);
                        $result=select($sql_,false);
                ?>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Order Code: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $orderCode?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Status: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['status']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Delivery Method: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['deliveryMethod']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">User Id: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['idUser']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Fullname: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['fullName']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Email: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['email']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Phone Number: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['phoneNumber']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Address: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['address']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Note: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['note']?></p>
                    </div>
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Order Date: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo $order['orderDate']?></p>
                    </div>
                    
                    <div class="flex mb-1">
                        <p class="font-semibold flex-initial w-1/4">Total Money: </p>
                        <p class="ml-2 flex-initial w-3/4"><?php echo number_format($order['totalMoney']);?> ₫</p>
                    </div>
                    <div>
                        <table id="sp" border="1" class="text-sm">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
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
                                        <!-- <td class="text-center" rowspan="8"><?php echo $i?></td> -->
                                        <td class="pl-2 py-1 font-bold"><?php echo $value['name']?></td>
                                        <td class="text-center"><?php echo $value['ram']."/".$value['rom'];?></td>
                                        <td class="text-center"><?php echo "Đen"?></td>
                                        <td class="text-center"><?php echo ($value['quantity']);?></td>
                                        <td class="text-center"><?php echo number_format($value['price']);?> ₫</td>
                                        <td class="text-center"><?php echo number_format($value['price']*$value['quantity']);?> ₫</td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                            
                        </table>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>