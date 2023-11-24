<?php
//BladeTemplate
require_once('view-setup.php');
//DB config
require_once('db-config.php');

$sqlWithDiscounts = "SELECT r.*, p.URL 
                    FROM room r 
                    INNER JOIN photo p ON r.id = p.room_id 
                    WHERE r.status = true AND r.discount > 0 
                    LIMIT 5;";

$sqlWithoutDiscounts = "SELECT r.*, p.URL 
                        FROM room r 
                        INNER JOIN photo p ON r.id = p.room_id 
                        WHERE r.status = true 
                        AND r.discount = 0;";

$resultWithDiscounts = $conn->query($sqlWithDiscounts);
$resultWithoutDiscounts = $conn->query($sqlWithoutDiscounts);

$roomsWithDiscounts = $resultWithDiscounts->fetch_all(MYSQLI_ASSOC);
$roomsWithoutDiscounts = $resultWithoutDiscounts->fetch_all(MYSQLI_ASSOC);

foreach ($roomsWithDiscounts as &$room) {
    $room['priceWithDiscount'] = intval($room['price'] - ($room['price'] * ($room['discount'] / 100)));
}

echo $blade->run('offers', ['roomsWithDiscounts' => $roomsWithDiscounts, 'roomsWithoutDiscounts' => $roomsWithoutDiscounts]);
$conn->close();
