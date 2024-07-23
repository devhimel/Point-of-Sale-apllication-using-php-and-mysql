<?php
// Database Connection
require "../../config/function.php";

// Fetch all Accounts, deposit categories from database
if($_GET['action'] === 'fetchAccountsDepositCategory'){
    $accounts = getAllRecord('accounts');
    $deposit_categories = getAllRecord('deposit_categories');
    $data = [];
    while($row = mysqli_fetch_assoc($accounts)){
        $data['accounts'][] = $row;
    }
    while($row = mysqli_fetch_assoc($deposit_categories)){
        $data['deposit_categories'][] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $data
    ]);
}

// Add a deposit record into database
if ($_GET['action'] === 'insertDeposit') {
    $date = validate_input($_POST['date']);
    $account_id = validate_input($_POST['account_id']);
    $deposit_category_id = validate_input($_POST['deposit_categories']);
    $amount = validate_input($_POST['amount']);
    $description = validate_input($_POST['description']);
    if ($date != '' && $account_id != '' && $deposit_category_id != '' && $amount != '') {
        $depositAccount = mysqli_fetch_assoc(getRecordById('accounts', $account_id));

        $depositAccountUpdateBalance = $depositAccount['balance'] + $amount;

        $depositAccountData =[
            'balance' => $depositAccountUpdateBalance
        ];
        $data = [
            'date' => date('d/m/Y', strtotime($date)),
            'account_id' => $account_id,
            'deposit_category_id' => $deposit_category_id,
            'amount' => $amount,
            'description' => $description,
        ];
        $result = insertRecord('deposits', $data);
        updateRecord('accounts', $depositAccountData, $account_id);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Deposit created successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create deposit!'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All deposits from database
if ($_GET['action'] === 'fetchDeposits') {
    $query = "SELECT 
        dep.id,
        dep.date,
        ac.account_name as account,
        dc.title as depositCategory,
        dep.amount,
        dep.description
    FROM deposits dep
    LEFT JOIN accounts ac ON dep.account_id  = ac.id
    LEFT JOIN deposit_categories dc ON dep.deposit_category_id  = dc.id";
//    $result = getAllRecord('deposits');
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

// Get a single deposit from database
if ($_GET['action'] === 'fetchSingleDeposit') {
    $id = validate_input($_POST['id']);
    $result = getRecordById('deposits', $id);
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

// Update a deposit record in database
if ($_GET['action'] === 'updateDeposit') {
    $id = validate_input($_POST['id']);
    $date = validate_input($_POST['date']);
    $account_id = validate_input($_POST['account_id']);
    $deposit_category_id = validate_input($_POST['deposit_categories']);
    $amount = validate_input($_POST['amount']);
    $oldAmount = validate_input($_POST['old_amount']);
    $description = validate_input($_POST['description']);
    if ($date != '' && $account_id != '' && $deposit_category_id != '' && $amount != '') {
        $depositAccount = mysqli_fetch_assoc(getRecordById('accounts', $account_id));

        // Adjust Old balance
        $depositAccountUpdateOldBalance = $depositAccount['balance'] - $oldAmount;
        $depositAccountOldData =[
            'balance' => $depositAccountUpdateOldBalance
        ];
        updateRecord('accounts', $depositAccountOldData, $account_id);

        // Update account balance after deposit
        $updatedDepositAccount = mysqli_fetch_assoc(getRecordById('accounts', $account_id));

        $depositAccountUpdateBalance = $updatedDepositAccount['balance'] + $amount;
        $depositAccountData =[
            'balance' => $depositAccountUpdateBalance
        ];

        $data = [
            'date' => $date,
            'account_id' => $account_id,
            'deposit_category_id' => $deposit_category_id,
            'amount' => $amount,
            'description' => $description,
        ];
        $result = updateRecord('deposits', $data, $id);
        updateRecord('accounts', $depositAccountData, $account_id);
        if ($result) {
            echo json_encode([
                'status' => 200,
                'message' => 'Deposit updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update deposit'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete an deposit record from database

if ($_GET['action'] === 'deleteSingleDeposit') {
    $id = validate_input($_POST['id']);
    $deposit = mysqli_fetch_assoc(getRecordById('deposits', $id));
    $depositedAccount = mysqli_fetch_assoc(getRecordById('accounts', $deposit['account_id']));
    $depositedAccountBalance = $depositedAccount['balance'] - $deposit['amount'];
    $depositedAccountData =[
        'balance' => $depositedAccountBalance
    ];
    updateRecord('accounts', $depositedAccountData, $deposit['account_id']);
    $result = deleteRecord('deposits', $id);
    if ($result) {
        echo json_encode([
            'status' => 200,
            'message' => 'Deposit deleted successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete deposit!'
        ]);
    }
}