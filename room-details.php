<?php
session_start();
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["room_id"])) {
        isset($_SESSION['start']) ? $start = $_SESSION['start'] : $start = null;
        isset($_SESSION['end']) ? $end = $_SESSION['end'] : $end = null;
        $id = htmlspecialchars($_GET["room_id"]);
        $_SESSION['room_id'] = $id;

        $sql = "SELECT r.*, p.URL FROM room r INNER JOIN photo p ON r.id = p.room_id WHERE r.id = $id;";

        $sqlRelatedRooms = "SELECT r.*, p.URL FROM room r LEFT JOIN photo p ON r.id = p.room_id WHERE r.status = true LIMIT 10;";
    }
    $result = $conn->query($sql);
    $room = $result->fetch_assoc();

    $resultRelatedRooms = $conn->query($sqlRelatedRooms);
    $rooms = $resultRelatedRooms->fetch_all(MYSQLI_ASSOC);

    echo $blade->run('room-details', ['room' => $room, 'rooms' => $rooms, 'start' => $start, 'end' => $end]);
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["trip-start"]) && isset($_POST["trip-end"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["special-request"])) {
        $trip_start = htmlspecialchars($_POST["trip-start"]);
        $trip_end = htmlspecialchars($_POST["trip-end"]);
        $full_name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone_number = htmlspecialchars($_POST["phone"]);
        $special_request = htmlspecialchars($_POST["special-request"]);
        $room_id = $_SESSION['room_id'];

        $sql = "INSERT INTO booking (guest, phone_number, email, order_date, check_in, check_out, special_request, status, room_id) VALUES (?, ?, ?, CURDATE(), ?, ?, ?, 'Check In', ?);";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $full_name, $phone_number, $email, $trip_start, $trip_end, $special_request, $room_id);

        if ($stmt->execute()) {
            $confirmation = 'Thank you for your request. We have received it correctly. Someone from our Team will get back to you very soon.';

            echo $blade->run('index', ['confirmation' =>  $confirmation]);
            session_destroy();
        } else {
            $confirmation = [null, $stmt->error];
            $_SESSION['confirmation'] = ['message' => 'Form not sent!', 'error' => true];
        }

        $stmt->close();
    } else {
        $confirmation = "Form fields are not set.";
        echo $blade->run('room-details');
    }
}

$conn->close();
