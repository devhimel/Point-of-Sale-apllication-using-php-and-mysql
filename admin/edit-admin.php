<?php include "includes/header.php"; ?>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="admins.php">Admins</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->

            <!-- start create admin form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Edit Admin/Staff</h4>
                            <a href="admins.php" class="btn btn-danger">
                                <i data-feather="arrow-left"></i>
                                Back
                            </a>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <form action="code.php" method="post">

                                <?php
                                if (isset($_GET['id'])) {
                                    if ($_GET['id'] != '') {
                                        $id = $_GET['id'];

                                    } else {
                                        echo '<h5>No Id Found</h5>';
                                        return false;
                                    }

                                } else {
                                    echo '<h5>No Id given in url</h5>';
                                    return false;
                                }
                                $admin = getRecordById('admins', $id);

                                if ($admin) {
                                    if ($admin['status'] == 200) {
                                        $id = $admin['data']['id'];
                                        $name = $admin['data']['name'];
                                        $email = $admin['data']['email'];
                                        $password = $admin['data']['password'];
                                        $phone = $admin['data']['phone'];
                                        $status = $admin['data']['status'];
                                        ?>
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Name <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name" required
                                                           value="<?= $name ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Email <span
                                                                class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" required
                                                           value="<?= $email ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="text" class="form-control" name="password">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="phone" required
                                                           value="<?= $phone ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                                    <select class="form-select" name="status" required>
                                                        <option <?= $status == 1 ? 'selected' : '' ?> value="1">Active
                                                        </option>
                                                        <option <?= $status == 0 ? 'selected' : '' ?> value="0">
                                                            Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update_admin">Save</button>
                                        <?php
                                    } else {
                                        echo '<h5>'.$admin['message'].'</h5>';
                                    }
                                } else {
                                    echo '<h5>Something went wrong!</h5>';
                                    return false;
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end create admin form -->
        </div>
    </div>
<?php include "includes/footer.php"; ?>