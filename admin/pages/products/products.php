<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="styles/products.css">
</head>

<body>
<div >
    <?php
      include_once "../untils/utility.php";
      // session_start();
      $sort = isset($_SESSION["sort"]) ? $_SESSION["sort"] : "id";
      // echo $sort;
    ?>
      <div class="sortAdd flex justify-between">
        <form class="sort" method="post" action="">
          <select name="sort" id="selectSort">
            <option value="id" <?php if ($sort == "id") echo "selected"; ?>>Lastest</option>
            <option value="model" <?php if ($sort == "model") echo "selected"; ?>>Name</option>
            <option value="price" <?php if ($sort == "price") echo "selected"; ?>>Price</option>
            <option value="stockQuantity" <?php if ($sort == "stockQuantity") echo "selected"; ?>>Quantity</option>
          </select>
        </form>
        <div>
            <!-- {selectProduct ? "Update Product" : "Add Product"} -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary button !bg-neutral-900 !text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Product
            </button>

            <!-- Modal -->
            <?php include_once "addProduct.php" ?>
            <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
              <?php include_once "editProduct.php" ?>
            </div>
            <div class="modal fade" id="viewProduct" tabindex="-1" aria-labelledby="viewProductLabel" aria-hidden="true">
              <?php include_once "viewProduct.php" ?>
            </div>



        </div>
      </div>
      <div style ="overflow: auto; max-height: 750px ">
        <table
          class="table table-striped table-hover text-center"
          style="width: 80%;  margin: 20px auto"
        >
          <thead class="table-dark" >
            <tr>
              <th class="bg-neutral-900 text-white">STT</th>
              <th class="bg-neutral-900 text-white">Image</th>
              <th class="bg-neutral-900 text-white">Name</th>
              <th class="bg-neutral-900 text-white">Price</th>
              <th class="bg-neutral-900 text-white">Discount</th>
              <th class="bg-neutral-900 text-white">Quantity</th>
              <th class="bg-neutral-900 text-white" colspan="3">
                Action
              </th>
            </tr>
          </thead>
          
          <?php
            if($sort=="model"){
              $productsSql="SELECT * FROM products ORDER BY model";
            }else if($sort== "price"){
              $productsSql="SELECT * FROM products ORDER BY price";
            }else if($sort== "stockQuantity"){
              $productsSql="SELECT * FROM products ORDER BY stockQuantity DESC";
            }else{
              $productsSql="SELECT * FROM products ORDER BY id DESC";
            }
            // $queryProducts=mysqli_query($conn, $productsSql);
            $products = select($productsSql,false);
            // $_SESSION['products'][]=array('id'=>$products['id'],'categoryId'=>$products['categoryId'],'brandId'=>$products['brandId'],'model'=>$products['model'],'price'=>$products['price'],'discount'=>$products['discount'],'thumbnail'=>$products['thumbnail'],'description'=>$products['description'],'createAt'=>$products['createAt'],'updateAt'=>$products['updateAt'],'stockQuantity'=>$products['stockQuantity'],'deleted'=>$products['deleted']);
            // $_SESSION['products']=$products;
            // $arr=getSession('products');
            // unset($_SESSION['products'])
            
          ?>
            <tbody>
              <form action="" method="post">
              <?php
                // if(isset($_SESSION['products'])){
                // $id=0;
                if(count($products)>0){
                $i=0;
                foreach ($products as $product) {
                $i++;
              ?>
              <tr id="<?php echo $product['id'];?>">
                <td><?php echo $i; ?></td>
                <td>
                  <img src=".<?php echo $product['thumbnail'];?>" alt="this is a image" class="rounded-lg shadow-sm"/>
                </td>
                <td><?php echo $product['model'];?></td>
                <td><?php echo number_format($product['price'],0,'.',',');?></td>
                <td><?php echo $product['discount']*100;?>%</td>
                <td><?php echo $product['stockQuantity'];?></td>
                <td>
                  <button 
                    type="submit"
                    class="btn btn-outline-info view"
                    data-bs-toggle="modal" data-bs-target="#viewProduct"
                  >
                    View
                  </button>
                  <!-- <ConfigProvider>
                    <Popover
                      placement="right"
                      content={<ViewProduct selectProduct={selectProduct} />}
                      trigger="click"
                    >
                      <button
                        type="button"
                        class="btn btn-outline-info"
                      >
                        View
                      </button>
                    </Popover>
                  </ConfigProvider> -->
                </td>
                <input type="hidden" value="<?php echo $product['id'] ;?>" class="id">
                <td>
                  <button
                    type="submit"
                    class="btn btn-outline-warning edit"
                    data-bs-toggle="modal" data-bs-target="#editProduct"
                    name="edit"
                  >
                    Edit
                  </button>
                </td>
                <td>
                    <button
                      type="button"
                      class="btn btn-outline-danger delete"
                      name="delete"
                    >
                      Delete
                    </button>
                </td>
              </tr>
            <?php
                  }
                }else{

            ?>
                  <!-- <div>trống</div> -->

            <?php
                } 

            ?>
            
            <!-- if(isset($_POST['deleted'])){
              $deleted=$_POST['an'];
              if($deleted=='on'){
                $a=0;
              }else{
                $a=1;
              }
              // echo $deleted;
              $sqlDel="update products set deleted = '$a' where id='$product[id]'";
              iud($sqlDel);
            } -->
            </form>
            </tbody>
          <tfoot>
            <!-- <tr>
              <td colSpan={8}>
                <Pagination style={{ display: "flex", justifyContent: "center" }}>
                  <Pagination.Prev onClick={handlePrev} />
                  {pages.map((_p) => (
                    <Pagination.Item
                      key={_p}
                      active={_p === currentPage}
                      onClick={() => handleCurrentPage(_p)}
                    >
                      {_p}
                    </Pagination.Item>
                  ))}

                  <Pagination.Next onClick={handleNext} />
                </Pagination>
              </td>
            </tr> -->
          </tfoot>
        </table>
      </div>
      
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    $('.edit').click(function(){
        // Lấy giá trị của phần tử có lớp '.id'
        let id = $(this).closest('tr').find('.id').val();

        // Gửi yêu cầu AJAX để lấy dữ liệu từ editProduct.php
        $.post('./pages/products/editProduct.php', {id: id}, function(data){
            // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
            $('#editProduct').html(data);
        });
        return false;
    });
    $('.view').click(function(){
        // Lấy giá trị của phần tử có lớp '.id'
        let id = $(this).closest('tr').find('.id').val();

        // Gửi yêu cầu AJAX để lấy dữ liệu từ editProduct.php
        $.post('./pages/products/viewProduct.php', {id: id}, function(data){
            // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
            $('#viewProduct').html(data);
        });
        return false;
    });
    $('.delete').click(function(){
    // Lấy giá trị của phần tử có lớp '.id'
        let id = $(this).closest('tr').find('.id').val();

    // Gửi yêu cầu AJAX để xóa dữ liệu
    $.post('./pages/products/handleProduct.php', {delete: id}, function(data){
        // Hiển thị thông báo hoặc thực hiện các xử lý khác nếu cần

        // Tải lại trang sau khi xóa thành công
        location.reload();
    });

    // Ngăn chặn các hành động mặc định của nút hoặc liên kết
    return false;
  });

  $('#selectSort').change(function(){
    let sort=$(this).val();
    $.post('./pages/products/handleProduct.php', {sort: sort}, function(data){
        // Hiển thị thông báo hoặc thực hiện các xử lý khác nếu cần
        // alert(sort);
        $('#divP').html(data);
        // Tải lại trang sau khi xóa thành công
        location.reload();
    });
    return false;
  })


</script>



    
</body>
</html>