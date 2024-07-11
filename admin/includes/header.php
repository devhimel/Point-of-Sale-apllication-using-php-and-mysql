<?php require "../config/function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
          content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Dashboard - Point of Sale System in PHP & MySQL</title>
    <script src="./assets/vendors/jquery/jquery.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="./assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./assets/vendors/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="./assets/vendors/toastr/toastr.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="./assets/fonts/feather-font/css/iconfont.css">
    <!--    <link rel="stylesheet" href="./assets/vendors/flag-icon-css/css/flag-icon.min.css">-->
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="./assets/images/favicon.png"/>
    <script src="./assets/vendors/toastr/toastr.js"></script>
    <style>
        .feather{
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php include "sidebar.php"; ?>
    <!-- partial -->

    <div class="page-wrapper">

        <!-- partial:includes/navbar.php -->
        <?php include "navbar.php"; ?>
        <!-- partial -->