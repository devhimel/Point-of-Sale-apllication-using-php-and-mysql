<?php

// Database Connection
require "../../config/function.php";

// Fetch all brands, categories and units from database
if($_GET['action'] === 'fetchBrandSCategoriesUnits'){
    $brands = getAllRecord('brands');
    $categories = getAllRecord('categories');
    $units = getAllRecord('units');
    $data = [];
    while($row = mysqli_fetch_assoc($brands)){
        $data['brands'][] = $row;
    }
    while($row = mysqli_fetch_assoc($categories)){
        $data['categories'][] = $row;
    }
    while($row = mysqli_fetch_assoc($units)){
        $data['units'][] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $data
    ]);
}
// Generate random product code
if($_GET['action'] === 'generateProductCode'){
    $code = generateRandomCode();
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $code
    ]);
}
// Add a product record into database
if($_GET['action'] === 'insertProduct'){
    if($_POST['barcode_type'] != '' && $_POST['name'] != '' && $_POST['code'] != '' && $_POST['category'] != '' && $_POST['brand'] != '' && $_POST['unit'] != '' && $_POST['cost'] != '' && $_POST['price'] != '' && $_POST['quantity'] != '' && $_POST['status'] != ''){
        $name = validate_input($_POST['name']);
        $barcode_type = validate_input($_POST['barcode_type']);
        $code = validate_input($_POST['code']);
        $category = validate_input($_POST['category']);
        $brand = validate_input($_POST['brand']);
        $unit = validate_input($_POST['unit']);
        $cost = validate_input($_POST['cost']);
        $price = validate_input($_POST['price']);
        $quantity = validate_input($_POST['quantity']);
        $status = validate_input($_POST['status']);
        $description = validate_input($_POST['description']);

        // rename the image before saving it to the database
        if($_FILES['image']['size'] != 0){
            $original_name = $_FILES['image']['name'];
            $new_name = products - code.phpuniqid().time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
            $target = './assets/images/products/' . $new_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        }else{
            $new_name = '';
        }

        $data = [
            'barcode_type' => $barcode_type,
            'code' => $code,
            'category_id' => $category,
            'brand_id' => $brand,
            'unit_id' => $unit,
            'name' => $name,
            'description' => $description,
            'cost' => $cost,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $new_name,
            'status' => $status
        ];
        $result = insertRecord('products', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Product created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create product!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All Products from database
if($_GET['action'] === 'fetchProducts'){
    $query = "SELECT 
        p.id,
        p.barcode_type,
        p.code,
        c.name as category,
        u.name as unit,
        b.name as brand,
        p.name,
        p.description,
        p.cost,
        p.price,
        p.quantity,
        p.image,
        p.status,
        p.created_at,
        p.updated_at
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN units u ON p.unit_id = u.id
    LEFT JOIN brands b ON p.brand_id = b.id";
    $result = mysqli_query($conn, $query);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $data
    ]);
}

// Get a single product from database
if($_GET['action'] === 'fetchSingleProduct'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('products', $id);
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'data' => $data
        ]);
    }else{
        echo json_encode([
            'status' => 404,
            'message' => 'No unit found with this id!'
        ]);
    }
}

// Update a product record in database
if($_GET['action'] === 'updateProduct'){
    if($_POST['barcode_type'] != '' && $_POST['name'] != '' && $_POST['code'] != '' && $_POST['category'] != '' && $_POST['brand'] != '' && $_POST['unit'] != '' && $_POST['cost'] != '' && $_POST['price'] != '' && $_POST['quantity'] != '' && $_POST['status'] != ''){
        $id = validate_input($_POST['id']);
        $name = validate_input($_POST['name']);
        $barcode_type = validate_input($_POST['barcode_type']);
        $code = validate_input($_POST['code']);
        $category = validate_input($_POST['category']);
        $brand = validate_input($_POST['brand']);
        $unit = validate_input($_POST['unit']);
        $cost = validate_input($_POST['cost']);
        $price = validate_input($_POST['price']);
        $quantity = validate_input($_POST['quantity']);
        $status = validate_input($_POST['status']);
        $description = validate_input($_POST['description']);
        if($_FILES['image']['size'] != 0){
            // rename the image before saving it to the database
            $original_name = $_FILES['image']['name'];
            $new_name = products - code.phpuniqid().time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
            $target = './assets/images/products/' . $new_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            // remove the old image from the database
            unlink('./assets/images/products/'.$_POST['old_image']);
        }else{
            $new_name = $_POST['old_image'];
        }
        $data = [
            'barcode_type' => $barcode_type,
            'code' => $code,
            'category_id' => $category,
            'brand_id' => $brand,
            'unit_id' => $unit,
            'name' => $name,
            'description' => $description,
            'cost' => $cost,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $new_name,
            'status' => $status
        ];
        $result = updateRecord('products', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Product updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update product!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a product record from database

if($_GET['action'] === 'deleteSingleProduct'){
    $id = validate_input($_POST['id']);
    $image = validate_input($_POST['image']);
    $result = deleteRecord('products', $id);
    if($result){
        $filePath = './assets/images/products/' . $image;
        if (!empty($image) && file_exists($filePath)) {
            unlink($filePath);
        }
        echo json_encode([
            'status' => 200,
            'message' => 'Product deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete product!'
        ]);
    }
}
