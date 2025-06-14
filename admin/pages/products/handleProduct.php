<?php
    include_once "../../../database/config.php";
    include_once "../../../database/dbhelper.php";
    session_start();
    
    // Hàm validate dữ liệu đầu vào
    function validateProductData($data, $files) {
        $errors = array();
        
        // Validate brand
        if (empty($data['brand'])) {
            $errors['brand'] = "Vui lòng chọn thương hiệu";
        }
        
        // Validate model
        if (empty(trim($data['model']))) {
            $errors['model'] = "Tên sản phẩm không được để trống";
        } elseif (strlen(trim($data['model'])) < 2) {
            $errors['model'] = "Tên sản phẩm phải có ít nhất 2 ký tự";
        }
        
        // Validate version
        if (empty($data['version'])) {
            $errors['version'] = "Vui lòng chọn phiên bản";
        }
        
        // Validate category
        if (empty($data['category'])) {
            $errors['category'] = "Vui lòng chọn danh mục";
        }
        
        // Validate color
        if (empty($data['color']) || !is_array($data['color'])) {
            $errors['color'] = "Vui lòng chọn ít nhất một màu sắc";
        }
        
        // Validate price
        if (empty($data['price'])) {
            $errors['price'] = "Giá sản phẩm không được để trống";
        } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
            $errors['price'] = "Giá sản phẩm phải là số dương";
        }
        
        // Validate discount
        if (!empty($data['discount'])) {
            $discount_num = filter_var($data['discount'], FILTER_SANITIZE_NUMBER_INT);
            if ($discount_num < 0 || $discount_num > 100) {
                $errors['discount'] = "Giảm giá phải từ 0% đến 100%";
            }
        }
        
        // Validate stock quantity
        if (empty($data['stockQuantity'])) {
            $errors['stockQuantity'] = "Số lượng không được để trống";
        } elseif (!is_numeric($data['stockQuantity']) || $data['stockQuantity'] < 0) {
            $errors['stockQuantity'] = "Số lượng phải là số không âm";
        }
        
        // Validate description
        if (empty(trim($data['description']))) {
            $errors['description'] = "Mô tả sản phẩm không được để trống";
        } elseif (strlen(trim($data['description'])) < 10) {
            $errors['description'] = "Mô tả sản phẩm phải có ít nhất 10 ký tự";
        }
        
        // Validate main image (for add product)
        if (isset($files['image']) && empty($files['image']['name'])) {
            $errors['image'] = "Vui lòng chọn ảnh đại diện cho sản phẩm";
        }
        
        // Validate file types
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        
        if (isset($files['image']) && !empty($files['image']['name'])) {
            $file_extension = strtolower(pathinfo($files['image']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_types)) {
                $errors['image'] = "Ảnh đại diện phải có định dạng: " . implode(', ', $allowed_types);
            }
            
            // Validate file size (max 5MB)
            if ($files['image']['size'] > 5242880) {
                $errors['image'] = "Ảnh đại diện không được vượt quá 5MB";
            }
        }
        
        // Validate gallery images
        if (isset($files['images']) && !empty($files['images']['name'][0])) {
            foreach ($files['images']['name'] as $key => $filename) {
                if (!empty($filename)) {
                    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    if (!in_array($file_extension, $allowed_types)) {
                        $errors['images'] = "Tất cả ảnh mô tả phải có định dạng: " . implode(', ', $allowed_types);
                        break;
                    }
                    
                    // Validate file size (max 5MB each)
                    if ($files['images']['size'][$key] > 5242880) {
                        $errors['images'] = "Mỗi ảnh mô tả không được vượt quá 5MB";
                        break;
                    }
                }
            }
        }
        
        return $errors;
    }
    
    if(isset($_POST['sort'])){
        $_SESSION['sort']=$_POST['sort'];
    }
    
    if (isset($_POST["addProduct"])) {
        // Validate dữ liệu
        $errors = validateProductData($_POST, $_FILES);
        
        if (!empty($errors)) {
            // Lưu lỗi vào session để hiển thị
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST; // Lưu dữ liệu cũ để hiển thị lại form
            header("location: ../../?action=products&error=validation");
            exit();
        }
        
        $brand = $_POST['brand'];
        $model = trim($_POST['model']);
        $version = $_POST['version'];
        $color = isset($_POST['color']) ? $_POST['color'] : array();
        $colors = json_encode($color);
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = trim($_POST['description']);
        $stockQuantity = $_POST['stockQuantity'];
        $category = $_POST['category'];
        $createAt = date("Y-m-d H:i:s");
        $num = ($discount != '') ? filter_var($discount, FILTER_SANITIZE_NUMBER_INT) / 100 : 0;
        $deleted = 0;
        
        $sqlAdd = "INSERT INTO products (brandId, model, versionId, colors, price, discount, description, stockQuantity, categoryId, createAt, deleted) VALUES ('$brand','$model','$version', '$colors', '$price','$num','$description','$stockQuantity','$category','$createAt', '$deleted')";
        
        if (mysqli_query($conn, $sqlAdd)) {
            $id = mysqli_insert_id($conn);
            
            // Xử lý hình ảnh
            $targetDirectory = "./assets/images/uploads/";
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
            
            if (file_exists($targetFile)) {
                echo "Tệp tin đã tồn tại.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../." . $targetFile)) {
                    $sqlThumbnail = "update products set thumbnail = '$targetFile' where id = '$id'";
                    mysqli_query($conn, $sqlThumbnail);
                } else {
                    $_SESSION['errors'] = array('general' => 'Có lỗi khi tải lên ảnh đại diện');
                    header("location: ../../?action=products&error=upload");
                    exit();
                }
            }
            
            // Xử lý ảnh mô tả
            if (!empty($_FILES["images"]["name"][0])) {
                foreach ($_FILES["images"]["name"] as $key => $filename) {
                    $targetFiles = $targetDirectory . basename($filename);
                    
                    if (file_exists($targetFiles)) {
                        echo "Tệp tin đã tồn tại.";
                    } else if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "../../." . $targetFiles)) {
                        $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$targetFiles')";
                        mysqli_query($conn, $sqlGalleries);
                    } else {
                        $_SESSION['errors'] = array('general' => "Có lỗi khi tải lên hình ảnh $filename");
                        header("location: ../../?action=products&error=upload");
                        exit();
                    }
                }
            } else {
                $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$targetFile')";
                mysqli_query($conn, $sqlGalleries);
            }
            
            $_SESSION['success'] = "Thêm sản phẩm thành công!";
        } else {
            $_SESSION['errors'] = array('general' => 'Lỗi khi thêm sản phẩm: ' . mysqli_error($conn));
        }
        
        mysqli_close($conn);
        header("location: ../../?action=products");
        
    } elseif(isset($_POST["editProduct"])) {
        // Validate dữ liệu cho edit (tương tự như add nhưng không bắt buộc ảnh)
        $errors = validateProductData($_POST, $_FILES);
        
        // Đối với edit, ảnh không bắt buộc
        if (isset($errors['image']) && !empty($_POST['imgValue'])) {
            unset($errors['image']);
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            $id = $_GET['id'];
            header("location: ../../?action=products&edit=$id&error=validation");
            exit();
        }
        
        $brand = $_POST['brand'];
        $model = trim($_POST['model']);
        $version = $_POST['version'];
        $color = isset($_POST['color']) ? $_POST['color'] : array();
        $colors = json_encode($color);
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = trim($_POST['description']);
        $stockQuantity = $_POST['stockQuantity'];
        $category = $_POST['category'];
        $updateAt = date("Y-m-d H:i:s");
        $num = ($discount != '') ? filter_var($discount, FILTER_SANITIZE_NUMBER_INT) / 100 : 0;
        $id = $_GET['id'];
        
        $targetDirectory = "./assets/images/uploads/";
        
        if (!empty($_FILES["image"]["name"])) {
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        } else {
            $targetFile = $_POST['imgValue'];
        }
        
        if (!empty($_FILES["image"]["name"]) && !file_exists($targetFile)) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], "../../." . $targetFile)) {
                $_SESSION['errors'] = array('general' => 'Có lỗi khi tải lên ảnh đại diện');
                header("location: ../../?action=products&edit=$id&error=upload");
                exit();
            }
        }
        
        $updateSql = "UPDATE products SET brandId='$brand', model='$model', versionId='$version', colors='$colors', price='$price', discount='$num', description='$description', stockQuantity ='$stockQuantity', categoryId='$category', thumbnail='$targetFile', updateAt='$updateAt' WHERE id='$id'";
        
        if (mysqli_query($conn, $updateSql)) {
            $imagesSql = "select * from galleries where productId='$id'";
            $images = select($imagesSql, false);
            
            if (!empty($_FILES["images"]["name"][0])) {
                $sqlGalleriesDel = "delete from galleries where productId = '$id'";
                mysqli_query($conn, $sqlGalleriesDel);
                
                foreach ($_FILES["images"]["name"] as $key => $filename) {
                    $targetFiles = $targetDirectory . basename($filename);
                    
                    if (!file_exists($targetFiles)) {
                        if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "../../." . $targetFiles)) {
                            $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$targetFiles')";
                            mysqli_query($conn, $sqlGalleries);
                        }
                    }
                }
            } else {
                $sqlGalleriesDel = "delete from galleries where productId = '$id'";
                mysqli_query($conn, $sqlGalleriesDel);
                foreach ($images as $img) {
                    $a = $img['thumbnail'];
                    $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$a')";
                    mysqli_query($conn, $sqlGalleries);
                }
            }
            
            $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
        } else {
            $_SESSION['errors'] = array('general' => 'Lỗi khi cập nhật sản phẩm: ' . mysqli_error($conn));
        }
        
        header("location: ../../?action=products");
        
    } elseif(isset($_POST['delete'])) {
        $id = $_POST['delete'];
        
        $deleteGallery = "delete from galleries where productId='$id'";
        $deleteSql = "delete from products where id='$id'";
        
        if (iud($deleteGallery) && iud($deleteSql)) {
            $_SESSION['success'] = "Xóa sản phẩm thành công!";
        } else {
            $_SESSION['errors'] = array('general' => 'Có lỗi khi xóa sản phẩm');
        }
        
        header("location: ../../?action=products");
    }
?>