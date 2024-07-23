<?php include "includes/header.php"; ?>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Suppliers</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Suppliers List</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                Add Supplier
                            </button>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="suppliersTable" class="table dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier Code</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Tax Number</th>
                                        <th>Total Sale Due</th>
                                        <th>Total Sale Return Due</th>
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
            <!-- add Supplier Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 mb3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Supplier Name">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Supplier Email">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control" name="country" placeholder="Enter Supplier Country">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" name="city" placeholder="Enter Supplier City">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Phone (Optional)</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Supplier Phone Number">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tax Number</label>
                                        <input type="text" class="form-control" name="tax_number" placeholder="Enter Supplier Tax Number">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" cols="30" rows="4" class="form-control" placeholder="Enter Supplier Address"></textarea>
                                    </div>
                                    <div class="col-6 mb-3">
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
            <!-- end add Supplier Modal -->
            <!-- start edit Supplier Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="editForm">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-6 mb3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control name" name="name" placeholder="Enter Supplier Name">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control email" name="email" placeholder="Enter Supplier Email">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control country" name="country" placeholder="Enter Supplier Country">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control city" name="city" placeholder="Enter Supplier City">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Phone (Optional)</label>
                                        <input type="text" class="form-control phone" name="phone" placeholder="Enter Supplier Phone Number">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tax Number</label>
                                        <input type="text" class="form-control tax_number" name="tax_number" placeholder="Enter Supplier Tax Number">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" cols="30" rows="4" class="form-control address" placeholder="Enter Supplier Address"></textarea>
                                    </div>
                                    <div class="col-6 mb-3">
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
            <!-- end edit Supplier Modal -->

        </div>
    </div>

    <script>
        $(document).ready(function () {
            let table = $('#suppliersTable').DataTable();
            fetchSuppliers();

            function fetchSuppliers() {
                $.ajax({
                    url: "./code/suppliers-code.php?action=fetchSuppliers",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        table.clear().draw();
                        $.each(data, function (key, value) {
                            table.row.add([
                                value.id,
                                value.code,
                                value.name,
                                value.email ? value.email : 'N/A',
                                value.phone ? value.phone : 'N/A',
                                value.tax_number ? value.tax_number : 'N/A',
                                value.total_sale_due ? value.total_sale_due : '0.00',
                                value.total_sale_return_due ? value.total_sale_return_due : '0.00',
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
                    url: "./code/suppliers-code.php?action=insertSupplier",
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
                            fetchSuppliers();
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

            // edit category
            $('#suppliersTable').on('click', '.editBtn', function () {
                var id = $(this).val();
                $.ajax({
                    url: "./code/suppliers-code.php?action=fetchSingleSupplier",
                    method: "POST",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        var data = response.data;
                        $('#id').val(data.id);
                        $('.name').val(data.name);
                        $('.email').val(data.email);
                        $('.country').val(data.country);
                        $('.city').val(data.city);
                        $('.phone').val(data.phone);
                        $('.tax_number').val(data.tax_number);
                        $('.address').val(data.address);
                        $('.status').val(data.status)
                        $('#editModal').modal('show');
                    }
                });
            })

            $('#editForm').on('submit', function (e) {
                $('#updateBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/suppliers-code.php?action=updateSupplier",
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
                            fetchSuppliers();
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

            // Delete Category
            $('#suppliersTable').on('click', '.deleteBtn', function () {
                if (confirm("Are you sure you want to delete this supplier?")) {
                    var id = $(this).val();
                    $.ajax({
                        url: "./code/suppliers-code.php?action=deleteSingleSupplier",
                        method: "POST",
                        dataType: "json",
                        data: {id: id},
                        success: function (response) {
                            if (response.status == 200) {
                                fetchSuppliers();
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