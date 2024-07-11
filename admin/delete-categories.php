<?php
require "../config/function.php";
$paramResult = checkParam('id');
if(is_numeric($paramResult)) {
    $id = validate_input($paramResult);
    $category = getRecordById('categories', $id);

    if ($category) {
        if ($category['status'] == 200) {
            $result = deleteRecord('categories', $id);
            if ($result) {
                redirect('categories.php', 'Category deleted successfully', 'success');
            } else {
                redirect('categories.php', 'Something went wrong', 'danger');
            }
        } else {
            redirect('categories.php', 'Category not found', 'danger');
        }
    } else {
        redirect('categories.php', 'Category not found', 'danger');
    }

} else {
    redirect('categories.php', 'No id found', 'danger');
}