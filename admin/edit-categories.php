<?php include "includes/header.php"; ?>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->

            <!-- start create admin form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Edit Category</h4>
                            <a href="categories.php" class="btn btn-danger">
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
                                $category = getRecordById('categories', $id);

                                if ($category) {
                                    if ($category['status'] == 200) {
                                        $id = $category['data']['id'];
                                        $name = $category['data']['name'];
                                        $description = $category['data']['description'];
                                        $status = $category['data']['status'];
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

                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description"
                                                              rows="5"><?= $description ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update_category">Update</button>
                                        <?php
                                    } else {
                                        echo '<h5>'.$category['message'].'</h5>';
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