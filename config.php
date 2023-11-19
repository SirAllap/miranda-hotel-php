<?php

$servername = $_SERVER['SERVERNAME'];
$username = $_USER['USERNAME'];
$password = $_PASS['PASSWORD'];
$database = $_DB['DATABASE'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully \n";
