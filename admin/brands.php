<?php include "includes/header.php"; ?>
    <style>
        .file-upload{
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 150px;
            padding: 3px;
            border: 1px dashed silver;
            border-radius: 8px;
        }
        .file-upload input{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            opacity: 0;
        }
        .image_preview-wrapper{
            position: relative;
        }

        .preview_img{
            width: 115px;
            height: 115px;
            border-radius: 100%;
            object-fit: cover;
            border: 4px solid silver;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Brands List</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                Add Brand
                            </button>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="brandTable" class="table dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
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

            <!-- add Brand Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
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
                                            <label class="form-label">Description (optional)</label>
                                            <textarea name="description" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Upload Brand Logo</label>
                                        <div class="row">
                                            <div class="col-3 image_preview-wrapper">
                                                <img class="preview_img" src="./assets/images/default-logo.webp">
                                            </div>
                                            <div class="col-9">
                                                <div class="file-upload text-secondary">
                                                    <input type="file" name="image" class="image" accept="image/*" >
                                                    <span class="fs-4 fw-2">
                                                        Choose file....
                                                    </span>
                                                    <span>or Drag and Drop</span>
                                                </div>
                                            </div>
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
            <!-- end add Brand Modal -->
            <!-- start edit Brand Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
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
                                            <input type="text" class="form-control name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description (optional)</label>
                                            <textarea name="description" rows="4" class="form-control description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Upload Brand Logo</label>
                                        <div class="row">
                                            <div class="col-3 image_preview-wrapper">
                                                <img class="preview_img" src="./assets/images/default-logo.webp">
                                            </div>
                                            <div class="col-9">
                                                <div class="file-upload text-secondary">
                                                    <input type="file" name="image" class="image" accept="image/*" >
                                                    <input type="hidden" name="old_image" class="old_image" >
                                                    <span class="fs-4 fw-2">
                                                        Choose file....
                                                    </span>
                                                    <span>or Drag and Drop</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select status" name="status">
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
            <!-- end edit Brand Modal -->

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("input[name='image']").change(function () {
                var file = this.files[0];
                var url = URL.createObjectURL(file);
                $(".preview_img").attr("src", url);
            });


            let table = $('#brandTable').DataTable();
            fetchBrands();

            function fetchBrands() {
                $.ajax({
                    url: "code.php?action=fetchBrands",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        table.clear().draw();
                        $.each(data, function (key, value) {
                            table.row.add([
                                value.id,
                                `<img src="./assets/images/brands/${value.image}" width="200" height="200">`,
                                value.name,
                                value.description,
                                value.status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>',
                                value.created_at,
                                value.updated_at,
                                `<button type="button" class="btn btn-sm btn-warning editBtn" value="${value.id}"> <i class="ti ti-edit text-white"></i></button>
                                 <button type="button" class="btn btn-sm btn-danger deleteBtn" value="${value.id}"> <i class="ti ti-trash text-white"></i></button>
                                 <input type="hidden" class="delete_img" value="${value.image}">`
                            ]).draw(false);
                        })
                    }
                });
            }

            $('#insertForm').on('submit', function (e) {
                $('#insertBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "code.php?action=insertBrand",
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
                            fetchBrands();
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

            // edit brand
            $('#brandTable').on('click', '.editBtn', function () {
                var id = $(this).val();
                $.ajax({
                    url: "code.php?action=fetchSingleBrand",
                    method: "POST",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        var data = response.data;
                        $('#id').val(data.id);
                        $('.name').val(data.name);
                        $('.description').val(data.description);
                        // $('.image').val(data.image);
                        $('.preview_img').attr('src', `./assets/images/brands/${data.image}`)
                        $('.old_image').val(data.image);
                        $('.status').val(data.status)
                        $('#editModal').modal('show');
                    }
                });
            })

            $('#editForm').on('submit', function (e) {
                $('#updateBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "code.php?action=updateBrand",
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
                            fetchBrands();
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

            // Delete brands
            $('#brandTable').on('click', '.deleteBtn', function () {
                if (confirm("Are you sure you want to delete this unit?")) {
                    var id = $(this).val();
                    var image = $(this).closest('tr').find('.delete_img').val();
                    $.ajax({
                        url: "code.php?action=deleteSingleBrand",
                        method: "POST",
                        dataType: "json",
                        data: {id: id, image: image},
                        success: function (response) {
                            if (response.status == 200) {
                                fetchBrands();
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