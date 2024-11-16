<link rel="stylesheet" href="./CSS/article.css">
<div style="backgroundColor: #fafafa" class="mt-1">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/images/banner/carousel1.png" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel2.jpg" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel3.png" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel4.jpg" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel5.jpg" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel6.jpg" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel7.png" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel8.png" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel9.png" class="d-block w-100 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./assets/images/banner/carousel10.jpg" class="d-block w-100 rounded" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev z-0" type="button" data-bs-target="#carouselExampleAutoplaying" 
        data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next z-0" type="button" data-bs-target="#carouselExampleAutoplaying" 
        data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="ads flex">
        <img src="./assets/images/Ads/galaxy-s20-fe-1.png" />
        <img src="./assets/images/Ads/huawei-watch-gt4-1.png" />
        <img src="./assets/images/Ads/macbook-air.png" />
        <img src="./assets/images/Ads/nk125w_638338458734948608.png" />
    </div>
    <div class="mt-4">
        <img src="./assets/images/Ads/flip4-s22-ultra.png" />
    </div>

    <div
    class="prominentSpeakersHeadphones rounded mt-3.5"
    >
        <div
            class="divSpeakerHeadphone inline-block rounded-tl-lg"
        >
            CÓ THỂ BẠN SẼ THÍCH
        </div>
        <ul class="p-0 pt-2 m-0 ">
            <div class="mayBeLike">
                <?php 
                    $mayBeLikeProductsSql="select * from products where categoryId in (1,2) order by createAt desc limit 10";
                    $mayBeLikeProductQuery= mysqli_query($conn, $mayBeLikeProductsSql);
                    while($row=mysqli_fetch_array($mayBeLikeProductQuery)){
                ?>
                <li class="itemA list-none p-2 border rounded shadow-md relative hover:shadow">
                <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $row['id'];?>">

                    <img src="<?php echo $row['thumbnail']; ?>" alt="This is a image" />
                    <p><?php echo $row['model']; ?></p>
                    <p><?php echo number_format($row['price']*(1-$row['discount'])); ?> ₫</p>
                <span class="text-sm line-through" <?php echo ($row['discount']>0)?"":"hidden"?>><?php echo number_format($row['price']);?> ₫</span>
                <span class="text-xs font-semibold" <?php echo ($row['discount']>0)?"":"hidden"?>>Giảm <?php echo $row['discount']*100?>%</span>
                    <div class="divHidden absolute opacity-75">
                        <a href="pages/cart/workWithCart.php?id=<?php echo $row['id'];?>">
                            <p>Thêm giỏ hàng</p>
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
    <div
    class="phone appleReseller rounded mt-3.5"
    >
        <div class="inline-block rounded-tl-lg">
            APPLE AUTHORISED RESELLER
        </div>
        <ul class="p-0 pt-2 m-0 flex flex-wrap justify-evenly">
            <?php 
                $appleAuthSql="select products.id as id, products.model as model, products.price as price,
                products.thumbnail as thumbnail, products.discount as discount from products join brands on products.brandId=brands.id 
                where brand like 'Apple' and categoryId in (1,2) order by createAt desc limit 20";
                // $appleAuthSql = "SELECT * FROM productdetails WHERE LOWER(brand) LIKE 'apple' LIMIT 20";
                $appleAuthQuery= mysqli_query($conn, $appleAuthSql);
                while($rowAa=mysqli_fetch_array($appleAuthQuery)){
            ?>
                <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowAa['id'];?>">
                <li class="itemA list-none p-2 m-px my-1.5 border rounded shadow-md relative hover:shadow">
                    <img src="<?php echo $rowAa['thumbnail']; ?>" alt="This is a image" />
                    <p><?php echo $rowAa['model']; ?></p>
                    <p><?php echo number_format($rowAa['price']*(1-$rowAa['discount'])); ?> ₫</p>
                <span class="text-sm line-through" <?php echo ($rowAa['discount']>0)?"":"hidden"?>><?php echo number_format($rowAa['price']);?> ₫</span>
                <span class="text-xs font-semibold" <?php echo ($rowAa['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowAa['discount']*100?>%</span>
                    <div class="divHidden absolute opacity-75">
                    <a href="pages/cart/workWithCart.php?id=<?php echo $rowAa['id'];?>">
                            <p>Thêm giỏ hàng</p>
                        </a>
                    </div>
                </li>
                </a>
            <?php
                }
            ?>
        </ul>
    </div>
    <div class="mt-3">
        <img src="./assets/images/Ads/a05-m34-git.gif" />
    </div>
    <div
    class="phone prominentPhone rounded mt-3.5"
    >
        <div class="flex justify-between">
            <div class="inline-block rounded-tl-lg">ĐIỆN THOẠI NỔI BẬT</div>
            <ul class="flex justify-evenly p-0 m-0">
            <li>Iphone 15</li>
            <li>TECNO POVA 5</li>
            <li>Redmi Note 12</li>
            <li>Samsung Galaxy S23</li>
            <li>Xem tất cả</li>
            </ul>
        </div>
        <ul class="p-0 pt-2 m-0 flex flex-wrap justify-evenly">
            <?php 
                $prominentPhoneSql="select products.id as id, products.model as model, products.price as price,
                products.thumbnail as thumbnail, products.discount as discount from products left join categories on products.categoryId = categories.id where name like 'phone' order by createAt desc limit 20";
                // $appleAuthSql = "SELECT * FROM productdetails WHERE LOWER(brand) LIKE 'apple' LIMIT 20";
                $prominentPhoneQuery= mysqli_query($conn, $prominentPhoneSql);
                while($rowPp=mysqli_fetch_array($prominentPhoneQuery)){
            ?>
                <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowPp['id'];?>">
                <li class="itemA list-none p-2 m-px my-1.5 border rounded shadow-md relative hover:shadow">
                    <img src="<?php echo $rowPp['thumbnail']; ?>" alt="This is a image" />
                    <p><?php echo $rowPp['model']; ?></p>
                    <p><?php echo number_format($rowPp['price']*(1-$rowPp['discount'])); ?> ₫</p>
                <span class="text-sm line-through" <?php echo ($rowPp['discount']>0)?"":"hidden"?>><?php echo number_format($rowPp['price']);?> ₫</span>
                <span class="text-xs font-semibold" <?php echo ($rowPp['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowPp['discount']*100?>%</span>
                    <div class="divHidden absolute opacity-75">
                        <a href="pages/cart/workWithCart.php?id=<?php echo $rowPp['id'];?>">
                            <p>Thêm giỏ hàng</p>
                        </a>
                    </div>
                </li>
                </a>
            <?php
                }
            ?>
        </ul>
    </div>
    <div>
        <img src="./assets/images/Ads/tecno-spark-10.png" class="mt-3" />
    </div>
    <div class="prominentSpeakersHeadphones rounded mt-3.5"
    >
        <div
            class="divSpeakerHeadphone inline-block rounded-tl-lg"
        >
            LOA - TAI NGHE NỔI BẬT
        </div>
        <ul class="p-0 pt-2 m-0 ">
            <div class="mayBeLike ">
                <?php 
                    $prominentSpeakersHeadphonesSql="select products.id as id, products.model as model, products.price as price,
                    products.thumbnail as thumbnail, products.discount as discount from products join categories on products.categoryId=categories.id where name in ('headphone','speaker') order by products.id desc limit 10";
                    // $appleAuthSql = "SELECT * FROM productdetails WHERE LOWER(brand) LIKE 'apple' LIMIT 20";
                    $prominentSpeakersHeadphonesQuery= mysqli_query($conn, $prominentSpeakersHeadphonesSql);
                    while($rowPsh=mysqli_fetch_array($prominentSpeakersHeadphonesQuery)){
                ?>
                    <li class="itemA list-none p-2 border rounded shadow-md relative hover:shadow">
                    <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowPsh['id'];?>">
                        <!-- <div> -->
                            <img src="<?php echo $rowPsh['thumbnail']; ?>" alt="This is a image" />
                            <p><?php echo $rowPsh['model']; ?></p>
                        <!-- </div> -->
                        <p><?php echo number_format($rowPsh['price']*(1-$rowPsh['discount'])); ?> ₫</p>
                <span class="text-sm line-through" <?php echo ($rowPsh['discount']>0)?"":"hidden"?>><?php echo number_format($rowPsh['price']);?> ₫</span>
                <span class="text-xs font-semibold" <?php echo ($rowPsh['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowPsh['discount']*100?>%</span>
                        <div class="divHidden absolute opacity-75">
                            <a href="pages/cart/workWithCart.php?id=<?php echo $rowPsh['id'];?>">
                                <p>Thêm giỏ hàng</p>
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
    <div class="phone appleReseller iPhoneBatteryReplacementAndRepair rounded mt-3.5"
    >
        <div class="inline-block rounded-tl-lg">
            THAY PIN IPHONE CHÍNH HÃNG VÀ SỬA CHỮA
        </div>
        <ul class="p-0 pt-2 m-0 flex flex-wrap justify-evenly">
            <?php 
            $iPhoneBatteryReplacementAndRepairSql = "
            SELECT products.id as id, products.model as model, products.price as price,
            products.thumbnail as thumbnail, products.discount as discount
            FROM products
            JOIN categories ON products.categoryId = categories.id
            JOIN brands ON products.brandId = brands.id
            WHERE categories.name IN ('pin', 'monitor') AND brands.brand LIKE 'Apple'
            ORDER BY products.createAt DESC
            LIMIT 15";
        
                // $appleAuthSql = "SELECT * FROM productdetails WHERE LOWER(brand) LIKE 'apple' LIMIT 20";
                $iPhoneBatteryReplacementAndRepairQuery= mysqli_query($conn, $iPhoneBatteryReplacementAndRepairSql);
                while($rowIb=mysqli_fetch_array($iPhoneBatteryReplacementAndRepairQuery)){
            ?>
                <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowIb['id'];?>">
                <li class="itemA list-none p-2 m-px my-1.5 border rounded shadow-md relative hover:shadow">
                    <img src="<?php echo $rowIb['thumbnail']; ?>" alt="This is a image" />
                    <p><?php echo $rowIb['model']; ?></p>
                    <p><?php echo number_format($rowIb['price']*(1-$rowIb['discount'])); ?> ₫</p>
                <span class="text-sm line-through" <?php echo ($rowIb['discount']>0)?"":"hidden"?>><?php echo number_format($rowIb['price']);?> ₫</span>
                <span class="text-xs font-semibold" <?php echo ($rowIb['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowIb['discount']*100?>%</span>
                    <div class="divHidden absolute opacity-75">
                        <a href="pages/cart/workWithCart.php?id=<?php echo $rowIb['id'];?>">
                            <p>Thêm giỏ hàng</p>
                        </a>
                    </div>
                </li>
                </a>
                
            <?php
                }
            ?>
        </ul>
    </div>
    <div>
    <img src="./assets/images/Ads/htc.png" class="mt-3" />
    </div>
    <div class="accessory rounded mt-3.5" >
        <div
            class="divAccessory inline-block rounded-tl-lg"
        >
            PHỤ KIỆN
        </div>
        <div
            class="itemAccessory flex flex-wrap justify-evenly"
        >
            <div>
                <img src="./assets/images/icons/storage.png" />
                <p>Thẻ nhớ - USB</p>
            </div>
            <div>
                <img src="./assets/images/icons/headphone.png" />
                <p>Tai nghe</p>
            </div>
            <div>
                <img src="./assets/images/icons/power-bank.png" />
                <p>Sạc dự phòng</p>
            </div>
            <div>
                <img src="./assets/images/icons/fan.png" />
                <p>Quạt Mini</p>
            </div>
            <div>
                <img src="./assets/images/icons/speaker.png" />
                <p>Loa</p>
            </div>
            <div>
                <img src="./assets/images/icons/charger.png" />
                <p>Củ sạc - Dây cáp</p>
            </div>
            <div>
                <img src="./assets/images/icons/apple-logo.png" />
                <p>Apple</p>
            </div>
            <div>
                <img src="./assets/images/icons/back-camera.png" />
                <p>Bao da - Ốp lưng</p>
            </div>
            <div>
                <img src="./assets/images/icons/smartphone.png" />
                <p>Dán màn hình</p>
            </div>
            <div>
                <img src="./assets/images/icons/gimbal.png" />
                <p>Tay cầm chống rung</p>
            </div>
        </div>
    </div>
    <div class="technologyNews rounded mt-3.5" >
    <div class="inline-block rounded-tl-lg">TIN CÔNG NGHỆ</div>
    </div>
    <div class="customerOfThaiLinh rounded mt-5">
        <div
            class="divCustomers inline-block rounded-tl-lg"
        >
            KHÁCH HÀNG CỦA THÁI LINH
        </div>
        <div id="carouselCustomer" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="itemCustomer flex">
                        <div class="divCustomer flex">
                            <img src="https://cdn.hoanghamobile.com/i/idol/Uploads/2022/03/01/vdv-nguyen-huy-hoang.jpg" />
                            <div>
                                <h5>Nguyễn Huy Hoàng</h5>
                                <h6>Vận động viên bơi lội</h6>
                                <p>
                                Với một vận động viên thể thao, Hoàng luôn ưu tiên việc chăm
                                sóc sức khoẻ bản thân. Lịch thi đấu dày đặc, nay Hoàng mới
                                có dịp quay trở lại cửa hàng công nghệ yêu thích - Hoàng Hà
                                Mobile chi nhánh quận 1, Tp.HCM để rinh về chiếc đồng hồ
                                </p>
                            </div>
                        </div>
                        <div class="divCustomer flex" >
                            <img src="https://cdn.hoanghamobile.com/i/idol/Uploads/2021/12/16/anh-cua-linh.jpg" />
                            <div>
                                <h5>VĐV Châu Tuyết Vân</h5>
                                <h6>VĐV Đội tuyển Teakwondo Việt Nam</h6>
                                <p>
                                Vân thấy giá bán ở Hoàng Hà Mobile tốt hơn các bên khác khá
                                nhiều, các sản phẩm cũng phong phú và đa dạng. Vân thường
                                qua shop để mua đồng hồ thông minh luyện tập thể thao hoặc
                                tablet.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="itemCustomer flex">
                        <div class="divCustomer flex">
                            <img src="https://cdn.hoanghamobile.com/i/idol/Uploads/2022/01/18/hhm00784ii.png" />
                            <div>
                                <h5>DV Huyền Lizzie</h5>
                                <h6>Diễn viên truyền hình</h6>
                                <p>
                                Huyền rất hay ghé Hoàng Hà Mobile mua các sản phẩm iPhone dù
                                không hẳn là một tín đồ công nghệ. Về giá cả, chất lượng và
                                độ uy tín thì Hoàng Hà đều mang lại cho mình sự hài lòng.
                                </p>
                            </div>
                        </div>
                        <div class="divCustomer flex">
                            <img src="https://cdn.hoanghamobile.com/i/idol/Uploads/2022/03/29/whatsapp-image-2022-03-28-at-5-36-16-pm.jpeg" />
                            <div>
                                <h5>Jun Vũ</h5>
                                <h6>Diễn viên</h6>
                                <p>
                                Các sản phẩm đến từ thương hiệu Apple luôn chiếm trọn niềm
                                yêu thích của mình từ cái nhìn đầu tiên. Và Hoàng Hà Mobile
                                là nơi Jun Vũ tin tưởng nhất để mua sắm, với hơn 100 chi
                                nhánh trên toàn quốc.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev z-0" type="button" data-bs-target="#carouselCustomer" 
            data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next z-0" type="button" data-bs-target="#carouselCustomer" 
            data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>




