<?php
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

$sql = "SELECT r.*, p.URL FROM room r INNER JOIN photo p ON r.id = p.room_id;";
$result = $conn->query($sql);

$rooms = $result->fetch_all(MYSQLI_ASSOC);

echo $blade->run('contact');
$conn->close();
