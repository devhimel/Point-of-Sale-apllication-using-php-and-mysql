<?php

// Database Connection
require "../../config/function.php";

// Get All users from database
if($_GET['action'] === 'fetchUsers'){
    $result = getAllRecord('users');
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

// Add a user record into database
if($_GET['action'] === 'insertUser'){
    $first_name = validate_input($_POST['first_name']);
    $last_name = validate_input($_POST['last_name']);
    $email = validate_input($_POST['email']);
    $password = validate_input($_POST['password']);
    $phone = validate_input($_POST['phone']);
    $role = validate_input($_POST['role']);
    $status = validate_input($_POST['status']);
    if($first_name != '' && $last_name != '' && $email != '' && $password != '' && $phone != '' && $role != '' && $status != ''){
        $image = $_FILES['image']['name'];
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'phone' => $phone,
            'role' => $role,
            'status' => $status
        ];
        if($_FILES['image']['size'] != 0){
            $new_name = users - code.phpuniqid().time(). '.' .pathinfo($image, PATHINFO_EXTENSION);
            $target = './assets/images/users/' . $new_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $data['avatar'] = $new_name;
        }
        $result = insertRecord('users', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'User created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create user'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get a single user from database
if($_GET['action'] === 'fetchSingleUser'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('users', $id);
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
            'message' => 'No user found with this id!'
        ]);
    }
}

// Update a user record in database
if($_GET['action'] === 'updateUser'){
    $id = validate_input($_POST['id']);
    $first_name = validate_input($_POST['first_name']);
    $last_name = validate_input($_POST['last_name']);
    $email = validate_input($_POST['email']);
    $password = validate_input($_POST['password']);
    $phone = validate_input($_POST['phone']);
    $role = validate_input($_POST['role']);
    $status = validate_input($_POST['status']);
    if($first_name != '' && $last_name != '' && $email != '' && $phone != '' && $role != '' && $status != ''){
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'role' => $role,
            'status' => $status
        ];
        if($password != ''){
            $data = password_hash($password, PASSWORD_BCRYPT);
        }
        if($_FILES['image']['size'] != 0){
            // rename the image before saving it to the database
            $original_name = $_FILES['image']['name'];
            $new_name = users - code.phpuniqid().time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
            $target = './assets/images/users/' . $new_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $data['avatar'] = $new_name;
            // remove the old image from the database
            $filePath = './assets/images/user/' . $_POST['old_image'];
            if (!empty($image) && file_exists($filePath)) {
                unlink($filePath);
            }
        }else{
            $new_name = $_POST['old_image'];
            $data['avatar'] = $new_name;
        }
        $result = updateRecord('users', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'User updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update user!'
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

if($_GET['action'] === 'deleteSingleUser'){
    $id = validate_input($_POST['id']);
    $image = validate_input($_POST['image']);
    $result = deleteRecord('users', $id);
    if($result){
        $filePath = './assets/images/users/' . $image;
        if (!empty($image) && file_exists($filePath)) {
            unlink($filePath);
        }
        echo json_encode([
            'status' => 200,
            'message' => 'User deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete user!'
        ]);
    }
}