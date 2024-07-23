<?php
// Database Connection
require "../../config/function.php";

// Add a brand record into database
if($_GET['action'] === 'insertBrand'){
    if(!empty($_POST['name'])){
        $name = validate_input($_POST['name']);
        $description = validate_input($_POST['description']);
        $status = validate_input($_POST['status']);

        // rename the image before saving it to the database
        $original_name = $_FILES['image']['name'];
        $new_name = uniqid(). time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
        $target = './assets/images/brands/' . $new_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $data = [
            'name' => $name,
            'description' => $description,
            'image' => $new_name,
            'status' => $status
        ];
        $result = insertRecord('brands', $data);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Brand created successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to create brand'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Get All brands from database
if($_GET['action'] === 'fetchBrands'){
    $result = getAllRecord('brands');
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

// Get a single brand from database
if($_GET['action'] === 'fetchSingleBrand'){
    $id = validate_input($_POST['id']);
    $result = getRecordById('brands', $id);
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

// Update a brand record in database
if($_GET['action'] === 'updateBrand'){
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $status = validate_input($_POST['status']);
    if(!empty($name)){
        if($_FILES['image']['size'] != 0){
            // rename the image before saving it to the database
            $original_name = $_FILES['image']['name'];
            $new_name = uniqid(). time(). '.' .pathinfo($original_name, PATHINFO_EXTENSION);
            $target = './assets/images/brands/' . $new_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            // remove the old image from the database
            unlink('./assets/images/brands/'.$_POST['old_image']);
        }else{
            $new_name = $_POST['old_image'];
        }
        $data = [
            'name' => $name,
            'description' => $description,
            'image' => $new_name,
            'status' => $status
        ];
        $result = updateRecord('brands', $data, $id);
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'Brand updated successfully'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update brand!'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 400,
            'message' => 'Please fill all the required fields'
        ]);
    }
}

// Delete a brand record from database

if($_GET['action'] === 'deleteSingleBrand'){
    $id = validate_input($_POST['id']);
    $image = validate_input($_POST['image']);
    $result = deleteRecord('brands', $id);
    if($result){
        $filePath = './assets/images/brands/' . $image;
        if (!empty($image) && file_exists($filePath)) {
            unlink($filePath);
        }
        echo json_encode([
            'status' => 200,
            'message' => 'Brand deleted successfully'
        ]);
    }else{
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to delete unit'
        ]);
    }
}
