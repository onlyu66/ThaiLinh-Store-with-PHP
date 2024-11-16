<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple</title>
    <link rel="stylesheet" href="./CSS/apple.css">
</head>
<body>
<div>
    <div id="carouselExampleAutoplaying1" class="carousel slide mt-2" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img
                    class="d-block w-100 rounded"
                    src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/10/07/frame-3.png"
                    alt="First slide"
                />
            </div>
            <div class="carousel-item">
                <img
                    class="d-block w-100 rounded"
                    src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/09/12/iphone-14-pro-max-apc.png"
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
    </div>
    <!-- <div class="carouselPhone">
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
        <div class="itemAp list-none mt-2 p-2 m-px mx-3.5 my-1.5 border rounded shadow-md ">
            <img src="<?php echo $img ;?>" alt="This is a image" />
        </div>
        <?php
            }
        ?>
    </div> -->
    <div class="flex justify-evenly mt-1">
      <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/09/18/anhdoc-2.jpg;width=410" class ="rounded shadow-lg" width="380" alt="">
      <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/09/14/anhdoc-1.jpg;width=410" class ="rounded shadow-lg" width="380" alt="">
      <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/09/14/anhdoc-3.jpg;width=410" class ="rounded shadow-lg" width="380" alt="">
    </div>
    <div class="mt-3">
        <a href="http://localhost/ThaiLinhStore/?quanly=home">
            <span>
                <i class="fa-solid fa-house mr-1"></i>Home
            </span>
        </a>
        >
        <span class="text-teal-700 font-bold">
            Apple
        </span>
    </div>
    <div class="filter flex justify-evenly mt-2">
        <p>Lọc danh sách: </p>
        <ul class="flex justify-evenly m-0 z-50">
          <li>
            <div>
              <span>Danh mục</span>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <ul class="subCategory p-0 z-50">
              <li>
                <ul class="p-0">
                  <li>iPhone 11 series</li>
                </ul>
              </li>
              <li>
                <ul class="p-0">
                  <li>iPhone 12 series</li>
                </ul>
              </li>
              <li>
                <ul class="p-0">
                  <li>iPhone 13 series</li>
                </ul>
              </li>
              <li>
                <ul class="p-0">
                  <li>iPhone 14 series</li>
                </ul>
              </li>
              <li>
                <ul class="p-0">
                  <li>
                    iPhone 15 series
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <!-- {rangePrice ? (
              <div onClick={() => setRangePrice("">
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
            
            <ul class="subPrice p-0 z-50">
              <li>
                <ul class="p-0">
                  <li>
                    10 đến 12 triệu (0)
                  </li>
                </ul>
              </li>
              <li>
                <ul class="p-0">
                  <li>
                    12 đến 15 triệu (0)
                  </li>
                </ul>
              </li>
              <li>
                <ul class="p-0">
                  <li>
                    15 đến 20 triệu (0)
                  </li>
                </ul>
              </li>
              <li>
                <ul class="p-0">
                  <li>
                    20 đến 100 triệu (0)
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
      <h4 class="mt-2 font-bold text-2xl text-slate-700">Apple</h4>
      <ul class="p-0 pt-2 m-0 flex flex-wrap justify-evenly">
        <?php 
            $appleSql="select products.id as id, products.model as model, products.price as price,
            products.thumbnail as thumbnail, products.discount as discount from products inner join brands on products.brandId=brands.id where brand like 'Apple' order by createAt desc";
            $appleQuery= mysqli_query($conn, $appleSql);
            while($rowAp=mysqli_fetch_array($appleQuery)){
        ?>
            <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowAp['id'];?>">
            <li class="itemAp list-none p-2 m-px my-1.5 border rounded shadow-md relative hover:shadow">
                <img src="<?php echo $rowAp['thumbnail']; ?>" alt="This is a image" />
                <p><?php echo $rowAp['model']; ?></p>
                <p><?php echo number_format($rowAp['price']*(1-$rowAp['discount'])); ?> ₫</p>
                <span class="text-sm line-through" <?php echo ($rowAp['discount']>0)?"":"hidden"?>><?php echo number_format($rowAp['price']);?> ₫</span>
                <span class="text-xs font-semibold" <?php echo ($rowAp['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowAp['discount']*100?>%</span>
                <div class="divHiddenAp absolute opacity-75">
                  <a href="pages/cart/workWithCart.php?id=<?php echo $rowAp['id'];?>">
                    <p>Thêm giỏ hàng</p>
                  </a>
                </div>
            </li>
            </a>
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