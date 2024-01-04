<?php
    include_once "../database/config.php";
    include_once "../database/dbhelper.php";
    $a = $_POST['data'];
    $sql="select * from products where model like '%$a%'";
    $products=select($sql, false);
?>
    <h6 class="font-bold text-sm">Sản phẩm gợi ý</h6>
    <ul class="p-0">
<?php
    foreach($products as $product){
?>
        <a href="?quanly=productDetails&id=<?php echo $product['id'];?>" class="listItem" data-model="<?php echo $product['model'];?>">
            <li class="flex py-1 rounded" id="listItem_<?php echo $product['model']; ?>" >
                <img src="<?php echo $product['thumbnail'];?>" alt="" class="w-16 mr-3" />
                <div style="margin: auto 0; line-height: 1.4">
                    <p class="font-semibold text-sm"><?php echo $product['model'];?></p>
                    <div class="flex">
                        <p style="color: red" class="text-sm"> <?php echo number_format($product['price']*(1-$product['discount']));?> ₫</p>
                        <p class="line-through text-sm ml-2 text-slate-800 font-normal" <?php echo ($product['discount']>0)?"":"hidden"?>><?php echo number_format($product['price']);?> ₫</p>
                        <p class="text-xs ml-1"><?php echo ($product['discount']>0)?"Giảm: ".($product['discount']*100)."%":"";?></p>
                    </div>
                </div>
            </li>
        </a>
        
<?php
    }
?>
    </ul>
    <!-- <script>
    var listItems = document.querySelectorAll(".listItem");

    listItems.forEach(function (listItem) {
        listItem.addEventListener("click", function () {
            var model = this.getAttribute("data-model");
            
            // Assuming searchInput is the ID of your input field
            var inputValue = document.getElementById("searchInput").value;

            // Ensure that the session is started
            <?php session_start();?>
                <?php
                    $idUser=getSession('id');?>

            // Store the input value in the session variable
            <?php $_SESSION['searchHistory'][$idUser] =  $inputValue ; ?>

            // Update the input field value
            searchInput.value = model;

            // Other actions you want to perform
            suggestions.style.display = "none";
            hSearch.style.display = "block";
            console.log(searchInput.value);
        });
    });
</script> -->



