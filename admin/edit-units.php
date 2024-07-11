<?php include "includes/header.php"; ?>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="units.php">Units</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->

            <!-- start create admin form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Edit Unit</h4>
                            <a href="units.php" class="btn btn-danger">
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
                                $unit = getRecordById('units', $id);

                                if ($unit) {
                                    if ($unit['status'] == 200) {
                                        $id = $unit['data']['id'];
                                        $name = $unit['data']['name'];
                                        $short_name = $unit['data']['short_name'];
                                        $status = $unit['data']['status'];
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
                                                    <label class="form-label">Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="short_name" required
                                                           value="<?= $short_name ?>">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="status" required>
                                                        <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Active
                                                        </option>
                                                        <option value="0" <?= $status == 0 ? 'selected' : '' ?>>Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update_unit">Update</button>
                                        <?php
                                    } else {
                                        echo '<h5>'.$unit['message'].'</h5>';
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