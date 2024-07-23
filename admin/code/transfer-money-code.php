<?php
// Database Connection
require "../../config/function.php";

// Fetch all accounts from database
if ($_GET['action'] === 'fetchAccounts') {
    $accounts = getAllRecord('accounts');
    $data = [];
    while ($row = mysqli_fetch_assoc($accounts)) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $data
    ]);
}

// Add a transfer money record into database
if ($_GET['action'] === 'insertTransferMoney') {
    $date = validate_input($_POST['date']);
    $amount = validate_input($_POST['amount']);
    $from_account_id = validate_input($_POST['from_account_id']);
    $to_account_id = validate_input($_POST['to_account_id']);
    if ($date != '' && $amount != '' && $from_account_id != '' && $to_account_id != '') {
        $fromAccount = mysqli_fetch_assoc(getRecordById('accounts', $from_account_id));
        $toAccount = mysqli_fetch_assoc(getRecordById('accounts', $to_account_id));
        if ($from_account_id == $to_account_id) {
            echo json_encode([
                'status' => 400,
                'message' => 'Account From and to account cannot be the same!'
            ]);
        } elseif ($amount > $fromAccount['balance']) {
            echo json_encode([
                'status' => 400,
                'message' => 'Insufficient balance in the from account!'
            ]);
        } else {
            $fromAccountUpdateBalance = $fromAccount['balance'] - $amount;
            $toAccountUpdateBalance = $toAccount['balance'] + $amount;

            $fromAccountData = [
                'balance' => $fromAccountUpdateBalance
            ];

            $toAccountData = [
                'balance' => $toAccountUpdateBalance
            ];

            updateRecord('accounts', $fromAccountData, $from_account_id);
            updateRecord('accounts', $toAccountData, $to_account_id);
            $data = [
                'from_account_id' => $from_account_id,
                'to_account_id' => $to_account_id,
                'date' => $date,
                'amount' => $amount,
            ];
            $result = insertRecord('transfer_money', $data);
            if ($result) {
                echo json_encode([
                    'status' => 200,
                    'message' => 'Transfer Money created successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 500,
                    'message' => 'Failed to create transfer money!'
                ]);
            }
        }

    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All supplier from database
if ($_GET['action'] === 'fetchTransfersMoney') {
    $query = "SELECT 
        t.id,
        a.account_name as fromAccount,
        b.account_name  as toAccount,
        t.date,
        t.amount
    FROM transfer_money t
    LEFT JOIN accounts a ON t.from_account_id  = a.id
    LEFT JOIN accounts b ON t.to_account_id   = b.id";
//    $result = getAllRecord('transfer_money');
    $result = mysqli_query($conn, $query);
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