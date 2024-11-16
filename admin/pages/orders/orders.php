<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="styles/orders.css">
    
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
            <option value="orderDate" <?php if ($sort == "orderDate") echo "selected"; ?>>orderDate</option>
            <option value="totalMoney" <?php if ($sort == "totalMoney") echo "selected"; ?>>totalMoney</option>
            <option value="deliveryMethod" <?php if ($sort == "deliveryMethod") echo "selected"; ?>>deliveryMethod</option>
          </select>
        </form>
        <div>
            <!-- {selectProduct ? "Update Product" : "Add Product"} -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary button !bg-neutral-900 !text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" hidden>
            Add Product
            </button>

            <!-- Modal -->
            <div class="modal fade" id="viewOrder" tabindex="-1" aria-labelledby="viewOrderLabel" aria-hidden="true">
              <?php include_once "viewOrder.php";?>
            </div>



        </div>
      </div>
      <div style ="overflow: auto; max-height: 750px ">
        <table
          class="table table-striped table-hover text-center"
          style="width: 80%;  margin: 20px auto 10px auto"
        >
          <thead class="table-dark" >
            <tr>
              <th class="bg-neutral-900 text-white">                    
                <input type="checkbox" name="comfirmOrder" id="selectAll"/>
                </th>
              <th class="bg-neutral-900 text-white">Order ID</th>
              <th class="bg-neutral-900 text-white">Status</th>
              <th class="bg-neutral-900 text-white">Order Amount</th>
              <th class="bg-neutral-900 text-white">Delivery Method</th>
              <th class="bg-neutral-900 text-white">Confirmation Deadline</th>
              <th class="bg-neutral-900 text-white" colspan="3">
                Action
              </th>
            </tr>
          </thead>
          
          <?php
            if($sort=="orderDate"){
              $ordersSql="
              SELECT 
              orders.orderCode as orderCode, orders.status as status, 
              orders.totalMoney as totalMoney, orders.deliveryMethod as deliveryMethod,
              orders.orderDate, status.name as status, orders.id as id
              FROM orders 
              join status on orders.status=status.id
              join deliveryMethod on orders.deliveryMethod=deliverymethod.id 
              ORDER BY orders.orderDate";
            }else if($sort== "totalMoney"){
              $ordersSql="
              SELECT orders.orderCode as orderCode, orders.status as status, 
              orders.totalMoney as totalMoney, orders.deliveryMethod as deliveryMethod,
              orders.orderDate, status.name as status, orders.id as id 
              FROM orders 
              join status on orders.status=status.id 
              join deliveryMethod on orders.deliveryMethod=deliverymethod.id 
              ORDER BY orders.totalMoney";
            }else if($sort== "deliveryMethod"){
              $ordersSql="
              SELECT orders.orderCode as orderCode, orders.status as status, 
              orders.totalMoney as totalMoney, orders.deliveryMethod as deliveryMethod,
              orders.orderDate, status.name as status, orders.id as id 
              FROM orders 
              join status on orders.status=status.id 
              join deliveryMethod on orders.deliveryMethod=deliverymethod.id 
              ORDER BY orders.deliveryMethod DESC";
            }else{
              $ordersSql="
              SELECT orders.orderCode as orderCode, orders.status as statusId, 
              orders.totalMoney as totalMoney, deliverymethod.name as deliveryMethod,
              orders.orderDate, status.name as status, orders.id as id 
              FROM orders 
              join status on orders.status=status.id 
              join deliveryMethod on orders.deliveryMethod=deliverymethod.id 
              ORDER BY orders.id DESC";
            }
            // $queryProducts=mysqli_query($conn, $ordersSql);
            $orders = select($ordersSql,false);
            // $_SESSION['orders'][]=array('id'=>$orders['id'],'categoryId'=>$orders['categoryId'],'brandId'=>$orders['brandId'],'orderDate'=>$orders['orderDate'],'totalMoney'=>$orders['totalMoney'],'status'=>$orders['status'],'orderCode'=>$orders['orderCode'],'description'=>$orders['description'],'createAt'=>$orders['createAt'],'updateAt'=>$orders['updateAt'],'deliveryMethod'=>$orders['deliveryMethod'],'deleted'=>$orders['deleted']);
            // $_SESSION['orders']=$orders;
            // $arr=getSession('orders');
            // unset($_SESSION['orders'])
            
          ?>
            <tbody>
              <form action="" method="post">
              <?php
                // if(isset($_SESSION['orders'])){
                // $id=0;
                $maxAge = strtotime('-1 minute');

                // Xây dựng truy vấn xóa
                $sql = "DELETE FROM orders WHERE (orderDate < '$maxAge' and status='1')";
                
                // Thực hiện truy vấn xóa
                if ($conn->query($sql) === TRUE) {
                    // echo "Đã xóa các đơn hàng đã quá 1 phút thành công.";
                    iud($sql);
                } else {
                    echo "Lỗi khi xóa đơn hàng: " . $conn->error;
                }
              
                if(count($orders)>0){
                $i=0;
                foreach ($orders as $order) {
                $i++;
              ?>
              <tr>
                <td>
                    <input type="checkbox" name="comfirmOrder[]" class="checkbox" value="<?php echo $order['orderCode']?>">
                </td>
                <td class="text-sm"><?php echo $order['orderCode'];?></td>
                <td class="text-sm"><?php echo $order['status'];?></td>
                <td class="text-sm"><?php echo number_format($order['totalMoney'],0,'.',',');?></td>
                <td class="text-sm"><?php echo $order['deliveryMethod'];?></td>
                <td class="text-sm" id="countdownTimer"><?php include_once "countdown.php"; echo ($order['statusId']!=1)?"Confirmed!":countdownToThreeDays($order['orderDate']);?></td>
                <td >
                  <button 
                    type="submit"
                    class="btn btn-outline-info view text-sm"
                    data-bs-toggle="modal" data-bs-target="#viewOrder"
                  >
                    View
                  </button>
                </td>
                <input type="hidden" value="<?php echo $order['orderCode'] ;?>" class="id">
                <td>
                  <button
                    type="submit"
                    class="btn btn-outline-success confirm text-sm"
                    name="confirm"
                    <?php echo ($order['statusId']!=1)?"hidden":"";?>
                  >
                    Confirm
                  </button>
                </td>
                <td>
                    <button
                      type="button"
                      class="btn btn-outline-danger delete text-sm"
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
              $sqlDel="update orders set deleted = '$a' where id='$order[id]'";
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
        <div style="margin-left:125px;">
        <button class="btn btn-outline-danger text-sm">Delete Selected Items</button>
        <button class="btn btn-outline-success text-sm confirmSelectedItems">Confirm Selected Items</button>
        </div>
      </div>
      
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
//       function updateCountdownTimer() {
//     // Sử dụng AJAX để gửi yêu cầu lấy thời gian đếm ngược từ máy chủ
//     $.ajax({
//         url: 'countdown.php', // Thay đổi thành URL của script máy chủ của bạn
//         method: 'GET',
//         success: function(response) {
//             // Cập nhật nội dung của thẻ div
//             $('#countdownTimer').text(response);
//         },
//         error: function(error) {
//             console.error('Lỗi khi lấy thời gian đếm ngược từ máy chủ:', error);
//         }
//     });
// }

// // Cập nhật thời gian mỗi giây
// setInterval(updateCountdownTimer, 1000);

// // Gọi hàm để cập nhật thời gian lần đầu tiên
// updateCountdownTimer();
      $('.confirmSelectedItems').click(function(){
    // Lấy giá trị của các checkbox đã chọn
    let arrId = $('input[name="confirmOrder[]"]:checked').map(function(){
        return $(this).val();
    }).get();

    // Gửi yêu cầu AJAX để xác nhận các ID đã chọn
    $.post('./pages/orders/handleOrder.php', {confirms: arrId}, function(data){
        // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
        // $('#confirmOrder').html(data);

        // Hiển thị mảng id
        alert(arrId);

        // location.reload();
    });

    // Ngăn chặn sự kiện mặc định
    return false;
});


        $('.confirm').click(function(){
        // Lấy giá trị của phần tử có lớp '.id'
        let id = $(this).closest('tr').find('.id').val();
        

        // Gửi yêu cầu AJAX để lấy dữ liệu từ editProduct.php
        $.post('./pages/orders/handleOrder.php', {confirm: id}, function(data){
            // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
            // $('#confirmOrder').html(data);
            location.reload();
        });
        return false;
    });
    $('.view').click(function(){
        // Lấy giá trị của phần tử có lớp '.id'
        let id = $(this).closest('tr').find('.id').val();

        // Gửi yêu cầu AJAX để lấy dữ liệu từ editProduct.php
        $.post('./pages/orders/viewOrder.php', {id: id}, function(data){
            // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
            $('#viewOrder').html(data);
        });
        return false;
    });
    $('.delete').click(function(){
    // Lấy giá trị của phần tử có lớp '.id'
        let id = $(this).closest('tr').find('.id').val();

    // Gửi yêu cầu AJAX để xóa dữ liệu
    $.post('./pages/orders/handleOrder.php', {delete: id}, function(data){
        // Hiển thị thông báo hoặc thực hiện các xử lý khác nếu cần

        // Tải lại trang sau khi xóa thành công
        location.reload();
    });

    // Ngăn chặn các hành động mặc định của nút hoặc liên kết
    return false;
  });

  $('#selectSort').change(function(){
    let sort=$(this).val();
    $.post('./pages/orders/handleOrder.php', {sort: sort}, function(data){
        // Hiển thị thông báo hoặc thực hiện các xử lý khác nếu cần
        // alert(sort);
        $('#divP').html(data);
        // Tải lại trang sau khi xóa thành công
        location.reload();
    });
    return false;
  })

  $(document).ready(function() {
    $('#selectAll').change(function() {
        $('.checkbox').prop('checked', this.checked);
    });
});
</script>



    
</body>
</html>