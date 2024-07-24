<?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.css">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transfers Money</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Transfers Money List</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                Add Transfer Money
                            </button>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="accountsTable" class="table table-responsive"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>From Account</th>
                                        <th>To Account</th>
                                        <th>Amount</th>
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
            <!-- add Transfer Money Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Transfer Money</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control date" name="date">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="amount"
                                               placeholder="Enter Amount">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">From Account <span
                                                    class="text-danger">*</span></label>
                                        <select class="form-select from_account_id" name="from_account_id">
                                            <option value="" selected disabled>Choose Account</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">To Account <span class="text-danger">*</span></label>
                                        <select class="form-select to_account_id" name="to_account_id">
                                            <option value="" selected disabled>Choose Account</option>
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
            <!-- end add Transfer Money Modal -->
            <!-- start edit Transfer Money Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Transfer Money</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="editForm">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Account Name <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" class="form-control account_name" name="account_name"
                                               placeholder="Enter Account Name">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Account Number <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" class="form-control account_number" name="account_number"
                                               placeholder="Enter Account Number">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Details</label>
                                        <textarea name="details" cols="30" rows="4" class="form-control details"
                                                  placeholder="A few words...."></textarea>
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
            <!-- end edit Transfer Money Modal -->

        </div>
    </div>
    <script src="./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function () {
            // $('.date').datepicker();
            let table = $('#accountsTable').DataTable();
            fetchTransfersMoney();

            function fetchTransfersMoney() {
                $.ajax({
                    url: "./code/transfer-money-code.php?action=fetchTransfersMoney",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        table.clear().draw();
                        $.each(data, function (key, value) {
                            table.row.add([
                                value.id,
                                value.date,
                                value.fromAccount,
                                value.toAccount,
                                value.amount,
                                `<button type="button" class="btn btn-sm btn-warning editBtn" value="${value.id}"> <i class="ti ti-edit text-white"></i></button>
                             <button type="button" class="btn btn-sm btn-danger deleteBtn" value="${value.id}"> <i class="ti ti-trash text-white"></i></button>`
                            ]).draw(false);
                        })
                    }
                });
            }
            // fetch Accounts
            function fetchAccounts() {
                $.ajax({
                    url: "./code/transfer-money-code.php?action=fetchAccounts",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        $('.from_account_id').empty().append(`<option value="">Choose Account</option>`);
                        $('.to_account_id').empty().append(`<option value="">Choose Account</option>`);

                        $.each(data, function (key, value) {
                            $('.from_account_id').append(`<option value="${value.id}">${value.account_name}</option>`);
                        });
                        $.each(data, function (key, value) {
                            $('.to_account_id').append(`<option value="${value.id}">${value.account_name}</option>`);
                        });
                    }
                })
            }

            // When addModal pop open modal
            $('#addModal').on('shown.bs.modal', function () {
                fetchAccounts()
            });

            $('#insertForm').on('submit', function (e) {
                $('#insertBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/transfer-money-code.php?action=insertTransferMoney",
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
                            fetchTransfersMoney();
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
                    url: "accounts-code.php?action=fetchSingleAccount",
                    method: "POST",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        var data = response.data;
                        $('#id').val(data.id);
                        $('.account_name').val(data.account_num);
                        $('.account_number').val(data.account_name);
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
                    url: "accounts-code.php?action=updateAccount",
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
                            fetchTransfersMoney();
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
                        url: "accounts-code.php?action=deleteSingleAccount",
                        method: "POST",
                        dataType: "json",
                        data: {id: id},
                        success: function (response) {
                            if (response.status == 200) {
                                fetchTransfersMoney();
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