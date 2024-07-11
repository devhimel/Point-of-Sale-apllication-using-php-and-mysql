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

if(isset($_POST['save_category'])) {
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);

    // Input validation
    if($name != ''){
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = insertRecord('categories', $data);
        if($result){
            redirect('categories.php', 'Category created successfully', 'success');
        }else{
            redirect('create-categories.php', 'Something went wrong', 'danger');
        }
    }else{
        redirect('create-categories.php', 'Please fill all the fields', 'danger');
    }
}

if(isset($_POST['update_category'])) {
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
    ];
    $result = updateRecord('categories', $data,  $id);
    if($result){
        redirect('categories.php', 'Category updated successfully', 'success');
    }else{
        redirect('edit-categories.php?id='.$id, 'Something went wrong', 'danger');
    }
}