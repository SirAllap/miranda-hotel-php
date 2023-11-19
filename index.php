<?php
require 'lib/BladeOne.php';
require __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/')->load();

include("config.php");

$sql = "SELECT id, room_number FROM room";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($columns = $result->fetch_assoc()) {
        echo "ID: " . $columns["id"] . " - Room Number: " . $columns["room_number"] . "\n";
    }
} else {
    echo "0 results";
}
$conn->close();

use eftec\bladeone\BladeOne;

$views = 'views'; // Specify the directory where your Blade templates are located.
$compiledFolder = 'cache'; // Specify the directory where compiled views will be stored.

$blade = new BladeOne($views, $compiledFolder, BladeOne::MODE_AUTO);

// Example usage
echo $blade->run('index');
