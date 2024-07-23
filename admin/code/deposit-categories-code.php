<?php
// Database Connection
require "../../config/function.php";

// Add a deposit category record into database
if($_GET['action'] === 'insertDepositCategory'){
    $name = validate_input($_POST['name']);
    $status = validate_input($_POST['status']);
    if($name != '' && $status != ''){
        $data = [
            'title' => $name,
            'status' => $status
        ];
        $result = insertRecord('deposit_categories', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Deposit category created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create deposit category!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All deposit categories from database
if($_GET['action'] === 'fetchDepositCategories'){
    $result = getAllRecord('deposit_categories');
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

// Get a single deposit category from database
if($_GET['action'] === 'fetchSingleDepositCategory'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('deposit_categories', $id);
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
            'message' => 'No category found with this id!'
        ]);
    }
}

// Update a deposit category record in database
if($_GET['action'] === 'updateDepositCategory'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $status = validate_input($_POST['status']);
    if($name != '' && $status != ''){
        $data = [
            'title' => $name,
            'status' => $status
        ];
        $result = updateRecord('deposit_categories', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Deposit category updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update deposit category'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a deposit category record from database

if($_GET['action'] === 'deleteSingleDepositCategory'){
    $id = validate_input($_POST['id']);
    $result = deleteRecord('deposit_categories', $id);
    if($result){
        echo json_encode([
            'status' => 200,
            'message' => 'Deposit Category deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete deposit category'
        ]);
    }
}