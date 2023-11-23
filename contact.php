<?php
//BladeTemplate
require_once('setup.php');
//DB config
require_once('config.php');
$confirmation = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["subject"]) && isset($_POST["message"])) {
        $full_name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone_number = htmlspecialchars($_POST["phone"]);
        $subject_of_review = htmlspecialchars($_POST["subject"]);
        $review_body = htmlspecialchars($_POST["message"]);

        $sql = "INSERT INTO contact (full_name, email, phone_number, subject_of_review, review_body, date, status) VALUES (?, ?, ?, ?, ?, CURDATE(), true)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $full_name, $email, $phone_number, $subject_of_review, $review_body);

        if ($stmt->execute()) {

            $confirmation = 'Form sent!';
        } else {
            $confirmation = 'Form not sent! | Error: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        $confirmation = "Form fields are not set.";
    }
}

echo $blade->run('contact', ['confirmation' =>  $confirmation]);
$conn->close();
