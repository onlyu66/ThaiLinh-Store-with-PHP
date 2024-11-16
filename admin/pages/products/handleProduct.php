<?php
  include_once"../../../database/config.php";    
  include_once"../../../database/dbhelper.php";    
  session_start();
  header('Content-Type: application/json');
  
  $response = [
  'success' => false,
  'errors' => [],
  'message' => ''
  ];
  try{
    
    // Handle Add Product
    if (isset($_POST['addProduct'])){
      
      // Validate input
      $errors = [];
      
      // Required fields
      $requiredFields = ['brand', 'model', 'version', 'price', 'stockQuantity', 'category'];
      foreach ($requiredFields as $field){
        if (empty($_POST[$field])){
          $errors[$field] = ucfirst($field) . ' is required';

        }

      }
      
      // Validate price and stock
      if (!empty($_POST['price']) && (!is_numeric($_POST['price']) || $_POST['price'] <= 0)){
        $errors['price'] = 'Price must be a positive number';

      }
      if (!empty($_POST['stockQuantity']) && (!is_numeric($_POST['stockQuantity']) || $_POST['stockQuantity'] < 0)){
        $errors['stockQuantity'] = 'Stock quantity must be a non-negative number';

      }
      
      // Validate thumbnail
      if (empty($_FILES['image']['name'])){
        $errors['image'] = 'Thumbnail is required';

      }
      
      // Validate Gallery Images
      if (empty($_FILES['images']['name'][0])){
        $errors['images'] = 'Gallery images is required';

      }else{
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxFileSize = 5 * 1024 * 1024;
        
        // 5MB
        $maxFiles = 5;
        
        // Giới hạn số lượng file

        // Kiểm tra số lượng file
        if (count($_FILES['images']['name']) > $maxFiles){
          $errors['images'] = "Maximum $maxFiles gallery images allowed";

        }
        
        // Kiểm tra từng file
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name){
          if (!empty($tmp_name)){
            $fileType = $_FILES['images']['type'][$key];
            $fileSize = $_FILES['images']['size'][$key];
            
            // Kiểm tra loại file
            if (!in_array($fileType, $allowedTypes)){
              $errors['images'] = 'Invalid image type. Only JPEG, PNG, GIF, and WebP are allowed';
              break;

            }
            
            // Kiểm tra kích thước file
            if ($fileSize > $maxFileSize){
              $errors['images'] = 'Gallery image size must be less than 5MB';
              break;

            }

          }

        }

      }
      
      // Validate Colors
      if (empty($_POST['color'][0])){
        $errors['color'] = 'Minimum 1 color must be selected';

      }else{
        $maxColors = 6;
        
        // Giới hạn số màu được chọn
        if (count($_POST['color']) > $maxColors){
          $errors['color'] = "Maximum $maxColors colors can be selected";

        }

      }
      if (!empty($errors)){
        $response['errors'] = $errors;
        echo json_encode($response);
        exit;

      }
      
      // Process the data
      $brand = $_POST['brand'];
      $model = $_POST['model'];
      $version = $_POST['version'];
      $colors = isset($_POST['color']) ? json_encode($_POST['color']) : '[]';
      $price = $_POST['price'];
      $discount = !empty($_POST['discount']) ? $_POST['discount'] / 100 : 0;
      $description = $_POST['description'];
      $stockQuantity = $_POST['stockQuantity'];
      $category = $_POST['category'];
      $createAt = date('Y-m-d H:i:s');
      
      // Insert product
      $sql ="INSERT INTO products (brandId, model, versionId, colors, price, discount, description, 
                                    stockQuantity, categoryId, createAt) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";    
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("isssddsiis", 
            $brand, $model, $version, $colors, $price, $discount, 
            $description, $stockQuantity, $category, $createAt
        );    
      if ($stmt->execute()){
        $productId = $stmt->insert_id;
        
        // Handle thumbnail upload
        $uploadDir ="../../assets/images/uploads/";    
        if (!file_exists($uploadDir)){
          mkdir($uploadDir, 0777, true);

        }
        $thumbnail = $_FILES['image'];
        $thumbnailName = time() . '_' . basename($thumbnail['name']);
        $thumbnailPath = $uploadDir . $thumbnailName;
        if (move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath)){
          
          // Update thumbnail path in database
          $thumbnailDbPath ="../../assets/images/uploads/" . $thumbnailName;    
          $stmt = $conn->prepare("UPDATE products SET thumbnail = ? WHERE id = ?");    
          $stmt->bind_param("si", $thumbnailDbPath, $productId);    
          $stmt->execute();
          
          // Handle gallery images
          if (!empty($_FILES['images']['name'][0])){
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name){
              $imageName = time() . '_' . $_FILES['images']['name'][$key];
              $imagePath = $uploadDir . $imageName;
              if (move_uploaded_file($tmp_name, $imagePath)){
                $imageDbPath = "../../assets/images/uploads/" . $imageName;
                $stmt = $conn->prepare("INSERT INTO galleries (productId, thumbnail) VALUES (?, ?)");
                $stmt->bind_param("is", $productId, $imageDbPath);
                $stmt->execute();

              }

            }

          }
          $response['success'] = true;
          $response['message'] = 'Product added successfully!';

        }else{
          throw new Exception("Error uploading thumbnail");

        }

      }else{
        throw new Exception("Error inserting product data");

      }

    }
    
    // Thêm vào phần xử lý edit product
    elseif (isset($_POST['editProduct'])){
      try{
        
        // Validate input
        $errors = [];
        
        // Lấy ID sản phẩm
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id <= 0){
          throw new Exception('Invalid product ID');

        }
        
        // Required fields
        $requiredFields = ['brand', 'model', 'version', 'price', 'stockQuantity', 'category'];
        foreach ($requiredFields as $field){
          if (empty($_POST[$field])){
            $errors[$field] = ucfirst($field) . ' is required';

          }

        }
        
        // Validate price and stock
        if (!empty($_POST['price']) && (!is_numeric($_POST['price']) || $_POST['price'] <= 0)){
          $errors['price'] = 'Price must be a positive number';

        }
        if (!empty($_POST['stockQuantity']) && (!is_numeric($_POST['stockQuantity']) || $_POST['stockQuantity'] < 0)){
          $errors['stockQuantity'] = 'Stock quantity must be a non-negative number';

        }
        
        // Validate Colors
        if (empty($_POST['color'][0])){
          $errors['color'] = 'Minimum 1 color must be selected';

        }else{
          $maxColors = 6;
          
          // Giới hạn số màu được chọn
          if (count($_POST['color']) > $maxColors){
            $errors['color'] = "Maximum $maxColors colors can be selected";

          }

        }
        
        // Validate Images (optional)
        $thumbnailChanged = !empty($_FILES['image']['name']);
        $galleryChanged = !empty($_FILES['images']['name'][0]);
        if ($thumbnailChanged){
          $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
          $maxFileSize = 5 * 1024 * 1024;
          
          // 5MB

          // Kiểm tra loại file
          if (!in_array($_FILES['image']['type'], $allowedTypes)){
            $errors['image'] = 'Invalid image type. Only JPEG, PNG, GIF, and WebP are allowed';

          }
          
          // Kiểm tra kích thước file
          if ($_FILES['image']['size'] > $maxFileSize){
            $errors['image'] = 'Thumbnail image size must be less than 5MB';

          }

        }
        
        // Validate gallery images if uploaded
        if ($galleryChanged){
          $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
          $maxFileSize = 5 * 1024 * 1024;
          
          // 5MB
          $maxFiles = 5;
          
          // Giới hạn số lượng file

          // Kiểm tra số lượng file
          if (count($_FILES['images']['name']) > $maxFiles){
            $errors['images'] = "Maximum $maxFiles gallery images allowed";

          }
          
          // Kiểm tra từng file
          foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name){
            if (!empty($tmp_name)){
              $fileType = $_FILES['images']['type'][$key];
              $fileSize = $_FILES['images']['size'][$key];
              
              // Kiểm tra loại file
              if (!in_array($fileType, $allowedTypes)){
                $errors['images'] = 'Invalid image type. Only JPEG, PNG, GIF, and WebP are allowed';
                break;

              }
              
              // Kiểm tra kích thước file
              if ($fileSize > $maxFileSize){
                $errors['images'] = 'Gallery image size must be less than 5MB';
                break;

              }

            }

          }

        }
        
        // Nếu có lỗi, trả về ngay
        if (!empty($errors)){
          $response['errors'] = $errors;
          echo json_encode($response);
          exit;

        }
        
        // Chuẩn bị dữ liệu
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $version = $_POST['version'];
        $colors = json_encode($_POST['color']);
        $price = $_POST['price'];
        $discount = !empty($_POST['discount']) ? $_POST['discount'] / 100 : 0;
        $description = $_POST['description'];
        $stockQuantity = $_POST['stockQuantity'];
        $category = $_POST['category'];
        $updateAt = date('Y-m-d H:i:s');
        
        // Upload directory
        $uploadDir ="../../assets/images/uploads/";    
        if (!file_exists($uploadDir)){
          mkdir($uploadDir, 0777, true);

        }
        
        // Chuẩn bị câu truy vấn cập nhật
        $updateSql ="UPDATE products SET 
            brandId = ?, 
            model = ?, 
            versionId = ?, 
            colors = ?, 
            price = ?, 
            discount = ?, 
            description = ?, 
            stockQuantity = ?, 
            categoryId = ?,
            updateAt = ?
            WHERE id = ?";    
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("isssddsiisi", 
            $brand, $model, $version, $colors, $price, $discount, 
            $description, $stockQuantity, $category, $updateAt, $id
        );    
        
        // Thực thi update sản phẩm
        if ($stmt->execute()){
          
          // Xử lý upload ảnh đại diện nếu có
          if ($thumbnailChanged){
            $thumbnailName = time() . '_' . basename($_FILES['image']['name']);
            $thumbnailPath = $uploadDir . $thumbnailName;
            $thumbnailDbPath ="../../assets/images/uploads/" . $thumbnailName;    
            
            // Di chuyển file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $thumbnailPath)){
              
              // Cập nhật đường dẫn ảnh đại diện
              $stmt = $conn->prepare("UPDATE products SET thumbnail = ? WHERE id = ?");
              $stmt->bind_param("si", $thumbnailDbPath, $id);
              $stmt->execute();

            }else{
              throw new Exception("Lỗi khi upload ảnh đại diện");

            }

          }
          
          // Xử lý ảnh gallery nếu có
          if ($galleryChanged){
            
            // Xóa ảnh gallery cũ
            $stmt = $conn->prepare("DELETE FROM galleries WHERE productId = ?");    
            $stmt->bind_param("i", $id);    
            $stmt->execute();
            
            // Thêm ảnh gallery mới
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name){
              $imageName = time() . '_' . $_FILES['images']['name'][$key];
              $imagePath = $uploadDir . $imageName;
              $imageDbPath ="../../assets/images/uploads/" . $imageName;    
              if (move_uploaded_file($tmp_name, $imagePath)){
                $stmt = $conn->prepare("INSERT INTO galleries (productId, thumbnail) VALUES (?, ?)");
                $stmt->bind_param("is", $id, $imageDbPath);
                $stmt->execute();

              }

            }

          }
          $response['success'] = true;
          $response['message'] = 'Cập nhật sản phẩm thành công!';

        }else{
          throw new Exception("Lỗi khi cập nhật sản phẩm");

        }

      }
      catch (Exception $e){
        $response['message'] = $e->getMessage();

      }

    }
    
    // Handle Delete Product
    elseif (isset($_POST['delete'])){
      $id = $_POST['delete'];
      
      // Delete gallery images first
      $stmt = $conn->prepare("DELETE FROM galleries WHERE productId = ?");    
      $stmt->bind_param("i", $id);    
      $stmt->execute();
      
      // Then delete the product
      $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");    
      $stmt->bind_param("i", $id);    
      if ($stmt->execute()){
        $response['success'] = true;
        $response['message'] = 'Product deleted successfully!';

      }else{
        throw new Exception("Error deleting product");

      }

    }
    
    // Handle Sort
    elseif (isset($_POST['sort'])){
      $_SESSION['sort'] = $_POST['sort'];
      $response['success'] = true;

    }

  }
  catch (Exception $e){
    $response['message'] = $e->getMessage();

  }
  echo json_encode($response);

?>
