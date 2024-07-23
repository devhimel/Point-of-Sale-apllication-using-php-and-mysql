<?php include "includes/header.php"; ?>

    <div class="page-content">
        <?php display_message(); ?>
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start greeting -->
            <h4>Welcome back <span class="text-primary"><?= $_SESSION['loggedInUser']['first_name'].' '. $_SESSION['loggedInUser']['last_name']; ?></span></h4>
            <!-- end greeting -->

        </div>
    </div>


<?php include "includes/footer.php"; ?>