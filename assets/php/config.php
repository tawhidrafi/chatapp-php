<?php
//declaring the requisites
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'chatapp';
//setting the connection
$conn = new mysqli($host, $user, $pass, $dbname);
//check connenction
if (!$conn) {
    echo '<h1>Database Not Connected</h1>';
}
