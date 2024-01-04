<?php
    include_once "../../../database/config.php";
    include_once "../../../database/dbhelper.php";
    session_start();
    if(isset($_POST['sort'])){
        $_SESSION['sort']=$_POST['sort'];
    }
    if (isset($_POST["addProduct"])) {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $version = $_POST['version'];
        // $color[] = $_POST['color'];
        $color = isset($_POST['color']) ? $_POST['color'] : array();
        $colors=json_encode($color);
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $stockQuantity = $_POST['stockQuantity'];
        $category = $_POST['category'];
        $createAt = date("Y-m-d H:i:s");
        $num = ($discount!='')?filter_var($discount, FILTER_SANITIZE_NUMBER_INT)/100:0;
        $deleted = 0;

        // echo "<pre>";
        // var_dump($colors);
        // var_dump(json_decode($colors));
        // echo $version;
        // echo "</pre>";
        
        $sqlAdd = "INSERT INTO products (brandId, model, versionId, colors, price, discount, description, stockQuantity, categoryId, createAt, deleted) VALUES ('$brand','$model','$version', '$colors', '$price','$num','$description','$stockQuantity','$category','$createAt', '$deleted')";
        echo "<pre>";
            print_r(($_FILES["images"]['name']));
            var_dump(empty($_FILES["images"]['name'][0])) ;
        echo "</pre>";
        // die();
        if (mysqli_query($conn, $sqlAdd)) {
            
            $id = mysqli_insert_id($conn); // Lấy ID của sản phẩm vừa được thêm
            echo "Sản phẩm đã được thêm thành công với ID: " . $id;
    
            // Xử lý hình ảnh
            $targetDirectory = "./assets/images/uploads/"; // Đường dẫn đến thư mục lưu trữ hình ảnh

            // $firstImage = null; // Variable to store the path of the first image
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]); // Đường dẫn đầy đủ đến tệp tin trên server



            
            // Kiểm tra xem tệp tin đã tồn tại chưa
            if (file_exists($targetFile)) {
                echo "Tệp tin đã tồn tại.";
            } else {
                // Thực hiện tải lên tệp tin
                if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../.".$targetFile)) {
                    echo "Tải lên thành công. Đường dẫn tệp tin: " . $targetFile;
                    $sqlThumbnail = "update products set thumbnail = '$targetFile' where id = '$id'";
                    mysqli_query($conn,$sqlThumbnail);
                    

                } else {
                    echo "Có lỗi khi tải lên tệp tin.";
                }
            }
            
            // if(mysqli_query($conn,$sqlThumbnail)){
                if(!empty($_FILES["images"]["name"][0])){
                    foreach ($_FILES["images"]["name"] as $key => $filename) {
                        $targetFiles = $targetDirectory . basename($filename); // Đường dẫn đầy đủ đến tệp tin trên server
        
                        if (file_exists($targetFiles)) {
                            echo "Tệp tin đã tồn tại.";
                        } else if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "../../.".$targetFiles)) {
                        echo "Tải lên thành công. Đường dẫn tệp tin: " . $targetFiles;
                            
                            // $sqlGalleriesDel = "delete from galleries where idProduct = '$id'";
                            // mysqli_query($conn, $sqlGalleriesDel);
                            // Thêm đường dẫn hình ảnh vào bảng galleries
                            $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$targetFiles')";
                            mysqli_query($conn, $sqlGalleries);
        
                            // Save the path of the first image
                            // if ($firstImage === null) {
                            //     $firstImage = $targetFile;
                            // }
        
                            echo "Hình ảnh đã được tải lên thành công.";
                        } else {
                            echo "Có lỗi khi tải lên hình ảnh $filename.<br>";
                        }
                    }
                }else{
                    $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$targetFile')";
                    mysqli_query($conn,$sqlGalleries);
                }
            // }

            // Cập nhật trường thumbnail trong bảng products
            // if ($firstImage !== null) {
            //     $sqlThumbnail = "UPDATE products SET thumbnail = '$firstImage' WHERE id = '$id'";
            //     mysqli_query($conn, $sqlThumbnail);
            // }
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }

        
        
        // $sqlSelect="select * from products";
        // $products=select($sqlSelect,false);
        // $_SESSION['products']=$products;
        // Đóng kết nối đến cơ sở dữ liệu
        mysqli_close($conn);

        
        header("location: ../../?action=products");
    }elseif(isset($_POST["editProduct"])) {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $version = $_POST['version'];
        $color = isset($_POST['color']) ? $_POST['color'] : array();
        $colors=json_encode($color);
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $stockQuantity = $_POST['stockQuantity'];
        $category = $_POST['category'];
        $updateAt = date("Y-m-d H:i:s");
        $num = ($discount!='')?filter_var($discount, FILTER_SANITIZE_NUMBER_INT)/100:0;
        $id=$_GET['id'];
        
        $targetDirectory = "./assets/images/uploads/";

        if(!empty($_FILES["image"]["name"][0])){
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]); // Đường dẫn đầy đủ đến tệp tin trên server
        }else{
            $targetFile = $_POST['imgValue'];
        }

        // Kiểm tra xem tệp tin đã tồn tại chưa
        if (file_exists($targetFile)) {
            echo "Tệp tin đã tồn tại.";
        } else {
            // Thực hiện tải lên tệp tin
            if (move_uploaded_file($_FILES["image"]["tmp_name"], ".".$targetFile)) {
                echo "Tải lên thành công. Đường dẫn tệp tin: " . $targetFile;
                
            } else {
                echo "Có lỗi khi tải lên tệp tin.";
            }
        }
        
        $updateSql="UPDATE products SET brandId='$brand', model='$model', versionId='$version', colors='$colors', price='$price', discount='$num', description='$description', stockQuantity ='$stockQuantity', categoryId='$category', thumbnail='$targetFile', updateAt='$updateAt' WHERE id='$id'";
        mysqli_query($conn, $updateSql);

        // session_start();
        $imagesSql="select * from galleries where productId='$id'";
        $images=select($imagesSql,false);

        if(!empty($_FILES["images"]["name"][0])){
            $sqlGalleriesDel = "delete from galleries where productId = '$id'";
            mysqli_query($conn, $sqlGalleriesDel);
            foreach ($_FILES["images"]["name"] as $key => $filename) {
                $targetFiles = $targetDirectory . basename($filename); // Đường dẫn đầy đủ đến tệp tin trên server
    
                if (file_exists($targetFiles)) {
                    echo "Tệp tin đã tồn tại.";
                } else if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "../../.".$targetFiles)) {
                    echo "Tải lên thành công. Đường dẫn tệp tin: " . $targetFiles;
                    echo "Hình ảnh đã được tải lên thành công.";
                } else {
                    echo "Có lỗi khi tải lên hình ảnh $filename.<br>";
                }
                
                // Thêm đường dẫn hình ảnh vào bảng galleries
                $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$targetFiles')";
                mysqli_query($conn, $sqlGalleries);
            }
        }else{
            $sqlGalleriesDel = "delete from galleries where productId = '$id'";
            mysqli_query($conn, $sqlGalleriesDel);
            foreach($images as $img){
                $a=$img['thumbnail'];
                // Thêm đường dẫn hình ảnh vào bảng galleries
                $sqlGalleries = "INSERT INTO galleries (productId, thumbnail) VALUES ('$id', '$a')";
                mysqli_query($conn, $sqlGalleries);
            }
        }
        
        header("location: ../../?action=products");
    }elseif(isset($_POST['delete'])){
        $id=$_POST['delete'];
        // $deleteImg="delete from images where nameImage='$id'";
        // mysqli_query($conn, $deleteImg);
        // header("location: ../../?action=products");
        
        $deleteGallery="delete from galleries where id='$id'";
        $deleteSql="delete from products where id='$id'";
        iud($deleteGallery);
        iud($deleteSql);
        // $deleteImg="delete from images where nameImage='$id'";
        // mysqli_query($conn, $deleteImg);

        header("location: ../../?action=products");
    }
?>
