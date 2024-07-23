<?php include "includes/header.php"; ?>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Accounts</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Accounts List</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                Add Account
                            </button>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="accountsTable" class="table dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Account Number</th>
                                        <th>Account Name</th>
                                        <th>Balance</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end data table -->
            <!-- add Account Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Account Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="account_name" placeholder="Enter Account Name">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Account Number</label>
                                        <input type="text" class="form-control" name="account_number" placeholder="Enter Account Number">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Initial Balance</label>
                                        <input type="text" class="form-control" name="initial_balance" value="0">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Details</label>
                                        <textarea name="details" cols="30" rows="4" class="form-control" placeholder="A few words...."></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="insertBtn" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end add Account Modal -->
            <!-- start edit Account Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="editForm">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Account Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control account_name" name="account_name" placeholder="Enter Account Name">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Account Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control account_number" name="account_number" placeholder="Enter Account Number">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Details</label>
                                        <textarea name="details" cols="30" rows="4" class="form-control details" placeholder="A few words...."></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select status" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="updateBtn" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end edit Account Modal -->

        </div>
    </div>

    <script>
        $(document).ready(function () {
            let table = $('#accountsTable').DataTable();
            fetchAccounts();

            function fetchAccounts() {
                $.ajax({
                    url: "./code/accounts-code.php?action=fetchAccounts",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        table.clear().draw();
                        $.each(data, function (key, value) {
                            table.row.add([
                                value.id,
                                value.account_num,
                                value.account_name,
                                value.balance,
                                value.note,
                                value.status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>',
                                `<button type="button" class="btn btn-sm btn-warning editBtn" value="${value.id}"> <i class="ti ti-edit text-white"></i></button>
                             <button type="button" class="btn btn-sm btn-danger deleteBtn" value="${value.id}"> <i class="ti ti-trash text-white"></i></button>`
                            ]).draw(false);
                        })
                    }
                });
            }

            $('#insertForm').on('submit', function (e) {
                $('#insertBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/accounts-code.php?action=insertAccount",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        var response = JSON.parse(response);
                        if (response.status == 200) {
                            $('#insertForm')[0].reset();
                            $('#insertBtn').attr('disabled', false);
                            $('#addModal').modal('hide');
                            toastr.success(response.message, 'Success');
                            fetchAccounts();
                        } else if (response.status == 500) {
                            $('#insertBtn').attr('disabled', false);
                            toastr.error(response.message, 'Error!');
                        } else if (response.status == 400) {
                            $('#insertBtn').attr('disabled', false);
                            toastr.error(response.message, 'Error!');
                        }
                    }
                });
            });

            // edit account
            $('#accountsTable').on('click', '.editBtn', function () {
                var id = $(this).val();
                $.ajax({
                    url: "./code/accounts-code.php?action=fetchSingleAccount",
                    method: "POST",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        var data = response.data;
                        $('#id').val(data.id);
                        $('.account_name').val(data.account_name);
                        $('.account_number').val(data.account_num);
                        $('.details').val(data.note);
                        $('.status').val(data.status)
                        $('#editModal').modal('show');
                    }
                });
            })

            $('#editForm').on('submit', function (e) {
                $('#updateBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/accounts-code.php?action=updateAccount",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        var response = JSON.parse(response);
                        if (response.status == 200) {
                            $('#editForm')[0].reset();
                            $('#updateBtn').attr('disabled', false);
                            $('#editModal').modal('hide');
                            toastr.success(response.message, 'Success');
                            fetchAccounts();
                        } else if (response.status == 500) {
                            $('#updateBtn').attr('disabled', false);
                            toastr.error(response.message, 'Error!');
                        } else if (response.status == 400) {
                            $('#updateBtn').attr('disabled', false);
                            toastr.error(response.message, 'Error!');
                        }
                    }
                });
            });

            // Delete Account
            $('#accountsTable').on('click', '.deleteBtn', function () {
                if (confirm("Are you sure you want to delete this account?")) {
                    var id = $(this).val();
                    $.ajax({
                        url: "./code/accounts-code.php?action=deleteSingleAccount",
                        method: "POST",
                        dataType: "json",
                        data: {id: id},
                        success: function (response) {
                            if (response.status == 200) {
                                fetchAccounts();
                                toastr.success(response.message, 'Success');
                            } else if (response.status == 500) {
                                toastr.error(response.message, 'Error!');
                            }
                        }
                    });
                }
            })
        });
    </script>
<?php include "includes/footer.php"; ?>