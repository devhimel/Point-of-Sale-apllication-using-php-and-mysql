<?php
// Database Connection
require "../config/function.php";

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