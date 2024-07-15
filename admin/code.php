<?php

// Database Connection
require "../config/function.php";

if(isset($_POST['save_admin'])) {
    $name = validate_input($_POST['name']);
    $email = validate_input($_POST['email']);
    $password = validate_input($_POST['password']);
    $phone = validate_input($_POST['phone']);
    $status = validate_input($_POST['status']);

    // Input validation
    if($name != '' && $email != '' && $password != ''){
        // check if email already exists
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email'");

        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('create-admin.php', 'Email already exists', 'danger');
            }
        }
        $password = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'status' => $status
        ];
        $result = insertRecord('admins', $data);
        if($result){
            redirect('admins.php', 'Admin created successfully', 'success');
        }else{
            redirect('create-admin.php', 'Something went wrong', 'danger');
        }
    }else{
        redirect('create-admin.php', 'Please fill all the fields', 'danger');
    }
}

if(isset($_POST['update_admin'])) {
    $id = validate_input($_POST['id']);
    $adminData = getRecordById('admins', $id);
    if($adminData['status'] != 200){
        redirect('edit-admin.php?id='.$id, 'Please fill required fields.', 'danger');
        exit();
    }
    $name = validate_input($_POST['name']);
    $email = validate_input($_POST['email']);
    $password = validate_input($_POST['password']);
    $phone = validate_input($_POST['phone']);
    $status = validate_input($_POST['status']);

    if($password != ''){
        $password = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $password = $adminData['data']['password'];
    }


    if($name != '' && $email != ''){
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'status' => $status
        ];
        $result = updateRecord('admins', $data,  $id);
        if($result){
            redirect('admins.php', 'Admin updated successfully', 'success');
        }else{
            redirect('edit-admin.php?id='.$id, 'Something went wrong', 'danger');
        }
    }else{
        redirect('edit-admin.php?id='.$id, 'Please fill all the fields', 'danger');
    }
}

// Add a category record into database
if($_GET['action'] === 'insertCategory'){
    if(!empty($_POST['name'])){
        $name = validate_input($_POST['name']);
        $description = validate_input($_POST['description']);
        $status = validate_input($_POST['status']);
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = insertRecord('categories', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Category created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Something went wrong'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All categories from database
if($_GET['action'] === 'fetchCategories'){
    $result = getAllRecord('categories');
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

// Get a single category from database
if($_GET['action'] === 'fetchSingleCategory'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('categories', $id);
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
            'message' => 'No category found with this id!'
        ]);
    }
}

// Update a category record in database
if($_GET['action'] === 'updateCategory'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);
    if(!empty($name)){
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = updateRecord('categories', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Category updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update category'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a category record from database

if($_GET['action'] === 'deleteSingleCategory'){
    $id = validate_input($_POST['id']);
    $result = deleteRecord('categories', $id);
    if($result){
        echo json_encode([
            'status' => 200,
            'message' => 'Category deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete category'
        ]);
    }
}


// Add a unit record into database
if($_GET['action'] === 'insertUnit'){
    if(!empty($_POST['name']) && !empty($_POST['short_name'])){
        $name = validate_input($_POST['name']);
        $short_name = validate_input($_POST['short_name']);
        $status = validate_input($_POST['status']);
        $data = [
            'name' => $name,
            'short_name' => $short_name,
            'status' => $status
        ];
        $result = insertRecord('units', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Unit created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create unit'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All categories from database
if($_GET['action'] === 'fetchUnits'){
    $result = getAllRecord('units');
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

// Get a single unit from database
if($_GET['action'] === 'fetchSingleUnit'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('units', $id);
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

// Update a unit record in database
if($_GET['action'] === 'updateUnit'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $short_name = validate_input($_POST['short_name']);
    $status = validate_input($_POST['status']);
    if(!empty($name) && !empty($short_name)){
        $data = [
            'name' => $name,
            'short_name' => $short_name,
            'status' => $status
        ];
        $result = updateRecord('units', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Unit updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update unit!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a category record from database

if($_GET['action'] === 'deleteSingleUnit'){
    $id = validate_input($_POST['id']);
    $result = deleteRecord('units', $id);
    if($result){
        echo json_encode([
            'status' => 200,
            'message' => 'Unit deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete unit'
        ]);
    }
}




// Add a brand record into database
if($_GET['action'] === 'insertBrand'){
    if(!empty($_POST['name'])){
        $name = validate_input($_POST['name']);
        $description = validate_input($_POST['description']);
        $status = validate_input($_POST['status']);

        // rename the image before saving it to the database
        $original_name = $_FILES['image']['name'];
        $new_name = uniqid(). time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
        $target = './assets/images/brands/' . $new_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $data = [
            'name' => $name,
            'description' => $description,
            'image' => $new_name,
            'status' => $status
        ];
        $result = insertRecord('brands', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Brand created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create brand'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All brands from database
if($_GET['action'] === 'fetchBrands'){
    $result = getAllRecord('brands');
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

// Get a single brand from database
if($_GET['action'] === 'fetchSingleBrand'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('brands', $id);
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

// Update a brand record in database
if($_GET['action'] === 'updateBrand'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);
    if(!empty($name)){
        if($_FILES['image']['size'] != 0){
            // rename the image before saving it to the database
            $original_name = $_FILES['image']['name'];
            $new_name = uniqid(). time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
            $target = './assets/images/brands/' . $new_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            // remove the old image from the database
            unlink('./assets/images/brands/'.$_POST['old_image']);
        }else{
            $new_name = $_POST['old_image'];
        }
        $data = [
            'name' => $name,
            'description' => $description,
            'image' => $new_name,
            'status' => $status
        ];
        $result = updateRecord('brands', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Brand updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update brand!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a brand record from database

if($_GET['action'] === 'deleteSingleBrand'){
    $id = validate_input($_POST['id']);
    $image = validate_input($_POST['image']);
    $result = deleteRecord('brands', $id);
    if($result){
        $filePath = './assets/images/brands/' . $image;
        if (!empty($image) && file_exists($filePath)) {
            unlink($filePath);
        }
        echo json_encode([
            'status' => 200,
            'message' => 'Brand deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete unit'
        ]);
    }
}



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
            $new_name = uniqid(). time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
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
            $new_name = uniqid(). time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
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


