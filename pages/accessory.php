<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phụ kiện</title>
    <link rel="stylesheet" href="./CSS/accessory.css">  
</head>
<body>
  <div>
    <div class="flex justify-center mt-4 mb-4 expAccessory">
        <div class="mx-2">
            <img src="assets/images/icons/headphone1.png" class="my-0 mx-auto" width="50px" alt="">
            <p class="text-center">Tai nghe</p>
        </div>
        <div class="mx-2">
            <img src="assets/images/icons/accumulator.png" class="my-0 mx-auto" width="50px" alt="">
            <p class="text-center">Sạc dự phòng</p>
        </div>
        <div class="mx-2">
            <img src="assets/images/icons/flash-drive.png" class="my-0 mx-auto" width="50px" alt="">
            <p class="text-center">Thẻ nhớ - USB</p>
        </div>
        <div class="mx-2">
            <img src="assets/images/icons/speaker1.png" class="my-0 mx-auto" width="50px" alt="">
            <p class="text-center">Loa</p>
        </div>
        <div class="mx-2">
            <img src="assets/images/icons/phone-charger.png" class="my-0 mx-auto" width="50px" alt="">
            <p class="text-center">Củ sạc - Dây cáp</p>
        </div>
    </div>
    <div class="mt-2">
        <span>
            <a href="http://localhost/ThaiLinhStore/?quanly=home" class="no-underline">
            <i class="fa-solid fa-house mr-1"></i>Home
            </a>
        </span>
        >
        <span class="text-teal-700 font-bold">
            Phụ kiện
        </span>
    </div>
      <div class="filter flex justify-evenly mt-2" >
        <p>Lọc danh sách: </p>
        <ul class="flex justify-evenly m-0 z-10">
          <li>
            <div>
              <span>Danh mục</span>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <ul class="subCategory p-0" >
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
             
            <ul class="subBrand p-0" >
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
             
            <ul class="subPrice p-0" >
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
            <ul class="subSort p-0" >
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
      <div class="prominentAccessory rounded mt-3.5">
            <div class="prominentAccessoryDiv inline-block rounded-tl-lg">
                TOP SẢN PHẨM BÁN CHẠY
            </div>
            <ul class="p-0 pt-2 m-0 ">
                <div class="mayBeLike">
                    <?php 
                        $promineAccessorySql="select products.id as id, products.model as model, products.price as price,
                        products.thumbnail as thumbnail, products.discount as discount from products join categories on products.categoryId=categories.id where name in ('headphone','speaker','pin','monitor','fan','charger-cable','storage-usb','phoneCase','backupCharger','screenProtector','balo','handBag','shockproofBag') order by createAt desc limit 10";
                        $promineAccessoryQuery= mysqli_query($conn, $promineAccessorySql);
                        while($rowPa=mysqli_fetch_array($promineAccessoryQuery)){
                    ?>
                    <li class="itemAcc list-none p-2 border rounded shadow-md relative hover:shadow">
                    <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowPa['id'];?>">
                        <img src="<?php echo $rowPa['thumbnail']; ?>" alt="This is a image" />
                        <p><?php echo $rowPa['model']; ?></p>
                        <p><?php echo number_format($rowPa['price']*(1-$rowPa['discount'])); ?> ₫</p>
                        <span class="text-sm line-through" <?php echo ($rowPa['discount']>0)?"":"hidden"?>><?php echo number_format($rowPa['price']);?> ₫</span>
                        <span class="text-xs font-semibold" <?php echo ($rowPa['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowPa['discount']*100?>%</span>
                        <div class=" absolute opacity-75 divHiddenAcc">
                            <a href="pages/cart/workWithCart.php?id=<?php echo $rowPa['id'];?>">
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
      <h4 class="mt-2 font-bold text-2xl text-slate-700">Phụ kiện</h4>
      <ul class="p-0 pt-2 m-0 flex flex-wrap justify-evenly">
        <?php 
            $accessorySql="select products.id as id, products.model as model, products.price as price,
            products.thumbnail as thumbnail, products.discount as discount from products join categories on products.categoryId=categories.id where name in ('headphone','speaker','pin','monitor','fan','charger-cable','storage-usb','phoneCase','backupCharger','screenProtector','balo','handBag','shockproofBag') order by createAt desc";
            $accessoryQuery= mysqli_query($conn, $accessorySql);
            while($rowAcc=mysqli_fetch_array($accessoryQuery)){
        ?>
            <li class="itemAcc list-none p-2 m-px my-1.5 border rounded shadow-md relative hover:shadow">
            <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=<?php echo $rowAcc['id'];?>">
                <img src="<?php echo $rowAcc['thumbnail']; ?>" alt="This is a image" />
                <p><?php echo $rowAcc['model']; ?></p>
                <p><?php echo number_format($rowAcc['price']*(1-$rowAcc['discount'])); ?> ₫</p>
                <span class="text-sm line-through" <?php echo ($rowAcc['discount']>0)?"":"hidden"?>><?php echo number_format($rowAcc['price']);?> ₫</span>
                <span class="text-xs font-semibold" <?php echo ($rowAcc['discount']>0)?"":"hidden"?>>Giảm <?php echo $rowAcc['discount']*100?>%</span>
                <div class="divHiddenAcc absolute opacity-75">
                  <a href="pages/cart/workWithCart.php?id=<?php echo $rowAcc['id'];?>">
                    <p>Thêm giỏ hàng</p>
                  </a>
                </div>
            </a>
            </li>
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