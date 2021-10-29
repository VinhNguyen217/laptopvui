<?php
require_once '../classes/user.php';
$user = new User();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $result = false;
    if ($status == 0) {
        $result = $user->update_status($id, 1);
    } else {
        $result = $user->update_status($id, 0);
    }
    if ($result != false)
        echo true;
    else
        echo false;
}
