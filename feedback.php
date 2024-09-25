<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php"); // Redirect to signin page if not logged in
    exit();
}

require 'db.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if the form is submitted
    // Sanitize user input to prevent XSS attacks
    $feedback_text = filter_input(INPUT_POST, 'feedback_text', FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['user_id']; // Get the user ID from the session

    if (!empty($feedback_text)) { // Check if the feedback text is not empty
        // Insert the user's feedback into the database using prepared statements to prevent SQL injection
        $stmt = $pdo->prepare("INSERT INTO feedback (user_id, feedback_text) VALUES (?, ?)");
        $stmt->execute([$user_id, $feedback_text]);
        $success = 'Feedback submitted successfully.'; // Set success message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> 
    <title>Feedback - MMU Resources</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Feedback</h2>
        <?php if ($success): ?>
            <div class="alert success">
                <div class="alert--content">
                    <div class="alert--words"><?php echo htmlspecialchars($success); ?></div>
                </div>
            </div>
        <?php endif; ?>
        <form method="post" action="feedback.php">
            <div class="form-group">
                <label for="feedback_text">Your Feedback:</label>
                <textarea id="feedback_text" name="feedback_text" required></textarea> <!-- Textarea for the user to enter their feedback -->
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn" style="background-color: blue; color: white;">Submit Feedback</button>
            </div></div>
        </form>
    </div>
</body>
</html>
