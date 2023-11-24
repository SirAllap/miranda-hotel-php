<?php
//BladeTemplate
require_once('view-setup.php');
//DB config
require_once('db-config.php');

$sql = "SELECT r.*, p.URL FROM room r INNER JOIN photo p ON r.id = p.room_id;";
$result = $conn->query($sql);

$rooms = $result->fetch_all(MYSQLI_ASSOC);

echo $blade->run('about-us');
$conn->close();
