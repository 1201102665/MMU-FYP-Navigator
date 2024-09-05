<?php
session_start();
require 'db.php';

// Restrict access to signed-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Fetch all announcements along with the admin user who created them
$stmt = $pdo->prepare("SELECT a.*, u.username AS admin_username FROM announcements a JOIN users u ON a.user_id = u.user_id ORDER BY a.created_at DESC");
$stmt->execute();
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/announcements.css">
    <title>Announcements - MMU Resources</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Announcements</h2>
        <?php if (count($announcements) > 0): ?>
            <?php foreach ($announcements as $announcement): ?>
                <div class="announcement">
                    <h3><?php echo htmlspecialchars($announcement['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
                    <small>Posted by <?php echo htmlspecialchars($announcement['admin_username']); ?> on <?php echo htmlspecialchars($announcement['created_at']); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h4>No announcements available.</h4>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
