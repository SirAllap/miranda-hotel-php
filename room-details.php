<?php
session_start();
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

if (isset($_GET["room_id"])) {
    isset($_SESSION['start']) ? $start = $_SESSION['start'] : $start = null;
    isset($_SESSION['end']) ? $end = $_SESSION['end'] : $end = null;
    $id = htmlspecialchars($_GET["room_id"]);

    $sql = "SELECT r.*, p.URL FROM room r INNER JOIN photo p ON r.id = p.room_id WHERE r.id = $id;";
}

$result = $conn->query($sql);

$room = $result->fetch_assoc();

echo $blade->run('room-details', ['room' => $room, 'start' => $start, 'end' => $end]);

$conn->close();
session_destroy();
