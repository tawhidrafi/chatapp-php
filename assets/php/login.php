<?php
session_start();
include_once 'config.php';
//GETTING FORM DATA USING AJAX
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
//VALIDATION USER
if (!empty($email) && !empty($password)) {
    //EMAIL VALIDATION
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //
        $sql = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'";
        $query = mysqli_query($conn, $sql);
        //
        if (mysqli_num_rows($query) === 1) {
            $user = mysqli_fetch_assoc($query);
            $status = "Active Now";
            //
            $sql_status = "UPDATE users SET status = '{$status}' WHERE unique_id = {$user['unique_id']}";
            $query_status = mysqli_query($conn, $sql_status);
            //
            if ($query_status) {
                $_SESSION['unique_id'] = $user['unique_id'];
                echo 'success';
            }
        } else {
            echo "Email or Password doesn't match";
        }
    } else {
        echo "Please Type in Valid Email";
    }
} else {
    echo "Please Type Email and Password";
}