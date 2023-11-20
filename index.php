<?php
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

$sql = "SELECT * FROM room";
$result = $conn->query($sql);

$rooms = $result->fetch_all(MYSQLI_ASSOC);

echo $blade->run('index', ['rooms' => $rooms]);
$conn->close();
