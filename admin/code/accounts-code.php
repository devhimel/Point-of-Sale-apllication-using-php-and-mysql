<?php
// Database Connection
require "../../config/function.php";

// Add a account record into database
if ($_GET['action'] === 'insertAccount') {
    $account_name = validate_input($_POST['account_name']);
    $account_number = validate_input($_POST['account_number']);
    $initial_balance = validate_input($_POST['initial_balance']);
    $details = validate_input($_POST['details']);
    $status = validate_input($_POST['status']);
    if ($account_name != '' && $account_number != '' && $initial_balance != '' && $status != '') {
        $data = [
            'account_num' => $account_number,
            'account_name' => $account_name,
            'initial_balance' => $initial_balance,
            'balance' => $initial_balance,
            'note' => $details,
            'status' => $status
        ];
        $result = insertRecord('accounts', $data);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Account created successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create account!'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All accounts from database
if ($_GET['action'] === 'fetchAccounts') {
    $result = getAllRecord('accounts');
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
if ($_GET['action'] === 'fetchSingleAccount') {
    $id = validate_input($_POST['id']);
    $result = getRecordById('accounts', $id);
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
            'message' => 'No account found with this id!'
        ]);
    }
}

// Update a account record in database
if ($_GET['action'] === 'updateAccount') {
    $id = validate_input($_POST['id']);
    $account_name = validate_input($_POST['account_name']);
    $account_number = validate_input($_POST['account_number']);
    $details = validate_input($_POST['details']);
    $status = validate_input($_POST['status']);
    if ($account_name != '' && $account_number != '' && $status != '') {
        $data = [
            'account_num' => $account_number,
            'account_name' => $account_name,
            'note' => $details,
            'status' => $status
        ];
        $result = updateRecord('accounts', $data, $id);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Account updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update account'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete an account record from database

if ($_GET['action'] === 'deleteSingleAccount') {
    $id = validate_input($_POST['id']);
    $result = deleteRecord('accounts', $id);
    if ($result) {
        echo json_encode([
            'status' => 200,
            'message' => 'Account deleted successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete account!'
        ]);
    }
}