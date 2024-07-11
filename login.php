<?php require "config/function.php";
if(isset($_SESSION['loggedIn'])) {
    redirect('admin/index.php', 'Already logged in.', 'success');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="./admin/assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="/admin/assets/fonts/feather-font/css/iconfont.css">
<!--    <link rel="stylesheet" href="./admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">-->
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="/admin/assets/css/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="./admin/assets/images/favicon.png" />
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-6 col-xl-3 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="index.php" class="noble-ui-logo d-block mb-2 text-center">POS<span> Application</span></a>
                                    <h5 class="text-muted fw-normal mb-4 text-center">Welcome back! Log in to your account.</h5>
                                    <?php display_message() ?>
                                    <form action="login-code.php" class="forms-sample px-lg-3 px-2" method="post">
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email" required value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password" required>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="authCheck">
                                            <label class="form-check-label" for="authCheck">
                                                Remember me
                                            </label>
                                        </div>
                                        <div>
                                            <button type="submit" name="login" class="btn btn-primary me-2 mb-2 mb-md-0 w-100">Login</button>
                                        </div>
                                        <a href="register.php" class="d-block mt-3 text-muted text-center">Not a user? Sign up</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- core:js -->
<script src="./admin/assets/vendors/core/core.js"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="./admin/assets/vendors/feather-icons/feather.min.js"></script>
<script src="./admin/assets/js/template.js"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<!-- End custom js for this page -->

</body>
</html>