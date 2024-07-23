<?php include "includes/header.php"; ?>
    <style>
        .file-upload {
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

        .file-upload input {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            opacity: 0;
        }

        .image_preview-wrapper {
            position: relative;
        }

        .preview_img {
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
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start data table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Products List</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                Add Product
                            </button>
                        </div>
                        <div class="card-body">
                            <?php display_message() ?>
                            <div class="table-responsive">
                                <table id="productTable" class="table dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Cost</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
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

            <!-- add Product Modal -->
            <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Barcode Symbology <span
                                                        class="text-danger">*</span></label>
                                            <select class="form-select" name="barcode_type">
                                                <option value="code128">Code 128</option>
                                                <option value="code39">Code 39</option>
                                                <option value="code25">Code 25</option>
                                                <option value="codabar">Codabar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Code <span
                                                        class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control code" placeholder="Product Code"
                                                       name="code">
                                                <span class="input-group-text generate-code" style="cursor: pointer">
                                                    <i class="ti ti-qrcode"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Category <span
                                                        class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select category" name="category">
                                                    <option value="" disabled selected>Select Category</option>
                                                </select>
                                                <span class="input-group-text addCategory" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select brand" name="brand">
                                                    <option value="" disabled selected>Select Brand</option>
                                                </select>
                                                <span class="input-group-text addBrand" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Unit <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select unit" name="unit">
                                                    <option value="" disabled selected>Select Unit</option>
                                                </select>
                                                <span class="input-group-text addUnit" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Cost <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="cost">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Price <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Quantity <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="quantity">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Upload Product Image</label>
                                        <div class="row">
                                            <div class="col-3 image_preview-wrapper">
                                                <img class="preview_img" src="./assets/images/default-logo.webp">
                                            </div>
                                            <div class="col-9">
                                                <div class="file-upload text-secondary">
                                                    <input type="file" name="image" class="image" accept="image/*">
                                                    <span class="fs-4 fw-2">
                                                        Choose file....
                                                    </span>
                                                    <span>or Drag and Drop</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Description (optional)</label>
                                            <textarea name="description" rows="6" class="form-control"></textarea>
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
            <!-- end add Product Modal -->
            <!-- add Category Modal -->
            <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertCategoryForm">
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
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description (Optional)</label>
                                            <textarea class="form-control" name="description" rows="3"></textarea>
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
            <!-- add Brand Modal -->
            <div class="modal fade" id="addBrandModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertBrandForm">
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
            <!-- add Unit Modal -->
            <div class="modal fade" id="addUnitModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="insertUnitForm">
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
            <!-- end add Unit Modal -->
            <!-- start edit Category Modal -->
            <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                        </div>
                        <form method="post" id="editForm">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Barcode Symbology <span
                                                        class="text-danger">*</span></label>
                                            <select class="form-select barcode_type" name="barcode_type">
                                                <option value="code128">Code 128</option>
                                                <option value="code39">Code 39</option>
                                                <option value="code25">Code 25</option>
                                                <option value="codabar">Codabar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Code <span
                                                        class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control code" placeholder="Product Code"
                                                       name="code">
                                                <span class="input-group-text generate-code" style="cursor: pointer">
                                                    <i class="ti ti-qrcode"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Category <span
                                                        class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select category" name="category">
                                                    <option value="" disabled selected>Select Category</option>
                                                </select>
                                                <span class="input-group-text addCategory" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select brand" name="brand">
                                                    <option value="" disabled selected>Select Brand</option>
                                                </select>
                                                <span class="input-group-text addBrand" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Unit <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select unit" name="unit">
                                                    <option value="" disabled selected>Select Unit</option>
                                                </select>
                                                <span class="input-group-text addUnit" style="cursor: pointer">
                                                    <i class="ti ti-plus"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Cost <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control cost" name="cost">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Price <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control price" name="price">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Quantity <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control quantity" name="quantity">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Upload Product Image</label>
                                        <div class="row">
                                            <div class="col-3 image_preview-wrapper">
                                                <img class="preview_img" src="./assets/images/default-logo.webp">
                                            </div>
                                            <div class="col-9">
                                                <div class="file-upload text-secondary">
                                                    <input type="file" name="image" class="image" accept="image/*">
                                                    <input type="hidden" name="old_image" class="old_image" >
                                                    <span class="fs-4 fw-2">
                                                        Choose file....
                                                    </span>
                                                    <span>or Drag and Drop</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Description (optional)</label>
                                            <textarea name="description" rows="6" class="form-control description"></textarea>
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
            $("input[name='image']").change(function () {
                var file = this.files[0];
                var url = URL.createObjectURL(file);
                $(".preview_img").attr("src", url);
            });


            let table = $('#productTable').DataTable();
            fetchProducts();

            function fetchProducts() {
                $.ajax({
                    url: "./code/products-code.php?action=fetchProducts",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        table.clear().draw();
                        $.each(data, function (key, value) {
                            table.row.add([
                                value.id,
                                `<img src="./assets/images/products/${value.image}" width="200" height="200">`,
                                value.name,
                                value.code,
                                value.brand,
                                value.category,
                                value.cost,
                                value.price,
                                value.unit,
                                value.quantity,
                                value.status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>',
                                `<button type="button" class="btn btn-sm btn-warning editBtn" value="${value.id}"> <i class="ti ti-edit text-white"></i></button>
                                 <button type="button" class="btn btn-sm btn-danger deleteBtn" value="${value.id}"> <i class="ti ti-trash text-white"></i></button>
                                 <input type="hidden" class="delete_img" value="${value.image}">`
                            ]).draw(false);
                        })
                    }
                });
            }

            // fetch Brands Categories and Units
            function fetchBrandSCategoriesUnits() {
                $.ajax({
                    url: "./code/products-code.php?action=fetchBrandSCategoriesUnits",
                    method: "POST",
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;
                        $('.brand').empty().append(`<option value="">Select Brand</option>`);
                        $('.category').empty().append(`<option value="">Select Category</option>`);
                        $('.unit').empty().append(`<option value="">Select Unit</option>`);

                        $.each(data.brands, function (key, value) {
                            $('.brand').append(`<option value="${value.id}">${value.name}</option>`);
                        });
                        $.each(data.categories, function (key, value) {
                            $('.category').append(`<option value="${value.id}">${value.name}</option>`);
                        });
                        $.each(data.units, function (key, value) {
                            $('.unit').append(`<option value="${value.id}">${value.short_name}</option>`);
                        });
                    }
                })
            }

            // When addProduct pop open modal
            $('#addModal').on('shown.bs.modal', function () {
                fetchBrandSCategoriesUnits()
            });

            $("#insertForm").on('click', '.generate-code', function () {
                $.ajax({
                    url: "code.php?action=generateProductCode",
                    method: "POST",
                    success: function (response) {
                        $('.code').val(response.data);
                    }
                });
            });
            $("#insertForm").on('click', '.addCategory', function () {
                $("#addCategoryModal").modal('show');
            });

            $('#insertCategoryForm').on('submit', function (e) {
                $('#insertBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "code.php?action=insertCategory",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        var response = JSON.parse(response);
                        if (response.status == 200) {
                            $('#insertCategoryForm')[0].reset();
                            $('#insertBtn').attr('disabled', false);
                            $('#addCategoryModal').modal('hide');
                            toastr.success(response.message, 'Success');
                            fetchBrandSCategoriesUnits()
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
            $("#insertForm").on('click', '.addBrand', function () {
                $("#addBrandModal").modal('show');
            });

            $('#insertBrandForm').on('submit', function (e) {
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
                            $('#insertBrandForm')[0].reset();
                            $('#insertBtn').attr('disabled', false);
                            $('#addBrandModal').modal('hide');
                            toastr.success(response.message, 'Success');
                            fetchBrandSCategoriesUnits()
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

            $("#insertForm").on('click', '.addUnit', function () {
                $("#addUnitModal").modal('show');
            });

            $('#insertUnitForm').on('submit', function (e) {
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
                            $('#insertUnitForm')[0].reset();
                            $('#insertBtn').attr('disabled', false);
                            $('#addUnitModal').modal('hide');
                            toastr.success(response.message, 'Success');
                            fetchBrandSCategoriesUnits()
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
                    url: "./code/products-code.php?action=insertProduct",
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
                            fetchProducts();
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
            $('#productTable').on('click', '.editBtn', function () {

                var id = $(this).val();
                $('#editModal').modal('show');
                fetchBrandSCategoriesUnits();
                $.ajax({
                    url: "./code/products-code.php?action=fetchSingleProduct",
                    method: "POST",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        var data = response.data;
                        console.log(data)
                        $('#id').val(data.id);
                        $('.code').val(data.code);
                        $('.name').val(data.name);
                        $('.barcode_type').val(data.barcode_type);
                        $('.cost').val(data.cost);
                        $('.quantity').val(data.quantity)
                        $('.price').val(data.price);
                        $('.description').val(data.description);
                        $('.preview_img').attr('src', `./assets/images/products/${data.image}`)
                        $('.old_image').val(data.image);
                        $('.category').val(data.category_id);
                        $('.brand').val(data.brand_id);
                        $('.unit').val(data.unit_id);
                        $('.status').val(data.status)
                    }
                });
            })

            $('#editForm').on('submit', function (e) {
                $('#updateBtn').attr('disabled', 'disabled');
                e.preventDefault();
                $.ajax({
                    url: "./code/products-code.php?action=updateProduct",
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
                            fetchProducts();
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
            $('#productTable').on('click', '.deleteBtn', function () {
                if (confirm("Are you sure you want to delete this product?")) {
                    var id = $(this).val();
                    var image = $(this).closest('tr').find('.delete_img').val();
                    $.ajax({
                        url: "./code/products-code.php?action=deleteSingleProduct",
                        method: "POST",
                        dataType: "json",
                        data: {id: id, image: image},
                        success: function (response) {
                            if (response.status == 200) {
                                fetchProducts();
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