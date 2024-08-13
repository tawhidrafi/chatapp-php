<?php
session_start();
include_once 'config.php';
//GETTING SIGN UP FORM DATA USING AJAX
$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
//FORM
if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
    //EMAIL VALIDATION
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "Select email FROM users WHERE email = '{$email}'";
        $query = mysqli_query($conn, $sql);
        //CHECK IF EMAIL ALREADY EXIST
        if (mysqli_num_rows($query) > 0) {
            echo "Email exists!";
        } else {
            //WORKING ON THE IMAGE
            if (isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                //IMAGE EXTENSIONS
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);
                //VALID EXTENSIONS
                $extensions = ['png', 'jpeg', 'jpg'];
                //CHECK IF IMAGE EXTENSION IS VALID
                if (in_array($img_ext, $extensions) === true) {
                    $time = time();
                    //TO MOVE TO THE FOLDER
                    $img_upload = '../img/' . $time . $img_name;
                    //DATA TO BE INSERTED IN THE DB
                    $img_db = 'assets/img/' . $time . $img_name;
                    $random_id = rand(time(), 10000000);
                    $status = 'Active now';
                    $sql2 = "INSERT INTO users (unique_id, firstName, lastName, email, password, img, status) VALUES ({$random_id}, '{$firstName}', '{$lastName}', '{$email}', '{$password}', '{$img_db}', '{$status}')";
                    $query2 = mysqli_query($conn, $sql2);
                    //FINAL CONDITION
                    if ($query2) {
                        //SEND IMAGE URL IN DB
                        move_uploaded_file($tmp_name, $img_upload);
                        //GETTING THE USER DATA FOR SESSION
                        $sql3 = "SELECT * FROM users WHERE email = '{$email}'";
                        $query3 = mysqli_query($conn, $sql3);
                        if (mysqli_num_rows($query3) > 0) {
                            $user = mysqli_fetch_assoc($query3);
                            $_SESSION['unique_id'] = $user['unique_id'];
                            echo "Success";
                        }
                    } else {
                        echo "Something Went Wrong";
                    }
                } else {
                    echo "Please Select any jpeg, jpg, png file";
                }
            } else {
                echo "Please upload any image file";
            }
        }
    } else {
        echo "Not Valid Email";
    }
} else {
    echo "All input fields are required";
}