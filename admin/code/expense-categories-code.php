<?php
// Database Connection
require "../../config/function.php";

// Add a expense category record into database
if($_GET['action'] === 'insertExpenseCategory'){
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);
    if($name != '' && $status != ''){
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = insertRecord('expense_categories', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Expense category created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create expense category!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All expense categories from database
if($_GET['action'] === 'fetchExpenseCategories'){
    $result = getAllRecord('expense_categories');
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 200,
        'data' => $data
    ]);
}

// Get a single expense category from database
if($_GET['action'] === 'fetchSingleExpenseCategory'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('expense_categories', $id);
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'data' => $data
        ]);
    }else{
        echo json_encode([
            'status' => 404,
            'message' => 'No expense category found with this id!'
        ]);
    }
}

// Update a expense category record in database
if($_GET['action'] === 'updateExpenseCategory'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);
    if($name != '' && $status != ''){
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = updateRecord('expense_categories', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Expense category updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update expense category'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a expense category record from database

if($_GET['action'] === 'deleteSingleExpenseCategory'){
    $id = validate_input($_POST['id']);
    $result = deleteRecord('expense_categories', $id);
    if($result){
        echo json_encode([
            'status' => 200,
            'message' => 'Expense category deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete expense category'
        ]);
    }
}