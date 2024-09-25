<?php
session_start();
require 'db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: signin.php");
    exit();
}

// Fetch all feedback and join with user data to get the username
$stmt = $pdo->prepare("SELECT f.*, u.username FROM feedback f JOIN users u ON f.user_id = u.user_id ORDER BY f.submitted_at DESC");
$stmt->execute();
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all feedbacks as an associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/manage_feedback.css">
    <title>Manage Feedback - MMU Resources</title>
</head>
<body>
    <?php include 'header.php'; // Include the header ?>
    <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Users Feedbacks</h2>
        <i class="bi bi-chat-left-text" style="font-size: 2rem;"></i>
    </div>
        <div class="feedback-list">
            <?php if (count($feedbacks) > 0): // Check if there are feedbacks ?>
                <ul>
                    <?php foreach ($feedbacks as $feedback): // Loop through each feedback ?>
                        <li>
                            <p class="feedback-text"><?php echo nl2br(htmlspecialchars($feedback['feedback_text'])); ?></p>
                            <p class="feedback-user">by user: <?php echo htmlspecialchars($feedback['username']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <h4>No feedbacks available.</h4>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
