<?php
// Database Connection
require "../../config/function.php";

// Add a customer record into database
if ($_GET['action'] === 'insertCustomer') {
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
            'code' => 'cus-'.generateRandomCode(),
            'email' => $email,
            'country' => $country,
            'city' => $city,
            'tax_number' => $tax_number,
            'address' => $address,
            'phone' => $phone,
            'status' => $status
        ];
        $result = insertRecord('customers', $data);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Customer created successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create customer!'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All customer from database
if ($_GET['action'] === 'fetchCompanies') {
    $result = getAllRecord('customers');
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
if ($_GET['action'] === 'fetchSingleCustomer') {
    $id = validate_input($_POST['id']);
    $result = getRecordById('customers', $id);
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
            'message' => 'No customer found with this id!'
        ]);
    }
}

// Update a category record in database
if ($_GET['action'] === 'updateCustomer') {
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
        $result = updateRecord('customers', $data, $id);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Customer updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update customer'
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

if ($_GET['action'] === 'deleteSingleCustomer') {
    $id = validate_input($_POST['id']);
    $result = deleteRecord('customers', $id);
    if ($result) {
        echo json_encode([
            'status' => 200,
            'message' => 'Customer deleted successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete customer!'
        ]);
    }
}