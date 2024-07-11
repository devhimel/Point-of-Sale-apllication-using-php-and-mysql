<?php
require '../config/function.php';

if(isset($_SESSION['loggedIn'])) {
    logout();
    redirect('../login.php', 'Logged out successfully.', 'success');
}