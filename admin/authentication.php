<?php

if(isset($_SESSION['loggedIn'])) {
    $email = $_SESSION['loggedInUser']['email'];

    $sql = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){

        $admin = mysqli_fetch_assoc($result);
        if($admin['status'] == 0){
            logout();
            redirect('../login.php', 'Your account is deactivated.', 'danger');
        }
    }else{
        logout();
        redirect('../login.php', 'Access denied', 'danger');
    }
}else {
    redirect('../login.php', 'Please login first.', 'danger');
}
?>