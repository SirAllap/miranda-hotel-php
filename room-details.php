<?php
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

if (isset($_GET["room_id"])) {
    $id = htmlspecialchars($_GET["room_id"]);

    $sql = "SELECT r.*, p.URL FROM room r INNER JOIN photo p ON r.id = p.room_id WHERE r.id = $id;";
}

$result = $conn->query($sql);

$room = $result->fetch_assoc();

echo $blade->run('room-details', ['room' => $room]);

$conn->close();
