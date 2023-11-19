<?php

$servername = $_SERVER['SERVERNAME'];
$username = $_SERVER['USERNAME'];
$password = $_SERVER['PASSWORD'];
$database = $_SERVER['DATABASE'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully \n";
