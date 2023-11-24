<?php
session_start();
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

if (isset($_GET["trip-start"]) && isset($_GET["trip-end"])) {
    $start = htmlspecialchars($_GET["trip-start"]);
    $_SESSION['start'] = $start;
    $end = htmlspecialchars($_GET["trip-end"]);
    $_SESSION['end'] = $end;
    $sql = "SELECT r.*, p.URL
            FROM room r
            INNER JOIN photo p ON r.id = p.room_id
            WHERE r.status = true
            AND r.discount = 0
            AND NOT EXISTS (
                SELECT 1
                FROM booking b
                WHERE r.id = b.room_id
                AND (
                    ('$start' BETWEEN b.check_in AND b.check_out)
                    OR ('$end' BETWEEN b.check_in AND b.check_out)
                    OR (b.check_in BETWEEN '$start' AND '$end')
                    OR (b.check_out BETWEEN '$start' AND '$end')
                )
            );";
} else {
    $sql = "SELECT r.*, p.URL 
            FROM room r 
            LEFT JOIN photo p ON r.id = p.room_id 
            WHERE r.status = true 
            AND r.discount = 0;";
}

$result = $conn->query($sql);

$rooms = $result->fetch_all(MYSQLI_ASSOC);

echo $blade->run('rooms', ['rooms' => $rooms]);
$conn->close();
