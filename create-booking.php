<?php
session_start();
//BladeTemplate
require_once('view-setup.php');
//DB config
require_once('db-config.php');

if (isset($_POST["trip-start"]) && isset($_POST["trip-end"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["special-request"])) {
    $trip_start = htmlspecialchars($_POST["trip-start"]);
    $trip_end = htmlspecialchars($_POST["trip-end"]);
    $full_name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone_number = htmlspecialchars($_POST["phone"]);
    $special_request = htmlspecialchars($_POST["special-request"]);
    $room_id = $_SESSION['room_id'];

    $sqlCheckAvailability =
        "SELECT
                    *
                FROM
                    room r
                WHERE
                    r.id = $room_id
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
                ";

    $stmt = $conn->prepare($sqlCheckAvailability);

    if ($stmt->execute()) {
        $stmt->free_result();
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
    } else {
        $confirmation = 'Apologize, but the selected room is no longer available within the selected dates';
        echo $blade->run('room-details', ['confirmation' =>  $confirmation]);
    }

    $stmt->close();
} else {
    $confirmation = "Form fields are not set.";
    echo $blade->run('room-details');
}

$conn->close();
