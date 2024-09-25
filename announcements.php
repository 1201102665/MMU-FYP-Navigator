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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <title>Announcements - MMU Resources</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .announcement {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .announcement h3 {
            color: #0d6efd;
        }

        .announcement p {
            color: #333;
        }

        .announcement small {
            color: #6c757d;
        }

        .announcement-icon {
            font-size: 1.5rem;
            color: #0d6efd;
            margin-right: 10px;
        }

        .announcement-header {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4"><i class="bi bi-megaphone-fill announcement-icon"></i>Latest Announcements</h2>
        <?php if (count($announcements) > 0): ?>
            <?php foreach ($announcements as $announcement): ?>
                <div class="announcement">
                    <div class="announcement-header">
                        <i class="bi bi-info-circle-fill announcement-icon"></i>
                        <h3><?php echo htmlspecialchars($announcement['title']); ?></h3>
                    </div>
                    <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
                    <small><i class="bi bi-person-fill"></i> Posted by <?php echo htmlspecialchars($announcement['admin_username']); ?> on <?php echo htmlspecialchars($announcement['created_at']); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill"></i> No announcements available.
            </div>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
