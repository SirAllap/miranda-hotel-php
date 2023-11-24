<?php
session_start();
//BladeTemplate
require_once('view-setup.php');
//DB config
require_once('db-config.php');

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
                        AND r.id != $id
                        AND r.discount = 0 
                        ORDER BY rand()
                        LIMIT 10;";

    $result = $conn->query($sql);
    $room = $result->fetch_assoc();

    if (isset($room['discount'])) {
        $room['priceWithDiscount'] = intval($room['price'] - ($room['price'] * ($room['discount'] / 100)));
    }
    $resultRelatedRooms = $conn->query($sqlRelatedRooms);
    $rooms = $resultRelatedRooms->fetch_all(MYSQLI_ASSOC);

    echo $blade->run('room-details', ['room' => $room, 'rooms' => $rooms, 'start' => $trip_start, 'end' => $trip_end]);
} else if (isset($_GET["room_id"])) {
    isset($_SESSION['start']) ? $trip_start = $_SESSION['start'] : $trip_start = null;
    isset($_SESSION['end']) ? $trip_end = $_SESSION['end'] : $trip_end = null;
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
                        AND r.id != $id
                        AND r.discount = 0 
                        ORDER BY rand()
                        LIMIT 10;";

    $result = $conn->query($sql);
    $room = $result->fetch_assoc();

    if (isset($room['discount'])) {
        $room['priceWithDiscount'] = intval($room['price'] - ($room['price'] * ($room['discount'] / 100)));
    }

    $resultRelatedRooms = $conn->query($sqlRelatedRooms);
    $rooms = $resultRelatedRooms->fetch_all(MYSQLI_ASSOC);
    echo $blade->run('room-details', ['room' => $room, 'rooms' => $rooms, 'start' => $trip_start, 'end' => $trip_end]);
} else {
    echo $blade->run('index', ['confirmation' =>  'Something went wrong, please try again!']);
}


$conn->close();
