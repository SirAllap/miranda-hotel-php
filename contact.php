<?php
//BladeTemplate
require_once('view-setup.php');
//DB config
require_once('db-config.php');

$confirmation = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["subject"]) && !empty($_POST["message"])) {
        $full_name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone_number = htmlspecialchars($_POST["phone"]);
        $subject_of_review = htmlspecialchars($_POST["subject"]);
        $review_body = htmlspecialchars($_POST["message"]);
        $sql = "INSERT INTO contact (full_name, email, phone_number, subject_of_review, review_body) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $full_name, $email, $phone_number, $subject_of_review, $review_body);
        if ($stmt->execute()) {
            $confirmation = 'Thank you! Your review has been sent to our team.';
            $error = false;
            echo $blade->run('contact', ['confirmation' =>  $confirmation, 'error' => $error]);
        } else {
            $confirmation = 'Form not sent! | Error: ' . $stmt->error;
            $error = true;
            echo $blade->run('contact', ['confirmation' =>  $confirmation, 'error' => $error]);
        }
        $stmt->close();
    } else {
        $confirmation = "Form fields are not set.";
        $error = true;
        echo $blade->run('contact', ['confirmation' =>  $confirmation, 'error' => $error]);
    }
} else {
    echo $blade->run('contact');
}

$conn->close();
