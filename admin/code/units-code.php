<?php
// Database Connection
require "../../config/function.php";


// Add a unit record into database
if($_GET['action'] === 'insertUnit'){
    if(!empty($_POST['name']) && !empty($_POST['short_name'])){
        $name = validate_input($_POST['name']);
        $short_name = validate_input($_POST['short_name']);
        $status = validate_input($_POST['status']);
        $data = [
            'name' => $name,
            'short_name' => $short_name,
            'status' => $status
        ];
        $result = insertRecord('units', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Unit created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create unit'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All units from database
if($_GET['action'] === 'fetchUnits'){
    $result = getAllRecord('units');
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

// Get a single unit from database
if($_GET['action'] === 'fetchSingleUnit'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('units', $id);
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
            'message' => 'No unit found with this id!'
        ]);
    }
}

// Update a unit record in database
if($_GET['action'] === 'updateUnit'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $short_name = validate_input($_POST['short_name']);
    $status = validate_input($_POST['status']);
    if(!empty($name) && !empty($short_name)){
        $data = [
            'name' => $name,
            'short_name' => $short_name,
            'status' => $status
        ];
        $result = updateRecord('units', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Unit updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update unit!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a unit record from database

if($_GET['action'] === 'deleteSingleUnit'){
    $id = validate_input($_POST['id']);
    $result = deleteRecord('units', $id);
    if($result){
        echo json_encode([
            'status' => 200,
            'message' => 'Unit deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete unit'
        ]);
    }
}