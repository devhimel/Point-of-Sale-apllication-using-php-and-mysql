<?php include "includes/header.php"; ?>

    <div class="page-content">
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                Add Unit
                            </button>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="unitTable" class="table dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end data table -->

            <!-- add Category Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertForm">
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
                                            <label class="form-label">Short Name <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="short_name">
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
            <!-- end add Category Modal -->
            <!-- start edit Category Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="editForm">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Short Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="short_name" name="short_name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
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
            <!-- end edit Category Modal -->

        </div>
    </div>

    <script>
        $(document).ready(function () {
            let table = $('#unitTable').DataTable();
            fetchUnits();

            function fetchUnits() {
                $.ajax({
                    url: "code.php?action=fetchUnits",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        table.clear().draw();
                        $.each(data, function (key, value) {
                            table.row.add([
                                value.id,
                                value.name,
                                value.short_name,
                                value.status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>',
                                value.created_at,
                                value.updated_at,
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
                    url: "code.php?action=insertUnit",
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
                            fetchUnits();
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
            $('#unitTable').on('click', '.editBtn', function () {
                var id = $(this).val();
                $.ajax({
                    url: "code.php?action=fetchSingleUnit",
                    method: "POST",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        var data = response.data;
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#short_name').val(data.short_name);
                        $('#status').val(data.status)
                        $('#editModal').modal('show');
                    }
                });
            })

            $('#editForm').on('submit', function (e) {
                $('#updateBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "code.php?action=updateUnit",
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
                            fetchUnits();
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
            $('#unitTable').on('click', '.deleteBtn', function () {
                if (confirm("Are you sure you want to delete this unit?")) {
                    var id = $(this).val();
                    $.ajax({
                        url: "code.php?action=deleteSingleUnit",
                        method: "POST",
                        dataType: "json",
                        data: {id: id},
                        success: function (response) {
                            if (response.status == 200) {
                                fetchUnits();
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