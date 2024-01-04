<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./CSS/header.css">
</head>
<body>
  <div class="relative headers">
      <div aria-label="Top" class="px-4 sm:px-6 lg:px-8 head">
        <div class="border-b border-gray-200">
          <div class="flex h-16 items-center">
            <!-- Logo -->
            <div class="ml-4 flex lg:ml-0 logos">
              <a href="?quanly=home" class="no-underline">
                <div class="flex">
                  <img class="logo flex-none" src="./assets/images/logos/Store Logo.png" alt="" />
                  <p class="flex-1">
                    <span style="color: #0f6d68">THAILINH</span> STORE
                  </p>
                </div>
              </a>
            </div>
            <div class="ml-auto flex items-center">
              <!-- Search -->
              <?php
                
                $idUser = getSession('id');

                // Kiểm tra và khởi tạo $_SESSION['searchHistory'][$idUser]
                if (!isset($_SESSION['searchHistory'])) {
                  $_SESSION['searchHistory'] = [];
                }
                
                  if (!isset($_SESSION['searchHistory'][$idUser])) {
                    $_SESSION['searchHistory'][$idUser] = [];
                }
                
                // Kiểm tra và khởi tạo $_SESSION['search_'][$idUser]
                if (!isset($_SESSION['search_'])) {
                    $_SESSION['search_'] = [];
                }
                
                if (!isset($_SESSION['search_'][$idUser])) {
                    $_SESSION['search_'][$idUser] = [];
                }
                
                // Tiếp tục xử lý các thao tác khác
                if (isset($_POST['searchBtn'])) {
                    $key = $_POST['search'];
                
                    // Thêm giá trị vào $_SESSION['searchHistory'][$idUser]
                  // $_SESSION['searchHistory'][$idUser][] = $key;

                
                    // Thêm giá trị vào $_SESSION['search_'][$idUser]
                    $_SESSION['search_'][$idUser][] = $key;
                
                    header("location: http://localhost/ThaiLinhStore/?quanly=search");
                }
                
              ?>
              <form class="flex lg:ml-6" action="" method="post" id="searchForm">
                <div class="relative">
                  <input type="text" class="searchInput"
                  placeholder="Hôm nay bạn cần gì?"
                  name="search"
                  value=""
                  id="searchInput"
                  data-sql-input="model"
                  />
                  
                </div>
                <button class="p-2 searchButton" type="submit" name="searchBtn" id="searchBtn">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 searchIcon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                  </svg>
                </button>
              </form>
              <div id="onFocus" style="width:540px; max-height:350px; margin-left: 80px" class="absolute top-14 left-1/4 border rounded p-2 pt-2 bg-white z-50 shadow">
                    <div id="hSearch">
                      <?php include_once "./pages/onFocus.php";?>
                    </div>
                    <div style="overflow: auto; max-height: 330px;" class="suggestedProducts" id="suggestions">
                    <!-- <h6>Sản phẩm gợi ý</h6> -->
                          <!-- <ul class="p-0">
                            <li class="flex">
                              <img src="" alt="" class="w-16 mr-3" />
                              <div style="margin: auto 0; line-height: 1.4">
                                <p></p>
                                <p style="color: red"></p>
                              </div>
                            </li>
                          </ul> -->
                    </div>
              </div>
              

              <div class="checkOrder btn flex items-center p-2"
                  type="button" 
                  data-bs-toggle="offcanvas" 
                  data-bs-target="#offOrderCheck" 
                  aria-controls="offOrderCheck">
                <i
                  class="fa-solid fa-truck-fast fa-2x"
                  style="color: white"
                ></i>
                <p>Kiểm tra đơn hàng</p>
              </div>
              <div class="offcanvas offcanvas-end w-50 rounded" tabindex="-1" id="offOrderCheck" aria-labelledby="offOrderCheckLabel">
                  <div class="offcanvas-header headerCart">
                    <h5 class="offcanvas-title" id="offOrderCheckLabel">Kiểm tra đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <div class="offcanvas-body bodyCart">
                    <?php include_once "./pages/order/checkOrder.php";?>
                  </div>
                </div>

              <!-- Cart -->
              <div class="ml-1 flow-root lg:ml-6 groupC ">
                <button
                  class="btn flex items-center p-2 " 
                  type="button" 
                  data-bs-toggle="offcanvas" 
                  data-bs-target="#offcanvasExample" 
                  aria-controls="offcanvasExample"
                >
                  <!-- <a href="http://localhost/ThaiLinh%20Store/?quanly=cart" class="flex"> -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 cart">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <?php
                  // session_destroy();
                  $idUser=getSession('id');
                ?>
                  <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800 quantity">
                    <?php echo (isset($_SESSION['cart'][$idUser]))?totalQuantity($_SESSION['cart'][$idUser]):0;?>
                  </span>
                  <!-- </a> -->
                </button>
                <div class="offcanvas offcanvas-end w-50 rounded containerCart" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                  <div class="offcanvas-header headerCart">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Giỏ hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <div class="offcanvas-body bg-fixed bodyCart min-h-full flex flex-col justify-between pb-14 pt-0 pl-0 pr-0">
                    <div class="p-2">
                    <?php
                      include_once './pages/cart/cart.php';
                    ?>
                    </div>
                    <div class="flex footerCart">
                        <button class="flex-1">
                          <a href="./pages/cart/workWithCart.php?action=xoacart">
                            Xoá giỏ hàng
                          </a>
                        </button>
                        <button class="flex-1">
                          <a href="?quanly=order">
                            Đặt hàng
                          </a>
                        </button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <script>
    let searchInput=document.getElementById('searchInput');
    let onFocus=document.getElementById('onFocus');
    if(searchInput!=null && onFocus!=null){
      onFocus.style.display='none';
      searchInput.addEventListener('focus', function(){
        onFocus.style.display='block';
      });
      // Thêm một trình nghe sự kiện cho sự kiện 'mousedown' trên document
  document.addEventListener('mousedown', function (event) {
    // Kiểm tra xem sự kiện mousedown có xảy ra trong onFocus không
    if (onFocus.contains(event.target)) {
      // Nếu có, không ẩn onFocus
      return;
    }

    // Nếu không, ẩn onFocus
    onFocus.style.display = 'none';
  });
    }
  </script>
  <!-- <script>
    // Lấy phần tử input và nút tìm kiếm
    // var inputElement = document.getElementById("searchInput");
    var searchButton = document.getElementById("searchBtn");
    var searchForm = document.getElementById("searchForm");

    // Bắt sự kiện keydown cho input
    searchInput.addEventListener("keydown", function(event) {
        // Kiểm tra xem mã phím có phải là Enter (mã 13) không
        if (event.keyCode === 13) {
            // Gửi form khi nhấn Enter
            event.preventDefault(); // Tránh chuyển hướng
            searchForm.submit();
        }
    });

   
</script> -->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const suggestions = document.getElementById("suggestions");
    const hSearch = document.getElementById('hSearch');

    // Một số dữ liệu giả định, bạn có thể lấy từ máy chủ hoặc cơ sở dữ liệu
    // const mockData = [];
    $('#searchInput').keyup(function () {
      var txt=$('#searchInput').val();
      if(txt!==''){
        suggestions.style.display = "block";
      }
      if (txt==='') {
        // Nếu ô input rỗng, ẩn suggestions và hiển thị hSearch
        suggestions.style.display = "none";
        hSearch.style.display = "block";
      }
      if (suggestions.style.display === "block") {
            hSearch.style.display = "none";
        } else {
            hSearch.style.display = "block";
        }
      $.post('./pages/searchAjax.php', {data: txt}, function(data){
          $('#suggestions').html(data);
        })
        
    });
    
    // searchInput.addEventListener  ("input", function () {
    //     const query = searchInput.value.toLowerCase();
    //     // const sqlInput = searchInput.dataset.sqlInput;
       
    //     if (query.trim() === "") {
    //         // Nếu ô input rỗng, ẩn suggestions và hiển thị hSearch
    //         suggestions.style.display = "none";
    //         hSearch.style.display = "block";
    //     } else {
    //         // Thay thế %query% trong câu truy vấn SQL bằng giá trị nhập vào
    //         // const sqlSuggest = `SELECT * FROM products WHERE ${sqlInput} LIKE '%${query}%'`;
                
    //         // Gửi câu truy vấn SQL để lấy dữ liệu từ máy chủ và xử lý dữ liệu
    //         // (Dòng này chỉ là ví dụ, bạn cần sử dụng AJAX hoặc Fetch để gửi yêu cầu đến máy chủ)
    //         // const suggestionData = fetchDataFromServer(sqlSuggest);
    //         // Nếu ô input không rỗng, xử lý các gợi ý và hiển thị suggestions
    //         const filteredSuggestions = mockData.filter(item => item.toLowerCase().includes(query));
    //         displaySuggestions(filteredSuggestions);
    //     }
    // });
    

    // function displaySuggestions(suggestionArray) {
    //     if (suggestionArray.length > 0) {
          
    //         const h6=document.createElement('h6');
    //         h6.textContent="Sản phẩm gợi ý";
    //         const suggestionsList = document.createElement("ul");
    //         suggestionsList.classList.add('p-0');

    //         suggestionArray.forEach(item => {
    //             const listItem = document.createElement("li");
    //             listItem.classList.add('flex');

    //             // Tạo phần tử hình ảnh và đặt src (đường dẫn ảnh) cho nó
    //             const img = document.createElement('img');
    //             img.classList.add('w-16', 'mr-3');
    //             img.src = './assets/images/uploads/13-removebg-preview.webp';

    //             // Tạo phần tử div để chứa các phần tử văn bản
    //             const div = document.createElement('div');
    //             div.style.margin = "auto 0";
    //             div.style.lineHeight = "1.4";

    //             // Tạo phần tử văn bản cho tên sản phẩm
    //             const p1 = document.createElement('p');
    //             p1.textContent = item;

    //             // Tạo phần tử văn bản cho mô tả (màu đỏ)
    //             const p2 = document.createElement('p');
    //             p2.style.color = "red";
    //             p2.textContent = "Mô tả sản phẩm";

    //             listItem.addEventListener("click", function () {
    //                 searchInput.value = item;
    //                 suggestions.style.display = "none";
    //                 hSearch.style.display = "block";
    //             });

    //             suggestionsList.appendChild(listItem);
    //             listItem.appendChild(img);
    //             listItem.appendChild(div);
    //             div.appendChild(p1);
    //             div.appendChild(p2);
    //         });

    //         suggestions.innerHTML = "";
    //         suggestions.appendChild(h6);
    //         suggestions.appendChild(suggestionsList);
    //         suggestions.style.display = "block";
    //     } else {
    //         suggestions.style.display = "none";
    //     }

        
    // }

    document.addEventListener("click", function (event) {
        if (!event.target.matches("#searchInput")) {
            suggestions.style.display = "none";
        }
    });
});

</script>
</body>
</html>


