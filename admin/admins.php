<?php include "includes/header.php"; ?>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Admins</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Admins</h4>
                            <a href="create-admin.php" class="btn btn-primary">Add Admin</a>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="example" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Last Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $admins = getAllRecord('admins');
                                        if(!$admins) {
                                            echo "<tr><td colspan='7' class='text-center'>Something went wrong</td></tr>";
                                        }
                                        if(mysqli_num_rows($admins) > 0)
                                            foreach($admins as $admin) {
                                                $id = $admin['id'];
                                                $name = $admin['name'];
                                                $email = $admin['email'];
                                                $phone = $admin['phone'];
                                                $status = $admin['status'];
                                                if($status == 1){
                                                    $status = '<span class="badge bg-success">Active</span>';
                                                }else{
                                                    $status = '<span class="badge bg-danger">Inactive</span>';
                                                }
                                                $created_at = $admin['created_at'];
                                                $updated_at = $admin['updated_at'];
                                                $created_at = date('D, d M Y h:i A', strtotime($created_at));
                                                $updated_at = date('D, d M Y h:i A', strtotime($updated_at));
                                                echo "<tr>
                                                        <td>$id</td>
                                                        <td>$name</td>
                                                        <td>$email</td>
                                                        <td>$phone</td>
                                                        <td>$status</td>
                                                        <td>$created_at</td>
                                                        <td>$updated_at</td>
                                                        <td>
                                                            <a href='edit-admin.php?id=$id' class='btn btn-sm btn-warning'>
                                                                <i data-feather='edit'></i>
                                                            </a>
                                                            <a href='delete-admin.php?id=$id' class='btn btn-sm btn-danger'>
                                                                <i data-feather='trash-2'></i>
                                                            </a>
                                                        </td>
                                                    </tr>";
                                            }else{
                                                echo "<tr><td colspan='7' class='text-center'>No admins found</td></tr>";
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