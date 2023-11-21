<?php
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

$sql = "SELECT r.*, COALESCE(p.URL, 'https://picsum.photos/seed/WsPyhTrC/640/480') AS URL FROM room r LEFT JOIN photo p ON r.id = p.room_id;";
$result = $conn->query($sql);

$rooms = $result->fetch_all(MYSQLI_ASSOC);

echo $blade->run('rooms', ['rooms' => $rooms]);
$conn->close();
