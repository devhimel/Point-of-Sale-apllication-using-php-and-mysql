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