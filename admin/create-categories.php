<?php include "includes/header.php"; ?>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->

            <!-- start create admin form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Create Category</h4>
                            <a href="categories.php" class="btn btn-danger">
                                <i data-feather="arrow-left"></i>
                                Back
                            </a>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <form action="code.php" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description (Optional)</label>
                                            <textarea class="form-control" name="description" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" name="save_category">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end create admin form -->
        </div>
    </div>
<?php include "includes/footer.php"; ?>