<?php
session_start();
require 'db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: signin.php");
    exit();
}

$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form inputs
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id']; // Get the admin user id from the session

    // Check if both title and content are not empty
    if (!empty($title) && !empty($content)) {
        // Prepare the SQL statement to insert the announcement into the database
        $stmt = $pdo->prepare("INSERT INTO announcements (title, content, user_id) VALUES (?, ?, ?)");
        // Execute the statement with the form inputs
        if ($stmt->execute([$title, $content, $user_id])) {
            $success = 'Announcement created successfully.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/create_announcement.css">
    <title>Create Announcement - MMU Resources</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Create Announcement</h2>
        <?php if ($success): ?>
            <div class="alert success">
                <div class="alert--content">
                    <div class="alert--words"><?php echo htmlspecialchars($success); ?></div>
                </div>
            </div>
        <?php endif; ?>
        <form method="post" action="create_announcement.php">
            <div class="form-group">
                <label for="title">Title:</label>
                <!-- Input field for the announcement title -->
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <!-- Textarea for the announcement content -->
                <textarea id="content" name="content" required></textarea>
            </div>
            <div class="btn-group">
                <!-- Submit button to create the announcement -->
                <button type="submit" class="btn">Create Announcement</button>
                <!-- Link to go back to My Announcements page -->
                <a href="my_announcements.php" class="btn btn-secondary">Back to My Announcements</a>
            </div>
        </form>
    </div>
</body>
</html>
