<?php include "includes/header.php"; ?>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Deposits</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Deposits List</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                Add Deposit
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
                                        <th>Amount</th>
                                        <th>Deposit Category</th>
                                        <th>Account</th>
                                        <th>Details</th>
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
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Deposit</h5>
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
                                        <label class="form-label">Account <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-select account_id" name="account_id">
                                                <option value="" selected disabled>Choose Account</option>
                                            </select>
                                            <span class="input-group-text addAccount" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Deposit Category <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-select deposit_categories" name="deposit_categories">
                                                <option value="" selected disabled>Select Deposit Category</option>
                                            </select>
                                            <span class="input-group-text addDepositCategory" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control amount" name="amount" placeholder="Enter deposit amount.">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" cols="30" rows="4" placeholder="A few words...." class="form-control description"></textarea>
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
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control date" name="date">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Account <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-select account_id" name="account_id">
                                                <option value="" selected disabled>Choose Account</option>
                                            </select>
                                            <span class="input-group-text addAccount" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Deposit Category <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-select deposit_categories" name="deposit_categories">
                                                <option value="" selected disabled>Select Deposit Category</option>
                                            </select>
                                            <span class="input-group-text addDepositCategory" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control old_amount" name="old_amount">
                                        <input type="text" class="form-control amount" name="amount" placeholder="Enter deposit amount.">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" cols="30" rows="4" placeholder="A few words...." class="form-control description"></textarea>
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

            <!-- add Deposit Category Modal -->
            <div class="modal fade" id="addDepositCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Deposit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertDepositCategoryForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
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
            <!-- end add Deposit Category Modal -->
            <!-- add Account Modal -->
            <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertAccountForm">
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

        </div>
    </div>

    <script>
        $(document).ready(function () {
            let table = $('#accountsTable').DataTable();
            fetchDeposits();

            function fetchDeposits() {
                $.ajax({
                    url: "./code/deposits-code.php?action=fetchDeposits",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        table.clear().draw();
                        $.each(data, function (key, value) {
                            var date = new Date(value.date);
                            var year = date.getFullYear();
                            var month = date.getMonth() + 1;
                            month = month.toString().padStart(2, '0');
                            var day = date.getDay().toString().padStart(2,'0');
                            var dateFormat = `${day}/${month}/${year}`
                            table.row.add([
                                value.id,
                                dateFormat,
                                value.amount,
                                value.depositCategory,
                                value.account,
                                value.description,
                                `<button type="button" class="btn btn-sm btn-warning editBtn" value="${value.id}"> <i class="ti ti-edit text-white"></i></button>
                             <button type="button" class="btn btn-sm btn-danger deleteBtn" value="${value.id}"> <i class="ti ti-trash text-white"></i></button>`
                            ]).draw(false);
                        })
                    }
                });
            }

            // fetch Accounts and deposit categories
            function fetchAccountsDepositCategory() {
                $.ajax({
                    url: "./code/deposits-code.php?action=fetchAccountsDepositCategory",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        $('.account_id').empty().append(`<option value="">Choose Account</option>`);
                        $('.deposit_categories').empty().append(`<option value="">Select Deposit Category</option>`);

                        $.each(data.accounts, function (key, value) {
                            $('.account_id').append(`<option value="${value.id}">${value.account_name}</option>`);
                        });
                        $.each(data.deposit_categories, function (key, value) {
                            $('.deposit_categories').append(`<option value="${value.id}">${value.title}</option>`);
                        });
                    }
                })
            }

            // When add modal pop open modal
            $('#addModal').on('shown.bs.modal', function () {
                fetchAccountsDepositCategory()
            });
            // Show Account pop up
            $("#insertForm").on('click', '.addAccount', function () {
                $("#addAccountModal").modal('show');
            });

            // Insert Account form
            $('#insertAccountForm').on('submit', function (e) {
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
                            $('#insertAccountForm')[0].reset();
                            $('#insertBtn').attr('disabled', false);
                            $('#addAccountModal').modal('hide');
                            toastr.success(response.message, 'Success');
                            fetchAccountsDepositCategory()
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
            // Show Deposit Category pop up
            $("#insertForm").on('click', '.addDepositCategory', function () {
                $("#addDepositCategoryModal").modal('show');
            });
            // Insert Deposit Category From
            $('#insertDepositCategoryForm').on('submit', function (e) {
                $('#insertBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/deposit-categories-code.php?action=insertDepositCategory",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        var response = JSON.parse(response);
                        if (response.status == 200) {
                            $('#insertDepositCategoryForm')[0].reset();
                            $('#insertBtn').attr('disabled', false);
                            $('#addDepositCategoryModal').modal('hide');
                            toastr.success(response.message, 'Success');
                            fetchAccountsDepositCategory()
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

            $('#insertForm').on('submit', function (e) {
                $('#insertBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/deposits-code.php?action=insertDeposit",
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
                            fetchDeposits();
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
                fetchAccountsDepositCategory()
                var id = $(this).val();
                $.ajax({
                    url: "./code/deposits-code.php?action=fetchSingleDeposit",
                    method: "POST",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        var data = response.data;
                        console.log(data)
                        $('#id').val(data.id);
                        $('.date').val(data.date);
                        $('.account_id').val(data.account_id);
                        $('.deposit_categories').val(data.deposit_category_id);
                        $('.old_amount').val(data.amount);
                        $('.amount').val(data.amount);
                        $('.description').val(data.description);
                        $('#editModal').modal('show');
                    }
                });
            })

            $('#editForm').on('submit', function (e) {
                $('#updateBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/deposits-code.php?action=updateDeposit",
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
                            fetchDeposits();
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
                if (confirm("Are you sure you want to delete this deposit?")) {
                    var id = $(this).val();
                    $.ajax({
                        url: "./code/deposits-code.php?action=deleteSingleDeposit",
                        method: "POST",
                        dataType: "json",
                        data: {id: id},
                        success: function (response) {
                            if (response.status == 200) {
                                fetchDeposits();
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