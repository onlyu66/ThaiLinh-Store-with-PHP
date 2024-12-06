<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="styles/products.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
</head>

<body>
<div>
    <div class="sortAdd flex justify-between">
        <form class="sort" method="post">
            <select name="sort" id="selectSort">
                <option value="id">Latest</option>
                <option value="model">Name</option>
                <option value="price">Price</option>
                <option value="stockQuantity">Quantity</option>
            </select>
        </form>
        <button type="button" id="addProductBtn" class="btn btn-primary button !bg-neutral-900 !text-white" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add Product
        </button>
    </div>

    <!-- Modal -->
    <?php include_once "addProduct.php" ?>
    <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
      <?php include_once "editProduct.php" ?>
    </div>
    <div class="modal fade" id="viewProduct" tabindex="-1" aria-labelledby="viewProductLabel" aria-hidden="true">
      <?php include_once "viewProduct.php" ?>
    </div>

    <div style="overflow: auto; max-height: 80vh;">
        <table class="table table-striped table-hover text-center" style="width: 80%; margin: 20px auto;">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Quantity</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                <!-- Sản phẩm sẽ được tải động qua AJAX -->
            </tbody>
        </table>
    </div>
</div>

<script>
// Load danh sách sản phẩm
function loadProducts(sort = 'id') {
    $.ajax({
        url: './pages/products/getProductsAPI.php',
        type: 'POST',
        data: { sort: sort },
        dataType: 'json',
        success: function (data) {
            let rows = '';
            if (data.error) {
                rows = `<tr><td colspan="8">${data.error}</td></tr>`;
            } else {
                data.forEach((product, index) => {
                    rows += `
                        <tr id="${product.id}">
                            <td>${index + 1}</td>
                            <td><img src=".${product.thumbnail}" alt="Image" style="width: 50px; height: 50px;" /></td>
                            <td>${product.model}</td>
                            <td>${parseInt(product.price).toLocaleString()}</td>
                            <td>${product.discount * 100}%</td>
                            <td>${product.stockQuantity}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info view" data-bs-toggle="modal" data-bs-target="#viewProduct" data-id="${product.id}">View</button>

                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-warning edit" data-id="${product.id}">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger delete" data-id="${product.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
            }
            $('#productTableBody').html(rows);
            bindActions();
        },
        error: function () {
            alert('Failed to load products.');
        }
    });
}

// Gắn sự kiện cho các nút sau khi tải sản phẩm
function bindActions() {
    $('.view').click(function () {
        let id = $(this).data('id');
        $.post('./pages/products/viewProduct.php', { id: id }, function (data) {
            $('#viewProduct').html(data);
            $('#viewProduct').modal('show');
        });
    });

    $('.edit').click(function () {
        let id = $(this).data('id');
        $.post('./pages/products/editProduct.php', { id: id }, function (data) {
            $('#editProduct').html(data);
            $('#editProduct').modal('show');
        });
    });

    $('.delete').click(function () {
        let id = $(this).data('id');
        if (confirm('Are you sure you want to delete this product?')) {
            $.post('./pages/products/handleProduct.php', { delete: id }, function () {
                loadProducts();
            });
        }
    });
}

// Khi thay đổi sắp xếp
$('#selectSort').change(function () {
    let sort = $(this).val();
    loadProducts(sort);
});

// Tải sản phẩm ban đầu
$(document).ready(function () {
    loadProducts();
});
</script>
</body>
</html>
