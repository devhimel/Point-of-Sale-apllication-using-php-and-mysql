<?php
// Database Connection
require "../../config/function.php";

// Add a supplier record into database
if ($_GET['action'] === 'insertSupplier') {
    $name = validate_input($_POST['name']);
    $email = validate_input($_POST['email']);
    $country = validate_input($_POST['country']);
    $city = validate_input($_POST['city']);
    $tax_number = validate_input($_POST['tax_number']);
    $phone = validate_input($_POST['phone']);
    $address = validate_input($_POST['address']);
    $status = validate_input($_POST['status']);
    if ($name != '' && $status != '') {
        $data = [
            'name' => $name,
            'code' => 'sup-'.generateRandomCode(),
            'email' => $email,
            'country' => $country,
            'city' => $city,
            'tax_number' => $tax_number,
            'address' => $address,
            'phone' => $phone,
            'status' => $status
        ];
        $result = insertRecord('suppliers', $data);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Supplier created successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create supplier!'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All supplier from database
if ($_GET['action'] === 'fetchSuppliers') {
    $result = getAllRecord('suppliers');
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $data
    ]);
}

// Get a single category from database
if ($_GET['action'] === 'fetchSingleSupplier') {
    $id = validate_input($_POST['id']);
    $result = getRecordById('suppliers', $id);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'message' => 'No supplier found with this id!'
        ]);
    }
}

// Update a category record in database
if ($_GET['action'] === 'updateSupplier') {
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $email = validate_input($_POST['email']);
    $country = validate_input($_POST['country']);
    $city = validate_input($_POST['city']);
    $tax_number = validate_input($_POST['tax_number']);
    $phone = validate_input($_POST['phone']);
    $address = validate_input($_POST['address']);
    $status = validate_input($_POST['status']);
    if ($name != '' && $status != '') {
        $data = [
            'name' => $name,
            'email' => $email,
            'country' => $country,
            'city' => $city,
            'tax_number' => $tax_number,
            'address' => $address,
            'phone' => $phone,
            'status' => $status
        ];
        $result = updateRecord('suppliers', $data, $id);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Supplier updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update supplier'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a category record from database

if ($_GET['action'] === 'deleteSingleSupplier') {
    $id = validate_input($_POST['id']);
    $result = deleteRecord('suppliers', $id);
    if ($result) {
        echo json_encode([
            'status' => 200,
            'message' => 'Supplier deleted successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete supplier!'
        ]);
    }
}