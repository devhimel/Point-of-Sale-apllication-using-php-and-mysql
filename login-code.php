<?php

require 'config/function.php';

if(isset($_POST['login'])) {
    $email = validate_input($_POST['email']);
    $password = validate_input($_POST['password']);

    if($email != '' && $password != ''){
        $sql = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){

                $admin = mysqli_fetch_assoc($result);
                $hashedPassword = $admin['password'];
                if(!password_verify($password, $hashedPassword)){
                    redirect('login.php', 'Invalid password.', 'danger');
                }

                if($admin['status'] == 0){
                    redirect('login.php', 'Your account is deactivated.', 'danger');
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'id' => $admin['id'],
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'phone' => $admin['phone'],
                ];

                redirect('admin/index.php', 'Login successful.', 'success');


            }else{
                redirect('login.php', 'Invalid email.', 'danger');
            }

        }else{
            redirect('login.php', 'Something went wrong', 'danger');
        }
    }else{
        redirect('login.php', 'Please fill required fields.', 'danger');
    }
}