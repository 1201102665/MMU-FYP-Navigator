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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>Create Announcement - MMU Resources</title>
</head>
<body style="background-color: white;"></body>
    
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4"><i class="bi bi-megaphone"></i> Create Announcement</h2>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="create_announcement.php">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter announcement title" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea id="content" name="content" class="form-control" rows="5" placeholder="Enter announcement content" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create Announcement
                </button>
                <a href="my_announcements.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to My Announcements
                </a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
