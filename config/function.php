<?php
// Start The Session
session_start();

// Database Connection
require 'dbcon.php';

// Input field Validation
function validate_input($inputData)
{
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}

// Redirect from one page to another page with message
function redirect($url, $message, $message_type)
{
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $message_type;
    header('Location: '.$url);
    exit(0);
}

// Display message or status after any process
function display_message()
{
    if (isset($_SESSION['message'])) {
        ?>
        <script>
            toastr.<?= $_SESSION['message_type'] ?>("<?= $_SESSION['message'] ?>", "<?= ucfirst($_SESSION['message_type']) ?>");
        </script>
<!--        <div class="alert alert---><?php //= $_SESSION['message_type'] ?><!-- alert-dismissible fade show" role="alert">-->
<!--            --><?php //= $_SESSION['message'] ?>
<!--            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
<!--        </div>-->
        <?php
        unset($_SESSION['message']);
    }
}

// Insert new record into database
function insertRecord($table, $data)
{
    global $conn;
    // validated input value
    $table = validate_input($table);
    $columns = implode(', ', array_keys($data));
    $values = implode("', '", $data);
    $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Update record in database
function updateRecord($table, $data, $id)
{
    global $conn;
    $table = validate_input($table);
    $id = validate_input($id);

    $updateDataString = '';
    foreach ($data as $column => $value) {
        $updateDataString .= $column." = '".$value."',";
    }

    $finalUpdateData = substr(trim($updateDataString), 0, -1);
    $sql = "UPDATE $table SET $finalUpdateData WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}


// Get All records from database
function getAllRecord($table, $status = '')
{
    global $conn;
    $table = validate_input($table);
    $status = validate_input($status);

    if ($status) {
        $sql = "SELECT * FROM $table WHERE status = '$status'";
    } else {
        $sql = "SELECT * FROM $table";
    }
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Get Single record from database
function getRecordById($table, $id)
{
    global $conn;
    $table = validate_input($table);
    $id = validate_input($id);
    $sql = "SELECT * FROM $table WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Delete record from database
function deleteRecord($table, $id)
{
    global $conn;
    $table = validate_input($table);
    $id = validate_input($id);
    $sql = "DELETE FROM $table WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Check parameter is set or not
function checkParam($param)
{
    if(isset($_GET[$param])){
        if($_GET[$param] != ''){
            return $_GET[$param];
        }else{
            return '<h5>No Id found</h5>';
        }
    }else{
        return '<h5>No Id given in url</h5>';
    }
}

function logout()
{
    unset($_SESSION['loggedIn']);
    unset($_SESSION['loggedInUser']);
}

// Generate Random unique product code
function generateRandomCode($length = 6) {
    // Ensuring that the requested length is within a reasonable limit
    if ($length <= 0) {
        return '';
    }

    $prefix = uniqid('', true); // Generates a unique identifier with more entropy
    $randomString = substr(md5($prefix . microtime()), 0, $length); // Combine with microtime for extra uniqueness and hash it with md5
    return $randomString;
}
