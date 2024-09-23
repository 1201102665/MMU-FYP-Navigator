<?php
// Start session to manage messages
session_start();

// Database connection using PDO
require 'db.php'; // This should contain your PDO connection code

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $inquiry = $_POST['inquiry'];
    $message = $_POST['message'];

    try {
        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO contact_requests (name, email, phone, inquiry_type, message) 
                VALUES (:name, :email, :phone, :inquiry_type, :message)";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the form data to the SQL statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':inquiry_type', $inquiry);
        $stmt->bindParam(':message', $message);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = "Thank you! Your message has been sent.";
        } else {
            $_SESSION['error'] = "Sorry! There was an error submitting your request.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    // Redirect to the contact page (or wherever you'd like)
    header('Location: contact.php');
    exit();
}
?>
