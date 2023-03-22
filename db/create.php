<?php
    require 'database.php';
    $database = new Database();
    $conn = $database->dbConnection();
    
    try {
        $name = $_POST['name'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $productType = $_POST['productType'];
        if ($productType == 'Book') {
            $height = 0;
            $width = 0;
            $length = 0;
            $size = 0;
            $weight = $_POST['weight'];
        } elseif ($productType == 'DVD') {
            $height = 0;
            $width = 0;
            $length = 0;
            $size = $_POST['size'];
            $weight = 0;
        }
        else{
            $height = $_POST['height'];
            $width = $_POST['width'];
            $length = $_POST['length'];
            $size = 0;
            $weight = 0;
        }
    
    
        $query = "INSERT INTO `products`(name,sku,price,productType,height,width,length,size,weight)
        VALUES
        (:name,:sku,:price,:productType,:height,:width,:length,:size,:weight)";
    
        $stmt = $conn->prepare($query);
    
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':sku', $sku, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':productType', $productType, PDO::PARAM_STR);
        $stmt->bindValue(':height', $height, PDO::PARAM_INT);
        $stmt->bindValue(':width', $width, PDO::PARAM_INT);
        $stmt->bindValue(':length', $length, PDO::PARAM_INT);
        $stmt->bindValue(':size', $size, PDO::PARAM_INT);
        $stmt->bindValue(':weight', $weight, PDO::PARAM_INT);
    
    
        if ($stmt->execute()) {
            header("Location: ../index.php");
        }
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'netice' => 0,
            'message' => $e->getMessage()
        ]);
        exit;
    }

