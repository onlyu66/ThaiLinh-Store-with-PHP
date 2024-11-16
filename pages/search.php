<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sản phẩm</title>
    <link rel="stylesheet" href="./CSS/phone.css">
</head>
<body>
    <div style="min-height: 620px;" class="bg-gray-100 mt-2 p-2">
        <!-- <div id="carouselExampleAutoplaying1" class="carousel slide mt-2" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        class="d-block w-100 rounded"
                        src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/10/24/infinix-note-30-5g-01.jpg"
                        alt="First slide"
                    />
                </div>
                <div class="carousel-item">
                    <img
                        class="d-block w-100 rounded"
                        src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/10/25/web-v29e-03.jpg"
                        alt="First slide"
                    />
                </div>
            </div>
            <button class="carousel-control-prev z-0" type="button" data-bs-target="#carouselExampleAutoplaying1" 
                data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next z-0" type="button" data-bs-target="#carouselExampleAutoplaying1" 
                data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
        </div> -->
        <div class="carouselPhone">
            <?php 
                $imgs = array("https://cdn.hoanghamobile.com/i/cat/Uploads/2022/09/07/logoooooooooooooooo.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2020/11/30/samsung-logo-transparent.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/07/18/xiaomi-logo.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2020/09/14/brand%20(3).png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/06/02/tecno.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2020/09/14/brand%20(4).png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2020/09/14/brand%20(6).png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2020/11/30/vivo-logo.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/06/19/honor-logo-2022-svg.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/08/22/htc-new-logo-svg.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/05/26/infinix-logo-svg.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/06/12/rog.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2021/12/24/xorr.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2020/10/30/logo-masstel-4.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/06/02/tcl.png",
                "https://cdn.hoanghamobile.com/i/cat/Uploads/2023/08/02/logo-moi-ra-2.png");
                foreach ($imgs as $img) {
            ?>
            <div class="itemP list-none mt-2 p-2 m-px mx-3.5 my-1.5 border rounded shadow-md ">
                <img src="<?php echo $img ;?>" alt="This is a image" />
            </div>
            <?php
                }
            ?>
        </div>
        <div class="mt-2">
            <span>
                <a href="http://localhost/ThaiLinhStore/?quanly=home" class="no-underline">
                <i class="fa-solid fa-house mr-1"></i>Home
                </a>
            </span>
            >
            <span class="text-teal-700 font-bold">
                Tìm kiếm sản phẩm
            </span>
        </div>
        <div class="filter flex justify-evenly mt-2 " >
            <p>Lọc danh sách: </p>
            <ul class="flex justify-evenly m-0">
            <li>
                <div>
                <span>Danh mục</span>
                <i class="fa-solid fa-chevron-down"></i>
                </div>
                <ul class="subCategory p-0 z-50" >
                <li>
                    <ul class="p-0">
                    <a href="http://localhost/ThaiLinhStore/?quanly=apple"><li>Apple</li></a>
                    <li>Nokia</li>
                    <li>Infinix</li>
                    <li>TCL</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>Samsung</li>
                    <li>Realme</li>
                    <li>ROG</li>
                    <li>Itel</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>Xiaomi</li>
                    <li>Vivo</li>
                    <li>Nubia</li>
                    <li>Mới - Tin đồn</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>OPPO</li>
                    <li>HONOR</li>
                    <li>XOR</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>TECNO</li>
                    <li>HTC</li>
                    <li>Masstel</li>
                    </ul>
                </li>
                </ul>
            </li>
            <li>
                <!-- {brand ? (
                <div onClick={() => setBrand("" >
                    <i
                    class="fa-solid fa-circle-minus"
                    style={{ color: "#ff3333" }}
                    ></i>
                    <span
                    style={{ color: "#d10000", fontSize: "15px" }}
                    class="ml-1"
                    >
                    Thương hiệu:
                    </span>
                    <span class="font-bold ml-2">{brand}</span>
                </div>
                ) : ( -->
                <div>
                    <span>Thương hiệu</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                
                <ul class="subBrand p-0 z-50" >
                <li>
                    <ul class="p-0">
                    <li>Samsung (0)</li>
                    <li>Vivo (0)</li>
                    <li>Itel (0)</li>
                    <li>Philips (0)</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>Apple (0)</li>
                    <li>Nokia (0)</li>
                    <li>HONOR (0)</li>
                    <li>Asus (0)</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>Xiaomi (0)</li>
                    <li>Realme (0)</li>
                    <li>XOR (0)</li>
                    <li>Huawei (0)</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>OPPO (0)</li>
                    <li>TCL (0)</li>
                    <li>Nubia (0)</li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>TECNO (0)</li>
                    <li>Infinix (0)</li>
                    <li>HTC (0)</li>
                    </ul>
                </li>
                </ul>
            </li>
            <li>
                <!-- {rangePrice ? (
                <div onClick={() => setRangePrice("" >
                    <i
                    class="fa-solid fa-circle-minus"
                    style={{ color: "#ff3333" }}
                    ></i>
                    <span
                    style={{ color: "#d10000", fontSize: "15px" }}
                    class="ml-1"
                    >
                    Giá:
                    </span>
                    <span style={{ fontSize: "16px" }} class="font-bold ml-1">
                    {rangePrice}
                    </span>
                </div>
                ) : ( -->
                <div>
                    <span>Giá</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                
                <ul class="subPrice p-0 z-50" >
                <li>
                    <ul class="p-0">
                    <li>
                        Dưới 1 triệu (0)
                    </li>
                    <li>
                        5 đến 6 triệu (0)
                    </li>
                    <li>
                        15 đến 20 triệu (0)
                    </li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>
                        1 đến 2 triệu (0)
                    </li>
                    <li>
                        6 đến 8 triệu (0)
                    </li>
                    <li>
                        20 đến 100 triệu (0)
                    </li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>
                        2 đến 3 triệu (0)
                    </li>
                    <li>
                        8 đến 10 triệu (0)
                    </li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>
                        3 đến 4 triệu (0)
                    </li>
                    <li>
                        10 đến 12 triệu (0)
                    </li>
                    </ul>
                </li>
                <li>
                    <ul class="p-0">
                    <li>
                        4 đến 5 triệu (0)
                    </li>
                    <li>
                        12 đến 15 triệu (0)
                    </li>
                    </ul>
                </li>
                </ul>
            </li>
            <li>
                <div>
                <span>Bluetooth</span>
                <i class="fa-solid fa-chevron-down"></i>
                </div>
            </li>
            <li>
                <div>
                <span>Độ phân giải</span>
                <i class="fa-solid fa-chevron-down"></i>
                </div>
            </li>
            <li>
                <div>
                <span>Kích thước màn hình</span>
                <i class="fa-solid fa-chevron-down"></i>
                </div>
            </li>
            <li>
                <div>
                <span>RAM</span>
                <i class="fa-solid fa-chevron-down"></i>
                </div>
            </li>
            <li>
                <div>
                <span>Sắp xếp</span>
                <i class="fa-solid fa-chevron-down"></i>
                </div>
                <ul class="subSort p-0 z-50" >
                <li>
                    <ul class="p-0">
                    <li>
                        Mặc định
                    </li>
                    <li>
                        Giá thấp đến cao
                    </li>
                    <li>
                        Giá cao đến thấp
                    </li>
                    </ul>
                </li>
                </ul>
            </li>
            </ul>
        </div>
        <h4 class="mt-2 font-bold text-2xl text-slate-700">Kết quả tìm kiếm</h4>
        <?php
            // include_once "./pages/session_handler.php";

            $idUser=getSession('id');
            
            $keys=array_reverse($_SESSION['search_'][$idUser]);
            // echo "<pre>";
            // var_dump($keys);
            // echo "</pre>";
        ?>
            <?php 
                if(isset($_GET['key'])){
                    // if (isset($_SESSION['searchHistory'])){
                    //     $_SESSION['searchHistory'][$idUser][]=$_GET['key'];
                    // }else{
                    //     $_SESSION['searchHistory'] = [];
                    // }

                    $key=$_GET['key'];
                    $phoneSql="select products.id as id, products.model as model, products.price as price,
                    products.thumbnail as thumbnail from products join categories on products.categoryId = categories.id
                    where model like '%$key%' order by createAt desc";
                    
                }else{
                    if(count($keys)>0){
                        for($i=0;$i<count($keys);$i++){
                            $phoneSql="select products.id as id, products.model as model, products.price as price,
                            products.thumbnail as thumbnail from products join categories on products.categoryId = categories.id
                            where model like '%$keys[$i]%' order by createAt desc";
                            if($i==0){
                                $key=$keys[$i];
                                break;
                            }
                        }
                    }
                }
                if (!isset($_SESSION['searchHistory'])) {
                    $_SESSION['searchHistory'] = [];
                }
                
                if (!isset($_SESSION['searchHistory'][$idUser])) {
                    $_SESSION['searchHistory'][$idUser] = [];
                }
                $_SESSION['searchHistory'][$idUser][] = $key;


                if (!isset($_SESSION['search'])){
                    $_SESSION['search'] = [];
                }
                if(isset($_SESSION['search'][$key])) {
                    // Nếu tồn tại, tăng giá trị 'quantity' lên 1
                    $_SESSION['search'][$key]['quantity'] += 1;
                } else {
                    // Nếu không tồn tại, thêm mới vào $_SESSION['search'][$idUser]
                    $_SESSION['search'][$key] = ['key' => $key, 'quantity' => 1];
                }
    
                  

                $rowsP=select($phoneSql,false);
        ?>
        <p class="ml-2">Từ khoá: "<?php echo htmlspecialchars($key); ?>"</p>

        <ul class="p-0 pt-2 m-0 flex flex-wrap justify-evenly">

        <?php
                if(count($rowsP)>0){
                foreach($rowsP as $rowP){
        ?>
                <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowP['id'];?>">
                <li class="itemP list-none p-2 m-px my-1.5 border rounded shadow-md relative hover:shadow">
                    <img src="<?php echo $rowP['thumbnail']; ?>" alt="This is a image" />
                    <p><?php echo $rowP['model']; ?></p>
                    <p><?php echo number_format($rowP['price']); ?> ₫</p>
                    <div class="absolute opacity-75 divHiddenP">
                        <a href="./pages/cart/workWithCart.php?id=<?php echo $rowP['id'];?>">
                            <p>Thêm giỏ hàng</p>
                        </a>
                    </div>
                </li>
                </a>
            <?php
                }
            }else{
                ?>
                    <div class="mt-4">
                        <img src="./assets/images/icons/search.png" alt="">
                        <p class="mt-2">Không tìm thấy sản phẩm!</p>
                    </div>
                <?php
            }
                
            ?>
        </ul>
        
        <!-- <Pagination
            style={{ display: "flex", justifyContent: "center" }}
            class="mt-2"
        >
            <Pagination.Prev onClick={handlePrev} />
            {pages.map((_p) => (
            <Pagination.Item
                key={_p}
                active={_p === currentPage}
                onClick={() => handleCurrentPage(_p 
            >
                {_p}
            </Pagination.Item>
            ) 

            <Pagination.Next onClick={handleNext} />
        </Pagination> -->
    </div>
</body>
</html>