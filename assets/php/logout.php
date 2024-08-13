<?php
session_start();
include_once 'config.php';

if (isset($_SESSION['unique_id'])) {
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
    if (isset($logout_id)) {
        //
        $status = 'offline';
        $sql = "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}";
        $query = mysqli_query($conn, $sql);
        //
        if ($query) {
            session_destroy();
            header('location: ../../login.php');
        }
    }
} else {
    header('location: ../../login.php');
}