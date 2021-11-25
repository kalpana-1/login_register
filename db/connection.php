<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "user_login";


// create connection
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    echo "Failed to connect to MYSQL :". $conn->connect_error;
    exit();
}