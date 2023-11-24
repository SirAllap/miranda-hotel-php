<?php
session_start();
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');



if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["room_id"]) && isset($_GET["trip-start"]) && isset($_GET["trip-end"])) {
        $id = htmlspecialchars($_GET["room_id"]);
        $trip_start = htmlspecialchars($_GET["trip-start"]);
        $trip_end = htmlspecialchars($_GET["trip-end"]);

        $sql = "SELECT
                    r.*,
                    p.URL,
                    b.check_in,
                    b.check_out,
                    GROUP_CONCAT(a.amenities SEPARATOR ', ') AS all_amenities
                FROM
                    room r
                    INNER JOIN photo p ON r.id = p.room_id
                    LEFT JOIN amenities_has_room ahr ON r.id = ahr.room_id
                    LEFT JOIN amenity a ON ahr.amenity_id = a.id
                    INNER JOIN booking b ON r.id = b.room_id
                WHERE
                    r.id = $id
                    AND NOT EXISTS (
                        SELECT 1
                        FROM booking b_sub
                        WHERE r.id = b_sub.room_id
                            AND (
                                ('$trip_start' BETWEEN b_sub.check_in AND b_sub.check_out)
                                OR ('$trip_end' BETWEEN b_sub.check_in AND b_sub.check_out)
                                OR (b_sub.check_in BETWEEN '$trip_start' AND '$trip_end')
                                OR (b_sub.check_out BETWEEN '$trip_start' AND '$trip_end')
                            )
                    )
                GROUP BY
                    r.id, p.URL, b.check_in, b.check_out;
                ";
        $sqlRelatedRooms = "SELECT r.*, p.URL 
                            FROM room r 
                            LEFT JOIN photo p ON r.id = p.room_id 
                            WHERE r.status = true 
                            AND r.discount = 0 
                            LIMIT 10;";

        $result = $conn->query($sql);
        $room = $result->fetch_assoc();
        $resultRelatedRooms = $conn->query($sqlRelatedRooms);
        $rooms = $resultRelatedRooms->fetch_all(MYSQLI_ASSOC);
        echo $blade->run('room-details', ['room' => $room, 'rooms' => $rooms, 'start' => $trip_start, 'end' => $trip_end]);
    } else if (isset($_GET["room_id"])) {
        isset($_SESSION['start']) ? $start = $_SESSION['start'] : $start = null;
        isset($_SESSION['end']) ? $end = $_SESSION['end'] : $end = null;
        $id = htmlspecialchars($_GET["room_id"]);
        $_SESSION['room_id'] = $id;
        $sql = "SELECT
                r.*,
                p.URL,
                b.check_in,
                b.check_out,
                GROUP_CONCAT(a.amenities SEPARATOR ', ') AS all_amenities
                FROM
                    room r
                    INNER JOIN photo p ON r.id = p.room_id
                    LEFT JOIN amenities_has_room ahr ON r.id = ahr.room_id
                    LEFT JOIN amenity a ON ahr.amenity_id = a.id
                    INNER JOIN booking b ON r.id = b.room_id
                WHERE
                    r.id = $id
                GROUP BY
                    r.id, p.URL, b.check_in, b.check_out;";

        $sqlRelatedRooms = "SELECT r.*, p.URL 
                            FROM room r 
                            LEFT JOIN photo p ON r.id = p.room_id 
                            WHERE r.status = true 
                            AND r.discount = 0 
                            LIMIT 10;";

        $result = $conn->query($sql);
        $room = $result->fetch_assoc();
        $resultRelatedRooms = $conn->query($sqlRelatedRooms);
        $rooms = $resultRelatedRooms->fetch_all(MYSQLI_ASSOC);
        echo $blade->run('room-details', ['room' => $room, 'rooms' => $rooms, 'start' => $start, 'end' => $end]);
    } else {
        echo $blade->run('index', ['confirmation' =>  'Something went wrong, please try again!']);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["trip-start"]) && isset($_POST["trip-end"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["special-request"])) {
        $trip_start = htmlspecialchars($_POST["trip-start"]);
        $trip_end = htmlspecialchars($_POST["trip-end"]);
        $full_name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone_number = htmlspecialchars($_POST["phone"]);
        $special_request = htmlspecialchars($_POST["special-request"]);
        $room_id = $_SESSION['room_id'];

        $sql = "INSERT INTO booking (guest, phone_number, email, order_date, check_in, check_out, special_request, status, room_id) 
                VALUES (?, ?, ?, CURDATE(), ?, ?, ?, 'Check In', ?);";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $full_name, $phone_number, $email, $trip_start, $trip_end, $special_request, $room_id);

        if ($stmt->execute()) {
            session_destroy();
            $confirmation = 'Thank you for your request. We have received it correctly. Someone from our Team will get back to you very soon.';
            header('Refresh: 3; "index.php"');
            echo $blade->run('index', ['confirmation' =>  $confirmation]);
        } else {
            $confirmation = 'Form not sent! | Error: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        $confirmation = "Form fields are not set.";
        echo $blade->run('room-details');
    }
}

$conn->close();
