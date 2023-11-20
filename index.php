<?php
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

$sql = "SELECT id, room_number FROM room";
$result = $conn->query($sql);

$data = $result->fetch_all(MYSQLI_ASSOC);

// print_r($data);

echo $blade->run('index', ['data' => $data]);
$conn->close();
