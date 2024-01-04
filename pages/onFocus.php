<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./CSS/onFocus.css">
</head>
<body>
    <div>

        
        <?php
            // include_once "./pages/session_handler.php";

                
            if (isset($_POST['xoa'])) {
                $key = $_POST['keyXoa'];
            
                if (count($_SESSION['searchHistory'][$idUser]) > 0) {
                    foreach ($_SESSION['searchHistory'][$idUser] as $index => $searchItem) {
                        if ($searchItem == $key) {
                            unset($_SESSION['searchHistory'][$idUser][$index]);
                            break; // Kết thúc vòng lặp sau khi xóa
                        }else{
                            $_SESSION['searchHistory'][$idUser][$index]=$searchItem;
                        }
                    }
                }else{
                    $_SESSION['searchHistory'][$idUser]=[];
                }
            }
            if(isset($_POST['deleteAll'])){
                unset($_SESSION['searchHistory'][$idUser]);
            }
            
            // echo "<pre>";
            // var_dump($_SESSION['searchHistory']);
            // echo "</pre>";
        ?>
        <form style="overflow: auto; max-height: 330px" action="" method="post">
          <img src="https://hoanghamobile.com/Uploads/2023/10/31/web-htc-wildfire-e3-lite-03.jpg" style="width: 98%; margin: 10px auto;"/>
            <div>
              <button type="submit" name="deleteAll" style="font-size:15px; color: red; margin-left:350px; cursor: pointer;">
                <i class="fa-solid fa-trash mr-1" style="color: #ff0000"  ></i>
                <span>Xoá lịch sử tìm kiếm</span>
              </button>
              
              <div class="history ml-3 my-1" >
                  <ul>
                    <?php
                        $idUser=getSession('id');
                        if(isset($_SESSION['searchHistory'][""])){
                          $arr_=$_SESSION['searchHistory'][""];
                        }else{
                          $arr_=[];
                        }
                        
                        if(isset($_SESSION['id'])){
                            if(isset($_SESSION['searchHistory'][$idUser])){
                                foreach ($arr_ as $value) {
                                  $_SESSION['searchHistory'][$idUser][]=$value;
                                }
                                unset($_SESSION['searchHistory'][""]);
                                $arr=$_SESSION['searchHistory'][$idUser];
                            }else{
                              $arr=[];
                            }
                            
                            // echo "<pre>";
                            // var_dump($_SESSION['cart']);
                            // echo "</pre>";
                        }else{
                          $arr=$arr_;
                        }
                        
                        if(isset($_SESSION['searchHistory'][$idUser])){
                            $arr = array_reverse($_SESSION['searchHistory'][$idUser]);
                            $arrs=array_slice($arr, 0, 3);
                        foreach($arrs as $key){
                    ?>
                    <li style="font-size:15px; display: flex" >
                      <i class="fa-solid fa-clock-rotate-left " style="color:#828282; flex:1; margin: auto 0;" ></i>
                      <a href="?quanly=search&key=<?php echo $key;?>" style=" margin-top: 20px; cursor: pointer; flex:3; margin: auto 0;" >
                        <?php echo $key?>
                      </a>
                      <input type="hidden" name="keyXoa" value="<?php echo $key;?>">
                      <button type="submit" name="xoa" style="flex:1" >
                        X
                      </button>
                    </li>
                    <?php
                        }
                        }else{
                            $_SESSION['searchHistory'][$idUser]=[];
                        }
                    ?>
                  </ul>
              </div>
              <?php 
                if(isset($_SESSION['search'])){
                    uasort($_SESSION['search'], function ($a, $b) {
                        return $b['quantity'] - $a['quantity'];
                    });
                    $hotSearchs = array_slice($_SESSION['search'], 0, 6);
                }else{
                    $hotSearchs=[];
                }
                // echo "<pre>";
                // var_dump($hotSearchs);
                // echo "</pre>";
              ?>
              <div>
                <div class="flex mt-3">
                  <h5 class="ml-2 mr-1 font-bold" style="color:#ffa200">
                    Xu hướng tìm kiếm
                  </h5>
                  <i class="fa-solid fa-fire mb-1" style="color:#ffa200; margin: auto 0"></i>
                </div>
                <ul class="flex justify-around py-2 px-3 m-0 mt-2 hotSearch">
                  <li class="mr-1">
                    <ul class="p-0 m-0">
                        <?php
                            $i=0;
                            foreach($hotSearchs as $hotSearch){
                                $i++;
                                if($i<4){
                        ?>
                            <a href="?quanly=search&key=<?php echo $hotSearch['key'];?>"><li class="pb-1 text-sm"><?php echo $hotSearch['key'];?></li></a>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                    
                  </li>
                  <li class="ml-1">
                  <ul class="p-0 m-0">
                        <?php
                            $j=0;
                            foreach($hotSearchs as $hotSearch){
                                $j++;
                                if($j>3){
                        ?>
                            <a href="?quanly=search&key=<?php echo $hotSearch['key'];?>"><li class="pb-1 text-sm"><?php echo $hotSearch['key'];?></li></a>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
        </form>
    </div>
    
</body>
</html>