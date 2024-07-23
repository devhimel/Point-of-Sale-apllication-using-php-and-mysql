<?php

require 'config/function.php';

if (isset($_POST['login'])) {
    $email = validate_input($_POST['email']);
    $password = validate_input($_POST['password']);

    if ($email != '' && $password != '') {
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $admin = mysqli_fetch_assoc($result);
                $hashedPassword = $admin['password'];

                if (!password_verify($password, $hashedPassword)) {
                    redirect('login.php', 'Invalid password.', 'error');
                }

                if ($admin['status'] == 0) {
                    redirect('login.php', 'Your account is deactivated.', 'error');
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'id' => $admin['id'],
                    'first_name' => $admin['first_name'],
                    'last_name' => $admin['last_name'],
                    'avatar' => $admin['avatar'],
                    'email' => $admin['email'],
                    'phone' => $admin['phone'],
                ];

                redirect('admin/index.php', 'Login successful.', 'success');

            } else {
                redirect('login.php', 'Invalid email.', 'error');
            }

        } else {
            redirect('login.php', 'Something went wrong', 'error');
        }
    } else {
        redirect('login.php', 'Please fill required fields.', 'error');
    }
}