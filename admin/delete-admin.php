<?php
require "../config/function.php";
$paramResult = checkParam('id');
if(is_numeric($paramResult)) {
    $id = validate_input($paramResult);
    $admin = getRecordById('admins', $id);

    if ($admin) {
        if ($admin['status'] == 200) {
            $result = deleteRecord('admins', $id);
            if ($result) {
                redirect('admins.php', 'Admin deleted successfully', 'success');
            } else {
                redirect('admins.php', 'Something went wrong', 'danger');
            }
        } else {
            redirect('admins.php', 'Admin not found', 'danger');
        }
    } else {
        redirect('admins.php', 'Admin not found', 'danger');
    }

} else {
    redirect('admins.php', 'No id found', 'danger');
}