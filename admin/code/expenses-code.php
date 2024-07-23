<?php
// Database Connection
require "../../config/function.php";

// Fetch all Accounts, deposit categories from database
if ($_GET['action'] === 'fetchAccountsExpenseCategory') {
    $accounts = getAllRecord('accounts');
    $expense_categories = getAllRecord('expense_categories');
    $data = [];
    while ($row = mysqli_fetch_assoc($accounts)) {
        $data['accounts'][] = $row;
    }
    while ($row = mysqli_fetch_assoc($expense_categories)) {
        $data['expense_categories'][] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $data
    ]);
}

// Add a expense record into database
if ($_GET['action'] === 'insertExpense') {
    $date = validate_input($_POST['date']);
    $account_id = validate_input($_POST['account_id']);
    $expense_categories_id = validate_input($_POST['expense_categories']);
    $amount = validate_input($_POST['amount']);
    $description = validate_input($_POST['description']);
    if ($date != '' && $account_id != '' && $expense_categories_id != '' && $amount != '') {
        $expenseAccount = mysqli_fetch_assoc(getRecordById('accounts', $account_id));

        if ($amount > $expenseAccount['balance']) {
            echo json_encode([
                'status' => 400,
                'message' => 'Insufficient balance in select expense account!'
            ]);
        } else {
            $expenseAccountUpdateBalance = $expenseAccount['balance'] - $amount;

            $expenseAccountData = [
                'balance' => $expenseAccountUpdateBalance
            ];
            $data = [
                'date' => $date,
                'account_id' => $account_id,
                'expense_category_id' => $expense_categories_id,
                'amount' => $amount,
                'details' => $description,
            ];
            $result = insertRecord('expenses', $data);
            updateRecord('accounts', $expenseAccountData, $account_id);
            if ($result) {
                echo json_encode([
                    'status' => 200,
                    'message' => 'Expense created successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 500,
                    'message' => 'Failed to create expense!'
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

// Get All expenses from database
if ($_GET['action'] === 'fetchExpenses') {
    $query = "SELECT 
        e.id,
        e.date,
        ac.account_name as account,
        ec.name as expenseCategory,
        e.amount,
        e.details
    FROM expenses e
    LEFT JOIN accounts ac ON e.account_id  = ac.id
    LEFT JOIN expense_categories ec ON e.expense_category_id   = ec.id";
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

// Get a single expense from database
if ($_GET['action'] === 'fetchSingleExpense') {
    $id = validate_input($_POST['id']);
    $result = getRecordById('expenses', $id);
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
            'message' => 'No expense found with this id!'
        ]);
    }
}

// Update a expense record in database
if ($_GET['action'] === 'updateExpense') {
    $id = validate_input($_POST['id']);
    $date = validate_input($_POST['date']);
    $account_id = validate_input($_POST['account_id']);
    $expense_categories_id = validate_input($_POST['expense_categories']);
    $amount = validate_input($_POST['amount']);
    $oldAmount = validate_input($_POST['old_amount']);
    $description = validate_input($_POST['description']);
    if ($date != '' && $account_id != '' && $expense_categories_id != '' && $amount != '') {
        $expenseAccount = mysqli_fetch_assoc(getRecordById('accounts', $account_id));

        // Adjust Old balance
        $expenseAccountUpdateOldBalance = $expenseAccount['balance'] + $oldAmount;
        $expenseAccountOldData = [
            'balance' => $expenseAccountUpdateOldBalance
        ];
        updateRecord('accounts', $expenseAccountOldData, $account_id);

        // Update account balance after deposit
        $updatedExpenseAccount = mysqli_fetch_assoc(getRecordById('accounts', $account_id));
        if ($amount > $updatedExpenseAccount['balance']) {
            echo json_encode([
                'status' => 400,
                'message' => 'Insufficient balance in select expense account!'
            ]);
        } else {
            $expenseAccountUpdateBalance = $updatedExpenseAccount['balance'] - $amount;
            $expenseAccountData = [
                'balance' => $expenseAccountUpdateBalance
            ];

            $data = [
                'date' => $date,
                'account_id' => $account_id,
                'expense_category_id' => $expense_categories_id,
                'amount' => $amount,
                'details' => $description,
            ];
            $result = updateRecord('expenses', $data, $id);
            updateRecord('accounts', $expenseAccountData, $account_id);
            if ($result) {
                echo json_encode([
                    'status' => 200,
                    'message' => 'Expense updated successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 500,
                    'message' => 'Failed to update expense'
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

// Delete an deposit record from database
if ($_GET['action'] === 'deleteSingleExpense') {
    $id = validate_input($_POST['id']);
    $expense = mysqli_fetch_assoc(getRecordById('expenses', $id));
    $expenseAccount = mysqli_fetch_assoc(getRecordById('accounts', $expense['account_id']));
    $expenseAccountBalance = $expenseAccount['balance'] + $expense['amount'];
    $expenseAccountData = [
        'balance' => $expenseAccountBalance
    ];
    updateRecord('accounts', $expenseAccountData, $expense['account_id']);
    $result = deleteRecord('expenses', $id);
    if ($result) {
        echo json_encode([
            'status' => 200,
            'message' => 'Expense deleted successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete expense!'
        ]);
    }
}