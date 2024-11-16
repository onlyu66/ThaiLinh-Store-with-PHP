<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table tr .pm{
            padding-left: 30px !important;
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
        .orders{
            display: grid;
            grid-template-areas: 
            "stt inf view";
            grid-template-columns: 10% 70% 20%;
            grid-template-rows: auto auto auto;
        }
        .stt{
            grid-area: stt;
            margin: auto 0;
        }
        .inf{
            grid-area: inf;
        }
        .view{
            grid-area: view;
            margin: auto 0;
        }
        .view a{
            border: 2px solid #208f89;
        }
        
    </style>
</head>
<body>
    <div class="">
        <?php
            if(isset($_SESSION['id'])){
                $idUser=getSession('id');

                    // join (select  
                    // orderdetails.productId as productId, orderdetails.orderCode as orderCode, orderdetails.price as price , 
                    // products.model as name, products.colorId as color, orderdetails.num as quantity,
                    // orderdetails.totalMoney as totalPrice, versions.ram as ram, versions.rom as rom
                    // from products 
                    // join orderdetails on products.id=orderdetails.productId
                    // join versions on products.versionId=versions.id
                    // where orderdetails.orderCode = orders.codeOrder) on orderdetails.productId=products.id
                    $sql_="select
                    orders.orderCode as orderCode, orders.orderDate as orderDate,
                    status.name as status, orders.totalMoney as totalMoney
                    from orders 
                    join status on orders.status=status.id
                    where orders.idUser = $idUser";
                    $orders=select($sql_,false);    
                    if(count($orders)>0){
                        ?>
                            <div class="text-center my-3 mb-5">
                                <img src="./assets/images/icons/shopping-bag.png" alt="" class="mx-auto my-0" >
                                <p class="mx-auto my-0 font-bold ">CÁC ĐƠN HÀNG CỦA BẠN</p>
                            </div>
                        <?php
                    

                    
        ?>
                    
        <?php    
                    
                    // echo "<pre>";
                    // var_dump($result_);
                    // echo "</pre>";
                    // // header("location: ?quanly=checkOrder");
                        $i=0;
                        foreach($orders as $order){
                            $i++;
                            // echo "<pre>";
                            // var_dump($order);
                            // // var_dump($result);
                            // echo "</pre>";
                            
            ?>
                            <div class="orders mb-2 p-2 bg-neutral-100 rounded shadow-sm">
                                <p class="stt pl-4"><?php echo $i;?></p>
                                <div class="inf">
                                    <p><span class="font-semibold">Đơn hàng:</span> <?php echo $order['orderCode'];?></p>
                                    <p><span class="font-semibold">Thời gian đặt hàng:</span> <?php echo $order['orderDate'];?></p>
                                    <p><span class="font-semibold">Trạng thái:</span> <?php echo $order['status'];?></p>
                                    <p><span class="font-semibold">Tổng tiền:</span> <?php echo number_format($order['totalMoney']);?> ₫</p>
                                </div>
                                <div class="view">
                                    <a href="?quanly=order_details&orderCode=<?php echo $order['orderCode'];?>" class="border p-2 rounded hover:shadow hover:font-semibold shadow-sm">Xem chi tiết</a>
                                </div>
                            </div>
                <?php
                    }
                    }else{
                    ?>
                    <form action="?quanly=order_details" method="post" class="my-11 text-center" style="width: 70%; margin-left: 115px ;margin-top: 100px">
                    <h3 class="text-lg mb-2 font-bold">Kiểm tra đơn hàng</h3>
                    <input type="text" name="orderCode" value="<?php echo getSession('orderCode');?>" placeholder="Vui lòng nhập mã đơn hàng *" class="w-full bg-zinc-200 rounded-2xl p-3 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    <button type="submit" name="checkOrder" class="border rounded px-4 py-2.5 text-sm font-semibold bg-teal-600 text-white hover:bg-teal-700">TRA CỨU</button>
                    </form>
                    <div>
                        <div style="margin-top:320px" class="w-full bg-teal-600 rounded-2xl py-3 focus:outline-none indent-2.5 placeholder:text-sm mb-2 relative flex justify-end ">
                            <img src="./assets/images/icons/icon-youknow.png" width="140" alt="" class="absolute bottom-1 left-0">
                            <p class="text-sm text-white absolute " style="left:148px;">MUA HÀNG ĐỂ CÓ THẾ TRẢI NGHIỆM DỊCH VỤ CỦA THAILINH STORE</p>
                            <a href="?quanly=home" class="border rounded p-2 font-semibold bg-slate-50 hover:bg-slate-200 mr-4" style="border-color: rgb(13 148 136); border-width: 2px;">
                                <p>Mua ngay</p>
                            </a>
                        </div>
                    </div>
    <?php    
                        
                    }
            }else{
                
        ?>
                <form action="?quanly=order_details" method="post" class="my-11 text-center " style="width: 70%; margin-left: 115px ;margin-top: 100px">
                    <h3 class="text-lg mb-2 font-bold">Kiểm tra đơn hàng</h3>
                    <input type="text" name="orderCode" value="<?php echo getSession('orderCode');?>" placeholder="Vui lòng nhập mã đơn hàng *" class="w-full bg-zinc-200 rounded-2xl p-3 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                    <button type="submit" name="checkOrder" class="border rounded px-4 py-2.5 text-sm font-semibold bg-teal-600 text-white hover:bg-teal-700">TRA CỨU</button>
                </form>
                <div>
                    <div style="margin-top:320px" class="w-full bg-teal-600 rounded-2xl py-3 focus:outline-none indent-2.5 placeholder:text-sm mb-2 relative flex justify-end ">
                        <img src="./assets/images/icons/icon-youknow.png" width="140" alt="" class="absolute bottom-1 left-0">
                        <p class="text-xs text-white absolute left-9" style="left:128px;">ĐĂNG NHẬP SẼ GIÚP BẠN QUẢN LÝ ĐƠN HÀNG VÀ TRẢI NGHIỆM WEBSITE TỐT HƠN</p>
                        <a href="./admin/authen/login.php" class="border rounded p-2 font-semibold bg-slate-50 hover:bg-slate-200 mr-4" style="border-color: rgb(13 148 136); border-width: 2px;">
                            <p>Đăng nhập</p>
                        </a>
                    </div>
                </div>
        <?php
                }
        ?>
            <!-- <form action="" method="post" class="my-11 " style="width: 70%; margin-left: 115px ;margin-top: 100px">
                <h3 class="text-lg mb-2 font-bold">Kiểm tra đơn hàng</h3>
                <input type="text" name="orderCode" placeholder="Vui lòng nhập mã đơn hàng *" class="w-full bg-zinc-200 rounded-2xl p-3 focus:outline-none indent-2.5 placeholder:text-sm mb-2">
                <button type="submit" name="checkOrder" class="border rounded px-4 py-2.5 text-sm font-semibold bg-teal-600 text-white hover:bg-teal-700">TRA CỨU</button>
            </form>
            <div>
                <div style="margin-top:320px" class="w-full bg-teal-600 rounded-2xl py-3 focus:outline-none indent-2.5 placeholder:text-sm mb-2 relative flex justify-end ">
                    <img src="./assets/images/icons/icon-youknow.png" width="140" alt="" class="absolute bottom-1 left-0">
                    <p class="text-xs text-white absolute left-9 right-9">ĐĂNG NHẬP SẼ GIÚP BẠN QUẢN LÝ ĐƠN HÀNG VÀ TRẢI NGHIỆM WEBSITE TỐT HƠN</p>
                    <a href="./admin/authen/login.php" class="border rounded p-2 font-semibold bg-slate-50 hover:bg-slate-200 mr-4" style="border-color: rgb(13 148 136); border-width: 2px;">
                        <p>Đăng nhập</p>
                    </a>
                </div>
            </div> -->
        <?php
            
        ?>
    </div>
</body>
</html>