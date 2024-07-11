<?php include "includes/header.php"; ?>

    <div class="page-content">
        <?php display_message(); ?>
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Units</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Units List</h4>
                            <a href="create-units.php" class="btn btn-primary">Add Unit</a>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="example" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Short Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $units = getAllRecord('units');
                                    if(!$units) {
                                        echo "<tr><td colspan='7' class='text-center'>Something went wrong</td></tr>";
                                    }
                                    if(mysqli_num_rows($units) > 0)
                                        foreach($units as $unit) {
                                            $id = $unit['id'];
                                            $name = $unit['name'];
                                            $short_name = $unit['short_name'];
                                            $status = $unit['status'];
                                            if($status == 1){
                                                $status = '<span class="badge bg-success">Active</span>';
                                            }else{
                                                $status = '<span class="badge bg-danger">Inactive</span>';
                                            }
                                            $created_at = $unit['created_at'];
                                            $updated_at = $unit['updated_at'];
                                            $created_at = date('D, d M Y h:i A', strtotime($created_at));
                                            $updated_at = date('D, d M Y h:i A', strtotime($updated_at));
                                            echo "<tr>
                                                        <td>$id</td>
                                                        <td>$name</td>
                                                        <td>$short_name</td>
                                                        <td>$status</td>
                                                        <td>$created_at</td>
                                                        <td>$updated_at</td>
                                                        <td>
                                                            <a href='edit-units.php?id=$id' class='btn btn-sm btn-warning'>
                                                                <i data-feather='edit'></i>
                                                            </a>
                                                            <a href='delete-units.php?id=$id' class='btn btn-sm btn-danger'>
                                                                <i data-feather='trash-2'></i>
                                                            </a>
                                                        </td>
                                                    </tr>";
                                        }else{
                                        echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end data table -->

        </div>
    </div>


<?php include "includes/footer.php"; ?>