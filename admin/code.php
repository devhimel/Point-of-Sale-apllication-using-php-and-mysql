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

if(isset($_POST['save_unit'])){
    $name = validate_input($_POST['name']);
    $short_name = validate_input($_POST['short_name']);
    $status = validate_input($_POST['status']);

    // Input validation
    if($name != '' && $short_name != ''){
        $data = [
            'name' => $name,
            'short_name' => $short_name,
            'status' => $status
        ];
        $result = insertRecord('units', $data);
        if($result){
            redirect('units.php', 'Unit created successfully', 'success');
        }else{
            redirect('create-units.php', 'Something went wrong', 'danger');
        }
    }else{
        redirect('create-units.php', 'Please fill all the fields', 'danger');
    }
}

if(isset($_POST['update_unit'])) {
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $short_name = validate_input($_POST['short_name']);
    $status = validate_input($_POST['status']);

    $data = [
        'name' => $name,
        'short_name' => $short_name,
        'status' => $status
    ];
    $result = updateRecord('units', $data,  $id);
    if($result){
        redirect('units.php', 'Unit updated successfully', 'success');
    }else{
        redirect('edit-units.php?id='.$id, 'Something went wrong', 'danger');
    }
}