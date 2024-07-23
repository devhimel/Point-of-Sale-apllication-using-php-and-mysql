<?php
// Database Connection
require "../../config/function.php";

// Add a category record into database
if($_GET['action'] === 'insertCategory'){
    if(!empty($_POST['name'])){
        $name = validate_input($_POST['name']);
        $description = validate_input($_POST['description']);
        $status = validate_input($_POST['status']);
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = insertRecord('categories', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Category created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Something went wrong'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All categories from database
if($_GET['action'] === 'fetchCategories'){
    $result = getAllRecord('categories');
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

// Get a single category from database
if($_GET['action'] === 'fetchSingleCategory'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('categories', $id);
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

// Update a category record in database
if($_GET['action'] === 'updateCategory'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);
    if(!empty($name)){
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = updateRecord('categories', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Category updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update category'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a category record from database

if($_GET['action'] === 'deleteSingleCategory'){
    $id = validate_input($_POST['id']);
    $result = deleteRecord('categories', $id);
    if($result){
        echo json_encode([
            'status' => 200,
            'message' => 'Category deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete category'
        ]);
    }
}